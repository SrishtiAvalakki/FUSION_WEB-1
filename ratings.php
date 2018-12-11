<html>
<?php
session_start();
if(!isset($_SESSION['displayname']) || !isset($_SESSION['userid']) || !isset($_SESSION['groupid'])){
    session_destroy();
    $newURL = "login/login.php";
    header('Location: '.$newURL);
}

?>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="styling.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    </head>
<body>
<div class="topnav" id="myTopnav">
						<div class="row" >
							<div class="topic">
								<a href="index.php" style="font-size: 17px; font-family: 'Comic Sans MS'">
									<b>FIND A ROOMIE</b>
								</a>
							</div>
						</div>
                        </div>
                        <div class="row">
			            <div id="star_rating">
                        <div class="chatDiv" id="chatDiv" style="margin:100px">
           <script>
    $(document).ready(function(){
                    $.ajax({
                        url:'ratingsCalc.php',
                        method:'POST',
                        datatype:'text',
                        data:{"noOfGroups":"noOfGroups"},
                        success:function(data){    
                           
                            var obj = JSON.parse(data);
                             var groups_ratings=(obj[1]/obj[0])*100;
                             var posts_ratings=(obj[3]/obj[2])*100;
                              str="<table><thead><tr><th>Category</th><th>Rating</th></tr></thead><tbody><tr class='groups_rating'><td>Based On Number Of Groups</td><td><div class='stars-outer'><div class='stars-inner' style='width:"+groups_ratings+"%'></div></div></td></tr><tr class='posts_rating'><td>Based On Number Of Posts</td><td><div class='stars-outer'><div class='stars-inner' style='width:"+posts_ratings+"%'></div></div></td></tr></tbody></table>";
                             $('.chatDiv').html(str);
                             
 
    
        
                          
                        }
                       
                    });
                    
    });
    
                        </script>
            </div>
            
            </div>

        </div>
</body>
</html>