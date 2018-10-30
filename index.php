<html>
<?php
session_start();
if(!isset($_SESSION['displayname']) || !isset($_SESSION['userid']) || !isset($_SESSION['groupid'])){
    $newURL = "login/login.html";
    header('Location: '.$newURL);
}
?>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="styling.css">
			</head>
			<body>
			<?php
if(isset($_GET["groups"]))
{
	$_SESSION["groupid"] = $_GET["groups"];
	
}

?>
				<div class="topnav" id="myTopnav">
						<div class="row" style="height:30px;">
							<div class="topic">
								<a href="#" style="font-size: 17px; font-family: 'Comic Sans MS'">
									<b>FIND A ROOMIE</b>
								</a>
							</div>
							<div class="tabs" style="float: right;">
								<a href="profile.php">Edit Profile</a>
								<a href="groups/groups.php">Create Group</a>
								
								<a href="login/login.html">Sign Out</a>
							</div>
						</div>
        </div>
        		
		  <div class="row">
						<div class="sidenav">
							
						<!-- <form action="" method = "GET"> -->
						<?php
								function publicDisplay(){
  									require('utils/connection.php');
										$displayPublicGroups="SELECT name FROM `groups` WHERE id=1;";
										$result = $conn->query($displayPublicGroups);
										if ($result-> num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													echo $row['name'];
												}
										}
										echo "<hr>";
									} 
									function privateDisplay(){
										require('utils/connection.php');
										  $displayPrivateGroups="Select groups.name, groups.id 
										  from users, groups, usergroupmapping
										  where users.id = usergroupmapping.userId
										  and usergroupmapping.groupId = groups.id
										  and groups.name !='global'
										  and userId = ".$_SESSION["userid"];
										  $result = $conn->query($displayPrivateGroups);
										  if ($result-> num_rows > 0) {
												  while($row = $result->fetch_assoc()) {
													  echo $row['name']."</br>";
												  }
										  }
										  echo "<hr>";
									  } 
									// display();
							

						?>
						<script>
							function displayPublic() {
								var phpadd = "<?php publicDisplay();?>"; 
								//console.log(phpadd);
								document.getElementById("publicgroupid").innerHTML=phpadd;
								}
								function displayPrivate() {
								var phpadd1 = "<?php privateDisplay();?>"; 
								//console.log(phpadd);
								document.getElementById("privategroupid").innerHTML=phpadd1;
								}
								
							// document.getElementById("groups").click();
						</script>
						<button class="dropdown-btn" name = "groups" onclick="displayPublic()" id="groups" style="background-color:#FFA646">Public Groups</button>
						<button class="dropdown-btn" id="publicgroupid" ></button>
						<button class="dropdown-btn" name = "groups" onclick="displayPrivate()" id="groups" style="background-color:#FFA646">Private Groups</button>
						<button class="dropdown-btn" id="privategroupid"></button>
						</div>
				<div class="column_right">
				 <iframe name="chat" src="chat/chat.php" style="width:100%;height:100%"></iframe> 
				</div>
			
          </div>
		 </body>
	</html>