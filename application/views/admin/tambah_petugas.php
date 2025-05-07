<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Petugas</title>
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
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%); min-height: 100vh;">
    <div class="row">
        <div class="col-auto p-0">
            <?php include('_sidebar.php'); ?>
        </div>
        <div class="col">
            <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm border-0" style="background:rgba(255,255,255,0.97); border-radius:18px;">
                <div class="card-body p-4">
                    <h2 class="mb-4 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Tambah Petugas</h2>
                    <?php if(isset($success)): ?>
                        <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            <div><?php echo $success; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <div><?php echo $error; ?></div>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo site_url('admin/simpan_petugas'); ?>" method="post">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?php echo site_url('admin'); ?>" class="btn btn-secondary d-flex align-items-center gap-2">
                                <i class="bi bi-arrow-left"></i> Kembali ke Admin
                            </a>
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="bi bi-save"></i> Simpan
                            </button>
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
        </div>
    </div>
</div>
</body>
</html>