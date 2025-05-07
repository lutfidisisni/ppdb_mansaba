<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Notifikasi PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/js/notification-handler.js') ?>"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .test-card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            border: none;
        }
        .card-header {
            background-color: #198754;
            color: white;
            font-weight: 600;
            padding: 15px 20px;
        }
        .test-btn {
            margin: 10px 0;
            padding: 12px 20px;
            font-weight: 500;
        }
        .test-btn-direct {
            background-color: #198754;
            border-color: #198754;
        }
        .test-btn-ajax {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card test-card">
                    <div class="card-header">
                        <i class="fas fa-bell me-2"></i>Halaman Test Notifikasi PPDB
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Halaman ini digunakan untuk menguji notifikasi sukses tanpa perlu mengisi form pendaftaran lengkap.
                        </div>
                        
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Jika tombol Lihat Detail Pendaftaran tidak berfungsi:</h5>
                            <p>Gunakan link di bawah ini setelah menjalankan Test Halaman Sukses Langsung:</p>
                            <div id="direct-link-container" class="d-none mt-2">
                                <a id="direct-detail-link" href="#" class="btn btn-success">
                                    <i class="fas fa-external-link-alt me-1"></i> Buka Detail Pendaftaran (Direct Link)
                                </a>
                            </div>
                        </div>
                        
                        <h5 class="mb-3">Pilih Metode Test:</h5>
                        
                        <div class="d-grid gap-3">
                            <a href="<?= base_url('test-detail.php') ?>" class="btn btn-success test-btn test-btn-direct">
                                <i class="fas fa-check-circle me-2"></i>Test Halaman Sukses Langsung
                            </a>
                            
                            <button id="test-ajax-btn" class="btn btn-primary test-btn test-btn-ajax">
                                <i class="fas fa-sync me-2"></i>Test Notifikasi AJAX
                            </button>
                            
                            <a href="<?= base_url('test-detail.php?nomor=TEST'.rand(10000,99999)) ?>" class="btn btn-warning test-btn">
                                <i class="fas fa-external-link-alt me-2"></i>Buka Detail Langsung (Metode Alternatif)
                            </a>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <a href="<?= base_url('ppdb/form_pendaftaran') ?>" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i>Kembali ke Formulir Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            // Variable to store current registration number
            var currentNomorPendaftaran = null;
            
            // Function to update direct link
            function updateDirectLink(nomor) {
                currentNomorPendaftaran = nomor;
                
                // Show the direct link container
                $('#direct-link-container').removeClass('d-none');
                
                // Create an absolute URL to the success page
                var baseUrl = window.location.origin + '/ppdb_manu/index.php/ppdb/pendaftaran_sukses/';
                var detailUrl = baseUrl + nomor;
                
                // Update the direct link href
                $('#direct-detail-link').attr('href', detailUrl);
                
                // Console logging for debugging
                console.log('Direct link updated to:', detailUrl);
            }
            
            // AJAX test button
            $('#test-ajax-btn').click(function() {
                $.ajax({
                    url: '<?= base_url("ppdb/test_success_ajax") ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        // Update the direct link with the new registration number
                        updateDirectLink(response.nomor_pendaftaran);
                        
                        Swal.fire({
                            title: '<strong>Pendaftaran Berhasil!</strong>',
                            icon: 'success',
                            html: '<p>Terima kasih telah mendaftar. Nomor pendaftaran Anda adalah:</p>' +
                                  '<h3 class="text-success mb-4">' + response.nomor_pendaftaran + '</h3>' +
                                  '<p>Silahkan catat nomor pendaftaran Anda untuk keperluan selanjutnya.</p>',
                            showCloseButton: true,
                            showCancelButton: false,
                            focusConfirm: true,
                            confirmButtonText: 'Kembali ke Halaman Utama',
                            confirmButtonColor: '#198754'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Langsung kembali ke halaman utama aplikasi
                                window.location.href = '<?= base_url() ?>';
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menguji notifikasi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
