<?php
// Koneksi ke database
include 'config.php';

// Mendapatkan ID mahasiswa dari URL
$id = $_GET['id'];

// Query untuk menghapus data mahasiswa
$delete_query = "DELETE FROM berita_repository WHERE id = $id";

if (mysqli_query($conn, $delete_query)) {
    echo "Data berhasil dihapus!";
    header("Location: berita.php");
} else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
}
?>
