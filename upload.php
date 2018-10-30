<?php
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

  	$sql = "INSERT INTO images (image) VALUES ('$image')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else {
  		$msg = "Failed to upload image";
  	}
  }

//*******************************************************************/
//YOUR HAVE TO INCLCUDE THE USER ID SO THAT THE IMAGE CAN BE MERGED 
$result = mysqli_query($db, "SELECT image FROM images WHERE id='7'");  
$servername = "localhost";
$username = "root";
$password = "";
$database = "roomies";

// Create connection
//$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

//*******************************************************************/
//YOUR HAVE TO INCLCUDE THE USER ID SO THAT THE IMAGE CAN BE MERGED 
$result1 = mysqli_query($db, "SELECT * FROM profile where id='6'");

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


.about-info {
      display: grid;
      grid-gap; 30px;
      grid-template-areas:'bioimage bio bio';
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


  
  </style>
</head>
<body>
<!--div id="content">
  
  <form method="POST" action="upload.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
  	<div>
      <textarea 
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="image_text" 
      	placeholder="Say something about this image..."></textarea>
  	</div>
  	<div>
  		<button type="submit" name="upload">POST</button>
  	</div>
  </form>
</div-->
<main id="about">

    <?php

        while ($row = mysqli_fetch_array($result1)){
        echo "<h1 class='lg-heading'>".$row['fname'] . "<span class='text-secondary'>"."  ".$row['lname']."</span></h1>";
        }
    ?>

<div class="about-info">    
    <form method="POST" action="upload.php" enctype="multipart/form-data"-->
    	
        <?php
        while ($row = mysqli_fetch_array($result)) {
        //echo "<div id='img_div'>";
      	echo "<img src='images/".$row['image']."'class='bio-image' >";
      	//echo "<p>".$row['image_text']."</p>";
        // echo "</div>";
         }
        ?>
        <input type="hidden" name="size" value="1000000">
  	    <input type="file" name="image">
        <button type="submit" name="upload" method="POST" action="upload.php" enctype="multipart/form-data">POST</button>
         </form>


     
    <div class="bio">
        
            <?php
             while ($row = mysqli_fetch_array($result1)) {
      
      	        //echo "<img src='images/".$row['about']."' >";
                //echo "<p><b>About Me:   <b>".$row['about']."</p>";
                
                echo "<p><b>Hobbies:    <b>".$row['hobbies']."</p>";
                 echo "<h3 class='text-secondary'>BIO</h3><p>".$row['bio']."</p>";
                echo "<p><b>GENDER:   <b>".$row['gender']."</p>";
                //echo "<p><b>Phone:     <b>".$row['pno']."</p>";
                //echo "<p><b>COUNTRY:    <b>".$row['country']."</p>";
                }
            ?>
    
    </div>
</div>
</main>
</body>
</html>