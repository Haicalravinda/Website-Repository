<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gunadarma Repository Information System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .card {
      border: none;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }
    .card:hover {
      transform: translateY(-10px);
    }
    .card img {
      border-top-left-radius: 0.25rem;
      border-bottom-left-radius: 0.25rem;
      animation: fadeIn 1s ease-in-out;
    }
    .card-body {
      padding: 2rem;
      opacity: 0;
      animation: fadeInUp 1s ease-out forwards;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #007bff;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
      transform: translateY(-3px);
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
      transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }
    .input-group-text {
      background-color: #e9ecef;
      border: 1px solid #ced4da;
    }

    /* Animations */
    @keyframes fadeIn {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="row g-0">
        <div class="col-md-6">
          <img src="https://storage.googleapis.com/a1aa/image/pNCLMBWSEoqwNRixE6iKuTCOXmpDsvhZrmhXOPpfu5zdFc0JA.jpg" alt="Image of Gunadarma University building" class="img-fluid" height="400" />
        </div>
        <div class="col-md-6">
          <div class="card-body text-center">
            <div class="mb-4">
              <img src="https://storage.googleapis.com/a1aa/image/RHwibB4VLpLKAp3pHyDCqQhzu2fyo6gSffvHFsu0s2enrgjOB.jpg" alt="Gunadarma University Logo" height="100" width="200"/>
            </div>
            <h5 class="card-title mb-3">REPOSITORY</h5>
            <p class="card-text mb-4">Gunadarma Repository Information System</p>
            <div class="d-grid gap-2">
              <a href="mahasiswa_dashboard/login.php" class="btn btn-primary">Login sebagai Mahasiswa</a>
              <a href="dosen_dashboard/login.php" class="btn btn-primary">Login sebagai Dosen</a>
              <a href="index.php" class="btn btn-secondary">Back to Website</a>
            </div>
            <p class="text-center mt-4 mb-0">&copy; 2007 - 2024. Universitas Gunadarma</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
