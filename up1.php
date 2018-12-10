<!DOCTYPE html>
<?php
  
  $db = mysqli_connect("localhost", "admin", "monarchs", "roomies");
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error()); 
}

  if(isset($_POST["userID"]))
  {
  $dp_id=$_POST["userID"];
  $result = mysqli_query($db, "SELECT image FROM users  WHERE id='$dp_id'");
  $result1 = mysqli_query($db, "SELECT * FROM users where id='$dp_id'");
  $result2 = mysqli_query($db, "SELECT * FROM users where id='$dp_id'");
  $result3 = mysqli_query($db, "SELECT * FROM users where id='$dp_id'");
  $result4 = mysqli_query($db, "SELECT * FROM users where id='$dp_id'");
  $result5 = mysqli_query($db, "SELECT * FROM users where id='$dp_id'");
  
  }
?>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
    <link rel="stylesheet" href="styling.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      

</head>
<body class="b1">

				   <nav class="navbar navbar-inverse" id="nav_bar">
                        <div class= "container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="index.php"><b>FIND A ROOMIE</b></a>
                            </div>
                            <div class="nav navbar-nav navbar-right" id ="nav_list">
                                <a class="navbar-brand"href="profileedit.php"><span class="glyphicon glyphicon-user"></span>Edit My Profile</a>
                                <a class="navbar-brand" href="groups/groups.php">Create<span class="glyphicon glyphicon-cog"></span>Group</a>
                                <a class="navbar-brand" href="search.php"><span class="glyphicon glyphicon-cog"></span>Search Another Users</a>
                                <a class="navbar-brand"href="logout/logout.php"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a>
                            </div>
                        </div>
                </nav>
                <script>
    $(document).ready(function(){
                    $.ajax({
                        url:'ratingsCalc.php',
                        method:'POST',
                        datatype:'text',
                        data:{"noOfGroups":"noOfGroups"},
                        success:function(data)
			{
				console.log(data);
			}
                    });
                    
    });
    
    </script>
                
         <main id="about">

<?php

   while ($row = mysqli_fetch_array($result1)){
   echo "<h3 class='lg-heading'>User Name: ".$row['username'] . "<br><br><span class='text-secondary'> Display Name:"."  ".$row['displayName']."</span></h3>";
   if($row['about']===null) {
    $row['about']=null;
   }
   echo "<h3 class=sm-heading>About".$row['about']."</h3>";
   if($row['groups']===null){
       $row['groups']=0;
       $row['Posts']=0;
   };
   $str="<table><thead><tr><th>Category</th><th>Rating</th></tr></thead><tbody><tr class='groups_rating'><td>Based On Number Of Groups</td><td><div class='stars-outer'><div class='stars-inner' style='width:".$row['groups']."%'></div></div></td></tr><tr class='posts_rating'><td>Based On Number Of Posts</td><td><div class='stars-outer'><div class='stars-inner' style='width:".$row['Posts']."%'></div></div></td></tr></tbody></table>";
   echo $str;
   }
?>
 
                <div class="about-info">    
    <form  enctype="multipart/form-data">
    	
        <?php
        while ($row_img = mysqli_fetch_array($result))
         {
      	     echo "<img src='".$row_img['image']."' class='bio-image' alt='alt.png'>";
         }
        ?>
 
    </form>
   <div class="bio">
        
            <?php
             while ($rowd = mysqli_fetch_array($result2)) {
                echo "<h3 class='text-secondary'>BIO</h3>".$rowd['bio'];
                echo "<h3 class='text-secondary'>HOBBIES</h3>".$rowd['hobbies'];
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