<?php
session_start();
$userId=$_SESSION["userid"];
include 'utils/ChromePhp.php';
if(!isset($_SESSION['displayname']) || !isset($_SESSION['userid']) || !isset($_SESSION['groupid']))
{
    $newURL = "login/login.php";
    header('Location: '.$newURL);
}
  // Create database connection
  $db = mysqli_connect("localhost", "admin", "monarchs", "roomies");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['gravatar']))
  { $email = "";
    $result6 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
   
    while ($rowd1 = mysqli_fetch_array($result6)) {
             $email = $rowd1['emailId'];
        }

        //$yravi = "yravi001@odu.edu";
        $gravatar_link = 'http://www.gravatar.com/avatar/' . md5($email) . '?s=32';
        
        $sql ="UPDATE `users` SET `image`='$gravatar_link' WHERE id='$userId'";
        mysqli_query($db, $sql);
        header("Location:newup.php");

        echo '<img src="' . $gravatar_link . '" class="bio-image" />';
  
}
  
  if (isset($_POST['upload']))
   {
    $image = $_FILES['image'];

    //$image = $_FILES['image']['name'];

    //$file = $_FILES['file'];
    
    $fileName =$_FILES['image']['name'];
    $fileTmpName =$_FILES['image']['tmp_name'];
    $fileSize =$_FILES['image']['size'];
    $fileError =$_FILES['image']['error'];
    $fileType =$_FILES['image']['type'];
    $fileExt =explode('.' , $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $types = array('jpeg', 'gif', 'png', 'jpg','JPEG','JPG','PNG');
      
     if (in_array($fileActualExt, $types))
       {
        

        $fileNameNew = "profile".$userId.uniqid('',true).".".$fileActualExt;
        $fileDestination ='images/'.$fileNameNew;
        move_uploaded_file($fileTmpName,$fileDestination);
        // file is okay continue
        $sql ="UPDATE `users` SET `image`='$fileDestination' WHERE id='$userId'";
        mysqli_query($db, $sql);
        header("Location:newup.php");


        } 
    else
     {
        echo '<script language="javascript">';
        // echo 'alert("image uploaded in the wrong format!")';
        echo '</script>';
       
        } 
       }
  $result = mysqli_query($db, "SELECT * FROM users  WHERE id='$userId'");

  $result1 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
  $result2 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
  $result3 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
  $result4 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
  $result5 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
?>
<!DOCTYPE html>
<html>
<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="styling.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">

<title>My Profile</title>
<style type="text/css">

main {
    padding: 4rem;
    min-height: cal(100vh-60px);
}
h1,h2,h3{
    margin:0;
    font-weight:400;
}
h1,lg-heading,
h2,lg-heading,
h3,lg-heading,{
    font-size: 6rem;
}
h1,sm-heading,
h2,sm-heading,
h3,sm-heading,{
    margin-bottom: 2rem;
    padding: 0.2rem 1rem;
    background: rgba(255,255,255,0.5);
}
.text-secondary{
    color: #3334ff;
}
.about-info {
      display: grid;
      grid-gap: 30px;
      grid-template-areas:'bioimage bio bio' 'job1 job2 job3';
      grid-template-columns: repeat(3,1fr);
      }

.about-info .bio-image{
    grid-area: bioimage;
    margin-top:0px;
    margin-left:10px;
    height: 200px;
    width: 200px;
    border: 3px solid;

}

.about-info .bio{
    grid-area: bio;
    font-size: 1.5rem;
}


.about-info .job-1{
    grid-area:job1;
}


.about-info .job-2{
    grid-area:job2;
}


.about-info .job-3{
    grid-area:job3;
}

.about-info .job{
    background: white;
    padding: 0.5rem;
    border-bottom: #3334FF 5px solid;

}

</style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
                                <a class="navbar-brand"href="profileedit.php"><span class="glyphicon glyphicon-user"></span>Edit My Profile</a>
                                <a class="navbar-brand" href="groups/groups.php">Create<span class="glyphicon glyphicon-cog"></span>Group</a>
                                <a class="navbar-brand" href="search.php"><span class="glyphicon glyphicon-search"></span>Search Users</a>
                                <a class="navbar-brand"href="login/login.php"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a>
                            </div>
                        </div>
                </nav>


    <main id="about">
    
<?php

while ($row = mysqli_fetch_array($result1)){
echo "<h2 class='lg-heading'><span class='text-secondary'>User Name:</span>".$row['username'] . "<br><br><span class='text-secondary'> Display Name:</span>"."  ".$row['displayName']."</h3>";
echo "<h3 class=sm-heading><p class='text-secondary'>About</p>".$row['about']."</h3>";
}
    ?>
    
    <div class="about-info">    
    <form method="POST" action="newup.php" enctype="multipart/form-data">
        
        <?php
        while ($row_img = mysqli_fetch_array($result))
         {
             echo "<img src='".$row_img['image']."' class='bio-image' >";
         }
        ?>

        <input type="hidden" name="size" value="1000">
        <input type="file" name="image"><br>
        <button type="submit" name="gravatar" method="POST" action="newup.php" enctype="multipart/form-data">Gravatar</button>
        <button type="submit" name="upload" method="POST" action="newup.php" enctype="multipart/form-data">Update</button>
    </form>
   <div class="bio">
        
            <?php
             while ($rowd = mysqli_fetch_array($result2)) {
      
                                       
                echo "<h3 class='sm-heading'><p class='text-secondary' >BIO</p></h3>".$rowd['bio']."</p>";
                echo "<h3 class='text-secondary'>HOBBIES</h3><p>".$rowd['hobbies']."</p>";                       
                }
            ?>
    </div>

    <div class="job job-1">
                <h3 class='text-secondary'>GENDER</h3>
                <?php
                    while ($rowd1 = mysqli_fetch_array($result3)) {
                    echo "<p>".$rowd1['gender']."</p>";
                    }
                ?>
    </div>

       <div class="job job-2">
                <h3 class='text-secondary'>COUNTRY</h3>
                <?php
                    while ($rowd2 = mysqli_fetch_array($result4)) {
                    echo "<p>".$rowd2['country']."</p>";
                    }
                ?>
    </div>
    <div class="job job-3">
                <h3 class='text-secondary' >DATE OF BIRTH</h3>
                <?php
                    while ($rowd3 = mysqli_fetch_array($result5)) {
                    echo "<p>".$rowd3['dob']."</p>";
                    }
                ?>
    </div>

</div>
</main>
</body>
