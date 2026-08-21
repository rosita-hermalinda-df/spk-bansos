<?php
include "../config/koneksi.php";

if(isset($_POST['update'])){
$id_user = $_POST['id_user'];
$username = mysqli_real_escape_string($conn, $_POST['username']);
$role = $_POST['role'];
$password = $_POST['password'];

if(!empty($password)){
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$query = mysqli_query($conn,
    "UPDATE tb_user SET
        username='$username',
        password='$password_hash',
        role='$role'
        WHERE id_user='$id_user'
    ");
}else{
    $query = mysqli_query($conn,
        "UPDATE tb_user SET
        username='$username',
        role='$role'
        WHERE id_user='$id_user'
    ");
}
if($query){
    echo "
        <script>
            alert('Data user berhasil diperbarui');
            window.location='user.php';
        </script>
    ";
}else{
    echo "
        <script>
            alert('Data user gagal diperbarui');
            window.location='user.php';
        </script>
    ";
}
}
?>