<?php
include "../includes/session-kades.php";
include "../config/koneksi.php";
include "../includes/header.php";
include "../includes/sidebar-kades.php";
include "../includes/navbar.php";

/* STATISTIK */

$jmlAlternatif = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM tb_alternatif
"));

$jmlKriteria = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM tb_kriteria
"));

$jmlPenilaian = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM tb_penilaian
"));

$jmlRanking = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM tb_ranking
"));
?>

<div class="content">

    <div class="container-fluid">

        <h3 class="mb-4">
            <i class="bi bi-speedometer2"></i>
            Dashboard Kepala Desa
        </h3>

        <div class="row">

            <!-- Calon Penerima -->
            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Calon Penerima
                            </small>

                            <h2 class="fw-bold mb-0">
                                <?= $jmlAlternatif; ?>
                            </h2>

                        </div>

                        <i class="bi bi-people-fill text-primary display-5"></i>

                    </div>

                </div>

            </div>

            <!-- Kriteria -->
            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Jumlah Kriteria
                            </small>

                            <h2 class="fw-bold mb-0">
                                <?= $jmlKriteria; ?>
                            </h2>

                        </div>

                        <i class="bi bi-list-check text-success display-5"></i>

                    </div>

                </div>

            </div>

            <!-- Penilaian -->
            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Data Penilaian
                            </small>

                            <h2 class="fw-bold mb-0">
                                <?= $jmlPenilaian; ?>
                            </h2>

                        </div>

                        <i class="bi bi-clipboard-check-fill text-warning display-5"></i>

                    </div>

                </div>

            </div>

            <!-- Ranking -->
            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Data Ranking
                            </small>

                            <h2 class="fw-bold mb-0">
                                <?= $jmlRanking; ?>
                            </h2>

                        </div>

                        <i class="bi bi-trophy-fill text-danger display-5"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Informasi Sistem -->

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">

                <b>
                    Informasi Sistem
                </b>

            </div>

            <div class="card-body">

                <div class="alert alert-info mb-4">

                    <h5 class="alert-heading">
                        <i class="bi bi-info-circle-fill"></i>
                        Sistem Pendukung Keputusan
                    </h5>

                    <hr>

                    <p class="mb-2">

                        Sistem ini digunakan untuk membantu menentukan
                        calon penerima bantuan sosial menggunakan
                        <strong>Metode Weighted Product (WP)</strong>.

                    </p>

                    <ul class="mb-0">

                        <li>
                            Jumlah Calon Penerima :
                            <strong><?= $jmlAlternatif; ?></strong>
                        </li>

                        <li>
                            Jumlah Kriteria :
                            <strong><?= $jmlKriteria; ?></strong>
                        </li>

                        <li>
                            Jumlah Penilaian :
                            <strong><?= $jmlPenilaian; ?></strong>
                        </li>

                        <li>
                            Data Ranking :
                            <strong><?= $jmlRanking; ?></strong>
                        </li>

                    </ul>

                </div>

                <div class="alert alert-success">

                    <i class="bi bi-check-circle-fill"></i>

                    Proses perhitungan menggunakan metode
                    <strong>Weighted Product (WP)</strong>
                    telah dilakukan.

                    <br><br>

                    Silakan pilih menu
                    <strong>Hasil Ranking</strong>
                    untuk melihat hasil rekomendasi penerima bantuan sosial.

                </div>

                <a href="ranking.php"
                   class="btn btn-primary">

                    <i class="bi bi-trophy-fill"></i>

                    Lihat Hasil Ranking

                </a>

            </div>

        </div>

    </div>

</div>

<?php
include "../includes/footer.php";
?>