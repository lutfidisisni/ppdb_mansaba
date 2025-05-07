<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/login');
        }
        $this->load->model('Pendaftaran_model');
        $this->load->model('Daftar_ulang_model');
        // Add authentication check here
    }

    public function index() {
        $this->load->view('admin/dashboard');
    }

    public function input_daftar_ulang() {
        $data['title'] = 'Input Daftar Ulang';
        $data['pendaftar'] = $this->Pendaftaran_model->get_belum_daftar_ulang();
        $this->load->view('admin/input_daftar_ulang', $data);
    }

    public function data_pendaftar() {
        $data['title'] = 'Data Pendaftar';
        $data['pendaftar'] = $this->Pendaftaran_model->get_all_pendaftar();
        $this->load->view('admin/data_pendaftar', $data);
    }

    public function peserta_daftar_ulang() {
        $data['title'] = 'Peserta Daftar Ulang';
        $data['peserta'] = $this->Daftar_ulang_model->get_all_peserta_daftar_ulang();
        $this->load->view('admin/peserta_daftar_ulang', $data);
    }

    public function belum_daftar_ulang() {
        $data['title'] = 'Data Belum Daftar Ulang';
        $data['pendaftar'] = $this->Pendaftaran_model->get_belum_daftar_ulang();
        $this->load->view('admin/belum_daftar_ulang', $data);
    }

    public function exportExcelBelumDaftarUlang() {
        $data = $this->Pendaftaran_model->get_belum_daftar_ulang();
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="belum_daftar_ulang_'.date('Ymd').'.csv"');
        
        $output = fopen('php://output', 'w');
        
        fputcsv($output, array('No', 'Nomor Pendaftaran', 'Nama Siswa', 'Sekolah Asal', 'Alamat Lengkap', 'Tanggal Pendaftaran', 'Rekomendasi'));
        
        $no = 1;
        foreach($data as $row) {
            fputcsv($output, array(
                $no++,
                $row->no_pendaftaran,
                $row->nama_siswa,
                $row->nama_sekolah,
                $row->alamat_lengkap,
                date('d/m/Y', strtotime($row->tanggal_pendaftaran)),
                $row->rekomendasi
            ));
        }
        
        fclose($output);
        exit;
    }

    public function laporan_harian() {
        $data['title'] = 'Laporan Harian';
        $data['tanggal'] = $this->input->get('tanggal') ? $this->input->get('tanggal') : date('Y-m-d');
        $data['laporan'] = $this->Daftar_ulang_model->get_laporan_harian($data['tanggal']);
        $data['rekap_harian'] = $this->Daftar_ulang_model->get_rekap_laporan_harian($data['tanggal']);
        $this->load->view('admin/laporan_harian', $data);
    }

    public function laporan_sekolah() {
        $data['title'] = 'Laporan Data Sekolah';
        $data['laporan'] = $this->Pendaftaran_model->get_laporan_sekolah();
        $this->load->view('admin/laporan_sekolah', $data);
    }

    public function save_daftar_ulang() {
        $this->form_validation->set_rules('pendaftaran_id', 'Pendaftaran ID', 'required');
        $this->form_validation->set_rules('nominal_daftar_ulang', 'Nominal Daftar Ulang', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/input_daftar_ulang');
        } else {
            $tgl_lahir = $this->input->post('tanggal_lahir'); // format: dd/mm/yyyy
            if ($tgl_lahir) {
                $parts = explode('/', $tgl_lahir);
                if (count($parts) == 3) {
                    $tgl_lahir_db = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
                } else {
                    $tgl_lahir_db = null;
                }
            } else {
                $tgl_lahir_db = null;
            }

            $nama_siswa = $this->input->post('nama_siswa');
            $nama_ayah = $this->input->post('nama_ayah');

            // Cek duplikasi daftar ulang berdasarkan pendaftaran_id
            $this->db->where('pendaftaran_id', $this->input->post('pendaftaran_id'));
            $cek = $this->db->get('daftar_ulang')->num_rows();

            if ($cek > 0) {
                $data['error'] = 'Data dengan nama dan nama ayah yang sama sudah ada!';
                $this->load->view('admin/input_daftar_ulang', $data);
                return;
            }

            $data = array(
                'pendaftaran_id' => $this->input->post('pendaftaran_id'),
                'no_daftar_ulang' => $this->generate_no_daftar_ulang(),
                'kk_asli' => $this->input->post('kk_asli') ? 1 : 0,
                'skl' => $this->input->post('skl') ? 1 : 0,
                'piagam' => $this->input->post('piagam') ? 1 : 0,
                'sktm' => $this->input->post('sktm') ? 1 : 0,
                'bayar_daftar_ulang' => $this->input->post('bayar_daftar_ulang') ? 1 : 0,
                'nominal_daftar_ulang' => $this->input->post('nominal_daftar_ulang'),
                'ukuran_seragam' => $this->input->post('ukuran_seragam'),
                'seragam_osis' => $this->input->post('seragam_osis') ? 1 : 0,
                'seragam_pramuka' => $this->input->post('seragam_pramuka') ? 1 : 0,
                'seragam_batik' => $this->input->post('seragam_batik') ? 1 : 0,
                'seragam_olahraga' => $this->input->post('seragam_olahraga') ? 1 : 0
            );

            if ($this->Daftar_ulang_model->save($data)) {
                $this->Pendaftaran_model->update_status_daftar_ulang($data['pendaftaran_id'], 'sudah');
                $this->session->set_flashdata('success', 'Data daftar ulang berhasil disimpan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data daftar ulang');
            }
            redirect('admin/input_daftar_ulang');
        }
    }

    private function generate_no_daftar_ulang() {
        $last_no = $this->Daftar_ulang_model->get_last_no_daftar_ulang();
        $next_no = 1;
        if ($last_no) {
            $last_no = explode('-', $last_no);
            $next_no = intval($last_no[1]) + 1;
        }
        return 'DU-' . str_pad($next_no, 3, '0', STR_PAD_LEFT);
    }

    public function cetak_formulir($id) {
        $data['pendaftar'] = $this->Pendaftaran_model->get_pendaftaran_by_id($id);

        $this->load->view('admin/cetak_formulir', $data);
    }

    public function cetak_bukti_daftar_ulang($id) {
        $data['daftar_ulang'] = $this->Daftar_ulang_model->get_by_id($id);
        $pendaftar = $this->Pendaftaran_model->get_pendaftaran_by_id($data['daftar_ulang']->pendaftaran_id);
        if (is_array($pendaftar)) {
            $pendaftar = (object) $pendaftar;
        }
        $data['pendaftar'] = $pendaftar;
        
        // Ambil data kop sekolah dengan pengecekan
        
        
        $this->load->view('admin/cetak_bukti_daftar_ulang', $data);
    }

    public function data_pendaftar_lengkap() {
        $data['title'] = 'Data Pendaftar Lengkap';
        $data['pendaftar'] = $this->Pendaftaran_model->get_all_pendaftar();
        $this->load->view('admin/data_pendaftar_lengkap', $data);
    }

    public function hapus_pendaftar_lengkap() {
        $ids = $this->input->post('ids');
        if (!is_array($ids) || empty($ids)) {
            echo json_encode(['status' => false, 'msg' => 'Tidak ada data yang dipilih']);
            return;
        }
        $this->load->database();
        $this->db->where_in('id', $ids);
        $result = $this->db->delete('pendaftaran');
        if ($result) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Gagal menghapus data']);
        }
    }

    public function tambah_petugas() {
        $this->load->view('admin/tambah_petugas');
    }

    public function simpan_petugas() {
        $this->load->database();
        $nama_lengkap = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if (!$nama_lengkap || !$username || !$password) {
            $data['error'] = 'Semua field wajib diisi!';
            $this->load->view('admin/tambah_petugas', $data);
            return;
        }
        // Cek username unik
        $cek = $this->db->get_where('petugas', ['username' => $username])->row();
        if ($cek) {
            $data['error'] = 'Username sudah digunakan!';
            $this->load->view('admin/tambah_petugas', $data);
            return;
        }
        $insert = $this->db->insert('petugas', [
            'nama_lengkap' => $nama_lengkap,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        if ($insert) {
            $data['success'] = 'Petugas berhasil ditambahkan!';
        } else {
            $data['error'] = 'Gagal menambah petugas!';
        }
        $this->load->view('admin/tambah_petugas', $data);
    }

    public function pengaturan()
    {
        $data['title'] = 'Pengaturan Tahun Pelajaran & Gelombang';
        $data['tahun_pelajaran'] = $this->db->get_where('pengaturan', ['nama' => 'tahun_pelajaran'])->row('nilai');
        $data['gelombang'] = $this->db->get_where('pengaturan', ['nama' => 'gelombang'])->row('nilai');
        
        $this->load->view('admin/pengaturan', $data);
    }

    

    public function rekapitulasi_ppdb() {
        $data['title'] = 'Rekapitulasi PPDB';
        $data['laporan'] = $this->Daftar_ulang_model->get_laporan_harian(date('Y-m-d'));
        $data['rekap_harian'] = $this->Daftar_ulang_model->get_rekap_laporan_harian();
        $this->load->view('admin/rekapitulasi', $data);
    }

    public function hapus_peserta_daftar_ulang($id) {
        // Cek apakah data exists
        $peserta = $this->db->get_where('daftar_ulang', ['id' => $id])->row();
        if (!$peserta) {
            $this->session->set_flashdata('error', 'Data peserta tidak ditemukan');
            redirect('admin/peserta_daftar_ulang');
            return;
        }

        // Hapus data
        $this->db->where('id', $id);
        $this->db->delete('daftar_ulang');

        if ($this->db->affected_rows() > 0) {
            // Update status pendaftaran menjadi 'belum'
            $this->Pendaftaran_model->update_status_daftar_ulang($peserta->pendaftaran_id, 'belum');
            $this->session->set_flashdata('success', 'Data peserta berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data peserta');
        }

        redirect('admin/peserta_daftar_ulang');
    }

    public function hapus_multiple_peserta_daftar_ulang() {
        $ids = $this->input->get('ids');
        if (!$ids) {
            $this->session->set_flashdata('error', 'Tidak ada data yang dipilih');
            redirect('admin/peserta_daftar_ulang');
            return;
        }

        $id_array = explode(',', $ids);
        
        // Ambil data peserta sebelum dihapus untuk update status pendaftaran
        $peserta_list = $this->db->where_in('id', $id_array)->get('daftar_ulang')->result();
        
        // Hapus data
        $this->db->where_in('id', $id_array);
        $this->db->delete('daftar_ulang');

        if ($this->db->affected_rows() > 0) {
            // Update status pendaftaran menjadi 'belum' untuk semua yang dihapus
            foreach ($peserta_list as $peserta) {
                $this->Pendaftaran_model->update_status_daftar_ulang($peserta->pendaftaran_id, 'belum');
            }
            $this->session->set_flashdata('success', count($id_array) . ' data peserta berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data peserta');
        }

        redirect('admin/peserta_daftar_ulang');
    }

    public function edit_peserta_daftar_ulang($id) {
        // Cek apakah admin sudah login
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        // Load model
        $this->load->model('daftar_ulang_model');
        
        // Ambil data peserta berdasarkan ID
        $data['peserta'] = $this->daftar_ulang_model->get_peserta_by_id($id);
        
        if (!$data['peserta']) {
            $this->session->set_flashdata('error', 'Data peserta tidak ditemukan');
            redirect('admin/peserta_daftar_ulang');
        }

        // Data untuk view
        $data['title'] = 'Edit Data Peserta Daftar Ulang';
        
        // Load view
        $this->load->view('admin/edit_peserta_daftar_ulang', $data);
    }

    public function update_peserta_daftar_ulang() {
        // Cek apakah admin sudah login
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        // Load model
        $this->load->model('daftar_ulang_model');
        
        // Ambil data dari form
        $id = $this->input->post('id');
        $data = array(
            'kk_asli' => $this->input->post('kk_asli') ? 1 : 0,
            'skl' => $this->input->post('skl') ? 1 : 0,
            'piagam' => $this->input->post('piagam') ? 1 : 0,
            'sktm' => $this->input->post('sktm') ? 1 : 0,
            'seragam_osis' => $this->input->post('seragam_osis') ? 1 : 0,
            'seragam_pramuka' => $this->input->post('seragam_pramuka') ? 1 : 0,
            'seragam_batik' => $this->input->post('seragam_batik') ? 1 : 0,
            'seragam_olahraga' => $this->input->post('seragam_olahraga') ? 1 : 0,
            'ukuran_seragam' => $this->input->post('ukuran_seragam'),
            'bayar_daftar_ulang' => $this->input->post('bayar_daftar_ulang') ? 1 : 0,
            'nominal_daftar_ulang' => str_replace('.', '', $this->input->post('nominal_daftar_ulang'))
        );

        // Update data
        if ($this->daftar_ulang_model->update_peserta($id, $data)) {
            $this->session->set_flashdata('success', 'Data peserta berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data peserta');
        }

        redirect('admin/peserta_daftar_ulang');
    }

    public function laporan_rekomendasi() {
        $data['title'] = 'Laporan Data Rekomendasi';
        $data['laporan'] = $this->Pendaftaran_model->get_laporan_rekomendasi();
        $this->load->view('admin/laporan_rekomendasi', $data);
    }

    public function laporan_seragam() {
        $data['title'] = 'Laporan Seragam';
        
        // Get data seragam berdasarkan jenis kelamin
        $this->db->select('
            p.jenis_kelamin,
            COUNT(DISTINCT p.id) as total,
            SUM(CASE WHEN du.seragam_osis = 1 THEN 1 ELSE 0 END) as total_osis,
            SUM(CASE WHEN du.seragam_pramuka = 1 THEN 1 ELSE 0 END) as total_pramuka,
            SUM(CASE WHEN du.seragam_batik = 1 THEN 1 ELSE 0 END) as total_batik,
            SUM(CASE WHEN du.seragam_olahraga = 1 THEN 1 ELSE 0 END) as total_olahraga
        ');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id', 'left');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $this->db->group_by('p.jenis_kelamin');
        $data['seragam_gender'] = $this->db->get()->result();

        // Get data seragam berdasarkan ukuran untuk laki-laki
        $this->db->select('
            du.ukuran_seragam,
            COUNT(DISTINCT p.id) as total,
            SUM(CASE WHEN du.seragam_osis = 1 THEN 1 ELSE 0 END) as total_osis,
            SUM(CASE WHEN du.seragam_pramuka = 1 THEN 1 ELSE 0 END) as total_pramuka,
            SUM(CASE WHEN du.seragam_batik = 1 THEN 1 ELSE 0 END) as total_batik,
            SUM(CASE WHEN du.seragam_olahraga = 1 THEN 1 ELSE 0 END) as total_olahraga
        ');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $this->db->where('p.jenis_kelamin', 'Laki-laki');
        $this->db->where('du.ukuran_seragam IS NOT NULL');
        $this->db->group_by('du.ukuran_seragam');
        $this->db->order_by('FIELD(du.ukuran_seragam, "S", "M", "L", "XL", "XXL", "3XL", "custom")', FALSE);
        $data['seragam_ukuran_laki'] = $this->db->get()->result();

        // Get data seragam berdasarkan ukuran untuk perempuan
        $this->db->select('
            du.ukuran_seragam,
            COUNT(DISTINCT p.id) as total,
            SUM(CASE WHEN du.seragam_osis = 1 THEN 1 ELSE 0 END) as total_osis,
            SUM(CASE WHEN du.seragam_pramuka = 1 THEN 1 ELSE 0 END) as total_pramuka,
            SUM(CASE WHEN du.seragam_batik = 1 THEN 1 ELSE 0 END) as total_batik,
            SUM(CASE WHEN du.seragam_olahraga = 1 THEN 1 ELSE 0 END) as total_olahraga
        ');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $this->db->where('p.jenis_kelamin', 'Perempuan');
        $this->db->where('du.ukuran_seragam IS NOT NULL');
        $this->db->group_by('du.ukuran_seragam');
        $this->db->order_by('FIELD(du.ukuran_seragam, "S", "M", "L", "XL", "XXL", "3XL", "custom")', FALSE);
        $data['seragam_ukuran_perempuan'] = $this->db->get()->result();

        // Get total keseluruhan dan kebutuhan untuk Laki-laki
        $this->db->select('
            COUNT(DISTINCT p.id) as total,
            SUM(CASE WHEN du.seragam_osis = 1 THEN 1 ELSE 0 END) as total_osis,
            SUM(CASE WHEN du.seragam_pramuka = 1 THEN 1 ELSE 0 END) as total_pramuka,
            SUM(CASE WHEN du.seragam_batik = 1 THEN 1 ELSE 0 END) as total_batik,
            SUM(CASE WHEN du.seragam_olahraga = 1 THEN 1 ELSE 0 END) as total_olahraga
        ');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id', 'left');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $this->db->where('p.jenis_kelamin', 'Laki-laki');
        $data['total_laki'] = $this->db->get()->row();

        // Get total keseluruhan dan kebutuhan untuk Perempuan
        $this->db->select('
            COUNT(DISTINCT p.id) as total,
            SUM(CASE WHEN du.seragam_osis = 1 THEN 1 ELSE 0 END) as total_osis,
            SUM(CASE WHEN du.seragam_pramuka = 1 THEN 1 ELSE 0 END) as total_pramuka,
            SUM(CASE WHEN du.seragam_batik = 1 THEN 1 ELSE 0 END) as total_batik,
            SUM(CASE WHEN du.seragam_olahraga = 1 THEN 1 ELSE 0 END) as total_olahraga
        ');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id', 'left');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $this->db->where('p.jenis_kelamin', 'Perempuan');
        $data['total_perempuan'] = $this->db->get()->row();

        // Calculate total pending seragam untuk Laki-laki
        $data['pending_seragam_laki'] = [
            'osis' => $data['total_laki']->total - $data['total_laki']->total_osis,
            'pramuka' => $data['total_laki']->total - $data['total_laki']->total_pramuka,
            'batik' => $data['total_laki']->total - $data['total_laki']->total_batik,
            'olahraga' => $data['total_laki']->total - $data['total_laki']->total_olahraga
        ];

        // Calculate total pending seragam untuk Perempuan
        $data['pending_seragam_perempuan'] = [
            'osis' => $data['total_perempuan']->total - $data['total_perempuan']->total_osis,
            'pramuka' => $data['total_perempuan']->total - $data['total_perempuan']->total_pramuka,
            'batik' => $data['total_perempuan']->total - $data['total_perempuan']->total_batik,
            'olahraga' => $data['total_perempuan']->total - $data['total_perempuan']->total_olahraga
        ];

        // Get total keseluruhan (for overall stats)
        $this->db->select('
            COUNT(DISTINCT p.id) as total,
            SUM(CASE WHEN du.seragam_osis = 1 THEN 1 ELSE 0 END) as total_osis,
            SUM(CASE WHEN du.seragam_pramuka = 1 THEN 1 ELSE 0 END) as total_pramuka,
            SUM(CASE WHEN du.seragam_batik = 1 THEN 1 ELSE 0 END) as total_batik,
            SUM(CASE WHEN du.seragam_olahraga = 1 THEN 1 ELSE 0 END) as total_olahraga
        ');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id', 'left');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $data['total_keseluruhan'] = $this->db->get()->row();

        // Get data custom size
        $this->db->select('COUNT(DISTINCT p.id) as total_custom');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $this->db->where('du.ukuran_seragam', 'custom');
        $data['total_custom'] = $this->db->get()->row()->total_custom;

        // Calculate total pending
        $data['total_pending'] = array_sum($data['pending_seragam_laki']) + array_sum($data['pending_seragam_perempuan']);

        // Get data pending seragam untuk Laki-laki berdasarkan ukuran
        $this->db->select('
            du.ukuran_seragam,
            SUM(CASE WHEN du.seragam_osis = 0 THEN 1 ELSE 0 END) as pending_osis,
            SUM(CASE WHEN du.seragam_pramuka = 0 THEN 1 ELSE 0 END) as pending_pramuka,
            SUM(CASE WHEN du.seragam_batik = 0 THEN 1 ELSE 0 END) as pending_batik,
            SUM(CASE WHEN du.seragam_olahraga = 0 THEN 1 ELSE 0 END) as pending_olahraga
        ');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $this->db->where('p.jenis_kelamin', 'Laki-laki');
        $this->db->where('du.ukuran_seragam IS NOT NULL');
        $this->db->having('pending_osis > 0 OR pending_pramuka > 0 OR pending_batik > 0 OR pending_olahraga > 0');
        $this->db->group_by('du.ukuran_seragam');
        $this->db->order_by('FIELD(du.ukuran_seragam, "S", "M", "L", "XL", "XXL", "3XL", "custom")', FALSE);
        $data['pending_seragam_laki'] = $this->db->get()->result();

        // Get data pending seragam untuk Perempuan berdasarkan ukuran
        $this->db->select('
            du.ukuran_seragam,
            SUM(CASE WHEN du.seragam_osis = 0 THEN 1 ELSE 0 END) as pending_osis,
            SUM(CASE WHEN du.seragam_pramuka = 0 THEN 1 ELSE 0 END) as pending_pramuka,
            SUM(CASE WHEN du.seragam_batik = 0 THEN 1 ELSE 0 END) as pending_batik,
            SUM(CASE WHEN du.seragam_olahraga = 0 THEN 1 ELSE 0 END) as pending_olahraga
        ');
        $this->db->from('pendaftaran p');
        $this->db->join('daftar_ulang du', 'p.id = du.pendaftaran_id');
        $this->db->where('p.status_daftar_ulang', 'sudah');
        $this->db->where('p.jenis_kelamin', 'Perempuan');
        $this->db->where('du.ukuran_seragam IS NOT NULL');
        $this->db->having('pending_osis > 0 OR pending_pramuka > 0 OR pending_batik > 0 OR pending_olahraga > 0');
        $this->db->group_by('du.ukuran_seragam');
        $this->db->order_by('FIELD(du.ukuran_seragam, "S", "M", "L", "XL", "XXL", "3XL", "custom")', FALSE);
        $data['pending_seragam_perempuan'] = $this->db->get()->result();

        $this->load->view('admin/laporan_seragam', $data);
    }

    public function edit_pendaftar($id) {
        $this->load->model('Pendaftaran_model');
        $data['pendaftar'] = $this->Pendaftaran_model->get_pendaftaran_by_id($id);
        
        if(empty($data['pendaftar'])) {
            $this->session->set_flashdata('error', 'Data pendaftar tidak ditemukan');
            redirect('admin/data_pendaftar_lengkap');
        }
        
        $this->load->view('admin/edit_pendaftar', $data);
    }

    public function update_pendaftar($id) {
        $this->load->model('Pendaftaran_model');
        
        // Validate form data
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('no_hp_siswa', 'No. HP Siswa', 'required');
        $this->form_validation->set_rules('tinggal', 'Status Tinggal', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('pendidikan_ayah', 'Pendidikan Ayah', 'required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'required');
        $this->form_validation->set_rules('no_hp_ayah', 'No. HP Ayah', 'required');
        $this->form_validation->set_rules('pendidikan_ibu', 'Pendidikan Ibu', 'required');
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'required');
        $this->form_validation->set_rules('no_hp_ibu', 'No. HP Ibu', 'required');
        $this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'required');
        $this->form_validation->set_rules('alamat_sekolah', 'Alamat Sekolah', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->edit_pendaftar($id);
        } else {
            $data = array(
                'nama_siswa' => $this->input->post('nama_siswa'),
                'rekomendasi' => $this->input->post('rekomendasi'),
                'jalur_pendaftaran' => $this->input->post('jalur_pendaftaran'),
                'pilihan_program' => $this->input->post('pilihan_program'),
                'nama_siswa' => $this->input->post('nama_siswa'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'no_hp_siswa' => $this->input->post('no_hp_siswa'),
                'tinggal' => $this->input->post('tinggal'),
                'alamat_lengkap' => $this->input->post('alamat_lengkap'),
                'nama_sekolah' => $this->input->post('nama_sekolah'),
                'nisn' => $this->input->post('nisn'),
                'alamat_sekolah' => $this->input->post('alamat_sekolah'),
                'nama_ayah' => $this->input->post('nama_ayah'),
                'nama_ibu' => $this->input->post('nama_ibu'),
                'pendidikan_ayah' => $this->input->post('pendidikan_ayah'),
                'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
                'no_hp_ayah' => $this->input->post('no_hp_ayah'),
                'pendidikan_ibu' => $this->input->post('pendidikan_ibu'),
                'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
                'no_hp_ibu' => $this->input->post('no_hp_ibu'),
                'nama_sekolah' => $this->input->post('nama_sekolah'),
                'nisn' => $this->input->post('nisn'),
                'alamat_sekolah' => $this->input->post('alamat_sekolah'),
                'nama_wali' => $this->input->post('nama_wali'),
                'hubungan_wali' => $this->input->post('hubungan_wali'),
                'pendidikan_wali' => $this->input->post('pendidikan_wali'),
                'pekerjaan_wali' => $this->input->post('pekerjaan_wali'),
                'no_hp_wali' => $this->input->post('no_hp_wali'),
                'alamat_wali' => $this->input->post('alamat_wali')
            );
            
            $result = $this->Pendaftaran_model->update_pendaftaran($id, $data);
            
            if($result) {
                $this->session->set_flashdata('success', 'Data pendaftar berhasil diperbarui');
                redirect('admin/data_pendaftar_lengkap');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data pendaftar');
                $this->edit_pendaftar($id);
            }
        }
    }

    public function upload_kop() {
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadPath = FCPATH . 'assets/img/kop_sekolah.jpg';
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
                $this->db->update('pengaturan', ['nilai' => 'kop_sekolah.jpg'], ['nama' => 'kop_sekolah']);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan file']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengupload file']);
        }
    }

    public function update_pengaturan() {
        $this->load->library('upload');
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $this->upload->initialize($config);

        $data = [
            'tahun_pelajaran' => $this->input->post('tahun_pelajaran'),
            'gelombang' => $this->input->post('gelombang')
        ];

        if ($this->upload->do_upload('kop_sekolah')) {
            $upload_data = $this->upload->data();
            $data['kop_sekolah'] = 'assets/img/' . $upload_data['file_name'];
            $this->db->set('nilai', 'assets/img/' . $upload_data['file_name'])
                     ->where('nama', 'kop_sekolah')
                     ->update('pengaturan');
        }

        $this->load->model('Pengaturan_model');
        $this->Pengaturan_model->update_settings($data);
        
        $this->session->set_flashdata('success', 'Pengaturan berhasil diperbarui');
        redirect('admin/pengaturan');
    }
}