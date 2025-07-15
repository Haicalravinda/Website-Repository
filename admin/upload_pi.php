<?php
// Directory untuk menyimpan file
$target_dir = "up_pi/";
$filename = basename($_FILES["file"]["name"]);
$target_file = $target_dir . $filename;
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Mengambil input dari form
$nama_mahasiswa = $_POST['nama_mahasiswa'];
$npm = $_POST['npm'];
$tingkat = $_POST['tingkat'];
$angkatan = $_POST['angkatan'];
$judul_penelitian = $_POST['judul_penelitian'];
$dosen_pembimbing = $_POST['dosen_pembimbing'];
$kategori_pi = $_POST['kategori_pi'];
$tanggal_upload = $_POST['tanggal_upload'];

// Cek apakah file sudah ada
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
$allowedFormats = ["pdf"];
if (!in_array($fileType, $allowedFormats)) {
    echo "Sorry, only PDF files are allowed.";
    $uploadOk = 0;
}

// Cek apakah $uploadOk 0 karena error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // Jika file berhasil diunggah, simpan file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars($filename). " has been uploaded.";

        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "repository_ug2024");

        // Cek koneksi database
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Menggunakan prepared statement untuk mencegah SQL Injection
        // Prepare the SQL statement with an additional status_pi field
        $stmt = $conn->prepare("INSERT INTO repository_pi2024 (nama_mahasiswa, npm, tingkat, angkatan, judul_penelitian, dosen_pembimbing, kategori_pi, tanggal_upload, filename, filepath, status_pi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Define the status value to be "DIREVIEW"
        $status_pi = "DIREVIEW";

        // Bind the parameters, including the new status
        $stmt->bind_param("sssssssssss", $nama_mahasiswa, $npm, $tingkat, $angkatan, $judul_penelitian, $dosen_pembimbing, $kategori_pi, $tanggal_upload, $filename, $target_file, $status_pi);

        // Eksekusi query hanya satu kali
        if ($stmt->execute()) {
            echo "Research information saved to database!";
            // Redirect ke halaman utama
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
