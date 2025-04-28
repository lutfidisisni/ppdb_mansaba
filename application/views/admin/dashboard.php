<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .shortcut-card {
            transition: box-shadow 0.2s;
        }
        .shortcut-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .shortcut-icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Dashboard Admin</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <a href="<?php echo site_url('admin/input_daftar_ulang'); ?>" class="text-decoration-none">
                    <div class="card shortcut-card text-center p-4">
                        <div class="shortcut-icon mb-2">📝</div>
                        <h5 class="card-title">Input Daftar Ulang</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo site_url('admin/data_pendaftar'); ?>" class="text-decoration-none">
                    <div class="card shortcut-card text-center p-4">
                        <div class="shortcut-icon mb-2">📋</div>
                        <h5 class="card-title">Data Pendaftar</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo site_url('admin/peserta_daftar_ulang'); ?>" class="text-decoration-none">
                    <div class="card shortcut-card text-center p-4">
                        <div class="shortcut-icon mb-2">✅</div>
                        <h5 class="card-title">Peserta Daftar Ulang</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo site_url('admin/belum_daftar_ulang'); ?>" class="text-decoration-none">
                    <div class="card shortcut-card text-center p-4">
                        <div class="shortcut-icon mb-2">⏳</div>
                        <h5 class="card-title">Belum Daftar Ulang</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo site_url('admin/laporan_harian'); ?>" class="text-decoration-none">
                    <div class="card shortcut-card text-center p-4">
                        <div class="shortcut-icon mb-2">📅</div>
                        <h5 class="card-title">Laporan Harian</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo site_url('admin/laporan_sekolah'); ?>" class="text-decoration-none">
                    <div class="card shortcut-card text-center p-4">
                        <div class="shortcut-icon mb-2">🏫</div>
                        <h5 class="card-title">Laporan Data Sekolah</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 