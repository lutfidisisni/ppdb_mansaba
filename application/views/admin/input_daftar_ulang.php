<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto sidebar-container p-0">
                <?php $this->load->view('admin/_sidebar'); ?>
            </div>
            <div class="col p-4">
                <h2 class="mb-4">Input Daftar Ulang</h2>
                
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php endif; ?>

                <form action="<?php echo site_url('admin/save_daftar_ulang'); ?>" method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pendaftaran_id" class="form-label">Pilih Siswa</label>
                            <select class="form-select select2" id="pendaftaran_id" name="pendaftaran_id" required>
                                <option value="">Pilih Siswa</option>
                                <?php foreach($pendaftar as $p): ?>
                                    <option value="<?php echo $p->id; ?>">
                                        <?php echo $p->no_pendaftaran . ' - ' . $p->nama_siswa . ' - ' . $p->nama_sekolah; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_daftar_ulang" class="form-label">Tanggal Daftar Ulang</label>
                            <input type="date" class="form-control" id="tanggal_daftar_ulang" name="tanggal_daftar_ulang" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kelengkapan Berkas</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="kk_asli" id="kk_asli">
                                <label class="form-check-label" for="kk_asli">KK Asli</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="skl" id="skl">
                                <label class="form-check-label" for="skl">SKL</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="piagam" id="piagam">
                                <label class="form-check-label" for="piagam">Piagam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sktm" id="sktm">
                                <label class="form-check-label" for="sktm">SKTM / Surat Rekom PRNU</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="bayar_daftar_ulang" id="bayar_daftar_ulang">
                                <label class="form-check-label" for="bayar_daftar_ulang">Bayar Daftar Ulang</label>
                            </div>
                            <div class="mb-3">
                                <label for="nominal_daftar_ulang" class="form-label">Nominal Daftar Ulang</label>
                                <input type="number" class="form-control" id="nominal_daftar_ulang" name="nominal_daftar_ulang" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ukuran_seragam" class="form-label">Ukuran Seragam</label>
                            <select class="form-select" id="ukuran_seragam" name="ukuran_seragam" required>
                                <option value="">Pilih Ukuran</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                                <option value="3XL">3XL</option>
                                <option value="4XL">4XL</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Seragam yang Diterima</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="seragam_osis" id="seragam_osis">
                                <label class="form-check-label" for="seragam_osis">Osis</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="seragam_pramuka" id="seragam_pramuka">
                                <label class="form-check-label" for="seragam_pramuka">Pramuka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="seragam_batik" id="seragam_batik">
                                <label class="form-check-label" for="seragam_batik">Batik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="seragam_olahraga" id="seragam_olahraga">
                                <label class="form-check-label" for="seragam_olahraga">Olahraga</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Set today's date as default for tanggal_daftar_ulang
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            $('#tanggal_daftar_ulang').val(today);

            $('#bayar_daftar_ulang').change(function() {
                if($(this).is(':checked')) {
                    $('#nominal_daftar_ulang').prop('disabled', false);
                } else {
                    $('#nominal_daftar_ulang').prop('disabled', true);
                    $('#nominal_daftar_ulang').val('');
                }
            });

            // Sidebar toggle functionality
            $('#sidebarToggle').click(function() {
                $('.sidebar').toggleClass('collapsed');
                $('.main-content').toggleClass('col-auto');
            });
        });
    </script>
</body>
</html> 