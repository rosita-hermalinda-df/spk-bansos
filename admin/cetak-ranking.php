<?php
include "../includes/session.php";
require "../vendor/autoload.php";
include "../config/koneksi.php";

date_default_timezone_set('Asia/Jakarta');

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$query = mysqli_query($conn,"
    SELECT
        r.peringkat,
        a.nama_penerima,
        r.nilai_v
    FROM tb_ranking r
    JOIN tb_alternatif a
    ON r.id_alternatif=a.id_alternatif
    ORDER BY r.peringkat ASC
");

$tanggal = date('d F Y');
$jam = date('H:i:s');

$html = '

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
}

h2,h3,p{
    margin:0;
    padding:0;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table th,
table td{
    border:1px solid #000;
    padding:8px;
    text-align:center;
}

th{
    background:#e9ecef;
}

.text-left{
    text-align:left;
}

</style>

<h2 align="center">
LAPORAN HASIL PERANGKINGAN
</h2>

<h3 align="center">
PENERIMA BANTUAN SOSIAL
</h3>

<p align="center">
Desa Semampirejo
</p>

<hr>

<table style="border:none;margin-top:10px;">

<tr>

<td style="border:none;width:50%;text-align:left;">
Tanggal Cetak :
'.$tanggal.'
<br>
Jam Cetak :
'.$jam.'
</td>

<td style="border:none;width:50%;text-align:right;">
Admin :
'.htmlspecialchars($_SESSION['username']).'
</td>

</tr>

</table>

<table>

<tr>

<th width="60">Ranking</th>

<th>Nama Penerima</th>

<th width="150">Nilai Preferensi</th>

</tr>

';

while($row=mysqli_fetch_assoc($query)){

$html .= '

<tr>

<td>'.$row['peringkat'].'</td>

<td class="text-left">'.$row['nama_penerima'].'</td>

<td>'.number_format($row['nilai_v'],6,'.','').'</td>

</tr>

';

}

$html .= '

</table>

<br><br><br>

<table style="border:none;">

<tr>

<td style="border:none;text-align:right;">

Mengetahui,

<br><br><br><br><br>

_________________________

<br>

Kepala Desa

</td>

</tr>

</table>

';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4','portrait');

$dompdf->render();

$dompdf->stream(
"Laporan_Ranking.pdf",
["Attachment"=>false]
);
?>