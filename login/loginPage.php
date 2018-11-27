<?php
session_start();
//  if(isset($_POST['submit'])){
    
  if(isset($_POST['submit'])){
    if(isset($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
      }
      if(!$captcha){
        echo '<h2>Please check the the captcha form.</h2>';
        exit;
      }
        // $secretKey = "6LdKiHwUAAAAAJanuKKjNvd_GJlgH_fDGDrxdSIB";
       $secretKey = "6LfJHXwUAAAAAHWUMk_3OZ6UCpkXdfQzyTGMuob2";
      $ip = $_SERVER['localhost'];
      $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
      $responseKeys = json_decode($response,true);
      if(intval($responseKeys["success"]) !== 1) {
        echo '<h2>You are spammer !</h2>';
      } else {
          header('Location: '.$newURL);
//         echo '<h2>Thanks for posting comment.</h2>';
     
      }
    require('../utils/connection.php');
    $emailId = mysqli_real_escape_string($conn, $_POST['emailId']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $newURL = "../index.php";
    $userLoginQuery = "SELECT * FROM `users` WHERE `emailId`= '$emailId' AND
                         `password`= '$password'";

            $result = $conn->query($userLoginQuery);            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if($row['id']==='0'){
                    $newURL1="../admin.php";
                    $_SESSION["userid"] = 0;
                    $_SESSION["displayname"] = $row['displayName'];
                    header('Location: '.$newURL1);
                   exit();
                }
                else {
                $_SESSION["userid"] = $row['id'];
                $_SESSION["groupid"] = '1';
                $_SESSION["displayname"] = $row['displayName'];
                header('Location: '.$newURL);
                 exit();
             }
             
            }
              else {
                echo "Invalid Password or User does not exist";
            }
             $conn->close();
           
}
?>
