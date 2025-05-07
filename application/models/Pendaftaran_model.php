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
        try {
            // Log the incoming data
            log_message('debug', '=== Starting simpan_pendaftaran ===');
            log_message('debug', 'Received data: ' . json_encode($data));
            
            // Generate nomor pendaftaran
            $no_pendaftaran = $this->generate_no_pendaftaran();
            $data['no_pendaftaran'] = $no_pendaftaran;
            $data['tanggal_daftar'] = date('Y-m-d H:i:s');
            
            log_message('debug', 'Generated no_pendaftaran: ' . $no_pendaftaran);
            
            // Check for required fields
            $required_fields = [
                'nama_siswa', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
                'no_hp_siswa', 'alamat_lengkap', 'nama_ayah', 'nama_ibu'
            ];
            
            foreach ($required_fields as $field) {
                if (empty($data[$field])) {
                    log_message('error', 'Required field missing: ' . $field);
                    log_message('error', 'Field value: ' . (isset($data[$field]) ? $data[$field] : 'NOT SET'));
                    return [
                        'status' => false,
                        'message' => 'Field ' . $field . ' harus diisi'
                    ];
                }
            }
            
            log_message('debug', 'All required fields present');
            
            // Check for duplicate registration based on name and birth date
            if ($this->check_duplicate($data['nama_siswa'], $data['tanggal_lahir'])) {
                log_message('error', 'Duplicate registration found for: ' . $data['nama_siswa'] . ' (DOB: ' . $data['tanggal_lahir'] . ')');
                return [
                    'status' => false,
                    'message' => 'Siswa dengan nama dan tanggal lahir yang sama sudah terdaftar'
                ];
            }
            
            log_message('debug', 'No duplicates found, proceeding with insert');
            
            // Insert data
            $this->db->trans_start();
            $this->db->insert('pendaftaran', $data);
            $insert_id = $this->db->insert_id();
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                // Something went wrong
                $error = $this->db->error();
                log_message('error', 'Database transaction failed');
                log_message('error', 'Database error: ' . json_encode($error));
                return [
                    'status' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data: ' . $error['message']
                ];
            }
            
            log_message('debug', 'Data successfully inserted with ID: ' . $insert_id);
            log_message('debug', '=== End simpan_pendaftaran ===');
            
            return [
                'status' => true,
                'message' => 'Pendaftaran berhasil disimpan',
                'no_pendaftaran' => $no_pendaftaran,
                'id' => $insert_id
            ];
            
        } catch (Exception $e) {
            log_message('error', 'Error in simpan_pendaftaran: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Generate nomor pendaftaran otomatis
     * Format: A-2627/001 (Gelombang-TahunPelajaran/NomorUrut)
     * 
     * @return string Nomor pendaftaran
     */
    public function generate_no_pendaftaran()
    {
        $year = date('Y');
        $month = date('m');
        
        // Get the last registration number for this year and month
        $this->db->select('no_pendaftaran');
        $this->db->like('no_pendaftaran', $year . $month, 'after');
        $this->db->order_by('no_pendaftaran', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pendaftaran');
        
        if ($query->num_rows() > 0) {
            $last_no = $query->row()->no_pendaftaran;
            $sequence = intval(substr($last_no, -4)) + 1;
        } else {
            $sequence = 1;
        }
        
        // Format: YYYYMMXXXX (YYYY = year, MM = month, XXXX = sequence number)
        return $year . $month . str_pad($sequence, 4, '0', STR_PAD_LEFT);
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

    public function get_all_pendaftar() {
        $this->db->select('pendaftaran.*, daftar_ulang.no_daftar_ulang');
        $this->db->from('pendaftaran');
        $this->db->join('daftar_ulang', 'pendaftaran.id = daftar_ulang.pendaftaran_id', 'left');
        return $this->db->get()->result();
    }

    public function get_belum_daftar_ulang() {
        // Ambil pendaftar yang status_daftar_ulang-nya 'belum' atau NULL
        $this->db->where('(status_daftar_ulang = "belum" OR status_daftar_ulang IS NULL)');
        return $this->db->get('pendaftaran')->result();
    }

    public function get_laporan_sekolah() {
        $this->db->select('
            nama_sekolah,
            COUNT(*) as total_pendaftar,
            SUM(CASE WHEN status_daftar_ulang = "sudah" THEN 1 ELSE 0 END) as total_daftar_ulang
        ');
        $this->db->from('pendaftaran');
        $this->db->group_by('nama_sekolah');
        $this->db->order_by('total_pendaftar', 'DESC');
        return $this->db->get()->result();
    }

    public function update_status_daftar_ulang($pendaftaran_id, $status = 'sudah')
    {
        $this->db->where('id', $pendaftaran_id);
        return $this->db->update('pendaftaran', ['status_daftar_ulang' => $status]);
    }

    public function get_by_id($id)
    {
        return $this->get_pendaftaran_by_id($id);
    }

    public function get_laporan_harian($tanggal = null) {
        $this->db->select("COUNT(*) as total_pendaftar, 
                          SUM(CASE WHEN status_daftar_ulang = 'sudah' THEN 1 ELSE 0 END) as total_daftar_ulang,
                          SUM(CASE WHEN jenis_kelamin = 'laki-laki' THEN 1 ELSE 0 END) as total_laki,
                          SUM(CASE WHEN jenis_kelamin = 'perempuan' THEN 1 ELSE 0 END) as total_perempuan");
        return $this->db->get()->row();
    }

    public function get_laporan_rekomendasi() {
        $this->db->select('
            rekomendasi,
            COUNT(*) as total_pendaftar,
            SUM(CASE WHEN status_daftar_ulang = "sudah" THEN 1 ELSE 0 END) as total_daftar_ulang
        ');
        $this->db->from('pendaftaran');
        $this->db->where('rekomendasi IS NOT NULL');
        $this->db->group_by('rekomendasi');
        $this->db->order_by('total_pendaftar', 'DESC');
        return $this->db->get()->result();
    }

    public function update_pendaftaran($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pendaftaran', $data);
    }

    public function check_duplicate($nama_lengkap, $tanggal_lahir) {
        $this->db->where('nama_siswa', $nama_lengkap);
        $this->db->where('tanggal_lahir', $tanggal_lahir);
        $query = $this->db->get('pendaftaran');
        return $query->num_rows() > 0;
    }

}