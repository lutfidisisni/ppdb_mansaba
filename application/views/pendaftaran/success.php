<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - <?php echo $this->config->item('app_name'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .success-card {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background: white;
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .registration-number {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
            margin: 20px 0;
            padding: 10px;
            background: #e8f5e9;
            border-radius: 5px;
        }
        .info-label {
            font-weight: bold;
            color: #495057;
        }
        .info-value {
            color: #212529;
        }
        .action-buttons {
            margin-top: 30px;
        }
        .action-buttons .btn {
            margin: 0 10px;
        }
        @media print {
            .action-buttons {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-card">
            <div class="text-center">
                <i class="fas fa-check-circle success-icon"></i>
                <h2 class="mb-4">Pendaftaran Berhasil!</h2>
                <div class="registration-number">
                    Nomor Pendaftaran: <?php echo $pendaftaran['no_pendaftaran']; ?>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h4 class="mb-3">Data Siswa</h4>
                    <div class="mb-2">
                        <span class="info-label">Nama Lengkap:</span>
                        <span class="info-value"><?php echo $pendaftaran['nama_lengkap']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="info-label">Tempat Lahir:</span>
                        <span class="info-value"><?php echo $pendaftaran['tempat_lahir']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="info-label">Tanggal Lahir:</span>
                        <span class="info-value"><?php echo date('d-m-Y', strtotime($pendaftaran['tanggal_lahir'])); ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="info-label">Jenis Kelamin:</span>
                        <span class="info-value"><?php echo $pendaftaran['jenis_kelamin']; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">Data Orang Tua</h4>
                    <div class="mb-2">
                        <span class="info-label">Nama Ayah:</span>
                        <span class="info-value"><?php echo $pendaftaran['nama_ayah']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="info-label">Nama Ibu:</span>
                        <span class="info-value"><?php echo $pendaftaran['nama_ibu']; ?></span>
                    </div>
                    <div class="mb-2">
                        <span class="info-label">No. HP:</span>
                        <span class="info-value"><?php echo $pendaftaran['no_hp']; ?></span>
                    </div>
                </div>
            </div>

            <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle"></i> Silakan simpan nomor pendaftaran Anda. Nomor ini akan digunakan untuk melacak status pendaftaran.
            </div>

            <div class="text-center action-buttons">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak Bukti Pendaftaran
                </button>
                <a href="<?php echo site_url('pendaftaran'); ?>" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 