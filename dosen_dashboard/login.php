<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dosen</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-box img {
            width: 100%;
            border-radius: 10px;
        }

        .login-box h1 {
            font-size: 24px;
            font-weight: bold;
            color: #4a4a4a;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-box p {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-box .form-group {
            margin-bottom: 15px;
        }

        .login-box .form-control {
            border-radius: 5px;
        }

        .login-box .btn-primary {
            width: 100%;
            border-radius: 5px;
        }

        .login-box .btn-success {
            width: 100%;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn-back {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            transition: transform 0.2s ease;
        }

        .btn-back:hover {
            transform: scale(1.1);
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <!-- Tombol Back -->
            <button class="btn btn-back mb-3" onclick="window.history.back();">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>

            <img alt="Gunadarma University Logo" src="https://jurusan-akademik.gunadarma.ac.id/assets/img/brand/logoUG.png" />
            <h1>LOGIN DOSEN</h1>
            <p>Sistem Informasi Akademik - Dosen</p>

            <form action="login_process.php" method="POST">
                <div class="mb-3">
                    <label for="email_dosen" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email_dosen" name="email_dosen" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <a href="register.php" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Daftar
            </a>

            <div class="footer">
                Copyright &copy; 2024. Universitas Gunadarma
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php
        session_start();
        if (isset($_SESSION['status'])) {
            echo "Swal.fire({
                icon: 'warning',
                title: 'Akun Anda Belum Aktif',
                text: 'Akun Anda sedang dalam proses verifikasi. Harap tunggu konfirmasi lebih lanjut.',
                confirmButtonText: 'OK',
                background: '#fff3cd',
                iconColor: '#856404',
                confirmButtonColor: '#856404',
            });";
            unset($_SESSION['status']);
        }

        if (isset($_SESSION['login_error'])) {
            echo "Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '" . $_SESSION['login_error'] . "',
                confirmButtonText: 'Coba Lagi',
                background: '#f8d7da',
                iconColor: '#721c24',
                confirmButtonColor: '#721c24',
            });";
            unset($_SESSION['login_error']);
        }
        ?>
    </script>
</body>

</html>
