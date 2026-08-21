<?php
include "../config/koneksi.php";

$id_user = $_GET['id'];
$query = mysqli_query($conn,
    "DELETE FROM tb_user 
    WHERE id_user='$id_user'"
);

if($query){
    echo "
        <script>
            alert('Data user berhasil dihapus');
            window.location='user.php';
        </script>
    ";
}else{
    echo "
        <script>
            alert('Data user gagal dihapus');
            window.location='user.php';
        </script>
    ";
}

?>