<?php
include 'koneksi.php';

// Proses tambah data setelah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // ID yang dimasukkan manual
    $nama = $_POST['nama_tanaman'];
    $jenis = $_POST['jenis_tanaman'];
    $manfaat = $_POST['manfaat'];
    $asal = $_POST['asal_tanaman'];
    $tahun_ditemukan = $_POST['tahun_ditemukan'];
    $foto = '';

    // Cek apakah ID sudah ada di database
    $query_check = "SELECT * FROM tanaman WHERE id = '$id'";
    $result_check = mysqli_query($conn, $query_check);
    if (mysqli_num_rows($result_check) > 0) {
        echo "ID sudah digunakan, harap pilih ID yang unik.";
    } else {
        // Upload foto jika ada yang diubah
        if (!empty($_FILES['foto']['name'])) {
            $foto = basename($_FILES['foto']['name']);
            $target_dir = "assets/images/";
            $target_file = $target_dir . $foto;
            move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
        }

        // Insert data ke database
        $query_insert = "INSERT INTO tanaman (id, nama_tanaman, jenis_tanaman, manfaat, asal_tanaman, foto, tahun_ditemukan) 
                         VALUES ('$id', '$nama', '$jenis', '$manfaat', '$asal', '$foto', '$tahun_ditemukan')";

        if (mysqli_query($conn, $query_insert)) {
            header("Location: admin.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Tanaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf6ea;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            border: 2px solid #2c6b2f; /* Border hijau */
        }

        h1 {
            text-align: center;
            color: #2c6b2f;
            font-size: 20px;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            color: #2c6b2f;
        }

        input[type="text"], input[type="number"], input[type="file"] {
            padding: 6px;
            margin: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #45a049;
        }

        .exit-button {
            background-color: #e74c3c;
            padding: 6px 12px;
            margin-top: 10px;
        }

        .exit-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Tambah Data Tanaman</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" maxlength="3" required>

            <label for="nama_tanaman">Nama Tanaman:</label>
            <input type="text" id="nama_tanaman" name="nama_tanaman" required>

            <label for="jenis_tanaman">Jenis:</label>
            <input type="text" id="jenis_tanaman" name="jenis_tanaman" required>

            <label for="manfaat">Manfaat:</label>
            <input type="text" id="manfaat" name="manfaat" required>

            <label for="asal_tanaman">Asal:</label>
            <input type="text" id="asal_tanaman" name="asal_tanaman" required>

            <label for="tahun_ditemukan">Tahun Ditemukan:</label>
            <input type="number" id="tahun_ditemukan" name="tahun_ditemukan" required>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">

            <button type="submit">Simpan</button>
            <a href="admin.php"><button type="button" class="exit-button">Keluar</button></a>
        </form>
    </div>
</body>
</html>
