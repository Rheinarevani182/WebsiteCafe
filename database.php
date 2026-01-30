<?php
$host = "localhost";  // kalau Laragon biasanya localhost
$user = "root";       // default user Laragon
$pass = "";            // password biasanya kosong di Laragon
$db   = "cafe_database";  // nama database yang kamu buat

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
?>
