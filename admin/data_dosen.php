<?php
include('config.php'); // Sertakan koneksi database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Umum */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5e6f7, #d8b6e1);
            min-height: 100vh;
            animation: fadeIn 1s ease-in-out;
            overflow-x: hidden;
        }

        /* Animasi Fade In */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
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

        .sidebar .nav-link:hover {
            background-color: #5a2c8c;
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #5a2c8c;
            color: white;
        }

        /* Konten utama */
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .content.expanded {
            margin-left: 0;
        }

        footer {
            text-align: center;
            padding: 15px 0;
            background-color: #6f42c1;
            color: white;
            margin-top: 30px;
            animation: fadeIn 2s ease-in-out;
        }

        /* Tabel */
        .table thead {
            background-color: #6f42c1;
            color: white;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        /* Tombol Custom */
        .btn-custom {
            background-color: #6f42c1;
            color: white;
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .btn-custom:hover {
            transform: scale(1.1);
            background-color: #5a2c8c;
        }

        /* Media Query untuk responsivitas */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: absolute;
                top: 0;
                left: -100%;
                transition: transform 0.3s ease;
            }

            .sidebar.hidden {
                transform: translateX(100%);
            }


            .content {
                margin-left: 0;
                padding: 15px;
            }

            .navbar .navbar-brand {
                font-size: 18px;
            }
        }

        /* Table Styling */
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

        /* Button Styling */
        .btn-purple {
            background-color: #6f42c1;
            border-color: #6f42c1;
            color: white;
        }

        .btn-purple:hover {
            background-color: #5a2c8c;
            border-color: #5a2c8c;
            color: white;
        }

        /* Content Card */
        .content-wrapper {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
                <span>Data Dosen Universitas Gunadarma</span>
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
        <h2 class="text-center my-4">Data Dosen</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Dosen</th>
                        <th>Email</th>
                        <th>Nomor Induk</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_dosen = "SELECT * FROM dosen";
                    $result_dosen = $conn->query($sql_dosen);

                    if ($result_dosen && $result_dosen->num_rows > 0) {
                        while ($row_dosen = $result_dosen->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row_dosen['id_dosen']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_dosen['nama_dosen']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_dosen['email_dosen']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_dosen['nomor_induk_dosen']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_dosen['alamat_lengkap']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_dosen['status_dosen_reg']) . "</td>";
                            echo "<td>
                                    <a href='edit_dosen.php?id_dosen=" . htmlspecialchars($row_dosen['id_dosen']) . "' class='btn btn-warning btn-custom'>Edit</a>
                                    <a href='hapus_dosen.php?id_dosen=" . htmlspecialchars($row_dosen['id_dosen']) . "' class='btn btn-danger btn-custom' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Tidak ada data dosen yang ditemukan.</td></tr>";
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


