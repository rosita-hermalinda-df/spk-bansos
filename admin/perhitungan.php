<?php
include "../config/koneksi.php";
include "../includes/header.php";
include "../includes/sidebar.php";
include "../includes/navbar.php";

/*DATA KRITERIA*/
$qKriteria = mysqli_query($conn,"
    SELECT *
    FROM tb_kriteria
    ORDER BY id_kriteria ASC
");

$kriteria = [];
$totalBobot = 0;
    while($k=mysqli_fetch_assoc($qKriteria)){
        $kriteria[] = $k;
        $totalBobot += $k['bobot'];
    }

/* NORMALISASI BOBOT */
$bobotNormal = [];
foreach($kriteria as $k){
    $w = $k['bobot'] / $totalBobot;
    $bobotNormal[$k['id_kriteria']] = $w;
}

/*JUMLAH DATA*/
$jmlKriteria = mysqli_num_rows(mysqli_query($conn,"
    SELECT * FROM tb_kriteria
"));

$jmlAlternatif = mysqli_num_rows(mysqli_query($conn,"
    SELECT * FROM tb_alternatif
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
            <i class="bi bi-calculator"></i>
                Perhitungan Weighted Product
        </h3>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card shadow-sm text-center wp-card">
                    <div class="card-body">
                        <i class="bi bi-list-check display-5 text-primary"></i>
                        <h5 class="mt-3">
                            Data Bobot
                        </h5>
                        <h2>
                            <?= $jmlKriteria ?>
                        </h2>
                        <button
                            class="btn btn-primary mt-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalBobot">
                                Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm text-center wp-card">
                    <div class="card-body">
                        <i class="bi bi-percent display-5 text-success"></i>
                        <h5 class="mt-3">
                            Normalisasi
                        </h5>
                        <h2>
                            <?= $jmlKriteria ?>
                        </h2>
                        <button
                            class="btn btn-success mt-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalNormalisasi">
                                Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm text-center wp-card">
                    <div class="card-body">
                        <i class="bi bi-table display-5 text-warning"></i>
                        <h5 class="mt-3">
                            Matriks
                        </h5>
                        <h2>
                            <?= $jmlAlternatif ?>
                        </h2>
                        <button
                            class="btn btn-warning mt-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalMatriks">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm text-center wp-card">
                    <div class="card-body">
                        <i class="bi bi-calculator-fill display-5 text-info"></i>
                        <h5 class="mt-3">
                            Vector S
                        </h5>
                        <h2>
                            <?= $jmlAlternatif ?>
                        </h2>
                        <button
                            class="btn btn-info text-white mt-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalVectorS">
                                Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm text-center wp-card">
                    <div class="card-body">
                        <i class="bi bi-graph-up display-5 text-secondary"></i>
                        <h5 class="mt-3">
                            Vector V
                        </h5>
                        <h2>
                            <?= $jmlAlternatif ?>
                        </h2>
                        <button
                            class="btn btn-secondary mt-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalVectorV">
                                Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm text-center wp-card">
                    <div class="card-body">
                        <i class="bi bi-trophy-fill display-5 text-danger"></i>
                        <h5 class="mt-3">
                            Ranking
                        </h5>
                        <h2>
                            <?= $jmlRanking ?>
                        </h2>
                        <button
                            class="btn btn-danger mt-2"
                            data-bs-toggle="modal"
                            data-bs-target="#modalRanking">
                                Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--MODAL DATA BOBOT-->
        <div class="modal fade" id="modalBobot" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            Data Bobot Kriteria
                        </h5>

                        <button
                            type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Jenis</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            $no=1;
                            foreach($kriteria as $k){
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $k['kode_kriteria']; ?></td>
                                    <td class="text-start">
                                        <?= $k['nama_kriteria']; ?>
                                    </td>
                                    <td><?= $k['bobot']; ?></td>
                                    <td>
                                        <span class="badge bg-<?= strtolower($k['jenis'])=='benefit'?'success':'danger'; ?>">
                                            <?= ucfirst($k['jenis']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--MODAL NORMALISASI-->
        <div class="modal fade" id="modalNormalisasi" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            Normalisasi Bobot
                        </h5>

                        <button
                            type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Bobot</th>
                                    <th>Normalisasi</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            $no=1;
                            foreach($kriteria as $k){
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $k['kode_kriteria']; ?></td>
                                    <td><?= $k['bobot']; ?></td>
                                    <td>
                                        <?= number_format($bobotNormal[$k['id_kriteria']], 2); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL MATRIKS KEPUTUSAN -->
        <div class="modal fade" id="modalMatriks" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <!-- HEADER -->
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-table me-2"></i>
                            Matriks Keputusan
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover text-center align-middle mb-0">
                                <thead class="table-warning">
                                    <tr>
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>Nama Penerima</th>
                                        <?php foreach ($kriteria as $k) { ?>
                                            <th>
                                                <?= htmlspecialchars($k['kode_kriteria']); ?>
                                            </th>
                                        <?php } ?>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                $no = 1;
                                $alt = mysqli_query($conn, "
                                    SELECT
                                        id_alternatif,
                                        nama_penerima
                                    FROM tb_alternatif
                                    ORDER BY id_alternatif ASC
                                ");

                                if (mysqli_num_rows($alt) > 0) {
                                    while ($a = mysqli_fetch_assoc($alt)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><strong>A<?= htmlspecialchars($a['id_alternatif']); ?></strong></td>
                                        <td class="text-start"><?= htmlspecialchars($a['nama_penerima']); ?></td>
                                        <!-- NILAI C1-C5 -->
                                        <?php foreach ($kriteria as $k) { ?>
                                            <?php
                                            $idAlternatif = $a['id_alternatif'];
                                            $idKriteria = $k['id_kriteria'];
                                            $q = mysqli_query($conn, "
                                                SELECT
                                                    s.nilai
                                                FROM tb_penilaian p
                                                INNER JOIN tb_subkriteria s
                                                    ON p.id_subkriteria = s.id_subkriteria
                                                WHERE
                                                    p.id_alternatif = '$idAlternatif'
                                                    AND
                                                    p.id_kriteria = '$idKriteria'
                                                LIMIT 1
                                            ");
                                            $nilai = mysqli_fetch_assoc($q);
                                            ?>
                                            <td><?= isset($nilai['nilai'])? htmlspecialchars($nilai['nilai']): '-';?></td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                }

                                } else {

                                ?>
                                    <tr>
                                        <td
                                            colspan="<?= count($kriteria) + 3; ?>"
                                            class="text-center text-muted py-4">
                                            <i class="bi bi-info-circle me-2"></i>
                                            Belum terdapat data alternatif.
                                        </td>
                                    </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- FOOTER MODAL -->
                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            <i class="bi bi-x-circle me-1"></i>
                            Tutup

                        </button>

                    </div>

                </div>

            </div>

        </div>

        <?php

        /*PERHITUNGAN VECTOR S & VECTOR V*/
        $hasilS = [];
        $totalS = 0;
        $alternatifWP = mysqli_query($conn,"
            SELECT *
            FROM tb_alternatif
            ORDER BY id_alternatif ASC
        ");

        while($alt = mysqli_fetch_assoc($alternatifWP)){
            $S = 1;
            foreach($kriteria as $k){

                $nilaiQuery = mysqli_query($conn,"
                SELECT s.nilai
                FROM tb_penilaian p
                JOIN tb_subkriteria s
                ON p.id_subkriteria=s.id_subkriteria
                WHERE
                p.id_alternatif='".$alt['id_alternatif']."'
                AND
                p.id_kriteria='".$k['id_kriteria']."'
                ");

                $nilai = mysqli_fetch_assoc($nilaiQuery);
                $x = $nilai['nilai'] ?? 1;
                $S *= pow($x,$bobotNormal[$k['id_kriteria']]);
            }

            $hasilS[$alt['id_alternatif']] = $S;
            $totalS += $S;
        }
        

        /* SIMPAN RANKING */
        mysqli_query($conn,"TRUNCATE TABLE tb_ranking");
        $ranking = [];
        $alternatifWP = mysqli_query($conn,"
            SELECT *
            FROM tb_alternatif
            ORDER BY id_alternatif ASC
        ");

        while($alt=mysqli_fetch_assoc($alternatifWP)){
            $V = $hasilS[$alt['id_alternatif']] / $totalS;

            $ranking[]=[
                "id"=>$alt['id_alternatif'],
                "nama"=>$alt['nama_penerima'],
                "s"=>$hasilS[$alt['id_alternatif']],
                "v"=>$V
            ];
        }

        /* DATA SEBELUM RANKING */
        $hasilWP = $ranking;

        /* PROSES RANKING */
        usort($ranking,function($a,$b){
            return $b['v'] <=> $a['v'];
        });

        usort($ranking,function($a,$b){
            return $b['v'] <=> $a['v'];
        });
        $rank=1;

        foreach($ranking as $r){
            mysqli_query($conn,"
            INSERT INTO tb_ranking
            (
                id_alternatif,
                nilai_s,
                nilai_v,
                peringkat
            )
            VALUES
            (
                '".$r['id']."',
                '".$r['s']."',
                '".$r['v']."',
                '$rank'
            )
            ");
            $rank++;
        }
        ?>

        <!-- MODAL VECTOR S -->
        <div class="modal fade" id="modalVectorS" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-calculator-fill"></i>
                            Perhitungan Vector S
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle text-center">
                                <thead class="table-info">
                                    <tr>
                                        <th width="70">No</th>
                                        <th>Alternatif</th>
                                        <th>Vector S</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                $no = 1;
                                foreach($hasilWP as $r){
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="text-center">
                                            <?= htmlspecialchars($r['nama']); ?>
                                        </td>
                                        <td>
                                            <strong><?= $r['s']; ?></strong>
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

        <!-- MODAL VECTOR V -->
        <div class="modal fade" id="modalVectorV" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-graph-up-arrow"></i>
                            Perhitungan Vector V
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle text-center">
                                <thead class="table-secondary">
                                    <tr>
                                        <th width="70">No</th>
                                        <th>Alternatif</th>
                                        <th>Vector V</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                $no = 1;
                                foreach($hasilWP as $r){
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="text-center">
                                            <?= htmlspecialchars($r['nama']); ?>
                                        </td>
                                        <td>
                                            <strong><?= $r['s']; ?></strong>
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

        <div class="modal fade" id="modalRanking">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">        
                        <h5 class="modal-title">
                            Ranking Weighted Product
                        </h5>
                        
                        <button
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-danger">
                                <tr>
                                    <th>Ranking</th>
                                    <th>Nama</th>
                                    <th>Nilai V</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                $no=1;
                                foreach($ranking as $r){
                                ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">
                                            <?= $no++; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?= htmlspecialchars($r['nama']); ?>
                                    </td>
                                    <td>
                                        <strong><?= $r['s']; ?></strong>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php include "../includes/footer.php";?>
