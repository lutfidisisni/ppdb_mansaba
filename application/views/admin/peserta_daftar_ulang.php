<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
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
        .select-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        #deleteSelected {
            display: none;
        }
        #deleteSelected.show {
            display: inline-flex;
        }
        .table-responsive {
            overflow-x: auto;
            min-height: 400px;
            padding-bottom: 50px;
        }
        .dataTables_wrapper {
            padding: 1rem;
        }
        .dataTables_paginate {
            margin-top: 15px !important;
            float: right;
        }
        .dataTables_info {
            margin-top: 15px;
        }
        .dataTables_length {
            float: left;
            margin-bottom: 15px;
        }
        .dataTables_filter {
            float: right;
            margin-bottom: 15px;
        }
        .dataTables_wrapper .row:after {
            content: "";
            display: table;
            clear: both;
        }
        /* Tambahan style untuk tabel yang lebih menarik */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 0;
        }
        .table thead th {
            background-color: #f0f6ff;
            border-bottom: 2px solid #dee2e6;
            color: #2d3748;
            font-weight: 600;
            padding: 12px 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(247, 250, 255, 0.5);
        }
        .table tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }
        .table tbody tr:hover {
            background-color: #f0f6ff;
        }
        .table td {
            padding: 12px 8px;
            vertical-align: middle;
            font-size: 0.9rem;
            color: #4a5568;
            border-top: 1px solid #edf2f7;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #000;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-edit:hover {
            background-color: #ffb300;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-edit i {
            font-size: 0.9rem;
        }
        .card {
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        }
        .badge {
            padding: 6px 10px;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 4px;
        }
        .bg-success {
            background-color: #10b981 !important;
        }
        .bg-warning {
            background-color: #f59e0b !important;
        }
        .bg-danger {
            background-color: #ef4444 !important;
        }
        .btn-print {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
        }
        .btn-print:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .text-success {
            color: #10b981 !important;
        }
        .text-danger {
            color: #ef4444 !important;
        }
        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.25em;
            cursor: pointer;
            border-color: #d1d5db;
        }
        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        #deleteSelected {
            display: none;
            background-color: #ef4444;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            color: white;
            font-weight: 500;
        }
        #deleteSelected:hover {
            background-color: #dc2626;
        }
        #deleteSelected.show {
            display: inline-flex;
        }
        .bi-check-circle-fill, .bi-x-circle-fill {
            font-size: 1.2rem;
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
                        <h2 class="mb-0 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Peserta Daftar Ulang</h2>
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
                        <div class="mb-3">
                            <button id="deleteSelected" class="btn btn-danger d-inline-flex align-items-center gap-1">
                                <i class="bi bi-trash"></i> Hapus Data Terpilih
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="tablePeserta">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">
                                            <input type="checkbox" class="form-check-input" id="selectAll">
                                        </th>
                                        <th style="width: 50px">#</th>
                                        <th>No. Daftar Ulang</th>
                                        <th>Nama Siswa</th>
                                        <th>Berkas</th>
                                        <th>Ukuran Seragam</th>
                                        <th>OSIS</th>
                                        <th>Pramuka</th>
                                        <th>Batik</th>
                                        <th>Olahraga</th>
                                        <th>Status Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($peserta as $p): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input select-item" value="<?php echo $p->id; ?>">
                                        </td>
                                        <td class="text-center"><?php echo $no++; ?></td>
                                        <td><?php echo $p->no_daftar_ulang; ?></td>
                                        <td>
                                            <div style="font-weight: 500; color: #2d3748;">
                                                <?php echo $p->nama_siswa; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <?php
                                                $berkas = [];
                                                if($p->kk_asli) $berkas[] = 'KK';
                                                if($p->skl) $berkas[] = 'SKL';
                                                if($p->piagam) $berkas[] = 'Piagam';
                                                if($p->sktm) $berkas[] = 'SKTM';
                                                echo empty($berkas) ? '<span class="text-danger">Belum ada berkas</span>' : implode(', ', $berkas);
                                                ?>
                                            </div>
                                        </td>
                                        <td class="text-center"><?php echo $p->ukuran_seragam ?: '-'; ?></td>
                                        <td class="text-center">
                                            <i class="bi <?php echo $p->seragam_osis ? 'bi-check-circle-fill text-success' : 'bi-x-circle-fill text-danger'; ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="bi <?php echo $p->seragam_pramuka ? 'bi-check-circle-fill text-success' : 'bi-x-circle-fill text-danger'; ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="bi <?php echo $p->seragam_batik ? 'bi-check-circle-fill text-success' : 'bi-x-circle-fill text-danger'; ?>"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="bi <?php echo $p->seragam_olahraga ? 'bi-check-circle-fill text-success' : 'bi-x-circle-fill text-danger'; ?>"></i>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <?php if($p->bayar_daftar_ulang): ?>
                                                    <span class="text-success">
                                                        Rp <?php echo number_format($p->nominal_daftar_ulang, 0, ',', '.'); ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-danger">-</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button class="btn-edit" onclick="window.location.href='<?php echo site_url('admin/edit_peserta_daftar_ulang/' . $p->id); ?>'">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn-print" onclick="window.open('<?php echo site_url('admin/cetak_bukti_daftar_ulang/' . $p->id); ?>', '_blank')" title="Cetak Bukti">
                                                    <i class="bi bi-printer"></i>
                                                </button>
                                            </div>
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
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('#tablePeserta').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                },
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Semua']],
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                     "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-success mb-3',
                        text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                        exportOptions: {
                            columns: [2, 3, 4, 5, 6, 7, 8, 9, 10]
                        },
                        title: 'Data Peserta Daftar Ulang - ' + new Date().toLocaleDateString('id-ID')
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info mb-3 ms-2',
                        text: '<i class="bi bi-printer"></i> Cetak',
                        exportOptions: {
                            columns: [2, 3, 4, 5, 6, 7, 8, 9, 10]
                        },
                        title: 'Data Peserta Daftar Ulang',
                        customize: function(win) {
                            $(win.document.body).css('font-size', '10pt');
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ],
                responsive: true,
                ordering: true,
                columnDefs: [
                    { orderable: false, targets: [0, 11] },
                    { className: "text-center", targets: [0, 1, 6, 7, 8, 9] }
                ]
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

            // Select all functionality
            $('#selectAll').change(function() {
                $('.select-item').prop('checked', $(this).prop('checked'));
                updateDeleteButton();
            });

            // Individual checkbox change
            $(document).on('change', '.select-item', function() {
                updateDeleteButton();
                if (!$(this).prop('checked')) {
                    $('#selectAll').prop('checked', false);
                } else if ($('.select-item:checked').length === $('.select-item').length) {
                    $('#selectAll').prop('checked', true);
                }
            });

            // Update delete button visibility
            function updateDeleteButton() {
                const checkedCount = $('.select-item:checked').length;
                if (checkedCount > 0) {
                    $('#deleteSelected').addClass('show');
                } else {
                    $('#deleteSelected').removeClass('show');
                }
            }

            // Delete selected items
            $('#deleteSelected').click(function() {
                const selectedIds = $('.select-item:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: `Apakah Anda yakin ingin menghapus ${selectedIds.length} data terpilih?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus Semua!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `<?php echo site_url('admin/hapus_multiple_peserta_daftar_ulang?ids='); ?>${selectedIds.join(',')}`;
                        }
                    });
                }
            });
        });
    </script>
</body>
</html> 