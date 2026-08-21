<?php
include "../config/koneksi.php";
include "../includes/header.php";
include "../includes/sidebar.php";
include "../includes/navbar.php";

$data = mysqli_query($conn,
"SELECT * FROM tb_user ORDER BY id_user DESC");

?>


<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3><i class="bi bi-person-fill"></i>
                Data User
            </h3>
            
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="bi bi-plus-circle"></i>
                    Tambah User
            </button>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body">
                <table id="tabel" class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        $no=1;
                        while($row=mysqli_fetch_assoc($data)){
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><span class="badge bg-info"><?= $row['role']; ?></span></td>
                            <td>
                                <button
                                    class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit<?= $row['id_user']; ?>">
                                        <i class="bi bi-pencil"></i>
                                </button>
                                
                                <a href="hapus-user.php?id=<?= $row['id_user']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data user?')">
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
"SELECT * FROM tb_user ORDER BY id_user DESC");
while($row=mysqli_fetch_assoc($dataEdit)){
?>

<div class="modal fade" id="edit<?= $row['id_user']; ?>" tabindex="-1">
    <div class="modal-dialog" >
        <div class="modal-content">
            <form action="proses-edit-user.php" method="POST">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square"></i>
                            Edit User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id_user" value="<?= $row['id_user']; ?>">

                    <div class="mb-3">
                        <label>Username</label>                        
                        <input type="text" name="username" class="form-control" 
                        value="<?= $row['username']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password"
                            name="password"
                            class="form-control"
                            placeholder="Kosongkan jika tidak diganti">
                    </div>
                    
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-select">
                            <option value="Admin" <?= $row['role']=="Admin"?"selected":""; ?>>
                                Admin
                            </option>
                            
                            <option value="Kepala Desa"<?= $row['role']=="Kepala Desa"?"selected":""; ?>>
                                Kepala Desa
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button"class="btn btn-secondary"data-bs-dismiss="modal">
                        Batal
                    </button>
                    
                    <button type="submit"name="update"class="btn btn-warning">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- MODAL TAMBAH -->
<div class="modal fade"id="tambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="proses-user.php"method="POST">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-person-plus"></i>
                            Tambah User
                    </h5>

                    <button type="button"class="btn-close"data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text"name="username"class="form-control"required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password"name="password"class="form-control"required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role"class="form-select">
                            <option value="Admin">Admin</option>
                            <option value="Kepala Desa">Kepala Desa</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button"class="btn btn-secondary"data-bs-dismiss="modal">
                        Batal
                    </button>
                    
                    <button type="submit"name="simpan"class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "../includes/footer.php";?>
