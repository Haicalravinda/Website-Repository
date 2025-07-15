<?php
// Include database connection
require 'config.php'; // Pastikan file ini berisi koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store form inputs
    $nama_dosen = htmlspecialchars(trim($_POST['nama_dosen']));
    $email_dosen = htmlspecialchars(trim($_POST['email_dosen']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $alamat_lengkap = htmlspecialchars(trim($_POST['alamat_lengkap']));
    $nomor_induk_dosen = htmlspecialchars(trim($_POST['nomor_induk_dosen']));

    // Default status
    $status_dosen_reg = 'TAHAP VERIFIKASI';

    // Check if email or nomor_induk_dosen already exists
    $stmt = $conn->prepare("SELECT * FROM dosen WHERE email_dosen = ? OR nomor_induk_dosen = ?");
    $stmt->bind_param("ss", $email_dosen, $nomor_induk_dosen);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: Email or Nomor Induk Dosen already exists. Please use a different one.";
    } else {
        // Handle file upload
        $target_dir = "uploads_dosen/";  // Directory for uploads

        // Check if directory exists, if not, create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);  // Create the directory with full permissions
        }

        $file_kartu_tanda_dosen = $_FILES["file_kartu_tanda_dosen"]["name"];
        $target_file = $target_dir . basename($file_kartu_tanda_dosen);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type
        if ($file_type != "jpg" && $file_type != "pdf") {
            die("Sorry, only JPG and PDF files are allowed.");
        }

        // Move uploaded file to the target directory
        if (!move_uploaded_file($_FILES["file_kartu_tanda_dosen"]["tmp_name"], $target_file)) {
            die("Sorry, there was an error uploading your file.");
        }

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO dosen (nama_dosen, email_dosen, password, file_kartu_tanda_dosen, nomor_induk_dosen, alamat_lengkap, status_dosen_reg) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sssssss", $nama_dosen, $email_dosen, $password, $target_file, $nomor_induk_dosen, $alamat_lengkap, $status_dosen_reg);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: login.php");
            exit(); // Ensure no further code is executed after redirect
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
