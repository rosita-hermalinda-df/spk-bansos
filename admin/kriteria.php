<?php
include "../config/koneksi.php";
include "../includes/header.php";
include "../includes/sidebar.php";
include "../includes/navbar.php";

$data = mysqli_query($conn, 
"SELECT * FROM tb_kriteria ORDER BY id_kriteria ASC");

$totalBobotQuery = mysqli_query($conn,
"SELECT SUM(bobot) AS total FROM tb_kriteria");

$totalBobot = mysqli_fetch_assoc($totalBobotQuery)['total'];

?>

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3><i class="bi bi-list-check"></i>Data Kriteria</h3>
            
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="bi bi-plus-circle"></i>
                    Tambah Kriteria
            </button>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Jenis</th>
                            <th>Bobot Awal</th>
                            <th>Bobot Normalisasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($data)){
                            $normalisasi = $row['bobot']/$totalBobot;
                        ?>
                        
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['kode_kriteria']; ?></td>
                            <td><?= $row['nama_kriteria']; ?></td>
                            <td><span class="badge bg-info"><?= $row['jenis']; ?></span></td>
                            <td><?= $row['bobot']; ?></td>
                            <td><?= number_format($normalisasi,2); ?></td>
                            <td>
                                <a href="subkriteria.php?id=<?= $row['id_kriteria']; ?>"
                                    class="btn btn-info btn-sm">
                                    <i class="bi bi-list-ul"></i>
                                </a>

                                <button
                                    class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit<?= $row['id_kriteria']; ?>">
                                        <i class="bi bi-pencil"></i>
                                </button>

                                <a href="hapus-kriteria.php?id=<?= $row['id_kriteria']; ?>"
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
    </div>
</div>

<!-- MODAL EDIT -->
<?php

$dataEdit = mysqli_query($conn,
"SELECT * FROM tb_kriteria ORDER BY id_kriteria ASC");

while($row=mysqli_fetch_assoc($dataEdit)){

?>

<div class="modal fade" id="edit<?= $row['id_kriteria']; ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="proses-edit-kriteria.php" method="POST">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square"></i>
                        Edit Kriteria
                    </h5>
                    
                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>
                
                <div class="modal-body">
                    <input type="hidden" name="id_kriteria" value="<?= $row['id_kriteria']; ?>">
                    <div class="mb-3">
                        <label>Kode Kriteria</label>
                        <input type="text"
                            name="kode_kriteria"
                            class="form-control"
                            value="<?= $row['kode_kriteria']; ?>"
                            required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Nama Kriteria</label>
                        <input type="text"
                            name="nama_kriteria"
                            class="form-control"
                            value="<?= $row['nama_kriteria']; ?>"
                            required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Bobot Awal</label>
                        <input type="number"
                            name="bobot"
                            class="form-control"
                            value="<?= $row['bobot']; ?>"
                            required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Jenis</label>
                        <select name="jenis"class="form-select">
                            <option value="Benefit"<?= $row['jenis']=="Benefit"?'selected':''; ?>>
                                Benefit
                            </option>
                            <option value="Cost"<?= $row['jenis']=="Cost"?'selected':''; ?>>
                                Cost
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                            Batal
                    </button>
                    
                    <button type="submit"
                        name="update"
                        class="btn btn-warning">
                            Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php } ?>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="proses-kriteria.php" method="POST">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        Tambah Kriteria
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kode Kriteria</label>
                        <input type="text" name="kode_kriteria" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Bobot Awal</label>
                        <input type="number" name="bobot" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Jenis</label>
                        <select name="jenis" class="form-select">
                            <option value="Benefit">
                                Benefit
                            </option><option value="Cost">
                                Cost
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    
                    <button type="submit" name="simpan" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "../includes/footer.php";
?>