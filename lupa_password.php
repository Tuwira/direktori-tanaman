<?php
// Koneksi ke database
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];
    $new_password = $_POST['new_password'];

    // Query untuk memeriksa username dan jawaban keamanan di tabel admin
    $query = "SELECT * FROM admin WHERE username = '$username' AND security_question = '$security_question' AND security_answer = '$security_answer'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika data cocok, update password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Amankan password dengan hashing
        $update_query = "UPDATE admin SET password = '$hashed_password' WHERE username = '$username'";
        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Password berhasil diubah!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Gagal mengubah password.');</script>";
        }
    } else {
        echo "<script>alert('Username atau jawaban keamanan salah.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf6ea; /* Background hijau terang */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            border: 2px solid #2c6b2f; /* Border hijau */
        }

        h2 {
            text-align: center;
            color: #2c6b2f; /* Hijau tua */
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #2c6b2f; /* Hijau tua */
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="password"], select {
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%; /* Memastikan input dan select mengisi lebar container */
            box-sizing: border-box; /* Menambahkan padding dalam perhitungan lebar */
        }

        button {
            padding: 12px;
            background-color: #2c6b2f; /* Hijau muda */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #1f4d28; /* Hijau lebih gelap saat hover */
        }

        .form-container input, .form-container select {
            width: 100%;
        }

        .back-button {
            background-color: #f44336; /* Merah */
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            width: 100%; /* Agar tombol kembali selebar form */
        }

        .back-button:hover {
            background-color: #d32f2f; /* Merah lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Lupa Password</h2>
        <form method="POST" action="lupa_password.php">
            <label for="username">Nama Pengguna:</label>
            <input type="text" name="username" required>
            
            <label for="security_question">Pertanyaan Keamanan:</label>
            <select name="security_question" required>
                <option value="Nama ibu kandung?">Nama ibu kandung?</option>
                <option value="Apa hari favorit?">Apa hari favorit?</option>
                <option value="Nama sekolah dasar?">Nama sekolah dasar?</option>
            </select>
            
            <label for="security_answer">Jawaban Keamanan:</label>
            <input type="text" name="security_answer" required>
            
            <label for="new_password">Kata Sandi Baru:</label>
            <input type="password" name="new_password" required>
            
            <button type="submit" name="submit">Simpan Kata Sandi</button>
        </form>

        <!-- Tombol Kembali -->
        <a href="login.php">
            <button class="back-button">Kembali</button>
        </a>
    </div>
</body>
</html>
