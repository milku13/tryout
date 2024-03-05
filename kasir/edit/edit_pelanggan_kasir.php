<?php
include '../../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui formulir
    $id = $_POST['id']; // ID pelanggan yang diedit
    $nama_pelanggan = $_POST['nama_pelanggan'];   
    $alamat = $_POST['alamat'];   
    $no_hp = $_POST['no_hp'];   

    // Buat SQL untuk melakukan pembaruan data
    $sql_update = "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', alamat='$alamat', no_hp='$no_hp' WHERE pelanggan_id='$id'";
    $resultupdate = mysqli_query($conn, $sql_update);

    // Eksekusi query pembaruan data
    if ($resultupdate) {
        // Jika pembaruan berhasil, redirect pengguna ke halaman pelanggan.php dengan menyertakan ID pelanggan yang diperbarui
        header("location: ../pelanggan.php?id=$id");
        exit;
    } else {
        // Jika terjadi kesalahan saat pembaruan data, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($conn);
    }
}

$id = $_GET['id']; // Ambil ID pelanggan dari URL

$sql = "SELECT * FROM pelanggan WHERE pelanggan_id = '$id'";
$result = mysqli_query($conn,$sql);
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
        <h2 class="text-center">Edit Data Pelanggan</h2>
        <?php
        // Ambil data pelanggan dari database
        
        ?>
        <form action="" method="post">
            
        <?php
        $data = mysqli_fetch_assoc($result);
        ?>
             <input type="hidden" name="id" value="<?= $_GET["id"]?>">
            <input type="hidden" name="pelanggan_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan:</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $data['nama_pelanggan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_hp">NO HP:</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?php echo $data['no_hp']; ?>" required>
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
