<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repository_ug2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's email
$email = $_SESSION['email'];

// Prepare SQL query to retrieve student details
$stmt = $conn->prepare("SELECT nama_lengkap, npm, email, alamat_lengkap, kelas, jurusan, angkatan, status_mhs_reg FROM students WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($nama_lengkap, $npm, $email, $alamat_lengkap, $kelas, $jurusan, $angkatan, $status_mhs_reg);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <!-- Update ke Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahan Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(135deg, #5f2c82 0%, #49a09d 100%);
            padding: 1rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-brand img {
            height: 45px;
            border-radius: 8px;
        }

        .navbar-brand span {
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .sidebar {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 20px;
            height: calc(100vh - 100px);
        }

        .sidebar .nav-link {
            color: #5f2c82;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #5f2c82;
            color: white;
            transform: translateX(5px);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            padding: 30px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #5f2c82 0%, #49a09d 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .info-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 25px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-card i {
            font-size: 24px;
            color: #5f2c82;
            margin-bottom: 15px;
        }

        .btn-logout {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5253 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(238, 82, 83, 0.3);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Logo">
                <span>Repository Universitas Gunadarma</span>
            </a>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar">
                    <h5 class="mb-4">Menu Navigasi</h5>
                    <nav class="nav flex-column">
                    <a class="nav-link active" href="index.php"><i class="bi bi-house-door"></i> Dashboard</a>
<a class="nav-link" href="directory_ta.php"><i class="bi bi-file-text"></i> Tugas Akhir</a>
<a class="nav-link" href="directory_pi.php"><i class="bi bi-file-text"></i> Penulisan Ilmiah</a>

                    
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="welcome-card">
                    <h2 class="mb-0">Selamat datang, <?php echo $nama_lengkap; ?>! 👋</h2>
                    <p class="mb-0">Selamat datang di Dashboard Repository Universitas Gunadarma</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="info-card">
                            <i class="bi bi-person-badge"></i>
                            <h5>Informasi Pribadi</h5>
                            <p class="mb-2"><strong>NPM:</strong> <?php echo $npm; ?></p>
                            <p class="mb-2"><strong>Email:</strong> <?php echo $email; ?></p>
                            <p class="mb-0"><strong>Alamat:</strong> <?php echo $alamat_lengkap; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card">
                            <i class="bi bi-mortarboard"></i>
                            <h5>Informasi Akademik</h5>
                            <p class="mb-2"><strong>Kelas:</strong> <?php echo $kelas; ?></p>
                            <p class="mb-2"><strong>Jurusan:</strong> <?php echo $jurusan; ?></p>
                            <p class="mb-0"><strong>Angkatan:</strong> <?php echo $angkatan; ?></p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="logout.php" class="btn btn-logout text-white">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
