<?php
// Koneksi ke database
include 'koneksi.php';
session_start();

// Proses registrasi
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
    $security_answer = mysqli_real_escape_string($conn, $_POST['security_answer']);

    // Cek apakah username sudah terdaftar
    $check_query = "SELECT * FROM admin WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $register_error = "Username sudah terdaftar. Silakan pilih username lain.";
    } else {
        // Query untuk menambahkan user baru
        $query = "INSERT INTO admin (username, password, security_question, security_answer) 
                  VALUES ('$username', '$password', '$security_question', '$security_answer')";
        if (mysqli_query($conn, $query)) {
            $register_success = "Registrasi berhasil! Silakan login.";
        } else {
            $register_error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <style>
        /* Styling untuk form registrasi */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eaf6ea;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            border: 2px solid #2c6b2f;
        }

        h1 {
            color: #2c6b2f;
            font-size: 36px;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }

        input, select, button {
            width: 80%;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #2c6b2f;
            color: #333;
            box-sizing: border-box;
        }

        button {
            background-color: #2c6b2f;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1f4d28;
        }

        .message {
            margin-top: 10px;
        }

        .message p {
            font-size: 16px;
        }

        .message .error {
            color: red;
        }

        .message .success {
            color: green;
        }

        .link a {
            color: #2c6b2f;
            text-decoration: none;
            font-size: 16px;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Daftar Akun</h1>
        
        <!-- Form registrasi -->
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Nama Pengguna" required>
            <input type="password" name="password" placeholder="Kata Sandi" required>
            
            <select name="security_question" required>
                <option value="" disabled selected>Pilih Pertanyaan Keamanan</option>
                <option value="Nama ibu kandung?">Nama ibu kandung?</option>
                <option value="Apa hari favorit?">Apa hari favorit?</option>
                <option value="Nama Sekolah dasar?">Nama sekolah dasar?</option>
            </select>
            
            <input type="text" name="security_answer" placeholder="Jawaban Keamanan" required>
            <button type="submit" name="register">Daftar</button>
        </form>

        <!-- Pesan error atau sukses -->
        <div class="message">
            <?php
            if (isset($register_error)) {
                echo "<p class='error'>$register_error</p>";
            } elseif (isset($register_success)) {
                echo "<p class='success'>$register_success</p>";
            }
            ?>
        </div>

        <!-- Link ke halaman login -->
        <div class="link">
            <p>Sudah punya akun? <a href="login.php">Masuk Sekarang</a></p>
        </div>
    </div>

</body>
</html>
