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
        $this->db->select('daftar_ulang.*, pendaftaran.nama_siswa, pendaftaran.nama_sekolah, pendaftaran.no_pendaftaran, pendaftaran.jenis_kelamin, pendaftaran.pilihan_program, pendaftaran.jalur_pendaftaran');
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

    public function get_laporan_harian($tanggal = null) {
        $this->db->select("COUNT(*) as total_pendaftar, 
                          SUM(CASE WHEN status_daftar_ulang = 'sudah' THEN 1 ELSE 0 END) as total_daftar_ulang,
                          SUM(CASE WHEN jenis_kelamin = 'laki-laki' THEN 1 ELSE 0 END) as total_laki,
                          SUM(CASE WHEN jenis_kelamin = 'perempuan' THEN 1 ELSE 0 END) as total_perempuan");
        $this->db->from('pendaftaran');
        return $this->db->get()->row();
    }

    /**
     * Rekap laporan harian: jumlah pendaftar & daftar ulang berdasarkan jenis kelamin, pilihan program, dan jalur pendaftaran
     */
    public function get_rekap_laporan_harian($tanggal = null) {
        // Filter tanggal jika diberikan
        if ($tanggal) {
            $this->db->where('DATE(pendaftaran.tanggal_pendaftaran)', $tanggal);
        }
        // Ambil semua pendaftar
        $pendaftar = $this->db->get('pendaftaran')->result();

        // Ambil semua daftar ulang (join ke pendaftaran)
        $this->db->select('pendaftaran.*');
        $this->db->join('pendaftaran', 'pendaftaran.id = daftar_ulang.pendaftaran_id');
        if ($tanggal) {
            $this->db->where('DATE(daftar_ulang.tanggal_daftar_ulang)', $tanggal);
        }
        $daftar_ulang = $this->db->get('daftar_ulang')->result();

        // Inisialisasi struktur rekap
        $rekap = [
            'jenis_kelamin' => [
                'laki-laki' => ['daftar' => 0, 'du' => 0],
                'perempuan' => ['daftar' => 0, 'du' => 0],
            ],
            'pilihan_program' => [
                'MIPA' => ['daftar' => 0, 'du' => 0],
                'IPS' => ['daftar' => 0, 'du' => 0],
                'Bahasa' => ['daftar' => 0, 'du' => 0],
                'AGM' => ['daftar' => 0, 'du' => 0],
                'Tahfidz' => ['daftar' => 0, 'du' => 0],
            ],
            'jalur_pendaftaran' => [
                'Reguler' => ['daftar' => 0, 'du' => 0],
                'Prestasi' => ['daftar' => 0, 'du' => 0],
                'Sosial' => ['daftar' => 0, 'du' => 0],
            ]
        ];

        // Mapping program dan jalur
        $map_program = [
            'mipa' => 'MIPA',
            'ips' => 'IPS',
            'bahasa' => 'Bahasa',
            'agm' => 'AGM',
            'tahfidz' => 'Tahfidz'
        ];
        $map_jalur = [
            'reguler' => 'Reguler',
            'reguler (umum)' => 'Reguler',
            'reguler_umum' => 'Reguler',
            'prestasi' => 'Prestasi',
            'sosial' => 'Sosial'
        ];

        // Rekap pendaftar
        foreach ($pendaftar as $p) {
            if (isset($rekap['jenis_kelamin'][strtolower($p->jenis_kelamin)])) {
                $rekap['jenis_kelamin'][strtolower($p->jenis_kelamin)]['daftar']++;
            }
            $prog = $map_program[strtolower($p->pilihan_program)] ?? null;
            if ($prog && isset($rekap['pilihan_program'][$prog])) {
                $rekap['pilihan_program'][$prog]['daftar']++;
            }
            $jalur = $map_jalur[strtolower($p->jalur_pendaftaran)] ?? null;
            if ($jalur && isset($rekap['jalur_pendaftaran'][$jalur])) {
                $rekap['jalur_pendaftaran'][$jalur]['daftar']++;
            }
        }
        // Rekap daftar ulang
        foreach ($daftar_ulang as $p) {
            if (isset($rekap['jenis_kelamin'][strtolower($p->jenis_kelamin)])) {
                $rekap['jenis_kelamin'][strtolower($p->jenis_kelamin)]['du']++;
            }
            $prog = $map_program[strtolower($p->pilihan_program)] ?? null;
            if ($prog && isset($rekap['pilihan_program'][$prog])) {
                $rekap['pilihan_program'][$prog]['du']++;
            }
            $jalur = $map_jalur[strtolower($p->jalur_pendaftaran)] ?? null;
            if ($jalur && isset($rekap['jalur_pendaftaran'][$jalur])) {
                $rekap['jalur_pendaftaran'][$jalur]['du']++;
            }
        }
        return $rekap;
    }

    public function get_all_peserta() {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('daftar_ulang')->result();
    }

    public function get_peserta_by_id($id) {
        $this->db->select('daftar_ulang.*, pendaftaran.nama_siswa, pendaftaran.pilihan_program');
        $this->db->from('daftar_ulang');
        $this->db->join('pendaftaran', 'pendaftaran.id = daftar_ulang.pendaftaran_id', 'left');
        $this->db->where('daftar_ulang.id', $id);
        return $this->db->get()->row();
    }

    public function update_peserta($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('daftar_ulang', $data);
    }

    public function delete_peserta($id) {
        $this->db->where('id', $id);
        return $this->db->delete('daftar_ulang');
    }

    public function delete_multiple_peserta($ids) {
        $this->db->where_in('id', $ids);
        return $this->db->delete('daftar_ulang');
    }
}