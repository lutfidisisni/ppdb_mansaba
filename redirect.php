<?php
/**
 * Direct redirection script for PPDB Manu
 * This file handles direct redirection to the success page
 */

// Get the registration number from the URL
$nomor = isset($_GET['nomor']) ? $_GET['nomor'] : '';

if (empty($nomor)) {
    // Redirect to form if no registration number
    header('Location: /ppdb_manu/index.php/ppdb/form_pendaftaran');
    exit;
} else {
    // Direct redirection to the success page with registration number
    header('Location: /ppdb_manu/index.php/ppdb/pendaftaran_sukses/' . $nomor);
    exit;
}
