<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

require "../vendor/autoload.php";
include "../config/koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

/* JUDUL LAPORAN */
$sheet->mergeCells('A1:C1');
$sheet->setCellValue('A1', 'LAPORAN HASIL PERANGKINGAN');
$sheet->mergeCells('A2:C2');
$sheet->setCellValue('A2', 'SISTEM PENDUKUNG KEPUTUSAN PENERIMA BANTUAN SOSIAL');
$sheet->mergeCells('A3:C3');
$sheet->setCellValue('A3', 'DESA SEMAMPIREJO');

/* INFO CETAK */
$sheet->setCellValue('A5', 'Tanggal Cetak');
$sheet->setCellValue('B5', ': '.date('d F Y'));
$sheet->setCellValue('A6', 'Jam Cetak');
$sheet->setCellValue('B6', ': '.date('H:i:s'));
$sheet->setCellValue('A7', 'Admin');
$sheet->setCellValue('B7', ': '.$_SESSION['username']);

/* HEADER TABEL */
$row = 9;
$sheet->setCellValue('A'.$row,'Ranking');
$sheet->setCellValue('B'.$row,'Nama Penerima');
$sheet->setCellValue('C'.$row,'Nilai Preferensi');

/* STYLE HEADER */
$sheet->getStyle("A{$row}:C{$row}")
->getFont()
->setBold(true);
$sheet->getStyle("A{$row}:C{$row}")
->getAlignment()
->setHorizontal(
\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
);

/* DATA */
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

$row++;
while($data=mysqli_fetch_assoc($query)){

    $sheet->setCellValue('A'.$row,$data['peringkat']);
    $sheet->setCellValue('B'.$row,$data['nama_penerima']);
    $sheet->setCellValue('C'.$row,round($data['nilai_v'],6));

    $row++;
}

/* AUTO SIZE */
foreach(range('A','C') as $column){
    $sheet->getColumnDimension($column)
    ->setAutoSize(true);
}

/* BORDER */
$style = [
    'borders'=>[
        'allBorders'=>[
            'borderStyle'=>
            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        ]
    ]
];

$sheet->getStyle('A9:C'.($row-1))->applyFromArray($style);

/* ALIGNMENT */
$sheet->getStyle('A9:C'.($row-1))
->getAlignment()
->setVertical(
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
);

/* DOWNLOAD */
$filename = "Laporan_Ranking_".date('Ymd_His').".xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit;