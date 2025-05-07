<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%); min-height: 100vh; }
        .login-container { max-width: 400px; margin: 100px auto; }
    </style>
</head>
<body>
<div class="login-container">
    <div class="card shadow-sm border-0" style="background:rgba(255,255,255,0.97); border-radius:18px;">
        <div class="card-body p-4">
            <h4 class="mb-4 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Login Admin</h4>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <div><?php echo $this->session->flashdata('error'); ?></div>
                </div>
            <?php endif; ?>
            <form method="post" action="<?php echo site_url('auth/do_login'); ?>">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100 d-flex align-items-center gap-2 justify-content-center" type="submit">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </form>
        </div>
    </div>
    <footer class="mt-5 text-center text-muted small" style="opacity:0.7;">
        &copy; <?php echo date('Y'); ?> PPDB MANU Admin. All rights reserved.
    </footer>
</div>
</body>
</html> 