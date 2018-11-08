<?php
session_start();
if(isset($_POST['submit']))
{
    require('../utils/connection.php');
    $emailId = mysqli_real_escape_string($conn, $_POST['emailId']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $newURL = "../index.php";
    $userLoginQuery = "SELECT * FROM `users` WHERE `emailId`= '$emailId' AND
                         `password`= '$password'";

            $result = $conn->query($userLoginQuery);            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION["userid"] = $row['id'];
                $_SESSION["groupid"] = '1';
                $_SESSION["displayname"] = $row['displayName'];
                header('Location: '.$newURL);
                 exit();
             } else {
                echo "Invalid Password or User does not exist";
            }
            $conn->close();
}
?>
