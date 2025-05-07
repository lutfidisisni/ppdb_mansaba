<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar-container { min-height: 100vh; }
        .sidebar {
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            width: 60px !important;
        }
        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .fs-4 {
            display: none;
        }
        .sidebar.collapsed .nav-link {
            text-align: center;
        }
        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }
        .main-content {
            transition: all 0.3s;
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4" style="background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%); min-height: 100vh;">
        <div class="row">
            <div class="col-auto sidebar-container p-0">
                <?php $this->load->view('admin/_sidebar'); ?>
            </div>
            <div class="col p-4 main-content">
                <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.95); border-radius:18px;">
                    <div class="card-body p-4">
                        <h2 class="mb-0 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Laporan Harian</h2>
                    </div>
                </div>
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        <div><?php echo $this->session->flashdata('success'); ?></div>
                    </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <div><?php echo $this->session->flashdata('error'); ?></div>
                    </div>
                <?php endif; ?>
                <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.92); border-radius:18px;">
                    <div class="card-body">
                        <form action="<?php echo site_url('admin/laporan_harian'); ?>" method="get">
                            <div class="input-group">
                                <input type="date" class="form-control" name="tanggal" value="<?php echo $tanggal; ?>">
                                <button class="btn btn-primary d-flex align-items-center gap-2" type="submit" style="transition:box-shadow 0.2s,transform 0.2s;">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card text-white bg-primary mb-3 shadow-sm border-0" style="border-radius:18px;">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-people"></i> Jumlah Pendaftar</h5>
                                <p class="card-text display-6"><?php echo isset($laporan->total_pendaftar) ? $laporan->total_pendaftar : 0; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-white bg-success mb-3 shadow-sm border-0" style="border-radius:18px;">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-check-circle"></i> Jumlah Daftar Ulang</h5>
                                <p class="card-text display-6"><?php echo isset($laporan->total_daftar_ulang) ? $laporan->total_daftar_ulang : 0; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.92); border-radius:18px;">
                    <div class="card-body">
                        <h5 class="mb-3">Rekap Berdasarkan Jenis Kelamin</h5>
                        <table class="table table-bordered text-center">
                            <thead class="table-warning">
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <th>Pendaftar</th>
                                    <th>Daftar Ulang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rekap_harian['jenis_kelamin'] as $jk => $row): ?>
                                <tr>
                                    <td><?php echo $jk; ?></td>
                                    <td><?php echo $row['daftar']; ?></td>
                                    <td><?php echo $row['du']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.92); border-radius:18px;">
                    <div class="card-body">
                        <h5 class="mb-3">Rekap Berdasarkan Peminatan</h5>
                        <table class="table table-bordered text-center">
                            <thead class="table-info">
                                <tr>
                                    <th>Peminatan</th>
                                    <th>Pendaftar</th>
                                    <th>Daftar Ulang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rekap_harian['pilihan_program'] as $prog => $row): ?>
                                <tr>
                                    <td><?php echo $prog; ?></td>
                                    <td><?php echo $row['daftar']; ?></td>
                                    <td><?php echo $row['du']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.92); border-radius:18px;">
                    <div class="card-body">
                        <h5 class="mb-3">Rekap Berdasarkan Jalur Pendaftaran</h5>
                        <table class="table table-bordered text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>Jalur Pendaftaran</th>
                                    <th>Pendaftar</th>
                                    <th>Daftar Ulang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rekap_harian['jalur_pendaftaran'] as $jalur => $row): ?>
                                <tr>
                                    <td><?php echo $jalur; ?></td>
                                    <td><?php echo $row['daftar']; ?></td>
                                    <td><?php echo $row['du']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <footer class="mt-5 text-center text-muted small" style="opacity:0.7;">
                    &copy; <?php echo date('Y'); ?> PPDB MANU Admin. All rights reserved.
                </footer>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Sidebar toggle functionality
            $('#sidebarToggle').click(function() {
                $('.sidebar').toggleClass('collapsed');
                $('.main-content').toggleClass('col-auto');
            });
        });
    </script>
</body>
</html> 