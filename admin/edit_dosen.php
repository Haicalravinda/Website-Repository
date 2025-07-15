<?php
include('config.php'); // Sertakan koneksi database

if (!isset($_GET['id_dosen'])) {
    header('Location: data_dosen.php');
    exit();
}

$id_dosen = $_GET['id_dosen'];
$stmt = $conn->prepare("SELECT * FROM dosen WHERE id_dosen = ?");
$stmt->bind_param("i", $id_dosen);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: data_dosen.php');
    exit();
}

$row_dosen = $result->fetch_assoc();

// Proses formulir jika di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dosen = $_POST['nama_dosen'];
    $email_dosen = $_POST['email_dosen'];
    $nomor_induk_dosen = $_POST['nomor_induk_dosen'];
    $alamat_lengkap = $_POST['alamat_lengkap'];
    $status_dosen_reg = $_POST['status_dosen_reg'];

    $update_stmt = $conn->prepare("UPDATE dosen SET nama_dosen = ?, email_dosen = ?, nomor_induk_dosen = ?, alamat_lengkap = ?, status_dosen_reg = ? WHERE id_dosen = ?");
    $update_stmt->bind_param("sssssi", $nama_dosen, $email_dosen, $nomor_induk_dosen, $alamat_lengkap, $status_dosen_reg, $id_dosen);

    if ($update_stmt->execute()) {
        header('Location: data_dosen.php');
        exit();
    } else {
        $error_message = "Gagal memperbarui data.";
    }
    $update_stmt->close();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>
    <!-- Link Bootstrap 5 dan Font Awesome untuk ikon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Umum */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #d3e0ea, #f0f4f8);
            margin: 0;
        }

        /* Header */
        .navbar {
            background: #4e73df;
            color: white;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover {
            color: #4e73df;
            transition: 0.3s ease;
        }

        /* Animasi formulir */
        .form-container {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tombol */
        .btn-hover:hover {
            transform: scale(1.1);
            background-color: #395da4;
            transition: 0.3s ease;
        }

        /* Form dan card style */
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px 0;
            background: #4e73df;
            color: white;
            margin-top: 30px;
        }

        /* Sidebar Styling */
        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(139, 92, 246, 0.2);
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: #6b7280;
            padding: 12px 16px;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            transform: translateX(5px);
        }

        .icon-circle {
            width: 36px;
            height: 36px;
            background: rgba(139, 92, 246, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .nav-link:hover .icon-circle {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link i {
            font-size: 16px;
            color: #7c3aed;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover i {
            color: white;
        }

        .border-purple {
            border-color: rgba(139, 92, 246, 0.2) !important;
        }

        /* Animasi hover untuk menu items */
        .nav-link:hover .icon-circle {
            transform: rotate(360deg);
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Edit Data Dosen</span>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-4" style="min-height: 100vh; width: 280px;">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-purple">
                <i class="fas fa-university me-3" style="color: #7c3aed; font-size: 24px;"></i>
                <h5 class="m-0" style="color: #7c3aed; font-weight: 600;">Menu Navigasi</h5>
            </div>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="data_dosen.php">
                        <div class="icon-circle me-3">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <span>Daftar Dosen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="logout.php">
                        <div class="icon-circle me-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Konten utama -->
        <div class="container flex-grow-1 mt-5">
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger text-center"><?= $error_message ?></div>
            <?php } ?>
            <div class="card form-container p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" name="nama_dosen" value="<?= htmlspecialchars($row_dosen['nama_dosen']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email_dosen" class="form-label">Email Dosen</label>
                        <input type="email" class="form-control" name="email_dosen" value="<?= htmlspecialchars($row_dosen['email_dosen']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_induk_dosen" class="form-label">Nomor Induk Dosen</label>
                        <input type="text" class="form-control" name="nomor_induk_dosen" value="<?= htmlspecialchars($row_dosen['nomor_induk_dosen']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat_lengkap" rows="3" required><?= htmlspecialchars($row_dosen['alamat_lengkap']) ?></textarea>
                    </div>

                    <div class="mb-3">
    <label for="status_dosen_reg" class="form-label">Status Registrasi</label>
    <select class="form-control" name="status_dosen_reg">
        <option value="TAHAP VERIFIKASI" <?php if ($row_dosen['status_dosen_reg'] == 'TAHAP VERIFIKASI') echo 'selected'; ?>>TAHAP VERIFIKASI</option>
        <option value="DITERIMA" <?php if ($row_dosen['status_dosen_reg'] == 'DITERIMA') echo 'selected'; ?>>DITERIMA</option>
        <option value="DITOLAK" <?php if ($row_dosen['status_dosen_reg'] == 'DITOLAK') echo 'selected'; ?>>DITOLAK</option>
    </select>
</div>


                    <button type="submit" class="btn btn-success btn-hover w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>&copy; <?= date('Y') ?> Universitas Gunadarma</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
