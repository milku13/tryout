
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
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $toko_id = $_POST["toko_id"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $create=date("Y-m-d H:i:s");

    // Validate and sanitize the data if needed

    // Include your database connection code here
    // Example: include 'db_connection.php';

    // Perform the database insertion
    try {
        // Replace the following lines with your actual database insertion logic
        $pdo = new PDO("mysql:host=localhost;dbname=db_kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO pelanggan(pelanggan_id, toko_id, nama_pelanggan, alamat, no_hp, created_at)
        VALUES (:pelanggan_id, :toko_id, :nama_pelanggan, :alamat, :no_hp, :created_at)";

        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':pelanggan_id', $kategori_id);
        $stmt->bindParam(':toko_id', $toko_id);
        $stmt->bindParam(':nama_pelanggan', $nama_pelanggan);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':no_hp', $no_hp);
        $stmt->bindParam(':created_at', $create);
        
        // Execute the statement
        $stmt->execute();

        // Redirect to a success page or display a success message
        header("Location: ../pelanggan.php");
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
    <title>Tambah Kategori</title>
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

                            <tr>
                                <td>Nama pelanggan</td>
                                <td>:</td>
                                <td><input type="text" name="nama_pelanggan" class="form-control" placeholder="" required></td>
                            </tr>
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
                            <tr>
                                <td>alamat</td>
                                <td>:</td>
                                <td><input type="text" name="alamat" class="form-control" placeholder=" " required></td>
                            </tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td><input type="text" name="no_hp" class="form-control" placeholder="" required></td>
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
