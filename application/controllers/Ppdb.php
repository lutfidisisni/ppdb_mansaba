<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppdb extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation', 'session']);
        $this->load->model('ppdb_model');
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function form_pendaftaran() {
        $data['title'] = 'Form Pendaftaran PPDB';
        $this->load->view('ppdb/form_pendaftaran', $data);
    }
    
    public function pendaftaran_sukses($nomor_pendaftaran = '') {
        if (empty($nomor_pendaftaran)) {
            redirect('ppdb/form_pendaftaran');
        }
        
        // Get registration data by number
        $this->load->model('ppdb_model');
        $pendaftaran = $this->ppdb_model->get_pendaftaran_by_nomor($nomor_pendaftaran);
        
        if (!$pendaftaran) {
            redirect('ppdb/form_pendaftaran');
        }
        
        $data['title'] = 'Pendaftaran Berhasil';
        $data['pendaftaran'] = $pendaftaran;
        $data['success'] = true;
        $data['success_message'] = 'Pendaftaran berhasil disimpan! Nomor pendaftaran Anda adalah <strong>' . $nomor_pendaftaran . '</strong>';
        
        $this->load->view('ppdb/pendaftaran_sukses', $data);
    }
    
    /**
     * Method untuk menampilkan detail pendaftaran
     * Digunakan saat tombol "Lihat Detail Pendaftaran" diklik
     */
    public function detail_pendaftaran($nomor_pendaftaran = '') {
        // First try to get nomor from the URL parameter
        if (empty($nomor_pendaftaran)) {
            // Check if it's passed as a GET parameter
            $nomor_get = $this->input->get('nomor');
            if (!empty($nomor_get)) {
                $nomor_pendaftaran = $nomor_get;
            }
        }
        
        // Still empty? Check session
        if (empty($nomor_pendaftaran)) {
            $nomor_pendaftaran = $this->session->userdata('nomor_pendaftaran');
        }
        
        // Now redirect based on whether we have a registration number or not
        if (!empty($nomor_pendaftaran)) {
            // Force direct redirect to pendaftaran_sukses
            // Use absolute URL to avoid any routing issues
            $base_url = rtrim(base_url(), '/');
            if (substr($base_url, -9) == 'index.php') {
                $base_url = substr($base_url, 0, -9);
            }
            
            // Log for debugging
            log_message('debug', 'Redirecting to pendaftaran_sukses with nomor: ' . $nomor_pendaftaran);
            
            // Handle direct navigation
            redirect('ppdb/pendaftaran_sukses/' . $nomor_pendaftaran, 'location', 301);
        } else {
            // Fallback to form if no registration number is found
            redirect('ppdb/form_pendaftaran');
        }
    }
    
    /**
     * Method untuk menampilkan halaman sukses standalone
     * Ini digunakan untuk menampilkan modal sukses yang terlihat pada Gambar 1
     */
    public function success() {
        // Ambil nomor pendaftaran dari parameter GET atau dari session
        $nomor_pendaftaran = $this->input->get('nomor');
        if (empty($nomor_pendaftaran)) {
            $nomor_pendaftaran = $this->session->userdata('nomor_pendaftaran');
        }
        
        if (empty($nomor_pendaftaran)) {
            redirect('ppdb/form_pendaftaran');
        }
        
        $data['nomor_pendaftaran'] = $nomor_pendaftaran;
        $this->load->view('ppdb/success_modal', $data);
    }

    public function save_pendaftaran() {
        // Log request for debugging
        log_message('debug', 'POST data: ' . print_r($_POST, true));
        
        // Validasi input
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('no_hp_siswa', 'Nomor HP', 'required');
        // ... tambahkan validasi lainnya sesuai kebutuhan

        if ($this->form_validation->run() == FALSE) {
            // If validation failed, redirect back to form with error message
            $this->session->set_flashdata('error_message', validation_errors());
            redirect('ppdb/form_pendaftaran');
            return;
        }
        
        // Set debugging to show errors
        $this->db->db_debug = TRUE;
        
        // Remove columns that don't exist in database
        unset($_POST['tahun_pelajaran']);
        unset($_POST['gelombang']);
        
        // Data pribadi
        $data = array(
            'nama_siswa' => $this->input->post('nama_siswa'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir_db'),
            'tempat_tanggal_lahir' => $this->input->post('tempat_tanggal_lahir_db'),
            'no_hp_siswa' => $this->input->post('no_hp_siswa'),
            'rekomendasi' => $this->input->post('rekomendasi'),
            'pilihan_program' => $this->input->post('pilihan_program'),
            'jalur_pendaftaran' => $this->input->post('jalur_pendaftaran'),
            
            // Data alamat
            'tinggal' => $this->input->post('tinggal'),
            'dukuh' => $this->input->post('dukuh'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'desa' => $this->input->post('desa'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kabupaten' => $this->input->post('kabupaten'),
            'provinsi' => $this->input->post('provinsi'),
            'alamat_lengkap' => $this->input->post('alamat_lengkap_db'),
            
            // Data orang tua
            'nama_ayah' => $this->input->post('nama_ayah'),
            'nama_ibu' => $this->input->post('nama_ibu'),
            'pendidikan_ayah' => $this->input->post('pendidikan_ayah'),
            'pendidikan_ibu' => $this->input->post('pendidikan_ibu'),
            'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
            'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
            'no_hp_ayah' => $this->input->post('no_hp_ayah'),
            'no_hp_ibu' => $this->input->post('no_hp_ibu'),
            'alamat_ortu' => $this->input->post('alamat_ortu'),
            'saudara_sekolah' => $this->input->post('saudara_sekolah'),
            
            // Data wali (jika ada)
            'nama_wali' => $this->input->post('nama_wali'),
            'hubungan_wali' => $this->input->post('hubungan_wali'),
            'pendidikan_wali' => $this->input->post('pendidikan_wali'),
            'pekerjaan_wali' => $this->input->post('pekerjaan_wali'),
            'no_hp_wali' => $this->input->post('no_hp_wali'),
            'alamat_wali' => $this->input->post('alamat_wali'),
            
            // Data sekolah
            'nama_sekolah' => $this->input->post('nama_sekolah'),
            'nisn' => $this->input->post('nisn'),
            'alamat_sekolah' => $this->input->post('alamat_sekolah'),
            'piagam' => $this->input->post('piagam'),
            'nama_event' => $this->input->post('nama_event'),
            'motivasi' => $this->input->post('motivasi'),
            
            // Data tambahan
            'tanggal_daftar' => date('Y-m-d H:i:s'),
            'status' => 'Baru'
        );

        // Generate nomor pendaftaran dengan format A-2526/XXXX
        $data['no_pendaftaran'] = $this->ppdb_model->generate_nomor_pendaftaran();
        
        // For debugging
        log_message('debug', 'Generated registration number: ' . $data['no_pendaftaran']);
        log_message('debug', 'Form data to save: ' . print_r($data, true));

        // Simpan data
        $result = $this->ppdb_model->save_pendaftaran($data);

        if($result) {
            // Store essential data in session
            $this->session->set_userdata('last_submission_success', true);
            $this->session->set_userdata('nomor_pendaftaran', $data['no_pendaftaran']);
            
            // Check if request is AJAX (XMLHttpRequest)
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // Set proper headers for JSON response
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => 'success',
                        'nomor_pendaftaran' => $data['no_pendaftaran']
                    ]));
                return;
            }
            
            // For non-AJAX requests, redirect to success page
            redirect('ppdb/pendaftaran_sukses/' . $data['no_pendaftaran']);
        } else {
            // If save failed
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data pendaftaran'
                    ]));
                return;
            }
            
            $this->session->set_flashdata('error_message', 'Gagal menyimpan data pendaftaran');
            redirect('ppdb/form_pendaftaran');
        }
    }
    
    /**
     * Fungsi untuk menguji notifikasi sukses pendaftaran
     */
    public function test_success() {
        // Load model
        $this->load->model('ppdb_model');
        
        // Generate nomor pendaftaran untuk testing
        $nomor_pendaftaran = $this->ppdb_model->generate_nomor_pendaftaran();
        
        // Membuat data dummy untuk menguji
        $pendaftaran = new stdClass();
        $pendaftaran->no_pendaftaran = $nomor_pendaftaran;
        $pendaftaran->nama_siswa = 'Test User';
        $pendaftaran->tanggal_daftar = date('Y-m-d');
        $pendaftaran->tanggal_lahir = '2000-01-01';
        $pendaftaran->tempat_lahir = 'Jakarta';
        $pendaftaran->jenis_kelamin = 'Laki-laki';
        $pendaftaran->agama = 'Islam';
        $pendaftaran->nik = '3200000000000001';
        $pendaftaran->nisn = '1234567890';
        $pendaftaran->no_hp_siswa = '081234567890';
        $pendaftaran->email = 'test@example.com';
        $pendaftaran->alamat_lengkap = 'Jl. Test No. 123';
        $pendaftaran->provinsi = 'Jawa Tengah';
        $pendaftaran->kabupaten = 'Demak';
        $pendaftaran->kecamatan = 'Mranggen';
        $pendaftaran->desa = 'Mranggen';
        $pendaftaran->kode_pos = '59567';
        $pendaftaran->tinggal = 'Orang Tua';
        $pendaftaran->transportasi = 'Motor';
        $pendaftaran->anak_ke = '1';
        $pendaftaran->jumlah_saudara = '2';
        $pendaftaran->no_kk = '3200000000000000';
        $pendaftaran->nama_ayah = 'Nama Ayah';
        $pendaftaran->nama_ibu = 'Nama Ibu';
        $pendaftaran->pekerjaan_ayah = 'Wiraswasta';
        $pendaftaran->pekerjaan_ibu = 'Ibu Rumah Tangga';
        $pendaftaran->pendidikan_ayah = 'S1';
        $pendaftaran->pendidikan_ibu = 'S1';
        $pendaftaran->penghasilan_ayah = '3000000-5000000';
        $pendaftaran->penghasilan_ibu = 'Kurang dari 1000000';
        $pendaftaran->no_hp_ortu = '081234567891';
        $pendaftaran->nama_wali = '';
        $pendaftaran->hubungan_wali = '';
        $pendaftaran->pekerjaan_wali = '';
        $pendaftaran->no_hp_wali = '';
        $pendaftaran->nama_sekolah = 'SMP Negeri 1 Mranggen';
        $pendaftaran->alamat_sekolah = 'Jl. Sekolah No. 123';
        $pendaftaran->jenis_sekolah = 'Negeri';
        $pendaftaran->tahun_lulus = '2023';
        $pendaftaran->no_ijazah = 'IJZ-123456';
        
        // Set session data
        $this->session->set_userdata('last_submission_success', true);
        $this->session->set_userdata('nomor_pendaftaran', $nomor_pendaftaran);
        
        // Set data untuk tampilan
        $data['title'] = 'Pendaftaran Berhasil';
        $data['pendaftaran'] = $pendaftaran;
        $data['success'] = true;
        $data['success_message'] = 'Pendaftaran berhasil disimpan! Nomor pendaftaran Anda adalah <strong>' . $nomor_pendaftaran . '</strong>';
        
        // Load view halaman sukses
        $this->load->view('ppdb/pendaftaran_sukses', $data);
    }
    
    /**
     * Fungsi untuk menguji notifikasi sukses dengan AJAX
     */
    public function test_success_ajax() {
        // Generate nomor pendaftaran untuk testing
        $this->load->model('ppdb_model');
        $nomor_pendaftaran = $this->ppdb_model->generate_nomor_pendaftaran();
        
        // Set session data to use later
        $this->session->set_userdata('last_submission_success', true);
        $this->session->set_userdata('nomor_pendaftaran', $nomor_pendaftaran);
        
        // Get absolute base URL
        $base_url = rtrim(base_url(), '/');
        if (substr($base_url, -9) == 'index.php') {
            $base_url = substr($base_url, 0, -9);
        }
        
        // Create an absolute path that bypasses controller routing
        $absolute_path = $base_url . '/index.php/ppdb/pendaftaran_sukses/' . $nomor_pendaftaran;
        
        // Return JSON response with absolute URL to the success page
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'message' => 'Pendaftaran berhasil disimpan!',
            'nomor_pendaftaran' => $nomor_pendaftaran,
            // Force the redirect URL to use the pendaftaran_sukses path with absolute URL
            'redirect_url' => $absolute_path
        ]);
        exit;
    }
    
    /**
     * Halaman untuk menguji notifikasi
     */
    public function test_notifikasi() {
        $data['title'] = 'Test Notifikasi PPDB';
        $this->load->view('ppdb/test_notifikasi', $data);
    }
    
    /**
     * Direct link redirector
     * This handles the redirection for "Lihat Detail Pendaftaran" button
     */
    public function direct_link() {
        $nomor = $this->input->get('nomor');
        $data['nomor'] = $nomor;
        $this->load->view('ppdb/direct_link', $data);
    }
}