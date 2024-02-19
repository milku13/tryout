<?php
include '../koneksi.php';
$sql = "SELECT * FROM toko";
$result = mysqli_query($conn, $sql);
$sql = "SELECT * FROM user";
$result1 = mysqli_query($conn, $sql);
$sql = "SELECT * FROM pelanggan";
$result2 = mysqli_query($conn, $sql);
$sql = "SELECT * FROM produk";
$result3 = mysqli_query($conn, $sql);
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $toko_id = $_POST["toko_id"];
    $user_id = $_POST["user_id"];
    $pelanggan_id = $_POST["pelanggan_id"];
    $total = $_POST["total"];
    $bayar = $_POST["bayar"];
    $sisa = $_POST["sisa"];
    $keterangan = $_POST["keterangan"];
    $create = date("Y-m-d H:i:s");
    $tanggal_penjualan = date("Y-m-d H:i:s");

    // Retrieve selected product IDs
    if(isset($_POST['produk_id'])) {
        foreach($_POST['produk_id'] as $produk_id) {
            // Ambil harga beli dari produk yang dipilih
            $harga_beli = $_POST["harga_beli_$produk_id"];
            // Lakukan apa yang perlu dilakukan dengan harga beli (simpan di database, dll)
        }
    }

    // Simpan data ke database menggunakan PDO
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=db_kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Begin a transaction
        $pdo->beginTransaction();

        // Masukkan data penjualan ke tabel penjualan
        $sql = "INSERT INTO penjualan (toko_id, user_id, tanggal_penjualan, pelanggan_id, total, bayar, sisa, keterangan, created_at)
                VALUES (:toko_id, :user_id, :tanggal_penjualan, :pelanggan_id, :total, :bayar, :sisa, :keterangan, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':toko_id' => $toko_id,
            ':user_id' => $user_id,
            ':tanggal_penjualan' => $tanggal_penjualan,
            ':pelanggan_id' => $pelanggan_id,
            ':total' => $total,
            ':bayar' => $bayar,
            ':sisa' => $sisa,
            ':keterangan' => $keterangan,
            ':created_at' => $create
        ));

        // Ambil penjualan_id dari baris yang dimasukkan
        $penjualan_id = $pdo->lastInsertId();

        // Masukkan data ke tabel penjualan_detail
        if(isset($_POST['produk_id'])) {
            foreach($_POST['produk_id'] as $produk_id) {
                // Ambil harga beli dari produk yang dipilih
                $harga_beli = $_POST["harga_beli_$produk_id"];
                
                // Ambil jumlah dari input jumlah yang sesuai dengan produk saat ini
                $jumlah = $_POST["jumlah_$produk_id"];
                
                // Ambil total harga dari input total
                $total_harga = $_POST["total"];
                
                // Simpan ke tabel penjualan_detail
                $sql = "INSERT INTO penjualan_detail (penjualan_id, produk_id, qty, harga_beli, harga_jual, created_at)
                        VALUES (:penjualan_id, :produk_id, :qty, :harga_beli, :harga_jual, :created_at)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':penjualan_id' => $penjualan_id,
                    ':produk_id' => $produk_id,
                    ':qty' => $jumlah,
                    ':harga_beli' => $harga_beli,
                    ':harga_jual' => $total_harga,
                    ':created_at' => $create
                ));
            }
        }        
        // Commit transaksi
        $pdo->commit();

        // Redirect ke halaman sukses atau tampilkan pesan sukses
        header("Location: penjualan_detail.php");
        exit();
    } catch (PDOException $e) {
        // Rollback transaksi jika terjadi kesalahan
        $pdo->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Tutup koneksi database
    $pdo = null;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KASIR</title>

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
                <i class="fas fa-cash-register"></i>
                </div>
                <div class="sidebar-brand-text mx-3">KASIR <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <div class="text-center" >
                <a class="nav-link" href="../dashboard.php">
                    <span class="../dashboard" style="font-size: 20px; color: white; font-weight: bold;">Dashboard</span>
                </a>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <div id="collapseTwo" class="text-center" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-blue py-1 collapse-inner rounded">
                    <p style="display: block;"><a class="collapse-item" href="../produk.php" style="color: white; font-weight: bold; font-size: 20px;">Barang</a></p>
                    <hr class="sidebar-divider">
                    <p style="display: block;"><a class="collapse-item" href="../kategori.php" style="color: white; font-weight: bold; font-size: 20px;">Kategori</a></p>
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
                        <a class="collapse-item" style="font-weight: bold; font-size: 15px;">Penjualan</a>
                        <a class="collapse-item" href="penjualan_detail.php" style="font-weight: bold; font-size: 15px;">Detail Penjualan</a>
                        <a class="collapse-item" href="pembelian.php" style="font-weight: bold; font-size: 15px;">Pembelian</a>
                        <a class="collapse-item" href="pembelian_detail.php" style="font-weight: bold; font-size: 15px;">Detail_Pembelian</a>
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
            <!-- Sidebar Toggler (Sidebar) -->
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

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto"> <!-- Menggunakan kelas ml-auto untuk menjaga elemen di sebelah kanan -->

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
    <!-- content -->
    <div class="container text">
        <h2 class="text-center" style="font-weiht">PENJUALAN</h2>
        <form action="" method="POST">
            <div class="row">
                <div class="offset-md-3 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="toko">TOKO</label>
                        <select class="form-control" id="toko_id" name="toko_id">
                        <option value="" disabled selected>toko...</option>
                            <?php 
                                if($result){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $nama_toko = $row['nama_toko'];
                                        $id = $row['toko_id'];
                                        echo "<option value='$id' >$nama_toko</option>";
                                    }
                                } else {
                                    echo "<option value=''>Gagal mengambil data</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="user">USER</label>
                        <select class="form-control" id="user_id" name="user_id">
                        <option value="" disabled selected>user...</option>
                            <?php 
                                if($result1){
                                    while($row = mysqli_fetch_assoc($result1)){
                                        $username = $row['username'];
                                        $id = $row['user_id'];
                                        echo "<option value='$id'>$username</option>";
                                    }
                                } else {
                                    echo "<option value=''>Gagal mengambil data</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="pelanggan">PELANGGAN</label>
                        <select class="form-control" id="pelanggan_id" name="pelanggan_id">
                        <option value="" disabled selected>Pilih Pelanggan...</option>
                            <?php 
                                if($result2){
                                    while($row = mysqli_fetch_assoc($result2)){
                                        $nama_pelanggan = $row['nama_pelanggan'];
                                        $id = $row['pelanggan_id'];
                                        echo "<option value='$id'>$nama_pelanggan</option>";
                                    }
                                } else {
                                    echo "<option value=''>Gagal mengambil data</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="offset-md-3 col-md-6 mb-3">
                <div class="form-group">
                    <label for="searchBarang">BARANG</label>
                    <input type="text" class="form-control" id="searchBarang" placeholder="Cari barang...">
                </div>

                <div class="form-group" id="daftarBarang">
                    <?php 
                        if($result3){
                            while($row = mysqli_fetch_assoc($result3)){
                                $nama_produk = $row['nama_produk'];
                                $id = $row['produk_id'];
                                $harga = $row['harga_jual'];
                    ?>
                                <div class='form-check barang' data-nama='<?php echo $nama_produk; ?>' style="display: none;">
                                    <input class='form-check-input' type='checkbox' name='produk_id[]' value='<?php echo $id; ?>' data-harga='<?php echo $harga; ?>' id='produk_<?php echo $id; ?>'>
                                    <label class='form-check-label' for='produk_<?php echo $id; ?>'><?php echo $nama_produk; ?></label>
                                    <div class='form-group'>
                                        <label for='jumlah_<?php echo $id; ?>'>JUMLAH</label>
                                        <input type='number' class='form-control' name='jumlah_<?php echo $id; ?>' id='jumlah_<?php echo $id; ?>' value='1' min='1'>
                                    </div>
                                </div>
                    <?php
                            }
                        } else {
                            echo "<p>Gagal mengambil data</p>";
                        }
                    ?>
                </div>
                </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <label for="bayar" class="form-label">TOTAL</label>
                        <input type="number" class="form-control" id="total" name="total" >
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <label for="bayar" class="form-label">BAYAR:</label>
                        <input type="text" class="form-control" id="bayar" name="bayar">
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <label for="sisa" class="form-label">SISA</label>
                        <input type="text" class="form-control" id="sisa" name="sisa">
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <label for="keterangan" class="form-label">KETERANGAN</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </div>
        </form>
    </div>
</div>
            <!-- End of Main Content -->
</div>
        <!-- End of Content Wrapper -->
</div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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
<script>
    
</script>
<script>
    //bayar
    document.getElementById('bayar').addEventListener('input', function() {
    calculateSisa();
});

function calculateSisa() {
    var total = parseFloat(document.getElementById('total').value);
    var bayar = parseFloat(document.getElementById('bayar').value);
    
    // Pastikan kedua nilai adalah angka dan bayar lebih besar dari total
    if (!isNaN(total) && !isNaN(bayar) && bayar > total) {
        var sisa = bayar - total;
        document.getElementById('sisa').value = sisa;
    } else {
        document.getElementById('sisa').value = '';
    }
}
</script>
<script>
    // search barang
    document.getElementById('searchBarang').addEventListener('input', function() {
        var keyword = this.value.toLowerCase();
        var barangs = document.querySelectorAll('.barang');
        
        if (keyword.trim() === '') { // Jika input pencarian kosong
            barangs.forEach(function(barang) {
                barang.style.display = 'none'; // Semua barang disembunyikan
            });
        } else {
            barangs.forEach(function(barang) {
                var nama = barang.getAttribute('data-nama').toLowerCase();
                var checkbox = barang.querySelector('.form-check-input');
                if (nama.includes(keyword)) {
                    barang.style.display = 'block';
                } else if (!checkbox.checked) {
                    barang.style.display = 'none';
                }
            });
        }
    });
</script>
<script>
    // Fungsi untuk mengupdate total harga
    function updateTotal() {
        var total = 0;

        // Loop melalui semua barang yang dipilih
        document.querySelectorAll('.form-check-input:checked').forEach(function(checkbox) {
            var id = checkbox.value;
            var harga = parseInt(checkbox.dataset.harga);
            var jumlah = parseInt(document.getElementById('jumlah_' + id).value);
            
            total += harga * jumlah;
        });

        // Update tampilan total harga
        document.getElementById('total').value = total;

        // Hitung sisa pembayaran jika input bayar diisi
        var bayar = parseInt(document.getElementById('bayar').value);
        var sisa = bayar - total;
        if (!isNaN(sisa)) {
            document.getElementById('sisa').value = sisa;
        }
    }

    // Event listener untuk checkbox dan input jumlah
    document.querySelectorAll('.form-check-input, .jumlah').forEach(function(element) {
        element.addEventListener('change', function() {
            updateTotal();
        });
    });

    // Event listener untuk input bayar
    document.getElementById('bayar').addEventListener('input', function() {
        updateTotal();
    });
</script>


</body>

</html>
