<?php
include '../koneksi.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui formulir
    $nama_kategori = $_POST['nama_kategori'];   
    $id = $_POST['id']; // ID kategori yang diedit

    // Buat SQL untuk melakukan pembaruan data
    $sql_update = "UPDATE produk_kategori SET nama_kategori='$nama_kategori' WHERE kategori_id='$id'";
    $resultupdate = mysqli_query($conn, $sql_update);

    // Eksekusi query pembaruan data
    if ($resultupdate) {
        // Jika pembaruan berhasil, redirect pengguna ke halaman kategori.php dengan menyertakan ID kategori yang diperbarui
        header("location: ../kategori.php?id=$id");
        exit;
    } else {
        // Jika terjadi kesalahan saat pembaruan data, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($conn);
    }
}

$id = $_GET['id']; // Ambil ID kategori dari URL

$sql = "SELECT * FROM produk_kategori WHERE kategori_id = '$id'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    echo "Data kategori tidak ditemukan.";
    exit; // Keluar dari skrip jika data tidak ditemukan
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kategori</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Kategori</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori:</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo isset($data['nama_kategori']) ? $data['nama_kategori'] : ''; ?>" required>
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
