<?php

include "../config/koneksi.php";
include "../includes/header.php";
include "../includes/sidebar.php";


/* ==================================================
   ID KRITERIA
================================================== */

$id_kriteria = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;


/* ==================================================
   AMBIL DATA KRITERIA
================================================== */

$queryKriteria = mysqli_query($conn, "
    SELECT *
    FROM tb_kriteria
    WHERE id_kriteria = '$id_kriteria'
");

$kriteria = mysqli_fetch_assoc($queryKriteria);


/* ==================================================
   CEK KRITERIA
================================================== */

if (!$kriteria) {

    echo "
    <script>
        alert('Data kriteria tidak ditemukan.');
        window.location='kriteria.php';
    </script>
    ";

    exit;
}


/* ==================================================
   URUTAN SUB KRITERIA
   COST    : BESAR -> KECIL
   BENEFIT : KECIL -> BESAR
================================================== */

$jenisKriteria = strtolower(trim($kriteria['jenis']));

if ($jenisKriteria == 'cost') {

    $urutanNilai = "DESC";

} else {

    $urutanNilai = "ASC";

}


$querySub = mysqli_query($conn, "
    SELECT *
    FROM tb_subkriteria
    WHERE id_kriteria = '$id_kriteria'
    ORDER BY nilai $urutanNilai, id_subkriteria ASC
");

?>

<div id="main-wrapper">

    <?php include "../includes/navbar.php"; ?>


    <div class="content">

        <div class="container-fluid">


            <!-- ==================================================
                 HEADER HALAMAN
            ================================================== -->

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                <div>

                    <h3 class="mb-1">

                        <i class="bi bi-list-ul me-2"></i>

                        Sub Kriteria

                    </h3>

                </div>


                <!-- TOMBOL -->

                <div class="d-flex gap-2 flex-wrap">

                    <!-- KEMBALI -->

                    <a
                        href="kriteria.php"
                        class="btn btn-secondary">

                        <i class="bi bi-arrow-left me-1"></i>

                        Kembali

                    </a>


                    <!-- TAMBAH -->

                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambah">

                        <i class="bi bi-plus-circle me-1"></i>

                        Tambah Sub Kriteria

                    </button>

                </div>

            </div>



            <!-- ==================================================
                 CARD TABEL
            ================================================== -->

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            id="tabelSubKriteria"
                            class="table table-bordered table-striped table-hover align-middle text-center">


                            <!-- ==================================================
                                 HEADER TABEL
                            ================================================== -->

                            <thead class="table-primary">

                                <tr>

                                    <th width="70">
                                        No
                                    </th>


                                    <th>

                                        <div class="fw-bold text-dark">

                                            Sub Kriteria
                                            <class="text-dark">
                                                <?= htmlspecialchars(
                                                    $kriteria['nama_kriteria']
                                                ); ?>
                                        </div>
                                    </th>


                                    <th width="120">
                                        Nilai
                                    </th>


                                    <th width="150">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <!-- ==================================================
                                 DATA
                            ================================================== -->

                            <tbody>

                            <?php

                            $no = 1;

                            if (mysqli_num_rows($querySub) > 0) {

                                while ($row = mysqli_fetch_assoc($querySub)) {

                            ?>

                                <tr>


                                    <!-- NO -->

                                    <td>

                                        <?= $no++; ?>

                                    </td>


                                    <!-- NAMA SUB KRITERIA -->

                                    <td class="text-start">

                                        <?= htmlspecialchars(
                                            $row['nama_subkriteria']
                                        ); ?>

                                    </td>


                                    <!-- NILAI -->

                                    <td>

                                        <span
                                            class="badge bg-primary px-3 py-2">

                                            <?= htmlspecialchars(
                                                $row['nilai']
                                            ); ?>

                                        </span>

                                    </td>


                                    <!-- AKSI -->

                                    <td>


                                        <!-- EDIT -->

                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit<?= (int) $row['id_subkriteria']; ?>"
                                            title="Edit Sub Kriteria">

                                            <i class="bi bi-pencil"></i>

                                        </button>


                                        <!-- HAPUS -->

                                        <a
                                            href="hapus-subkriteria.php?id=<?= (int) $row['id_subkriteria']; ?>&id_kriteria=<?= $id_kriteria; ?>"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus Sub Kriteria"
                                            onclick="return confirm('Yakin ingin menghapus sub kriteria ini?')">

                                            <i class="bi bi-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                            <?php

                                }

                            } else {

                            ?>

                                <!-- DATA KOSONG -->

                                <tr>

                                    <td
                                        colspan="4"
                                        class="text-center text-muted py-4">

                                        <i
                                            class="bi bi-info-circle me-1">
                                        </i>

                                        Belum terdapat sub kriteria
                                        untuk kriteria

                                        <strong>

                                            <?= htmlspecialchars(
                                                $kriteria['nama_kriteria']
                                            ); ?>

                                        </strong>.

                                    </td>

                                </tr>

                            <?php

                            }

                            ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- ==================================================
     MODAL EDIT SUB KRITERIA
================================================== -->

<?php

$queryEdit = mysqli_query($conn, "
    SELECT *
    FROM tb_subkriteria
    WHERE id_kriteria = '$id_kriteria'
    ORDER BY nilai DESC, id_subkriteria ASC
");


while ($edit = mysqli_fetch_assoc($queryEdit)) {

?>

<div
    class="modal fade"
    id="modalEdit<?= (int) $edit['id_subkriteria']; ?>"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                action="proses-subkriteria.php"
                method="POST">


                <!-- HEADER -->

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="bi bi-pencil-square me-1"></i>

                        Edit Sub Kriteria

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <!-- BODY -->

                <div class="modal-body">


                    <!-- ID SUB KRITERIA -->

                    <input
                        type="hidden"
                        name="id_subkriteria"
                        value="<?= (int) $edit['id_subkriteria']; ?>">


                    <!-- ID KRITERIA -->

                    <input
                        type="hidden"
                        name="id_kriteria"
                        value="<?= (int) $edit['id_kriteria']; ?>">


                    <!-- NAMA -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Nama Sub Kriteria

                        </label>

                        <input
                            type="text"
                            name="nama_subkriteria"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $edit['nama_subkriteria'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            required>

                    </div>


                    <!-- NILAI -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Nilai

                        </label>

                        <input
                            type="number"
                            name="nilai"
                            class="form-control"
                            value="<?= (int) $edit['nilai']; ?>"
                            min="1"
                            required>

                    </div>

                </div>


                <!-- FOOTER -->

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button
                        type="submit"
                        name="update"
                        value="1"
                        class="btn btn-warning">

                        <i class="bi bi-save me-1"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php

}

?>



<!-- ==================================================
     MODAL TAMBAH SUB KRITERIA
================================================== -->

<div
    class="modal fade"
    id="modalTambah"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                action="proses-subkriteria.php"
                method="POST">


                <!-- HEADER -->

                <div class="modal-header bg-primary text-white">

                    <h5 class="modal-title">

                        <i class="bi bi-plus-circle me-1"></i>

                        Tambah Sub Kriteria

                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <!-- BODY -->

                <div class="modal-body">


                    <!-- ID KRITERIA -->

                    <input
                        type="hidden"
                        name="id_kriteria"
                        value="<?= $id_kriteria; ?>">


                    <!-- INFORMASI KRITERIA -->

                    <div class="alert alert-light border">

                        <small class="text-muted">

                            Kriteria yang sedang dipilih:

                        </small>

                        <div class="fw-bold">

                            <?= htmlspecialchars(
                                $kriteria['nama_kriteria']
                            ); ?>

                        </div>

                    </div>


                    <!-- NAMA -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Nama Sub Kriteria

                        </label>

                        <input
                            type="text"
                            name="nama_subkriteria"
                            class="form-control"
                            placeholder="Masukkan nama sub kriteria"
                            required>

                    </div>


                    <!-- NILAI -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Nilai

                        </label>

                        <input
                            type="number"
                            name="nilai"
                            class="form-control"
                            min="1"
                            placeholder="Masukkan nilai"
                            required>

                    </div>

                </div>


                <!-- FOOTER -->

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button
                        type="submit"
                        name="simpan"
                        value="1"
                        class="btn btn-primary">

                        <i class="bi bi-save me-1"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



<?php include "../includes/footer.php"; ?>



<!-- ==================================================
     DATATABLES
================================================== -->

<script>

$(document).ready(function () {

    $('#tabelSubKriteria').DataTable({

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