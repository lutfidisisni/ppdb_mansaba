<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Landing controller
 * 
 * Controller untuk menampilkan halaman landing sebagai halaman utama
 */
class Landing extends CI_Controller {

    /**
     * Index method untuk halaman utama
     */
    public function index() {
        // Menampilkan landing.html langsung dari root folder
        $landing_path = FCPATH . 'landing.html';
        
        if (file_exists($landing_path)) {
            $content = file_get_contents($landing_path);
            echo $content;
        } else {
            // Fallback ke controller ppdb jika landing.html tidak ditemukan
            redirect('ppdb');
        }
    }
}
