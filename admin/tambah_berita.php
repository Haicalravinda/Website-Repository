<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS untuk animasi dan tata letak -->
    <style>
        /* Latar belakang utama */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #e3f2fd, #bbdefb);
            margin: 0;
            padding: 0;
        }

        /* Desain navbar */
        .navbar {
            background: #ffffff;
            color: #1976d2;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar a.navbar-brand {
            font-weight: bold;
            color: #1976d2;
        }

        .navbar a.navbar-brand:hover {
            color: #1565c0;
        }

        .navbar .nav-link {
            color: #1976d2;
        }

        .navbar .nav-link:hover {
            color: #1565c0;
        }

        /* Sidebar */
        #sidebarMenu {
            background-color: #ffffff;
            border-right: 2px solid #1976d2;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .sidebar .nav-item {
            font-size: 1.1em;
            padding: 12px;
        }

        .sidebar .nav-item a {
            color: #1976d2;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .sidebar .nav-item a:hover {
            color: #1565c0;
        }

        /* Animasi formulir */
        .form-container {
            animation: bounceIn 1s ease-out;
        }

        @keyframes bounceIn {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }

            50% {
                transform: translateY(10px);
                opacity: 0.8;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Perbaikan pada formulir */
        .btn-primary {
            background: #1976d2;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background: #1565c0;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            #sidebarMenu {
                display: none;
            }

            .container-fluid {
                padding: 0 10px;
            }

            h2 {
                font-size: 1.6em;
            }

            .content {
                padding: 0 10px;
            }
        }

        /* Pengaturan sidebar untuk desktop */
        @media (min-width: 768px) {
            .sidebar {
                display: block;
            }

            .sidebar .nav-item {
                padding: 12px;
            }

            .content {
                padding: 0 15px;
            }
        }

        /* Sentuhan ikon */
        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Formulir */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Logo Universitas Gunadarma" width="40" class="me-2">
                Repository Universitas Gunadarma
            </a>
        </div>
    </nav>

    <!-- Sidebar & Konten -->
    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fa fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data_mahasiswa.php">
                                <i class="fa fa-user"></i> Data Mahasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-book"></i> Data Penelitian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="berita.php">
                                <i class="fa fa-newspaper"></i> Data Berita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fa fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Konten Tambah Berita -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container my-5 form-container">
                    <h2 class="text-center mb-4">📰 Tambah Data Berita Baru</h2>
                    <form action="proses_tambah_berita.php" method="POST">
                        <div class="mb-3">
                            <label for="judul_berita" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Masukkan judul berita" required>
                        </div>

                        <div class="mb-3">
                            <label for="konten_berita" class="form-label">Konten Berita</label>
                            <textarea class="form-control" id="konten_berita" name="konten_berita" rows="5" placeholder="Masukkan konten berita" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_berita" class="form-label">Tanggal Publikasi</label>
                            <input type="date" class="form-control" id="tanggal_berita" name="tanggal_berita" required>
                        </div>

                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan nama penulis" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5 py-2">Tambah Berita</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
