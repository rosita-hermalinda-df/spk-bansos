<?php
include "../includes/header.php";
include "../includes/sidebar.php";
include "../includes/navbar.php";
include "../config/koneksi.php";

    $query = mysqli_query($conn, "
        SELECT *
        FROM tb_alternatif
        ORDER BY id_alternatif ASC
    ");
?>

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3><i class="bi bi-people-fill"></i> Data Calon Penerima</h3>
            
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Penerima</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        $no = 1;
                        while($row = mysqli_fetch_assoc($query)){
                        ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="text-start">
                                <?= $row['nama_penerima']; ?>
                            </td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm btn-edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit"
                                    data-id="<?= $row['id_alternatif']; ?>"
                                    data-nama="<?= htmlspecialchars($row['nama_penerima']); ?>">

                                    <i class="bi bi-pencil"></i>

                                </button>
                                
                                <a href="hapus-alternatif.php?id=<?= $row['id_alternatif']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>

                        </tbody>
                </table>
            </div>
        </div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="proses-alternatif.php" method="POST">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Calon Penerima
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Penerima
                        </label>

                        <input type="text"
                               name="nama_penerima"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            name="simpan"
                            class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="proses-edit-alternatif.php" method="POST">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square"></i>
                        Edit Calon Penerima
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
                        id="edit_id">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Penerima
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="nama_penerima"
                            id="edit_nama"
                            required>

                    </div>

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
                        name="update"
                        class="btn btn-warning">

                        <i class="bi bi-check-circle"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>
<?php include "../includes/footer.php";?>
</div>

<script>

document.querySelectorAll(".btn-edit").forEach(function(btn){

    btn.addEventListener("click", function(){

        document.getElementById("edit_id").value =
            this.dataset.id;

        document.getElementById("edit_nama").value =
            this.dataset.nama;

    });

});

</script>

