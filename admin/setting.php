<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include('../setting.php');
$sql = "SELECT status FROM setting WHERE id = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$status = $row['status'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    if ($status == '0') {
        $new_status = '1';
    } else {
        $new_status = '0';
    }
    $sql = "UPDATE setting SET status = $new_status WHERE id = 1";
    $conn->query($sql);
    header("Location: setting.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Setting Page</title>
    <style>
    .button {
        width: 100px;
        height: 50px;
        border-radius: 5px;
        font-size: 18px;
        color: #fff;
        cursor: pointer;
    }

    .button-red {
        background-color: red;
    }

    .button-green {
        background-color: green;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">SMKN 3 SELONG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="setting.php">Pengumuman</a>
                    </li>
                    <li>
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form class="mt-5" method="post">
        <center>
            <button class="button <?php echo $status == '0' ? 'button-red' : 'button-green'; ?>" name="change_status">
                <?php echo $status == '0' ? 'Aktifkan' : 'Non-Aktifkan'; ?>
            </button>
        </center>
    </form>
</body>

</html>