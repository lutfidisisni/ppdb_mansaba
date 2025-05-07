<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function login() {
        $this->load->view('admin/login');
    }

    public function do_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Cek admin (MD5)
        $admin = $this->db->get_where('admin', [
            'username' => $username,
            'password' => md5($password)
        ])->row();
        if ($admin) {
            $this->session->set_userdata('admin_logged_in', true);
            $this->session->set_userdata('role', 'admin');
            redirect('admin');
            return;
        }
        // Cek petugas (password_hash)
        $petugas = $this->db->get_where('petugas', ['username' => $username])->row();
        if ($petugas && password_verify($password, $petugas->password)) {
            $this->session->set_userdata('admin_logged_in', true);
            $this->session->set_userdata('role', 'petugas');
            $this->session->set_userdata('nama_lengkap', $petugas->nama_lengkap);
            redirect('admin');
            return;
        }
        $this->session->set_flashdata('error', 'Username atau password salah');
        redirect('auth/login');
    }

    public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        redirect('auth/login');
    }
} 