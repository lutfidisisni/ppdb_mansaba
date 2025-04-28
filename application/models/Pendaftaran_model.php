<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Simpan data pendaftaran ke database
     * 
     * @param array $data Data pendaftaran
     * @return array|bool Return array berisi [status, no_pendaftaran] jika berhasil, FALSE jika gagal
     */
    public function simpan_pendaftaran($data)
    {
        // Mulai transaksi database
        $this->db->trans_start();
        
        try {
            // Validasi data sebelum disimpan
            if (empty($data) || !is_array($data)) {
                throw new Exception('Data pendaftaran tidak valid');
            }

            // Generate nomor pendaftaran
            $no_pendaftaran = $this->generate_nomor_pendaftaran();
            if (!$no_pendaftaran) {
                throw new Exception('Gagal generate nomor pendaftaran');
            }

            // Tambahkan data sistem
            $data['tanggal_daftar'] = date('Y-m-d H:i:s');
            $data['no_pendaftaran'] = $no_pendaftaran;
            
            // Bersihkan data dari XSS
            $data = $this->security->xss_clean($data);

            // Log data sebelum disimpan
            log_message('debug', 'Model: Data yang akan disimpan: ' . json_encode($data));

            // Simpan ke database
            $this->db->insert('pendaftaran', $data);
            
            // Dapatkan ID pendaftaran yang baru dibuat
            $id_pendaftaran = $this->db->insert_id();
            
            // Selesaikan transaksi
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menyimpan data pendaftaran');
            }

            log_message('debug', 'Model: Data berhasil disimpan dengan ID: ' . $id_pendaftaran);
            
            return [
                'status' => true,
                'id_pendaftaran' => $id_pendaftaran,
                'no_pendaftaran' => $no_pendaftaran
            ];
            
        } catch (Exception $e) {
            // Rollback transaksi jika ada error
            $this->db->trans_rollback();
            
            // Log error
            log_message('error', 'Model: Error menyimpan pendaftaran - ' . $e->getMessage());
            log_message('error', 'Model: Error database: ' . json_encode($this->db->error()));
            
            return false;
        }
    }

    /**
     * Generate nomor pendaftaran otomatis
     * Format: A-2627/001 (Gelombang-TahunPelajaran/NomorUrut)
     * 
     * @return string Nomor pendaftaran
     */
    private function generate_nomor_pendaftaran()
    {
        $gelombang = 'A'; // Gelombang pendaftaran (A, B, C, dst)
        $tahun_pelajaran = '2627'; // Tahun pelajaran 2026/2027
        
        // Hitung jumlah pendaftar di gelombang ini
        $this->db->like('no_pendaftaran', $gelombang.'-'.$tahun_pelajaran, 'after');
        $jumlah_pendaftar = $this->db->count_all_results('pendaftaran');
        
        // Format nomor urut (3 digit)
        $no_urut = str_pad($jumlah_pendaftar + 1, 3, '0', STR_PAD_LEFT);
        
        return $gelombang.'-'.$tahun_pelajaran.'/'.$no_urut;
    }

    /**
     * Cek apakah NISN sudah terdaftar sebelumnya
     * 
     * @param string $nisn Nomor Induk Siswa Nasional
     * @return bool TRUE jika sudah terdaftar, FALSE jika belum
     */
    public function cek_nisn_terdaftar($nisn)
    {
        if (empty($nisn)) {
            return FALSE;
        }

        $this->db->where('nisn', $nisn);
        $query = $this->db->get('pendaftaran');
        
        return ($query->num_rows() > 0);
    }

    /**
     * Cek apakah nomor HP sudah terdaftar sebelumnya
     * 
     * @param string $no_hp Nomor HP/WhatsApp
     * @return bool TRUE jika sudah terdaftar, FALSE jika belum
     */
    public function cek_nohp_terdaftar($no_hp)
    {
        if (empty($no_hp)) {
            return FALSE;
        }

        $this->db->group_start()
             ->where('no_hp_siswa', $no_hp)
             ->or_where('no_hp_ayah', $no_hp)
             ->or_where('no_hp_ibu', $no_hp)
             ->or_where('no_hp_wali', $no_hp)
             ->group_end();
             
        $query = $this->db->get('pendaftaran');
        
        return ($query->num_rows() > 0);
    }

    /**
     * Dapatkan data pendaftaran berdasarkan ID
     * 
     * @param int $id ID pendaftaran
     * @return array|bool Data pendaftaran atau FALSE jika tidak ditemukan
     */
    public function get_pendaftaran_by_id($id)
    {
        if (empty($id) || !is_numeric($id)) {
            return FALSE;
        }

        $this->db->where('id', $id);
        $query = $this->db->get('pendaftaran');
        
        return ($query->num_rows() > 0) ? $query->row_array() : FALSE;
    }

    /**
     * Dapatkan data pendaftaran berdasarkan nomor pendaftaran
     * 
     * @param string $no_pendaftaran Nomor pendaftaran
     * @return array|bool Data pendaftaran atau FALSE jika tidak ditemukan
     */
    public function get_pendaftaran_by_no($no_pendaftaran)
    {
        if (empty($no_pendaftaran)) {
            return FALSE;
        }

        $this->db->where('no_pendaftaran', $no_pendaftaran);
        $query = $this->db->get('pendaftaran');
        
        return ($query->num_rows() > 0) ? $query->row_array() : FALSE;
    }
}