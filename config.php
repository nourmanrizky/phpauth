<?php
// Konfigurasi database
$db_host = "localhost"; // Host database
$db_username = "root"; // Username database
$db_password = "root"; // Password database
$db_name = "dbtes"; // Nama database

// Membuat koneksi ke database menggunakan mysqli
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

// Mengecek apakah terjadi error dalam koneksi
if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}
