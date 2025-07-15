<?php
session_start();

// Periksa login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Koneksi Database
$conn = new mysqli("localhost", "root", "", "repository_ug2024");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Berita</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --navbar-height: 70px;
            --sidebar-width: 280px;
            --primary-purple: #6f42c1;
            --secondary-purple: #5a2c8c;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5e6f7, #d8b6e1);
            min-height: 100vh;
            padding-top: var(--navbar-height); /* Memberikan ruang untuk navbar fixed */
        }

        /* Navbar Styles */
        .navbar {
            height: var(--navbar-height);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(111, 66, 193, 0.1);
            z-index: 1030;
            padding: 0.5rem 1rem;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: var(--navbar-height); /* Mulai dari bawah navbar */
            left: 0;
            background: linear-gradient(160deg, var(--primary-purple), var(--secondary-purple));
            z-index: 1020;
            transition: all 0.3s ease;
            overflow-y: auto;
            height: calc(100vh - var(--navbar-height)); /* Tinggi dikurangi navbar */
        }

        /* Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: calc(100vh - var(--navbar-height));
            transition: all 0.3s ease;
        }

        /* Card Styles */
        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(111, 66, 193, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .sidebar {
                left: -280px; /* Sembunyikan sidebar */
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            /* Overlay untuk mobile */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: var(--navbar-height);
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1015;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            margin-top: 1rem;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.1);
        }

        .table thead th {
            background: linear-gradient(45deg, var(--primary-purple), var(--secondary-purple));
            color: white;
            border: none;
            padding: 1rem;
        }

        /* Utility Classes */
        .page-title {
            color: var(--primary-purple);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="btn btn-link d-lg-none me-2" id="sidebarToggle">
                <i class="fas fa-bars fa-lg" style="color: var(--primary-purple);"></i>
            </button>
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../images/logo.png" alt="Logo" height="40" class="me-2">
                <span>Repository UG</span>
            </a>
        </div>
    </nav>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="px-3 py-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                </li>
                <li><a class="nav-link" href="data_mahasiswa.php"><i class="fas fa-user-graduate me-2"></i>Data Mahasiswa</a></li>
                <li><a class="nav-link" href="data_dosen.php"><i class="fas fa-chalkboard-teacher me-2"></i>Data Dosen</a></li>
                <li><a class="nav-link" href="data_pi.php"><i class="fas fa-book me-2"></i>Penelitian Ilmiah</a></li>
                <li><a class="nav-link" href="data_ta.php"><i class="fas fa-file-alt me-2"></i>Tugas Akhir</a></li>
                <li><a class="nav-link active" href="berita.php"><i class="fas fa-newspaper me-2"></i>Data Berita</a></li>
                <li><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-card">
            <h2 class="page-title">Data Berita</h2>
            
            <!-- Action Button -->
            <div class="d-flex justify-content-end mb-4">
                <a href="tambah_berita.php" class="btn btn-custom">
                    <i class="fas fa-plus me-2"></i>Tambah Berita
                </a>
            </div>

            <!-- Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul Berita</th>
                                <th>Konten Berita</th>
                                <th>Tanggal Berita</th>
                                <th>Penulis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id, judul_berita, konten_berita, tanggal_berita, penulis FROM berita_repository";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='text-center'>{$row['id']}</td>";
                                    echo "<td>{$row['judul_berita']}</td>";
                                    echo "<td>{$row['konten_berita']}</td>";
                                    echo "<td class='text-center'>{$row['tanggal_berita']}</td>";
                                    echo "<td>{$row['penulis']}</td>";
                                    echo "<td class='text-center'>
                                            <a href='edit_berita.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                                            <a href='hapus_berita.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus berita ini?\")'>Hapus</a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>Tidak ada data berita yang ditemukan.</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Toggle Sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
                document.body.classList.toggle('sidebar-open');
            }

            // Event Listeners
            sidebarToggle.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Close sidebar on window resize if in mobile view
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    document.body.classList.remove('sidebar-open');
                }
            });

            // Close sidebar when clicking a link (mobile)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        toggleSidebar();
                    }
                });
            });
        });
    </script>
</body>

</html>
