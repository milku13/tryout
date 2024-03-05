<?php
include '../koneksi.php';

session_start();

$id = $_GET['id']; // Ambil ID barang dari URL

$sql = "SELECT * FROM suplier WHERE suplier_id = '$id'";
$result = mysqli_query($conn,$sql);

$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui formulir
    $suplier_id = $_POST['suplier_id'];   
    $nama_suplier = $_POST['nama_suplier'];   
    $alamat = $_POST['alamat'];   
    $no_hp = $_POST['no_hp'];   

    // Buat SQL untuk melakukan pembaruan data
    $sql_update = "UPDATE suplier SET nama_suplier='$nama_suplier', alamat_suplier='$alamat', tlp_hp='$no_hp' WHERE suplier_id='$suplier_id'";
    $resultupdate = mysqli_query($conn, $sql_update);

    // Eksekusi query pembaruan data
    if ($resultupdate) {
        // Jika pembaruan berhasil, redirect pengguna ke halaman supplier.php dengan menyertakan ID supplier yang diperbarui
        header("location: ../supplier.php?id=$suplier_id");
        exit;
    } else {
        // Jika terjadi kesalahan saat pembaruan data, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Supllier</h2>
        <form action="" method="post">
            <input type="hidden" name="suplier_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nama_suplier">Nama Suplier:</label>
                <input type="text" class="form-control" id="nama_suplier" name="nama_suplier" value="<?php echo $data['nama_suplier']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat_suplier']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_hp">NO HP:</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?php echo $data['tlp_hp']; ?>" required>
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
