/**
 * Notification Handler for PPDB Manu
 * This script handles redirections from notification popups
 */

// Function to handle the redirection from the "Lihat Detail Pendaftaran" button
function redirectToDetails(nomorPendaftaran) {
    // Use absolute path to avoid any routing issues
    const baseUrl = window.location.origin + '/ppdb_manu/';
    const detailUrl = baseUrl + 'index.php/ppdb/pendaftaran_sukses/' + nomorPendaftaran;
    
    console.log('Redirecting to:', detailUrl);
    
    // Use a direct window.location.replace for more reliable redirection
    window.location.replace(detailUrl);
    
    // Fallback if replace doesn't work
    setTimeout(function() {
        window.location.href = detailUrl;
    }, 100);
    
    return false; // Prevent default action if used in an onclick handler
}
