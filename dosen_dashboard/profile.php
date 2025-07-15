<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repository_ug2024";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fetch dosen data
$query_dosen = $conn->prepare("SELECT * FROM dosen WHERE email_dosen = ?");
$query_dosen->bind_param("s", $_SESSION['email']);
$query_dosen->execute();
$dosen_data = $query_dosen->get_result()->fetch_assoc();
$query_dosen->close();

// Menangani formulir jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_dosen = $_POST['nama_dosen'];
    $alamat_lengkap = $_POST['alamat_lengkap'];
    $foto_path = $dosen_data['foto_profil'];

    // Menangani upload foto
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'upload_dosen/';
        $foto_path = $upload_dir . basename($_FILES['foto_profil']['name']);
        
        // Memindahkan file ke direktori yang sesuai
        if (!move_uploaded_file($_FILES['foto_profil']['tmp_name'], $foto_path)) {
            $error_message = "Gagal mengunggah file.";
        }
    }

    // Memperbarui data dosen di database
    $update = $conn->prepare("UPDATE dosen SET nama_dosen = ?, alamat_lengkap = ?, foto_profil = ? WHERE email_dosen = ?");
    $update->bind_param("ssss", $nama_dosen, $alamat_lengkap, $foto_path, $_SESSION['email']);
    
    // Mengeksekusi query dan memberikan feedback
    if ($update->execute()) {
        // Redirect jika sukses
        header("Location: profile.php");
        exit();
    } else {
        // Menampilkan pesan error jika update gagal
        $error_message = "Terjadi kesalahan: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbarui Profil Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .card {
            border-radius: 20px;
            transition: transform 0.3s ease;
            margin-top: 30px;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-header {
            background: linear-gradient(135deg, #6a4c9c, #9b59b6);
            color: white;
            font-weight: bold;
            border-radius: 20px 20px 0 0;
            padding: 20px;
        }

        .btn {
            border-radius: 30px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #6a4c9c;
            border: none;
        }

        .btn-primary:hover {
            background-color: #9b59b6;
        }

        .btn-secondary {
            background-color: #ccc;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #aaa;
        }

        .form-control {
            border-radius: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .img-thumbnail {
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .img-thumbnail:hover {
            transform: scale(1.1);
        }

        .logo {
            max-width: 180px;
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.1));
            border-radius: 50%;
            padding: 10px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label i {
            margin-right: 8px;
        }

        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }

        .btn.loading-btn:disabled .loading {
            display: block;
        }

        @media (max-width: 768px) {
            .logo {
                max-width: 140px;
                margin-bottom: 15px;
                border-radius: 50%;
            }

            .card {
                margin-top: 20px;
                padding: 20px;
            }

            .card-header h4 {
                font-size: 1.5rem;
            }

            .btn {
                width: 100%;
            }

            .form-control, .form-group {
                margin-bottom: 15px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="text-center">
            <img src="https://www.edarabia.com/wp-content/uploads/2018/05/gunadarma-university-depok-indonesia.png" alt="Logo Universitas Gunadarma" class="logo img-thumbnail">
        </div>

        <div class="card shadow-lg">
            <div class="card-header text-center">
                <h4><i class="fas fa-user-edit"></i> Perbarui Profil Anda</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?= $error_message; ?></div>
                <?php endif; ?>

                <form method="POST" action="profile.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="foto_profil" class="form-label"><i class="fas fa-image"></i> Foto Profil</label>
                        <input type="file" name="foto_profil" class="form-control">
                        <img src="<?= htmlspecialchars($dosen_data['foto_profil']); ?>" alt="Foto Profil"
                            class="img-thumbnail mt-2 shadow-sm" width="150">
                    </div>
                    <div class="form-group">
                        <label for="nama_dosen" class="form-label"><i class="fas fa-user"></i> Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="form-control"
                            value="<?= htmlspecialchars($dosen_data['nama_dosen']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="alamat_lengkap" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control"
                            rows="3"><?= htmlspecialchars($dosen_data['alamat_lengkap']); ?></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm loading-btn">
                            Perbarui Profil
                            <span class="loading"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                        <a href="index.php" class="btn btn-secondary px-4 py-2 shadow-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
