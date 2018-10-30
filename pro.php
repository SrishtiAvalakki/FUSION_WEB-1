<?php
include 'utils/ChromePhp.php';
if(isset($_POST['submit']))
{
    require('utils/connection.php');
    $userQuery = "INSERT INTO `profile`(`about`, `fname`, `lname`,`hobbies`,`bio`,`gender`,`pno`,`country`)
                 VALUES ('$_POST[about]','$_POST[firstname]','$_POST[lastname]', '$_POST[hobbies]','$_POST[bio]','$_POST[gender]','$_POST[phno]','$_POST[country]')";
    ChromePhp::log($userQuery);

       if ($conn->query($userQuery) == TRUE ) {
        echo "<script>alert (\"details recorded\")</script>";
    } else {
        ChromePhp::log("Error: " . $userQuery . "<br>" . $conn->error);
    }
    $conn->close();
}
?>