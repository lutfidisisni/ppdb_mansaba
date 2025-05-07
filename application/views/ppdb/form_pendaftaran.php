<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Siswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/form-fix.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-label { font-weight: 500; }
        .text-primary { color: #198754 !important; }
        .btn-primary, .btn-success { 
            background-color: #198754; 
            border-color: #198754; 
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover, .btn-success:hover {
            background-color: #157347;
            border-color: #157347;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-secondary {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Improved form field styling */
        .form-control, .form-select, .select2-container--default .select2-selection--single, select.form-control {
            height: 42px !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 1rem !important;
            border-radius: 4px !important;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out !important;
            width: 100% !important;
            min-width: 200px !important;
            max-width: 100% !important;
            display: block !important;
            flex-grow: 1 !important;
            appearance: auto !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            box-sizing: border-box !important;
        }
        select.form-select {
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        .nav-tabs { border-bottom: none; }
        .section-title { 
            border-left: 4px solid #198754; 
            padding-left: 10px; 
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .card-body {
            padding: 2.5rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
        }
        
        /* Improved field spacing */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        /* Better section styling */
        .section-title {
            border-left: 4px solid #198754;
            padding-left: 12px;
            margin-bottom: 1.5rem;
        }
        
        /* Improved styling for labels */
        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
            color: #444;
        }
        .section-nav {
            cursor: pointer;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            white-space: nowrap;
            margin: 0 2px;
        }
        
        .row.mb-4 {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 8px;
            padding: 8px 0;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .row.mb-4::-webkit-scrollbar {
            display: none;
        }
        
        .section-nav {
            min-width: 160px;
            max-width: 220px;
            text-align: center;
            padding: 10px 12px;
            border-radius: 8px;
            flex-shrink: 0;
            margin: 0 4px;
            font-size: 0.9rem;
        }
        
        .row.mb-4 {
            flex-wrap: nowrap;
            overflow-x: auto;
            scrollbar-width: thin;
            padding: 8px 0;
        }
        .section-nav:hover {
            background-color: #f8f9fa;
        }
        .section-nav.active {
            background-color: #198754;
            color: white !important;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .invalid-feedback {
            display: none;
        }
        .was-validated .form-control:invalid ~ .invalid-feedback {
            display: block;
        }
        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #ced4da;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .datepicker {
            z-index: 1060 !important;
        }
        .input-group-append {
            cursor: pointer;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }
        .input-group-text:hover {
            background-color: #e9ecef;
        }
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .loading-spinner {
            text-align: center;
        }
    @media (max-width: 768px) {
        .section-nav {
            min-width: 140px;
            padding: 8px 10px;
            font-size: 0.85rem;
        }
        .form-control, .form-select {
            min-width: 150px !important;
        }
    }
    
    @media (max-width: 576px) {
        .row.mb-4 {
            max-width: 100%;
            padding: 8px 5px;
        }
        .section-nav {
            min-width: auto;
            padding: 8px 10px;
            font-size: 0.8rem;
            margin: 0 2px;
        }
        .section-nav i {
            margin-right: 0 !important;
        }
    }
</style>
</head>
<body class="bg-light">
    <!-- Loading Overlay -->
    <div class="loading-overlay">
        <div class="loading-spinner">
            <div class="spinner-border text-success mb-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div>Mohon tunggu, data sedang diproses...</div>
        </div>
    </div>

    <div class="container-fluid mt-4 px-4 px-md-5">
        <!-- Notification Messages -->
        <?php if($this->session->flashdata('success_message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> <?= $this->session->flashdata('success_message') ?>
            <?php if($this->session->flashdata('nomor_pendaftaran')): ?>
            <p>Nomor Pendaftaran Anda: <strong><?= $this->session->flashdata('nomor_pendaftaran') ?></strong></p>
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('error_message')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= $this->session->flashdata('error_message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <h2 class="text-center mb-4 text-success">Formulir Pendaftaran Siswa Baru</h2>
        
        <div class="row mb-4">
            <div class="col-auto">
                <div class="section-nav active" data-section="data-pribadi">
                    <i class="fas fa-user me-md-2"></i><span class="d-none d-md-inline">Data Pribadi</span>
                </div>
            </div>
            <div class="col-auto">
                <div class="section-nav" data-section="data-alamat">
                    <i class="fas fa-map-marker-alt me-md-2"></i><span class="d-none d-md-inline">Data Alamat</span>
                </div>
            </div>
            <div class="col-auto">
                <div class="section-nav" data-section="data-ortu">
                    <i class="fas fa-users me-md-2"></i><span class="d-none d-md-inline">Data Orang Tua</span>
                </div>
            </div>
            <div class="col-auto">
                <div class="section-nav" data-section="data-wali">
                    <i class="fas fa-user-tie me-md-2"></i><span class="d-none d-md-inline">Data Wali</span>
                </div>
            </div>
            <div class="col-auto">
                <div class="section-nav" data-section="data-sekolah">
                    <i class="fas fa-school me-md-2"></i><span class="d-none d-md-inline">Data Sekolah</span>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <!-- Add dummy data button -->
                <div class="text-end mb-3">
                    
                </div>

                <form id="formPendaftaran" method="post" action="<?= base_url('ppdb/save_pendaftaran') ?>" class="needs-validation" novalidate>
                    <!-- Data Pribadi Section -->
                    <div class="form-section active" id="data-pribadi">
                        <div class="section-title mb-4">
                            <h5 class="mb-0 text-success">Data Pribadi Siswa</h5>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_siswa" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                                    <div class="invalid-feedback">Nama lengkap harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">Jenis kelamin harus dipilih</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                    <div class="invalid-feedback">Tempat lahir harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">Tanggal lahir harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tempat_tanggal_lahir" class="form-label">Tempat, Tanggal Lahir</label>
                                    <input type="text" class="form-control bg-light" id="tempat_tanggal_lahir" name="tempat_tanggal_lahir" readonly>
                                    <input type="hidden" name="tempat_tanggal_lahir_db" id="tempat_tanggal_lahir_db">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rekomendasi" class="form-label">Rekomendasi Pendaftaran</label>
                                    <input type="text" class="form-control" id="rekomendasi" name="rekomendasi" placeholder="Siapa yang mengajak anda mendaftar?">
                                    <small class="text-muted">Contoh: Guru PAI, Teman, Saudara, dll.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pilihan_program" class="form-label">Pilihan Program Peminatan <span class="text-danger">*</span></label>
                                    <select class="form-control" id="pilihan_program" name="pilihan_program" required>
                                        <option value="">Pilih Program</option>
                                        <option value="MIPA">MIPA</option>
                                        <option value="IPS">IPS</option>
                                        <option value="BAHASA">BAHASA</option>
                                        <option value="AGM">AGM</option>
                                    </select>
                                    <div class="invalid-feedback">Pilihan program harus dipilih</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp_siswa" class="form-label">Nomor HP/WhatsApp <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="no_hp_siswa" name="no_hp_siswa" 
                                           required pattern="08[0-9]{9,11}" 
                                           placeholder="08xxxxxxxxxx"
                                           title="Format: 08xxxxxxxxxx (10-13 digit)">
                                    <div class="invalid-feedback">Harus diawali 08 dan 10-13 digit angka</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jalur_pendaftaran" class="form-label">Jalur Pendaftaran <span class="text-danger">*</span></label>
                                    <select class="form-control" id="jalur_pendaftaran" name="jalur_pendaftaran" required>
                                        <option value="">Pilih Jalur Pendaftaran</option>
                                        <option value="Reguler">Reguler</option>
                                        <option value="Prestasi">Prestasi</option>
                                        <option value="Sosial">Sosial</option>
                                        <option value="Tahfidz">Tahfidz</option>
                                    </select>
                                    <div class="invalid-feedback">Jalur pendaftaran harus dipilih</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Alamat Section -->
                    <div class="form-section" id="data-alamat">
                        <div class="section-title mb-4">
                            <h5 class="mb-0 text-success">Data Alamat</h5>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tinggal" class="form-label">Tinggal <span class="text-danger">*</span></label>
                                    <select class="form-control" id="tinggal" name="tinggal" required>
                                        <option value="">Pilih Status Tinggal</option>
                                        <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                                        <option value="Bersama Wali">Bersama Wali</option>
                                        <option value="Bersama Kakak">Bersama Kakak</option>
                                        <option value="Tinggal Sendiri">Tinggal Sendiri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <div class="invalid-feedback">Status tinggal harus dipilih</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dukuh" class="form-label">Dukuh <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="dukuh" name="dukuh" required>
                                    <div class="invalid-feedback">Dukuh harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="rt" name="rt" required>
                                    <div class="invalid-feedback">RT harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="rw" name="rw" required>
                                    <div class="invalid-feedback">RW harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="desa" class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="desa" name="desa" required>
                                    <div class="invalid-feedback">Desa/Kelurahan harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                                    <div class="invalid-feedback">Kecamatan harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
                                    <div class="invalid-feedback">Kabupaten harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="provinsi" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                                    <div class="invalid-feedback">Provinsi harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control bg-light" id="alamat_lengkap" name="alamat_lengkap" readonly>
                                    <input type="hidden" name="alamat_lengkap_db" id="alamat_lengkap_db">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Orang Tua Section -->
                    <div class="form-section" id="data-ortu">
                        <div class="section-title mb-4">
                            <h5 class="mb-0 text-success">Data Orang Tua</h5>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_ayah" class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                                    <div class="invalid-feedback">Nama ayah harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_ibu" class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
                                    <div class="invalid-feedback">Nama ibu harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pendidikan_ayah" class="form-label">Pendidikan Ayah <span class="text-danger">*</span></label>
                                    <select class="form-control" id="pendidikan_ayah" name="pendidikan_ayah" required>
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                                        <option value="SD/MI Sederajat">SD/MI Sederajat</option>
                                        <option value="SLTP Sederajat">SLTP Sederajat</option>
                                        <option value="SLTA Sederajat">SLTA Sederajat</option>
                                        <option value="Strata 1">Strata 1</option>
                                        <option value="Strata 2">Strata 2</option>
                                        <option value="Strata 3">Strata 3</option>
                                    </select>
                                    <div class="invalid-feedback">Pendidikan ayah harus dipilih</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pendidikan_ibu" class="form-label">Pendidikan Ibu <span class="text-danger">*</span></label>
                                    <select class="form-control" id="pendidikan_ibu" name="pendidikan_ibu" required>
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                                        <option value="SD/MI Sederajat">SD/MI Sederajat</option>
                                        <option value="SLTP Sederajat">SLTP Sederajat</option>
                                        <option value="SLTA Sederajat">SLTA Sederajat</option>
                                        <option value="Strata 1">Strata 1</option>
                                        <option value="Strata 2">Strata 2</option>
                                        <option value="Strata 3">Strata 3</option>
                                    </select>
                                    <div class="invalid-feedback">Pendidikan ibu harus dipilih</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" required>
                                    <div class="invalid-feedback">Pekerjaan ayah harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" required>
                                    <div class="invalid-feedback">Pekerjaan ibu harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp_ayah" class="form-label">No. HP Ayah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_hp_ayah" name="no_hp_ayah" required pattern="[0-9]{10,13}">
                                    <div class="invalid-feedback">Nomor HP ayah harus diisi dengan benar</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp_ibu" class="form-label">No. HP Ibu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_hp_ibu" name="no_hp_ibu" required pattern="[0-9]{10,13}">
                                    <div class="invalid-feedback">Nomor HP ibu harus diisi dengan benar</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat_ortu" class="form-label">Alamat Orang Tua <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" required></textarea>
                                    <div class="invalid-feedback">Alamat orang tua harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Apakah mempunyai saudara kandung yang masih sekolah di MA NU 01 Banyuputih?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="saudara_sekolah" id="saudara_sekolah_ya" value="Ya">
                                        <label class="form-check-label" for="saudara_sekolah_ya">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="saudara_sekolah" id="saudara_sekolah_tidak" value="Tidak" checked>
                                        <label class="form-check-label" for="saudara_sekolah_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Wali Section -->
                    <div class="form-section" id="data-wali">
                        <div class="section-title mb-4">
                            <h5 class="mb-0 text-success">Data Wali (Opsional)</h5>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_wali" class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hubungan_wali" class="form-label">Hubungan dengan Wali</label>
                                    <input type="text" class="form-control" id="hubungan_wali" name="hubungan_wali">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pendidikan_wali" class="form-label">Pendidikan Wali</label>
                                    <select class="form-control" id="pendidikan_wali" name="pendidikan_wali">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                                        <option value="SD/MI Sederajat">SD/MI Sederajat</option>
                                        <option value="SLTP Sederajat">SLTP Sederajat</option>
                                        <option value="SLTA Sederajat">SLTA Sederajat</option>
                                        <option value="Strata 1">Strata 1</option>
                                        <option value="Strata 2">Strata 2</option>
                                        <option value="Strata 3">Strata 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                    <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp_wali" class="form-label">No. HP Wali</label>
                                    <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" pattern="[0-9]{10,13}">
                                    <div class="invalid-feedback">Nomor HP wali harus diisi dengan benar</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                    <textarea class="form-control" id="alamat_wali" name="alamat_wali"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Sekolah Section -->
                    <div class="form-section" id="data-sekolah">
                        <div class="section-title mb-4">
                            <h5 class="mb-0 text-success">Data Sekolah Asal</h5>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_sekolah" class="form-label">Nama SMP/MTs <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
                                    <div class="invalid-feedback">Nama sekolah harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat_sekolah" class="form-label">Alamat Sekolah <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" required></textarea>
                                    <div class="invalid-feedback">Alamat sekolah harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Apakah memiliki Piagam/Sertifikat (Juara)?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="piagam" id="piagam_ya" value="Ya">
                                        <label class="form-check-label" for="piagam_ya">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="piagam" id="piagam_tidak" value="Tidak" checked>
                                        <label class="form-check-label" for="piagam_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="nama_event_container" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama_event" class="form-label">Nama Lomba/Event</label>
                                    <input type="text" class="form-control" id="nama_event" name="nama_event">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="motivasi" class="form-label">Motivasi mendaftar di MA NU 01 Banyuputih <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="motivasi" name="motivasi" required></textarea>
                                    <div class="invalid-feedback">Motivasi harus diisi</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary px-4" id="btnKembali" style="display: none;">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </button>
                        <button type="button" class="btn btn-primary px-4" id="btnSelanjutnya">
                            Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                        <button type="submit" class="btn btn-success" id="submitForm" style="display: none;">
                            <i class="fas fa-save me-2"></i>Simpan Pendaftaran
                        </button>
                    </div>
                
            </div>
        </div>
    </div>

    <!-- Required Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>

    <script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('select').select2();
        
        // Inisialisasi datepicker
        $('#tanggal_lahir').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            language: 'id',
            todayHighlight: true
        }).on('changeDate', function() {
            updateTempatTanggalLahir();
        });
        
        // Function to update combined Tempat, Tanggal Lahir field with long date format
        function updateTempatTanggalLahir() {
            var tempat = $('#tempat_lahir').val();
            var tanggal = $('#tanggal_lahir').val();
            
            if (tempat && tanggal) {
                // Convert dd-mm-yyyy to long date format (e.g., 20 Agustus 2010)
                if (tanggal) {
                    var parts = tanggal.split('-');
                    if (parts.length === 3) {
                        var day = parseInt(parts[0]);
                        var month = parseInt(parts[1]);
                        var year = parts[2];
                        
                        var monthNames = [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ];
                        
                        var formattedDate = day + ' ' + monthNames[month-1] + ' ' + year;
                        var tempatTanggalLahir = tempat + ', ' + formattedDate;
                        $('#tempat_tanggal_lahir').val(tempatTanggalLahir);
                        $('#tempat_tanggal_lahir_db').val(tempatTanggalLahir);
                        
                        // Store the ISO format date (yyyy-mm-dd) in a hidden field for database storage
                        var isoDate = year + '-' + parts[1] + '-' + parts[0];
                        if (!$('#tanggal_lahir_db').length) {
                            $('<input>').attr({
                                type: 'hidden',
                                id: 'tanggal_lahir_db',
                                name: 'tanggal_lahir_db',
                                value: isoDate
                            }).appendTo('#formPendaftaran');
                        } else {
                            $('#tanggal_lahir_db').val(isoDate);
                        }
                    }
                }
            } else {
                $('#tempat_tanggal_lahir').val('');
                $('#tempat_tanggal_lahir_db').val('');
            }
        }
        
        // Function to update the complete address field
        function updateAlamatLengkap() {
            var dukuh = $('#dukuh').val();
            var rt = $('#rt').val();
            var rw = $('#rw').val();
            var desa = $('#desa').val();
            var kecamatan = $('#kecamatan').val();
            var kabupaten = $('#kabupaten').val();
            var provinsi = $('#provinsi').val();
            var tinggal = $('#tinggal').val();
            
            var alamat = '';
            
            if (dukuh) {
                alamat += dukuh;
            }
            
            if (rt || rw) {
                if (alamat) alamat += ', ';
                alamat += 'RT ' + (rt || '-') + '/RW ' + (rw || '-');
            }
            
            if (desa) {
                if (alamat) alamat += ', ';
                alamat += desa;
            }
            
            if (kecamatan) {
                if (alamat) alamat += ', ';
                alamat += kecamatan;
            }
            
            if (kabupaten) {
                if (alamat) alamat += ', ';
                alamat += kabupaten;
            }
            
            if (provinsi) {
                if (alamat) alamat += ', ';
                alamat += provinsi;
            }
            
            // Don't include tinggal status in alamat_lengkap
            
            $('#alamat_lengkap').val(alamat);
            $('#alamat_lengkap_db').val(alamat);
        }
        
        // Listen for changes on tempat_lahir field
        $('#tempat_lahir').on('change keyup', function() {
            updateTempatTanggalLahir();
        });
        
        // Listen for changes on address fields
        $('#dukuh, #rt, #rw, #desa, #kecamatan, #kabupaten, #provinsi, #tinggal').on('change keyup', function() {
            updateAlamatLengkap();
        });
    
        // Array untuk menyimpan urutan section
        const sections = ['data-pribadi', 'data-alamat', 'data-ortu', 'data-wali', 'data-sekolah'];
        let currentSectionIndex = 0;
    
        // Fungsi untuk menampilkan section
        function showSection(index) {
            // Sembunyikan semua section
            $('.form-section').hide();
            // Tampilkan section yang aktif
            $(`#${sections[index]}`).show();
            
            // Update status aktif pada navigasi
            $('.section-nav').removeClass('active');
            $(`.section-nav[data-section="${sections[index]}"]`).addClass('active');
            
            // Update tombol navigasi
            if (index === 0) {
                $('#btnKembali').hide();
                $('#btnSelanjutnya').show();
                $('#submitForm').hide();
            } else if (index === sections.length - 1) {
                $('#btnKembali').show();
                $('#btnSelanjutnya').hide();
                $('#submitForm').show();
            } else {
                $('#btnKembali').show();
                $('#btnSelanjutnya').show();
                $('#submitForm').hide();
            }
        }
        
        // Validate fields in current section
        function validateCurrentSection() {
            let isValid = true;
            const currentSection = $(`#${sections[currentSectionIndex]}`);
            
            // Check all required fields in the current section
            currentSection.find('input[required], select[required], textarea[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            return isValid;
        }
    
        // Event handler untuk tombol selanjutnya
        $('#btnSelanjutnya').click(function() {
            if (validateCurrentSection() && currentSectionIndex < sections.length - 1) {
                currentSectionIndex++;
                showSection(currentSectionIndex);
                // Scroll to top of form
                $('html, body').animate({
                    scrollTop: $('#formPendaftaran').offset().top - 50
                }, 500);
            }
        });
    
        // Event handler untuk tombol kembali
        $('#btnKembali').click(function() {
            if (currentSectionIndex > 0) {
                currentSectionIndex--;
                showSection(currentSectionIndex);
                // Scroll to top of form
                $('html, body').animate({
                    scrollTop: $('#formPendaftaran').offset().top - 50
                }, 500);
            }
        });
    
        // Event handler untuk menu navigasi
        $('.section-nav').click(function() {
            const targetSection = $(this).data('section');
            const targetIndex = sections.indexOf(targetSection);
            
            // Only allow navigation if all previous sections are valid
            let canNavigate = true;
            if (targetIndex > currentSectionIndex) {
                for (let i = 0; i <= currentSectionIndex; i++) {
                    let tempIndex = currentSectionIndex;
                    currentSectionIndex = i;
                    if (!validateCurrentSection()) {
                        canNavigate = false;
                        currentSectionIndex = tempIndex;
                        break;
                    }
                    currentSectionIndex = tempIndex;
                }
            }
            
            if (canNavigate) {
                currentSectionIndex = targetIndex;
                showSection(currentSectionIndex);
            }
        });
        
        // Form submission handler
        $('#formPendaftaran').on('submit', function(e) {
            e.preventDefault();
            
            // Make sure address and date fields are properly updated before submission
            updateTempatTanggalLahir();
            updateAlamatLengkap();
            
            // Validate all sections before submitting
            let allSectionsValid = true;
            let originalSectionIndex = currentSectionIndex;
            
            for (let i = 0; i < sections.length; i++) {
                currentSectionIndex = i;
                if (!validateCurrentSection()) {
                    allSectionsValid = false;
                    break;
                }
            }
            
            // Reset to original section
            currentSectionIndex = originalSectionIndex;
            showSection(currentSectionIndex);
            
            if (allSectionsValid) {
                // Show loading overlay
                $('.loading-overlay').css('display', 'flex');
                
                // Use FormData for more reliable form submission
                var formElement = document.getElementById('formPendaftaran');
                var formData = new FormData(formElement);
                
                // Make sure we're using the YYYY-MM-DD date format for database
                var dateDbValue = $('#tanggal_lahir_db').val();
                if (dateDbValue) {
                    formData.set('tanggal_lahir', dateDbValue);
                }
                
                // Debugging - log the form data
                console.log('Form data being submitted:');
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }
                
                // Submit the form using AJAX to provide immediate feedback
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        // Hide the loading overlay
                        $('.loading-overlay').hide();
                        
                        if (data.status === 'success') {
                            // Show success notification with registration number
                            Swal.fire({
                                icon: 'success',
                                title: 'Pendaftaran Berhasil!',
                                html: `
                                    <div class="text-center">
                                        <p>Data Anda telah berhasil disimpan.</p>
                                        <p class="mb-0">Nomor Pendaftaran Anda:</p>
                                        <h4 class="text-success mt-2">${data.nomor_pendaftaran}</h4>
                                        <p class="text-muted mt-2">Harap catat atau simpan nomor pendaftaran ini untuk keperluan selanjutnya.</p>
                                    </div>
                                `,
                                confirmButtonText: 'Kembali ke Halaman Awal',
                                confirmButtonColor: '#198754',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to home page
                                    window.location.href = '<?= base_url() ?>';
                                }
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: data.message || 'Gagal menyimpan pendaftaran. Silakan coba lagi.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Hide loading overlay
                        $('.loading-overlay').hide();
                        
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal menyimpan pendaftaran. Silakan coba lagi.'
                        });
                        
                        console.error('Error:', xhr.responseText);
                    }
                });
            } else {
                alert('Mohon lengkapi semua data yang diperlukan sebelum mengirim formulir.');
            }
        });
    
        // Function to fill form with dummy data
        function fillDummyData() {
            // Data Pribadi
            $('#nama_siswa').val('Ahmad Fauzi');
            $('#jenis_kelamin').val('Laki-laki').trigger('change');
            $('#tempat_lahir').val('Demak');
            $('#tanggal_lahir').val('15-08-2008');
            $('#no_hp_siswa').val('081234567890');
            $('#rekomendasi').val('Guru PAI');
            $('#pilihan_program').val('MIPA').trigger('change');
            $('#jalur_pendaftaran').val('Reguler').trigger('change');
            
            // Data Alamat
            $('#tinggal').val('Bersama Orang Tua').trigger('change');
            $('#dukuh').val('Dukuh Krajan');
            $('#rt').val('01');
            $('#rw').val('02');
            $('#desa').val('Mranggen');
            $('#kecamatan').val('Mranggen');
            $('#kabupaten').val('Demak');
            $('#provinsi').val('Jawa Tengah');
            
            // Data Orang Tua
            $('#nama_ayah').val('Budi Santoso');
            $('#nama_ibu').val('Siti Aminah');
            $('#pendidikan_ayah').val('Strata 1').trigger('change');
            $('#pendidikan_ibu').val('SLTA Sederajat').trigger('change');
            $('#pekerjaan_ayah').val('Wiraswasta');
            $('#pekerjaan_ibu').val('Ibu Rumah Tangga');
            $('#no_hp_ayah').val('081234567891');
            $('#no_hp_ibu').val('081234567892');
            $('#alamat_ortu').val('Jl. Merdeka No. 123');
            $('input[name="saudara_sekolah"][value="Tidak"]').prop('checked', true);
            
            // Data Wali (opsional)
            $('#nama_wali').val('');
            $('#hubungan_wali').val('');
            $('#pendidikan_wali').val('').trigger('change');
            $('#pekerjaan_wali').val('');
            $('#no_hp_wali').val('');
            $('#alamat_wali').val('');
            
            // Data Sekolah
            $('#nama_sekolah').val('SMP Negeri 1 Mranggen');
            $('#nisn').val('1234567890');
            $('#alamat_sekolah').val('Jl. Pendidikan No. 1, Mranggen');
            $('input[name="piagam"][value="Tidak"]').prop('checked', true);
            $('#motivasi').val('Ingin melanjutkan pendidikan di MA NU 01 Banyuputih karena memiliki program unggulan yang sesuai dengan minat saya.');
            
            // Update combined fields
            updateTempatTanggalLahir();
            updateAlamatLengkap();
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Data Contoh Telah Diisi',
                text: 'Silakan periksa dan edit data jika diperlukan sebelum mengirim formulir.',
                timer: 2000,
                showConfirmButton: false
            });
        }
        
        // Add click handler for dummy data button
        $('#btnFillDummy').click(function() {
            Swal.fire({
                title: 'Isi Data Contoh?',
                text: 'Formulir akan diisi dengan data contoh. Data yang sudah ada akan diganti.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Isi Data',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fillDummyData();
                }
            });
        });
    
        // Inisialisasi tampilan awal
        showSection(0);
    });
    </script>
    </body>
    </html>
