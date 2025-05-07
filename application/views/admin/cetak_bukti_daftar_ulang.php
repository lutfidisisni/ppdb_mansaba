<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Daftar Ulang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; }
        .bukti-outer { max-width: 1200px; margin: 32px auto 0 auto; }
        .bukti-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: flex-start;
        }
        .bukti-card { border: 1px solid #222; border-radius: 6px; width: 600px; padding: 22px 22px 10px 22px; min-height: 420px; position: relative; background: #fff; }
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
        .ttd .nama { margin-top: 40px; font-weight: bold; text-decoration: underline; }
        .cut-line {
            position: relative;
            width: 0;
            margin: 0 20px;
            z-index: 1;
            height: 100%;
        }
        .cut-line::before {
            content: "\2702";
            position: absolute;
            left: -14px;
            top: 0;
            font-size: 22px;
            color: #000;
            background: #fff;
            padding: 0 2px;
            z-index: 2;
        }
        .cut-line::after {
            content: '';
            position: absolute;
            left: 0;
            top: 26px; /* 22px font-size + 4px padding bawah icon gunting */
            width: 0;
            height: calc(100% - 26px);
            border-left: 2px dashed #000;
            z-index: 1;
        }
        @media print {
            @page {
                size: F4 landscape;
                margin: 0;
            }
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .btn-print { display: none; }
            .bukti-container {
                gap: 30px !important;
                page-break-inside: avoid;
                align-items: flex-start;
            }
            .bukti-card {
                page-break-inside: avoid;
                break-inside: avoid;
            }
            .cut-line {
                border-left: 2px dashed #000 !important;
                margin: 0 20px !important;
                height: 100% !important;
            }
            .cut-line::before {
                color: #000 !important;
                background: #fff !important;
            }
            .ttd .nama {
                margin-top: 40px !important;
            }
        }
    </style>
</head>
<body>
<div class="bukti-outer">
<div class="bukti-container">
    <!-- Untuk Peserta -->
    <div class="bukti-card">
        <div class="kop">
            <img src="<?php echo base_url('assets/img/kop_sekolah.jpg'); ?>" alt="Logo" />
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
            <br><br><br><br>
            <span class="nama"><?php echo $this->session->userdata('nama_lengkap') ?? 'Nama Petugas'; ?></span>
        </div>
    </div>
    <!-- Garis Potong -->
    <div class="cut-line"></div>
    <!-- Untuk Panitia -->
    <div class="bukti-card">
        <div class="kop">
            <img src="<?php echo base_url('assets/img/kop_sekolah.jpg'); ?>" alt="Logo" />
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
            <br><br><br><br>
            <span class="nama"><?php echo $this->session->userdata('nama_lengkap') ?? 'Nama Petugas'; ?></span>
        </div>
    </div>
</div>
<div class="text-center mt-4">
    <button class="btn btn-primary btn-print" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
</div>
</div>