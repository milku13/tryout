<?php
include '../koneksi.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui formulir
    $user_id = $_POST['user_id'];   
    $toko_id = $_POST['toko_id'];   
    $username = $_POST['username'];   
    $email = $_POST['email'];   
    $nama_lengkap = $_POST['nama_lengkap'];   
    $alamat = $_POST['alamat'];   
    $access_level = $_POST['access_level'];   

    // Buat SQL untuk melakukan pembaruan data
    $sql_update = "UPDATE user SET toko_id='$toko_id', username='$username', email='$email', nama_lengkap='$nama_lengkap', alamat='$alamat', access_level='$access_level' WHERE user_id='$user_id'";
    $resultupdate = mysqli_query($conn, $sql_update);

    // Eksekusi query pembaruan data
    if ($resultupdate) {
        // Jika pembaruan berhasil, redirect pengguna ke halaman yang sesuai
        // Misalnya, kembali ke halaman daftar pengguna
        header("location: ../user.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat pembaruan data, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($conn);
    }
}

$id = $_GET['id']; // Ambil ID pengguna dari URL

$sql = "SELECT * FROM toko";
$result = mysqli_query($conn,$sql);

$sql1 = "SELECT * FROM produk_kategori";
$result1 = mysqli_query($conn,$sql1);

$sql2 = "SELECT * FROM user WHERE user_id='$id'";
$result2 = mysqli_query($conn,$sql2);
$result2 = mysqli_fetch_assoc($result2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Pengguna</h2>
        <?php
        // Ambil data pengguna dari database (misalnya)
        $id_pengguna = $_GET['id']; // Ambil ID pengguna dari URL
        
        // Lakukan koneksi ke database dan ambil data pengguna dengan ID tertentu
        ?>
        <form action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo $id_pengguna; ?>">
            <?php
            if ($result) {
                echo "<label for='toko'>Toko :</label>";
                echo "<select class='form-control' name='toko_id' required>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $nama_toko = $row['nama_toko'];
                    $toko_id = $row['toko_id'];
                    echo "<option value='$toko_id'>$nama_toko</option>";
                }

                echo "</select>";
            } else {
                echo "Gagal mengambil data";
            }
            ?>

            <?php if($result2) { ?>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $result2["username"]; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $result2["email"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap:</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $result2["nama_lengkap"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $result2["alamat"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="access_level">Role:</label>
                    <select name="access_level" class="form-control" required>
                        <option value="kasir" <?php if($result2["access_level"] == "kasir") echo "selected"; ?>>Kasir</option>
                        <option value="admin" <?php if($result2["access_level"] == "admin") echo "selected"; ?>>Admin</option>
                    </select>
                </div>
            <?php }?>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <!-- Bootstrap JS, jQuery, Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
