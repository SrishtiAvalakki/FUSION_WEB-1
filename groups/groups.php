<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Group</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="../styling.css">
    <style>
    body {
 background-color:#F9B975;

}
* {
    box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
    float: left;
    width: 33.33%;
    padding: 10px;
    height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
h1 {
    color:white;
    margin-left:450px;
    margin-right:400px;
    font-size:40px;
    font-family:Ariel;
}
#myTopnav {
    height:15%;
}
</style>
</head>
<body>
<div class="topnav" id="myTopnav">
		<div class="row">
			<div class="topic">
					<h1><b>ADD NEW GROUP</b></h1>
			</div>
		</div>
</div>
<div class="row">

  <div class="column">
  </div>
  <div class="column">
  <form action="" method="POST">
<div class="field">
  <label class="label">Name of Group:</label>
  <div class="control">
    <input class="input" type="text" placeholder="Text input" value="">
  </div>
</div>

<div class="field">
  <label class="label">Add Names</label>
  <div class="control">
 
    <div class="select">
      <select>

        <option>Select dropdown</option>
       
        <option id="users">
       <?php
       require('../utils/connection.php');
       $displayNames="SELECT username FROM `users`;";
       $result = $conn->query($displayNames);
       if ($result-> num_rows > 0) {
        foreach($result as $rows) {
          echo "<option>".$rows['username']."</option>";
        }
    }
    
       ?>
        
      </select>
    </div>
  </div>
</div>

<div class="field is-grouped">
  <div class="control">
    <button class="button is-link">Submit</button>
  </div>
  <div class="control">
    <a href="../index.php" style="color:black"><u>Cancel</u></a>
  </div>
  
</div>

<div id="content">
<?php 
include '../login/loginPage.php';
// require('../utils/connection.php');
$userId = $_SESSION["userid"];
$groupId = $_SESSION["groupid"];
echo $userId;
$displayUsers="select username from `users` where id=(SELECT id FROM `users` WHERE username like \"Tow Mater\");"; 
$result1 = $conn->query($displayUsers);
while($row1=mysqli_fetch_array($result1)){
  echo "<div id='user1'>";
  echo "<p>".$row1['username']."</p>";
  echo "</div>";
}
?>
</div>
</form>
  </div>
  
  
  <div class="column">
    
  </div>
  
</div>
</body>
</html>

