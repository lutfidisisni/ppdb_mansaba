<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Peserta Didik Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; font-size: 15px; min-height: 330mm; }
        .kop-sekolah { text-align: center; margin-bottom: 8px; }
        .kop-img { width: 100%; max-width: 1000px; margin: 0 auto 8px auto; display: block; }
        .judul-formulir { text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 16px; text-transform: uppercase; }
        .section-title {
            background: #009900;
            color: #fff;
            font-weight: bold;
            padding: 4px 12px;
            margin-top: 18px;
            margin-bottom: 0;
            font-size: 15px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        @media print {
            .section-title {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background: #009900 !important;
                color: #fff !important;
            }
        }
        .table-formulir { width: 100%; margin-bottom: 0; }
        .table-formulir th, .table-formulir td { padding: 4px 8px; vertical-align: top; }
        .table-formulir th { width: 180px; font-weight: 500; }
        .ttd-area { margin-top: 32px; }
        .ttd-col { width: 33%; text-align: center; display: inline-block; vertical-align: top; }
        .bukti-daftar { margin-top: 32px; border-top: 2px solid #000; padding-top: 16px; }
        .bukti-title { font-weight: bold; text-align: center; margin-bottom: 12px; text-transform: uppercase; }
        .table-bukti th { width: 140px; font-weight: 500; }
.table-bukti td.text-end { padding-right: 80px; }
.table-bukti th { width: 180px; }
        .table-bukti td, .table-bukti th { padding: 3px 8px 3px 8px; }
        .catatan { font-size: 13px; margin-top: 8px; margin-left: 20px; margin-right: 20px; }
        @media print {
            @page {
                size: F4 portrait;
                margin: 1cm;
            }
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                margin: 0;
                font-size: 13px;
                line-height: 1.2;
            }
            .container {
                transform: scale(0.95);
                transform-origin: top center;
                padding: 0;
            }
            .section-title {
                page-break-inside: avoid;
            }
            table {
                page-break-inside: avoid;
            }
            .ttd-area {
                page-break-inside: avoid;
                margin-top: 20px !important;
            }
            .btn-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="container" style="max-width:794px; margin:0 auto; padding:15px;">
        <div class="kop-sekolah">
    <img src="<?php echo base_url('assets/img/kop_sekolah.jpg'); ?>" class="kop-img" alt="Kop Sekolah">
</div>
            <?php if(isset($kop) && !empty($kop)): ?>
            <img src="<?php echo base_url($kop); ?>" alt="Kop Sekolah" class="kop-img">
        <?php endif; ?>
        </div>
        <div class="judul-formulir">FORMULIR PENDAFTARAN PESERTA DIDIK BARU</div>

        <div class="section-title">IDENTITAS PESERTA DIDIK</div>
        <table class="table-formulir">
            <tr>
                <td style="width:50%; vertical-align:top;">
                    <table style="width:100%;">
                        <tr><th style="width:170px;">No Pendaftaran</th><td>: <b><?php echo $pendaftar['no_pendaftaran'] ?? '-'; ?></b></td></tr>
                        <tr><th>NISN</th><td>: <?php echo $pendaftar['nisn'] ?? '-'; ?></td></tr>
                        <tr><th>Nama Peserta Didik</th><td>: <b><?php echo $pendaftar['nama_siswa'] ?? '-'; ?></b></td></tr>
                        <tr><th>Tempat & Tanggal Lahir</th><td>:
<?php
    $tempat = $pendaftar['tempat_lahir'] ?? '-';
    $tgl = $pendaftar['tanggal_lahir'] ?? '';
    function tgl_indo($tanggal) {
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $exp = explode('-', $tanggal);
        if(count($exp) == 3) {
            return ltrim($exp[2], '0') . ' ' . $bulan[(int)$exp[1]] . ' ' . $exp[0];
        } else {
            return $tanggal;
        }
    }
    if ($tgl && $tgl != '-' && strtotime($tgl)) {
        $tgl_formatted = tgl_indo($tgl);
    } else {
        $tgl_formatted = $tgl;
    }
    echo $tempat . ', ' . $tgl_formatted;
?></td></tr>
                        <tr><th>Alamat Tinggal</th><td>:</td></tr>
                        <tr><th>Desa</th><td>: <?php echo $pendaftar['desa'] ?? '-'; ?></td></tr>
                        <tr><th>RT / RW</th><td>: <?php echo ($pendaftar['rt'] ?? '-') . ' / ' . ($pendaftar['rw'] ?? '-'); ?></td></tr>
                        <tr><th>Keterangan Tinggal</th><td>: <?php echo $pendaftar['tinggal'] ?? '-'; ?></td></tr>
                    </table>
                </td>
                <td style="width:50%; vertical-align:top; padding-left:16px;">
                    <table style="width:100%;">
                        <tr><th style="width:140px;">Jalur Daftar</th><td>: <?php echo $pendaftar['jalur_pendaftaran'] ?? '-'; ?></td></tr>
                        <tr><th>Peminatan</th><td>: <?php echo $pendaftar['pilihan_program'] ?? '-'; ?></td></tr>
                        <tr><th>Jenis Kelamin</th><td>: <?php echo $pendaftar['jenis_kelamin'] ?? '-'; ?></td></tr>
                        <tr><th>Kecamatan</th><td>: <?php echo $pendaftar['kecamatan'] ?? '-'; ?></td></tr>
                        <tr><th>Kabupaten</th><td>: <?php echo $pendaftar['kabupaten'] ?? '-'; ?></td></tr>
                        <tr><th>Provinsi</th><td>: <?php echo $pendaftar['provinsi'] ?? '-'; ?></td></tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="section-title">IDENTITAS ORANGTUA / WALI</div>
        <table class="table-formulir">
            <tr>
                <td style="width:50%; vertical-align:top;">
                    <table style="width:100%;">
                        <tr><th style="width:150px;">Nama Ayah</th><td>: <?php echo $pendaftar['nama_ayah'] ?? '-'; ?></td></tr>
                        <tr><th>Pendidikan Ayah</th><td>: <?php echo $pendaftar['pendidikan_ayah'] ?? '-'; ?></td></tr>
                        <tr><th>Pekerjaan Ayah</th><td>: <?php echo $pendaftar['pekerjaan_ayah'] ?? '-'; ?></td></tr>
                        <tr><th>No HP Ayah</th><td>: <?php echo $pendaftar['no_hp_ayah'] ?? '-'; ?></td></tr>
                        <tr><th>Nama Ibu</th><td>: <?php echo $pendaftar['nama_ibu'] ?? '-'; ?></td></tr>
                        <tr><th>Pendidikan Ibu</th><td>: <?php echo $pendaftar['pendidikan_ibu'] ?? '-'; ?></td></tr>
                        <tr><th>Pekerjaan Ibu</th><td>: <?php echo $pendaftar['pekerjaan_ibu'] ?? '-'; ?></td></tr>
                        <tr><th>No HP Ibu</th><td>: <?php echo $pendaftar['no_hp_ibu'] ?? '-'; ?></td></tr>
                        <tr><th>Alamat Orang Tua</th><td>: <?php echo $pendaftar['alamat_ortu'] ?? '-'; ?></td></tr>
                    </table>
                </td>
                <td style="width:50%; vertical-align:top; padding-left:16px;">
                    <table style="width:100%;">
                        <tr><th style="width:150px;">Nama Wali</th><td>: <?php echo $pendaftar['nama_wali'] ?? '-'; ?></td></tr>
                        <tr><th>Hubungan dengan Wali</th><td>: <?php echo $pendaftar['hubungan_wali'] ?? '-'; ?></td></tr>
                        <tr><th>No HP Wali</th><td>: <?php echo $pendaftar['no_hp_wali'] ?? '-'; ?></td></tr>
                        <tr><th>Alamat Wali</th><td>: <?php echo $pendaftar['alamat_wali'] ?? '-'; ?></td></tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="section-title">IDENTITAS SEKOLAH ASAL</div>
        <table class="table-formulir">
            <tr>
                <th>Nama Sekolah</th><td>: <?php echo $pendaftar['nama_sekolah'] ?? '-'; ?></td>
                <th>Alamat</th><td>: <?php echo $pendaftar['alamat_sekolah'] ?? '-'; ?></td>
            </tr>
            <tr>
                <th>Piagam / Sertifikat</th>
                <td>: <?php echo $pendaftar['piagam'] ?? '-'; ?></td>
                <th>Rekom</th>
                <td>: <?php echo $pendaftar['rekomendasi'] ?? '-'; ?></td>
            </tr>
            <tr>
                <th>Motivasi</th>
                <td colspan="3">: <?php echo $pendaftar['motivasi'] ?? '-'; ?></td>
            </tr>
        </table>

        <div class="ttd-area row mt-4" style="display: flex; justify-content: space-between; align-items: flex-end;">
            <div class="col-4 text-center" style="width:33%; text-align:left;">
                Mengetahui,<br>Panitia PPDB<br><br><br>
                <strong><?php echo $this->session->userdata('nama_lengkap') ?? 'Nama Petugas'; ?></strong>
            </div>
            <div class="col-4 text-center" style="width:33%;">
                Orang Tua / Wali<br><br><br><br>
                <span style="display:inline-block; border-bottom:2px solid #222; width:180px; height:2px;"></span>
            </div>
            <div class="col-4 text-center" style="width:33%; text-align:right;">
                Banyupatih, <?php echo date('d F Y'); ?><br>Pendaftar<br><br><br>
                <strong><?php echo $pendaftar['nama_siswa'] ?? '-'; ?></strong>
            </div>
        </div>

        <div class="bukti-daftar">
            <div class="bukti-title">BUKTI DAFTAR</div>
            <table class="table-bukti">
                <tr><th>No. Pendaftaran</th><td>: <?php echo $pendaftar['no_pendaftaran'] ?? '-'; ?></td><th class="text-end">Jalur</th><td class="text-end">: <?php echo $pendaftar['jalur_pendaftaran'] ?? '-'; ?></td></tr>
                <tr><th>Nama</th><td>: <?php echo $pendaftar['nama_siswa'] ?? '-'; ?></td><th class="text-end">Peminatan</th><td class="text-end">: <?php echo $pendaftar['pilihan_program'] ?? '-'; ?></td></tr>
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
                    Banyupatih, <?php echo date('d F Y'); ?><br>Panitia,<br><br><br><strong><?php echo $this->session->userdata('nama_lengkap') ?? 'Nama Petugas'; ?></strong>
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