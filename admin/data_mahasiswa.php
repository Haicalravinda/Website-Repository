<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username Anda
$password = ""; // Ganti dengan password Anda
$dbname = "repository_ug2024"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data mahasiswa
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5e6f7, #d8b6e1);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            padding: 15px 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .navbar a.navbar-brand {
            color: #6f42c1;
            font-weight: bold;
        }

        .navbar a.navbar-brand:hover {
            color: #5a2c8c;
        }

        .navbar-brand img {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #6f42c1, #5a2c8c);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            border-right: 2px solid #5a2c8c;
            padding-top: 30px;
            transition: transform 0.3s ease;
            box-shadow: 3px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar .nav-link {
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            transition: background-color 0.3s ease;
            margin: 5px 15px;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: left 0.3s ease;
        }

        .sidebar .nav-link:hover::before {
            left: 0;
        }

        .sidebar .nav-link.active {
            background-color: #5a2c8c;
        }

        .sidebar h5 {
            color: white;
            margin-bottom: 30px;
        }

        /* Konten utama */
        .content {
            margin-left: 250px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .content.expanded {
            margin-left: 0;
        }

        /* Tabel */
        .table thead {
            background-color: #6f42c1;
            color: white;
        }

        .table td, .table th {
            vertical-align: middle;
            transition: background-color 0.3s ease;
        }

        .table td:hover {
            background-color: #f1e0ff;
        }

        /* Tombol */
        .btn-primary {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        .btn-primary:hover {
            background-color: #5a2c8c;
            border-color: #5a2c8c;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px 0;
            background-color: #6f42c1;
            color: white;
            margin-top: 30px;
            animation: fadeIn 2s ease-in-out;
        }

        /* Animasi Fade In */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 80%;
                max-width: 300px;
            }

            .sidebar.hidden {
                transform: translateX(-100%);
            }

            .content {
                margin-left: 0;
                padding: 10px;
            }

            .navbar {
                padding: 10px;
            }

            .navbar-brand {
                font-size: 16px;
            }

            .navbar-brand img {
                height: 40px;
            }

            .table-responsive {
                padding: 10px;
                font-size: 14px;
            }

            .table td, .table th {
                padding: 8px;
            }

            .btn {
                padding: 5px 10px;
                font-size: 12px;
            }
        }

        /* Penyesuaian Tabel */
        .table-responsive {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(45deg, #6f42c1, #5a2c8c);
            color: white;
            font-weight: 500;
            border: none;
        }

        .table td {
            padding: 12px;
        }

        /* Penyesuaian Button */
        .btn {
            border-radius: 8px;
            padding: 8px 15px;
            transition: transform 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        /* Animasi loading */
        .loading-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Card style untuk konten */
        .content-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="btn btn-outline-primary" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand ms-3" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Gunadarma Logo" height="50">
                Repository Universitas Gunadarma
            </a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h5 class="text-center mb-4">Menu Navigasi</h5>
        <ul class="nav flex-column">
            <li><a class="nav-link" href="index.php"><i class="fas fa-home me-2"></i>Dashboard</a></li>
            <li><a class="nav-link active" href="data_mahasiswa.php"><i class="fas fa-user-graduate me-2"></i>Data Mahasiswa</a></li>
            <li><a class="nav-link" href="data_dosen.php"><i class="fas fa-chalkboard-teacher me-2"></i>Data Dosen</a></li>
            <li><a class="nav-link" href="data_pi.php"><i class="fas fa-book me-2"></i>Penelitian Ilmiah</a></li>
            <li><a class="nav-link" href="data_ta.php"><i class="fas fa-file-alt me-2"></i>Tugas Akhir</a></li>
            <li><a class="nav-link" href="berita.php"><i class="fas fa-newspaper me-2"></i>Data Berita</a></li>
            <li><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content" id="content">
        <h2 class="text-center my-4">Data Mahasiswa</h2>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nomor Pokok Mahasiswa</th>
                        <th>Email</th>
                        <th>File KTM/KRS</th>
                        <th>Alamat Lengkap</th>
                        <th>Kelas</th>
                        <th>Status Registrasi</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menampilkan data mahasiswa
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id"] . "</td>
                                    <td>" . $row["nama_lengkap"] . "</td>
                                    <td>" . $row["npm"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td><a href='uploads/" . $row["file_ktm_krs"] . "'>Download</a></td>
                                    <td>" . $row["alamat_lengkap"] . "</td>
                                    <td>" . $row["kelas"] . "</td>
                                    <td>" . $row["status_mhs_reg"] . "</td>
                                    <td>" . $row["jurusan"] . "</td>
                                    <td>" . $row["angkatan"] . "</td>
                                    <td><a href='edit_mahasiswa.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11' class='text-center'>No data found</td></tr>";
                    }

                    // Menutup koneksi
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Repository Universitas Gunadarma. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('hidden');
            content.classList.toggle('expanded');
        }
    </script>
</body>
</html>
