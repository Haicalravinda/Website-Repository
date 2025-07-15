<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";  // Adjust according to your environment
    $username = "root";         // Database username
    $password = "";             // Database password
    $dbname = "repository_ug2024"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and store form inputs
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $npm = trim($_POST['npm']);
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password'])); // Use MD5 hashing (not recommended for production)
    $alamat_lengkap = trim($_POST['alamat_lengkap']);
    $kelas = trim($_POST['kelas']);
    $jurusan = trim($_POST['jurusan']);
    $angkatan = trim($_POST['angkatan']);

    // Default status
    $status_mhs_reg = 'TAHAP VERIFIKASI';

    // Check if email or npm already exists
    $stmt = $conn->prepare("SELECT * FROM students WHERE email = ? OR npm = ?");
    $stmt->bind_param("ss", $email, $npm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: Email or NPM already exists. Please use a different one.";
    } else {
        // Handle file upload
        $target_dir = "uploads_mhs/";  // Directory for uploads

        // Check if directory exists, if not, create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);  // Create the directory with full permissions
        }

        $file_ktm_krs = $_FILES["file_ktm_krs"]["name"];
        $target_file = $target_dir . basename($file_ktm_krs);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type and size (e.g., max 5MB)
        if (!in_array($file_type, ['jpg', 'pdf'])) {
            die("Sorry, only JPG and PDF files are allowed.");
        }

        if ($_FILES["file_ktm_krs"]["size"] > 5 * 1024 * 1024) {
            die("Sorry, the file is too large. Maximum size is 5MB.");
        }

        // Move uploaded file to the target directory
        if (!move_uploaded_file($_FILES["file_ktm_krs"]["tmp_name"], $target_file)) {
            die("Sorry, there was an error uploading your file.");
        }

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO students (nama_lengkap, npm, email, password, file_ktm_krs, alamat_lengkap, kelas, jurusan, angkatan, status_mhs_reg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("ssssssssss", $nama_lengkap, $npm, $email, $password, $target_file, $alamat_lengkap, $kelas, $jurusan, $angkatan, $status_mhs_reg);

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
