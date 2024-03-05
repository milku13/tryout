<?php
require '../../koneksi.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Membuat query DELETE
    $query = "DELETE FROM penjualan WHERE penjualan_id = $id";

    // Menjalankan query
    if ($conn->query($query)) {

        header("location:../tabel_penjualan.php");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak valid.";
}


?>