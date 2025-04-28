<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Peserta Didik Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; font-size: 15px; }
        .kop-sekolah { text-align: center; margin-bottom: 8px; }
        .kop-img { width: 100%; max-width: 1000px; margin: 0 auto 8px auto; display: block; }
        .judul-formulir { text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 16px; text-transform: uppercase; }
        .section-title { background: #009900; color: #fff; font-weight: bold; padding: 4px 12px; margin-top: 18px; margin-bottom: 0; font-size: 15px; }
        .table-formulir { width: 100%; margin-bottom: 0; }
        .table-formulir th, .table-formulir td { padding: 4px 8px; vertical-align: top; }
        .table-formulir th { width: 180px; font-weight: 500; }
        .ttd-area { margin-top: 32px; }
        .ttd-col { width: 33%; text-align: center; display: inline-block; vertical-align: top; }
        .bukti-daftar { margin-top: 32px; border-top: 2px solid #000; padding-top: 16px; }
        .bukti-title { font-weight: bold; text-align: center; margin-bottom: 12px; text-transform: uppercase; }
        .table-bukti th { width: 140px; font-weight: 500; }
        .table-bukti td, .table-bukti th { padding: 3px 8px; }
        .catatan { font-size: 13px; margin-top: 8px; }
        @media print { .btn-print { display: none; } }
    </style>
</head>
<body>
    <div class="container" style="max-width:900px; margin:0 auto;">
        <div class="kop-sekolah">
            <img src="<?php echo base_url('assets/img/kop_ma_nu.jpg'); ?>" alt="Kop Sekolah" class="kop-img">
        </div>
        <div class="judul-formulir">FORMULIR PENDAFTARAN PESERTA DIDIK BARU</div>

        <div class="section-title">IDENTITAS PESERTA DIDIK</div>
        <table class="table-formulir">
            <tr><th>No Pendaftaran</th><td>: <?php echo $pendaftar['no_pendaftaran'] ?? '-'; ?></td><th>Jalur Daftar</th><td>: <?php echo $pendaftar['jalur_pendaftaran'] ?? '-'; ?></td></tr>
            <tr><th>NISN</th><td>: <?php echo $pendaftar['nisn'] ?? '-'; ?></td><th>Peminatan</th><td>: <?php echo $pendaftar['pilihan_program'] ?? '-'; ?></td></tr>
            <tr><th>Nama Peserta Didik</th><td colspan="3">: <?php echo $pendaftar['nama_siswa'] ?? '-'; ?></td></tr>
            <tr><th>Tempat & Tanggal Lahir</th><td>: <?php echo ($pendaftar['tempat_lahir'] ?? '-') . ', ' . ($pendaftar['tanggal_lahir'] ?? '-'); ?></td><th>Jenis Kelamin</th><td>: <?php echo $pendaftar['jenis_kelamin'] ?? '-'; ?></td></tr>
            <tr><th>Alamat Tinggal</th><td colspan="3">: <?php echo $pendaftar['alamat_lengkap'] ?? '-'; ?></td></tr>
            <tr><th>RT / RW</th><td>: <?php echo ($pendaftar['rt'] ?? '-') . ' / ' . ($pendaftar['rw'] ?? '-'); ?></td><th>Desa</th><td>: <?php echo $pendaftar['desa'] ?? '-'; ?></td></tr>
            <tr><th>Kecamatan</th><td>: <?php echo $pendaftar['kecamatan'] ?? '-'; ?></td><th>Kabupaten</th><td>: <?php echo $pendaftar['kabupaten'] ?? '-'; ?></td></tr>
            <tr><th>No HP Siswa</th><td>: <?php echo $pendaftar['no_hp_siswa'] ?? '-'; ?></td><th></th><td></td></tr>
            <tr><th>Keterangan Tinggal</th><td colspan="3">: <?php echo $pendaftar['tinggal'] ?? '-'; ?></td></tr>
        </table>

        <div class="section-title">IDENTITAS ORANGTUA / WALI</div>
        <table class="table-formulir">
            <tr><th>Ayah</th><td>: <?php echo $pendaftar['nama_ayah'] ?? '-'; ?></td><th>Ibu</th><td>: <?php echo $pendaftar['nama_ibu'] ?? '-'; ?></td></tr>
            <tr><th>Pendidikan</th><td>: <?php echo $pendaftar['pendidikan_ayah'] ?? '-'; ?></td><th>Pendidikan</th><td>: <?php echo $pendaftar['pendidikan_ibu'] ?? '-'; ?></td></tr>
            <tr><th>Pekerjaan</th><td>: <?php echo $pendaftar['pekerjaan_ayah'] ?? '-'; ?></td><th>Pekerjaan</th><td>: <?php echo $pendaftar['pekerjaan_ibu'] ?? '-'; ?></td></tr>
            <tr><th>No HP</th><td>: <?php echo $pendaftar['no_hp_ayah'] ?? '-'; ?></td><th>No HP</th><td>: <?php echo $pendaftar['no_hp_ibu'] ?? '-'; ?></td></tr>
            <tr><th>Alamat Orang Tua</th><td colspan="3">: <?php echo $pendaftar['alamat_ortu'] ?? '-'; ?></td></tr>
            <tr><th>Wali</th><td>: <?php echo $pendaftar['nama_wali'] ?? '-'; ?></td><th>Hubungan</th><td>: <?php echo $pendaftar['hubungan_wali'] ?? '-'; ?></td></tr>
            <tr><th>No HP Wali</th><td>: <?php echo $pendaftar['no_hp_wali'] ?? '-'; ?></td><th>Alamat Wali</th><td>: <?php echo $pendaftar['alamat_wali'] ?? '-'; ?></td></tr>
        </table>

        <div class="section-title">IDENTITAS SEKOLAH ASAL</div>
        <table class="table-formulir">
            <tr><th>Nama</th><td>: <?php echo $pendaftar['nama_sekolah'] ?? '-'; ?></td><th>Alamat</th><td>: <?php echo $pendaftar['alamat_sekolah'] ?? '-'; ?></td></tr>
            <tr><th>Piagam / Sertifikat</th><td>: <?php echo $pendaftar['piagam'] ?? '-'; ?></td><th>Motivasi</th><td>: <?php echo $pendaftar['motivasi'] ?? '-'; ?></td></tr>
        </table>

        <div class="ttd-area row mt-4">
            <div class="col-4 text-center">
                Mengetahui,<br>Panitia PPDB<br><br><br><br>
                <u>Saniyah, S.H.</u>
            </div>
            <div class="col-4 text-center">
            </div>
            <div class="col-4 text-center">
                Banyupatih, <?php echo date('d F Y'); ?><br>Orang Tua / Wali<br><br><br><br>
                <u>________________________</u>
            </div>
        </div>
        <div class="col-12 text-center mt-4">
            <u><?php echo $pendaftar['nama_siswa'] ?? '-'; ?></u><br>Pendaftar
        </div>

        <div class="bukti-daftar">
            <div class="bukti-title">BUKTI DAFTAR</div>
            <table class="table-bukti">
                <tr><th>No. Pendaftaran</th><td>: <?php echo $pendaftar['no_pendaftaran'] ?? '-'; ?></td><th>Jalur</th><td>: <?php echo $pendaftar['jalur_pendaftaran'] ?? '-'; ?></td></tr>
                <tr><th>Nama</th><td>: <?php echo $pendaftar['nama_siswa'] ?? '-'; ?></td><th>Peminatan</th><td>: <?php echo $pendaftar['pilihan_program'] ?? '-'; ?></td></tr>
                <tr><th>Alamat</th><td colspan="3">: <?php echo $pendaftar['alamat_lengkap'] ?? '-'; ?></td></tr>
                <tr><th>Sekolah Asal</th><td colspan="3">: <?php echo $pendaftar['nama_sekolah'] ?? '-'; ?></td></tr>
            </table>
            <div class="catatan mt-2">
                Dimohon untuk segera melakukan daftar ulang dengan mengumpulkan:<br>
                <ul>
                    <li>SKL / Ijazah</li>
                    <li>Surat Keterangan Lulus (jika sudah ada)</li>
                    <li>Fotokopi Akte dan Kartu Keluarga</li>
                    <li>Melunasi biaya daftar ulang</li>
                    <li>SKTM dan Rekomendasi PR NU Desa</li>
                </ul>
            </div>
            <div class="row mt-4">
                <div class="col-6 text-center">
                    Banyupatih, <?php echo date('d F Y'); ?><br>Panitia,<br><br><br><u>Saniyah, S.H.</u>
                </div>
                <div class="col-6 text-center">
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-primary btn-print" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
        </div>
    </div>
</body>
</html> 