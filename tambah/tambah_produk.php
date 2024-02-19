
<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$sql = "SELECT * FROM toko";
$result = mysqli_query($conn, $sql);
$sql = "SELECT * FROM produk_kategori";
$result1 = mysqli_query($conn, $sql);
// Include your database connection code or configuration file here
// Example: include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $toko_id = $_POST["toko_id"];
    $nama_produk = $_POST["nama_produk"];
    $kategori_id = $_POST["kategori_id"];
    $satuan = $_POST["satuan"];
    $harga_beli = $_POST["harga_beli"];
    $harga_jual = $_POST["harga_jual"];
    $create=date("Y-m-d H:i:s");

    // Validate and sanitize the data if needed

    // Include your database connection code here
    // Example: include 'db_connection.php';

    // Perform the database insertion
    try {
        // Replace the following lines with your actual database insertion logic
        $pdo = new PDO("mysql:host=localhost;dbname=db_kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO produk (produk_id, toko_id, nama_produk, kategori_id, satuan, harga_beli, harga_jual, created_at)
                VALUES (:produk_id, :toko_id, :nama_produk, :kategori_id, :satuan, :harga_beli, :harga_jual, :created_at)";

        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':produk_id', $produk_id);
        $stmt->bindParam(':toko_id', $toko_id);
        $stmt->bindParam(':nama_produk', $nama_produk);
        $stmt->bindParam(':kategori_id', $kategori_id);
        $stmt->bindParam(':satuan', $satuan);
        $stmt->bindParam(':harga_beli', $harga_beli);
        $stmt->bindParam(':harga_jual', $harga_jual);
        $stmt->bindParam(':created_at', $create);

        // Execute the statement
        $stmt->execute();

        // Redirect to a success page or display a success message
        header("Location: ../produk.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <table class="table table-bordered">
                        <tbody>
                            <tr><td>
                            <?php 
                                if($result){
                                    echo "<label for='toko'>Toko </label></td><td>:</td><td>";
                                    echo "<select  name='toko_id'>";

                                    while($row = mysqli_fetch_assoc($result)){
                                        $nama_toko = $row['nama_toko'];
                                        $id = $row['toko_id'];
                                        echo "<option value='$id'>$nama_toko </option>";
                                    }echo"</select>";
                                }else{
                                        echo"gagal mengambil data";
                                    } 
                            ?>
                               </td>
                            </tr>
                            <tr>
                                <td>Nama Produk</td>
                                <td>:</td>
                                <td><input type="text" name="nama_produk" class="form-control" placeholder="" required></td>
                            </tr>
                            <tr><td>
                            <?php 
                                if($result1){
                                    echo "<label for='produk_kategori'>kategori </label></td><td>:</td><td>";
                                    echo "<select  name='kategori_id'>";

                                    while($row = mysqli_fetch_assoc($result1)){
                                        $nama_kategori = $row['nama_kategori'];
                                        $id = $row['kategori_id'];
                                        echo "<option value='$id'>$nama_kategori </option>";
                                    }echo"</select>";
                                }else{
                                        echo"gagal mengambil data";
                                    }
                                
                            ?>
                               </td>
                            </tr>
                            <tr>
                                <td>Satuan</td>
                                <td>:</td>
                                <td><input type="text" name="satuan" class="form-control" placeholder="" required></td>
                            </tr>
                            <tr>
                                <td>Harga Beli</td>
                                <td>:</td>
                                <td><input type="text" name="harga_beli" class="form-control" placeholder="" required></td>
                            </tr>
                            <tr>
                                <td>Harga Jual</td>
                                <td>:</td>
                                <td><input type="text" name="harga_jual" class="form-control" placeholder="" required></td>
                            </tr>
                            <!-- <tr>
                                <td><input type="text" name="created_at" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly></td>
                            </tr> -->
                            <tr>
                                <td class="center">
                                    <button type="submit" class="btn btn-success">Tambah </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
