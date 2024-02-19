<?php
$servername = "localhost";  // Ganti dengan nama server database Anda
$username = "root";      // Ganti dengan username database Anda
$password = "";      // Ganti dengan password database Anda
$dbname = "db_kasir";   // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Kode PHP lainnya dapat ditambahkan di sini untuk berinteraksi dengan database


?>
