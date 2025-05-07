<?php
/**
 * Direct redirect script for testing
 * This file redirects to the correct page with a test registration number
 */

// Fungsi untuk generate nomor pendaftaran test
function generate_test_nomor() {
    return 'TEST'.rand(1000, 9999);
}

// Generate nomor pendaftaran untuk testing
$nomor_pendaftaran = isset($_GET['nomor']) ? $_GET['nomor'] : generate_test_nomor();

// Simpan nomor pendaftaran sementara di cookie untuk diperlukan oleh controller
setcookie('temp_registration_number', $nomor_pendaftaran, time() + 300, '/');

// Log untuk debugging
file_put_contents('redirect_log.txt', date('Y-m-d H:i:s') . " - Redirecting to pendaftaran_sukses with nomor: {$nomor_pendaftaran}\n", FILE_APPEND);

// Redirect langsung ke controller pendaftaran_sukses dengan nomor pendaftaran
header("Location: http://localhost/ppdb_manu/index.php/ppdb/pendaftaran_sukses/{$nomor_pendaftaran}");
exit;
$CI->load->view('ppdb/pendaftaran_sukses', $data);
?>
