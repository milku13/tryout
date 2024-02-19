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
    $nama_toko = $_POST["nama_toko"];
    $alamat = $_POST["alamat"];
    $tlp_hp = $_POST["tlp_hp"];
    $create = date("Y-m-d H:i:s");

    // Validate and sanitize the data if needed

    // Include your database connection code here
    // Example: include 'db_connection.php';

    // Perform the database insertion
    try {
        // Replace the following lines with your actual database insertion logic
        $pdo = new PDO("mysql:host=localhost;dbname=db_kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO toko(nama_toko, alamat, tlp_hp, created_at)
        VALUES (:nama_toko, :alamat, :tlp_hp, :created_at)";

        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':nama_toko', $nama_toko);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':tlp_hp', $tlp_hp);
        $stmt->bindParam(':created_at', $create);

        // Execute the statement
        $stmt->execute();

        // Redirect to a success page or display a success message
        header("Location:../toko.php");
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
    <title>Buat Toko Anda</title>
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
                                <td>Nama Toko</td>
                                <td>:</td>
                                <td><input type="text" name="nama_toko" class="form-control" placeholder=" " required></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><input type="text" name="alamat" class="form-control" placeholder="" required></td>
                            </tr>
                            <tr>
                                <td>Tlp HP</td>
                                <td>:</td>
                                <td><input type="text" name="tlp_hp" class="form-control" placeholder="" required></td>
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
