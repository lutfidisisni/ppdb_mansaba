<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Daftar Ulang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; }
        .bukti-outer { max-width: 1200px; margin: 0 auto; }
        .bukti-container { display: flex; gap: 70px; justify-content: center; }
        .bukti-card { border: 1px solid #222; border-radius: 6px; width: 500px; padding: 22px 22px 10px 22px; min-height: 420px; position: relative; background: #fff; }
        .bukti-card:first-child { margin-right: 0; }
        .kop { text-align: center; margin-bottom: 8px; }
        .kop img { height: 60px; margin-bottom: 4px; }
        .kop-title { font-weight: bold; font-size: 16px; line-height: 1.2; }
        .kop-title span { font-size: 18px; display: block; }
        .bukti-title { background: #222; color: #fff; font-weight: bold; text-align: center; padding: 4px 0; margin: 10px 0 14px 0; font-size: 15px; letter-spacing: 1px; }
        .bukti-title.peserta { background: #fff; color: #222; border-bottom: 3px solid #d00; }
        .bukti-title.panitia { background: #d00; color: #fff; }
        .table-bukti th { width: 140px; font-weight: 500; padding: 2px 0; }
        .table-bukti td { padding: 2px 0; }
        .berkas-list { margin: 10px 0 10px 0; }
        .berkas-item { display: flex; align-items: center; margin-bottom: 2px; }
        .berkas-item label { margin-left: 6px; margin-bottom: 0; }
        .berkas-item .check { width: 16px; height: 16px; border: 1.5px solid #222; display: inline-block; text-align: center; line-height: 14px; font-size: 15px; border-radius: 2px; }
        .berkas-item.checked .check { background: #222; color: #fff; font-weight: bold; }
        .berkas-item.checked label { font-weight: 500; }
        .nominal-box { display: inline-block; background: #222; color: #fff; font-weight: bold; padding: 2px 16px; border-radius: 4px; font-size: 16px; margin-left: 8px; }
        .catatan { font-size: 13px; background: #f7f7f7; border: 1px solid #ccc; border-radius: 4px; padding: 6px 10px; margin-top: 10px; }
        .ttd { margin-top: 32px; text-align: right; font-size: 14px; }
        .ttd .nama { margin-top: 60px; font-weight: bold; text-decoration: underline; }
        @media print {
            .btn-print { display: none; }
            .bukti-container { gap: 70px !important; }
            .bukti-card:first-child { margin-right: 0 !important; }
            .bukti-outer { max-width: none; }
        }
    </style>
</head>
<body>
<div class="bukti-outer">
<div class="bukti-container">
    <!-- Untuk Peserta -->
    <div class="bukti-card">
        <div class="kop">
            <img src="<?php echo base_url('assets/img/kop_ma_nu.jpg'); ?>" alt="Logo" />
            <div class="kop-title">
                PANITIA PENDAFTARAN PESERTA DIDIK BARU<br>
                <span>MA NU 01 BANYUPUTIH</span>
                TAHUN PELAJARAN 2025/2026
            </div>
        </div>
        <div class="bukti-title peserta">BUKTI DAFTAR ULANG</div>
        <table class="table-bukti">
            <tr><th>Nomor Pendaftaran</th><td>: <?php echo $pendaftar->no_pendaftaran ?? '-'; ?></td></tr>
            <tr><th>Nama Pendaftar</th><td>: <?php echo $pendaftar->nama_siswa ?? '-'; ?></td></tr>
            <tr><th>Asal Sekolah</th><td>: <?php echo $pendaftar->nama_sekolah ?? '-'; ?></td></tr>
            <tr><th>Alamat</th><td>: <?php echo $pendaftar->alamat_lengkap ?? '-'; ?></td></tr>
            <tr><th>No. Daftar Ulang</th><td>: <?php echo $daftar_ulang->no_daftar_ulang ?? '-'; ?></td></tr>
        </table>
        <div class="berkas-list">
            <div class="berkas-item<?php if($daftar_ulang->kk_asli) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->kk_asli) echo '✓'; ?></span>
                <label>KK/Akte (asli)</label>
            </div>
            <div class="berkas-item<?php if($daftar_ulang->skl) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->skl) echo '✓'; ?></span>
                <label>Surat Kelulusan (asli)</label>
            </div>
            <div class="berkas-item<?php if($daftar_ulang->kk_asli) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->kk_asli) echo '✓'; ?></span>
                <label>Fotocopi KK/Akte</label>
            </div>
            <div class="berkas-item<?php if($daftar_ulang->piagam) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->piagam) echo '✓'; ?></span>
                <label>Fotocopi Piagam / Sertifikat Juara</label>
            </div>
            <div class="berkas-item<?php if($daftar_ulang->sktm) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->sktm) echo '✓'; ?></span>
                <label>SKTM / Surat Rekom PRNU</label>
            </div>
            <div class="berkas-item checked">
                <span class="check">✓</span>
                <label>Daftar Ulang <span class="nominal-box">Rp <?php echo number_format($daftar_ulang->nominal_daftar_ulang,0,',','.'); ?></span></label>
            </div>
        </div>
        <div class="catatan">
            Selamat bergabung di Madrasah Hebat, MA NU 01 Banyuputih.<br>
            Info keberangkatan pertama akan di informasikan di grup Whatsapp Siswa Baru 2025
        </div>
        <div class="ttd">
            Banyuputih, <?php echo date('n/j/Y', strtotime($daftar_ulang->tanggal_daftar_ulang ?? 'now')); ?><br>
            Panitia PPDB<br>
            <span class="nama">Saniyah, S.H.</span>
        </div>
    </div>
    <!-- Untuk Panitia -->
    <div class="bukti-card">
        <div class="kop">
            <img src="<?php echo base_url('assets/img/kop_ma_nu.jpg'); ?>" alt="Logo" />
            <div class="kop-title">
                PANITIA PENDAFTARAN PESERTA DIDIK BARU<br>
                <span>MA NU 01 BANYUPUTIH</span>
                TAHUN PELAJARAN 2025/2026
            </div>
        </div>
        <div class="bukti-title peserta">BUKTI DAFTAR ULANG (ARSIP)</div>
        <table class="table-bukti">
            <tr><th>Nomor Pendaftaran</th><td>: <?php echo $pendaftar->no_pendaftaran ?? '-'; ?></td></tr>
            <tr><th>Nama Pendaftar</th><td>: <?php echo $pendaftar->nama_siswa ?? '-'; ?></td></tr>
            <tr><th>Asal Sekolah</th><td>: <?php echo $pendaftar->nama_sekolah ?? '-'; ?></td></tr>
            <tr><th>Alamat</th><td>: <?php echo $pendaftar->alamat_lengkap ?? '-'; ?></td></tr>
            <tr><th>No. Daftar Ulang</th><td>: <?php echo $daftar_ulang->no_daftar_ulang ?? '-'; ?></td></tr>
        </table>
        <div class="berkas-list">
            <div class="berkas-item<?php if($daftar_ulang->kk_asli) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->kk_asli) echo '✓'; ?></span>
                <label>KK/Akte (asli)</label>
            </div>
            <div class="berkas-item<?php if($daftar_ulang->skl) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->skl) echo '✓'; ?></span>
                <label>Surat Kelulusan (asli)</label>
            </div>
            <div class="berkas-item<?php if($daftar_ulang->kk_asli) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->kk_asli) echo '✓'; ?></span>
                <label>Fotocopi KK/Akte</label>
            </div>
            <div class="berkas-item<?php if($daftar_ulang->piagam) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->piagam) echo '✓'; ?></span>
                <label>Fotocopi Piagam / Sertifikat Juara</label>
            </div>
            <div class="berkas-item<?php if($daftar_ulang->sktm) echo ' checked'; ?>">
                <span class="check"><?php if($daftar_ulang->sktm) echo '✓'; ?></span>
                <label>SKTM / Surat Rekom PRNU</label>
            </div>
            <div class="berkas-item checked">
                <span class="check">✓</span>
                <label>Daftar Ulang <span class="nominal-box">Rp <?php echo number_format($daftar_ulang->nominal_daftar_ulang,0,',','.'); ?></span></label>
            </div>
        </div>
        <div class="catatan">
            Selamat bergabung di Madrasah Hebat, MA NU 01 Banyuputih.<br>
            Info keberangkatan pertama akan di informasikan di grup Whatsapp Siswa Baru 2025
        </div>
        <div class="ttd">
            Banyuputih, <?php echo date('n/j/Y', strtotime($daftar_ulang->tanggal_daftar_ulang ?? 'now')); ?><br>
            Panitia PPDB<br>
            <span class="nama">Saniyah, S.H.</span>
        </div>
    </div>
</div>
<div class="text-center mt-4">
    <button class="btn btn-primary btn-print" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
</div>
</div>
</body>
</html> 