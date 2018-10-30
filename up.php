<?php
session_start();
$userId=$_SESSION["userid"];
//$userId=4;
//echo "$userId";
include 'utils/ChromePhp.php';
if(!isset($_SESSION['displayname']) || !isset($_SESSION['userid']) || !isset($_SESSION['groupid'])){
    $newURL = "login/login.html";
    header('Location: '.$newURL);
}
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "roomies");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	//$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "images/".basename($image);

      //$sql = "INSERT INTO images (image) VALUES ('$image')";
      $sql ="UPDATE `images` SET `image`='$image'WHERE images.id='$userId'";
      
      
      // execute query
        mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT image FROM images, users WHERE users.id='$userId'AND images.id='$userId'");

  $result1 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
  $result2 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
  $result3 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
  $result4 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
  $result5 = mysqli_query($db, "SELECT * FROM users where id='$userId'");
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">


<title>Image Upload</title>
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
      grid-gap; 30px;
      grid-template-areas:'bioimage bio bio' 'job1 job2 job3';
      grid-template-columns: repeat(3,1fr);
      }

.about-info .bio-image{
    grid-area: bio-image;
    margin: auto;
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
								<a class="navbar-brand"href="up.php"><span class="glyphicon glyphicon-user"></span>Profile</a>
								<a class="navbar-brand" href="groups/groups.php">Create<span class="glyphicon glyphicon-cog"></span>Group</a>
								
								<a class="navbar-brand"href="login/login.html"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a>
							</div>
						</div>
                </nav>

<main id="about">

    <?php

        while ($row = mysqli_fetch_array($result1)){
        echo "<h1 class='lg-heading'>User Name: ".$row['username'] . "<span class='text-secondary'> Display Name:"."  ".$row['displayName']."</span></h1>";
        echo "<h2 class=sm-heading><p class='text-secondary'>About</p>".$row['about']."Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, aspernatur. Necessitatibus fugit voluptate magnam molestias, quod deserunt omnis et consequuntur repellendus ut quae? Sunt aut ea voluptatum dolores repellendus exercitationem.</h2>";
        }
    ?>

<div class="about-info">    
    <form method="POST" action="up.php" enctype="multipart/form-data">
    	
        <?php
        while ($row_img = mysqli_fetch_array($result)) {
        //echo "<div id='img_div'>";
      	echo "<img src='images/".$row_img['image']."'class='bio-image' >";
      	//echo "<p>".$row['image_text']."</p>";
        // echo "</div>";
         }
        ?>
        <input type="hidden" name="size" value="1000">
  	    <input type="file" name="image"><br>
        <button type="submit" name="upload" method="POST" action="up.php" enctype="multipart/form-data">Update</button>
         </form>


     
    <div class="bio">
        
            <?php
             while ($rowd = mysqli_fetch_array($result2)) {
      
      	                               
                echo "<h3 class='text-secondary'>BIO</h3><p>".$rowd['bio']."</p>";
                echo "<h3 class='text-secondary'>HOBBIES</h3><p>".$rowd['hobbies']."</p>";
                //echo "<h3 class='text-secondary'>DOB</h3><p>".$rowd['dob']."</p>";
                //echo "<h3 class='text-secondary'>COUNTRY</h3><p>".$rowd['country']."</p>";
                //echo "<h3 class='text-secondary'>GENDER</h3><p>".$rowd['gender']."</p>";
                                      
                }
            ?>
    </div>

    <div class="job job-1">
                <h3>GENDER</h3>
                <?php
                    while ($rowd1 = mysqli_fetch_array($result3)) {
                    echo "<p>".$rowd1['gender']."</p>";
                    }
                ?>
    </div>

       <div class="job job-2">
                <h3>COUNTRY</h3>
                <?php
                    while ($rowd2 = mysqli_fetch_array($result4)) {
                    echo "<p>".$rowd2['country']."</p>";
                    }
                ?>
    </div>
    <div class="job job-3">
                <h3>DATE OF BIRTH</h3>
                <?php
                    while ($rowd3 = mysqli_fetch_array($result5)) {
                    echo "<p>".$rowd3['dob']."</p>";
                    }
                ?>
    </div>

</div>
</main>
</body>
</html>