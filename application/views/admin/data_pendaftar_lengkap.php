<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar Lengkap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            background: #f8f9fa;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar-container {
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .sidebar {
            transition: all 0.3s;
            height: 100vh;
        }
        .main-content {
            margin-left: 240px;
            flex: 1;
            padding: 24px;
            min-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .table-area {
            width: 100%;
            overflow: auto;
        }
        .dataTables_wrapper {
            width: 100%;
        }
        .table-responsive {
            overflow-x: auto;
            min-height: 400px;
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
        @media (max-width: 991.98px) {
            .main-content { 
                margin-left: 0; 
                padding: 15px;
            }
            .sidebar-container {
                position: relative;
                min-height: auto;
            }
            .sidebar { 
                position: relative;
                width: 100%; 
                height: auto; 
            }
        }
        /* Perbaikan untuk DataTables */
        .dataTables_wrapper .row {
            margin: 0;
            width: 100%;
        }
        .dataTables_wrapper .dataTables_length {
            margin-bottom: 10px;
        }
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 10px;
        }
        /* Memastikan footer tetap di bawah */
        footer {
            margin-top: auto;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <div class="sidebar-container">
        <?php $this->load->view('admin/_sidebar'); ?>
    </div>
    <div class="main-content" style="background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%); min-height: 100vh;">
        <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.95); border-radius:18px;">
            <div class="card-body p-4">
                <h2 class="mb-0 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Data Pendaftar Lengkap</h2>
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
                <!-- Filter Section -->
                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" id="searchNama" placeholder="Cari berdasarkan nama siswa...">
                            <button class="btn btn-outline-secondary" type="button" id="btnClearSearch">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Filter Jenis Kelamin</label>
                        <select class="form-select" id="filterJenisKelamin">
                            <option value="">Semua</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Filter Status Daftar Ulang</label>
                        <select class="form-select" id="filterStatusDaftarUlang">
                            <option value="">Semua</option>
                            <option value="sudah">Sudah</option>
                            <option value="belum">Belum</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Filter Asal Sekolah</label>
                        <input type="text" class="form-control" id="filterSekolah" placeholder="Cari sekolah...">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tanggal Pendaftaran</label>
                        <input type="date" class="form-control" id="filterTanggal">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <div class="d-flex gap-2">
                        <button id="btnRefresh" class="btn btn-primary">
                            <i class="bi bi-arrow-clockwise"></i> Refresh
                        </button>
                        <button id="btnResetFilter" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Reset Filter
                        </button>
                    </div>
                    <div class="d-flex gap-2">
                        <button id="btnDelete" class="btn btn-danger" disabled>
                            <i class="bi bi-trash"></i> Hapus Terpilih
                        </button>
                    </div>
                </div>

                <div class="table-area">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle nowrap" id="tablePendaftarLengkap" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>No</th>
                                    <th>Nomor Pendaftaran</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>No HP Siswa</th>
                                    <th>Status Tinggal</th>
                                    <th>Alamat Lengkap</th>
                                    <th>Nama Sekolah</th>
                                    <th>Alamat Sekolah</th>
                                    <th>NISN</th>
                                    <th>Jalur Pendaftaran</th>
                                    <th>Pilihan Program</th>
                                    <th>Nama Ayah</th>
                                    <th>Pendidikan Ayah</th>
                                    <th>Pekerjaan Ayah</th>
                                    <th>No HP Ayah</th>
                                    <th>Nama Ibu</th>
                                    <th>Pendidikan Ibu</th>
                                    <th>Pekerjaan Ibu</th>
                                    <th>No HP Ibu</th>
                                    <th>Alamat Ortu</th>
                                    <th>Saudara Sekolah</th>
                                    <th>Nama Wali</th>
                                    <th>Hubungan Wali</th>
                                    <th>Pendidikan Wali</th>
                                    <th>Pekerjaan Wali</th>
                                    <th>No HP Wali</th>
                                    <th>Alamat Wali</th>
                                    <th>Tanggal Pendaftaran</th>
                                    <th>Status Daftar Ulang</th>
                                    <th>Rekomendasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($pendaftar as $p): ?>
                                <tr>
                                    <td><input type="checkbox" class="row-check" value="<?php echo $p->id; ?>"></td>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $p->no_pendaftaran; ?></td>
                                    <td><?php echo $p->nama_siswa; ?></td>
                                    <td><?php echo $p->jenis_kelamin; ?></td>
                                    <td><?php echo $p->tempat_lahir; ?></td>
                                    <td><?php echo $p->tanggal_lahir; ?></td>
                                    <td><?php echo $p->no_hp_siswa; ?></td>
                                    <td><?php echo $p->tinggal; ?></td>
                                    <td><?php echo $p->alamat_lengkap; ?></td>
                                    <td><?php echo $p->nama_sekolah; ?></td>
                                    <td><?php echo $p->alamat_sekolah; ?></td>
                                    <td><?php echo $p->nisn; ?></td>
                                    <td><?php echo $p->jalur_pendaftaran; ?></td>
                                    <td><?php echo $p->pilihan_program; ?></td>
                                    <td><?php echo $p->nama_ayah; ?></td>
                                    <td><?php echo $p->pendidikan_ayah; ?></td>
                                    <td><?php echo $p->pekerjaan_ayah; ?></td>
                                    <td><?php echo $p->no_hp_ayah; ?></td>
                                    <td><?php echo $p->nama_ibu; ?></td>
                                    <td><?php echo $p->pendidikan_ibu; ?></td>
                                    <td><?php echo $p->pekerjaan_ibu; ?></td>
                                    <td><?php echo $p->no_hp_ibu; ?></td>
                                    <td><?php echo $p->alamat_ortu; ?></td>
                                    <td><?php echo $p->saudara_sekolah; ?></td>
                                    <td><?php echo $p->nama_wali; ?></td>
                                    <td><?php echo $p->hubungan_wali; ?></td>
                                    <td><?php echo $p->pendidikan_wali; ?></td>
                                    <td><?php echo $p->pekerjaan_wali; ?></td>
                                    <td><?php echo $p->no_hp_wali; ?></td>
                                    <td><?php echo $p->alamat_wali; ?></td>
                                    <td><?php echo $p->tanggal_daftar ? date('d/m/Y H:i', strtotime($p->tanggal_daftar)) : ''; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $p->status_daftar_ulang == 'sudah' ? 'success' : 'warning'; ?>">
                                            <?php echo ucfirst($p->status_daftar_ulang); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $p->rekomendasi; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo site_url('admin/cetak_formulir/'.$p->id); ?>" class="btn btn-sm btn-info" title="Cetak Formulir">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                            <a href="<?php echo site_url('admin/edit_pendaftar/'.$p->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?php echo $p->id; ?>" title="Hapus">
                                                <i class="bi bi-trash"></i>
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
        </div>
        <footer class="mt-5 text-center text-muted small" style="opacity:0.7;">
            &copy; <?php echo date('Y'); ?> PPDB MANU Admin. All rights reserved.
        </footer>
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
            var table = $('#tablePendaftarLengkap').DataTable({
                dom: '<"d-flex justify-content-between align-items-center mb-3"l<"d-flex gap-2"B>>rtip',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10 Baris', '25 Baris', '50 Baris', '100 Baris', 'Semua']
                ],
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-success',
                        text: '<i class="bi bi-file-earmark-excel"></i> Excel'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        text: '<i class="bi bi-printer"></i> Cetak'
                    }
                ],
                scrollX: true,
                pageLength: 10,
                order: [[1, 'asc']],
                columnDefs: [
                    { targets: [34], orderable: false, searchable: false } // Kolom Aksi
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                }
            });

            // Search by name functionality
            $('#searchNama').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Clear search button
            $('#btnClearSearch').on('click', function() {
                $('#searchNama').val('');
                table.search('').draw();
            });

            // Filter functionality
            $('#filterJenisKelamin, #filterStatusDaftarUlang').on('change', function() {
                table.draw();
            });

            $('#filterSekolah, #filterTanggal').on('keyup change', function() {
                table.draw();
            });

            // Custom filtering function
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var jenisKelamin = $('#filterJenisKelamin').val();
                var statusDaftarUlang = $('#filterStatusDaftarUlang').val();
                var sekolah = $('#filterSekolah').val().toLowerCase();
                var tanggal = $('#filterTanggal').val();

                // Mengambil data dari kolom yang sesuai (sesuaikan dengan indeks kolom yang benar)
                var rowJenisKelamin = data[4];  // Kolom Jenis Kelamin (indeks 4)
                var rowStatus = data[32];        // Kolom Status Daftar Ulang (indeks 32)
                var rowSekolah = data[10];       // Kolom Nama Sekolah (indeks 10)
                var rowTanggal = data[31];       // Kolom Tanggal Pendaftaran (indeks 31)

                // Format tanggal dari dd/mm/yyyy HH:ii menjadi yyyy-mm-dd
                if (rowTanggal) {
                    var parts = rowTanggal.split(' ')[0].split('/');
                    if (parts.length === 3) {
                        rowTanggal = parts[2] + '-' + parts[1] + '-' + parts[0];
                    }
                }

                // Pencocokan filter
                var jenisKelaminMatch = !jenisKelamin || rowJenisKelamin === jenisKelamin;
                var statusMatch = !statusDaftarUlang || (rowStatus && rowStatus.toLowerCase().includes(statusDaftarUlang.toLowerCase()));
                var sekolahMatch = !sekolah || (rowSekolah && rowSekolah.toLowerCase().includes(sekolah));
                var tanggalMatch = !tanggal || rowTanggal === tanggal;

                return jenisKelaminMatch && statusMatch && sekolahMatch && tanggalMatch;
            });

            // Reset filter button
            $('#btnResetFilter').on('click', function() {
                $('#filterJenisKelamin, #filterStatusDaftarUlang').val('');
                $('#filterSekolah').val('');
                $('#filterTanggal').val('');
                table.draw();
            });

            // Refresh button
            $('#btnRefresh').on('click', function() {
                location.reload();
            });

            // Single delete button
            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                deleteConfirmation([id]);
            });

            function deleteConfirmation(ids) {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: `Apakah Anda yakin ingin menghapus ${ids.length} data terpilih?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo site_url('admin/hapus_pendaftar_lengkap'); ?>',
                            type: 'POST',
                            data: {ids: ids},
                            success: function(response) {
                                try {
                                    const res = JSON.parse(response);
                                    if(res.status) {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Data berhasil dihapus',
                                            icon: 'success'
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: res.msg || 'Gagal menghapus data',
                                            icon: 'error'
                                        });
                                    }
                                } catch(e) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan sistem',
                                        icon: 'error'
                                    });
                                }
                            }
                        });
                    }
                });
            }

            // Existing checkbox and delete functionality
            $('#checkAll').on('click', function() {
                $('.row-check').prop('checked', this.checked);
                updateDeleteButton();
            });
            
            $(document).on('change', '.row-check', function() {
                updateDeleteButton();
                if ($('.row-check:checked').length === 0) {
                    $('#checkAll').prop('checked', false);
                } else if ($('.row-check:checked').length === $('.row-check').length) {
                    $('#checkAll').prop('checked', true);
                }
            });

            function updateDeleteButton() {
                const checkedCount = $('.row-check:checked').length;
                $('#btnDelete').prop('disabled', checkedCount === 0);
            }
            
            $('#btnDelete').on('click', function() {
                var ids = $('.row-check:checked').map(function(){ return this.value; }).get();
                if(ids.length === 0) return;
                deleteConfirmation(ids);
            });
        });
    </script>
</body>
</html>