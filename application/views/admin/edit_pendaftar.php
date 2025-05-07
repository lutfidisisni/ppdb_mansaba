<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .section-title {
            color: #1976d2;
            border-bottom: 2px solid #1976d2;
            padding-bottom: 10px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center mb-4">Edit Data Pendaftar</h2>
                
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php echo form_open('admin/update_pendaftar/'.$pendaftar['id']); ?>

                <!-- Rekomendasi & Jalur Pendaftaran -->
                <h4 class="section-title">Rekomendasi & Jalur Pendaftaran</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Nomor Pendaftaran</label>
                            <input type="text" class="form-control" value="<?php echo $pendaftar['no_pendaftaran']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Rekomendasi</label>
                            <input type="text" name="rekomendasi" class="form-control" value="<?php echo $pendaftar['rekomendasi']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Jalur Pendaftaran</label>
                            <select name="jalur_pendaftaran" class="form-control">
                                <option value="Reguler" <?php echo $pendaftar['jalur_pendaftaran'] == 'Reguler' ? 'selected' : ''; ?>>Reguler (Umum)</option>
                                <option value="Prestasi" <?php echo $pendaftar['jalur_pendaftaran'] == 'Prestasi' ? 'selected' : ''; ?>>Prestasi</option>
                                <option value="Sosial" <?php echo $pendaftar['jalur_pendaftaran'] == 'Sosial' ? 'selected' : ''; ?>>Sosial</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Pilihan Program (Peminatan)</label>
                    <select name="pilihan_program" class="form-control">
                        <option value="MIPA" <?php echo $pendaftar['pilihan_program'] == 'MIPA' ? 'selected' : ''; ?>>MIPA</option>
                        <option value="IPS" <?php echo $pendaftar['pilihan_program'] == 'IPS' ? 'selected' : ''; ?>>IPS</option>
                        <option value="Bahasa" <?php echo $pendaftar['pilihan_program'] == 'Bahasa' ? 'selected' : ''; ?>>Bahasa</option>
                        <option value="AGM" <?php echo $pendaftar['pilihan_program'] == 'AGM' ? 'selected' : ''; ?>>AGM</option>
                        <option value="Tahfidz" <?php echo $pendaftar['pilihan_program'] == 'Tahfidz' ? 'selected' : ''; ?>>Tahfidz</option>
                    </select>
                </div>

                <!-- DATA PESERTA DIDIK -->
                <h4 class="section-title">DATA PESERTA DIDIK</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_siswa" class="form-control" value="<?php echo $pendaftar['nama_siswa']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="Laki-laki" <?php echo $pendaftar['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php echo $pendaftar['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $pendaftar['tempat_lahir']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $pendaftar['tanggal_lahir']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>No. HP / WhatsApp</label>
                            <input type="text" name="no_hp_siswa" class="form-control" value="<?php echo $pendaftar['no_hp_siswa']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Status Tinggal</label>
                            <select name="tinggal" class="form-control" required>
                                <option value="Bersama Orang tua" <?php echo $pendaftar['tinggal'] == 'Bersama Orang tua' ? 'selected' : ''; ?>>Bersama Orang tua</option>
                                <option value="Bersama Wali" <?php echo $pendaftar['tinggal'] == 'Bersama Wali' ? 'selected' : ''; ?>>Bersama Wali</option>
                                <option value="Bersama Kakak" <?php echo $pendaftar['tinggal'] == 'Bersama Kakak' ? 'selected' : ''; ?>>Bersama Kakak</option>
                                <option value="Tinggal Sendiri" <?php echo $pendaftar['tinggal'] == 'Tinggal Sendiri' ? 'selected' : ''; ?>>Tinggal Sendiri</option>
                                <option value="Lainnya" <?php echo $pendaftar['tinggal'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" class="form-control" rows="2"><?php echo $pendaftar['alamat_lengkap']; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- DATA SEKOLAH -->
                <h4 class="section-title">DATA SEKOLAH</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control" value="<?php echo $pendaftar['nama_sekolah']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>NISN</label>
                            <input type="text" name="nisn" class="form-control" value="<?php echo $pendaftar['nisn']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Alamat Sekolah</label>
                    <textarea name="alamat_sekolah" class="form-control" rows="2" required><?php echo $pendaftar['alamat_sekolah']; ?></textarea>
                </div>

                <!-- DATA ORANG TUA -->
                <h4 class="section-title">DATA ORANG TUA</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" value="<?php echo $pendaftar['nama_ayah']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" value="<?php echo $pendaftar['nama_ibu']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Pendidikan Ayah</label>
                            <select name="pendidikan_ayah" class="form-control" required>
                                <option value="SD" <?php echo $pendaftar['pendidikan_ayah'] == 'SD' ? 'selected' : ''; ?>>SD / Sederajat</option>
                                <option value="SMP" <?php echo $pendaftar['pendidikan_ayah'] == 'SMP' ? 'selected' : ''; ?>>SMP / Sederajat</option>
                                <option value="SMA" <?php echo $pendaftar['pendidikan_ayah'] == 'SMA' ? 'selected' : ''; ?>>SMA / Sederajat</option>
                                <option value="D1" <?php echo $pendaftar['pendidikan_ayah'] == 'D1' ? 'selected' : ''; ?>>D1</option>
                                <option value="D2" <?php echo $pendaftar['pendidikan_ayah'] == 'D2' ? 'selected' : ''; ?>>D2</option>
                                <option value="D3" <?php echo $pendaftar['pendidikan_ayah'] == 'D3' ? 'selected' : ''; ?>>D3</option>
                                <option value="S1" <?php echo $pendaftar['pendidikan_ayah'] == 'S1' ? 'selected' : ''; ?>>S1</option>
                                <option value="S2" <?php echo $pendaftar['pendidikan_ayah'] == 'S2' ? 'selected' : ''; ?>>S2</option>
                                <option value="S3" <?php echo $pendaftar['pendidikan_ayah'] == 'S3' ? 'selected' : ''; ?>>S3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" class="form-control" value="<?php echo $pendaftar['pekerjaan_ayah']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>No. HP Ayah</label>
                            <input type="text" name="no_hp_ayah" class="form-control" value="<?php echo $pendaftar['no_hp_ayah']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Pendidikan Ibu</label>
                            <select name="pendidikan_ibu" class="form-control" required>
                                <option value="SD" <?php echo $pendaftar['pendidikan_ibu'] == 'SD' ? 'selected' : ''; ?>>SD / Sederajat</option>
                                <option value="SMP" <?php echo $pendaftar['pendidikan_ibu'] == 'SMP' ? 'selected' : ''; ?>>SMP / Sederajat</option>
                                <option value="SMA" <?php echo $pendaftar['pendidikan_ibu'] == 'SMA' ? 'selected' : ''; ?>>SMA / Sederajat</option>
                                <option value="D1" <?php echo $pendaftar['pendidikan_ibu'] == 'D1' ? 'selected' : ''; ?>>D1</option>
                                <option value="D2" <?php echo $pendaftar['pendidikan_ibu'] == 'D2' ? 'selected' : ''; ?>>D2</option>
                                <option value="D3" <?php echo $pendaftar['pendidikan_ibu'] == 'D3' ? 'selected' : ''; ?>>D3</option>
                                <option value="S1" <?php echo $pendaftar['pendidikan_ibu'] == 'S1' ? 'selected' : ''; ?>>S1</option>
                                <option value="S2" <?php echo $pendaftar['pendidikan_ibu'] == 'S2' ? 'selected' : ''; ?>>S2</option>
                                <option value="S3" <?php echo $pendaftar['pendidikan_ibu'] == 'S3' ? 'selected' : ''; ?>>S3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" class="form-control" value="<?php echo $pendaftar['pekerjaan_ibu']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>No. HP Ibu</label>
                            <input type="text" name="no_hp_ibu" class="form-control" value="<?php echo $pendaftar['no_hp_ibu']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Alamat Orang Tua</label>
                    <textarea name="alamat_ortu" class="form-control" rows="2"><?php echo $pendaftar['alamat_ortu']; ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label>Saudara yang Sekolah di MA NU 01 Banyuputih</label>
                    <input type="text" name="saudara_sekolah" class="form-control" value="<?php echo $pendaftar['saudara_sekolah']; ?>">
                </div>

                <!-- DATA WALI -->
                <h4 class="section-title">DATA WALI</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Nama Wali</label>
                            <input type="text" name="nama_wali" class="form-control" value="<?php echo $pendaftar['nama_wali']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Hubungan dengan Wali</label>
                            <input type="text" name="hubungan_wali" class="form-control" value="<?php echo $pendaftar['hubungan_wali']; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Pendidikan Wali</label>
                            <select name="pendidikan_wali" class="form-control">
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="SD" <?php echo $pendaftar['pendidikan_wali'] == 'SD' ? 'selected' : ''; ?>>SD / Sederajat</option>
                                <option value="SMP" <?php echo $pendaftar['pendidikan_wali'] == 'SMP' ? 'selected' : ''; ?>>SMP / Sederajat</option>
                                <option value="SMA" <?php echo $pendaftar['pendidikan_wali'] == 'SMA' ? 'selected' : ''; ?>>SMA / Sederajat</option>
                                <option value="D1" <?php echo $pendaftar['pendidikan_wali'] == 'D1' ? 'selected' : ''; ?>>D1</option>
                                <option value="D2" <?php echo $pendaftar['pendidikan_wali'] == 'D2' ? 'selected' : ''; ?>>D2</option>
                                <option value="D3" <?php echo $pendaftar['pendidikan_wali'] == 'D3' ? 'selected' : ''; ?>>D3</option>
                                <option value="S1" <?php echo $pendaftar['pendidikan_wali'] == 'S1' ? 'selected' : ''; ?>>S1</option>
                                <option value="S2" <?php echo $pendaftar['pendidikan_wali'] == 'S2' ? 'selected' : ''; ?>>S2</option>
                                <option value="S3" <?php echo $pendaftar['pendidikan_wali'] == 'S3' ? 'selected' : ''; ?>>S3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Pekerjaan Wali</label>
                            <input type="text" name="pekerjaan_wali" class="form-control" value="<?php echo $pendaftar['pekerjaan_wali']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>No. HP Wali</label>
                            <input type="text" name="no_hp_wali" class="form-control" value="<?php echo $pendaftar['no_hp_wali']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Alamat Wali</label>
                    <textarea name="alamat_wali" class="form-control" rows="2"><?php echo $pendaftar['alamat_wali']; ?></textarea>
                </div>

                <div class="text-center mt-4">
                    <a href="<?php echo site_url('admin/data_pendaftar_lengkap'); ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 