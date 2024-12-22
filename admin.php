<?php
include 'koneksi.php';
session_start();

// Cek login admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

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
    <title>Halaman Admin - Direktori Tanaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf6ea; /* Background hijau terang */
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #2c6b2f; /* Hijau tua */
        }
        .container {
            margin: auto;
            width: 80%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #2c6b2f; /* Hijau tua */
            color: #fff;
        }
        td {
            background-color: #f9f9f9;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #2c6b2f; /* Hijau tua */
            border-radius: 5px;
            margin: 3px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        a.button:hover {
            background-color: #1f4d28; /* Hijau lebih gelap saat hover */
        }
        /* Tombol Logout dengan latar belakang merah dan ukuran lebih besar */
        .logout-button {
            background-color: #e74c3c !important;
            padding: 15px 30px;
            font-size: 18px;
            margin-top: 20px;
            text-align: center;
            width: 200px;
            display: inline-block;
            border-radius: 8px;
        }
        .logout-button:hover {
            background-color: #c0392b !important;
        }
        .logout-container {
            text-align: center;
        }
        /* Menata tombol dalam kolom aksi */
        .aksi-buttons {
            display: flex;
            justify-content: center;
            gap: 5px;
        }
        /* Tombol "Tambah Data" dan Pencarian di samping-sampingan */
        .top-buttons-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            gap: 20px; /* Jarak antara tombol */
        }
        /* Styling untuk tombol pencarian */
        .search-input {
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 250px;
        }
        .search-button {
            padding: 8px 16px;
            font-size: 16px;
            background-color: #2c6b2f; /* Hijau */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .search-button:hover {
            background-color: #1f4d28; /* Hijau lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <h1>Halaman Admin - Direktori Tanaman</h1>
    <div class="container">
        <!-- Tombol "Tambah Data" dan Form Pencarian disusun samping-sampingan -->
        <div class="top-buttons-container">
            <a href="tambah_data.php" class="button">Tambah Data</a>

            <!-- Form Pencarian -->
            <form method="POST" action="">
                <input type="text" name="search" class="search-input" value="<?= htmlspecialchars($search_keyword) ?>" placeholder="Cari Tanaman...">
                <button type="submit" class="search-button">Cari</button>
            </form>
        </div>

        <!-- Tabel Tanaman -->
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
                <td><?= $row['id']; ?></td>
                <td><?= $row['nama_tanaman']; ?></td>
                <td><?= $row['jenis_tanaman']; ?></td>
                <td><?= $row['manfaat']; ?></td>
                <td><?= $row['asal_tanaman']; ?></td>
                <td><?= $row['tahun_ditemukan']; ?></td>
                <td>
                    <?php if ($row['foto']): ?>
                    <img src="assets/images/<?= $row['foto']; ?>" alt="Foto" width="100">
                    <?php else: ?>
                    <em>Tidak Ada Foto</em>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="aksi-buttons">
                        <a href="edit_data.php?id=<?= $row['id']; ?>" class="button">Edit</a>
                        <a href="delete_data.php?id=<?= $row['id']; ?>" class="button" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Tombol Logout dipindahkan ke bawah dengan background merah -->
        <div class="logout-container">
            <a href="logout.php" class="button logout-button">Keluar</a>
        </div>
    </div>
</body>
</html>
