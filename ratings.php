<html>
<?php
session_start();
if(!isset($_SESSION['displayname']) || !isset($_SESSION['userid']) || !isset($_SESSION['groupid'])){
    session_destroy();
    $newURL = "login/login.html";
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
			<div class="sidenav">
           <script>
    $(document).ready(function(){
             
                    $.ajax({
                        url:'ratingsCalc.php',
                        method:'POST',
                        datatype:'text',
                        data:{"noOfGroups":"noOfGroups"},
                        
                        success:function(data){    
                           
                             var obj = JSON.parse(data);
                            // obj['name'].forEach(function(e){
                            //     str += "<a class = 'link' id ='"+e['id']+"'>"+e['name']+"</a>";
                            // });
                            
                            // $('.sidenav').html(str);
                            console.log(obj);
                            // $('.sidenav').html("<a class='inviteGroups'>INVITE GROUPS+</a>");
                            //location.href = "index.php";
                        }
                       
                    });
    });
                        </script>
            </div>
             <div class="chatDiv" style="margin-left:15%" id="chatDiv">
            </div>

        </div>
</body>
</html>