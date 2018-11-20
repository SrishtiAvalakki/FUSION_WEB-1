<?php
if(isset($_GET['submit']))
{           
require('./login/loginPage.php');
require('./utils/connection.php');
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];
// echo "<script>alert ('$userId')</script>";
    $userQuery="UPDATE users SET `displayName`=\"$_GET[dname]\",`gender`=\"$_GET[gender]\",`about`=\"$_GET[about]\",`hobbies`=\"$_GET[hobbies]\",`bio`=\"$_GET[bio]\",`pno`=\"$_GET[phno]\",`country`=\"$_GET[country]\" where id='$userId';";
    $result=$conn->query($userQuery);
    $conn->close();
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />


<title>Image Upload</title>
<style type="text/css">

/*div {

    margin-top: 50px;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}*/
/*body {
    font-family: Arial, Helvetica, sans-serif;
}
 Style the header */
header
 {
    background-color: #91006e;
    padding: 30px;
    text-align: center;
    font-size: 35px;
    color: white;
 }
 form {
  text-align: center;
}

</style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  
        <link rel="stylesheet" type="text/css" href="styles.css"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styling.css">
</head>
<body>
<nav class="navbar navbar-inverse" id="nav_bar">
                        <div class= "container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="index.php"><b>FIND A ROOMIE</b></a>
                            </div>
                            <div class="nav navbar-nav navbar-right" id ="nav_list">
                                <a class="navbar-brand"href="newup.php"><span class="glyphicon glyphicon-user"></span>My Profile</a>
                                <a class="navbar-brand" href="groups/groups.php">Create<span class="glyphicon glyphicon-cog"></span>Group</a>
                                <a class="navbar-brand" href="search.php"><span class="glyphicon glyphicon-search"></span>Search Users</a>
                                <a class="navbar-brand"href="login/login.html"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a>
                            </div>
                        </div>
                </nav>

<header>
  <h2>EDIT  YOUR  PROFILE</h2>
</header>



<div>
 <form action="#" method="get" >
 <br>
 <br>  
 About Me: <input type="text" id="about" name="about" placeholder="about me...!!!"><br><br>
 Display Name: <input type="text" id="about" name="dname" placeholder="Display Name"><br><br>
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
   <a href="newup.php">cancel</a>
  </form>    
</div>
</body>
</html>

