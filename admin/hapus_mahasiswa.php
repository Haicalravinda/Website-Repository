<?php
// Koneksi ke database
include 'config.php';

// Mendapatkan ID mahasiswa dari URL
$id = $_GET['id'];

// Query untuk menghapus data mahasiswa
$delete_query = "DELETE FROM students WHERE id = $id";

if (mysqli_query($conn, $delete_query)) {
    echo "Data berhasil dihapus!";
    header("Location: data_mahasiswa.php");
} else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
}
?>
