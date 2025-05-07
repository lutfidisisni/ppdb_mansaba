<script>
$(document).ready(function() {
    // ... existing code ...

    $('#formPendaftaran').on('submit', function(e) {
        e.preventDefault();
        
        // Disable submit button and show loading state
        const submitBtn = $(this).find('button[type="submit"]');
        const originalBtnText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
        
        // Create FormData object to handle file uploads
        const formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response); // Debug log
                
                if (response.status === true) {
                    // Show success message with green checkmark
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message || 'Pendaftaran berhasil disimpan',
                        showConfirmButton: false,
                        timer: 2000,
                        willClose: () => {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        }
                    });
                } else {
                    // Show error message with red X
                    Swal.fire({
                        icon: 'error',
                        title: 'Pendaftaran Gagal',
                        text: response.message || 'Terjadi kesalahan saat menyimpan data.',
                        showConfirmButton: true
                    });
                    // Re-enable submit button
                    submitBtn.prop('disabled', false).html(originalBtnText);
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', {xhr, status, error}); // Debug log
                
                let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Pendaftaran Gagal',
                    text: errorMessage,
                    showConfirmButton: true
                });
                
                // Re-enable submit button
                submitBtn.prop('disabled', false).html(originalBtnText);
            }
        });
    });
    
    // Function to update alamat lengkap
    function updateAlamatLengkap() {
        const dukuh = $('#dukuh').val();
        const rt = $('#rt').val();
        const rw = $('#rw').val();
        const desa = $('#desa').val();
        const kecamatan = $('#kecamatan').val();
        const kabupaten = $('#kabupaten').val();
        const provinsi = $('#provinsi').val();

        let alamatLengkap = '';

        if (dukuh) alamatLengkap += dukuh;
        if (rt || rw) {
            if (alamatLengkap) alamatLengkap += ', ';
            alamatLengkap += `RT ${rt}/RW ${rw}`;
        }
        if (desa) {
            if (alamatLengkap) alamatLengkap += ', ';
            alamatLengkap += `Desa ${desa}`;
        }
        if (kecamatan) {
            if (alamatLengkap) alamatLengkap += ', ';
            alamatLengkap += `Kecamatan ${kecamatan}`;
        }
        if (kabupaten) {
            if (alamatLengkap) alamatLengkap += ', ';
            alamatLengkap += `${kabupaten}`;
        }
        if (provinsi) {
            if (alamatLengkap) alamatLengkap += ', ';
            alamatLengkap += provinsi;
        }

        $('#alamat_lengkap').val(alamatLengkap);
    }

    // Add event listeners to address fields
    $('#dukuh, #rt, #rw, #desa, #kecamatan, #kabupaten, #provinsi').on('change keyup', function() {
        updateAlamatLengkap();
    });
    
    // ... existing code ...
});
</script> 