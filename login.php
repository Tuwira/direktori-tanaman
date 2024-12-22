<?php
// Koneksi ke database
include 'koneksi.php';
session_start();

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = true;  // Set session untuk login
            header("Location: admin.php");
            exit;
        } else {
            $login_error = "Kata sandi salah!";
        }
    } else {
        $login_error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin</title>
    <style>
        /* Styling untuk form login */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eaf6ea; /* Background hijau terang */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #2c6b2f; /* Border hijau */
        }

        h1 {
            margin-bottom: 20px;
            color: #2c6b2f; /* Hijau tua */
            text-align: center; /* Menengahkan judul */
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center; /* Menengahkan kolom input dan tombol */
            gap: 15px;
        }

        input {
            width: 80%; /* Membuat lebar input lebih kecil untuk menengahkannya */
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #2c6b2f;
            color: #333;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: white;
            background-color: #2c6b2f; /* Warna hijau tombol */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1f4d28; /* Efek hover hijau lebih gelap */
        }

        p, .back-button a {
            text-align: center; 
            display: block; 
            margin: 5; 
        }

        .link {
            margin-top: 5px;
        }

        .link a {
            color: #2c6b2f; /* Tautan hijau */
            text-decoration: none;
            font-size: 16px;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .back-button a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            border-radius: 5px;
        }

        .back-button a:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Masuk Admin</h1>
        
        <!-- Form login -->
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Nama Pengguna" required>
            <input type="password" name="password" placeholder="Kata Sandi" required>
            <button type="submit" name="login">Masuk</button>
            
            <!-- Tampilkan pesan error jika ada -->
            <?php if (isset($login_error)) { echo "<p class='error-message'>$login_error</p>"; } ?>
        </form>

        <!-- Link ke form lupa kata sandi -->
        <div class="link">
            <p><a href="lupa_password.php">Lupa Kata Sandi?</a></p>
        </div>

        <!-- Link ke form register -->
        <div class="link">
            <p>Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
        </div>

        <!-- Tombol Kembali ke Menu Pilihan -->
        <div class="back-button">
            <a href="index.php">Kembali ke Menu Pilihan</a>
        </div>
    </div>

</body>
</html>
