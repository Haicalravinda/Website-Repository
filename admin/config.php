<?php
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
?>