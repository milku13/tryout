<?php


include '../koneksi.php';
$sql="SELECT * FROM suplier";
$result=mysqli_query($conn,$sql);
$result1=mysqli_query($conn,$sql);
$sql="SELECT * FROM produk";
$result2 = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-user"></i>
                </div>
                <div class="sidebar-brand-text mx-3 ">ADMIN <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <div class="text-center" >
                <a class="nav-link" href="../dashboard.php">
                    <span class="dashboard" style="font-size: 20px; color: white; font-weight: bold;">Dashboard</span>
                </a>
            </div>
            <hr class="sidebar-divider my-1">

            <!-- Nav Item - Pages Collapse Menu -->
            <div id="collapseTwo" class="text-center" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-blue py-1 collapse-inner rounded">
                    <p style="display: block;"><a class="collapse-item" href="../produk.php" style="color: white; font-weight: bold; font-size: 20px;">Barang</a></p>
                    <hr class="sidebar-divider">
                    <p style="display: block;"><a class="collapse-item"  href="../kategori.php" style="color: white; font-weight: bold; font-size: 20px;">Kategori</a></p>
                    <hr class="sidebar-divider">
                    <p style="display: block;"><a class="collapse-item" href="../toko.php" style="color: white; font-weight: bold; font-size: 20px;">Toko</a></p>
                    <hr class="sidebar-divider">
                    <p style="display: block;"><a class="collapse-item" href="../pelanggan.php" style="color: white; font-weight: bold; font-size: 20px;">Pelanggan</a></p>
                    <hr class="sidebar-divider">
                    <p style="display: block;"><a class="collapse-item" href="../supplier.php" style="color: white; font-weight: bold; font-size: 20px;">Suplier</a></p>                
                    <hr class="sidebar-divider">              
                </div>
            </div>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item text-center">
                <a class="nav-link collapsed text-center" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-file"></i>
                    <span>TRANSAKSI</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaksi</h6>
                        <a class="collapse-item" href="penjualan_detail.php" style="font-weight: bold; font-size: 15px;">Penjualan</a>
                        <a class="collapse-item" href="pembelian.php" style="font-weight: bold; font-size: 15px;">Pembelian</a>
                        <a class="collapse-item" href="pembelian_detail.php" style="font-weight: bold; font-size: 15px;">DETAIL PEMBELIAN</a>
                    </div>
                </div>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link collapsed text-center" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>DATA USER</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">USER</h6>
                        <a class="collapse-item" href="../user.php" style="font-weight: bold; font-size: 15px;">Data User</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <i class="fas fa-user"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>
    <!-- Add your CSS link or styles here -->
    <style>
        /* Add your styles here */
    </style>
</head>

<body>    
    <div class="container">
    <h2 class="text-center">Pembelian</h2>

        <!-- Add a form for adding a new purchase -->
        <form action="../tambah/proses_tambah_pembelian.php" method="post">
            <!-- Include necessary input fields -->
            <label for="no_faktur">No. Faktur:</label>
            <input type="text" id="no_faktur" name="no_faktur" required readonly>

            <label for="tanggal_pembelian">Tanggal Pembelian:</label>
            <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" required>
    
            <label for="suplier">Suplier:</label>
            <select class="form-control mb-2" id="suplier" name="suplier_id" required>
                <?php 
                    if($result){
                        while($row = mysqli_fetch_assoc($result)){
                            $nama_suplier = $row['nama_suplier'];
                            $id = $row['suplier_id'];
                            echo "<option value='$id'>$nama_suplier</option>";
                        }
                    } else {
                        echo "<option value='' disabled selected>Gagal mengambil data</option>";
                    }
                ?>
            </select>
            
            <label for="produk">Barang:</label>
            <select class="form-control mb-2" id="produk" name="produk_id" required onchange="updateTotal()">
                <?php 
                    while($row = mysqli_fetch_assoc($result2)){
                        $nama_barang = $row['nama_produk'];
                        $id = $row['produk_id'];
                        $harga = $row['harga_jual'];
                        echo "<option value='$id'>$nama_barang - $harga</option>";
                    }
                ?>
            </select>
                      
            <label for="quantity">Kuantitas:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>

            <label for="total">Total:</label>
            <input type="text" id="total" name="total" required readonly>

            <label for="bayar">Bayar:</label>
            <input type="text" id="bayar" name="bayar" required>

            <label for="sisa">Sisa:</label>
            <input type="text" id="sisa" name="sisa" required readonly>

            <label for="stok">Stok:</label>
            <input type="text" id="stok" name="stok" required>

            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan"></textarea>       

            <button type="submit">Tambah Pembelian</button>
        </form>
        </table>
    </div>

    <div class="container ">        
    <table class="table table-bordered table-sm ">
            <!-- Include a table to display existing purchases -->
            <thead>
                <tr class="text-center">
                    <th>No. Faktur</th>
                    <th>Tanggal Pembelian</th>
                    <th>Supplier ID</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Sisa</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to your database and fetch data to display in the table
                // Use a PDO connection or any database connection method you prefer
                try {
                    $pdo = new PDO("mysql:host=localhost;dbname=db_kasir", "root", "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $pdo->prepare("SELECT * FROM pembelian");
                    $stmt->execute();
                    $pembelianData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($pembelianData as $pembelian) {
                        echo "<tr>";
                        echo "<td>{$pembelian['no_faktur']}</td>";
                        echo "<td>{$pembelian['tanggal_pembelian']}</td>";
                        echo "<td>{$pembelian['suplier_id']}</td>";
                        echo "<td>{$pembelian['total']}</td>";
                        echo "<td>{$pembelian['bayar']}</td>";
                        echo "<td>{$pembelian['sisa']}</td>";
                        echo "<td>{$pembelian['stok']}</td>"; // Ini akan menampilkan nilai stok dari database
                        echo "<td>{$pembelian['keterangan']}</td>";
                        echo "<td>{$pembelian['created_at']}</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                // Close the database connection
                $pdo = null;
                ?>
            </tbody>
    </div>

    <!-- Add your JavaScript code here -->
    <script>
         document.addEventListener('DOMContentLoaded', function () {
            // Menghasilkan No. Faktur yang unik
            var uniqueNoFaktur = 'F' + Date.now();
            document.getElementById('no_faktur').value = uniqueNoFaktur;

            // Mengatur tanggal hari ini sebagai default untuk Tanggal Pembelian
            var tanggal_pembelian = document.getElementById('tanggal_pembelian');
            tanggal_pembelian.value = getTodayDate();

            // Menambahkan event listener untuk input Bayar
            document.getElementById('bayar').addEventListener('input', function () {
                var total = parseFloat(document.getElementById('total').value);
                var bayar = parseFloat(document.getElementById('bayar').value);
                var sisa = total - bayar;
                document.getElementById('sisa').value = sisa.toFixed(2); // Batasi menjadi dua tempat desimal
            });
        });

        // Fungsi untuk mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        function getTodayDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Januari adalah 0!
            var yyyy = today.getFullYear();
            return yyyy + '-' + mm + '-' + dd;
        }

        // Fungsi untuk memperbarui total berdasarkan produk yang dipilih dan kuantitasnya
        function updateTotal() {
            var selectedOption = document.getElementById("produk").options[document.getElementById("produk").selectedIndex];
            var harga = parseFloat(selectedOption.textContent.split(' - ')[1]);
            var quantity = document.getElementById("quantity").value;
            if (quantity > 1) {
                harga *= quantity;
            }
            document.getElementById("total").value = harga; // Batasi menjadi dua tempat desimal
        }
    
    </script>
</body>

</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>

    <!-- Add your CSS link or include styles here -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fc;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <!-- Rest of your HTML content -->
</body>

</html>


                        <!-- Earnings (Monthly) Card Example -->
                        
                       

                        <!-- Pending Requests Card Example -->
                     

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Jika logout anda harus login kembali!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="../sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../sbadmin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../sbadmin/js/demo/chart-area-demo.js"></script>
    <script src="../sbadmin/js/demo/chart-pie-demo.js"></script>

</body>

</html>
    <!-- Custom styles for this template-->
    <link href="sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
</head>