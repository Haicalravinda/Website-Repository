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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Initialize default variables
$total_mahasiswa = $total_dosen = $total_penelitian = $total_tugas_akhir = 0;

// Count total students
$query_mahasiswa = "SELECT COUNT(*) AS total_mahasiswa FROM students";
$result_mahasiswa = mysqli_query($conn, $query_mahasiswa);
if ($result_mahasiswa && mysqli_num_rows($result_mahasiswa) > 0) {
    $row_mahasiswa = mysqli_fetch_assoc($result_mahasiswa);
    $total_mahasiswa = $row_mahasiswa['total_mahasiswa'];
}

// Count total lecturers
$query_dosen = "SELECT COUNT(*) AS total_dosen FROM dosen";
$result_dosen = mysqli_query($conn, $query_dosen);
if ($result_dosen && mysqli_num_rows($result_dosen) > 0) {
    $row_dosen = mysqli_fetch_assoc($result_dosen);
    $total_dosen = $row_dosen['total_dosen'];
}

// Count total research
$query_penelitian = "SELECT COUNT(*) AS total_penelitian FROM repository_pi2024";
$result_penelitian = mysqli_query($conn, $query_penelitian);
if ($result_penelitian && mysqli_num_rows($result_penelitian) > 0) {
    $row_penelitian = mysqli_fetch_assoc($result_penelitian);
    $total_penelitian = $row_penelitian['total_penelitian'];
}

// Count total final projects
$query_tugas_akhir = "SELECT COUNT(*) AS total_tugas_akhir FROM repository_ta2024";
$result_tugas_akhir = mysqli_query($conn, $query_tugas_akhir);
if ($result_tugas_akhir && mysqli_num_rows($result_tugas_akhir) > 0) {
    $row_tugas_akhir = mysqli_fetch_assoc($result_tugas_akhir);
    $total_tugas_akhir = $row_tugas_akhir['total_tugas_akhir'];
}

// Get logged-in user's email
$email = $_SESSION['email'];

// Prepare SQL query to retrieve admin details
$stmt = $conn->prepare("SELECT nama_lengkap, email, password, status_admin_reg FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($nama_lengkap, $email, $password, $status_admin_reg);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Universitas Gunadarma</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-purple: #6f42c1;
            --secondary-purple: #563d7c;
            --light-purple: #e9ecef;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f3ff, #e9ecef);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            min-height: 100vh;
            position: relative;
        }

        /* Mobile Menu Button */
        .menu-btn {
            position: fixed;
            top: 15px;
            right: 15px;
            background: var(--primary-purple);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1002;
            display: none;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1001;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .logo-container {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .logo-container img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .nav-link {
            padding: 12px 20px;
            color: #333;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: #f8f4ff;
            color: var(--primary-purple);
            border-left: 4px solid var(--primary-purple);
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .dashboard-header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2rem;
            color: var(--primary-purple);
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--secondary-purple);
        }

        /* Footer */
        footer {
            background: var(--primary-purple);
            color: white;
            text-align: center;
            padding: 15px;
            position: relative;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        /* Overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .menu-btn {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                padding: 60px 15px 15px;
            }

            footer {
                margin-left: 0;
            }

            .overlay.active {
                display: block;
            }

            .dashboard-header {
                padding: 15px;
            }

            .stat-card {
                margin-bottom: 15px;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .logo-container img {
                width: 80px;
            }
        }

        @media (max-width: 576px) {
            .stat-card {
                padding: 15px;
            }

            .stat-icon {
                font-size: 1.5rem;
            }

            .stat-value {
                font-size: 1.2rem;
            }

            .dashboard-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Button -->
    <button class="menu-btn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="../images/logo.png" alt="Logo Universitas Gunadarma">
            <h6 class="text-purple">Universitas Gunadarma</h6>
        </div>
        <ul class="nav flex-column">
            <li>
                <a class="nav-link" href="data_mahasiswa.php">
                    <i class="fas fa-user-graduate"></i> Data Mahasiswa
                </a>
            </li>
            <li>
                <a class="nav-link" href="data_dosen.php">
                    <i class="fas fa-chalkboard-teacher"></i> Data Dosen
                </a>
            </li>
            <li>
                <a class="nav-link" href="data_pi.php">
                    <i class="fas fa-book"></i> Penelitian Ilmiah
                </a>
            </li>
            <li>
                <a class="nav-link" href="data_ta.php">
                    <i class="fas fa-file-alt"></i> Tugas Akhir
                </a>
            </li>
            <li>
                <a class="nav-link" href="berita.php">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
            </li>
          
            <li>
                <a class="nav-link text-danger" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Dashboard Admin</h1>
            <p class="text-muted">Selamat datang, <?php echo htmlspecialchars($nama_lengkap); ?></p>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-title">Total Mahasiswa</div>
                    <div class="stat-value"><?php echo $total_mahasiswa; ?></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-title">Total Dosen</div>
                    <div class="stat-value"><?php echo $total_dosen; ?></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-title">Penelitian Ilmiah</div>
                    <div class="stat-value"><?php echo $total_penelitian; ?></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-title">Tugas Akhir</div>
                    <div class="stat-value"><?php echo $total_tugas_akhir; ?></div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Repository Universitas Gunadarma. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.querySelector('.menu-btn');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.overlay');
            
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            menuBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Close sidebar when window is resized above mobile breakpoint
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>