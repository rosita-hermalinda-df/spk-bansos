<?php
include "../config/koneksi.php";
include "../includes/header.php";
include "../includes/sidebar.php";
include "../includes/navbar.php";

$query = mysqli_query($conn,"
    SELECT
        i.*,
        u.username
    FROM tb_informasi i
    LEFT JOIN tb_user u
        ON i.id_user = u.id_user
    ORDER BY i.tanggal DESC
");
?>

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>
        <i class="bi bi-megaphone-fill text-primary"></i>
        Data Informasi
    </h3>

    <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah">

        <i class="bi bi-plus-circle"></i>
            Tambah Informasi
    </button>

</div>

<!-- TABEL INFORMASI -->
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <b>Daftar Informasi</b>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table
            id="tabelInformasi"
            class="table table-bordered table-striped table-hover align-middle text-center">
            
            <thead class="table-primary">
                <tr>
                    <th width="60">No</th>
                    <th>Judul</th>
                    <th>Isi Informasi</th>
                    <th width="150">Tanggal</th>
                    <th width="120">Admin</th>
                    <th width="170">Aksi</th>
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
                        <?= htmlspecialchars($row['judul']); ?>
                    </td>
                    <td class="text-start">
                        <?= substr(strip_tags($row['isi']),0,100); ?>...
                    </td>
                    <td>
                        <?= date('d-m-Y',strtotime($row['tanggal'])); ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($row['username']); ?>
                    </td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-warning btn-sm btn-edit"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEdit"

                            data-id="<?= $row['id_informasi']; ?>"
                            data-judul="<?= htmlspecialchars($row['judul'], ENT_QUOTES); ?>"
                            data-isi="<?= htmlspecialchars($row['isi'], ENT_QUOTES); ?>">

                            <i class="bi bi-pencil-square"></i>

                        </button>
                        
                        <a href="hapus-informasi.php?id=<?= $row['id_informasi']; ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus informasi ini?')">
                        <i class="bi bi-trash"></i>
                        </a>
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

<!-- MODAL TAMBAH INFORMASI -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="proses-informasi.php" method="POST">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle-fill"></i>
                        Tambah Informasi
                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">
                            Judul Informasi
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Isi Informasi
                        </label>

                        <textarea
                            name="isi"
                            rows="6"
                            class="form-control"
                            required></textarea>
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
                        class="btn btn-primary">
                        <i class="bi bi-save"></i>
                        Simpan
                    </button>
             </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="proses-edit-informasi.php" method="POST">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">
                        Edit Informasi
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
                        name="id_informasi"
                        id="edit_id">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input
                            type="text"
                            name="judul"
                            id="edit_judul"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Isi Informasi</label>
                        <textarea
                            name="isi"
                            id="edit_isi"
                            rows="6"
                            class="form-control"
                            required></textarea>
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
                        class="btn btn-warning">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "../includes/footer.php";?>

<script>
$(document).ready(function(){
    $('#tabelInformasi').DataTable({
        responsive:true,
        language:{
            search:"Cari :",
            lengthMenu:"Tampilkan _MENU_ data",
            info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            zeroRecords:"Data tidak ditemukan",
            infoEmpty:"Tidak ada data",
            paginate:{
                previous:"Sebelumnya",
                next:"Berikutnya"
            }
        }
    });
    
    $('.btn-edit').on('click', function(){
    $('#edit_id').val($(this).data('id'));
    $('#edit_judul').val($(this).data('judul'));
    $('#edit_isi').val($(this).data('isi'));
    });
});
</script>