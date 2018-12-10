<?php
session_start();
if(!isset($_SESSION['authSatisified'])) {
    header('Location: '.'../login/login.php');
}
?>