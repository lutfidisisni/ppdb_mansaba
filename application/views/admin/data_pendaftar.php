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
        body { 
            background: #f8f9fa;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar-container { 
            min-height: 100vh;
            transition: all 0.3s;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .sidebar {
            transition: all 0.3s;
            height: 100vh;
            position: fixed;
            width: 250px;
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
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        .main-content.expanded {
            margin-left: 60px;
            width: calc(100% - 60px);
        }
        .card-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1976d2;
            text-shadow: 0 2px 8px #1976d233;
        }
        .table th {
            background-color: #e3f2fd !important;
            color: #1976d2;
            font-weight: 600;
            white-space: nowrap;
        }
        .table td {
            vertical-align: middle;
        }
        .btn-primary {
            background: #1976d2;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background: #1256a3;
            box-shadow: 0 4px 12px rgba(25,118,210,0.2);
        }
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #b6d4fe;
            padding: 0.375rem 0.75rem;
        }
        /* Responsive Styles */
        @media (max-width: 1199px) {
            .sidebar {
                width: 220px;
            }
            .main-content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }
            .main-content.expanded {
                margin-left: 60px;
                width: calc(100% - 60px);
            }
            .card-title {
                font-size: 1.6rem;
            }
            .table th, .table td {
                padding: 0.75rem;
            }
        }
        @media (max-width: 991px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
                width: calc(100% - 200px);
            }
            .main-content.expanded {
                margin-left: 60px;
                width: calc(100% - 60px);
            }
            .card-title {
                font-size: 1.4rem;
            }
            .table th, .table td {
                font-size: 0.9rem;
                padding: 0.5rem;
            }
            .dataTables_wrapper .dataTables_length select {
                padding: 0.25rem 1.5rem 0.25rem 0.5rem;
            }
        }
        @media (max-width: 767px) {
            .sidebar {
                width: 60px;
            }
            .main-content {
                margin-left: 60px;
                width: calc(100% - 60px);
            }
            .sidebar .nav-link span,
            .sidebar .fs-4 {
                display: none;
            }
            .sidebar .nav-link {
                text-align: center;
            }
            .sidebar .nav-link i {
                margin-right: 0;
            }
            .card-title {
                font-size: 1.2rem;
            }
            .table th, .table td {
                font-size: 0.85rem;
                padding: 0.4rem;
            }
            .btn-primary {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
            }
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            .dataTables_wrapper .dataTables_filter {
                margin-top: 0.5rem;
            }
            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                margin-left: 0;
            }
        }
        @media (max-width: 575px) {
            .card-title {
                font-size: 1.1rem;
            }
            .table th, .table td {
                font-size: 0.8rem;
                padding: 0.3rem;
            }
            .btn-primary {
                width: 100%;
                margin-top: 0.25rem;
            }
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                text-align: left !important;
            }
            .dataTables_wrapper .dataTables_info {
                padding-top: 0.5rem;
            }
            .dataTables_wrapper .dataTables_paginate {
                padding-top: 0.5rem;
            }
        }
        /* Custom scrollbar for table */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: #1976d2;
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #1256a3;
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
                        <h2 class="mb-0 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Data Pendaftar</h2>
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
                <div class="card shadow-sm border-0" style="background:rgba(255,255,255,0.92); border-radius:18px;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle" id="tablePendaftar" style="border-radius:12px; overflow:hidden;">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Pendaftaran</th>
                                        <th>Nama Siswa</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jalur Pendaftaran</th>
                                        <th>Sekolah Asal</th>
                                        <th>Alamat Lengkap</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($pendaftar as $p): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $p->no_pendaftaran; ?></td>
                                        <td><?php echo $p->nama_siswa; ?></td>
                                        <td><?php echo $p->jenis_kelamin; ?></td>
                                        <td><?php echo $p->jalur_pendaftaran; ?></td>
                                        <td><?php echo $p->nama_sekolah; ?></td>
                                        <td><?php echo $p->alamat_lengkap; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($p->tanggal_pendaftaran)); ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/cetak_formulir/' . $p->id); ?>" class="btn btn-sm btn-primary d-flex align-items-center gap-1" target="_blank" style="transition:box-shadow 0.2s,transform 0.2s;">
                                                <i class="bi bi-printer"></i> Cetak Formulir
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablePendaftar').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                }
            });

            // Sidebar toggle functionality
            $('#sidebarToggle').click(function() {
                $('.sidebar').toggleClass('collapsed');
                $('.main-content').toggleClass('expanded');
            });

            // Handle window resize
            $(window).resize(function() {
                if ($(window).width() <= 767) {
                    $('.sidebar').addClass('collapsed');
                    $('.main-content').addClass('expanded');
                }
            });
        });
    </script>
</body>
</html> 