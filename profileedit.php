<?php
include '../utils/ChromePhp.php';
if(isset($_POST['submit']))
{
    require('../utils/connection.php');
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
 <form action="/profileedit.php" method="post">
   About Me: <input type="text" id="about" name="about" placeholder="about me...!!!"><br><br>
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name.."><br><br>

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name.."><br><br>

    HOBBIES: <input type="text" id="hobbies" name="hobbies" placeholder="list your hobbies"><br><br>
    BIO: <input type="text" id="bio" name="bio" placeholder="bio"><br><br>
    Phone no: <input type="text" id="phno" name="phno" placeholder="enter your number here"><br><br>
    Gender : 
    <input type = "radio" name="gender" value="male"> MALE<br>
    <input type = "radio" name="gender" value="female">FEMALE<br><br>


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
  
    <input type="submit" value="submit">
  </form>
</div>

</body>
</html>
