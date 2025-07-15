<?php
session_start();

// Validasi form hanya jika POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repository_ug2024";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    $nama_dosen = htmlspecialchars($_POST['nama_dosen']);
    $email_dosen = htmlspecialchars($_POST['email_dosen']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nomor_induk_dosen = htmlspecialchars($_POST['nomor_induk_dosen']);
    $alamat_lengkap = htmlspecialchars($_POST['alamat_lengkap']);

    $stmt = $conn->prepare("SELECT * FROM dosen WHERE email_dosen = ?");
    $stmt->bind_param("s", $email_dosen);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Email sudah terdaftar, silakan gunakan email lain.");
    }

    if ($_FILES['file_kartu_tanda_dosen']['error'] === UPLOAD_ERR_OK) {
        $target_dir = 'uploads/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_path = $target_dir . basename($_FILES['file_kartu_tanda_dosen']['name']);
        $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

        if (!in_array($file_type, ['jpg', 'png', 'pdf'])) {
            die('Hanya file JPG, PNG, atau PDF yang diperbolehkan.');
        }

        if (!move_uploaded_file($_FILES['file_kartu_tanda_dosen']['tmp_name'], $file_path)) {
            die('Gagal mengunggah file.');
        }
    } else {
        die('Gagal mengunggah file.');
    }

    $stmt = $conn->prepare("INSERT INTO dosen (nama_dosen, email_dosen, password, file_kartu_tanda_dosen, nomor_induk_dosen, alamat_lengkap, status_dosen_reg) VALUES (?, ?, ?, ?, ?, ?, 'direview')");
    $stmt->bind_param('ssssss', $nama_dosen, $email_dosen, $password, $file_path, $nomor_induk_dosen, $alamat_lengkap);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registrasi berhasil! Silakan login untuk melanjutkan.";
        header('Location: login.php');
        exit();
    } else {
        die('Gagal melakukan registrasi: ' . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Dosen</title>

    <!-- Link CSS dan Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('https://th.bing.com/th/id/R.9b103de67001001ec63e48d21e2af279?rik=ad27J8HKfNYpqA');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: #333;
            margin: 0;
        }

        .form-container {
            position: relative;
            z-index: 10;
            margin: auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .btn-custom,
        .btn-cancel {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-custom:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .btn-cancel:hover {
            transform: scale(1.1);
            background-color: #e74c3c;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container col-11 col-sm-9 col-md-6 col-lg-5">
            <h2 class="text-center mb-4">
                <i class="fas fa-user-plus"></i> Registrasi Dosen
            </h2>
            <form action="" method="POST" enctype="multipart/form-data" novalidate>
                <div class="mb-3">
                    <label for="nama_dosen" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="email_dosen" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email_dosen" name="email_dosen" placeholder="Masukkan email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                <div class="mb-3">
                    <label for="nomor_induk_dosen" class="form-label">Nomor Induk Dosen</label>
                    <input type="text" class="form-control" id="nomor_induk_dosen" name="nomor_induk_dosen" placeholder="Masukkan nomor induk dosen" required>
                </div>
                <div class="mb-3">
                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="file_kartu_tanda_dosen" class="form-label">Upload Kartu Tanda Dosen</label>
                    <input type="file" class="form-control" id="file_kartu_tanda_dosen" name="file_kartu_tanda_dosen" required>
                </div>
                <button type="submit" class="btn btn-success btn-custom w-100">
                    <i class="fas fa-user-check"></i> Registrasi
                </button>
                <button type="button" class="btn btn-cancel btn-warning w-100 mt-2" onclick="window.history.back();">
                    <i class="fas fa-ban"></i> Batal
                </button>
            </form>
        </div>
    </div>
</body>
</html>
