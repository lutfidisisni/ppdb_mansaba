<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function laporan_rekomendasi_guru() {
        $data['title'] = 'Laporan Rekomendasi Guru';
        $this->load->view('admin/_header', $data);
        $this->load->view('admin/laporan_rekomendasi_guru');
        $this->load->view('admin/_footer');
    }

    // Add other controller methods as needed
}