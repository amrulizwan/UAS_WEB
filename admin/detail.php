<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include('../setting.php');

$user_id = $_GET['id'];
$sql = "SELECT * FROM siswa WHERE id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $nama_lengkap = $row['nama_lengkap'];
    $jk = $row['jk'];
    $alamat = $row['alamat'];
    $asal_sekolah = $row['asal_sekolah'];
    $tempat_lahir = $row['tempat_lahir'];
    $tanggal_lahir = $row['tanggal_lahir'];
    $nama_ibu = $row['nama_ibu'];
    $nama_ayah = $row['nama_ayah'];
    $kk_filename = $row['kk_filename'];
    $foto_filename = $row['foto_filename'];
    $raport_filename = $row['raport_filename'];
} else {
    echo "User not found!";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
    img {
        max-width: 100%;
        max-height: 200px;
        height: auto;
        border-radius: 8px;
    }
    </style>
    <title>Portal - SMKN 3 SELONG</title>
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
    <div class="container mt-5">
        <div class="card mb-5">
            <div class="card-body ms-5">
                <h1 class="text-left mb-5">Biodata Pendaftar</h1>
                <div class="row">
                    <div class="col-md-2">
                        <img src="../uploads/<?php echo $foto_filename; ?>" alt="">
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-2">
                                <label for="nama_lengkap">Nama Lengkap </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $nama_lengkap; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="jk">Jenis Kelamin </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $jk; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="email">Email </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $email; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="alamat">Alamat </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $alamat; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="asal_sekolah">Asal Sekolah </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $asal_sekolah; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="tempat_lahir">Tempat Lahir </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $tempat_lahir; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="tanggal_lahir">Tanggal Lahir </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $tanggal_lahir; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="nama_ibu">Nama Ibu </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $nama_ibu; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="nama_ayah">Nama Ayah </label>
                            </div>:
                            <div class="col">
                                <p><?php echo $nama_ayah; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="kk">Kartu Keluarga </label>
                            </div>:
                            <div class="col">
                                <?php
                                if ($kk_filename === '' || $kk_filename === NULL) {
                                    echo '<p class="badge bg-danger">Belum Lengkap</p>';
                                } else {
                                    echo '<a href="../uploads/'.$kk_filename.'"><p class="badge bg-success">Lengkap</p></a>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="raport">Raport </label>
                            </div>:
                            <div class="col">
                                <?php
                                if ($raport_filename === '' || $raport_filename === NULL) {
                                    echo '<p class="badge bg-danger">Belum Lengkap</p>';
                                } else {
                                    echo '<a href="../uploads/'.$raport_filename.'"><p class="badge bg-success">Lengkap</p></a>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                                    <input type="submit" name="terima" class="btn btn-success" value="Terima">
                                    <input type="submit" name="tolak" class="btn btn-danger" value="Tolak">
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM pendaftaran WHERE siswa_id = $id";
    $result = $conn->query($sql);

    if($result->num_rows > 0 ) {
        if (isset($_POST['terima'])) {
            $sql = "UPDATE pendaftaran SET diterima = 1 WHERE siswa_id = $id";
            $result = $conn->query($sql);
            if ($result) {
                echo "<div class='alert alert-success' role='alert'> Pendaftar berhasil diterima </div>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else if (isset($_POST['tolak'])) {
            $sql = "UPDATE pendaftaran SET diterima = 0 WHERE siswa_id = $id";
            $result = $conn->query($sql);
            if ($result) {
                echo "<div class='alert alert-danger' role='alert'> Pendaftar berhasil ditolak </div>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        if (isset($_POST['terima'])) {
            $sql = "INSERT INTO pendaftaran (siswa_id, diterima) VALUES ($id, 1)";
            $result = $conn->query($sql);
            if ($result) {
                echo "<div class='alert alert-success' role='alert'> Pendaftar berhasil diterima </div>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else if (isset($_POST['tolak'])) {
            $sql = "INSERT INTO pendaftaran (siswa_id, diterima) VALUES ($id, 0)";
            $result = $conn->query($sql);
            if ($result) {
                echo "<div class='alert alert-danger' role='alert'> Pendaftar berhasil ditolak </div>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
$conn->close();
?>