<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Mengatur font dan warna latar belakang */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #9b5fff, #6a0dad);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        /* Desain form login */
        .login-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: scale(1.05);
        }

        /* Judul */
        h2 {
            color: #6a0dad;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        /* Form Styling */
        .form-group label {
            font-weight: 600;
        }

        /* Tombol dengan animasi */
        .btn-custom {
            background: linear-gradient(to right, #9b5fff, #6a0dad);
            border: none;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            padding: 10px;
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #6a0dad, #9b5fff);
            transform: translateY(-2px);
        }

        /* Animasi Logo */
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        /* Keyframes animasi logo */
        @keyframes bounce {
            0%,
            100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Responsif untuk tampilan kecil */
        @media (max-width: 480px) {
            .login-container {
                padding: 20px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Logo dengan animasi -->
        <div class="logo-container">
            <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Logo" style="height: 60px;">
        </div>
        <!-- Judul Halaman Login -->
        <h2>Login Admin</h2>
        <!-- Form Login -->
        <form action="login_admin.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email Anda" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password Anda" required>
            </div>

            <button type="submit" class="btn btn-custom btn-block">Login</button>
        </form>
    </div>

    <!-- JavaScript dan dependensi -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
