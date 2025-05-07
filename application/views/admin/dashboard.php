<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%);
        }
        .dashboard-title {
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: #1976d2;
            margin-bottom: 32px;
            text-shadow: 0 2px 8px #1976d233;
        }
        .shortcut-card {
            background: rgba(255,255,255,0.85);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(25,118,210,0.08);
            border: 1px solid #e3f2fd;
            transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
            backdrop-filter: blur(2px);
            height: 100%;
        }
        .shortcut-card:hover {
            box-shadow: 0 8px 32px rgba(25,118,210,0.18);
            background: #e3f2fd;
            transform: translateY(-4px) scale(1.03);
        }
        .shortcut-icon {
            font-size: 3.2rem;
            color: #1976d2;
            margin-bottom: 10px;
            filter: drop-shadow(0 2px 8px #1976d233);
        }
        .shortcut-label {
            font-size: 1.15rem;
            font-weight: 600;
            color: #1976d2;
            letter-spacing: 0.5px;
        }
        /* Responsive Styles */
        @media (max-width: 1199px) {
            .dashboard-title {
                font-size: 1.8rem;
                margin-bottom: 28px;
            }
            .shortcut-icon {
                font-size: 2.8rem;
            }
            .shortcut-label {
                font-size: 1.1rem;
            }
        }
        @media (max-width: 991px) {
            .dashboard-title {
                font-size: 1.6rem;
                margin-bottom: 24px;
            }
            .shortcut-icon {
                font-size: 2.4rem;
            }
            .shortcut-label {
                font-size: 1rem;
            }
        }
        @media (max-width: 767px) {
            .dashboard-title {
                font-size: 1.4rem;
                margin-bottom: 20px;
            }
            .shortcut-icon {
                font-size: 2.1rem;
            }
            .shortcut-label {
                font-size: 0.95rem;
            }
            .shortcut-card {
                padding: 16px !important;
            }
        }
        @media (max-width: 575px) {
            .dashboard-title {
                font-size: 1.2rem;
                margin-bottom: 16px;
            }
            .shortcut-icon {
                font-size: 1.8rem;
            }
            .shortcut-label {
                font-size: 0.9rem;
            }
            .shortcut-card {
                padding: 12px !important;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid py-5">
        <div class="row" style="margin-left: 250px;">
            <div class="col-auto sidebar-container p-0 position-fixed" style="width: 250px; z-index: 1000;">
                <?php $this->load->view('admin/_sidebar'); ?>
            </div>
            <div class="col p-4">
                <div class="dashboard-title text-center mb-5">Dashboard Admin</div>
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="<?php echo site_url('admin/input_daftar_ulang'); ?>" class="text-decoration-none">
                            <div class="card shortcut-card text-center p-4">
                                <div class="shortcut-icon"><i class="bi bi-pencil-square"></i></div>
                                <div class="shortcut-label">Input Daftar Ulang</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="<?php echo site_url('admin/data_pendaftar'); ?>" class="text-decoration-none">
                            <div class="card shortcut-card text-center p-4">
                                <div class="shortcut-icon"><i class="bi bi-people"></i></div>
                                <div class="shortcut-label">Data Pendaftar</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="<?php echo site_url('admin/peserta_daftar_ulang'); ?>" class="text-decoration-none">
                            <div class="card shortcut-card text-center p-4">
                                <div class="shortcut-icon"><i class="bi bi-check-circle"></i></div>
                                <div class="shortcut-label">Peserta Daftar Ulang</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="<?php echo site_url('admin/belum_daftar_ulang'); ?>" class="text-decoration-none">
                            <div class="card shortcut-card text-center p-4">
                                <div class="shortcut-icon"><i class="bi bi-clock"></i></div>
                                <div class="shortcut-label">Belum Daftar Ulang</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="<?php echo site_url('admin/laporan_sekolah'); ?>" class="text-decoration-none">
                            <div class="card shortcut-card text-center p-4">
                                <div class="shortcut-icon"><i class="bi bi-building"></i></div>
                                <div class="shortcut-label">Laporan Data Sekolah</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="<?php echo site_url('admin/rekapitulasi_ppdb'); ?>" class="text-decoration-none">
                            <div class="card shortcut-card text-center p-4">
                                <div class="shortcut-icon"><i class="bi bi-bar-chart-line"></i></div>
                                <div class="shortcut-label">Rekapitulasi PPDB</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>