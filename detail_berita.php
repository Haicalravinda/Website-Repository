<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repository Universitas Gunadarma</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .header-image {
            max-width: 300px; /* Atur ukuran maksimum gambar */
            height: auto; /* Memastikan proporsi gambar tetap terjaga */
            margin-bottom: 30px;
            .container {
    text-align: center;
}
        }
        .navbar-nav .nav-link:hover {
            background-color: purple;
            color: white !important;
        }

        /* Kustomisasi warna ungu untuk navbar */
        .navbar-purple {
            background-color: #6a1b9a; /* Warna ungu */
        }

        .bg-purple {
            background-color: #6a1b9a; /* Warna ungu */
        }

        .navbar-purple .navbar-nav .nav-link {
            color: white;
        }

        .navbar-purple .navbar-nav .nav-link:hover {
            background-color: #4a148c; /* Warna ungu lebih gelap saat hover */
            color: white;
        }

        .search-container input[type="text"] {
            padding: 6px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
        }

        .search-container button {
            padding: 6px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #45a049;
        }

        .container {
            margin-top: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.5em;
        }

        .social-icons a:hover {
            color: #4CAF50;
        }

        .google-maps iframe {
            border: 0;
            width: 100%;
            height: 300px;
        }

        /* Kustomisasi warna ungu untuk footer */
        .footer-purple {
            background-color: #6a1b9a; /* Warna ungu */
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer-purple a {
            color: #ffffff; /* Warna link di footer */
            text-decoration: none;
        }

        .footer-purple a:hover {
            color: #e0e0e0; /* Warna link saat hover */
        }
    </style>
</head>

<body>
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-purple bg-purple">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://www.gunadarma.ac.id/wp-content/uploads/2024/03/logoug-1-1.png" height="auto" width="200" alt="Gambar Repository Gunadarma" class="header-image">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
                <!-- Menu kanan -->
                <!-- Menu kanan -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="auth.php">Authentication</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
include 'config.php';
        // Memeriksa apakah ID berita diberikan melalui URL
if (isset($_GET['id'])) {
    $id_berita = $_GET['id'];

    // Query untuk mengambil detail berita berdasarkan ID
    $query = "SELECT * FROM berita_repository WHERE id = $id_berita";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah berita ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Berita tidak ditemukan.";
        exit;
    }
} else {
    echo "ID berita tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['judul_berita']; ?> - Repository UG</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Konten Detail Berita -->
    <div class="container my-5">
        <h1 class="mb-4"><?php echo $row['judul_berita']; ?></h1>
        <p><small class="text-muted">Dipublikasikan pada <?php echo $row['tanggal_berita']; ?> oleh <?php echo $row['penulis']; ?></small></p>
        <p><?php echo nl2br($row['konten_berita']); ?></p>
        <a href="index.php" class="btn btn-secondary mt-4">Kembali ke Berita</a>
    </div>

    <!-- Footer -->
    <footer class="footer-purple">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h5>Ikuti Kami</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <h5>Lokasi Kami :</h5>
                    <h5>Universitas Gunadarma Kampus J1 (Kalimalang)</h5>
<p>Jalan Raya Kalimalang No. 24,
Tambun, Bekasi, Jawa Barat 17510.</p>
                    <div class="google-maps">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1101556094786!2d106.96784407324887!3d-6.2492129937392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c5204032a97%3A0x7dd864ce65061cd8!2sGunadarma%20University%20Campus%20J1!5e0!3m2!1sen!2sid!4v1729134728991!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <p>&copy; 2024 Repository UG. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>

</html>
