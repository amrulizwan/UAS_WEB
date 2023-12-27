<?php
            include('../setting.php');
            session_start();
            if (!isset($_SESSION['user'])) {
                header("Location: login.php");
                exit();
            }
            $user_id = $_SESSION['user'];
            $query = "SELECT * FROM setting";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);
            if ($data['status'] == 0) {
                echo "<script>alert('Pendaftaran belum dibuka!'); window.location.href='index.php';</script>";
                exit();
            } else {
            $query = "SELECT diterima FROM pendaftaran WHERE siswa_id = $user_id";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .notification {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    .green-text {
        color: #008000;
    }

    .red-text {
        color: #ff0000;
    }
    </style>
</head>

<body
    <?php if($data['diterima'] == 1){ echo 'style="background-color: green"';}else{ echo 'style="background-color: red"';} ?>>
    <div class="notification">

        <?php
        $query = "SELECT diterima FROM pendaftaran WHERE siswa_id = $user_id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        $diterima = $row['diterima'];

        if ($diterima == 1) {
        echo "<p class='green-text'>Selamat kamu diterima!</p>";
        } else {
        echo "<p class='red-text'>Maaf, kamu tidak diterima.</p>";
        }
        }
    }

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>