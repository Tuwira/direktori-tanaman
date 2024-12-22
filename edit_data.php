<?php
include 'koneksi.php';

// Cek apakah ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data tanaman berdasarkan ID
    $query = "SELECT * FROM tanaman WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Jika data ditemukan
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}

// Proses update data setelah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama_tanaman'];
    $jenis = $_POST['jenis_tanaman'];
    $manfaat = $_POST['manfaat'];
    $asal = $_POST['asal_tanaman'];
    $tahun_ditemukan = $_POST['tahun_ditemukan'];
    $foto = $_POST['foto_lama'];

    if (!empty($_FILES['foto']['name'])) {
        $foto = basename($_FILES['foto']['name']);
        $target_dir = "assets/images/";
        $target_file = $target_dir . $foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    }

    // Update data ke database
    $query_update = "UPDATE tanaman SET 
                    id = '$id', 
                    nama_tanaman = '$nama', 
                    jenis_tanaman = '$jenis', 
                    manfaat = '$manfaat', 
                    asal_tanaman = '$asal', 
                    foto = '$foto', 
                    tahun_ditemukan = '$tahun_ditemukan' 
                    WHERE id = '$row[id]'";

    if (mysqli_query($conn, $query_update)) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Tanaman</title>
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
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
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
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            padding: 8px;
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
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Data Tanaman</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?= $row['id'] ?>" required>

            <label for="nama_tanaman">Nama Tanaman:</label>
            <input type="text" id="nama_tanaman" name="nama_tanaman" value="<?= $row['nama_tanaman'] ?>" required>

            <label for="jenis_tanaman">Jenis:</label>
            <input type="text" id="jenis_tanaman" name="jenis_tanaman" value="<?= $row['jenis_tanaman'] ?>" required>

            <label for="manfaat">Manfaat:</label>
            <input type="text" id="manfaat" name="manfaat" value="<?= $row['manfaat'] ?>" required>

            <label for="asal_tanaman">Asal:</label>
            <input type="text" id="asal_tanaman" name="asal_tanaman" value="<?= $row['asal_tanaman'] ?>" required>

            <label for="tahun_ditemukan">Tahun Ditemukan:</label>
            <input type="number" id="tahun_ditemukan" name="tahun_ditemukan" value="<?= $row['tahun_ditemukan'] ?>" required>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">

            <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
