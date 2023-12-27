<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Calon Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
    body {
        background-color: #e0f7fa;
    }

    .card {
        margin-left: 25%;
        margin-right: 25%;
        text-align: left;
    }

    .btn-primary {
        background-color: #4caf50;
        border-color: #4caf50;
    }

    img {
        max-width: 100%;
        height: auto;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Pendaftaran Akun</h1>
        <div class="card mt-5">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" name="register" class="btn btn-primary">Daftar</button>
                </form>

                <p class="mt-3">Sudah punya akun? <a href="../portal/login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include('../setting.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $sql = "INSERT INTO siswa (nama_lengkap, email, password) VALUES ('$nama_lengkap', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>