<?php
session_start();

if(isset($_SESSION['authSatisified']))
    if ($_SESSION['userid'] == '0') {
        header('Location: ../admin.php');
    }
    else{
        header('Location: ../index.php');
    }

?>