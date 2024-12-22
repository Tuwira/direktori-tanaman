<?php
require('fpdf186/fpdf.php');
include 'koneksi.php';

// Create PDF instance in landscape orientation
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

// Add header
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 20, 'Direktori Tanaman', 0, 1, 'C');

// Set table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'ID', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama Tanaman', 1, 0, 'C');
$pdf->Cell(30, 10, 'Jenis', 1, 0, 'C');
$pdf->Cell(60, 10, 'Manfaat', 1, 0, 'C');
$pdf->Cell(40, 10, 'Asal', 1, 0, 'C');
$pdf->Cell(30, 10, 'Foto', 1, 0, 'C');
$pdf->Cell(40, 10, 'Tahun Ditemukan', 1, 1, 'C');

// Set table data
$pdf->SetFont('Arial', '', 12);
$query = "SELECT * FROM tanaman";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $rowHeight = 30; // Tinggi tetap untuk semua baris
    
    // Kolom ID
    $pdf->Cell(20, $rowHeight, $row['id'], 1, 0, 'C');

    // Kolom Nama Tanaman
    $pdf->Cell(40, $rowHeight, $row['nama_tanaman'], 1, 0, 'C');

    // Kolom Jenis
    $pdf->Cell(30, $rowHeight, $row['jenis_tanaman'], 1, 0, 'C');

    // Kolom Manfaat (gunakan MultiCell secara terbatas)
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(60, $rowHeight, $row['manfaat'], 1, 'C'); // Tinggi baris dalam MultiCell tetap 10
    $pdf->SetXY($x + 60, $y);

    // Kolom Asal
    $pdf->Cell(40, $rowHeight, $row['asal_tanaman'], 1, 0, 'C');

    // Kolom Foto
    $fotoPath = $_SERVER['DOCUMENT_ROOT'] . '/direktori_tanaman/assets/images/' . $row['foto'];
    if (file_exists($fotoPath) && !empty($row['foto'])) {
        $xFoto = $pdf->GetX();
        $yFoto = $pdf->GetY();
        $pdf->Cell(30, $rowHeight, '', 1, 0, 'C'); // Sel kosong
        $pdf->Image($fotoPath, $xFoto + 2, $yFoto + 2, 26, 26);
    } else {
        $pdf->Cell(30, $rowHeight, 'No image', 1, 0, 'C');
    }

    // Kolom Tahun Ditemukan
    $pdf->Cell(40, $rowHeight, $row['tahun_ditemukan'], 1, 1, 'C');
}

// Output the PDF
$pdf->Output();
?>
