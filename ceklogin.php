<?php
session_start();
include 'config.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT * FROM user WHERE email=? AND password=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

$result = $stmt->get_result();
$cek = $result->num_rows;

$stmt->close();
$mysqli->close();

if ($cek > 0) {
    $_SESSION['email'] = $email;
    $_SESSION['status'] = "login";
    header("location: index.php");
} else {
    // email atau password salah, tampilkan pesan kesalahan
    $_SESSION['error'] = "email atau password salah. Silakan coba lagi.";
    header("location: login.php");
}
