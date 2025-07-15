<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #444;
        }

        .navbar {
            background: linear-gradient(135deg, #5e2e7e, #8e44ad);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 45px;
            margin-right: 15px;
            border-radius: 8px;
        }

        .navbar-brand span {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .container-fluid {
            padding: 2rem;
        }

        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 2rem;
            margin-top: 2rem;
        }

        h2 {
            color: #5e2e7e;
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
        }

        h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, #5e2e7e, #8e44ad);
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        .thead-dark {
            background: linear-gradient(135deg, #5e2e7e, #8e44ad);
        }

        .thead-dark th {
            color: white !important;
            font-weight: 500;
            border: none;
            padding: 15px;
        }

        .table td {
            vertical-align: middle;
            padding: 12px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f5ff;
        }

        .btn-view {
            background: linear-gradient(135deg, #5e2e7e, #8e44ad);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(94,46,126,0.3);
            color: white;
        }

        .jurusan-info {
            background: linear-gradient(135deg, #5e2e7e, #8e44ad);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .poster-preview {
            max-width: 100px;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .poster-preview:hover {
            transform: scale(1.1);
        }

        /* Animasi loading */
        .table-responsive {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsif */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }
            
            .main-content {
                padding: 1rem;
            }

            .navbar-brand span {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Gunadarma University Logo">
                <span>Repository Universitas Gunadarma</span>
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Menu -->
            <?php include('sidebar.php'); ?>
            
            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="main-content">
                    <h2 class="text-center">Directory Tugas Akhir (SKRIPSI)</h2>
                    <div class="jurusan-info mb-4">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        JURUSAN : SISTEM INFORMASI
                    </div>
                    
                    <!-- Table content remains the same -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nomor Pokok Mahasiswa</th>
                                    <th>Tingkat + Kelas</th>
                                    <th>Angkatan</th>
                                    <th>Judul Skripsi</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Upload</th>
                                    <th>Poster</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Membuat koneksi ke database
                                $conn = new mysqli("localhost", "root", "", "repository_ug2024");

                                // Memeriksa koneksi
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Query untuk mengambil data dari tabel repository_ta2024
                                $sql = "SELECT id, nama_mahasiswa, npm, tingkat, angkatan, judul_skripsi, dosen_pembimbing, kategori_ta, tanggal_upload, poster, filename, filepath 
                                        FROM repository_ta2024 
                                        WHERE status_ta='Diterima'";
                                $result = $conn->query($sql);

                                // Menampilkan data dari database
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nama_mahasiswa'] . "</td>";
                                        echo "<td>" . $row['npm'] . "</td>";
                                        echo "<td>" . $row['tingkat'] . "</td>";
                                        echo "<td>" . $row['angkatan'] . "</td>";
                                        echo "<td>" . $row['judul_skripsi'] . "</td>";
                                        echo "<td>" . $row['dosen_pembimbing'] . "</td>";
                                        echo "<td>" . $row['kategori_ta'] . "</td>";
                                        echo "<td>" . $row['tanggal_upload'] . "</td>";
                                        echo "<td>" . $row['poster'] . "</td>";
                                        echo "<td><a href='admin/" . $row['filepath'] . "' target='_blank'>" . $row['filename'] . "</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='11' class='text-center'>Tidak ada data TA yang ditemukan.</td></tr>";
                                }

                                // Menutup koneksi
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
