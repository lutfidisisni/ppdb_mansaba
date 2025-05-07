<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Admin PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2185d0;
            --secondary-color: #21ba45;
            --background-color: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --border-color: #e2e8f0;
        }

        body { 
            background-color: var(--background-color);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .main-content {
            padding: 2rem;
            min-height: 100vh;
        }

        .page-title {
            color: var(--text-primary);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-title i {
            color: var(--primary-color);
        }

        .card {
            background: var(--card-bg);
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            margin-bottom: 2rem;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card-header {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            border-radius: 16px 16px 0 0 !important;
        }

        .card-header h3 {
            color: var(--text-primary);
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background: var(--background-color);
            color: var(--text-primary);
            font-weight: 600;
            padding: 1rem;
            border-bottom: 2px solid var(--border-color);
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        .table tbody td {
            padding: 1rem;
            color: var(--text-secondary);
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: var(--background-color);
        }

        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid rgba(33, 133, 208, 0.1);
        }

        .info-box h4 {
            color: var(--primary-color);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .summary-card {
            height: 100%;
        }

        .summary-card .card-header {
            padding: 1.25rem;
        }

        .summary-card .card-header.bg-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1976d2 100%) !important;
        }

        .summary-card .card-header.bg-success {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #1b5e20 100%) !important;
        }

        .summary-card .card-header h3 {
            color: white;
        }

        .summary-table {
            margin: 0;
        }

        .summary-table th {
            font-weight: 600;
            padding: 0.75rem 0;
            color: var(--text-primary);
        }

        .summary-table td {
            text-align: right;
            padding: 0.75rem 0;
            color: var(--text-secondary);
        }

        .total-row {
            background: var(--background-color);
            font-weight: 600;
        }

        .total-row th,
        .total-row td {
            color: var(--primary-color) !important;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
        }

        .stat-card .stat-title {
            color: var(--text-secondary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-value {
            color: var(--text-primary);
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-card .stat-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        @media (max-width: 991.98px) {
            .sidebar-container {
                width: 240px;
            }
            .main-content {
                margin-left: 240px;
            }
        }

        @media (max-width: 767.98px) {
            .sidebar-container {
                width: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            .card {
                border-radius: 12px;
            }
            .page-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar-container">
        <?php $this->load->view('admin/_sidebar'); ?>
    </div>
    
    <div class="main-content">
        <h1 class="page-title">
            <i class="bi bi-file-earmark-text"></i>
            Laporan Seragam
        </h1>

        <div class="row">
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-people-fill stat-icon"></i>
                    <div class="stat-title">Total Siswa</div>
                    <div class="stat-value"><?= $total_keseluruhan->total ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-person-badge stat-icon"></i>
                    <div class="stat-title">Siswa Custom</div>
                    <div class="stat-value"><?= $total_custom ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-shop stat-icon"></i>
                    <div class="stat-title">Total Seragam Diterima</div>
                    <div class="stat-value"><?= $total_keseluruhan->total_osis + $total_keseluruhan->total_pramuka + $total_keseluruhan->total_batik + $total_keseluruhan->total_olahraga ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-clock-history stat-icon"></i>
                    <div class="stat-title">Total Pending</div>
                    <div class="stat-value"><?= $total_pending ?></div>
                </div>
            </div>
        </div>

        <!-- Laporan Berdasarkan Jenis Kelamin -->
        <div class="card mb-4">
            <div class="card-header">
                <h3><i class="bi bi-gender-ambiguous"></i> Laporan Seragam Berdasarkan Jenis Kelamin</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <th>Total Siswa</th>
                                <th>Seragam OSIS</th>
                                <th>Seragam Pramuka</th>
                                <th>Seragam Batik</th>
                                <th>Seragam Olahraga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($seragam_gender as $gender): ?>
                            <tr>
                                <td><strong><?= $gender->jenis_kelamin ?></strong></td>
                                <td><?= $gender->total ?></td>
                                <td><?= $gender->total_osis ?></td>
                                <td><?= $gender->total_pramuka ?></td>
                                <td><?= $gender->total_batik ?></td>
                                <td><?= $gender->total_olahraga ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="table-primary">
                                <td><strong>Total</strong></td>
                                <td><strong><?= array_sum(array_column($seragam_gender, 'total')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_gender, 'total_osis')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_gender, 'total_pramuka')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_gender, 'total_batik')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_gender, 'total_olahraga')) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Laporan Berdasarkan Ukuran -->
        <div class="card mb-4">
            <div class="card-header">
                <h3><i class="bi bi-rulers"></i> Laporan Seragam Berdasarkan Ukuran</h3>
            </div>
            <div class="card-body">
                <!-- Tabel untuk Laki-laki -->
                <h4 class="mb-3">Laki-laki</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Ukuran</th>
                                <th>Total Siswa</th>
                                <th>Seragam OSIS</th>
                                <th>Seragam Pramuka</th>
                                <th>Seragam Batik</th>
                                <th>Seragam Olahraga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($seragam_ukuran_laki as $ukuran): ?>
                            <tr <?= $ukuran->ukuran_seragam === 'custom' ? 'class="table-warning"' : '' ?>>
                                <td>
                                    <strong>
                                        <?php if ($ukuran->ukuran_seragam === 'custom'): ?>
                                            <i class="bi bi-scissors me-1"></i> Custom
                                        <?php else: ?>
                                            <?= $ukuran->ukuran_seragam ?>
                                        <?php endif; ?>
                                    </strong>
                                </td>
                                <td><?= $ukuran->total ?></td>
                                <td><?= $ukuran->total_osis ?></td>
                                <td><?= $ukuran->total_pramuka ?></td>
                                <td><?= $ukuran->total_batik ?></td>
                                <td><?= $ukuran->total_olahraga ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="table-primary">
                                <td><strong>Total</strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_laki, 'total')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_laki, 'total_osis')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_laki, 'total_pramuka')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_laki, 'total_batik')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_laki, 'total_olahraga')) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tabel untuk Perempuan -->
                <h4 class="mb-3">Perempuan</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Ukuran</th>
                                <th>Total Siswa</th>
                                <th>Seragam OSIS</th>
                                <th>Seragam Pramuka</th>
                                <th>Seragam Batik</th>
                                <th>Seragam Olahraga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($seragam_ukuran_perempuan as $ukuran): ?>
                            <tr <?= $ukuran->ukuran_seragam === 'custom' ? 'class="table-warning"' : '' ?>>
                                <td>
                                    <strong>
                                        <?php if ($ukuran->ukuran_seragam === 'custom'): ?>
                                            <i class="bi bi-scissors me-1"></i> Custom
                                        <?php else: ?>
                                            <?= $ukuran->ukuran_seragam ?>
                                        <?php endif; ?>
                                    </strong>
                                </td>
                                <td><?= $ukuran->total ?></td>
                                <td><?= $ukuran->total_osis ?></td>
                                <td><?= $ukuran->total_pramuka ?></td>
                                <td><?= $ukuran->total_batik ?></td>
                                <td><?= $ukuran->total_olahraga ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="table-primary">
                                <td><strong>Total</strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_perempuan, 'total')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_perempuan, 'total_osis')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_perempuan, 'total_pramuka')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_perempuan, 'total_batik')) ?></strong></td>
                                <td><strong><?= array_sum(array_column($seragam_ukuran_perempuan, 'total_olahraga')) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Laporan Berdasarkan Jenis Seragam -->
        <div class="card mb-4">
            <div class="card-header">
                <h3><i class="bi bi-collection"></i> Laporan Berdasarkan Jenis Seragam</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Tabel Laki-laki -->
                    <div class="col-md-6">
                        <h4 class="mb-3">Laki-laki</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>JENIS SERAGAM</th>
                                        <th>TOTAL KEBUTUHAN</th>
                                        <th>SUDAH DIPROSES</th>
                                        <th>PENDING</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Seragam OSIS</strong></td>
                                        <td><?= $total_laki->total ?></td>
                                        <td><?= $total_laki->total_osis ?></td>
                                        <td><?= $total_laki->total - $total_laki->total_osis ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Seragam Pramuka</strong></td>
                                        <td><?= $total_laki->total ?></td>
                                        <td><?= $total_laki->total_pramuka ?></td>
                                        <td><?= $total_laki->total - $total_laki->total_pramuka ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Seragam Batik</strong></td>
                                        <td><?= $total_laki->total ?></td>
                                        <td><?= $total_laki->total_batik ?></td>
                                        <td><?= $total_laki->total - $total_laki->total_batik ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Seragam Olahraga</strong></td>
                                        <td><?= $total_laki->total ?></td>
                                        <td><?= $total_laki->total_olahraga ?></td>
                                        <td><?= $total_laki->total - $total_laki->total_olahraga ?></td>
                                    </tr>
                                    <tr class="table-primary">
                                        <td><strong>Total</strong></td>
                                        <td><strong><?= $total_laki->total * 4 ?></strong></td>
                                        <td><strong><?= $total_laki->total_osis + $total_laki->total_pramuka + $total_laki->total_batik + $total_laki->total_olahraga ?></strong></td>
                                        <td><strong><?= ($total_laki->total * 4) - ($total_laki->total_osis + $total_laki->total_pramuka + $total_laki->total_batik + $total_laki->total_olahraga) ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tabel Perempuan -->
                    <div class="col-md-6">
                        <h4 class="mb-3">Perempuan</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>JENIS SERAGAM</th>
                                        <th>TOTAL KEBUTUHAN</th>
                                        <th>SUDAH DIPROSES</th>
                                        <th>PENDING</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Seragam OSIS</strong></td>
                                        <td><?= $total_perempuan->total ?></td>
                                        <td><?= $total_perempuan->total_osis ?></td>
                                        <td><?= $total_perempuan->total - $total_perempuan->total_osis ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Seragam Pramuka</strong></td>
                                        <td><?= $total_perempuan->total ?></td>
                                        <td><?= $total_perempuan->total_pramuka ?></td>
                                        <td><?= $total_perempuan->total - $total_perempuan->total_pramuka ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Seragam Batik</strong></td>
                                        <td><?= $total_perempuan->total ?></td>
                                        <td><?= $total_perempuan->total_batik ?></td>
                                        <td><?= $total_perempuan->total - $total_perempuan->total_batik ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Seragam Olahraga</strong></td>
                                        <td><?= $total_perempuan->total ?></td>
                                        <td><?= $total_perempuan->total_olahraga ?></td>
                                        <td><?= $total_perempuan->total - $total_perempuan->total_olahraga ?></td>
                                    </tr>
                                    <tr class="table-primary">
                                        <td><strong>Total</strong></td>
                                        <td><strong><?= $total_perempuan->total * 4 ?></strong></td>
                                        <td><strong><?= $total_perempuan->total_osis + $total_perempuan->total_pramuka + $total_perempuan->total_batik + $total_perempuan->total_olahraga ?></strong></td>
                                        <td><strong><?= ($total_perempuan->total * 4) - ($total_perempuan->total_osis + $total_perempuan->total_pramuka + $total_perempuan->total_batik + $total_perempuan->total_olahraga) ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Total Keseluruhan -->
                    <div class="col-12">
                        <div class="info-box">
                            <h4><i class="bi bi-info-circle"></i> Informasi Total Keseluruhan</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2">Total siswa dengan ukuran custom: <?= $total_custom ?> siswa</p>
                                    <p class="mb-0">Total kebutuhan seragam: <?= $total_keseluruhan->total * 4 ?> pcs</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">Total seragam sudah diproses: <?= $total_keseluruhan->total_osis + $total_keseluruhan->total_pramuka + $total_keseluruhan->total_batik + $total_keseluruhan->total_olahraga ?> pcs</p>
                                    <p class="mb-0">Total seragam pending: <?= $total_pending ?> pcs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kebutuhan Seragam Pending -->
        <div class="card mb-4">
            <div class="card-header">
                <h3><i class="bi bi-clock-history"></i> Kebutuhan Seragam Pending</h3>
            </div>
            <div class="card-body">
                <!-- Tabel Laki-laki -->
                <h4 class="mb-3">Laki-laki</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>UKURAN</th>
                                <th>Seragam OSIS</th>
                                <th>Seragam Pramuka</th>
                                <th>Seragam Batik</th>
                                <th>Seragam Olahraga</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($pending_seragam_laki)): ?>
                                <?php $no = 1; foreach($pending_seragam_laki as $row): ?>
                                <tr <?= $row->ukuran_seragam === 'custom' ? 'class="table-warning"' : '' ?>>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <strong>
                                            <?php if ($row->ukuran_seragam === 'custom'): ?>
                                                <i class="bi bi-scissors me-1"></i> Custom
                                            <?php else: ?>
                                                <?= $row->ukuran_seragam ?>
                                            <?php endif; ?>
                                        </strong>
                                    </td>
                                    <td><?= $row->pending_osis ?></td>
                                    <td><?= $row->pending_pramuka ?></td>
                                    <td><?= $row->pending_batik ?></td>
                                    <td><?= $row->pending_olahraga ?></td>
                                    <td><strong><?= $row->pending_osis + $row->pending_pramuka + $row->pending_batik + $row->pending_olahraga ?></strong></td>
                                </tr>
                                <?php endforeach; ?>
                                <tr class="table-primary">
                                    <td colspan="2"><strong>Total</strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_laki, 'pending_osis')) ?></strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_laki, 'pending_pramuka')) ?></strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_laki, 'pending_batik')) ?></strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_laki, 'pending_olahraga')) ?></strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_laki, 'pending_osis')) + 
                                        array_sum(array_column($pending_seragam_laki, 'pending_pramuka')) + 
                                        array_sum(array_column($pending_seragam_laki, 'pending_batik')) + 
                                        array_sum(array_column($pending_seragam_laki, 'pending_olahraga')) ?></strong></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pending seragam untuk laki-laki</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Tabel Perempuan -->
                <h4 class="mb-3">Perempuan</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>UKURAN</th>
                                <th>Seragam OSIS</th>
                                <th>Seragam Pramuka</th>
                                <th>Seragam Batik</th>
                                <th>Seragam Olahraga</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($pending_seragam_perempuan)): ?>
                                <?php $no = 1; foreach($pending_seragam_perempuan as $row): ?>
                                <tr <?= $row->ukuran_seragam === 'custom' ? 'class="table-warning"' : '' ?>>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <strong>
                                            <?php if ($row->ukuran_seragam === 'custom'): ?>
                                                <i class="bi bi-scissors me-1"></i> Custom
                                            <?php else: ?>
                                                <?= $row->ukuran_seragam ?>
                                            <?php endif; ?>
                                        </strong>
                                    </td>
                                    <td><?= $row->pending_osis ?></td>
                                    <td><?= $row->pending_pramuka ?></td>
                                    <td><?= $row->pending_batik ?></td>
                                    <td><?= $row->pending_olahraga ?></td>
                                    <td><strong><?= $row->pending_osis + $row->pending_pramuka + $row->pending_batik + $row->pending_olahraga ?></strong></td>
                                </tr>
                                <?php endforeach; ?>
                                <tr class="table-primary">
                                    <td colspan="2"><strong>Total</strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_perempuan, 'pending_osis')) ?></strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_perempuan, 'pending_pramuka')) ?></strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_perempuan, 'pending_batik')) ?></strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_perempuan, 'pending_olahraga')) ?></strong></td>
                                    <td><strong><?= array_sum(array_column($pending_seragam_perempuan, 'pending_osis')) + 
                                        array_sum(array_column($pending_seragam_perempuan, 'pending_pramuka')) + 
                                        array_sum(array_column($pending_seragam_perempuan, 'pending_batik')) + 
                                        array_sum(array_column($pending_seragam_perempuan, 'pending_olahraga')) ?></strong></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pending seragam untuk perempuan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>