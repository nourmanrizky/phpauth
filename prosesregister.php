<?php
session_start();
include "config.php";
//dapatkan data user dari form register
$user = [
    'nama' => $_POST['nama'],
    'email' => $_POST['email'],
    'password' => md5($_POST['password']),
    'password_confirmation' => md5($_POST['password_confirmation']),
];
// validasi jika password & password_confirmation sama
if ($user['password'] != $user['password_confirmation']) {
    $_SESSION['error'] = 'Password yang anda masukkan tidak sama dengan password confirmation.';
    header("Location: register.php");
    die;
}
// check apakah user dengan email tersebut ada di table users
$query = "SELECT * FROM user where email = ? limit 1";
$stmt = $mysqli->stmt_init();
$stmt->prepare($query);
$stmt->bind_param('s', $user['email']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_ASSOC);
//jika email sudah ada, maka return kembali ke halaman register.
if ($row != null) {
    $_SESSION['error'] = 'email yang anda masukkan sudah ada di database.';
    header("Location: register.php");
} else {
    //email unik. simpan di database.
    $query = "insert into user (nama, email, password) values  (?,?,?)";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('sss', $user['nama'], $user['email'], $user['password']);
    $stmt->execute();
    $result = $stmt->get_result();
    var_dump($result);
    $_SESSION['message']  = 'Berhasil register ke dalam sistem. Silakan login dengan username dan password yang sudah dibuat.';
    header("Location: login.php");
}
