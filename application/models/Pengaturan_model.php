<?php
class Pengaturan_model extends CI_Model {
    public function update_settings($data) {
        $this->db->update('pengaturan', $data); 
    }
    
    public function get_settings() {
        return $this->db->get('pengaturan')->row_array();
    }
}