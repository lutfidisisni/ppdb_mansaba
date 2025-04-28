<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_ulang_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function save($data) {
        return $this->db->insert('daftar_ulang', $data);
    }

    public function get_all_peserta_daftar_ulang() {
        $this->db->select('daftar_ulang.*, pendaftaran.nama_siswa, pendaftaran.nama_sekolah, pendaftaran.no_pendaftaran');
        $this->db->from('daftar_ulang');
        $this->db->join('pendaftaran', 'pendaftaran.id = daftar_ulang.pendaftaran_id');
        $this->db->order_by('daftar_ulang.tanggal_daftar_ulang', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('daftar_ulang')->row();
    }

    public function get_last_no_daftar_ulang() {
        $this->db->select('no_daftar_ulang');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('daftar_ulang')->row();
        return $result ? $result->no_daftar_ulang : null;
    }

    public function get_laporan_harian($tanggal) {
        $this->db->select('COUNT(*) as total_pendaftar, 
                          SUM(CASE WHEN status_daftar_ulang = "sudah" THEN 1 ELSE 0 END) as total_daftar_ulang,
                          SUM(CASE WHEN pilihan_program = "agm" THEN 1 ELSE 0 END) as total_agm,
                          SUM(CASE WHEN pilihan_program = "ips" THEN 1 ELSE 0 END) as total_ips,
                          SUM(CASE WHEN pilihan_program = "ipa" THEN 1 ELSE 0 END) as total_ipa,
                          SUM(CASE WHEN jenis_kelamin = "laki-laki" THEN 1 ELSE 0 END) as total_laki,
                          SUM(CASE WHEN jenis_kelamin = "perempuan" THEN 1 ELSE 0 END) as total_perempuan');
        $this->db->from('pendaftaran');
        $this->db->where('DATE(tanggal_pendaftaran)', $tanggal);
        return $this->db->get()->row();
    }
} 