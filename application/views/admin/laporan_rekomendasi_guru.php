<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekomendasi Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar-container { min-height: 100vh; }
        .sidebar {
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            width: 60px !important;
        }
        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .fs-4 {
            display: none;
        }
        .sidebar.collapsed .nav-link {
            text-align: center;
        }
        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }
        .main-content {
            transition: all 0.3s;
        }
        .table th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4" style="background: linear-gradient(135deg, #e3f0ff 0%, #f5faff 100%); min-height: 100vh;">
        <div class="row">
            <div class="col-auto sidebar-container p-0">
                <?php $this->load->view('admin/_sidebar'); ?>
            </div>
            <div class="col">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-center" style="color:#1976d2;">Laporan Rekomendasi Guru</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tabelRekomendasiGuru">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Guru</th>
                                        <th>Jumlah Pendaftar</th>
                                        <th>Jumlah Daftar Ulang</th>
                                        <th>Persentase Daftar Ulang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($rekomendasi_guru as $rg): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $rg->nama_guru ?: 'Tidak Ada Rekomendasi'; ?></td>
                                        <td><?php echo $rg->jumlah_pendaftar; ?></td>
                                        <td><?php echo $rg->jumlah_daftar_ulang; ?></td>
                                        <td><?php echo ($rg->jumlah_pendaftar > 0) ? number_format(($rg->jumlah_daftar_ulang/$rg->jumlah_pendaftar)*100, 2).'%' : '0%'; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabelRekomendasiGuru').DataTable({
                pageLength: 25,
                order: [[2, 'desc']],
                columnDefs: [
                    { targets: [4], className: 'text-end' }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                }
            });
        });
    </script>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0" style="color:#1976d2;">Laporan Rekomendasi Guru</h4>
        <button class="btn btn-success" onclick="exportExcel()">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </button>
    </div>
</body>
</html>
<script>
function exportExcel() {
    const data = [
        ['No', 'Nama Guru', 'Jumlah Pendaftar', 'Jumlah Daftar Ulang', 'Persentase']
    ];
    
    $('#tabelRekomendasiGuru tbody tr').each(function() {
        const row = [
            $(this).find('td:eq(0)').text(),
            $(this).find('td:eq(1)').text(),
            $(this).find('td:eq(2)').text(),
            $(this).find('td:eq(3)').text(),
            $(this).find('td:eq(4)').text()
        ];
        data.push(row);
    });

    const ws = XLSX.utils.aoa_to_sheet(data);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Laporan');
    XLSX.writeFile(wb, 'laporan_rekomendasi_guru.xlsx');
}
</script>