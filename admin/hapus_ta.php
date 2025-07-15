<?php
// Koneksi ke database
include 'config.php';

// Mendapatkan ID mahasiswa dari URL
$id = $_GET['id'];

// Query untuk menghapus data mahasiswa
$delete_query = "DELETE FROM repository_ta2024 WHERE id = $id";

if (mysqli_query($conn, $delete_query)) {
    echo "Data berhasil dihapus!";
    header("Location: data_ta.php");
} else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
}
?>
