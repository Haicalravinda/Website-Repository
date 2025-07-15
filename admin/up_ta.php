<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Penelitian</title>

    <!-- Bootstrap 4.5 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS for layout and effects -->
    <style>
        /* General body styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #e0eafc, #cfdef3);
            margin: 0;
            padding: 0;
        }

        /* Main container styling */
        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Heading styling */
        h1 {
            text-align: center;
            color: #4e73df;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        /* Form field styling */
        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select {
            height: 45px;
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 1rem;
            color: #555;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #4e73df;
            outline: none;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
        }

        /* Button styling */
        .btn-primary {
            background: #4e73df;
            border: none;
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
        }

        /* Link styling */
        a {
            color: #555;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #4e73df;
        }

        /* Responsiveness for smaller screens */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Upload Penelitian</h1>
        <form action="upload_ta.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_mahasiswa">Nama Mahasiswa:</label>
                <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" required>
            </div>

            <div class="form-group">
                <label for="npm">NPM:</label>
                <input type="text" class="form-control" name="npm" id="npm" required>
            </div>

            <div class="form-group">
                <label for="judul_skripsi">Judul Skripsi:</label>
                <input type="text" class="form-control" name="judul_skripsi" id="judul_skripsi" required>
            </div>

            <div class="form-group">
                <label for="dosen_pembimbing">Nama Dosen Pembimbing:</label>
                <input type="text" class="form-control" name="dosen_pembimbing" id="dosen_pembimbing" required>
            </div>

            <div class="form-group">
                <label for="kategori_ta">Kategori TA:</label>
                <select class="form-control" name="kategori_ta" id="kategori_ta" required>
                    <option value="Website">Website</option>
                    <option value="UI/UX">UI/UX</option>
                    <option value="Machine Learning">Machine Learning</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_upload">Tanggal Upload:</label>
                <input type="date" class="form-control" name="tanggal_upload" id="tanggal_upload" required>
            </div>

            <div class="form-group">
                <label for="file">File (PDF):</label>
                <input type="file" class="form-control" name="file" id="file" accept=".pdf" required>
            </div>

            <div class="form-group">
                <label for="file_poster">File Poster (Image):</label>
                <input type="file" class="form-control" name="file_poster" id="file_poster" accept="image/*">
            </div>

            <div class="form-group">
                <label for="status_ta">Status TA:</label>
                <select class="form-control" name="status_ta" id="status_ta" required>
                    <option value="direview">Direview</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Upload</button>

            <div class="text-center mt-2">
                <a href="data_pi.php">Kembali ke Daftar Penelitian</a>
            </div>
        </form>
    </div>

    <!-- JS and Bootstrap scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
