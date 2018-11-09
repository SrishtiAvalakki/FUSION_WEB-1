<?php
if(isset($_GET['submit']))
{           
require('./login/loginPage.php');
require('./utils/connection.php');
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];
// echo "<script>alert ('$userId')</script>";
    $userQuery="UPDATE users SET `username`=\"$_GET[username]\",`displayName`=\"$_GET[dname]\",`gender`=\"$_GET[gender]\",`about`=\"$_GET[about]\",`hobbies`=\"$_GET[hobbies]\",`bio`=\"$_GET[bio]\",`pno`=\"$_GET[phno]\",`country`=\"$_GET[country]\" where id='$userId';";
    $result=$conn->query($userQuery);
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
.about-info {
      display: grid;
      grid-gap; 30px;
      grid-template-areas:'bioimage bio bio' 'job1 job2 job3';
      grid-template-columns: repeat(3,1fr);
      }
</style>
</head>
<body>

<header>
  <h2>EDIT  YOUR  PROFILE</h2>
</header>



<div>
 <form action="#" method="get">
   
 About Me: <input type="text" id="about" name="about" placeholder="about me...!!!"><br><br>
 Display Name: <input type="text" id="about" name="dname" placeholder="Display Name"><br><br>
 User Name: <input type="text" id="about" name="username" placeholder="User Name"><br><br>
 HOBBIES: <input type="text" id="hobbies" name="hobbies" placeholder="list your hobbies"><br><br>
    BIO: <input type="text" id="bio" name="bio" placeholder="bio"><br><br>
    Phone no: <input type="text" id="phno" name="phno" placeholder="enter your number here"><br><br>
    Gender : 
    <input type = "radio" name="gender" value="M"> Male
    <input type = "radio" name="gender" value="F">Female<br><br>


    <label for="country">Country: </label>
    <select id="country" name="country">
      <option value="australia">Australia</option>
      <option value="canada">Canada</option>
      <option value="usa">USA</option>
      <option value="india">India</option>
      <option value="afghanistan">Afghanistan</option>
     <option value="Brazil">Brazil
     </option><br>

    </select>
   <br><br> <input type="submit" name="submit"  id="submit">
   <a href="up.php">cancel</a>
  </form>    
</div>
</body>
</html>