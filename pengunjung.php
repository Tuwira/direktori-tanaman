<?php
include 'koneksi.php';

// Ambil keyword pencarian jika ada
$search_keyword = isset($_POST['search']) ? $_POST['search'] : '';

// Query untuk mengambil data tanaman, dengan kondisi pencarian
$query = "SELECT * FROM tanaman WHERE nama_tanaman LIKE '%$search_keyword%' OR jenis_tanaman LIKE '%$search_keyword%'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Direktori Tanaman - Pengunjung</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eaf6ea;
            color: #333;
        }
        .container {
            text-align: center;
            padding: 50px 20px;
        }
        h1 {
            color: #2c6b2f;
            font-size: 36px;
            margin-bottom: 30px;
        }
        .button {
            text-decoration: none;
            display: inline-block;
            padding: 12px 24px;
            color: #fff;
            background-color: #e74c3c; /* Mengubah warna latar belakang menjadi merah */
            border-radius: 8px;
            margin: 10px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #c0392b; /* Efek hover menjadi merah lebih gelap */
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: left;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 14px;
            text-align: left;
        }
        th {
            background-color: #2c6b2f;
            color: #fff;
        }
        td {
            background-color: #f9f9f9;
        }
        td img {
            border-radius: 5px;
        }
        .back-button {
            margin-top: 20px;
        }
        /* Tombol Cetak PDF */
        .action-button {
            text-decoration: none;
            background-color: #4caf50;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .action-button:hover {
            background-color: #388e3c;
        }
        /* Form Pencarian */
        .search-form {
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
        }
        .search-input {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 250px;
            margin-right: 10px;
        }
        .search-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #2c6b2f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .search-button:hover {
            background-color: #1f4d28;
        }
        .action-button-container {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Direktori Tanaman</h1>

        <!-- Form Pencarian dan Tombol Cetak PDF Seluruh Data -->
        <form class="search-form" method="POST" action="">
            <input type="text" name="search" class="search-input" value="<?= htmlspecialchars($search_keyword) ?>" placeholder="Cari Tanaman...">
            <button type="submit" class="search-button">Cari</button>

            <!-- Tombol Cetak PDF Seluruh Data -->
            <a href="cetak_pdf_seluruh_data.php" class="action-button action-button-container">Cetak PDF Seluruh Data</a>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Nama Tanaman</th>
                <th>Jenis</th>
                <th>Manfaat</th>
                <th>Asal</th>
                <th>Tahun Ditemukan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nama_tanaman'] ?></td>
                    <td><?= $row['jenis_tanaman'] ?></td>
                    <td><?= $row['manfaat'] ?></td>
                    <td><?= $row['asal_tanaman'] ?></td>
                    <td><?= $row['tahun_ditemukan'] ?></td>
                    <td><?= $row['foto'] ? "<img src='assets/images/{$row['foto']}' width='80'>" : "Tidak ada foto" ?></td>
                    <td>
                        <a href="cetak_pdf_satu_baris_data.php?id=<?= $row['id'] ?>" class="action-button">Cetak PDF</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div style="text-align: center;">
            <a href="index.php" class="button">Kembali ke Menu Pilihan</a>
        </div>
    </div>
</body>
</html>
