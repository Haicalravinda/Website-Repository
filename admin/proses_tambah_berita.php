<?php
// Menghubungkan ke database
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $judul_berita = $_POST['judul_berita'];
    $konten_berita = $_POST['konten_berita'];
    $tanggal_berita = $_POST['tanggal_berita'];
    $penulis = $_POST['penulis'];

    // Query untuk menambahkan berita
    $query = "INSERT INTO berita_repository (judul_berita, konten_berita, tanggal_berita, penulis) 
              VALUES ('$judul_berita', '$konten_berita', '$tanggal_berita', '$penulis')";

    if (mysqli_query($conn, $query)) {
        // Jika berita berhasil ditambahkan, redirect ke halaman /admin/berita.php
        echo "Berita berhasil ditambahkan.";
        header("Location: berita.php");
        exit; // Menghentikan eksekusi lebih lanjut setelah redirect
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }

    // Menutup koneksi
    mysqli_close($conn);
}
?>
