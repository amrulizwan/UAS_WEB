<?php
session_start();
include('../setting.php');


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user'];
$sql = "SELECT * FROM siswa WHERE id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_details'])) {

    $nama_lengkap = $_POST['nama_lengkap'];
    $jk = $_POST['jk'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nama_ibu = $_POST['nama_ibu'];
    $nama_ayah = $_POST['nama_ayah'];
    $foto_filename = $_FILES['foto_file']['name'];
    $raport_filename = $_FILES['raport_file']['name'];
    $kk_filename = $_FILES['kk_file']['name'];

    function fileName($originalFilename) {
        $random = rand(10000, 99999);
        return $random . '_' . $originalFilename;
    }

    $kk_filename = fileName($_FILES['kk_file']['name']);
    $kk_temp = $_FILES['kk_file']['tmp_name'];
    move_uploaded_file($kk_temp, "../uploads/$kk_filename");

    $foto_filename = fileName($_FILES['foto_file']['name']);
    $foto_temp = $_FILES['foto_file']['tmp_name'];
    move_uploaded_file($foto_temp, "../uploads/$foto_filename");

    $raport_filename = fileName($_FILES['raport_file']['name']);
    $raport_temp = $_FILES['raport_file']['tmp_name'];
    move_uploaded_file($raport_temp, "../uploads/$raport_filename");

    $update_sql = "
        UPDATE siswa SET
        nama_lengkap = '$nama_lengkap',
        jk = '$jk',
        email = '$email',
        alamat = '$alamat',
        asal_sekolah = '$asal_sekolah',
        tempat_lahir = '$tempat_lahir',
        tanggal_lahir = '$tanggal_lahir',
        nama_ibu = '$nama_ibu',
        nama_ayah = '$nama_ayah',
        kk_filename = '$kk_filename',
        foto_filename = '$foto_filename',
        raport_filename = '$raport_filename'
        WHERE id = $user_id";
    
    if ($conn->query($update_sql) === TRUE) {
        unlink("../uploads/" . $row['kk_filename']);
        unlink("../uploads/" . $row['foto_filename']);
        unlink("../uploads/" . $row['raport_filename']);
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
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
    <title>Lengkapi Detail Pendaftar</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Biodata Pendaftar</h1>

        <div class="card mb-5">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-2">
                            <label for="nama_lengkap">Nama Lengkap </label>
                        </div>:
                        <div class="col">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                value="<?php echo $row['nama_lengkap']; ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label for="jk">Jenis Kelamin </label>
                        </div>:
                        <div class="col">
                            <select class="form-select" aria-label="Default select example" id="jk" name="jk">
                                <option value="L" <?php if ($row['jk'] === 'L') echo 'selected'; ?>>Laki-laki</option>
                                <option value="P" <?php if ($row['jk'] === 'P') echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label for="email">Email </label>
                        </div>:
                        <div class="col">
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo $row['email']; ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label for="alamat">Alamat </label>
                        </div>:
                        <div class="col">
                            <textarea class="form-control" id="alamat" name="alamat"
                                rows="3"><?php echo $row['alamat']; ?></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label for="asal_sekolah">Asal Sekolah </label>
                        </div>:
                        <div class="col">
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah"
                                value="<?php echo $row['asal_sekolah']; ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label for="tempat_lahir">Tempat & Tanggal Lahir </label>
                        </div>:
                        <div class="col">
                            <div class="row">
                                <div class="col-3"><input type="text" class="form-control" id="tempat_lahir"
                                        name="tempat_lahir" value="<?php echo $row['tempat_lahir']; ?>"
                                        placeholder="Tempat Lahir"></div>
                                <div class="col">
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="<?php echo $row['tanggal_lahir']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label for="nama_ibu">Nama Ibu </label>
                        </div>:
                        <div class="col">
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                value="<?php echo $row['nama_ibu']; ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label for="nama_ayah">Nama Ayah </label>
                        </div>:
                        <div class="col">
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                value="<?php echo $row['nama_ayah']; ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label>KK </label>
                        </div>:
                        <div class="col">
                            <input type="file" class="form-control" id="kk_file" name="kk_file">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label>Foto </label>
                        </div>:
                        <div class="col">
                            <input type="file" class="form-control" id="foto_file" name="foto_file">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <label>Raport </label>
                        </div>:
                        <div class="col">
                            <input type="file" class="form-control" id="raport_file" name="raport_file">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" name="submit_details" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>