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
                        <h2 class="mb-0 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Data Belum Daftar Ulang</h2>
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
                            <a href="javascript:void(0)" class="btn btn-success" onclick="exportToExcel()">
                                <i class="bi bi-file-earmark-excel"></i> Export ke Excel
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle" id="exportTable" style="border-radius:12px; overflow:hidden;">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Pendaftaran</th>
                                        <th>Nama Siswa</th>
                                        <th>Sekolah Asal</th>
                                        <th>Alamat Lengkap</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th>Rekomendasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($pendaftar as $p): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $p->no_pendaftaran; ?></td>
                                        <td><?php echo $p->nama_siswa; ?></td>
                                        <td><?php echo $p->nama_sekolah; ?></td>
                                        <td><?php echo $p->alamat_lengkap; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($p->tanggal_pendaftaran)); ?></td>
                                        <td><?php echo $p->rekomendasi; ?></td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#exportTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                },
                destroy: true,
                paging: false,
                searching: false,
                info: false
            });

            // Sidebar toggle functionality
            $('#sidebarToggle').click(function() {
                $('.sidebar').toggleClass('collapsed');
                $('.main-content').toggleClass('col-auto');
            });

            function exportToExcel() {
                const table = document.getElementById('exportTable');
                const wb = XLSX.utils.table_to_book(table, {sheet:"Data Belum Daftar Ulang"});
                XLSX.writeFile(wb, 'Belum_Daftar_Ulang_' + new Date().toLocaleDateString('en-CA') + '.xlsx');
            }
        });
        function exportToExcel() {
        const table = document.getElementById('exportTable');
        const wb = XLSX.utils.table_to_book(table, {sheet:"Data Belum Daftar Ulang"});
        XLSX.writeFile(wb, 'Belum_Daftar_Ulang_' + new Date().toLocaleDateString('en-CA') + '.xlsx');
    }
</script>
</body>
</html>