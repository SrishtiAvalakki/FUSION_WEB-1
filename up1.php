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
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">


<title>User Profile</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                                <a class="navbar-brand"href="login/login.php"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a>
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
   echo "<h3 class=sm-heading><p class='text-secondary'>About</p>".$row['about']."</h3>";
   if($row['groups']===null){
       $row['groups']=0;
       $row['Posts']=0;
   };
   $str="<table><thead><tr><th>Category</th><th>Rating</th></tr></thead><tbody><tr class='groups_rating'><td>Based On Number Of Groups</td><td><div class='stars-outer'><div class='stars-inner' style='width:".$row['groups']."%'></div></div></td></tr><tr class='posts_rating'><td>Based On Number Of Posts</td><td><div class='stars-outer'><div class='stars-inner' style='width:".$row['Posts']."%'></div></div></td></tr></tbody></table>";
   echo "<h3 class=sm-heading><p class='text-secondary'>Groups</p>".$str."</h3>";
   }
?>
 
                <div class="about-info">    
    <form  enctype="multipart/form-data">
    	
        <?php
        while ($row_img = mysqli_fetch_array($result))
         {
      	     echo "<img src='".$row_img['image']."' class='bio-image' >";
         }
        ?>
 
    </form>





     
    <div class="bio">
        
            <?php
             while ($rowd = mysqli_fetch_array($result2)) {
                echo "<h3 class='text-secondary'>BIO</h3><p>".$rowd['bio']."</p>";
                echo "<h3 class='text-secondary'>HOBBIES</h3><p>".$rowd['hobbies']."</p>";
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