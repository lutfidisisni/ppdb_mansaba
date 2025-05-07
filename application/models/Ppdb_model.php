<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppdb_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function generate_nomor_pendaftaran() {
        // Get the school year from settings (pengaturan table)
        $tahun_pelajaran = '2526'; // Default value
        
        // Try to get from settings table if it exists
        try {
            $this->db->select('nilai');
            $this->db->from('pengaturan');
            $this->db->where('nama', 'tahun_pelajaran');
            $query_tahun = $this->db->get();
            
            if ($query_tahun->num_rows() > 0) {
                $tahun_pelajaran = $query_tahun->row()->nilai;
            } else {
                // Default if setting not found
                $tahun_pelajaran = '2526';
            }
        } catch (Exception $e) {
            log_message('error', 'Error accessing pengaturan table: ' . $e->getMessage());
            // Use default value defined above
        }
        
        // Get last registration number for sequential numbering
        $this->db->select('no_pendaftaran');
        $this->db->from('pendaftaran');
        $this->db->like('no_pendaftaran', 'A-' . $tahun_pelajaran, 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            // Extract the sequential number from format A-2526/XXXX
            $parts = explode('/', $row->no_pendaftaran);
            if (count($parts) == 2 && is_numeric($parts[1])) {
                $last_number = intval($parts[1]);
                $next_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $next_number = '0001';
            }
        } else {
            $next_number = '0001';
        }
        
        // Format: A-2526/0001
        return 'A-' . $tahun_pelajaran . '/' . $next_number;
    }
    
    public function save_pendaftaran($data) {
        // Debug log
        log_message('debug', '=== Starting save_pendaftaran ===');
        log_message('debug', 'Database config: ' . print_r($this->db->db_debug, true));
        log_message('debug', 'Database hostname: ' . $this->db->hostname);
        log_message('debug', 'Database username: ' . $this->db->username);
        log_message('debug', 'Database database: ' . $this->db->database);
        log_message('debug', 'Data to save: ' . print_r($data, true));
        
        // Remove fields that don't exist in the database table
        if (isset($data['tahun_pelajaran'])) {
            unset($data['tahun_pelajaran']);
        }
        if (isset($data['gelombang'])) {
            unset($data['gelombang']);
        }
        
        $result = $this->db->insert('pendaftaran', $data);
        
        if (!$result) {
            $error = $this->db->error();
            log_message('error', 'Database Error: ' . print_r($error, true));
            log_message('error', 'Last Query: ' . $this->db->last_query());
        } else {
            log_message('debug', 'Data inserted successfully with ID: ' . $this->db->insert_id());
        }
        
        return $result;
    }
    
    public function get_pendaftaran_by_nomor($nomor_pendaftaran) {
        $this->db->where('no_pendaftaran', $nomor_pendaftaran);
        $query = $this->db->get('pendaftaran');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return false;
    }
}