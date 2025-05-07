<?php
/**
 * Direct redirect script
 * This bypasses all CodeIgniter routing issues
 */

try {
    // Buat folder logs jika belum ada
    if (!file_exists('logs')) {
        mkdir('logs', 0755, true);
    }
    
    // Log untuk debugging dengan lebih aman
    $log_file = 'logs/redirect_'.date('Y-m-d').'.log';
    
    // Ambil parameter nomor dari GET, POST, atau REQUEST
    $nomor = '';
    
    // 1. Cek parameter GET
    if (isset($_GET['nomor']) && !empty($_GET['nomor'])) {
        $nomor = $_GET['nomor'];
    } 
    // 2. Cek parameter POST
    else if (isset($_POST['nomor']) && !empty($_POST['nomor'])) {
        $nomor = $_POST['nomor'];
    }
    // 3. Cek parameter REQUEST
    else if (isset($_REQUEST['nomor']) && !empty($_REQUEST['nomor'])) {
        $nomor = $_REQUEST['nomor'];
    }
    
    // Log semua parameter yang diterima
    error_log("---- " . date('Y-m-d H:i:s') . " ----\n", 3, $log_file);
    error_log("GET params: " . print_r($_GET, true) . "\n", 3, $log_file);
    error_log("Detected nomor: " . $nomor . "\n", 3, $log_file);
    
    // Tentukan base URL dinamis berdasarkan server
    $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url .= "://" . $_SERVER['HTTP_HOST'];
    
    // Detect folder
    $folder = dirname($_SERVER['SCRIPT_NAME']);
    $folder = $folder == '/' ? '' : $folder;
    
    if (empty($nomor)) {
        // Jika tidak ada nomor pendaftaran, redirect ke halaman utama
        $form_url = $base_url . $folder . "/index.php/";
        error_log("No nomor - Redirecting to: {$form_url}\n", 3, $log_file);
        header("Location: {$form_url}");
        exit;
    }
    
    // Redirect ke halaman sukses dengan nomor pendaftaran
    $target_url = $base_url . $folder . "/index.php/ppdb/pendaftaran_sukses/" . $nomor;
    error_log("Redirecting to: {$target_url}\n", 3, $log_file);
    
    // Set header untuk redirect yang lebih aman
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache"); 
    header("Location: {$target_url}", true, 302);
    exit;
    
} catch (Exception $e) {
    // Tangani error dengan menampilkan pesan
    echo "<html><body>";
    echo "<h3>Terjadi kesalahan dalam pengalihan halaman</h3>";
    echo "<p>Silakan <a href='/ppdb_manu/'>klik di sini</a> untuk kembali ke halaman utama.</p>";
    echo "</body></html>";
    exit;
}
?>
