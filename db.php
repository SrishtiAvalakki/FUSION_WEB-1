<?php
    $servername = "localhost";
    $username = "admin";
    $password = "monarchs";
    $dbname = "roomies";
 
    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
?>
