<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Tahun Pelajaran & Gelombang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%);
        }
    </style>
</head>
<body>
<div class="container-fluid p-0">
    <div class="row">
        <?php $this->load->view('admin/_sidebar'); ?>
        <div class="col p-4 main-content">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                <div class="col-md-9">
                    <div class="card shadow-sm border-0" style="background:rgba(255,255,255,0.97); border-radius:18px;">
                        <div class="card-body p-4">
                            <h2 class="mb-4 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Pengaturan Tahun Pelajaran & Gelombang</h2>
                            <?php if (isset($this) && $this->session->flashdata('success')): ?>
                                <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    <div><?php echo $this->session->flashdata('success'); ?></div>
                                </div>
                            <?php endif; ?>
                            <form method="post" action="<?php echo site_url('admin/update_pengaturan'); ?>" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="tahun_pelajaran" class="form-label">Tahun Pelajaran (misal: 2526 untuk 2025/2026)</label>
                                    <input type="text" class="form-control" id="tahun_pelajaran" name="tahun_pelajaran" value="<?php echo htmlspecialchars($tahun_pelajaran); ?>" required maxlength="4">
                                </div>
                                <div class="mb-3">
                                    <label for="gelombang" class="form-label">Gelombang</label>
                                    <select class="form-select" id="gelombang" name="gelombang" required>
                                        <option value="1" <?php echo ($gelombang == '1') ? 'selected' : ''; ?>>Gelombang 1</option>
                                        <option value="2" <?php echo ($gelombang == '2') ? 'selected' : ''; ?>>Gelombang 2</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kop_sekolah" class="form-label">Kop Sekolah (file harus bernama : kop_sekolah.jpg)</label>
                                    <input type="file" class="form-control" id="kop_sekolah" name="kop_sekolah" accept="image/*" onchange="validateImage(this)">
                                    <script>
                                    function validateImage(input) {
                                        if (input.files && input.files[0]) {
                                            const fileName = 'kop_sekolah.jpg';
                                            const fileExtension = fileName.split('.').pop().toLowerCase();
                                            if (fileExtension !== 'jpg' && fileExtension !== 'jpeg') {
                                                alert('File harus berupa gambar dengan format JPG/JPEG');
                                                input.value = '';
                                                return false;
                                            }
                                            const formData = new FormData();
                                            formData.append('file', input.files[0], fileName);
                                            fetch('<?php echo site_url('admin/upload_kop'); ?>', {
                                                method: 'POST',
                                                body: formData
                                            }).then(response => {
                                                if (response.ok) {
                                                    document.getElementById('preview-kop').src = '<?php echo base_url('assets/img/'); ?>' + fileName;
                                                    document.getElementById('preview-kop').style.display = 'block';
                                                }
                                            });
                                            return true;
                                        }

                                        if (input.files && input.files[0]) {
                                            const fileName = 'kop_sekolah.jpg';
                                            if (!fileName.endsWith('.jpg') && !fileName.endsWith('.jpeg')) {
                                                alert('File harus berupa gambar dengan format JPG/JPEG');
                                                input.value = '';
                                                return false;
                                            }
                                            return true;
                                        }
                                    }
                                    </script>
                                    <div class="mt-2">
                                        <img id="preview-kop" src="<?php echo isset($kop_sekolah) ? base_url($kop_sekolah) : ''; ?>" class="img-fluid" style="max-width: 100%; max-height: 200px; display: <?php echo isset($kop_sekolah) ? 'block' : 'none'; ?>;">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                        <i class="bi bi-save"></i> Simpan Pengaturan
                                    </button>
                                    <a href="<?php echo site_url('admin'); ?>" class="btn btn-secondary d-flex align-items-center gap-2">
                                        <i class="bi bi-arrow-left"></i> Kembali ke Halaman Admin
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="mt-5 text-center text-muted small" style="opacity:0.7;">
                &copy; <?php echo date('Y'); ?> PPDB MANU Admin. All rights reserved.
            </footer>
        </div>
    </div>
</div>
<script>
    document.getElementById('kop_sekolah').addEventListener('change', function(event) {
        const preview = document.getElementById('preview-kop');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    });
</script>
</body>
</html>