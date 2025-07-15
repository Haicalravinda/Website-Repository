<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Repository Universitas Gunadarma</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6a1b9a;
            --secondary-color: #4CAF50;
            --hover-color: #4a148c;
            --text-color: #333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--primary-color);
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
            background-color: var(--hover-color);
            transform: translateY(-2px);
        }

        /* Contact Form Styles */
        .contact-section {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 2rem;
            margin-top: 2rem;
            transition: transform 0.3s ease;
        }

        .contact-section:hover {
            transform: translateY(-5px);
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.8rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(106, 27, 154, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Footer Styles */
        .footer-purple {
            background-color: var(--primary-color);
            color: white;
            padding: 3rem 0;
            margin-top: 5rem;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.5em;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--secondary-color);
            transform: translateY(-3px);
        }

        .google-maps {
            border-radius: 15px;
            overflow: hidden;
            margin-top: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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

        /* Success Message */
        .success-message {
            display: none;
            background-color: #4CAF50;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            text-align: center;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 35px;
            }

            .contact-section {
                padding: 1.5rem;
                margin: 1rem;
            }

            .google-maps iframe {
                height: 250px;
            }

            .footer-purple {
                text-align: center;
                padding: 2rem 0;
            }

            .social-icons {
                margin-bottom: 2rem;
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
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="kontak.php">Kontak</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="auth.php">Authentication</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed navbar -->
    <div style="height: 76px;"></div>

    <!-- Contact Section -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-section animate-fade-up">
                    <h2 class="text-center mb-4">Hubungi Kami</h2>
                    <p class="text-center mb-4">Silakan isi formulir di bawah ini untuk menghubungi kami. Kami akan merespons pesan Anda segera.</p>
                    
                    <form id="contactForm" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Mohon isi nama lengkap Anda</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Mohon isi alamat email yang valid</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            <div class="invalid-feedback">Mohon isi pesan Anda</div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fab fa-whatsapp me-2"></i>Kirim via WhatsApp
                            </button>
                        </div>
                    </form>
                    
                    <div id="successMessage" class="success-message">
                        Pesan Anda akan diteruskan ke WhatsApp
                    </div>
                </div>
            </div>
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1101556094786!2d106.96784407324887!3d-6.2492129937392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c5204032a97%3A0x7dd864ce65061cd8!2sGunadarma%20University%20Campus%20J1!5e0!3m2!1sen!2sid!4v1729134728991!5m2!1sen!2sid" style="border:0; width:100%; height:300px;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center">
                <p>&copy; 2024 Repository UG. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            if (!this.checkValidity()) {
                event.stopPropagation();
                this.classList.add('was-validated');
                return;
            }
            
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let message = document.getElementById('message').value;

            let whatsappMessage = `*Pesan dari Website Repository UG*\n\nNama: ${name}\nEmail: ${email}\n\nPesan:\n${message}`;
            let whatsappURL = `https://wa.me/+6281288905250?text=${encodeURIComponent(whatsappMessage)}`;

            // Show success message
            document.getElementById('successMessage').style.display = 'block';
            
            // Delay WhatsApp opening slightly to show the success message
            setTimeout(() => {
                window.open(whatsappURL, '_blank');
            }, 500);
        });

        // Add animation on scroll
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

        document.querySelectorAll('.contact-section').forEach(section => {
            observer.observe(section);
        });
    </script>
</body>
</html>