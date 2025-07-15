<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repository_ug2024";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];

// Queries
$query_penulisan_ilmiah = $conn->query("SELECT COUNT(*) AS jumlah_penulisan_ilmiah FROM repository_pi2024");
$jumlah_penulisan_ilmiah = $query_penulisan_ilmiah ? $query_penulisan_ilmiah->fetch_assoc()['jumlah_penulisan_ilmiah'] : 0;

$query_tugas_akhir = $conn->query("SELECT COUNT(*) AS jumlah_tugas_akhir FROM repository_ta2024");
$jumlah_tugas_akhir = $query_tugas_akhir ? $query_tugas_akhir->fetch_assoc()['jumlah_tugas_akhir'] : 0;

$query_dosen = $conn->prepare("SELECT * FROM dosen WHERE email_dosen = ?");
$query_dosen->bind_param("s", $email);
$query_dosen->execute();
$dosen_data = $query_dosen->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8B5CF6;
            --hover-color: #7C3AED;
            --bg-gradient: linear-gradient(135deg, #F3E8FF 0%, #EDE9FE 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            position: relative;
        }

        /* Navbar Styles */
        .navbar {
            background: white !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100vh;
            width: 280px;
            position: fixed;
            top: 0;
            left: -280px;
            background: linear-gradient(180deg, #8B5CF6 0%, #6D28D9 100%);
            transition: 0.3s ease-in-out;
            z-index: 1000;
            padding-top: 80px;
            box-shadow: 4px 0 20px rgba(139, 92, 246, 0.3);
        }

        .sidebar.active {
            left: 0;
        }

        .profile-section {
            text-align: center;
            padding: 20px;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            margin: 0 15px;
            border-radius: 15px;
            backdrop-filter: blur(5px);
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            margin: 0 auto 15px;
            transition: transform 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: white !important;
            padding: 12px 25px;
            transition: all 0.3s ease;
            margin: 5px 15px;
            border-radius: 8px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            transform: translateX(10px);
        }

        .nav-link i {
            margin-right: 10px;
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: rotate(360deg);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 0;
            transition: 0.3s ease-in-out;
            padding: 80px 20px 20px;
        }

        .main-content.shifted {
            margin-left: 280px;
        }

        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);
            padding: 60px 20px;
            border-radius: 20px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(139, 92, 246, 0.3);
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('path_to_pattern.png');
            opacity: 0.1;
        }

        .hero-banner h1 {
            color: white;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid rgba(139, 92, 246, 0.1);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.15);
        }

        .stat-card .card-title {
            color: #6D28D9;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .stat-card .card-value {
            font-size: 2.8rem;
            font-weight: 700;
            color: #4C1D95;
            background: #F5F3FF;
            border-radius: 15px;
            padding: 20px;
        }

        /* Welcome Text */
        .welcome-text {
            text-align: center;
            margin-top: 40px;
            color: #6D28D9;
            font-weight: 700;
            font-size: 2.2rem;
            animation: pulse 2s infinite;
            text-shadow: 2px 2px 4px rgba(139, 92, 246, 0.2);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
                left: -100%;
            }

            .main-content.shifted {
                margin-left: 0;
            }

            .hero-banner h1 {
                font-size: 1.8rem;
            }

            .stat-card .card-value {
                font-size: 2rem;
            }

            .welcome-text {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-banner {
                padding: 30px 15px;
            }

            .hero-banner h1 {
                font-size: 1.5rem;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-card .card-value {
                font-size: 1.8rem;
            }

            .profile-image {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <button class="btn" id="sidebar-toggle">
                <i class="fas fa-bars text-primary"></i>
            </button>
            <span class="navbar-brand">Dashboard Dosen</span>
            <img src="https://jurusan-akademik.gunadarma.ac.id/assets/img/brand/logoUG.png" alt="Logo" style="height: 40px;">
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="profile-section">
            <?php
            $profilePhotoPath = "upload_dosen/" . ($dosen_data['foto_profil'] ?? 'default.jpg');
            ?>
            <img src="<?= htmlspecialchars($profilePhotoPath); ?>" alt="Profile" class="profile-image">
            <h5 class="mb-4"><?= htmlspecialchars($dosen_data['nama_dosen'] ?? 'Dosen'); ?></h5>
            <nav class="nav flex-column">
                <a class="nav-link" href="dashboard_tugas_akhir.php">
                    <i class="fas fa-bookmark"></i> Direktori Tugas Akhir
                </a>
                <a class="nav-link" href="dashboard_penulisan_ilmiah.php">
                    <i class="fas fa-file-alt"></i> Direktori Penulisan Ilmiah
                </a>
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <div class="hero-banner text-center">
            <h1>Selamat Datang di Dashboard Dosen</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="stat-card">
                        <h5 class="card-title">Jumlah Penulisan Ilmiah</h5>
                        <p class="card-value"><?= $jumlah_penulisan_ilmiah; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <h5 class="card-title">Jumlah Tugas Akhir</h5>
                        <p class="card-value"><?= $jumlah_tugas_akhir; ?></p>
                    </div>
                </div>
            </div>

            <div class="welcome-text">
                Selamat Datang, <?= htmlspecialchars($dosen_data['nama_dosen'] ?? 'Dosen'); ?>!
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('shifted');
            });

            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickInsideToggle = sidebarToggle.contains(event.target);

                if (!isClickInsideSidebar && !isClickInsideToggle && window.innerWidth < 992) {
                    sidebar.classList.remove('active');
                    mainContent.classList.remove('shifted');
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth < 992) {
                    mainContent.classList.remove('shifted');
                } else if (sidebar.classList.contains('active')) {
                    mainContent.classList.add('shifted');
                }
            });
        });
    </script>
</body>
</html>