<?php
// Mulai sesi atau menghubungkan dengan sesi yang sudah ada
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Alihkan pengguna ke halaman login atau halaman lain yang sesuai
header("Location: login.php"); // Ganti "login.php" dengan URL halaman yang sesuai
exit();
