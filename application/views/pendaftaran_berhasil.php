<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .success-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
            text-align: center;
            border-top: 5px solid #28a745;
        }
        .success-icon {
            color: #28a745;
            font-size: 72px;
            margin-bottom: 20px;
        }
        .registration-number {
            background: #f8f9fa;
            border-left: 4px solid #6c757d;
            padding: 15px;
            margin: 25px 0;
            text-align: center;
        }
        .btn-back {
            background: #28a745;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Pendaftaran Berhasil!</h1>
        <p class="lead">Terima kasih <strong><?php echo htmlspecialchars($nama_siswa); ?></strong> telah mendaftar.</p>
        
        <div class="registration-number">
            <h4><i class="fas fa-id-card"></i> Nomor Pendaftaran</h4>
            <p class="h3 text-primary"><?php echo htmlspecialchars($no_pendaftaran); ?></p>
            <small class="text-muted">Simpan nomor ini untuk keperluan verifikasi</small>
        </div>
        
        <p>Data pendaftaran Anda telah kami terima. Panitia akan menghubungi Anda melalui kontak yang telah dicantumkan.</p>
        
        <a href="<?php echo base_url('pendaftaran'); ?>" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>