<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .navbar-brand img {
            height: 50px; /* Adjust logo size */
            margin-right: 10px;
        }

        /* Tambahkan CSS untuk layout dan sidebar */
        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: var(--primary-purple);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .menu-item:hover, .menu-item.active {
            background: var(--light-purple);
            color: white;
            text-decoration: none;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background: #f8f9fa;
        }

        /* Update container style */
        .container {
            max-width: calc(100% - 40px);
            margin: 20px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        /* Animasi hover untuk menu item */
        .menu-item:hover i {
            transform: translateX(5px);
            transition: transform 0.3s;
        }

        /* Style untuk status badge */
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8em;
            font-weight: bold;
        }

        .status-verifikasi {
            background: #ffd700;
            color: #000;
        }

        .status-diterima {
            background: #4CAF50;
            color: white;
        }

        .status-ditolak {
            background: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include('sidebar.php'); ?>
        
        <div class="main-content">
            <div class="container">
                <h2 class="my-4">Edit Status PI</h2>
                <?php
                   include('config.php');
                   // Mendapatkan ID mahasiswa dari URL
                   $id = $_GET['id'];

                   // Query untuk mengambil data dari tabel repository_pi2020
                   $sql = "SELECT id, nama_mahasiswa, npm, tingkat, angkatan, judul_penelitian, dosen_pembimbing, kategori_pi, tanggal_upload, filename, status_pi, filepath FROM repository_pi2024";
                   $result = $conn->query($sql);

                   // Menampilkan data mahasiswa berdasarkan ID
                   $query = "SELECT * FROM repository_pi2024 WHERE id = ?";
                   $stmt = $conn->prepare($query);
                   $stmt->bind_param("i", $id);
                   $stmt->execute();
                   $result = $stmt->get_result();
                   $row = $result->fetch_assoc();

                   // Jika form disubmit
                   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                       $status_pi = $_POST['status_pi'];

                       // Query update data
                       $update_query = "UPDATE repository_pi2024 SET status_pi = ? WHERE id = ?";
                       $update_stmt = $conn->prepare($update_query);
                       $update_stmt->bind_param("si", $status_pi, $id);

                       if ($update_stmt->execute()) {
                           echo "Data berhasil diupdate!";
                       } else {
                           echo "Terjadi kesalahan: " . $conn->error;
                       }
                   }
                   ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NPM</th>
                            <th>Tingkat</th>
                            <th>Angkatan</th>
                            <th>Judul Penelitian</th>
                            <th>Dosen Pembimbing</th>
                            <th>Kategori PI</th>
                            <th>Tanggal Upload</th>
                            <th>Status PI Terakhir</th>
                            <th>FILE ABSTRAK</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $row['nama_mahasiswa']; ?></td>
                            <td><?php echo $row['npm']; ?></td>
                            <td><?php echo $row['tingkat']; ?></td>
                            <td><?php echo $row['angkatan']; ?></td>
                            <td><?php echo $row['judul_penelitian']; ?></td>
                            <td><?php echo $row['dosen_pembimbing']; ?></td>
                            <td><?php echo $row['kategori_pi']; ?></td>
                            <td><?php echo $row['tanggal_upload']; ?></td>
                            <td><?php echo $row['status_pi']; ?></td>
                            <td>
                                <a href="<?php echo $row['filepath']; ?>" target="_blank"><?php echo $row['filename']; ?></a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <form method="post" class="container">
                    <div class="form-group mb-3">
                        <label for="status_pi">Status</label>
                        <select class="form-control" id="status_pi" name="status_pi">
                            <option value="TAHAP VERIFIKASI" <?php if($row['status_pi'] == 'TAHAP VERIFIKASI') echo 'selected'; ?>>TAHAP VERIFIKASI</option>
                            <option value="DITERIMA" <?php if($row['status_pi'] == 'DITERIMA') echo 'selected'; ?>>DITERIMA</option>
                            <option value="DITOLAK" <?php if($row['status_pi'] == 'DITOLAK') echo 'selected'; ?>>DITOLAK</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="data_pi.php">BACK</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>