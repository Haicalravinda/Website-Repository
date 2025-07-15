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
    $email = $_POST['email_dosen'];
    $password = $_POST['password'];

    // Query SQL untuk mengecek email dan password
    $stmt = $conn->prepare("SELECT password, status_dosen_reg FROM dosen WHERE email_dosen = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password_db, $status_dosen_reg);
    $stmt->fetch();

    // Cek apakah email ada dan verifikasi password
    if ($stmt->num_rows > 0) {
        // Verifikasi password menggunakan password_verify()
        if (password_verify($password, $hashed_password_db)) {
            // Cek apakah status admin "DITERIMA"
            if ($status_dosen_reg == "DITERIMA") {
                // Login berhasil, set session dan redirect ke dashboard
                $_SESSION['email'] = $email;
                header("Location: index.php");  // Redirect ke dashboard atau halaman lain
                exit();
            } else {
                // Status admin tidak AKTIF, tampilkan pesan error
                $_SESSION['status'] = "Akun Anda belum aktif. Harap tunggu konfirmasi lebih lanjut.";
                header("Location: login.php");
                exit();
            }
        } else {
            // Password salah
            $_SESSION['login_error'] = "Password yang Anda masukkan salah.";
            header("Location: login.php");
            exit();
        }
    } else {
        // Email tidak ditemukan
        $_SESSION['login_error'] = "Email tidak terdaftar atau salah.";
        header("Location: login.php");
        exit();
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
