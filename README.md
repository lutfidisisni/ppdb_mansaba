# PPDB Madrasah Application

Aplikasi Penerimaan Peserta Didik Baru (PPDB) untuk Madrasah.

## Fitur Utama

- Form pendaftaran peserta didik baru
- Notifikasi sukses dengan nomor pendaftaran
- Halaman detail pendaftaran
- Landing page

## Konfigurasi

### Lingkungan Local (Development)

Aplikasi secara otomatis mendeteksi penggunaan di localhost dengan konfigurasi:

- Base URL: Otomatis terdeteksi
- Database: MySQL (hostname: localhost, username: root, password: kosong)
- Debug: Diaktifkan

### Lingkungan Hosting (Production)

Saat diupload ke hosting, aplikasi akan otomatis menggunakan konfigurasi production:

1. **Pengaturan Database**:
   - Buka file `application/config/database.php`
   - Edit bagian `$prod_config` dengan kredensial database hosting:
     ```php
     $prod_config = array(
         'username'  => 'username_hosting', // Ganti dengan username database hosting
         'password'  => 'password_hosting', // Ganti dengan password database hosting
         'database'  => 'nama_database',    // Ganti dengan nama database di hosting
         ...
     );
     ```

2. **Struktur Database**:
   - Import file SQL yang sama yang digunakan di localhost ke database hosting

## Upload ke Hosting

1. Upload seluruh folder `ppdb_manu` ke folder `public_html` atau `www` di hosting
2. Pastikan setting database sudah diubah sesuai kredensial hosting
3. Pastikan mode debug dimatikan di lingkungan production (`db_debug` => FALSE)

## Troubleshooting

### Redirect tidak berfungsi
- Pastikan file `.htaccess` sudah diupload dengan benar
- Pastikan hosting mendukung `mod_rewrite`

### Error Database
- Verifikasi kredensial database di file konfigurasi
- Pastikan database sudah dibuat dan struktur tabel sudah diimport

## Note Penting

Aplikasi ini dirancang dengan fitur auto-detect environment, sehingga akan berjalan dengan lancar baik di localhost (development) maupun di hosting (production) tanpa perlu banyak perubahan konfigurasi. Yang perlu diubah hanya kredensial database untuk environment production.
