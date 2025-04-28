<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Pendaftaran_model');
        $this->load->model('Daftar_ulang_model');
        // Add authentication check here
    }

    public function index() {
        $data['title'] = 'Dashboard Admin';
        $this->load->view('admin/dashboard', $data);
    }

    public function input_daftar_ulang() {
        $data['title'] = 'Input Daftar Ulang';
        $data['pendaftar'] = $this->Pendaftaran_model->get_all_pendaftar();
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

    public function laporan_harian() {
        $data['title'] = 'Laporan Harian';
        $data['tanggal'] = $this->input->get('tanggal') ? $this->input->get('tanggal') : date('Y-m-d');
        $data['laporan'] = $this->Daftar_ulang_model->get_laporan_harian($data['tanggal']);
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
        $data['pendaftar'] = $this->Pendaftaran_model->get_pendaftaran_by_id($data['daftar_ulang']->pendaftaran_id);
        $this->load->view('admin/cetak_bukti_daftar_ulang', $data);
    }
} 