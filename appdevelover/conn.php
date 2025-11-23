<?php
$host     = "localhost";   // Host server
$user     = "root";        // Username MySQL
$pass     = "";            // Password MySQL (default XAMPP kosong)
$db       = "eventmusik_db";  // Nama database kamu

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
