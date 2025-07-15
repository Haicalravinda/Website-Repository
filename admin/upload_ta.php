<?php
// Directory untuk menyimpan file
$target_dir = "up_ta/";

// Ambil nama file dari form upload
$filename = basename($_FILES["file"]["name"]);
$file_poster_name = isset($_FILES["file_poster"]["name"]) ? basename($_FILES["file_poster"]["name"]) : null;

// Tentukan lokasi untuk menyimpan file
$target_file = $target_dir . $filename;
$target_file_poster = $file_poster_name ? $target_dir . $file_poster_name : null;

$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$filePosterType = $file_poster_name ? strtolower(pathinfo($target_file_poster, PATHINFO_EXTENSION)) : null;

// Mengambil input dari form
$nama_mahasiswa = $_POST['nama_mahasiswa'];
$npm = $_POST['npm'];
$judul_skripsi = $_POST['judul_skripsi'];
$dosen_pembimbing = $_POST['dosen_pembimbing'];
$kategori_ta = $_POST['kategori_ta'];
$tanggal_upload = $_POST['tanggal_upload'];
$status_ta = "direview"; // Status default

// Cek apakah file PDF sudah ada
if (file_exists($target_file)) {
    echo "Sorry, the PDF file already exists.";
    $uploadOk = 0;
}

// Validasi format file PDF
$allowedFormats = ["pdf"];
if (!in_array($fileType, $allowedFormats)) {
    echo "Sorry, only PDF files are allowed for the main file.";
    $uploadOk = 0;
}

// Validasi format file poster (JPG, JPEG, PNG)
if ($file_poster_name && !in_array($filePosterType, ["jpg", "jpeg", "png"])) {
    echo "Sorry, only JPG, JPEG, and PNG poster files are allowed.";
    $uploadOk = 0;
}

// Cek apakah ada error dalam proses upload
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // Proses upload file PDF dan poster
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // Upload poster jika ada
        if ($file_poster_name) {
            move_uploaded_file($_FILES["file_poster"]["tmp_name"], $target_file_poster);
        }

        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "repository_ug2024");

        // Cek koneksi database
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query SQL untuk memasukkan data ke dalam database
        $stmt = $conn->prepare("INSERT INTO repository_ta2024 (nama_mahasiswa, npm, judul_skripsi, dosen_pembimbing, kategori_ta, tanggal_upload, filename, filepath, status_ta, file_poster) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameter untuk mencegah SQL Injection
        $stmt->bind_param("ssssssssss", $nama_mahasiswa, $npm, $judul_skripsi, $dosen_pembimbing, $kategori_ta, $tanggal_upload, $filename, $target_file, $status_ta, $file_poster_name);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Research information saved to database!";
            // Redirect ke halaman utama setelah sukses
            header('Location: index.php');
            exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        // Menutup koneksi
        $stmt->close();
        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
