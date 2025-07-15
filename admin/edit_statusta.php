<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand img {
            height: 50px; /* Adjust logo size */
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Header with Logo and Title -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Gunadarma University Logo">
                <span>Repository Universitas Gunadarma</span>
            </a>
        </div>
    </nav>
    <div class="container-fluid mt-5">
        <div class="row">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="container">
            <?php
            include('config.php');
            // Mendapatkan ID dari URL
            $id = $_GET['id'];

            // Query untuk mengambil data mahasiswa berdasarkan ID
            $query = "SELECT * FROM repository_ta2024 WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Jika form disubmit
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $status_ta = $_POST['status_ta'];

                // Query untuk update status TA
                $update_query = "UPDATE repository_ta2024 SET status_ta = ? WHERE id = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param("si", $status_ta, $id);

                if ($update_stmt->execute()) {
                    echo "<div class='alert alert-success'>Data berhasil diupdate!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $conn->error . "</div>";
                }
            }
            ?>

            <h2 class="my-4">Edit Status TA</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>NPM</th>
                        <th>Judul Skripsi</th>
                        <th>Dosen Pembimbing</th>
                        <th>Kategori TA</th>
                        <th>Tanggal Upload</th>
                        <th>Status TA Terakhir</th>
                        <th>File Poster</th>
                        <th>File Abstrak</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row['nama_mahasiswa']; ?></td>
                        <td><?php echo $row['npm']; ?></td>
                        <td><?php echo $row['judul_skripsi']; ?></td>
                        <td><?php echo $row['dosen_pembimbing']; ?></td>
                        <td><?php echo $row['kategori_ta']; ?></td>
                        <td><?php echo $row['tanggal_upload']; ?></td>
                        <td><?php echo $row['status_ta']; ?></td>
                        <td>
                            <a href="/up_ta/<?php echo $row['file_poster']; ?>" target="_blank"><?php echo $row['file_poster']; ?></a>
                        </td>
                        <td>
                            <a href="/up_ta/<?php echo $row['filepath']; ?>" target="_blank"><?php echo $row['filename']; ?></a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <form method="post" class="container">
                <div class="form-group mb-3">
                    <label for="status_ta">Status</label>
                    <select class="form-control" id="status_ta" name="status_ta">
                        <option value="diterima" <?php if($row['status_ta'] == 'diterima') echo 'selected'; ?>>Diterima</option>
                        <option value="ditolak" <?php if($row['status_ta'] == 'ditolak') echo 'selected'; ?>>Ditolak</option>
                        <option value="direview" <?php if($row['status_ta'] == 'direview') echo 'selected'; ?>>Direview</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Data</button>
                <a href="data_ta.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
