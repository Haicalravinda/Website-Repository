<?php
include('config.php'); // Sertakan koneksi database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Tugas Akhir</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome untuk ikon -->
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

        /* Konten utama */
        .content {
            margin-left: 250px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        /* Tabel */
        .table-responsive {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .table thead th {
            background: linear-gradient(45deg, #6f42c1, #5a2c8c);
            color: white;
            font-weight: 500;
            border: none;
        }

        .table td, .table th {
            vertical-align: middle;
            transition: background-color 0.3s ease;
        }

        .table td:hover {
            background-color: #f1e0ff;
        }

        /* Tombol */
        .btn-custom {
            background-color: #6f42c1;
            border-color: #6f42c1;
            color: white;
            border-radius: 8px;
            padding: 8px 15px;
            transition: transform 0.2s ease;
        }

        .btn-custom:hover {
            background-color: #5a2c8c;
            border-color: #5a2c8c;
            color: white;
            transform: translateY(-2px);
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

        /* Responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 80%;
                max-width: 300px;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                padding: 10px;
            }

            .table-responsive {
                padding: 10px;
                font-size: 14px;
            }

            .btn {
                padding: 5px 10px;
                font-size: 12px;
            }
        }

        /* Overlay untuk mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        @media (max-width: 992px) {
            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="btn btn-outline-dark" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand ms-3" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Gunadarma Logo" height="50">
                Directory Tugas Akhir
            </a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h5 class="text-center text-primary mb-4">Menu Navigasi</h5>
        <ul class="nav flex-column">
            <li><a class="nav-link" href="index.php"><i class="fas fa-home me-2"></i>Dashboard</a></li>
            <li><a class="nav-link" href="data_mahasiswa.php"><i class="fas fa-user-graduate me-2"></i>Data Mahasiswa</a></li>
            <li><a class="nav-link" href="data_dosen.php"><i class="fas fa-chalkboard-teacher me-2"></i>Data Dosen</a></li>
            <li><a class="nav-link" href="data_pi.php"><i class="fas fa-book me-2"></i>Penelitian Ilmiah</a></li>
            <li><a class="nav-link" href="data_ta.php"><i class="fas fa-file-alt me-2"></i>Tugas Akhir</a></li>
            <li><a class="nav-link active" href="berita.php"><i class="fas fa-newspaper me-2"></i>Data Berita</a></li>
            <li><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
        </ul>
    </div>

    <!-- Konten -->
    <div class="content" id="content">
        <h2 class="text-center my-4">Directory Tugas Akhir (SKRIPSI)</h2>
        <p class="text-center mb-3">JURUSAN : SISTEM INFORMASI</p>
        <div class="mb-3 text-end">
            <a href="up_ta.php" class="btn btn-custom">Tambah Data Tugas Akhir</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>NPM</th>
                        <th>Judul Skripsi</th>
                        <th>Dosen Pembimbing</th>
                        <th>Kategori</th>
                        <th>Tanggal Upload</th>
                        <th>Status</th>
                        <th>File Abstrak(PDF)</th>
                        <th>Poster (JPG)</th>
                        <th>Upload Time</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_ta = "SELECT * FROM repository_ta2024";  // Assuming this is the correct table name in your database
                    $result_ta = $conn->query($sql_ta);

                    if ($result_ta && $result_ta->num_rows > 0) {
                        while ($row_ta = $result_ta->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row_ta['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_ta['nama_mahasiswa']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_ta['npm']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_ta['judul_skripsi']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_ta['dosen_pembimbing']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_ta['kategori_ta']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_ta['tanggal_upload']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_ta['status_ta']) . "</td>";
                            echo "<td><a href='" . htmlspecialchars($row_ta['filepath']) . "' target='_blank'>" . htmlspecialchars($row_ta['filename']) . "</a></td>";
                            echo "<td><a href='up_ta/" . htmlspecialchars($row_ta['file_poster']) . "' target='_blank'>Poster</a></td>";
                            echo "<td>" . htmlspecialchars($row_ta['upload_time']) . "</td>";
                            echo "<td>
                                <a href='edit_statusta.php?id=" . htmlspecialchars($row_ta['id']) . "' class='btn btn-warning btn-custom'>Edit</a>
                                <a href='hapus_ta.php?id=" . htmlspecialchars($row_ta['id']) . "' class='btn btn-danger btn-custom' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12' class='text-center'>Data Tugas Akhir tidak ditemukan.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; <?= date('Y') ?> Repository Universitas Gunadarma
    </footer>

    <!-- JS & Dependencies -->
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
