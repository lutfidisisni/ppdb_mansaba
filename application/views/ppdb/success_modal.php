<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .success-modal {
            max-width: 500px;
            width: 100%;
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .success-icon {
            margin: 30px auto 15px;
            width: 80px;
            height: 80px;
            background-color: rgba(25, 135, 84, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .success-icon i {
            color: #198754;
            font-size: 40px;
        }
        .modal-title {
            color: #333;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .registration-info {
            color: #555;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .registration-number {
            color: #198754;
            font-size: 20px;
            font-weight: 700;
            margin: 15px 0 30px;
        }
        .detail-btn {
            background-color: #198754;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 600;
            margin-bottom: 30px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .detail-btn:hover {
            background-color: #146c43;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="success-modal">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h1 class="modal-title">Pendaftaran Berhasil!</h1>
        <p class="registration-info">Data Anda telah berhasil disimpan. Nomor pendaftaran:</p>
        <div class="registration-number"><?= $nomor_pendaftaran ?></div>
        
        <a href="<?= base_url() ?>" class="detail-btn">
            <i class="fas fa-home me-2"></i> Kembali ke Halaman Utama
        </a>
        
        <!-- Pesan tambahan untuk pengguna -->
        <div style="margin-top: 15px;">
            <p style="color: #555; font-size: 14px;">
                Silahkan simpan nomor pendaftaran ini untuk keperluan selanjutnya
            </p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
