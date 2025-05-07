<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .success-card {
            max-width: 700px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .success-header {
            background-color: #198754;
            color: white;
            padding: 20px;
            text-align: center;
            font-weight: 500;
        }
        .success-content {
            padding: 30px;
        }
        .registration-number {
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            margin: 20px 0;
            color: #198754;
        }
        .detail-row {
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .detail-label {
            font-weight: 500;
            color: #555;
        }
        .btn-print {
            background-color: #198754;
            border-color: #198754;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-print:hover {
            background-color: #157347;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Success Notification -->
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <strong><i class="fas fa-check-circle me-2"></i> Pendaftaran Berhasil!</strong> 
            <p class="mb-0">Data Anda telah tersimpan dalam sistem. Nomor pendaftaran Anda adalah <strong><?= $pendaftaran->no_pendaftaran ?></strong></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        <div class="success-card">
            <div class="success-header">
                <h2><i class="fas fa-check-circle me-2"></i> Pendaftaran Berhasil</h2>
            </div>
            <div class="success-content">
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-info-circle me-2"></i> Data pendaftaran Anda telah berhasil disimpan dalam sistem.
                </div>
                
                <h4 class="text-center mb-3">Nomor Pendaftaran Anda:</h4>
                <div class="registration-number"><?= $pendaftaran->no_pendaftaran ?></div>
                
                <p class="text-center text-muted mb-4">Harap catat atau simpan nomor pendaftaran ini untuk keperluan selanjutnya.</p>
                
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Data Pendaftar</h5>
                    </div>
                    <div class="card-body">
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Nama Lengkap</div>
                            <div class="col-md-8"><?= $pendaftaran->nama_siswa ?></div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Tempat, Tanggal Lahir</div>
                            <div class="col-md-8"><?= $pendaftaran->tempat_lahir . ', ' . date('d F Y', strtotime($pendaftaran->tanggal_lahir)) ?></div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Jenis Kelamin</div>
                            <div class="col-md-8"><?= $pendaftaran->jenis_kelamin ?></div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Asal Sekolah</div>
                            <div class="col-md-8"><?= $pendaftaran->nama_sekolah ?></div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Pilihan Program</div>
                            <div class="col-md-8"><?= $pendaftaran->pilihan_program ?></div>
                        </div>
                        <div class="row detail-row">
                            <div class="col-md-4 detail-label">Tanggal Pendaftaran</div>
                            <div class="col-md-8"><?= date('d F Y H:i', strtotime($pendaftaran->tanggal_daftar)) ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> Silahkan cetak bukti pendaftaran dan bawa saat melakukan daftar ulang.
                </div>
                
                <div class="text-center mt-4">
                    <button onclick="window.print()" class="btn btn-print me-2">
                        <i class="fas fa-print me-2"></i> Cetak Bukti Pendaftaran
                    </button>
                    <a href="<?= base_url() ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-home me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Show a notification that registration was successful
        $(document).ready(function() {
            // Create a Bootstrap toast notification
            const toastHTML = `
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="successToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
                        <div class="toast-header bg-success text-white">
                            <strong class="me-auto"><i class="fas fa-check-circle"></i> Sukses!</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <strong>Pendaftaran berhasil disimpan!</strong><br>
                            Nomor pendaftaran Anda: <strong><?= $pendaftaran->no_pendaftaran ?></strong>
                        </div>
                    </div>
                </div>
            `;
            
            // Add toast to body
            $('body').append(toastHTML);
            
            // Initialize and show the toast
            var successToast = new bootstrap.Toast(document.getElementById('successToast'))
            successToast.show();
        });
    </script>
</body>
</html>
