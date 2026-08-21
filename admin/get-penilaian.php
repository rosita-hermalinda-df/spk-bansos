<?php

include "../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn,"
SELECT
    id_kriteria,
    id_subkriteria
FROM tb_penilaian
WHERE id_alternatif='$id'
");

$data = [];

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}

header("Content-Type: application/json");
echo json_encode($data);