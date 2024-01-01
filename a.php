<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Peminjaman Buku</title>
    <!-- Menggunakan Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <?php
include("../setting.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pengguna_id = $_POST['pengguna_id'];
    $buku_id = $_POST['buku_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $catatan = $_POST['catatan'];

    $query = "INSERT INTO peminjaman (pengguna_id, buku_id, tanggal_peminjaman, tanggal_pengembalian, catatan) VALUES ('$pengguna_id', '$buku_id', '$tanggal_peminjaman', '$tanggal_pengembalian', '$catatan')";

    // Pastikan koneksi sudah terbentuk
    if (!$link) {
        die('Koneksi database gagal: ' . mysqli_error($link));
    }

    
}

// Query untuk mendapatkan data pengguna
$queryPengguna = "SELECT id, nama_lengkap FROM pengguna";
$resultPengguna = mysqli_query($link, $queryPengguna);

// Periksa apakah query pengguna berhasil
if (!$resultPengguna) {
    die('Error: ' . mysqli_error($link));
}
?>

    <div class="container mt-5">
        <h2 class="mb-4">Tambah Data Peminjaman Buku</h2>

        <form method="post" action="">
            <div class="form-group">
                <label for="pengguna_id">Nama Peminjam:</label>
                <select class="form-control" name="pengguna_id" required>
                    <?php
                // Pastikan ada data pengguna
                if (mysqli_num_rows($resultPengguna) > 0) {
                    while ($rowPengguna = mysqli_fetch_assoc($resultPengguna)) {
                        echo '<option value="' . $rowPengguna['id'] . '">' . $rowPengguna['nama_lengkap'] . '</option>';
                    }
                } else {
                    echo '<option value="" disabled>No users available</option>';
                }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="buku_id">Judul Buku:</label>
                <!-- Tambahkan query untuk mendapatkan data buku di sini -->
                <?php
            $queryBuku = "SELECT id, judul FROM daftarbuku";
            $resultBuku = mysqli_query($link, $queryBuku);
            ?>

                <?php
            // Periksa apakah query buku berhasil
            if ($resultBuku) {
                echo '<select class="form-control" name="buku_id" required>';
                // Pastikan ada data buku
                if (mysqli_num_rows($resultBuku) > 0) {
                    while ($rowBuku = mysqli_fetch_assoc($resultBuku)) {
                        echo '<option value="' . $rowBuku['id'] . '">' . $rowBuku['judul'] . '</option>';
                    }
                } else {
                    echo '<option value="" disabled>No books available</option>';
                }
                echo '</select>';
            } else {
                die('Error: ' . mysqli_error($link));
            }
            ?>
            </div>
            <div class="form-group">
                <label for="tanggal_peminjaman">Tanggal Peminjaman:</label>
                <input type="date" class="form-control" name="tanggal_peminjaman" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pengembalian">Tanggal Pengembalian:</label>
                <input type="date" class="form-control" name="tanggal_pengembalian" required>
            </div>
            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea class="form-control" name="catatan"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>

        <a href="read.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>

    <!-- Menggunakan Bootstrap JS dan Popper.js (diperlukan oleh Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>