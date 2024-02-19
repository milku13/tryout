<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$sql = "SELECT * FROM toko";
$result = mysqli_query($conn, $sql);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $toko_id = $_POST["toko_id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $alamat = $_POST["alamat"];
    $access_level = $_POST["access_level"];
    $create = date("Y-m-d H:i:s");

    // Perform the database insertion
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=db_kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "INSERT INTO user(toko_id, username, password, email, nama_lengkap, alamat, access_level)
        VALUES (:toko_id, :username, :password, :email, :nama_lengkap, :alamat, :access_level)";
    
        $stmt = $pdo->prepare($sql);
    
        // Generate password hash (you may need to adjust this based on your password hashing method)
        $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    
        // Bind parameters
        $stmt->bindParam(':toko_id', $toko_id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nama_lengkap', $nama_lengkap);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':access_level', $access_level);
    
        // Execute the statement
        $stmt->execute();
    
        // Redirect to a success page or display a success message
        header("Location: ../user.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
                                    echo "Gagal mengambil data";
                                }
                            ?>
                            <tr>
                                <td>Username</td>
                                <td>:</td>
                                <td><input type="text" name="username" class="form-control" placeholder="" required></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>:</td>
                                <td><input type="password" name="password" class="form-control" placeholder="" required></td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><input type="text" name="email" class="form-control" placeholder=" " required></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><input type="text" name="nama_lengkap" class="form-control" placeholder="" required></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><input type="text" name="alamat" class="form-control" placeholder="" required></td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>:</td>
                                <td>
                                    <select name="access_level" id="access_level">
                                        <option value="Admin">Admin</option>
                                        <option value="Kasir">Kasir</option>
                                    </select>
                                </td>
                            </tr>
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
