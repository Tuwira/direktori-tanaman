<?php
require('fpdf186/fpdf.php');
include 'koneksi.php';

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mengambil data berdasarkan ID
$query = "SELECT * FROM tanaman WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Periksa apakah data ditemukan
if (!$data) {
    die('Data tidak ditemukan!');
}

// Buat objek FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Judul
$pdf->Cell(0, 10, 'Detail Tanaman', 0, 1, 'C');

// Tambahkan data ke PDF
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'ID Tanaman:', 0, 0);
$pdf->Cell(100, 10, $data['id'], 0, 1);
$pdf->Cell(50, 10, 'Nama Tanaman:', 0, 0);
$pdf->Cell(100, 10, $data['nama_tanaman'], 0, 1);
$pdf->Cell(50, 10, 'Jenis Tanaman:', 0, 0);
$pdf->Cell(100, 10, $data['jenis_tanaman'], 0, 1);
$pdf->Cell(50, 10, 'Manfaat:', 0, 0);
$pdf->Cell(100, 10, $data['manfaat'], 0, 1);
$pdf->Cell(50, 10, 'Asal Tanaman:', 0, 0);
$pdf->Cell(100, 10, $data['asal_tanaman'], 0, 1);
$pdf->Cell(50, 10, 'Tahun Ditemukan:', 0, 0);
$pdf->Cell(100, 10, $data['tahun_ditemukan'], 0, 1);

// Tambahkan Foto
if (!empty($data['foto'])) {
    $foto_path = 'assets/images/' . $data['foto']; // Sesuaikan path ke folder foto
    if (file_exists($foto_path)) {
        $pdf->Ln(10); // Tambahkan jarak baris
        $pdf->Cell(50, 10, 'Foto Tanaman:', 0, 1);
        // Hitung posisi X agar gambar berada di tengah
        $pageWidth = $pdf->GetPageWidth(); // Lebar halaman
        $imageWidth = 50; // Lebar gambar
        $centerX = ($pageWidth - $imageWidth) / 2;

        // Cetak gambar di posisi tengah
        $pdf->Image($foto_path, $centerX, $pdf->GetY(), $imageWidth, 50); // Ukuran gambar 50x50 mm
        $pdf->Ln(60); // Tambahkan jarak setelah gambar
    } else {
        $pdf->Cell(50, 10, 'Foto tidak ditemukan.', 0, 1);
    }
} else {
    $pdf->Cell(50, 10, 'Foto tidak tersedia.', 0, 1);
}

// Output PDF
$pdf->Output('I', 'Detail_Tanaman_' . $data['id'] . '.pdf');
?>
