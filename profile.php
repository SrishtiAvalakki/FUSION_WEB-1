<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
    box-sizing: border-box;
}
#box {
    background-color: white;
    width: 25px;
    border: 5px solid black;
    padding: 90px;
    margin: 28px;
    margin-top: -140px;
    margin-left: 25px;
}

body {
    font-family: Arial, Helvetica, sans-serif;
}

/* Style the header */
header {
    background-color: #91006e;
    padding: 30px;
    text-align: center;
    font-size: 35px;
    color: white;
}
p{
    margin-left:500px;
    margin-top:40px;
}
h3{
    margin-left:500px;
    color: red;
}
#btn-edit{
    border-radius: 12px;
    color: black;
    color: black;
    border: 2px solid #555555;
    margin-left:-65px;
    margin-top: -50px;
    padding: 14px 40px;
    font-size: 16px;
    text-align: center;
}
#btn-pic{
    border-radius: 12px;
    color: black;
    color: black;
    border: 2px solid #555555;
    margin-left:-65px;
    margin-top: -50px;
    padding: 14px 40px;
    font-size: 16px;
    text-align: center;
}

.button1{
    margin-right:-1200px;
    background-color: #e7e7e7;
    color:black;
}

/* Create two columns/boxes that floats next to each other */
nav {
    float: left;
    width: 20%;
    height: 900px; /* only for demonstration, should be removed */
    background: #A9A9A9;
    padding: 20px;
}

/* Style the list inside the menu */
nav ul {
    list-style-type: none;
    padding: 60;
}

article {
    float: left;
    padding: 20px;
    width: 70%;
    background-color:blue;
    height: 300px; /* only for demonstration, should be removed */
}

/* Clear floats after the columns */
section:after {
    content: "";
    display: table;
    clear: both;
}


/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
@media (max-width: 600px) {
    nav, article {
        width: 100%;
        height: auto;
    }
}
</style>
</head>
<body>

<header>
  <h2>PROFILE</h2>
  <button class="button button1" id= "btn-edit" type="button" onclick="window.location.href='profileedit.php'">EDIT !</button>
</header>
  <nav>     
  <div id=box>
  <button type="buttons" id =" btn-pic" onclick="window.location.href='upload.php'">upload profile!</button>
  </div>
  </nav>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "roomies";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
session_start();
$userId=$_SESSION["userid"];
include 'utils/ChromePhp.php';
$result = mysqli_query($conn, "SELECT * FROM users where id=$userId");

//$sql = "SELECT about,fname,lname,hobbies,bio,gender,pno,country FROM profile";
//$result = $conn->query($sql);

//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//        echo "<br> ABOUT ME..!!: ". $row["about"]. "<br><br> First Name: ". $row["fname"]. " <br><br>Lastname :" . $row["lname"]." <br><br>My Hobbies :" . $row["hobbies"]."<br><br> BIO:".$row["bio"]."<br><br> GENDER:".$row["gender"]."<br><br> Phone :".$row["pno"]."<br><br> COUNTRY:".$row["country"];
//    }
//} else {
//    echo "0 results";
//}
?>
<div id="retrive">
    <p>
    <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='profile_id'>";
      	//echo "<img src='images/".$row['about']."' >";
          echo "<p><b>About Me:   <b>".$row['username']."</p>";
          echo "<p><b>Display Name  <b>".$row['displayName']."</p>";
          echo "<p><b>Email ID   <b> ".$row['emailId']."</p>";
          echo "<p><b>Hobbies:    <b>".$row['hobbies']."</p>";
          echo "<p><b>BIO:      <b>".$row['bio']."</p>";
          echo "<p><b>GENDER:   <b>".$row['gender']."</p>";
          echo "<p><b>Phone:     <b>".$row['dob']."</p>";
          echo "<p><b>COUNTRY:    <b>".$row['country']."</p>";
      echo "</div>";
    }
  ?>
  </p>

</div>
</body>
</html>
