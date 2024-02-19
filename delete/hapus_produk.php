<?php
require '../koneksi.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Periksa apakah ada data terkait di tabel penjualan_detail
    $check_query = "SELECT * FROM penjualan_detail WHERE produk_id = $id";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Ada data terkait, hapus terlebih dahulu
        $delete_detail_query = "DELETE FROM penjualan_detail WHERE produk_id = $id";
        if ($conn->query($delete_detail_query)) {
            // Setelah data terkait dihapus, baru hapus produk
            $delete_produk_query = "DELETE FROM produk WHERE produk_id = $id";
            if ($conn->query($delete_produk_query)) {
                header("location:../produk.php");
            } else {
                echo "Error: " . $delete_produk_query . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $delete_detail_query . "<br>" . $conn->error;
        }
    } else {
        // Tidak ada data terkait, langsung hapus produk
        $query = "DELETE FROM produk WHERE produk_id = $id";
        if ($conn->query($query)) {
            header("location:../produk.php");
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
} else {
    echo "ID tidak valid.";
}
?>
