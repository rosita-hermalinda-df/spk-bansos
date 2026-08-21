<?php
include "../config/koneksi.php";
include "../includes/header.php";
include "../includes/sidebar.php";
include "../includes/navbar.php";

/* STATISTIK */

$jmlAlternatif = mysqli_num_rows(mysqli_query($conn,"
    SELECT *
    FROM tb_alternatif
"));

$jmlRanking = mysqli_num_rows(mysqli_query($conn,"
    SELECT *
    FROM tb_ranking
"));

$terbaik = mysqli_query($conn,"
    SELECT
    a.nama_penerima,
    r.nilai_v
    FROM tb_ranking r
    JOIN tb_alternatif a
    ON r.id_alternatif = a.id_alternatif
    ORDER BY r.peringkat ASC
    LIMIT 1
");

$dataTerbaik = mysqli_fetch_assoc($terbaik);

/* DATA RANKING */

$query = mysqli_query($conn,"
    SELECT
    r.peringkat,
    r.nilai_v,
    a.nama_penerima
    FROM tb_ranking r
    JOIN tb_alternatif a
    ON r.id_alternatif = a.id_alternatif
    ORDER BY r.peringkat ASC
");
?>

<div class="content">
    <div class="container-fluid">
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
        
        <!-- CARD STATISTIK -->
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">
                                    Jumlah Alternatif
                                </small>

                                <h2 class="fw-bold mb-0">
                                    <?= $jmlAlternatif ?>
                                </h2>
                            </div>
                            <i class="bi bi-people-fill text-primary display-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">
                                    Total Ranking
                                </small>

                                <h2 class="fw-bold mb-0">
                                    <?= $jmlRanking ?>
                                </h2>
                            </div>
                            <i class="bi bi-bar-chart-fill text-success display-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">
                                    Peringkat 1
                                </small>
                                <h5 class="fw-bold mb-1">
                                    <?= htmlspecialchars($dataTerbaik['nama_penerima'] ?? '-'); ?>
                                </h5>

                                <small class="text-success">
                                    Nilai Preferensi :
                                    <strong>
                                        <?= $dataTerbaik['nilai_v'] ?? 0; ?>
                                    </strong>
                                </small>
                            </div>
                            <i class="bi bi-trophy-fill text-warning display-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL RANKING -->
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                <b>
                    Hasil Perankingan Metode Weighted Product
                </b>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table
                        id="tabelRanking"
                        class="table table-bordered table-striped table-hover align-middle text-center">
                        <thead class="table-danger">
                            <tr>
                                <th width="90">Ranking</th>
                                <th>Nama Penerima</th>
                                <th width="200">Nilai Preferensi</th>
                            </tr>
                        </thea  d>
                        <tbody>
                            <?php
                            while($row = mysqli_fetch_assoc($query)){
                            ?>

                            <tr>
                                <td>
                                    <?php
                                    if($row['peringkat'] == 1){
                                        echo "🥇";
                                    }elseif($row['peringkat'] == 2){
                                        echo "🥈";
                                    }elseif($row['peringkat'] == 3){
                                        echo "🥉";
                                    }else{
                                        echo '<span class="badge bg-primary">'.$row['peringkat'].'</span>';
                                    }
                                    ?>
                                </td>

                                <td class="text-start">
                                    <?= htmlspecialchars($row['nama_penerima']); ?>
                                </td>

                                <td>
                                    <strong>
                                        <?= $row['nilai_v']; ?>
                                    </strong>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "../includes/footer.php";
?>

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