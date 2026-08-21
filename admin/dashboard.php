<?php

include "../config/koneksi.php";

include "../includes/header.php";
include "../includes/sidebar.php";

// Query jumlah data
$user = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM tb_user");
$kriteria = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM tb_kriteria");
$alternatif = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM tb_alternatif");
$penilaian = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM tb_penilaian");
$ranking = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM tb_ranking");

$jml_user = mysqli_fetch_assoc($user)['jumlah'];
$jml_kriteria = mysqli_fetch_assoc($kriteria)['jumlah'];
$jml_alternatif = mysqli_fetch_assoc($alternatif)['jumlah'];
$jml_ranking = mysqli_fetch_assoc($ranking)['jumlah'];

include "../includes/navbar.php";
?>

<div class="content">

    <div class="container-fluid">

        <h3 class="mb-2">
            Selamat Datang,
            <b><?= htmlspecialchars($_SESSION['username']); ?></b>
        </h3>

        <p class="mb-4">
            Role :
            <span class="badge bg-primary">
                <?= htmlspecialchars($_SESSION['role']); ?>
            </span>
        </p>

        <h3 class="mb-4">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </h3>

        <div class="row">

            <!-- Jumlah User -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-person-fill fs-1 text-primary"></i>
                        <h3 class="mt-2"><?= $jml_user; ?></h3>
                        <p class="mb-0">Data User</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Kriteria -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-list-check fs-1 text-success"></i>
                        <h3 class="mt-2"><?= $jml_kriteria; ?></h3>
                        <p class="mb-0">Data Kriteria</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Alternatif -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill fs-1 text-warning"></i>
                        <h3 class="mt-2"><?= $jml_alternatif; ?></h3>
                        <p class="mb-0">Calon Penerima</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Ranking -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-bar-chart-fill fs-1 text-danger"></i>
                        <h3 class="mt-2"><?= $jml_ranking; ?></h3>
                        <p class="mb-0">Hasil Ranking</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

<?php include "../includes/footer.php";?>
</div>

