<?php
require "login/github_login/init.php";
require "utils/connection.php";

getData();
if(!isset($_SESSION['githubUseremail'])) {
    header("location: login/login.php");
}
$email = $_SESSION['githubUseremail'];
$emailValue = $email['email'];

$username = $_SESSION['githubUsername'];


$checkIfUserExists = "SELECT * from users WHERE users.emailId = '$emailValue';";

$result = $conn->query($checkIfUserExists);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['id']==='0'){
        $_SESSION["userid"] = 0;
        $_SESSION["displayname"] = $row['displayName'];
        $_SESSION['authSatisified'] = 'true';
        $_SESSION['githubLogin'] = 'true';
        header('Location: admin.php');
       exit();
    }
    else {
    $_SESSION["userid"] = $row['id'];
    $_SESSION["groupid"] = '1';
    $_SESSION["displayname"] = $row['displayName'];
    $_SESSION['authSatisified'] = 'true';
    $_SESSION['githubLogin'] = 'true';
    $_SESSION['gravatarURL'] = 'https://github.com/'.$username.'.png?size=400';
    header('Location: index.php');
     exit();
 } 
}
else {
    echo 'User does not exist in our system';
}
var_dump($emailValue);

?>