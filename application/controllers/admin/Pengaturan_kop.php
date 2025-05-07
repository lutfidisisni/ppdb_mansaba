<?php
class Pengaturan_kop extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('pengaturan_kop_model');
        $this->load->library('upload');
        $this->load->helper('file');
    }

    public function index() {
        $data['kop'] = $this->pengaturan_kop_model->get_kop();
        $this->load->view('admin/pengaturan_kop', $data);
    }

    public function update() {
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = 'kop_sekolah';
        $config['overwrite'] = true;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('kop_gambar')) {
            $upload_data = $this->upload->data();
            $data = array('path' => 'assets/img/'.$upload_data['file_name']);
            $this->pengaturan_kop_model->update_kop($data);
            $this->session->set_flashdata('success', 'Kop sekolah berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        redirect('admin/pengaturan_kop');
    }
}