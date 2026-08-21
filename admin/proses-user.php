<?php
include "../config/koneksi.php";
if(isset($_POST['simpan'])){

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];
$role = $_POST['role'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$query = mysqli_query($conn,
    "INSERT INTO tb_user
    (username,password,role)
    VALUES
    ('$username','$password_hash','$role')"
);

if($query){
echo "
    <script>
        alert('Data user berhasil ditambahkan');
        window.location='user.php';
    </script>
";
}else{
echo "
    <script>
        alert('Data user gagal ditambahkan');
        window.location='user.php';
    </script>
";
}
}
?>