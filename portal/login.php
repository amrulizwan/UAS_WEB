<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .card {
        margin-left: 35%;
        margin-right: 35%;
        text-align: left;
    }

    .btn {
        width: 100%;
        margin-top: 10px;
        background-color: #4caf50;
        border-color: #4caf50;
        color: white;
    }

    .btn:hover {
        background-color: #4caf50;
        border-color: #4caf50;
        color: white;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Login</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" name="login" class="btn">Login</button>
                </form>

                <p class="mt-3">Belum punya akun? <a href="../pendaftaran/index.php">Daftar</a></p>
            </div>
        </div>
    </div>
</body>

</html>
<?php
session_start();
include('../setting.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM siswa WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //sha 1 decrypt
        if ($row['password'] === sha1($password)) {
            $_SESSION['user'] = $row['id'];
            header('Location: index.php');
        } else {
            echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Pengguna tidak terdaftar!'); window.location.href='login.php';</script>";

    }
}

$conn->close();
?>