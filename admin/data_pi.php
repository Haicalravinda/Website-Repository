<?php
include('config.php'); // Sertakan koneksi database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penelitian Ilmiah</title>
    
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

        .table {
            margin-bottom: 0;
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

        /* Responsive */
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
                Data Penelitian Ilmiah
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
        <h2 class="text-center my-4">Data Penelitian Ilmiah</h2>
        <div class="mb-3">
            <a href="up_pi.php" class="btn btn-custom">Tambah Data Penelitian Ilmiah</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>NPM</th>
                        <th>Kelas</th>
                        <th>Angkatan</th>
                        <th>Judul Penelitian</th>
                        <th>Dosen Pembimbing</th>
                        <th>Kategori</th>
                        <th>Status PI</th>
                        <th>Tanggal Upload</th>
                        <th>File Abstract (PDF)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_pi = "SELECT * FROM repository_pi2024";
                    $result_pi = $conn->query($sql_pi);

                    if ($result_pi && $result_pi->num_rows > 0) {
                        while ($row_pi = $result_pi->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row_pi['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['nama_mahasiswa']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['npm']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['tingkat']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['angkatan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['judul_penelitian']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['dosen_pembimbing']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['kategori_pi']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['status_pi']) . "</td>";
                            echo "<td>" . htmlspecialchars($row_pi['tanggal_upload']) . "</td>";
                            echo "<td><a href='" . htmlspecialchars($row_pi['filepath']) . "' target='_blank'>" . htmlspecialchars($row_pi['filename']) . "</a></td>";
                            echo "<td>
                                    <a href='edit_statuspi.php?id=" . htmlspecialchars($row_pi['id']) . "' class='btn btn-warning btn-custom'>Edit</a>
                                    <a href='hapus_pi.php?id=" . htmlspecialchars($row_pi['id']) . "' class='btn btn-danger btn-custom' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12' class='text-center'>Data Penelitian Ilmiah tidak ditemukan.</td></tr>";
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
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('active');
            content.classList.toggle('expanded');
            overlay.classList.toggle('active');
        }

        // DataTable initialization
        $(document).ready(function() {
            $('.table').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    </script>
</body>
</html>
