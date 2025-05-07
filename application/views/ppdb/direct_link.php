<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Detail</title>
    <script>
        // This script will execute immediately when the page loads
        window.onload = function() {
            // Extract nomor_pendaftaran from query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const nomor = urlParams.get('nomor');
            
            if (nomor) {
                // Redirect directly to the success page
                window.location.href = '<?= base_url('ppdb/pendaftaran_sukses/') ?>' + nomor;
            } else {
                // If no registration number is provided, redirect to form
                window.location.href = '<?= base_url('ppdb/form_pendaftaran') ?>';
            }
        }
    </script>
</head>
<body>
    <p>Redirecting to detail page...</p>
</body>
</html>
