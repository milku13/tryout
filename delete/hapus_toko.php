<?php
require '../koneksi.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Membuat query DELETE
    $query = "DELETE FROM toko WHERE toko_id = $id";

    // Menjalankan query
    if ($conn->query($query)) {
        echo "Data berhasil dihapus.";
        header("location:../toko.php");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak valid.";
}


?>