<?php $role = $this->session->userdata('role'); ?>
<div class="d-flex flex-column flex-shrink-0 p-3 sidebar" style="height: 100vh; width: 240px; background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%); box-shadow: 2px 0 10px rgba(25,118,210,0.08); border-radius: 0 24px 24px 0;">
    <div class="d-flex flex-column align-items-center mb-4">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" class="mb-2" style="width: 60px; height: 60px; box-shadow:0 2px 8px #1976d233;">
        <span class="fs-5 fw-bold text-white">Admin PPDB</span>
    </div>
    <hr class="my-2 text-white">
    <ul class="nav nav-pills flex-column mb-auto">
        <?php $current = $this->uri->segment(2); ?>
        <li>
            <a href="<?php echo site_url('admin'); ?>" class="nav-link d-flex align-items-center <?php echo $current==''?'active':''; ?>">
                <i class="bi bi-house me-2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/input_daftar_ulang'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='input_daftar_ulang'?'active':''; ?>">
                <i class="bi bi-pencil-square me-2"></i>
                <span>Input Daftar Ulang</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/data_pendaftar'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='data_pendaftar'?'active':''; ?>">
                <i class="bi bi-people me-2"></i>
                <span>Data Pendaftar</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/peserta_daftar_ulang'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='peserta_daftar_ulang'?'active':''; ?>">
                <i class="bi bi-check-circle me-2"></i>
                <span>Peserta Daftar Ulang</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/data_pendaftar_lengkap'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='data_pendaftar_lengkap'?'active':''; ?>">
                <i class="bi bi-table me-2"></i>
                <span>Data Pendaftar Lengkap</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/belum_daftar_ulang'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='belum_daftar_ulang'?'active':''; ?>">
                <i class="bi bi-clock me-2"></i>
                <span>Belum Daftar Ulang</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/laporan_sekolah'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='laporan_sekolah'?'active':''; ?>">
                <i class="bi bi-building me-2"></i>
                <span>Laporan Data Sekolah</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/laporan_rekomendasi'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='laporan_rekomendasi'?'active':''; ?>">
                <i class="bi bi-star me-2"></i>
                <span>Laporan Rekomendasi</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/laporan_seragam'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='laporan_seragam'?'active':''; ?>">
                <i class="bi bi-bag me-2"></i>
                <span>Laporan Seragam</span>
            </a>
        </li>
        <?php if($role === 'admin'): ?>
        <li class="nav-header text-white mt-3 mb-2">ADMINISTRATOR</li>
        <li>
            <a href="<?php echo site_url('admin/rekapitulasi_ppdb'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='rekapitulasi_ppdb'?'active':''; ?>">
                <i class="bi bi-bar-chart-line me-2"></i>
                <span>Rekapitulasi PPDB</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/pengaturan'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='pengaturan'?'active':''; ?>">
                <i class="bi bi-gear me-2"></i>
                <span>Pengaturan</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/tambah_petugas'); ?>" class="nav-link d-flex align-items-center <?php echo $current=='tambah_petugas'?'active':''; ?>">
                <i class="bi bi-person-plus me-2"></i>
                <span>Tambah Petugas</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <hr class="my-2 text-white">
    <ul class="nav nav-pills flex-column mt-auto">
        <li>
            <a href="<?php echo site_url('auth/logout'); ?>" class="nav-link d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-2"></i>
                <span>Log Out</span>
            </a>
        </li>
    </ul>
</div>
<style>
.sidebar {
    width: 240px !important;
    height: 100vh;
    background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
    transition: all 0.3s;
    position: fixed;
    z-index: 100;
    overflow-y: auto;
    top: 0;
    left: 0;
}
.main-content {
    margin-left: 240px;
    transition: all 0.3s;
    min-height: 100vh;
    padding-bottom: 60px;
}
@media (max-width: 768px) {
    .sidebar {
        margin-left: -240px;
    }
    .sidebar.active {
        margin-left: 0;
    }
    .main-content {
        margin-left: 0;
    }
}
.sidebar .nav-link { 
    color: #e3f2fd; 
    border-radius: 8px; 
    margin-bottom: 4px; 
    transition: background 0.2s, color 0.2s; 
}
.sidebar .nav-link.active, 
.sidebar .nav-link:hover { 
    background: #fff; 
    color: #1976d2 !important; 
    font-weight: 600; 
}
.sidebar .nav-link i { 
    font-size: 1.2rem; 
}
.sidebar .nav-link span { 
    font-size: 1rem; 
}
.nav-header { 
    font-size: 0.75rem; 
    text-transform: uppercase; 
    letter-spacing: 0.5px; 
}
</style>