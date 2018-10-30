<?php
include '../utils/ChromePhp.php';
// ChromePhp::log($_POST);
session_start();
if(isset($_POST['submit']))
{
    require('../utils/connection.php');
    $emailId = mysqli_real_escape_string($conn, $_POST['emailId']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $newURL = "../index.php";
    ChromePhp::log($_POST['submit']);
    $userLoginQuery = "SELECT * FROM `users` WHERE `emailId`= '$emailId' AND
                         `password`= '$password'";

            $result = $conn->query($userLoginQuery);            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION["userid"] = $row['id'];
                $_SESSION["groupid"] = '1';
                $_SESSION["displayname"] = $row['displayName'];
                ChromePhp::log($username);
                 header('Location: '.$newURL);
                 exit();
            //   echo "Login Successful";
             } else {
                echo "Invalid Password or User does not exist";
            }
            $conn->close();
}
?>
