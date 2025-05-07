<?php
class Migration_Create_pengaturan_kop extends CI_Migration {
    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'path' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('pengaturan_kop');
        
        // Insert default data
        $this->db->insert('pengaturan_kop', array('path' => 'assets/img/kop_ma_nu.jpg'));
    }

    public function down() {
        $this->dbforge->drop_table('pengaturan_kop');
    }
}