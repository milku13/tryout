<?php
include '../koneksi.php';

session_start();

// Jika formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui formulir
    $user = isset ($_SESSION['user_id']);
    $nama_produk = $_POST['nama_produk'];
    $stok = $_POST['stok'];
    $harga_jual = $_POST['harga_jual'];
    $satuan = $_POST['satuan'];
    $id = $_GET['id']; // ID produk yang diedit

    // Buat SQL untuk melakukan pembaruan data
    $sql_update = "UPDATE produk SET nama_produk='$nama_produk', stok='$stok', harga_jual='$harga_jual', satuan='$satuan' WHERE produk_id='$id'";
    $resultupdate = mysqli_query($conn, $sql_update);
    // Eksekusi query pembaruan data
    if ($resultupdate) {
        //var_dump($conn);
        // Jika pembaruan berhasil, redirect pengguna ke halaman produk.php dengan menyertakan ID produk yang diperbarui
        header("location: ../produk.php?id=$id");
        exit;
    } else {
        // Jika terjadi kesalahan saat pembaruan data, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($conn);
    }
    
}

// Ambil ID barang dari URL
$id = $_GET['id'];

// Ambil data toko
$sql = "SELECT * FROM toko";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Gagal mengambil data toko: " . mysqli_error($conn));
}

// Ambil data kategori
$sql1 = "SELECT * FROM produk_kategori";
$result1 = mysqli_query($conn, $sql1);
if (!$result1) {
    die("Gagal mengambil data kategori: " . mysqli_error($conn));
}

// Ambil data produk berdasarkan ID yang diberikan
$sql2 = "SELECT * FROM produk WHERE produk_id='$id'";
$result2 = mysqli_query($conn, $sql2);
if (!$result2) {
    die("Gagal mengambil data produk: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Barang</h2>
        <form action="edit_barang.php?id=<?php echo $id; ?>" method="post">
            <?php
            $data = mysqli_fetch_assoc($result2);
            ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Menggunakan variabel $id -->
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $data['stok']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual:</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" required>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan:</label> <!-- Perbaikan nama ID -->
                <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $data['satuan']; ?>" required> <!-- Perbaikan nama kolom -->
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
