<?php
$current = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar bg-primary text-white shadow" id="sidebar">

    <div class="sidebar-header text-center py-4 border-bottom border-light">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-bar-chart-fill"></i>
            SPK BANSOS
        </h5>
    </div>

    <ul class="nav flex-column flex-grow-1 py-3">

        <li class="nav-item">
            <a href="../kepaladesa/dashboard.php"
               class="nav-link text-white <?= ($current == 'dashboard.php') ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="../kepaladesa/ranking.php"
               class="nav-link text-white <?= ($current == 'ranking.php') ? 'active' : ''; ?>">
                <i class="bi bi-trophy-fill me-2"></i>
                Hasil Ranking
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