<?php
include '../koneksi.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan dari formulir
    $id = $_GET['id'];
    $toko = $_POST['toko'];
    $alamat = $_POST['alamat'];
    $tlp_hp = $_POST['tlp_hp'];

    // Lakukan validasi data yang diterima jika diperlukan

    // Jalankan kueri SQL untuk mengupdate data toko berdasarkan ID yang diterima
    $sql = "UPDATE toko SET nama_toko='$toko', alamat='$alamat', tlp_hp='$tlp_hp' WHERE toko_id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Jika proses update berhasil, redirect ke halaman lain atau tampilkan pesan sukses
        header("Location: ../toko.php");
        exit();
    } else {
        // Jika proses update gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($conn);
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM toko WHERE toko_id = '$id'";
$result1 = mysqli_query($conn, $sql);

// Periksa apakah hasil kueri berhasil
if (!$result1) {
    echo "Error: " . mysqli_error($conn);
} else {
    // Ambil data dari hasil kueri
    $data = mysqli_fetch_assoc($result1);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Toko</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Toko</h2>
        <form action="" method="post">          
            <input type="hidden" name="toko_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="toko">Toko:</label>
                <input type="text" class="form-control" id="toko" name="toko" value="<?php echo isset($data['nama_toko']) ? $data['nama_toko'] : ''; ?>" required>
            </div>
        
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo isset($data['alamat']) ? $data['alamat'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="tlp_hp">TLP HP:</label>
                <input type="number" class="form-control" id="tlp_hp" name="tlp_hp" value="<?php echo isset($data['tlp_hp']) ? $data['tlp_hp'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <!-- Bootstrap JS, jQuery, Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
