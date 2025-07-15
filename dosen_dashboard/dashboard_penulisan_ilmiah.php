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

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch dosen data
$query_dosen = $conn->prepare("SELECT * FROM dosen WHERE email_dosen = ?");
$query_dosen->bind_param("s", $_SESSION['email']);
$query_dosen->execute();
$dosen_data = $query_dosen->get_result()->fetch_assoc();
$query_dosen->close();

// Get search term
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Query for research data
$sql = "SELECT id, nama_mahasiswa, npm, tingkat, angkatan, judul_penelitian, dosen_pembimbing, kategori_pi, tanggal_upload, filename, filepath 
        FROM repository_pi2024
        WHERE status_pi='Diterima'
        AND (judul_penelitian LIKE ? OR kategori_pi LIKE ? OR dosen_pembimbing LIKE ?)";

$search_param = "%$search%";
$query = $conn->prepare($sql);

if ($query) {
    $query->bind_param("sss", $search_param, $search_param, $search_param);
    $query->execute();
    $result = $query->get_result();
} else {
    // Handle errors in query preparation
    die("Error preparing query: " . $conn->error);
}
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
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            overflow-x: hidden;
            min-height: 100vh;
        }

        nav {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            padding: 15px 25px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        nav .navbar-brand {
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 60px;
            left: -250px;
            height: calc(100% - 60px);
            width: 250px;
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            padding-top: 30px;
            transition: left 0.3s ease;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar img {
            display: block;
            margin: 10px auto;
            border-radius: 50%;
            border: 3px solid #fff;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .sidebar img:hover {
            transform: scale(1.05);
        }

        .sidebar h5 {
            margin: 10px 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 5px 0;
            display: block;
            line-height: 1.5;
        }

        .sidebar a:hover {
            background-color: #4834d4;
            transform: translateX(5px);
        }

        /* Main Content */
        .content {
            margin-left: 0;
            padding: 30px;
            margin-top: 20px;
            color: #2d3436;
            transition: margin-left 0.3s ease;
            max-width: 1400px;
            margin: 0 auto;
        }

        footer {
            background-color: #6c5ce7;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            font-size: 14px;
        }

        footer a {
            color: #a29bfe;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Popup */
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
            border-radius: 15px;
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

        /* Button style for search */
        #open-popup {
            margin-top: 30px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        #open-popup:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        /* Table */
        .table-responsive {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .table {
            margin-bottom: 0;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f1f1f1;
        }

        .thead-dark {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
                width: 200px;
            }

            .content {
                margin-left: 0;
            }

            .content.shifted {
                margin-left: 200px;
            }

            #menu-toggle {
                display: block;
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            .sidebar a {
                font-size: 14px;
                padding: 10px;
            }

            nav {
                padding: 12px 15px;
            }

            .navbar-brand {
                font-size: 1rem !important;
            }

            .content {
                padding: 15px;
            }

            .table-responsive {
                margin-top: 20px;
            }

            .table th, .table td {
                font-size: 0.8rem;
                padding: 10px 8px;
            }

            /* Mengatur tampilan tabel pada mobile */
            .table {
                display: block;
                width: 100%;
                overflow-x: auto;
            }

            /* Menyembunyikan beberapa kolom pada tampilan mobile */
            .table th:nth-child(3),
            .table th:nth-child(4),
            .table th:nth-child(5),
            .table td:nth-child(3),
            .table td:nth-child(4),
            .table td:nth-child(5) {
                display: none;
            }

            /* Mengatur ukuran popup pada mobile */
            .popup-content {
                width: 95%;
                margin: 5% auto;
                padding: 20px;
            }
        }

        /* Animasi transisi halus */
        .sidebar, .content, .table-responsive {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <nav>
        <button class="btn btn-light" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <span class="navbar-brand ms-3 mb-0 h5">Dashboard Dosen - Direktori Penelitian Ilmiah</span>
    </nav>

    <div class="sidebar" id="sidebar">
        <div class="text-center mt-3">
            <?php
            $profilePhotoPath = "upload_dosen/" . ($dosen_data['foto_profil'] ?: 'default.jpg');
            ?>
            <img src="<?= htmlspecialchars($profilePhotoPath); ?>" alt="Foto Profil">
            <div class="text-center mt-3">
                <h5><?= htmlspecialchars($dosen_data['nama_dosen'] ?? 'Dosen'); ?></h5>
            </div>
        </div>
        <h4 class="text-center mt-4" style="font-size: 18px; font-weight: 600;">Menu Navigasi</h4>
        <a href="index.php"><i class="fas fa-bookmark"></i> Homepage</a>
        <a href="dashboard_tugas_akhir.php"><i class="fas fa-bookmark"></i> Direktori Tugas Akhir</a>
        <a href="dashboard_penulisan_ilmiah.php"><i class="fas fa-file-alt"></i> Direktori Penulisan Ilmiah</a>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <button class="btn btn-primary" id="open-popup">Cari Penulisan Ilmiah</button>

        <div id="search-popup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h4 class="mb-3">Cari Penulisan Ilmiah</h4>
                <form method="GET" class="search-bar">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari Berdasarkan Judul Penulisan Ilmiah, Kategori PI atau Dosen Pembimbing" 
                               value="<?= htmlspecialchars($search) ?>">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>NPM</th>
                        <th>TINGKAT</th>
                        <th>ANGKATAN</th>
                        <th>Judul Penelitian Ilmiah</th>
                        <th>Dosen Pembimbing</th>
                        <th>Kategori</th>
                        <th>Tanggal Upload</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_mahasiswa']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['npm']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tingkat']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['angkatan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['judul_penelitian']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['dosen_pembimbing']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['kategori_pi']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_upload']) . "</td>";
                            echo "<td><a href='admin/" . htmlspecialchars($row['filepath']) . "' target='_blank'>" . htmlspecialchars($row['filename']) . "</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>Tidak ada data penelitian ilmiah yang ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
            document.querySelector('.content').classList.toggle('shifted');
        });

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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$query->close();
$conn->close();
?>
