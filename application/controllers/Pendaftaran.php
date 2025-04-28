<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pendaftaran_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->lang->load('form_validation', 'indonesian');
    }

    public function index()
    {
        $data['title'] = 'Form Pendaftaran Siswa Baru';
        $this->load->view('pendaftaran_form', $data);
    }

    public function submit_pendaftaran()
    {
        // Atur pesan error dalam bahasa Indonesia
        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('regex_match', 'Format {field} tidak valid');

        // Aturan Validasi
        $this->form_validation->set_rules('rekomendasi', 'Pendaftaran (Siapa yang Mendaftarkan)', 'required');
        $this->form_validation->set_rules('jalur_pendaftaran', 'Jalur Pendaftaran', 'required');
        $this->form_validation->set_rules('pilihan_program', 'Pilihan Program (Peminatan)', 'required');
        
        // Data Peserta Didik
        $this->form_validation->set_rules('nama_siswa', 'Nama Lengkap', 'required|max_length[100]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|max_length[50]');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|regex_match[/^\d{4}-\d{2}-\d{2}$/]');
        $this->form_validation->set_rules('no_hp_siswa', 'No. HP / Whatsapp', 'required|max_length[20]');
        
        // Data Alamat
        $this->form_validation->set_rules('tinggal', 'Status Tinggal', 'required');
        $this->form_validation->set_rules('dukuh', 'Dukuh / Jalan', 'required|max_length[100]');
        $this->form_validation->set_rules('desa', 'Desa', 'required|max_length[50]');
        $this->form_validation->set_rules('rt', 'RT', 'required|max_length[5]');
        $this->form_validation->set_rules('rw', 'RW', 'required|max_length[5]');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|max_length[50]');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|max_length[50]');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|max_length[50]');
        
        // Data Orang Tua
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required|max_length[100]');
        $this->form_validation->set_rules('pendidikan_ayah', 'Pendidikan Ayah', 'required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'required|max_length[50]');
        $this->form_validation->set_rules('no_hp_ayah', 'No. HP Ayah', 'required|max_length[20]');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required|max_length[100]');
        $this->form_validation->set_rules('pendidikan_ibu', 'Pendidikan Ibu', 'required');
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'required|max_length[50]');
        $this->form_validation->set_rules('no_hp_ibu', 'No. HP Ibu', 'required|max_length[20]');
        $this->form_validation->set_rules('alamat_ortu', 'Alamat Orang Tua', 'required');
        $this->form_validation->set_rules('saudara_sekolah', 'Saudara Sekolah', 'required');
        
        // Data Wali (tidak wajib)
        $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'max_length[100]');
        $this->form_validation->set_rules('hubungan_wali', 'Hubungan dengan Wali', 'max_length[50]');
        $this->form_validation->set_rules('pendidikan_wali', 'Pendidikan Wali', 'max_length[20]');
        $this->form_validation->set_rules('pekerjaan_wali', 'Pekerjaan Wali', 'max_length[50]');
        $this->form_validation->set_rules('no_hp_wali', 'No. HP Wali', 'max_length[20]');
        $this->form_validation->set_rules('alamat_wali', 'Alamat Wali', '');
        
        // Sekolah Asal
        $this->form_validation->set_rules('nama_sekolah', 'Nama SMP/MTs', 'required|max_length[100]');
        $this->form_validation->set_rules('alamat_sekolah', 'Alamat SMP/MTs', 'required');
        $this->form_validation->set_rules('nisn', 'NISN', 'max_length[20]');
        $this->form_validation->set_rules('piagam', 'Piagam/Sertifikat', '');
        $this->form_validation->set_rules('motivasi', 'Motivasi Mendaftar', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            // Jika validasi gagal, tampilkan kembali form dengan data yang sudah diisi
            $data['title'] = 'Form Pendaftaran Siswa Baru';
            $data['input'] = $this->input->post();
            $data['validation_errors'] = validation_errors('<div class="alert alert-danger">', '</div>');
            $this->load->view('pendaftaran_form', $data);
        }
        else
        {
            // Jika validasi berhasil, proses data
            log_message('debug', 'Controller: Data POST dari form: ' . json_encode($_POST));
            
            $data_pendaftaran = array(
                // Rekomendasi & Jalur Pendaftaran
                'rekomendasi' => $this->input->post('rekomendasi'),
                'jalur_pendaftaran' => $this->input->post('jalur_pendaftaran'),
                'pilihan_program' => $this->input->post('pilihan_program'),
                
                // Data Peserta Didik
                'nama_siswa' => $this->input->post('nama_siswa'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'tempat_tanggal_lahir' => $this->input->post('tempat_tanggal_lahir'),
                'no_hp_siswa' => $this->input->post('no_hp_siswa'),
                
                // Data Alamat
                'tinggal' => $this->input->post('tinggal'),
                'tinggal_lainnya' => $this->input->post('tinggal_lainnya'),
                'dukuh' => $this->input->post('dukuh'),
                'desa' => $this->input->post('desa'),
                'rt' => $this->input->post('rt'),
                'rw' => $this->input->post('rw'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kabupaten' => $this->input->post('kabupaten'),
                'provinsi' => $this->input->post('provinsi'),
                'alamat_lengkap' => $this->input->post('alamat_lengkap'),
                
                // Data Orang Tua
                'nama_ayah' => $this->input->post('nama_ayah'),
                'pendidikan_ayah' => $this->input->post('pendidikan_ayah'),
                'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
                'no_hp_ayah' => $this->input->post('no_hp_ayah'),
                'nama_ibu' => $this->input->post('nama_ibu'),
                'pendidikan_ibu' => $this->input->post('pendidikan_ibu'),
                'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
                'no_hp_ibu' => $this->input->post('no_hp_ibu'),
                'alamat_ortu' => $this->input->post('alamat_ortu'),
                'saudara_sekolah' => $this->input->post('saudara_sekolah'),
                
                // Data Wali
                'nama_wali' => $this->input->post('nama_wali'),
                'hubungan_wali' => $this->input->post('hubungan_wali'),
                'pendidikan_wali' => $this->input->post('pendidikan_wali'),
                'pekerjaan_wali' => $this->input->post('pekerjaan_wali'),
                'no_hp_wali' => $this->input->post('no_hp_wali'),
                'alamat_wali' => $this->input->post('alamat_wali'),
                
                // Sekolah Asal
                'nama_sekolah' => $this->input->post('nama_sekolah'),
                'alamat_sekolah' => $this->input->post('alamat_sekolah'),
                'nisn' => $this->input->post('nisn'),
                'piagam' => $this->input->post('piagam'),
                'motivasi' => $this->input->post('motivasi'),
                
                // Tambahan
                'tanggal_daftar' => date('Y-m-d H:i:s')
                // Kolom 'status' dihapus karena sudah tidak digunakan
            );

            log_message('debug', 'Controller: Data yang akan dikirim ke model: ' . json_encode($data_pendaftaran));

            // Simpan data dan dapatkan hasilnya
            $result = $this->Pendaftaran_model->simpan_pendaftaran($data_pendaftaran);
            
            if ($result && $result['status'])
            {
                // Jika berhasil disimpan
                $data['title'] = 'Pendaftaran Berhasil';
                $data['nama_siswa'] = $this->input->post('nama_siswa');
                $data['no_pendaftaran'] = $result['no_pendaftaran'];
                $this->load->view('pendaftaran_berhasil', $data);
            }
            else
            {
                log_message('error', 'Controller: Gagal menyimpan data pendaftaran. Error database: ' . json_encode($this->db->error()));
                $data['title'] = 'Pendaftaran Gagal';
                $data['error'] = 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.';
                $data['input'] = $this->input->post();
                $this->load->view('pendaftaran_form', $data);
            }
        }
    }
}