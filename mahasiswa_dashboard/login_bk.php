<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $servername = "localhost";  // Sesuaikan dengan environment Anda
    $username = "root";         // Username database
    $password = "";             // Password database
    $dbname = "repository_ug2024"; // Nama database Anda

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil input dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password yang diinput menggunakan MD5
    $hashed_password_input = md5($password);

    // Query SQL untuk mengecek email dan password
    $stmt = $conn->prepare("SELECT password, status_mhs_reg FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password_db, $status_mhs_reg);
    $stmt->fetch();

    // Cek apakah email ada dan verifikasi password
    if ($stmt->num_rows > 0) {
        // Verifikasi password
        if ($hashed_password_input === $hashed_password_db) {
            // Cek apakah status admin "AKTIF"
            if ($status_mhs_reg == "DITERIMA") {
                // Login berhasil, set session dan redirect ke dashboard
                $_SESSION['email'] = $email;
                header("Location: index.php");  // Redirect ke dashboard atau halaman lain
                exit();
            } else {
                // Status admin tidak AKTIF, set error session
                $_SESSION['error'] = "Akun Anda belum aktif. Status: " . $status_mhs_reg;
                header("Location: login.php");
                exit();
            }
        } else {
            // Password salah
            $_SESSION['error'] = "Password salah.";
            header("Location: login.php");
            exit();
        }
    } else {
        // Email tidak ditemukan
        $_SESSION['error'] = "Akun dengan email tersebut tidak ditemukan.";
        header("Location: login.php");
        exit();
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
