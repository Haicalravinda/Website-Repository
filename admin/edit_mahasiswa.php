<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Umum */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #e0eafc, #cfdef3);
        }

        /* Header Style */
        .navbar-brand img {
            height: 50px;
            margin-right: 10px;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            background: #fff;
            border-right: 1px solid #dee2e6;
            transition: transform 0.3s ease;
            padding: 20px;
        }

        .sidebar a:hover {
            color: #4e73df;
            transition: all 0.3s ease;
        }

        /* Animasi Form */
        .form-container {
            transform: translateY(-20px);
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Hover Effects */
        .btn-custom:hover {
            transform: scale(1.1);
            background-color: #395da4;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px 0;
            background: #4e73df;
            color: white;
            margin-top: 20px;
        }

        /* Card Styling */
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Navbar Styling */
        .navbar {
            height: 55px;
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1040;
            padding: 0;
        }

        .navbar-brand {
            font-size: 1.1rem;
            padding: 0;
        }

        .brand-text {
            color: var(--primary-purple);
            font-weight: 600;
        }

        .navbar-logo {
            height: 32px;
            width: auto;
        }

        .navbar-toggler {
            padding: 4px 8px;
        }

        .navbar-toggler i {
            color: var(--primary-purple);
            font-size: 1.2rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }

        /* Responsive Navbar */
        @media (max-width: 992px) {
            .navbar {
                padding: 0.5rem 1rem;
            }

            .brand-text {
                font-size: 1rem;
            }

            .navbar-logo {
                height: 28px;
            }
        }

        @media (max-width: 576px) {
            .brand-text {
                display: none;
            }

            .navbar-logo {
                height: 24px;
            }
        }

        /* Update sidebar top position to match navbar height */
        .sidebar {
            top: 55px;
        }

        /* Update main wrapper padding to match navbar height */
        .main-wrapper {
            padding-top: 55px;
        }

        /* Tambahan untuk memastikan konten tidak tertutup navbar */
        .content-wrapper {
            padding-top: 1.5rem;
        }
    </style>
</head>

<?php
// Koneksi ke database
include 'config.php';

// Mendapatkan ID mahasiswa dari URL
$id = $_GET['id'];
// Menampilkan data mahasiswa berdasarkan ID
$query = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $npm = $_POST['npm'];
    $email = $_POST['email'];
    $alamat_lengkap = $_POST['alamat_lengkap'];
    $kelas = $_POST['kelas'];
    $status_mhs_reg = $_POST['status_mhs_reg'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];

    // Query update data
    $update_query = "UPDATE students SET 
        nama_lengkap = '$nama_lengkap',
        npm = '$npm',
        email = '$email',
        alamat_lengkap = '$alamat_lengkap',
        kelas = '$kelas',
        status_mhs_reg = '$status_mhs_reg',
        jurusan = '$jurusan',
        angkatan = '$angkatan'
        WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        echo "Data berhasil diupdate!";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }
}
?>

<body>
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" 
                     alt="Logo" 
                     class="navbar-logo">
                <span class="brand-text ms-2">Admin Panel</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-purple"></i>
            </button>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar Menu -->
        <div class="sidebar">
            <h5 class="text-primary text-center mb-3">Menu Navigasi</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link" href="index.php"><i class="fas fa-home me-2"></i>Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="data_mahasiswa.php"><i class="fas fa-user-graduate me-2"></i>Data Mahasiswa</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="data_dosen.php"><i class="fas fa-chalkboard-teacher me-2"></i>Data Dosen</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="container flex-grow-1 mt-4">
            <div class="card form-container p-4">
            <h2 class="my-4">Edit Data Mahasiswa</h2>
<form method="post" class="container">
    <div class="form-group mb-3">
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>">
    </div>
    
    <div class="form-group mb-3">
        <label for="npm">NPM</label>
        <input type="text" class="form-control" id="npm" name="npm" value="<?php echo $row['npm']; ?>">
    </div>
    
    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
    </div>
    
    <div class="form-group mb-3">
        <label for="alamat_lengkap">Alamat Lengkap</label>
        <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" value="<?php echo $row['alamat_lengkap']; ?>">
    </div>
    
    <div class="form-group mb-3">
        <label for="kelas">Kelas</label>
        <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $row['kelas']; ?>">
    </div>
    
    <div class="form-group mb-3">
        <label for="status_mhs_reg">Status</label>
        <select class="form-control" id="status_mhs_reg" name="status_mhs_reg">
            <option value="TAHAP VERIFIKASI" <?php if($row['status_mhs_reg'] == 'TAHAP VERIFIKASI') echo 'selected'; ?>>TAHAP VERIFIKASI</option>
            <option value="DITERIMA" <?php if($row['status_mhs_reg'] == 'DITERIMA') echo 'selected'; ?>>DITERIMA</option>
            <option value="DITOLAK" <?php if($row['status_mhs_reg'] == 'DITOLAK') echo 'selected'; ?>>DITOLAK</option>
        </select>
    </div>
    
    <div class="form-group mb-3">
        <label for="jurusan">Jurusan</label>
        <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo $row['jurusan']; ?>">
    </div>
    
    <div class="form-group mb-3">
        <label for="angkatan">Angkatan</label>
        <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?php echo $row['angkatan']; ?>">
    </div>
    
    <button type="submit" class="btn btn-primary">Update Data</button>
</form>


    <!-- Footer -->
    <footer>
        &copy; <?= date('Y') ?> Universitas Gunadarma
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log('Form and sidebar UI loaded');
        });
    </script>
</body>

</html>
