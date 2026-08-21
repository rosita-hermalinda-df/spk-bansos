<?php
include "../config/koneksi.php";
include "../includes/header.php";
include "../includes/sidebar.php";
include "../includes/navbar.php";

$queryAlternatif = mysqli_query($conn,"
SELECT *
FROM tb_alternatif
ORDER BY id_alternatif ASC
");

$queryKriteria = mysqli_query($conn,"
SELECT *
FROM tb_kriteria
ORDER BY id_kriteria ASC
");
?>

<div class="content">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3>
                <i class="bi bi-pencil-square"></i>
                Data Penilaian
            </h3>

        </div>

        <div class="card shadow-sm">

            <div class="card-body">

                <table
                    id="tabel"
                    class="table table-bordered table-striped text-center align-middle">

                    <thead class="table-primary">

                        <tr>

                            <th width="60">No</th>

                            <th>Nama Penerima</th>

                            <?php
                            $header = mysqli_query($conn,"
                            SELECT *
                            FROM tb_kriteria
                            ORDER BY id_kriteria ASC");

                            while($k=mysqli_fetch_assoc($header)){
                            ?>

                            <th>
                                <?= htmlspecialchars($k['kode_kriteria']); ?>
                            </th>

                            <?php } ?>

                            <th width="100">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        $no=1;

                        while($alt=mysqli_fetch_assoc($queryAlternatif)){
                        ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td class="text-start">
                                <?= htmlspecialchars($alt['nama_penerima']); ?>
                            </td>

                            <?php

                            $kolom = mysqli_query($conn,"
                            SELECT
                                k.id_kriteria,
                                p.id_subkriteria,
                                s.nama_subkriteria
                            FROM tb_kriteria k

                            LEFT JOIN tb_penilaian p
                            ON p.id_kriteria=k.id_kriteria
                            AND p.id_alternatif='".$alt['id_alternatif']."'

                            LEFT JOIN tb_subkriteria s
                            ON s.id_subkriteria=p.id_subkriteria

                            ORDER BY k.id_kriteria ASC
                            ");

                            while($nilai=mysqli_fetch_assoc($kolom)){
                            ?>

                            <td>

                                <?= $nilai['nama_subkriteria'] ?? '-'; ?>

                            </td>

                            <?php } ?>

                            <td>

                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm btn-edit"

                                    data-bs-toggle="modal"
                                    data-bs-target="#modalPenilaian"

                                    data-id="<?= $alt['id_alternatif']; ?>"
                                    data-nama="<?= htmlspecialchars($alt['nama_penerima']); ?>">

                                    <i class="bi bi-pencil"></i>

                                </button>

                            </td>

                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- Modal Penilaian -->
<div class="modal fade" id="modalPenilaian" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form action="proses-penilaian.php" method="POST">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="bi bi-pencil-square"></i>
                        Input Penilaian

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        name="id_alternatif"
                        id="id_alternatif">

                    <div class="alert alert-primary mb-3">

                        <b>Nama Penerima :</b>
                        <span id="nama_penerima"></span>

                    </div>

                    <?php

                    $listKriteria = mysqli_query($conn,"
                        SELECT *
                        FROM tb_kriteria
                        ORDER BY id_kriteria ASC
                    ");

                    while($k=mysqli_fetch_assoc($listKriteria)){

                    ?>

                    <div class="mb-3">

                        <label class="form-label fw-bold">

                            <?= htmlspecialchars($k['kode_kriteria']); ?>

                            -
                            
                            <?= htmlspecialchars($k['nama_kriteria']); ?>

                        </label>

                        <select
                            class="form-select subkriteria"
                            name="subkriteria[<?= $k['id_kriteria']; ?>]"
                            data-kriteria="<?= $k['id_kriteria']; ?>"
                            required>

                            <option value="">
                                -- Pilih Sub Kriteria --
                            </option>

                            <?php

                            $sub = mysqli_query($conn,"
                                SELECT *
                                FROM tb_subkriteria
                                WHERE id_kriteria='".$k['id_kriteria']."'
                                ORDER BY nilai DESC
                            ");

                            while($s=mysqli_fetch_assoc($sub)){

                            ?>

                            <option
                                value="<?= $s['id_subkriteria']; ?>">

                                <?= htmlspecialchars($s['nama_subkriteria']); ?>

                                (Nilai <?= $s['nilai']; ?>)

                            </option>

                            <?php } ?>

                        </select>

                    </div>

                    <?php } ?>

                </div>

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
                        class="btn btn-warning">

                        <i class="bi bi-check-circle"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<?php include "../includes/footer.php";?>


<script>
document.querySelectorAll(".btn-edit").forEach(function(btn){

    btn.addEventListener("click", function(){

        const id = this.dataset.id;
        const nama = this.dataset.nama;

        document.getElementById("id_alternatif").value = id;
        document.getElementById("nama_penerima").innerHTML = nama;

        // reset semua dropdown
        document.querySelectorAll(".subkriteria").forEach(function(select){
            select.value = "";
        });

        fetch("get-penilaian.php?id="+id)
        .then(response => response.json())
        .then(data => {

            data.forEach(function(item){

                const select = document.querySelector(
                    'select[data-kriteria="'+item.id_kriteria+'"]'
                );

                if(select){
                    select.value = item.id_subkriteria;
                }

            });

        });

    });

});
</script>