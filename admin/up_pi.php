<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Penelitian</title>

    <!-- Bootstrap 4.5 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS untuk tata letak dan efek -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #e0eafc, #cfdef3);
            margin: 0;
            padding: 0;
        }

        /* Kontainer utama dengan bayangan lembut dan radius */
        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        /* Judul */
        h1 {
            text-align: center;
            color: #4e73df;
            margin-bottom: 20px;
            animation: bounceIn 1s ease-out;
        }

        /* Animasi judul */
        @keyframes bounceIn {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }

            50% {
                transform: translateY(10px);
                opacity: 0.7;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Formulir dan tombol */
        .btn-primary {
            background: #4e73df;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
        }

        /* Animasi untuk formulir */
        .form-container {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Link kembali ke halaman sebelumnya */
        a {
            color: #555;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #4e73df;
        }

        /* Responsivitas untuk formulir */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.8em;
            }
        }

    </style>
</head>

<body>
    <!-- Formulir utama -->
    <div class="container">
        <h1>📄 Upload Penelitian Ilmiah</h1>
        <div class="form-container">
            <form action="upload_pi.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_mahasiswa">Nama Mahasiswa:</label>
                    <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" required>
                </div>

                <div class="form-group">
                    <label for="npm">NPM:</label>
                    <input type="number" class="form-control" name="npm" id="npm" required>
                </div>

                <div class="form-group">
                    <label for="tingkat">Kelas:</label>
                    <input type="text" class="form-control" name="tingkat" id="tingkat" required>
                </div>

                <div class="form-group">
                    <label for="angkatan">Angkatan:</label>
                    <input type="text" class="form-control" name="angkatan" id="angkatan" required>
                </div>

                <div class="form-group">
                    <label for="judul_penelitian">Judul Penelitian:</label>
                    <input type="text" class="form-control" name="judul_penelitian" id="judul_penelitian" required>
                </div>

                <div class="form-group">
                    <label for="dosen_pembimbing">Nama Dosen Pembimbing:</label>
                    <input type="text" class="form-control" name="dosen_pembimbing" id="dosen_pembimbing" required>
                </div>

                <div class="form-group">
                    <label for="kategori_pi">Kategori Penelitian Ilmiah (PI):</label>
                    <select class="form-control" name="kategori_pi" id="kategori_pi" required>
                        <option value="Website">Website</option>
                        <option value="UI/UX">UI/UX</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_upload">Tanggal Upload:</label>
                    <input type="date" class="form-control" name="tanggal_upload" id="tanggal_upload" required>
                </div>

                <div class="form-group">
                    <label for="file">File (PDF):</label>
                    <input type="file" class="form-control" name="file" id="file" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-3">Upload</button>
                <div class="text-center mt-2">
                    <a href="data_pi.php">Kembali ke Daftar Penelitian</a>
                </div>
            </form>
        </div>
    </div>

    <!-- JS dan Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
