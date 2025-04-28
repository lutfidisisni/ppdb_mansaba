<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        :root {
            --primary-color: #1e7e34;
            --secondary-color: #28a745;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .form-container {
            background-color: #fff;
            padding: 30px;
            margin: 30px auto;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 15px;
        }
        
        .form-header h2 {
            color: var(--primary-color);
            font-weight: 700;
        }
        
        .tagline {
            font-style: italic;
            color: var(--secondary-color);
            font-size: 1.1rem;
            margin-top: 10px;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin: 25px 0 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .form-group label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 5px;
        }
        
        .form-control, .custom-select {
            border-radius: 4px;
            padding: 1px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus, .custom-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 25px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            background-color: #155724;
            border-color: #155724;
            transform: translateY(-2px);
        }
        
        .optional-text {
            font-size: 0.85rem;
            color: #6c757d;
            font-style: italic;
        }
        
        .is-invalid {
            border-color: #dc3545;
        }
        
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                margin: 15px auto;
            }
            
            .section-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2>Selamat Datang di Form Pendaftaran</h2>
                <p class="mb-2">Peserta Didik Baru MA NU 01 Banyuputih Tahun Pelajaran 2026/2027</p>
                <p class="tagline">Elevate your future with us!</p>
            </div>

            <?php if(isset($validation_errors)) echo $validation_errors; ?>

            <?php echo form_open('pendaftaran/submit_pendaftaran'); ?>

                <!-- Rekomendasi & Jalur Pendaftaran -->
                <h4 class="section-title">Rekomendasi & Jalur Pendaftaran</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rekomendasi">Pendaftaran (Siapa yang Mendaftarkan)</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['rekomendasi']) ? 'is-invalid' : ''; ?>" 
                                   id="rekomendasi" name="rekomendasi"
                                   value="<?php echo set_value('rekomendasi', isset($input['rekomendasi']) ? $input['rekomendasi'] : ''); ?>">
                            <?php if(isset($field_errors['rekomendasi'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['rekomendasi']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jalur_pendaftaran">Jalur Pendaftaran</label>
                            <select class="form-control <?php echo isset($field_errors['jalur_pendaftaran']) ? 'is-invalid' : ''; ?>" 
                                    id="jalur_pendaftaran" name="jalur_pendaftaran">
                                <option value="">-- Pilih Jalur Pendaftaran --</option>
                                <option value="reguler_umum" <?php echo set_select('jalur_pendaftaran', 'reguler_umum'); ?>>Reguler (Umum)</option>
                                <option value="reguler_prestasi" <?php echo set_select('jalur_pendaftaran', 'reguler_prestasi'); ?>>Reguler (Prestasi)</option>
                                <option value="reguler_sosial" <?php echo set_select('jalur_pendaftaran', 'reguler_sosial'); ?>>Reguler (Sosial)</option>
                            </select>
                            <?php if(isset($field_errors['jalur_pendaftaran'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['jalur_pendaftaran']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pilihan_program">Pilihan Program (Peminatan)</label>
                    <select class="form-control <?php echo isset($field_errors['pilihan_program']) ? 'is-invalid' : ''; ?>" 
                            id="pilihan_program" name="pilihan_program">
                        <option value="">-- Pilih Peminatan --</option>
                        <option value="mipa" <?php echo set_select('pilihan_program', 'mipa'); ?>>MIPA</option>
                        <option value="ips" <?php echo set_select('pilihan_program', 'ips'); ?>>IPS</option>
                        <option value="bahasa" <?php echo set_select('pilihan_program', 'bahasa'); ?>>Bahasa</option>
                        <option value="agm" <?php echo set_select('pilihan_program', 'agm'); ?>>AGM</option>
                        <option value="tahfidz" <?php echo set_select('pilihan_program', 'tahfidz'); ?>>Tahfidz</option>
                    </select>
                    <?php if(isset($field_errors['pilihan_program'])): ?>
                        <div class="invalid-feedback"><?php echo $field_errors['pilihan_program']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- DATA PESERTA DIDIK -->
                <h4 class="section-title">DATA PESERTA DIDIK</h4>
                <p class="text-muted mb-3">Silahkan isi data Peserta Didik sesuai dengan data di ijazah SMP/MTs</p>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nama_siswa">Nama Lengkap</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['nama_siswa']) ? 'is-invalid' : ''; ?>" 
                                   id="nama_siswa" name="nama_siswa"
                                   value="<?php echo set_value('nama_siswa', isset($input['nama_siswa']) ? $input['nama_siswa'] : ''); ?>">
                            <?php if(isset($field_errors['nama_siswa'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['nama_siswa']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control <?php echo isset($field_errors['jenis_kelamin']) ? 'is-invalid' : ''; ?>" 
                                    id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki" <?php echo set_select('jenis_kelamin', 'laki-laki'); ?>>Laki-laki</option>
                                <option value="perempuan" <?php echo set_select('jenis_kelamin', 'perempuan'); ?>>Perempuan</option>
                            </select>
                            <?php if(isset($field_errors['jenis_kelamin'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['jenis_kelamin']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['tempat_lahir']) ? 'is-invalid' : ''; ?>" 
                                   id="tempat_lahir" name="tempat_lahir"
                                   value="<?php echo set_value('tempat_lahir', isset($input['tempat_lahir']) ? $input['tempat_lahir'] : ''); ?>">
                            <?php if(isset($field_errors['tempat_lahir'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['tempat_lahir']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control <?php echo isset($field_errors['tanggal_lahir']) ? 'is-invalid' : ''; ?>" 
                                   id="tanggal_lahir" name="tanggal_lahir"
                                   value="<?php echo set_value('tanggal_lahir', isset($input['tanggal_lahir']) ? $input['tanggal_lahir'] : ''); ?>">
                            <small class="optional-text">Format: dd-MMM-yyyy (akan terisi otomatis)</small>
                            <?php if(isset($field_errors['tanggal_lahir'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['tanggal_lahir']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp_siswa">No. HP / Whatsapp</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['no_hp_siswa']) ? 'is-invalid' : ''; ?>" 
                                   id="no_hp_siswa" name="no_hp_siswa"
                                   value="<?php echo set_value('no_hp_siswa', isset($input['no_hp_siswa']) ? $input['no_hp_siswa'] : ''); ?>">
                            <?php if(isset($field_errors['no_hp_siswa'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['no_hp_siswa']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tempat_tanggal_lahir">Tempat & Tanggal Lahir (Otomatis)</label>
                    <input type="text" class="form-control" id="tempat_tanggal_lahir" name="tempat_tanggal_lahir" readonly
                           value="<?php echo set_value('tempat_tanggal_lahir', isset($input['tempat_tanggal_lahir']) ? $input['tempat_tanggal_lahir'] : ''); ?>">
                </div>

                <!-- DATA ALAMAT -->
                <h4 class="section-title">DATA ALAMAT</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tinggal">Tinggal</label>
                            <select class="form-control <?php echo isset($field_errors['tinggal']) ? 'is-invalid' : ''; ?>" 
                                    id="tinggal" name="tinggal">
                                <option value="">-- Pilih Status Tinggal --</option>
                                <option value="bersama_ortu" <?php echo set_select('tinggal', 'bersama_ortu'); ?>>Bersama Orang tua</option>
                                <option value="bersama_wali" <?php echo set_select('tinggal', 'bersama_wali'); ?>>Bersama Wali</option>
                                <option value="bersama_kakak" <?php echo set_select('tinggal', 'bersama_kakak'); ?>>Bersama Kakak</option>
                                <option value="tinggal_sendiri" <?php echo set_select('tinggal', 'tinggal_sendiri'); ?>>Tinggal Sendiri</option>
                                <option value="lainnya" <?php echo set_select('tinggal', 'lainnya'); ?>>Lainnya</option>
                            </select>
                            <?php if(isset($field_errors['tinggal'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['tinggal']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="tinggal_lainnya_group" style="display:<?php echo (isset($input['tinggal']) && $input['tinggal'] == 'lainnya') ? 'block' : 'none'; ?>;">
                            <label for="tinggal_lainnya">Keterangan Tinggal</label>
                            <input type="text" class="form-control" id="tinggal_lainnya" name="tinggal_lainnya" 
                                   placeholder="Sebutkan status tinggal lainnya"
                                   value="<?php echo set_value('tinggal_lainnya', isset($input['tinggal_lainnya']) ? $input['tinggal_lainnya'] : ''); ?>">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dukuh">Dukuh / Jalan</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['dukuh']) ? 'is-invalid' : ''; ?>" 
                                   id="dukuh" name="dukuh"
                                   value="<?php echo set_value('dukuh', isset($input['dukuh']) ? $input['dukuh'] : ''); ?>">
                            <?php if(isset($field_errors['dukuh'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['dukuh']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="desa">Desa</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['desa']) ? 'is-invalid' : ''; ?>" 
                                   id="desa" name="desa"
                                   value="<?php echo set_value('desa', isset($input['desa']) ? $input['desa'] : ''); ?>">
                            <?php if(isset($field_errors['desa'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['desa']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['rt']) ? 'is-invalid' : ''; ?>" 
                                   id="rt" name="rt"
                                   value="<?php echo set_value('rt', isset($input['rt']) ? $input['rt'] : ''); ?>">
                            <?php if(isset($field_errors['rt'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['rt']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['rw']) ? 'is-invalid' : ''; ?>" 
                                   id="rw" name="rw"
                                   value="<?php echo set_value('rw', isset($input['rw']) ? $input['rw'] : ''); ?>">
                            <?php if(isset($field_errors['rw'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['rw']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['kecamatan']) ? 'is-invalid' : ''; ?>" 
                                   id="kecamatan" name="kecamatan"
                                   value="<?php echo set_value('kecamatan', isset($input['kecamatan']) ? $input['kecamatan'] : ''); ?>">
                            <?php if(isset($field_errors['kecamatan'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['kecamatan']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['kabupaten']) ? 'is-invalid' : ''; ?>" 
                                   id="kabupaten" name="kabupaten"
                                   value="<?php echo set_value('kabupaten', isset($input['kabupaten']) ? $input['kabupaten'] : ''); ?>">
                            <?php if(isset($field_errors['kabupaten'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['kabupaten']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['provinsi']) ? 'is-invalid' : ''; ?>" 
                                   id="provinsi" name="provinsi"
                                   value="<?php echo set_value('provinsi', isset($input['provinsi']) ? $input['provinsi'] : ''); ?>">
                            <?php if(isset($field_errors['provinsi'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['provinsi']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="alamat_lengkap">Alamat Lengkap (Otomatis)</label>
                    <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="2" readonly><?php echo set_value('alamat_lengkap', isset($input['alamat_lengkap']) ? $input['alamat_lengkap'] : ''); ?></textarea>
                </div>

                <!-- DATA ORANG TUA -->
                <h4 class="section-title">DATA ORANG TUA (Kandung)</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['nama_ayah']) ? 'is-invalid' : ''; ?>" 
                                   id="nama_ayah" name="nama_ayah"
                                   value="<?php echo set_value('nama_ayah', isset($input['nama_ayah']) ? $input['nama_ayah'] : ''); ?>">
                            <?php if(isset($field_errors['nama_ayah'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['nama_ayah']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['nama_ibu']) ? 'is-invalid' : ''; ?>" 
                                   id="nama_ibu" name="nama_ibu"
                                   value="<?php echo set_value('nama_ibu', isset($input['nama_ibu']) ? $input['nama_ibu'] : ''); ?>">
                            <?php if(isset($field_errors['nama_ibu'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['nama_ibu']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendidikan_ayah">Pendidikan Ayah</label>
                            <select class="form-control <?php echo isset($field_errors['pendidikan_ayah']) ? 'is-invalid' : ''; ?>" 
                                    id="pendidikan_ayah" name="pendidikan_ayah">
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="sd" <?php echo set_select('pendidikan_ayah', 'sd'); ?>>SD</option>
                                <option value="smp" <?php echo set_select('pendidikan_ayah', 'smp'); ?>>SMP</option>
                                <option value="sma" <?php echo set_select('pendidikan_ayah', 'sma'); ?>>SMA</option>
                                <option value="d1" <?php echo set_select('pendidikan_ayah', 'd1'); ?>>D1</option>
                                <option value="d2" <?php echo set_select('pendidikan_ayah', 'd2'); ?>>D2</option>
                                <option value="d3" <?php echo set_select('pendidikan_ayah', 'd3'); ?>>D3</option>
                                <option value="s1" <?php echo set_select('pendidikan_ayah', 's1'); ?>>S1</option>
                                <option value="s2" <?php echo set_select('pendidikan_ayah', 's2'); ?>>S2</option>
                                <option value="s3" <?php echo set_select('pendidikan_ayah', 's3'); ?>>S3</option>
                            </select>
                            <?php if(isset($field_errors['pendidikan_ayah'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['pendidikan_ayah']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['pekerjaan_ayah']) ? 'is-invalid' : ''; ?>" 
                                   id="pekerjaan_ayah" name="pekerjaan_ayah"
                                   value="<?php echo set_value('pekerjaan_ayah', isset($input['pekerjaan_ayah']) ? $input['pekerjaan_ayah'] : ''); ?>">
                            <?php if(isset($field_errors['pekerjaan_ayah'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['pekerjaan_ayah']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp_ayah">No. HP Ayah</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['no_hp_ayah']) ? 'is-invalid' : ''; ?>" 
                                   id="no_hp_ayah" name="no_hp_ayah"
                                   value="<?php echo set_value('no_hp_ayah', isset($input['no_hp_ayah']) ? $input['no_hp_ayah'] : ''); ?>">
                            <?php if(isset($field_errors['no_hp_ayah'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['no_hp_ayah']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendidikan_ibu">Pendidikan Ibu</label>
                            <select class="form-control <?php echo isset($field_errors['pendidikan_ibu']) ? 'is-invalid' : ''; ?>" 
                                    id="pendidikan_ibu" name="pendidikan_ibu">
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="sd" <?php echo set_select('pendidikan_ibu', 'sd'); ?>>SD</option>
                                <option value="smp" <?php echo set_select('pendidikan_ibu', 'smp'); ?>>SMP</option>
                                <option value="sma" <?php echo set_select('pendidikan_ibu', 'sma'); ?>>SMA</option>
                                <option value="d1" <?php echo set_select('pendidikan_ibu', 'd1'); ?>>D1</option>
                                <option value="d2" <?php echo set_select('pendidikan_ibu', 'd2'); ?>>D2</option>
                                <option value="d3" <?php echo set_select('pendidikan_ibu', 'd3'); ?>>D3</option>
                                <option value="s1" <?php echo set_select('pendidikan_ibu', 's1'); ?>>S1</option>
                                <option value="s2" <?php echo set_select('pendidikan_ibu', 's2'); ?>>S2</option>
                                <option value="s3" <?php echo set_select('pendidikan_ibu', 's3'); ?>>S3</option>
                            </select>
                            <?php if(isset($field_errors['pendidikan_ibu'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['pendidikan_ibu']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['pekerjaan_ibu']) ? 'is-invalid' : ''; ?>" 
                                   id="pekerjaan_ibu" name="pekerjaan_ibu"
                                   value="<?php echo set_value('pekerjaan_ibu', isset($input['pekerjaan_ibu']) ? $input['pekerjaan_ibu'] : ''); ?>">
                            <?php if(isset($field_errors['pekerjaan_ibu'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['pekerjaan_ibu']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp_ibu">No. HP Ibu</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['no_hp_ibu']) ? 'is-invalid' : ''; ?>" 
                                   id="no_hp_ibu" name="no_hp_ibu"
                                   value="<?php echo set_value('no_hp_ibu', isset($input['no_hp_ibu']) ? $input['no_hp_ibu'] : ''); ?>">
                            <?php if(isset($field_errors['no_hp_ibu'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['no_hp_ibu']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="alamat_ortu">Alamat Orangtua</label>
                    <textarea class="form-control <?php echo isset($field_errors['alamat_ortu']) ? 'is-invalid' : ''; ?>" 
                              id="alamat_ortu" name="alamat_ortu" rows="2"><?php echo set_value('alamat_ortu', isset($input['alamat_ortu']) ? $input['alamat_ortu'] : ''); ?></textarea>
                    <?php if(isset($field_errors['alamat_ortu'])): ?>
                        <div class="invalid-feedback"><?php echo $field_errors['alamat_ortu']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="saudara_sekolah">Apakah mempunyai saudara kandung yang masih sekolah di MA NU 01 Banyuputih?</label>
                    <select class="form-control <?php echo isset($field_errors['saudara_sekolah']) ? 'is-invalid' : ''; ?>" 
                            id="saudara_sekolah" name="saudara_sekolah">
                        <option value="">-- Pilih Jawaban --</option>
                        <option value="punya" <?php echo set_select('saudara_sekolah', 'punya'); ?>>Punya (Kelas 10/11/12)</option>
                        <option value="tidak_punya" <?php echo set_select('saudara_sekolah', 'tidak_punya'); ?>>Tidak Punya</option>
                    </select>
                    <?php if(isset($field_errors['saudara_sekolah'])): ?>
                        <div class="invalid-feedback"><?php echo $field_errors['saudara_sekolah']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- DATA WALI -->
                <h4 class="section-title">DATA WALI (Jika Ada)</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_wali">Nama Wali</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['nama_wali']) ? 'is-invalid' : ''; ?>" 
                                   id="nama_wali" name="nama_wali"
                                   value="<?php echo set_value('nama_wali', isset($input['nama_wali']) ? $input['nama_wali'] : ''); ?>">
                            <?php if(isset($field_errors['nama_wali'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['nama_wali']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hubungan_wali">Hubungan dengan Siswa</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['hubungan_wali']) ? 'is-invalid' : ''; ?>" 
                                   id="hubungan_wali" name="hubungan_wali"
                                   value="<?php echo set_value('hubungan_wali', isset($input['hubungan_wali']) ? $input['hubungan_wali'] : ''); ?>">
                            <?php if(isset($field_errors['hubungan_wali'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['hubungan_wali']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendidikan_wali">Pendidikan Wali</label>
                            <select class="form-control <?php echo isset($field_errors['pendidikan_wali']) ? 'is-invalid' : ''; ?>" 
                                    id="pendidikan_wali" name="pendidikan_wali">
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="sd" <?php echo set_select('pendidikan_wali', 'sd'); ?>>SD</option>
                                <option value="smp" <?php echo set_select('pendidikan_wali', 'smp'); ?>>SMP</option>
                                <option value="sma" <?php echo set_select('pendidikan_wali', 'sma'); ?>>SMA</option>
                                <option value="d1" <?php echo set_select('pendidikan_wali', 'd1'); ?>>D1</option>
                                <option value="d2" <?php echo set_select('pendidikan_wali', 'd2'); ?>>D2</option>
                                <option value="d3" <?php echo set_select('pendidikan_wali', 'd3'); ?>>D3</option>
                                <option value="s1" <?php echo set_select('pendidikan_wali', 's1'); ?>>S1</option>
                                <option value="s2" <?php echo set_select('pendidikan_wali', 's2'); ?>>S2</option>
                                <option value="s3" <?php echo set_select('pendidikan_wali', 's3'); ?>>S3</option>
                            </select>
                            <?php if(isset($field_errors['pendidikan_wali'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['pendidikan_wali']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pekerjaan_wali">Pekerjaan Wali</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['pekerjaan_wali']) ? 'is-invalid' : ''; ?>" 
                                   id="pekerjaan_wali" name="pekerjaan_wali"
                                   value="<?php echo set_value('pekerjaan_wali', isset($input['pekerjaan_wali']) ? $input['pekerjaan_wali'] : ''); ?>">
                            <?php if(isset($field_errors['pekerjaan_wali'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['pekerjaan_wali']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp_wali">No. HP Wali</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['no_hp_wali']) ? 'is-invalid' : ''; ?>" 
                                   id="no_hp_wali" name="no_hp_wali"
                                   value="<?php echo set_value('no_hp_wali', isset($input['no_hp_wali']) ? $input['no_hp_wali'] : ''); ?>">
                            <?php if(isset($field_errors['no_hp_wali'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['no_hp_wali']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="alamat_wali">Alamat Wali</label>
                    <textarea class="form-control <?php echo isset($field_errors['alamat_wali']) ? 'is-invalid' : ''; ?>" 
                              id="alamat_wali" name="alamat_wali" rows="2"><?php echo set_value('alamat_wali', isset($input['alamat_wali']) ? $input['alamat_wali'] : ''); ?></textarea>
                    <?php if(isset($field_errors['alamat_wali'])): ?>
                        <div class="invalid-feedback"><?php echo $field_errors['alamat_wali']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- SEKOLAH ASAL -->
                <h4 class="section-title">SEKOLAH ASAL</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_sekolah">Nama SMP/MTs</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['nama_sekolah']) ? 'is-invalid' : ''; ?>" 
                                   id="nama_sekolah" name="nama_sekolah"
                                   value="<?php echo set_value('nama_sekolah', isset($input['nama_sekolah']) ? $input['nama_sekolah'] : ''); ?>">
                            <?php if(isset($field_errors['nama_sekolah'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['nama_sekolah']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat_sekolah">Alamat SMP/MTs</label>
                            <input type="text" class="form-control <?php echo isset($field_errors['alamat_sekolah']) ? 'is-invalid' : ''; ?>" 
                                   id="alamat_sekolah" name="alamat_sekolah"
                                   value="<?php echo set_value('alamat_sekolah', isset($input['alamat_sekolah']) ? $input['alamat_sekolah'] : ''); ?>">
                            <?php if(isset($field_errors['alamat_sekolah'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['alamat_sekolah']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">NISN <span class="optional-text">(Tidak Wajib Diisi)</span></label>
                            <input type="text" class="form-control <?php echo isset($field_errors['nisn']) ? 'is-invalid' : ''; ?>" 
                                   id="nisn" name="nisn"
                                   value="<?php echo set_value('nisn', isset($input['nisn']) ? $input['nisn'] : ''); ?>">
                            <?php if(isset($field_errors['nisn'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['nisn']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="piagam">Piagam/Sertifikat (Juara) <span class="optional-text">(Tidak Wajib Diisi)</span></label>
                            <select class="form-control <?php echo isset($field_errors['piagam']) ? 'is-invalid' : ''; ?>" 
                                    id="piagam" name="piagam">
                                <option value="tidak_punya" <?php echo set_select('piagam', 'tidak_punya'); ?>>Tidak Punya</option>
                                <option value="punya" <?php echo set_select('piagam', 'punya'); ?>>Punya</option>
                            </select>
                            <?php if(isset($field_errors['piagam'])): ?>
                                <div class="invalid-feedback"><?php echo $field_errors['piagam']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="motivasi">Motivasi Mendaftar di MA NU 01 Banyuputih</label>
                    <textarea class="form-control <?php echo isset($field_errors['motivasi']) ? 'is-invalid' : ''; ?>" 
                              id="motivasi" name="motivasi" rows="3"><?php echo set_value('motivasi', isset($input['motivasi']) ? $input['motivasi'] : ''); ?></textarea>
                    <?php if(isset($field_errors['motivasi'])): ?>
                        <div class="invalid-feedback"><?php echo $field_errors['motivasi']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-submit">Kirim Pendaftaran</button>
                </div>

            <?php echo form_close(); ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Format tanggal lahir
            $('#tanggal_lahir').on('change', function() {
                var tempatLahir = $('#tempat_lahir').val();
                var tanggalLahir = $(this).val();
                
                if (tanggalLahir) {
                    var date = new Date(tanggalLahir);
                    var options = { day: '2-digit', month: 'short', year: 'numeric' };
                    var formattedDate = date.toLocaleDateString('id-ID', options);
                    
                    if (tempatLahir) {
                        $('#tempat_tanggal_lahir').val(tempatLahir + ', ' + formattedDate);
                    } else {
                        $('#tempat_tanggal_lahir').val(formattedDate);
                    }
                } else if (tempatLahir) {
                    $('#tempat_tanggal_lahir').val(tempatLahir);
                } else {
                    $('#tempat_tanggal_lahir').val('');
                }
            });

            // Format alamat lengkap
            $('#dukuh, #desa, #rt, #rw, #kecamatan, #kabupaten, #provinsi').on('input', function() {
                var dukuh = $('#dukuh').val();
                var desa = $('#desa').val();
                var rt = $('#rt').val();
                var rw = $('#rw').val();
                var kecamatan = $('#kecamatan').val();
                var kabupaten = $('#kabupaten').val();
                var provinsi = $('#provinsi').val();
                
                var alamatLengkap = '';
                
                if (dukuh) alamatLengkap += dukuh;
                if (desa) alamatLengkap += (alamatLengkap ? ', ' : '') + 'Desa ' + desa;
                if (rt || rw) {
                    alamatLengkap += (alamatLengkap ? ', ' : '') + 'RT';
                    if (rt) alamatLengkap += ' ' + rt;
                    if (rw) alamatLengkap += '/RW ' + rw;
                }
                if (kecamatan) alamatLengkap += (alamatLengkap ? ', Kec. ' : 'Kec. ') + kecamatan;
                if (kabupaten) alamatLengkap += (alamatLengkap ? ', Kab. ' : 'Kab. ') + kabupaten;
                if (provinsi) alamatLengkap += (alamatLengkap ? ', Prov. ' : 'Prov. ') + provinsi;
                
                $('#alamat_lengkap').val(alamatLengkap);
            });

            // Tampilkan field lainnya jika dipilih
            $('#tinggal').on('change', function() {
                if ($(this).val() === 'lainnya') {
                    $('#tinggal_lainnya_group').show();
                } else {
                    $('#tinggal_lainnya_group').hide();
                    $('#tinggal_lainnya').val('');
                }
            });

            // Validasi client-side untuk field required
            $('form').submit(function(e) {
                let isValid = true;
                $('[required]').each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                        $(this).next('.invalid-feedback').text('Field ini harus diisi');
                        isValid = false;
                        
                        // Scroll ke field pertama yang error
                        if (isValid === false) {
                            $('html, body').animate({
                                scrollTop: $(this).offset().top - 100
                            }, 500);
                            isValid = null; // Hanya scroll ke field pertama
                        }
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                }
            });

            // Hapus error saat user mulai mengisi
            $('input, select, textarea').on('input change', function() {
                if ($(this).val() !== '') {
                    $(this).removeClass('is-invalid');
                }
            });

            // Inisialisasi field "tinggal_lainnya" jika kembali dari error
            <?php if(isset($input['tinggal']) && $input['tinggal'] == 'lainnya'): ?>
                $('#tinggal_lainnya_group').show();
            <?php endif; ?>
        });
    </script>
</body>
</html>