<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa</title>
    <!-- Link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Latar Belakang */
        body {
            background-image: url('https://th.bing.com/th/id/R.ed05ef13ec95434a78d2a35b8416564c?rik=2sXatG3QXFnHlg&riu=http%3a%2f%2f1.bp.blogspot.com%2f-W95syyy3J54%2fVH2wmOzADCI%2fAAAAAAAALTE%2fCKnUvNBYGaQ%2fs1600%2fug.jpg&ehk=jOH06RoNo17RQ4S61%2fNfG5EWxgT59%2bRX%2fbxmLZ5esE4%3d&risl=&pid=ImgRaw&r=0');
            background-size: cover;
            background-position: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        /* Container formulir */
        .container {
            max-width: 900px;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 5% auto;
        }

        /* Desain Judul */
        h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #333;
        }

        /* Desain tombol */
        .btn-primary {
            background-color: #6f42c1;
            border-color: #6f42c1;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #d63384;
            border-color: #d63384;
        }

        /* Responsif formulir */
        @media (max-width: 768px) {
            .form-section {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Container formulir utama -->
    <div class="container">
        <!-- Judul formulir -->
        <h2 class="text-uppercase">Form Registrasi Mahasiswa</h2>
        <p class="text-center text-muted mb-4">Lengkapi data Anda untuk melanjutkan pendaftaran.</p>

        <!-- Formulir Registrasi -->
        <form action="register_bk.php" method="POST" enctype="multipart/form-data">
            <div class="row g-3 form-section">
                <!-- Nama Lengkap -->
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Contoh: John Doe" required>
                </div>
                <!-- NPM -->
                <div class="col-md-6">
                    <label for="npm" class="form-label">NPM</label>
                    <input type="text" class="form-control" name="npm" id="npm" placeholder="Contoh: 202210123" required>
                </div>
                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Contoh: email@example.com" required>
                </div>
                <!-- Password -->
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password Anda" required>
                </div>
                <!-- Upload File KTM/KRS -->
                <div class="col-md-6">
                    <label for="file_ktm_krs" class="form-label">Upload KTM/KRS (JPG atau PDF)</label>
                    <input type="file" class="form-control" name="file_ktm_krs" id="file_ktm_krs" accept=".jpg,.pdf" required>
                </div>
                <!-- Alamat Lengkap -->
                <div class="col-12">
                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" rows="3"
                        placeholder="Tuliskan alamat lengkap Anda" required></textarea>
                </div>
                <!-- Dropdown Jurusan -->
                <div class="col-md-6">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <select class="form-select" name="jurusan" id="jurusan" required>
                        <option value="">Pilih Jurusan</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Kedokteran">Kedokteran</option>
                    </select>
                </div>
                <!-- Dropdown Kelas -->
                <div class="col-md-6">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="form-select" name="kelas" id="kelas" required>
                        <option value="">Pilih Kelas</option>
                        <option value="1">Kelas 1</option>
                        <option value="2">Kelas 2</option>
                        <option value="3">Kelas 3</option>
                        <option value="4">Kelas 4</option>
                    </select>
                </div>
                <!-- Angkatan Tahun -->
                <div class="col-md-6">
                    <label for="angkatan" class="form-label">Angkatan Tahun</label>
                    <input type="number" class="form-control" name="angkatan" id="angkatan" placeholder="Contoh: 2023" required>
                </div>
            </div>

            <!-- Tombol Daftar -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2">Daftar</button>
            </div>
        </form>
    </div>

    <!-- JS Dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
