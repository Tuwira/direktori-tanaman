<?php
include 'koneksi.php';
session_start();

// Cek login admin
if (isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Pencarian data (jika ada)
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
if ($keyword) {
    $query = "SELECT * FROM tanaman WHERE nama_tanaman LIKE '%$keyword%' OR jenis_tanaman LIKE '%$keyword%' OR manfaat LIKE '%$keyword%'";
} else {
    $query = "SELECT * FROM tanaman";
}
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Direktori Tanaman</title>
    <style>
        /* Styling untuk halaman utama */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333; /* Warna teks lebih gelap untuk kontras yang lebih baik */
        }

        .container {
            text-align: center;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        h1 {
            color: #2c3e50; /* Warna teks lebih gelap dan cerah */
            font-size: 42px;
            margin-bottom: 20px;
        }

        p {
            color: #555; /* Menggunakan warna teks yang lebih terang dan jelas */
            font-size: 18px;
            margin-bottom: 30px;
        }

        .choice-container {
            margin-top: 30px;
        }

        .button {
            text-decoration: none;
            display: inline-block;
            padding: 15px 30px;
            color: #fff;
            background-color: #2c6b2f;
            border-radius: 5px;
            margin: 10px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #1f4d28;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Direktori Tanaman</h1>
        <p>Direktori ini menyediakan informasi tentang berbagai jenis tanaman, manfaatnya, asal, dan tahun ditemukan.</p>
        <p>Silakan pilih salah satu opsi di bawah ini:</p>
        
        <!-- Opsi login Pengunjung dan Admin -->
        <div class="choice-container">
            <a href="pengunjung.php" class="button">Lihat sebagai Pengunjung</a>
            <a href="login.php" class="button">Masuk Sebagai Admin</a>
        </div>

    </div>
</body>
</html>
