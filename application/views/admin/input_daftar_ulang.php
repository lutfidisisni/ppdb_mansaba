<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%);
        }
        .main-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1976d2;
            margin-bottom: 32px;
            text-shadow: 0 2px 8px #1976d233;
        }
        .form-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(25,118,210,0.08);
            border: 1px solid #e3f2fd;
            padding: 32px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .form-label {
            color: #1976d2;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 10px !important;
            border: 1px solid #b6d4fe;
            box-shadow: 0 1px 4px #1976d211;
            height: 50px !important;
            padding: 12px 16px !important;
        }
        .select2-container--default .select2-selection--single {
            border-radius: 10px !important;
            border: 1px solid #b6d4fe !important;
            box-shadow: 0 1px 4px #1976d211;
            height: 50px !important;
            padding: 10px 16px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px !important;
            padding-left: 0 !important;
        }
        .btn-primary {
            background: #1976d2;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 28px;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            background: #1256a3;
            box-shadow: 0 4px 16px #1976d233;
        }
        .alert {
            border-radius: 10px;
            font-size: 1rem;
        }
        .section-title {
            color: #1976d2;
            font-weight: 600;
            margin: 24px 0 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e3f2fd;
        }
        .form-check {
            margin-bottom: 8px;
        }
        .form-check-input:checked {
            background-color: #1976d2;
            border-color: #1976d2;
        }
        /* Responsive Styles */
        @media (max-width: 991px) {
            .form-card {
                padding: 24px;
            }
            .main-title {
                font-size: 1.5rem;
                margin-bottom: 24px;
            }
            .section-title {
                font-size: 1.1rem;
                margin: 20px 0 12px;
            }
        }
        @media (max-width: 767px) {
            .form-card {
                padding: 20px;
                margin: 0 15px;
            }
            .main-title {
                font-size: 1.3rem;
                margin-bottom: 20px;
            }
            .section-title {
                font-size: 1rem;
                margin: 16px 0 10px;
            }
            .form-label {
                font-size: 0.9rem;
            }
            .form-control, .form-select {
                font-size: 0.9rem;
            }
            .btn-primary {
                padding: 8px 20px;
                font-size: 0.9rem;
            }
            .form-check-label {
                font-size: 0.9rem;
            }
        }
        @media (max-width: 575px) {
            .form-card {
                padding: 16px;
                margin: 0 10px;
            }
            .main-title {
                font-size: 1.2rem;
                margin-bottom: 16px;
            }
            .section-title {
                font-size: 0.95rem;
                margin: 14px 0 8px;
            }
            .btn-primary {
                width: 100%;
                margin: 10px 0;
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
                        <div class="main-title text-center mb-0">Input Daftar Ulang</div>
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
                <div class="card form-card shadow-sm border-0">
                    <div class="card-body">
                        <form action="<?php echo site_url('admin/save_daftar_ulang'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="section-title">Data Siswa</h5>
                                    <div class="mb-3">
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
                                    <div class="mb-3">
                                        <label for="tanggal_daftar_ulang" class="form-label">Tanggal Daftar Ulang</label>
                                        <input type="date" class="form-control" id="tanggal_daftar_ulang" name="tanggal_daftar_ulang" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="section-title">Pembayaran</h5>
                                    <div class="mb-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="bayar_daftar_ulang" id="bayar_daftar_ulang">
                                            <label class="form-check-label" for="bayar_daftar_ulang">Bayar Daftar Ulang</label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nominal_daftar_ulang" class="form-label">Nominal Daftar Ulang</label>
                                            <select class="form-select" id="nominal_daftar_ulang" name="nominal_daftar_ulang" disabled>
                                                <option value="">Pilih Nominal</option>
                                                <option value="100000">Rp 100.000</option>
                                                <option value="200000">Rp 200.000</option>
                                                <option value="300000">Rp 300.000</option>
                                                <option value="400000">Rp 400.000</option>
                                                <option value="500000">Rp 500.000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="section-title">Kelengkapan Berkas</h5>
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
                                <div class="col-md-6">
                                    <h5 class="section-title">Seragam</h5>
                                    <div class="mb-3">
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
                                    <div class="mb-3">
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
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 justify-content-center mx-auto" style="transition:box-shadow 0.2s,transform 0.2s; min-width: 200px;">
                                        <i class="bi bi-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
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
        });
    </script>
</body>
</html> 