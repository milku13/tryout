<?php
// Periksa apakah formulir dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Hubungkan ke database Anda
        $pdo = new PDO("mysql:host=localhost;dbname=db_kasir", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Ambil nilai dari formulir
        $no_faktur = $_POST['no_faktur'];
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
        $suplier_id = $_POST['suplier_id'];
        $total = $_POST['total'];
        $bayar = $_POST['bayar'];
        $sisa = $_POST['sisa'];
        $stok = $_POST['stok'];
        $keterangan = $_POST['keterangan'];
        $barang = $_POST['barang']; // Ambil nilai barang dari formulir
        $quantity = $_POST['quantity']; // Ambil nilai quantity dari formulir

        $sql_update_stok = "UPDATE produk SET stok = stok + $quantity WHERE produk_id = $produk_id";
        $result_update_stok = mysqli_query($conn, $sql_update_stok);

        // Lakukan penyimpanan pembelian
        $sql_simpan_pembelian = "INSERT INTO pembelian (no_faktur, tanggal_pembelian, suplier_id, produk_id, quantity, total, bayar, sisa, stok, keterangan) 
                                VALUES ('$no_faktur', '$tanggal_pembelian', '$suplier_id', '$produk_id', '$quantity', '$total', '$bayar', '$sisa', '$stok', '$keterangan')";
        $result_simpan_pembelian = mysqli_query($conn, $sql_simpan_pembelian);

        if ($result_simpan_pembelian && $result_update_stok) {
            // Jika penyimpanan berhasil, arahkan kembali ke halaman pembelian dengan pesan sukses
            header("Location: ../pembelian.php?pesan=sukses");
        } else {
            // Jika terjadi kesalahan, arahkan kembali ke halaman pembelian dengan pesan error
            header("Location: ../pembelian.php?pesan=gagal");
        }

        // Mulai transaksi
        $pdo->beginTransaction();

        // Siapkan pernyataan SQL untuk memasukkan data ke tabel pembelian
        $stmt_pembelian = $pdo->prepare("INSERT INTO pembelian (no_faktur, tanggal_pembelian, suplier_id, total, bayar, sisa, stok, keterangan) 
                               VALUES (:no_faktur, :tanggal_pembelian, :suplier_id, :total, :bayar, :sisa, :stok, :keterangan)");

        // Bind parameter untuk tabel pembelian
        $stmt_pembelian->bindParam(':no_faktur', $no_faktur);
        $stmt_pembelian->bindParam(':tanggal_pembelian', $tanggal_pembelian);
        $stmt_pembelian->bindParam(':suplier_id', $suplier_id);
        $stmt_pembelian->bindParam(':total', $total);
        $stmt_pembelian->bindParam(':bayar', $bayar);
        $stmt_pembelian->bindParam(':sisa', $sisa);
        $stmt_pembelian->bindParam(':stok', $stok);
        $stmt_pembelian->bindParam(':keterangan', $keterangan);

        // Jalankan pernyataan untuk memasukkan data ke tabel pembelian
        $stmt_pembelian->execute();

        // Dapatkan ID yang terakhir dimasukkan dari tabel pembelian
        $lastInsertId = $pdo->lastInsertId();

        // Siapkan pernyataan SQL untuk memasukkan data ke tabel pembelian_detail
        $stmt_detail = $pdo->prepare("INSERT INTO pembelian_detail (pembelian_id, produk_id, qty) 
                                      VALUES (:pembelian_id, :produk_id, :qty)");

        // Bind parameter untuk tabel pembelian_detail
        $stmt_detail->bindParam(':pembelian_id', $lastInsertId);

        // Lakukan loop melalui setiap barang dan quantity untuk dimasukkan ke pembelian_detail
        foreach ($barang as $index => $barangId) {
            $stmt_detail->bindParam(':produk_id', $barangId);
            $stmt_detail->bindParam(':qty', $quantity[$index]);
            $stmt_detail->execute();
        }

        // Komit transaksi
        $pdo->commit();

        // Redirect kembali ke halaman pembelian1.php setelah penambahan berhasil
        header("Location: ../transaksi/pembelian.php");
        exit();
    } catch (PDOException $e) {
        // Batalkan transaksi jika terjadi kesalahan
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }

    // Tutup koneksi database
    $pdo = null;
}

?>
