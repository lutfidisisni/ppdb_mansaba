<?php

class AddRekomendasiGuruToPendaftaranTable extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('pendaftaran', [
            'rekomendasi_guru' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);
    }

    public function down() {
        $this->dbforge->drop_column('pendaftaran', 'rekomendasi_guru');
    }
}