<div class="d-flex flex-column flex-shrink-0 p-3 bg-white sidebar" style="height: 100vh; width: 220px; box-shadow: 2px 0 5px rgba(0,0,0,0.1);">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="<?php echo site_url('admin'); ?>" class="d-flex align-items-center text-decoration-none">
            <span class="fs-4 fw-bold text-dark">Admin PPDB</span>
        </a>
        <button class="btn btn-link text-dark p-0" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <hr class="my-2">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?php echo site_url('admin/input_daftar_ulang'); ?>" class="nav-link text-dark">
                <i class="bi bi-pencil-square me-2"></i>
                <span>Input Daftar Ulang</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/data_pendaftar'); ?>" class="nav-link text-dark">
                <i class="bi bi-people me-2"></i>
                <span>Data Pendaftar</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/peserta_daftar_ulang'); ?>" class="nav-link text-dark">
                <i class="bi bi-check-circle me-2"></i>
                <span>Peserta Daftar Ulang</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/belum_daftar_ulang'); ?>" class="nav-link text-dark">
                <i class="bi bi-clock me-2"></i>
                <span>Belum Daftar Ulang</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/laporan_harian'); ?>" class="nav-link text-dark">
                <i class="bi bi-calendar me-2"></i>
                <span>Laporan Harian</span>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/laporan_sekolah'); ?>" class="nav-link text-dark">
                <i class="bi bi-building me-2"></i>
                <span>Laporan Data Sekolah</span>
            </a>
        </li>
    </ul>
</div> 