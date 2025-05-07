<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This file is a simple redirect to fix the "Lihat Detail Pendaftaran" issue
$nomor = isset($_GET['nomor']) ? $_GET['nomor'] : '';

if (!empty($nomor)) {
    // Redirect to the success page with the registration number
    header('Location: ' . '/ppdb_manu/index.php/ppdb/pendaftaran_sukses/' . $nomor);
    exit;
} else {
    // If no registration number is provided, redirect to the form
    header('Location: ' . '/ppdb_manu/index.php/ppdb/form_pendaftaran');
    exit;
}
?>
