<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%); }
        .stat-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(25,118,210,0.08);
            border: 1px solid #e3f2fd;
            text-align: center;
            padding: 32px 0 24px 0;
            margin-bottom: 24px;
        }
        .stat-icon {
            font-size: 2.5rem;
            color: #1976d2;
            margin-bottom: 8px;
        }
        .stat-label { font-size: 1.1rem; color: #1976d2; }
        .stat-value { font-size: 2.2rem; font-weight: 700; color: #1976d2; }
        .table-modern thead { background: #e3f2fd; }
        .table-modern th, .table-modern td { vertical-align: middle; }
        .section-title { font-size: 1.3rem; font-weight: 600; color: #1976d2; margin: 32px 0 16px 0; }
    </style>
</head>
<body>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%); min-height: 100vh;">
    <div class="row">
        <div class="col-auto sidebar-container p-0">
            <?php $this->load->view('admin/_sidebar'); ?>
        </div>
        <div class="col p-4 main-content">
            <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.95); border-radius:18px;">
                <div class="card-body p-4">
                    <h2 class="mb-0 fw-bold text-center" style="color:#1976d2; text-shadow:0 2px 8px #1976d233;">Rekapitulasi PPDB</h2>
                </div>
            </div>
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    <div><?php echo $this->session->flashdata('success'); ?></div>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <div><?php echo $this->session->flashdata('error'); ?></div>
                </div>
            <?php endif; ?>
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card stat-card shadow-sm border-0" style="transition:box-shadow 0.2s,transform 0.2s;">
                        <div class="stat-icon"><i class="bi bi-people"></i></div>
                        <div class="stat-label">Total Pendaftar</div>
                        <div class="stat-value"><?php echo $laporan->total_pendaftar ?? 0 ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card stat-card shadow-sm border-0" style="transition:box-shadow 0.2s,transform 0.2s;">
                        <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
                        <div class="stat-label">Total Daftar Ulang</div>
                        <div class="stat-value"><?php echo $laporan->total_daftar_ulang ?? 0 ?></div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.92); border-radius:18px;">
                <div class="card-body">
                <div class="section-title">Berdasarkan Jenis Kelamin</div>
                <table class="table table-modern table-bordered text-center">
                <thead>
                <tr>
                <th>Jenis Kelamin</th>
                <th>Pendaftar</th>
                <th>Daftar Ulang</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $jenis_kelamin = ['Laki-laki', 'Perempuan'];
                foreach ($jenis_kelamin as $jk) {
                $rekap_harian['gender'][$jk]['daftar'] = $this->db->where('jenis_kelamin', $jk)->get('pendaftaran')->num_rows();
                $rekap_harian['gender'][$jk]['du'] = $this->db->where('jenis_kelamin', $jk)->where('status_daftar_ulang', 'sudah')->get('pendaftaran')->num_rows();
                }
                ?>
                <tr>
                <td>Laki-laki</td>
                <td><?php echo $rekap_harian['gender']['Laki-laki']['daftar'] ?? 0 ?></td>
                <td><?php echo $rekap_harian['gender']['Laki-laki']['du'] ?? 0 ?></td>
                </tr>
                <tr>
                <td>Perempuan</td>
                <td><?php echo $rekap_harian['gender']['Perempuan']['daftar'] ?? 0 ?></td>
                <td><?php echo $rekap_harian['gender']['Perempuan']['du'] ?? 0 ?></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <th>Total</th>
                <th><?php echo array_sum(array_column($rekap_harian['jenis_kelamin'], 'daftar')) ?></th>
                <th><?php echo array_sum(array_column($rekap_harian['jenis_kelamin'], 'du')) ?></th>
                </tr>
                </tfoot>
                </table>
                </div>
            </div>
            <div class="card mb-4 shadow-sm border-0" style="background:rgba(255,255,255,0.92); border-radius:18px;">
                <div class="card-body">
                    <div class="section-title">Berdasarkan Jalur Pendaftaran</div>
                    <table class="table table-modern table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Jalur Pendaftaran</th>
                                <th>Pendaftar</th>
                                <th>Daftar Ulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jalur_pendaftaran = ['Reguler', 'Prestasi', 'Sosial', 'Tahfidz'];
                            foreach ($jalur_pendaftaran as $jalur) {
                                $rekap_harian['jalur'][$jalur]['daftar'] = $this->db->where('jalur_pendaftaran', $jalur)->get('pendaftaran')->num_rows();
                                $rekap_harian['jalur'][$jalur]['du'] = $this->db->where('jalur_pendaftaran', $jalur)->where('status_daftar_ulang', 'sudah')->get('pendaftaran')->num_rows();
                            }
                            ?>
                            <tr>
                                <td>Reguler</td>
                                <td><?php echo $rekap_harian['jalur']['Reguler']['daftar'] ?? 0 ?></td>
                                <td><?php echo $rekap_harian['jalur']['Reguler']['du'] ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td>Prestasi</td>
                                <td><?php echo $rekap_harian['jalur']['Prestasi']['daftar'] ?? 0 ?></td>
                                <td><?php echo $rekap_harian['jalur']['Prestasi']['du'] ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td>Sosial</td>
                                <td><?php echo $rekap_harian['jalur']['Sosial']['daftar'] ?? 0 ?></td>
                                <td><?php echo $rekap_harian['jalur']['Sosial']['du'] ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td>Tahfidz</td>
                                <td><?php echo $rekap_harian['jalur']['Tahfidz']['daftar'] ?? 0 ?></td>
                                <td><?php echo $rekap_harian['jalur']['Tahfidz']['du'] ?? 0 ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?php echo array_sum(array_column($rekap_harian['jalur'], 'daftar')) ?></th>
                                <th><?php echo array_sum(array_column($rekap_harian['jalur'], 'du')) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
                <div class="card-body">
                    <div class="section-title">Berdasarkan Pilihan Program</div>
                    <table class="table table-modern table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Program</th>
                                <th>Pendaftar</th>
                                <th>Daftar Ulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rekap_harian['program'] = $rekap_harian['program'] ?? [];
                            // Query database to get data for each program
                            $programs = ['MIPA', 'IPS', 'Bahasa', 'AGM'];
                            foreach ($programs as $program) {
                                $rekap_harian['program'][$program]['daftar'] = $this->db->where('pilihan_program', $program)->get('pendaftaran')->num_rows();
                                $rekap_harian['program'][$program]['du'] = $this->db->where('pilihan_program', $program)->where('status_daftar_ulang', 'sudah')->get('pendaftaran')->num_rows();
                            }
                            ?>
                            <tr>
                                <td>MIPA</td>
                                <td><?php echo $rekap_harian['program']['MIPA']['daftar'] ?? 0 ?></td>
                                <td><?php echo $rekap_harian['program']['MIPA']['du'] ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td>IPS</td>
                                <td><?php echo $rekap_harian['program']['IPS']['daftar'] ?? 0 ?></td>
                                <td><?php echo $rekap_harian['program']['IPS']['du'] ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td>Bahasa</td>
                                <td><?php echo $rekap_harian['program']['Bahasa']['daftar'] ?? 0 ?></td>
                                <td><?php echo $rekap_harian['program']['Bahasa']['du'] ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td>AGM</td>
                                <td><?php echo $rekap_harian['program']['AGM']['daftar'] ?? 0 ?></td>
                                <td><?php echo $rekap_harian['program']['AGM']['du'] ?? 0 ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?php echo array_sum(array_column($rekap_harian['program'], 'daftar')) ?></th>
                                <th><?php echo array_sum(array_column($rekap_harian['program'], 'du')) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <footer class="mt-5 text-center text-muted small" style="opacity:0.7;">
                &copy; <?php echo date('Y'); ?> PPDB MANU Admin. All rights reserved.
            </footer>
        </div>
    </div>
</div>
</body>
</html>