<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Penelitian Ilmiah</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
    }

    .navbar {
        background-color: #ffffff; /* White */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
        height: 50px;
        margin-right: 10px;
    }

    .navbar-brand span {
        font-size: 24px;
        font-weight: bold;
        color: #000000; /* Black text for contrast */
    }

    .sidebar {
        background-color: #5f2c82; /* Purple */
        color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        padding: 10px;
        display: block;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #4a1f6b;
    }

    .container h2 {
        color: #5f2c82; /* Purple */
    }

    .btn-primary {
        background-color: #5f2c82;
        border: none;
    }

    .btn-primary:hover {
        background-color: #4a1f6b;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #fff;
    }

    .thead-dark {
        background-color: #5f2c82;
        color: white;
    }

    .fade-in {
        animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
</style>
</head>
<body>
    <!-- Header with Logo and Title -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/id/1/19/Logo_Gunadarma.jpg" alt="Gunadarma University Logo">
                <span>Repository Universitas Gunadarma</span>
            </a>
        </div>
    </nav>

    <div class="container-fluid mt-5 fade-in">
        <div class="row">
            <!-- Sidebar Menu -->
            <?php include('sidebar.php'); ?>
            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="container">
                    <h2 class="text-center my-4">Directory Penelitian Ilmiah</h2>
                    <p class="text-center">JURUSAN : SISTEM INFORMASI</p>
                    <!-- Form Pencarian -->
                    <form method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Judul, Kategori, atau Dosen Pembimbing" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>TINGKAT</th>
                                    <th>ANGKATAN</th>
                                    <th>Judul Penelitian Ilmiah</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Upload</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Membuat koneksi ke database
                                $conn = new mysqli("localhost", "root", "", "repository_ug2024");

                                // Memeriksa koneksi
                                if ($conn->connect_error) {
                                    die("Koneksi gagal: " . $conn->connect_error);
                                }

                                // Mendapatkan input pencarian
                                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

                                // Query dasar
                                $sql = "SELECT * FROM repository_pi2024 WHERE status_pi='diterima'";

                                // Tambahkan kondisi pencarian jika ada input search
                                if (!empty($search)) {
                                    $sql .= " AND (
                                        judul_penelitian LIKE '%$search%' OR 
                                        kategori_pi LIKE '%$search%' OR 
                                        dosen_pembimbing LIKE '%$search%' OR
                                        nama_mahasiswa LIKE '%$search%' OR
                                        npm LIKE '%$search%'
                                    )";
                                }

                                // Tambahkan pengurutan
                                $sql .= " ORDER BY tanggal_upload DESC";

                                $result = $conn->query($sql);

                                // Menampilkan data
                                if ($result && $result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nama_mahasiswa']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['npm']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['tingkat']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['angkatan']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['judul_penelitian']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['dosen_pembimbing']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['kategori_pi']) . "</td>";
                                        echo "<td>" . date('d-m-Y', strtotime($row['tanggal_upload'])) . "</td>";
                                        echo "<td><a href='admin/" . htmlspecialchars($row['filepath']) . "' class='btn btn-sm btn-primary' target='_blank'>
                                                <i class='fas fa-download'></i> Download
                                              </a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='10' class='text-center'>Tidak ada data penelitian ilmiah yang ditemukan.</td></tr>";
                                }

                                // Menutup koneksi
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
