<?php
include '../utils/ChromePhp.php';
if(isset($_POST['submit']))
{
    require('../utils/connection.php');
    $userQuery = "INSERT INTO `users`(`username`, `password`, `emailID`, `displayName`,`dob`,`gender`)
                 VALUES ('$_POST[username]','$_POST[password]','$_POST[emailid]', '$_POST[username]','$_POST[dob]','$_POST[gender]')";
    
    ChromePhp::log($userQuery);
    $verifyemail="SELECT * FROM users WHERE emailId='$_POST[emailid]'";
    $result=$conn->query($verifyemail);
    if ($result-> num_rows > 0) {
        echo "<script>alert (\"Email Duplicates\")</script>";
    }
       if ($conn->query($userQuery) == TRUE ) {
        echo "<script>alert (\"User signed up successfully\")</script>";
    } else {
        ChromePhp::log("Error: " . $userQuery . "<br>" . $conn->error);
    }
    $conn->close();
}
?>