<?php
include '../koneksi.php';
session_start();
// Inisialisasi data pembelian
$pembelianToAdd = [
    'pembelian_id' => '',
    'toko_id' => '',
    'user_id' => '',
    'no_faktur' => '',
    'tanggal_pembelian' => '',
    'suplier_id' => '',
    'total' => '',
    'bayar' => '',
    'sisa' => '',
    'keterangan' => '',
    'created_at' => date("Y-m-d")
];

// Ambil data toko dari database
$sql = "SELECT toko_id, nama_toko FROM toko";
$result = $conn->query($sql);
$tokoOptions = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tokoOptions .= "<option value='" . $row["toko_id"] . "'>" . $row["nama_toko"] . "</option>";
    }
}

// Ambil data user dari database
$sql = "SELECT user_id, username FROM user";
$result = $conn->query($sql);
$userOptions = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $userOptions .= "<option value='" . $row["user_id"] . "'>" . $row["username"] . "</option>";
    }
}

// Ambil data supplier dari database
$sql = "SELECT suplier_id, nama_suplier FROM suplier";
$result = $conn->query($sql);
$supplierOptions = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $supplierOptions .= "<option value='" . $row["suplier_id"] . "'>" . $row["nama_suplier"] . "</option>";
    }
}

// Setelah validasi data POST, simpan data pembelian ke dalam database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangani data POST
    $pembelianToAdd = [
        'pembelian_id' => $_POST['pembelianId'],
        'toko_id' => $_POST['tokoId'],
        'user_id' => $_POST['userId'],
        'no_faktur' => $_POST['noFaktur'],
        'tanggal_pembelian' => $_POST['tanggalPembelian'],
        'suplier_id' => $_POST['suplierId'],
        'total' => $_POST['total'],
        'bayar' => $_POST['bayar'],
        'sisa' => $_POST['sisa'],
        'keterangan' => $_POST['keterangan'],
        'created_at' => $_POST['createdAt'],
    ];

    // Simpan data ke dalam database
    // Code untuk menyimpan data ke database di sini
    // Pastikan untuk mengganti bagian ini dengan logika penyimpanan ke database sesuai dengan struktur tabel Anda
}
if(isset($_POST['id_suplier'])){
    $suplierId = $_POST['id_suplier'];

    // Query untuk mengambil produk berdasarkan suplier_id
    $sql = "SELECT nama_produk, harga FROM produk WHERE suplier_id = $suplierId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Tampilkan produk berdasarkan suplier_id
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nama_produk'] . "</td>";
            echo "<td id='harga" . $row['nama_produk'] . "'>" . $row['harga'] . "</td>"; // Tambahkan kolom harga di sini
            echo "<td><input type='number' id='qty" . $row['nama_produk'] . "' name='qty" . $row['nama_produk'] . "' min='0' style='width:60px;' oninput='hitungSisa()'></td>";
            echo "<td><input type='checkbox' class='selectProduct' id='chk" . $row['nama_produk'] . "' name='selectProduct[]' value='" . $row['nama_produk'] . "' onchange='updateQty(this)'></td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
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

    <title>Pembelian Barang</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 120vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #formContainer {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .wrapper{
        width:100%;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        select,
        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            width: 49%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        #simpanBtn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        #batalBtn {
            float: right;
            background-color: #ccc;
            color: black;
            border: none;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* CSS untuk penampilan tabel produk */
        #productTableContainer {
            float: right;
            width: 50%;
            padding-left: 20px;
        }

        #productTable {
            border-collapse: collapse;
            width: 100%;
        }

        #productTable td,
        #productTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #productTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f2f2f2;
        }

        /* Tambahkan gaya untuk checkbox */
        .checkbox-label {
            display: block;
            position: relative;
            padding-left: 25px;
            margin-bottom: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkbox-label input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .checkbox-label:hover input~.checkmark {
            background-color: #ccc;
        }

        .checkbox-label input:checked~.checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-label input:checked~.checkmark:after {
            display: block;
        }

        .checkbox-label .checkmark:after {
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
   
</head>

<body id="page-top">

       <!-- Page Wrapper -->
    

    <div style='display:flex;flex-direction:row;'>

        <div id="formContainer">
            <h2 class="">Tambah Pembelian</h2>

            <form id="formTambahPembelian" method="post" action="detail_pembelian.php">

                <input type="hidden" id="pembelianId" name="pembelianId" value="">

                <label for="tokoId">Nama Toko:</label>
                <select id="tokoId" name="tokoId" required>
                    <option value="">Pilih Toko</option>
                    <?= $tokoOptions ?>
                </select>

                <label for="userId">Nama User:</label>
                <select id="userId" name="userId" required>
                    <option value='<?= $_SESSION['user_id']?>'><?= $_SESSION['username']?></option>
                </select>

                <label for="noFaktur">No Faktur:</label>
                <input type="text" id="noFaktur" name="noFaktur" value="<?= $pembelianToAdd['no_faktur'] ?>" required>

                <label for="tanggalPembelian">Tanggal Pembelian:</label>
                <input type="date" id="tanggalPembelian" name="tanggalPembelian" value="<?= $pembelianToAdd['tanggal_pembelian'] ?>" required>

                <label for="suplierId">Nama Supplier:</label>
                <select  name="suplierId" id='id_suplier' required >
                    <option value="">Pilih Supplier</option>
                    <?= $supplierOptions ?>
                </select>

                <input type="hidden" id="total" name="total" value="<?= $pembelianToAdd['total'] ?>">
                <input type="hidden" id="sisa" name="sisa" value="<?= $pembelianToAdd['sisa'] ?>">

                <div id="totalBayar">
                    <div>Total: <span id="totalbarang">0</span></div>
                    <div>
                        <label for="bayar">Bayar:</label>
                        <input type="number" id="bayar" name="bayar" oninput="hitungSisa()">
                    </div>
                    <div>Sisa: <span id="sisaBayar">0</span></div>
                </div>


                <label for="keterangan">Keterangan:</label>
                <input type="text" id="keterangan" name="keterangan" value="<?= $pembelianToAdd['keterangan'] ?>" required>

                <input type="hidden" id="createdAt" name="createdAt" value="<?= date("Y-m-d") ?>">

                <button id="simpanBtn" type="submit">Simpan</button>
                <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
            </form>
        </div>
        <!-- Container untuk menampilkan tabel produk -->
        <div id="productTableContainer">
            <h3>Daftar Produk</h3>
            <table id="productTable">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody id='tbody'>
                    
                    <!-- <tr>
                        <td>Kopi</td>
                        <td>Rp. 25.000</td>
                        <td><input type="number" id="qtyKopi" name="qtyKopi" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkKopi" name="selectProduct[]" value="Kopi" onchange="updateQty(this)"></td>
                    </tr>
                    <tr>
                        <td>Nabati</td>
                        <td>Rp. 20.000</td>
                        <td><input type="number" id="qtyNabati" name="qtyNabati" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkNabati" name="selectProduct[]" value="Nabati" onchange="updateQty(this)"></td>
                    </tr> -->
                </tbody>
            </table>
            <br>
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function formatCurrency(amount) {
            return 'Rp. ' + amount.toLocaleString('id-ID', { minimumFractionDigits: 2 });
        }
        function updateTotal() {
            let total = 0;
        const checkboxes = document.querySelectorAll('.selectProduct:checked');
        checkboxes.forEach(function (checkbox) {
            const productName = checkbox.value;
            const qty = parseFloat(document.getElementById('qty' + productName).value) || 0;
            const harga = parseFloat(document.getElementById('harga' + productName).textContent.replace(/\D/g, '')) || 0;
            total += harga * qty;
        });
    document.getElementById('total').value = total; // Update the total input field
    hitungSisa(); 
            }

            $(document).ready(function(){
                            // Event listener untuk perubahan nilai pada elemen select nama supplier
                $('#id_suplier').change(function(){
                    var suplierId = $(this).val(); // Ambil nilai ID supplier yang dipilih
                    
                    if(suplierId != ''){
                        // Kirim permintaan Ajax ke file PHP untuk mendapatkan produk berdasarkan supplier yang dipilih
                        $.ajax({
                            url: 'getproduksuplier.php',
                            type: 'post',
                            data: {id_suplier: suplierId},
                            success:function(response){
                                // Perbarui tampilan produk di halaman HTML dengan respons dari permintaan Ajax
                                $('#tbody').html(response);
                            }
                        });
                    }else{
                        // Kosongkan kontainer produk jika tidak ada supplier yang dipilih
                        $('#tbody').html('');
                    }
                });
            });

            // Fungsi untuk memperbarui jumlah barang dan menghitung total saat checkbox diubah


// Fungsi untuk menghitung sisa pembayaran
function hitungSisa() {
    const total = parseFloat(document.getElementById('total').value) || 0;
    const bayar = parseFloat(document.getElementById('bayar').value) || 0;
    const sisa = bayar - total;
    document.getElementById('sisa').value = sisa;
    document.getElementById('sisaBayar').textContent = 'Rp. ' + sisa.toLocaleString('id-ID', { minimumFractionDigits: 2 });
}

function updateQty(element) {
    const productName = element.value;
    const qtyInput = document.getElementById('qty' + productName);
    qtyInput.value = element.checked ? 1 : 0;
    updateTotal();
}



</script>

    <!-- Bootstrap core JavaScript-->
  
    <script src="../SBAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../SBAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../SBAdmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../SBAdmin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../SBAdmin/js/demo/chart-area-demo.js"></script>
    <script src="../SBAdmin/js/demo/chart-pie-demo.js"></script>

    <!-- Additional custom scripts or scripts for handling data tables can be added here -->

</body>

</html>