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
           $verifyemail="SELECT id FROM users WHERE emailId='$_POST[emailid]'";
         $result=$conn->query($verifyemail);
            if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            //echo "<script>alert (\"Email Duplicates\")</script>";
            $res = $row['id'];
            echo "<script>console.log( 'Debug Objects: " . $res . "' );</script>";
            $userQuery = "INSERT INTO `usergroupmapping`(`userId`, `groupid`)
                 VALUES ('$res',1)";
            $conn->query($userQuery);
            $userimageQuery = "INSERT INTO `images`(`id`, `image`)
                 VALUES ('$res','https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwi_7aOj_MbeAhXxYt8KHVU-COUQjRx6BAgBEAU&url=https%3A%2F%2Fpngtree.com%2Ffree-icon%2Fthe-default-user_1213197&psig=AOvVaw2DORBZyG3TSPDq28pdunSB&ust=1541841220048327')";
            $conn->query($userimageQuery);
    }
        
        
    }

    } else {
        ChromePhp::log("Error: " . $userQuery . "<br>" . $conn->error);
    }
    $conn->close();
}
?>