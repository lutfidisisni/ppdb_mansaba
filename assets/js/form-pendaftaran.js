$(document).ready(function() {
    // Inisialisasi Select2
    $('.select2').select2();
    
    // Inisialisasi Datepicker
    $('#tanggal_lahir').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
    
    // Handle section navigation
    $('.section-nav').click(function() {
        const section = $(this).data('section');
        $('.section-nav').removeClass('active');
        $(this).addClass('active');
        $('.form-section').removeClass('active');
        $(`#${section}`).addClass('active');
    });
    
    // Update tempat tanggal lahir otomatis
    function updateTempatTanggalLahir() {
        const tempat = $('#tempat_lahir').val();
        const tanggal = $('#tanggal_lahir').val();
        if(tempat && tanggal) {
            const tanggalFormatted = new Date(tanggal).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            $('#tempat_tanggal_lahir').val(`${tempat}, ${tanggalFormatted}`);
        }
    }
    
    $('#tempat_lahir, #tanggal_lahir').change(updateTempatTanggalLahir);
    
    // Update alamat lengkap otomatis
    function updateAlamatLengkap() {
        const dukuh = $('#dukuh').val();
        const rt = $('#rt').val();
        const rw = $('#rw').val();
        const desa = $('#desa').val();
        const kecamatan = $('#kecamatan').val();
        const kabupaten = $('#kabupaten').val();
        const provinsi = $('#provinsi').val();
        
        if(dukuh && rt && rw && desa && kecamatan && kabupaten && provinsi) {
            $('#alamat_lengkap').val(
                `${dukuh}, RT ${rt}/RW ${rw}, ${desa}, ${kecamatan}, ${kabupaten}, ${provinsi}`
            );
        }
    }
    
    $('#dukuh, #rt, #rw, #desa, #kecamatan, #kabupaten, #provinsi').change(updateAlamatLengkap);
    
    // Form submission
    $('#formPendaftaran').submit(function(e) {
        e.preventDefault();
        
        // Show loading overlay
        $('.loading-overlay').css('display', 'flex');
        
        // Submit form dengan AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('.loading-overlay').hide();
                
                if(response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pendaftaran Berhasil!',
                        text: `Nomor pendaftaran Anda: ${response.nomor_pendaftaran}`,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'success?nomor=' + response.nomor_pendaftaran;
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                $('.loading-overlay').hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});