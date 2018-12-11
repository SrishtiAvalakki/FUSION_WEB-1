<?php

session_start();
require "Authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: 2fAuth.php");
    die();
}
$authenticator = new Authenticator();
$checkResult = $authenticator->verifyCode($_SESSION['auth_secret'], $_POST['authenticatorCode'], 0);

if ($checkResult) {
    $_SESSION['2faAuth'] = 'true';
    if ($_SESSION["userid"] === 0) {
        header('Location: ' . '../../admin.php');
        exit();
    } else {
        header('Location: ' . '../../index.php');
        exit();
    }
    echo "Code Matched";
} else {
    header('Location: ' . '../login.php');
    exit();
    echo "Code Not Matched";
}
