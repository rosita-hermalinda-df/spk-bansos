<div class="sidebar bg-primary text-white shadow" id="sidebar">

    <div class="sidebar-header text-center py-4 border-bottom border-light">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-bar-chart-fill"></i>
            SPK BANSOS
        </h5>
    </div>

    <ul class="nav flex-column flex-grow-1 py-3">

        <li class="nav-item">
            <a href="../admin/dashboard.php" class="nav-link text-white">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/user.php" class="nav-link text-white">
                <i class="bi bi-person-fill me-2"></i>
                Data User
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/kriteria.php" class="nav-link text-white">
                <i class="bi bi-list-check me-2"></i>
                Data Kriteria
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/alternatif.php" class="nav-link text-white">
                <i class="bi bi-people-fill me-2"></i>
                Calon Penerima
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/penilaian.php" class="nav-link text-white">
                <i class="bi bi-pencil-square me-2"></i>
                Penilaian
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/perhitungan.php" class="nav-link text-white">
                <i class="bi bi-calculator me-2"></i>
                Perhitungan WP
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/ranking.php" class="nav-link text-white">
                <i class="bi bi-bar-chart me-2"></i>
                Hasil Ranking
            </a>
        </li>

        <li class="nav-item">
            <a href="../admin/informasi.php"
               class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'informasi.php' ? 'active' : ''; ?>">
                <i class="bi bi-megaphone-fill me-2"></i>
                Informasi
            </a>
        </li>

        <!-- Logout -->
        <li class="nav-item mt-auto mb-3">
            <a href="../auth/logout.php" class="nav-link text-warning">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </a>
        </li>

    </ul>

    <!-- FOOTER SIDEBAR -->
    <div class="sidebar-footer text-center border-top border-light">
        <small>© 2026 SPK BANSOS</small>
    </div>

</div>