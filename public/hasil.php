<?php
include "../config/koneksi.php";

/* ================================
   FUNGSI SENSOR NAMA
================================ */

function sensorNama($nama)
{
    $nama = trim($nama);

    if ($nama === '') {
        return '-';
    }

    $kata = preg_split('/\s+/', $nama);
    $hasil = [];

    foreach ($kata as $k) {

        $panjang = strlen($k);

        if ($panjang <= 1) {
            $hasil[] = '*';
        } else {
            $hasil[] = substr($k, 0, 1)
                . str_repeat('*', $panjang - 1);
        }
    }

    return implode(' ', $hasil);
}


/* ================================
   HALAMAN AKTIF
================================ */

$currentPage = basename($_SERVER['PHP_SELF']);


/* ================================
   JUMLAH ALTERNATIF
================================ */

$resultAlternatif = mysqli_query($conn, "
    SELECT *
    FROM tb_alternatif
");

$jmlAlternatif = mysqli_num_rows($resultAlternatif);


/* ================================
   JUMLAH RANKING
================================ */

$resultRanking = mysqli_query($conn, "
    SELECT *
    FROM tb_ranking
");

$jmlRanking = mysqli_num_rows($resultRanking);


/* ================================
   PERINGKAT TERBAIK
================================ */

$terbaik = mysqli_query($conn, "
    SELECT
        a.nama_penerima,
        r.nilai_v
    FROM tb_ranking r
    INNER JOIN tb_alternatif a
        ON r.id_alternatif = a.id_alternatif
    ORDER BY r.peringkat ASC
    LIMIT 1
");

$dataTerbaik = mysqli_fetch_assoc($terbaik);


/* ================================
   DATA RANKING
================================ */

$query = mysqli_query($conn, "
    SELECT
        r.peringkat,
        r.nilai_v,
        a.nama_penerima
    FROM tb_ranking r
    INNER JOIN tb_alternatif a
        ON r.id_alternatif = a.id_alternatif
    ORDER BY r.peringkat ASC
");

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Hasil Ranking | SPK Bansos</title>


    <!-- ================================
         BOOTSTRAP
    ================================= -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- ================================
         BOOTSTRAP ICONS
    ================================= -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">


    <!-- ================================
         DATATABLES
    ================================= -->

    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">


    <!-- ================================
         STYLE
    ================================= -->

    <style>

        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }


        /* NAVBAR */

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }


        /* HERO */

        .hero {
            background: linear-gradient(
                135deg,
                #0d6efd,
                #4dabf7
            );

            color: white;

            padding: 70px 0;
        }


        .hero h2 {
            font-weight: 700;
        }


        /* CARD */

        .card {
            border: none;
            border-radius: 15px;
        }


        /* TABLE */

        .table {
            margin-bottom: 0;
        }


        /* FOOTER */

        footer {
            background: #0d6efd;

            color: white;

            padding: 20px;

            margin-top: 60px;
        }


        /* RESPONSIVE */

        @media (max-width: 768px) {

            .hero {
                padding: 50px 20px;
            }

            .hero h2 {
                font-size: 25px;
            }

        }

    </style>

</head>


<body>


<!-- ==================================================
     NAVBAR
=================================================== -->

<nav class="navbar navbar-expand-lg bg-white">

    <div class="container">


        <!-- LOGO -->

        <a
            class="navbar-brand d-flex align-items-center"
            href="index.php"
        >

            <img
                src="../assets/img/logo.png"
                alt="Logo SPK Bansos"
                style="height:45px; width:auto;"
            >

            <div class="lh-1 ms-2">

                <span class="fw-bold fs-5">
                    SPK BANSOS
                </span>

                <small
                    class="d-block text-secondary"
                    style="font-size:10px;"
                >
                    Desa Semampirejo
                </small>

            </div>

        </a>


        <!-- TOGGLE MOBILE -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu"
            aria-controls="menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- MENU -->

        <div
            class="collapse navbar-collapse"
            id="menu"
        >

            <ul class="navbar-nav ms-auto">


                <!-- BERANDA -->

                <li class="nav-item">

                    <a
                        class="nav-link <?= ($currentPage == 'index.php') ? 'active fw-bold text-primary' : ''; ?>"
                        href="index.php"
                    >
                        Beranda
                    </a>

                </li>


                <!-- TENTANG -->

                <li class="nav-item">

                    <a
                        class="nav-link <?= ($currentPage == 'tentang.php') ? 'active fw-bold text-primary' : ''; ?>"
                        href="tentang.php"
                    >
                        Tentang
                    </a>

                </li>


                <!-- INFORMASI -->

                <li class="nav-item">

                    <a
                        class="nav-link <?= ($currentPage == 'informasi.php') ? 'active fw-bold text-primary' : ''; ?>"
                        href="informasi.php"
                    >
                        Informasi
                    </a>

                </li>


                <!-- HASIL RANKING -->

                <li class="nav-item">

                    <a
                        class="nav-link <?= ($currentPage == 'hasil.php') ? 'active fw-bold text-primary' : ''; ?>"
                        href="hasil.php"
                    >
                        Hasil Ranking
                    </a>

                </li>


                <!-- LOGIN -->

                <li class="nav-item">

                    <a
                        class="btn btn-primary ms-3"
                        href="../auth/login.php"
                    >

                        <i class="bi bi-box-arrow-in-right"></i>

                        Login

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>



<!-- ==================================================
     HERO
=================================================== -->

<section class="hero">

    <div class="container text-center">

        <h2 class="fw-bold">

            Hasil Rekomendasi Penerima Bantuan Sosial

        </h2>

        <p class="mb-0">

            Berikut merupakan hasil rekomendasi penerima bantuan sosial
            berdasarkan perhitungan menggunakan metode
            <strong>Weighted Product (WP)</strong>.

        </p>

    </div>

</section>



<!-- ==================================================
     KONTEN HASIL RANKING
=================================================== -->

<div class="container my-5">


    <!-- ==================================================
         JUDUL
    =================================================== -->

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h3 class="mb-2 mb-md-0">
                <i class="bi bi-trophy-fill text-warning"></i>
                Hasil Ranking
            </h3>

            <div class="d-flex gap-2">
                <a href="cetak-ranking.php"
                   target="_blank"
                   class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i>
                        Cetak PDF
                </a>

                <a href="export-ranking.php"
                   class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i>
                        Export Excel
                </a>
            </div>
        </div>



    <!-- ==================================================
         CARD STATISTIK
    =================================================== -->

    <div class="row mb-4">


        <!-- JUMLAH ALTERNATIF -->

        <div class="col-lg-4 col-md-6 mb-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div
                        class="d-flex justify-content-between align-items-center"
                    >

                        <div>

                            <small class="text-muted">
                                Jumlah Alternatif
                            </small>

                            <h2 class="fw-bold mb-0">

                                <?= $jmlAlternatif ?>

                            </h2>

                        </div>

                        <i
                            class="bi bi-people-fill text-primary display-5"
                        ></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- TOTAL RANKING -->

        <div class="col-lg-4 col-md-6 mb-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div
                        class="d-flex justify-content-between align-items-center"
                    >

                        <div>

                            <small class="text-muted">
                                Total Ranking
                            </small>

                            <h2 class="fw-bold mb-0">

                                <?= $jmlRanking ?>

                            </h2>

                        </div>

                        <i
                            class="bi bi-bar-chart-fill text-success display-5"
                        ></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- PERINGKAT 1 -->

        <div class="col-lg-4 col-md-12 mb-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div
                        class="d-flex justify-content-between align-items-center"
                    >

                        <div>

                            <small class="text-muted">
                                Peringkat 1
                            </small>

                            <h5 class="fw-bold mb-1">
                                <?= htmlspecialchars(
                                    sensorNama($dataTerbaik['nama_penerima'] ?? '-')
                                ); ?>
                            </h5>


                            <small class="text-success">

                                Nilai Preferensi :

                                <strong>
                                    <?= $dataTerbaik['nilai_v'] ?? 0; ?>
                                </strong>

                            </small>

                        </div>


                        <i
                            class="bi bi-trophy-fill text-warning display-5"
                        ></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- ==================================================
         TABEL RANKING
    =================================================== -->

    <div class="card shadow-sm">


        <!-- HEADER -->

        <div class="card-header bg-primary text-white">

            <b>

                Hasil Perankingan Metode Weighted Product

            </b>

        </div>


        <!-- BODY -->

        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="tabelRanking"
                    class="table table-bordered table-striped table-hover align-middle text-center"
                >


                    <!-- HEAD -->

                    <thead class="table-primary">

                        <tr>

                            <th width="90">
                                Ranking
                            </th>

                            <th>
                                Nama Penerima
                            </th>

                            <th width="200">
                                Nilai Preferensi
                            </th>

                        </tr>

                    </thead>


                    <!-- BODY -->

                    <tbody>

                        <?php if (mysqli_num_rows($query) > 0): ?>

                            <?php while ($row = mysqli_fetch_assoc($query)): ?>

                                <tr>


                                    <!-- RANKING -->

                                    <td>

                                        <?php

                                        if ($row['peringkat'] == 1) {

                                            echo "🥇";

                                        } elseif ($row['peringkat'] == 2) {

                                            echo "🥈";

                                        } elseif ($row['peringkat'] == 3) {

                                            echo "🥉";

                                        } else {

                                            echo '<span class="badge bg-primary">'
                                                . htmlspecialchars($row['peringkat'])
                                                . '</span>';

                                        }

                                        ?>

                                    </td>


                                    <!-- NAMA PENERIMA -->

                                    <td class="text-start">

                                        <?= htmlspecialchars(
                                            sensorNama(
                                                $row['nama_penerima']
                                            )
                                        ); ?>

                                    </td>


                                    <!-- NILAI PREFERENSI -->

                                    <td>

                                        <strong>
                                            <?= $row['nilai_v']; ?>
                                        </strong>

                                    </td>


                                </tr>

                            <?php endwhile; ?>


                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="3"
                                    class="text-center text-muted py-4"
                                >

                                    <i
                                        class="bi bi-info-circle me-2"
                                    ></i>

                                    Belum terdapat hasil ranking.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- ==================================================
         KETERANGAN
    =================================================== -->

    <div class="alert alert-info mt-4">

        <i class="bi bi-info-circle-fill me-2"></i>

        Hasil yang ditampilkan merupakan rekomendasi berdasarkan
        proses perhitungan menggunakan metode
        <strong>Weighted Product (WP)</strong>.

        Keputusan akhir mengenai penerima bantuan sosial tetap berada
        pada Pemerintah Desa Semampirejo sesuai dengan kebijakan dan
        hasil verifikasi lapangan.

    </div>

</div>



<!-- ==================================================
     FOOTER
=================================================== -->

<footer>

    <div class="container text-center">

        © <?= date('Y'); ?>

        Sistem Pendukung Keputusan Penerima Bantuan Sosial

        <br>

        Desa Semampirejo

    </div>

</footer>



<!-- ==================================================
     JAVASCRIPT
=================================================== -->

<!-- jQuery -->

<script
    src="https://code.jquery.com/jquery-3.7.1.min.js">
</script>


<!-- Bootstrap -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<!-- DataTables -->

<script
    src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js">
</script>


<script
    src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js">
</script>



<!-- ==================================================
     DATATABLES
=================================================== -->

<script>

$(document).ready(function () {

    $('#tabelRanking').DataTable({

        responsive: true,

        pageLength: 10,

        ordering: false,

        language: {

            search: "Cari :",

            lengthMenu: "Tampilkan _MENU_ data",

            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            infoEmpty: "Tidak ada data",

            zeroRecords: "Data tidak ditemukan",

            paginate: {

                previous: "Sebelumnya",

                next: "Berikutnya"

            }

        }

    });

});

</script>


</body>

</html>
```
