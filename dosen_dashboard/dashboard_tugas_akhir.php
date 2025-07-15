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

// Retrieve data for logged-in user
$query_dosen = $conn->prepare("SELECT * FROM dosen WHERE email_dosen = ?");
$query_dosen->bind_param("s", $_SESSION['email']);
$query_dosen->execute();
$dosen_data = $query_dosen->get_result()->fetch_assoc();

// Sanitize search input
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_param = "%" . $search . "%";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Penulisan Ilmiah</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #e0eafc, #cfdef3);
            margin: 0;
            overflow-x: hidden;
        }

        nav {
            background: linear-gradient(to right, #6c5ce7, #a29bfe);
            color: white;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        nav .navbar-brand {
            font-size: 24px;
            font-weight: 700;
        }

        .sidebar {
            position: fixed;
            top: 60px;
            left: -250px;
            height: calc(100% - 60px);
            width: 250px;
            background: linear-gradient(to bottom, #6c5ce7, #a29bfe);
            color: white;
            padding-top: 20px;
            overflow-y: auto;
            transition: left 0.3s ease;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar img {
            display: block;
            margin: 20px auto;
            border-radius: 50%;
            border: 3px solid #fff;
            width: 120px;
            height: 120px;
        }

        .sidebar h5 {
            margin: 10px 0;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 8px 0;
            display: block;
            line-height: 1.5;
        }

        .sidebar a:hover {
            background-color: #4834d4;
            transform: translateX(5px);
        }

        .content {
            margin-left: 0;
            padding: 30px;
            margin-top: 20px;
            color: #2d3436;
            transition: margin-left 0.3s ease;
            padding-bottom: 70px; /* Ensure there's space for the footer */
        }

      

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .popup-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .popup-content .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #6c5ce7;
            cursor: pointer;
        }

        .popup-content .close:hover {
            color: #4834d4;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table th {
            background-color: #6c5ce7;
            color: white;
        }

        .table td {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="d-flex justify-content-between align-items-center">
    <button class="btn btn-light" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>
    <span class="navbar-brand ms-3 mb-0 h5 mx-auto text-center">Dashboard Dosen - Direktori Skripsi</span>
</nav>


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="text-center mt-3">
            <?php
            $profilePhotoPath = "upload_dosen/" . ($dosen_data['foto_profil'] ?: 'default.jpg');
            ?>
            <img src="<?= htmlspecialchars($profilePhotoPath); ?>" alt="Foto Profil">
            <h5><?= htmlspecialchars($dosen_data['nama_dosen'] ?? 'Dosen'); ?></h5>
        </div>
        <a href="index.php"><i class="fas fa-home"></i> Homepage</a>
        <a href="dashboard_tugas_akhir.php"><i class="fas fa-book"></i> Direktori Tugas Akhir</a>
        <a href="dashboard_penulisan_ilmiah.php"><i class="fas fa-file-alt"></i> Direktori Penulisan Ilmiah</a>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="text-center">
            <button class="btn btn-primary" id="open-popup">Cari Skripsi</button>
        </div>

        <!-- Popup -->
        <div id="search-popup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h4 class="mb-3">Cari Penulisan Ilmiah</h4>
                <form method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari Berdasarkan Judul Penulisan Ilmiah, Kategori PI atau Dosen Pembimbing" 
                               value="<?= htmlspecialchars($search); ?>">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>NPM</th>
                        <th>Judul Skripsi</th>
                        <th>Dosen Pembimbing</th>
                        <th>Kategori TA</th>
                        <th>Tanggal Upload</th>
                        <th>Filename</th>
                        <th>Status TA</th>
                        <th>File Poster</th>
                        <th>Filepath</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Secure query with prepared statement
                    $stmt = $conn->prepare("SELECT id, nama_mahasiswa, npm, judul_skripsi, dosen_pembimbing, kategori_ta, tanggal_upload, filename, status_ta, file_poster, filepath
                                            FROM repository_ta2024
                                            WHERE status_ta='diterima' AND 
                                                  (judul_skripsi LIKE ? OR kategori_ta LIKE ? OR dosen_pembimbing LIKE ?)");
                    $stmt->bind_param("sss", $search_param, $search_param, $search_param);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_mahasiswa']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['npm']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['judul_skripsi']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['dosen_pembimbing']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['kategori_ta']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_upload']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['filename']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status_ta']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['file_poster']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['filepath']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11' class='text-center'>Tidak ada data yang ditemukan.</td></tr>";
                    }

                    // Close the statement and connection
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <script>
        // Sidebar toggle
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Popup functionality
        const popup = document.getElementById('search-popup');
        const openPopup = document.getElementById('open-popup');
        const closePopup = document.querySelector('.close');

        openPopup.addEventListener('click', () => {
            popup.style.display = 'block';
        });

        closePopup.addEventListener('click', () => {
            popup.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        });

        // Perbaikan Script Sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const content = document.querySelector('.content-wrapper');

            function handleSidebar() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                    content.style.marginLeft = '280px';
                } else {
                    content.style.marginLeft = '0';
                }
            }

            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            window.addEventListener('resize', handleSidebar);
            handleSidebar();
        });
    </script>
</body>

</html>
