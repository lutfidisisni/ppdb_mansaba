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
            background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%);
            min-height: 100vh;
        }
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        }
        .form-control:disabled {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-auto sidebar-container p-0">
                <?php $this->load->view('admin/_sidebar'); ?>
            </div>
            <div class="col p-4" style="margin-left: 240px;">
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <h2 class="mb-0 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Edit Data Peserta Daftar Ulang</h2>
                    </div>
                </div>

                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/update_peserta_daftar_ulang'); ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $peserta->id; ?>">
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nomor Daftar Ulang</label>
                                    <input type="text" class="form-control" name="no_daftar_ulang" value="<?php echo $peserta->no_daftar_ulang; ?>" readonly disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" name="nama_siswa" value="<?php echo $peserta->nama_siswa; ?>" readonly disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Program</label>
                                    <select class="form-select" name="pilihan_program" disabled>
                                        <option value="MIPA" <?php echo ($peserta->pilihan_program == 'MIPA') ? 'selected' : ''; ?>>MIPA</option>
                                        <option value="IPS" <?php echo ($peserta->pilihan_program == 'IPS') ? 'selected' : ''; ?>>IPS</option>
                                        <option value="Bahasa" <?php echo ($peserta->pilihan_program == 'Bahasa') ? 'selected' : ''; ?>>Bahasa</option>
                                        <option value="AGM" <?php echo ($peserta->pilihan_program == 'AGM') ? 'selected' : ''; ?>>AGM</option>
                                        <option value="Tahfidz" <?php echo ($peserta->pilihan_program == 'Tahfidz') ? 'selected' : ''; ?>>Tahfidz</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ukuran Seragam</label>
                                    <select class="form-select" name="ukuran_seragam">
                                        <option value="">Pilih Ukuran</option>
                                        <option value="S" <?php echo ($peserta->ukuran_seragam == 'S') ? 'selected' : ''; ?>>S</option>
                                        <option value="M" <?php echo ($peserta->ukuran_seragam == 'M') ? 'selected' : ''; ?>>M</option>
                                        <option value="L" <?php echo ($peserta->ukuran_seragam == 'L') ? 'selected' : ''; ?>>L</option>
                                        <option value="XL" <?php echo ($peserta->ukuran_seragam == 'XL') ? 'selected' : ''; ?>>XL</option>
                                        <option value="XXL" <?php echo ($peserta->ukuran_seragam == 'XXL') ? 'selected' : ''; ?>>XXL</option>
                                        <option value="3XL" <?php echo ($peserta->ukuran_seragam == '3XL') ? 'selected' : ''; ?>>3XL</option>
                                        <option value="4XL" <?php echo ($peserta->ukuran_seragam == '4XL') ? 'selected' : ''; ?>>4XL</option>
                                        <option value="Custom" <?php echo ($peserta->ukuran_seragam == 'Custom') ? 'selected' : ''; ?>>Custom</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Status Berkas</label>
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="kk_asli" value="1" <?php echo $peserta->kk_asli ? 'checked' : ''; ?>>
                                            <label class="form-check-label">KK Asli</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="skl" value="1" <?php echo $peserta->skl ? 'checked' : ''; ?>>
                                            <label class="form-check-label">SKL</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="piagam" value="1" <?php echo $peserta->piagam ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Piagam</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="sktm" value="1" <?php echo $peserta->sktm ? 'checked' : ''; ?>>
                                            <label class="form-check-label">SKTM</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status Seragam</label>
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="seragam_osis" value="1" <?php echo $peserta->seragam_osis ? 'checked' : ''; ?>>
                                            <label class="form-check-label">OSIS</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="seragam_pramuka" value="1" <?php echo $peserta->seragam_pramuka ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Pramuka</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="seragam_batik" value="1" <?php echo $peserta->seragam_batik ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Batik</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="seragam_olahraga" value="1" <?php echo $peserta->seragam_olahraga ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Olahraga</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Status Pembayaran</label>
                                    <div class="d-flex gap-4 align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="bayar_daftar_ulang" value="1" <?php echo $peserta->bayar_daftar_ulang ? 'checked' : ''; ?>>
                                            <label class="form-check-label">Sudah Bayar</label>
                                        </div>
                                        <div class="flex-grow-1">
                                            <select class="form-select" name="nominal_daftar_ulang" <?php echo !$peserta->bayar_daftar_ulang ? 'disabled' : ''; ?>>
                                                <option value="">Pilih Nominal</option>
                                                <option value="100000" <?php echo ($peserta->nominal_daftar_ulang == 100000) ? 'selected' : ''; ?>>Rp 100.000</option>
                                                <option value="200000" <?php echo ($peserta->nominal_daftar_ulang == 200000) ? 'selected' : ''; ?>>Rp 200.000</option>
                                                <option value="300000" <?php echo ($peserta->nominal_daftar_ulang == 300000) ? 'selected' : ''; ?>>Rp 300.000</option>
                                                <option value="400000" <?php echo ($peserta->nominal_daftar_ulang == 400000) ? 'selected' : ''; ?>>Rp 400.000</option>
                                                <option value="500000" <?php echo ($peserta->nominal_daftar_ulang == 500000) ? 'selected' : ''; ?>>Rp 500.000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Simpan Perubahan
                                </button>
                                <a href="<?php echo site_url('admin/peserta_daftar_ulang'); ?>" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Format nominal dengan titik sebagai pemisah ribuan
        $('input[name="nominal_daftar_ulang"]').on('input', function() {
            let value = $(this).val().replace(/\D/g, '');
            $(this).val(new Intl.NumberFormat('id-ID').format(value));
        });

        // Update script untuk enable/disable dropdown nominal
        $('input[name="bayar_daftar_ulang"]').on('change', function() {
            $('select[name="nominal_daftar_ulang"]').prop('disabled', !this.checked);
            if (!this.checked) {
                $('select[name="nominal_daftar_ulang"]').val('');
            }
        });
    </script>
</body>
</html>