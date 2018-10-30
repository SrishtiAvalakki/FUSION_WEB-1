<?php
include 'utils/ChromePhp.php';
//require ('login/loginPage.php');
//include 'utils/ChromePhp.php';



if(isset($_POST['submit']))
{
    require('utils/connection.php');
    //include 'login/loginPage.php';
    
    //ChromePhp::log($_POST);
    //start_session();
    //$userId=$_SESSION["userid"];
    echo $_POST[username];
    //$userQuery = "INSERT INTO `profile`(`about`, `fname`, `lname`,`hobbies`,`bio`,`gender`,`pno`,`country`) VALUES ('$_POST[about]','$_POST[firstname]','$_POST[lastname]', '$_POST[hobbies]','$_POST[bio]','$_POST[gender]','$_POST[phno]','$_POST[country]')";
    $userQuery="UPDATE `users` SET `username`='$_POST[username]',`displayName`='$_POST[dname]',`gender`='$_POST[gender]',`about`='$_POST[about]',`hobbies`='$_POST[hobbies]',`bio`='$_POST[bio]',`pno`='$_POST[phno]',`country`='$_POST[country]' WHERE id = 6";  
   
    $result=$conn->query($userQuery);
    //echo "$result";                               
                                    
    ChromePhp::log($userQuery);

       if ($result==TRUE) {
        header('Location: profile.php');
    } else {
        ChromePhp::log("Error: " . $userQuery . "<br>" . $conn->error);
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
div {

    margin-top: 50px;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
* {
    box-sizing: border-box;
}
body {
    font-family: Arial, Helvetica, sans-serif;
}
/* Style the header */
header
 {
    background-color: #91006e;
    padding: 30px;
    text-align: center;
    font-size: 35px;
    color: white;
}
</style>
</head>
<body>

<header>
  <h2>EDIT  YOUR  PROFILE</h2>
</header>
<div>
 <form action="profileedit.php" method="post">
   
 About Me: <input type="text" id="about" name="about" placeholder="about me...!!!"><br><br>
 Display Name: <input type="text" id="about" name="dname" placeholder="Display Name"><br><br>
 User Name: <input type="text" id="about" name="username" placeholder="User Name"><br><br>
 HOBBIES: <input type="text" id="hobbies" name="hobbies" placeholder="list your hobbies"><br><br>
    BIO: <input type="text" id="bio" name="bio" placeholder="bio"><br><br>
    Phone no: <input type="text" id="phno" name="phno" placeholder="enter your number here"><br><br>
    Gender : 
    <input type = "radio" name="gender" value="male"> M<br>
    <input type = "radio" name="gender" value="female">F<br><br>


    <label for="country">Country: </label>
    <select id="country" name="country">
      <option value="australia">Australia</option>
      <option value="canada">Canada</option>
      <option value="usa">USA</option>
      <option value="india">India</option>
      <option value="afghanistan">Afghanistan</option>
     <option value="Brazil">Brazil
     </option>

    </select>
  
    <input type="submit" name="submit" id="go">
  </form>    
</div>
</body>
</html>
