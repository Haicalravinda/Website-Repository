<?php
include 'config.php'; // Memuat file koneksi database
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repository Universitas Gunadarma</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6a1b9a;
            --secondary-color: #4CAF50;
            --accent-color: #ff9800;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--primary-color);
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 45px;
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            transform: translateY(-2px);
        }

        /* Carousel Styles */
        .carousel {
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .carousel-item {
            max-height: 500px;
            overflow: hidden;
        }

        .carousel-item img {
            object-fit: cover;
            width: 100%;
            height: 500px;
            filter: brightness(0.9);
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .card-title {
            color: var(--primary-color);
            font-weight: 600;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        /* Footer Styles */
        .footer-purple {
            background-color: var(--primary-color);
            color: white;
            padding: 3rem 0;
            margin-top: 3rem;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.5em;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }

        .google-maps {
            border-radius: 10px;
            overflow: hidden;
            margin-top: 1rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 35px;
            }

            .carousel-item {
                max-height: 300px;
            }

            .carousel-item img {
                height: 300px;
            }

            .container {
                padding: 0 1rem;
            }

            .footer-purple {
                text-align: center;
            }

            .social-icons {
                margin-bottom: 2rem;
            }

            .google-maps iframe {
                height: 250px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://www.gunadarma.ac.id/wp-content/uploads/2024/03/logoug-1-1.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth.php">Authentication</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed navbar -->
    <div style="height: 76px;"></div>

    <!-- Banner Slideshow -->
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://kuliahkelaskaryawan.org/wp-content/uploads/2017/01/Gundar.jpg" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="https://www.datapendidikan.com/blog/wp-content/uploads/2022/11/Cara-Pendaftaran-Universitas-Gunadarma.png" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="/api/placeholder/1200/500" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- About Section -->
    <div class="container my-5 animate-fade-up">
        <h2 class="mb-4 text-center">Tentang Repository</h2>
        <div class="card">
            <div class="card-body">
                <p class="lead">Repository Universitas Gunadarma adalah platform yang disediakan untuk menyimpan, mengelola, dan membagikan karya-karya ilmiah yang dihasilkan oleh mahasiswa, dosen, dan peneliti di Universitas Gunadarma. Melalui repository ini, kami bertujuan untuk mendukung keterbukaan informasi, memperluas jangkauan penelitian, dan menyediakan akses yang mudah terhadap publikasi ilmiah yang dihasilkan oleh komunitas akademik kami.</p>
            </div>
        </div>
    </div>

    <div class="container my-5 animate-fade-up">
    <h2 class="mb-4 text-center">Berita Terbaru</h2>
    <div class="row">
        <?php
        // Koneksi ke database dan mengambil data berita
        $sql = "SELECT * FROM berita_repository ORDER BY tanggal_berita DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Menampilkan data berita
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '    <div class="card">';
                echo '        <div class="card-body">';
                echo '            <h5 class="card-title">' . htmlspecialchars($row['judul_berita']) . '</h5>';
                echo '            <p class="card-text">' . nl2br(htmlspecialchars(substr($row['konten_berita'], 0, 100))) . '...</p>';
                echo '            <p><small>' . $row['tanggal_berita'] . ' | ' . $row['penulis'] . '</small></p>';
                echo '            <a href="#" class="btn btn-primary">Selengkapnya</a>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo '<p>Tidak ada berita untuk ditampilkan.</p>';
        }
        ?>
    </div>
</div>


    <!-- Footer -->
    <footer class="footer-purple">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h5 class="mb-3">Ikuti Kami</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="mb-3">Lokasi Kami</h5>
                    <h6>Universitas Gunadarma Kampus J1 (Kalimalang)</h6>
                    <p>Jalan Raya Kalimalang No. 24, Tambun, Bekasi, Jawa Barat 17510.</p>
                    <div class="google-maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1101556094786!2d106.96784407324887!3d-6.2492129937392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a186b0ff5f5b1%3A0x67a2c35f1d9b70e2!2sUniversitas%20Gunadarma%20Kampus%20J1!5e0!3m2!1sen!2sid!4v1576091539250!5m2!1sen!2sid" style="border:0; width:100%; height:300px;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add animation to cards on scroll
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>
<?php
mysqli_close($conn);
?>