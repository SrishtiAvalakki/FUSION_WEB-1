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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
<body>
<div class="topnav" id="myTopnav">
						<div class="row" style="height:30px;">
							<div class="topic">
								<a href="#" style="font-size: 17px; font-family: 'Comic Sans MS'">
									<b>FIND A ROOMIE</b>
								</a>
							</div>
							<div class="tabs" style="float: right;">
							<a href="up.php">Profile</a>
								<a href="groups/groups.php">Create Group</a>
								
								<a href="login/login.html">Sign Out</a>
							</div>
						</div>
        </div>
        <div class="row">
			<div class="sidenav">
           <script>
           $(document).ready(function(){
                var str = "<br>";
                    $.ajax({
                        url:'groupmessages.php',
                        method:'get',
                        datatype:'text',
                        data:{"groups":"groups"},
                        success:function(data){
                            var obj = JSON.parse(data);
                            obj['name'].forEach(function(e){
                                str += "<a class = 'link' id ='"+e['id']+"'>"+e['name']+"</a>";
                            });
                            $('.sidenav').html(str);
                        }
                    });
            $(document).on('click','.link',function() {
                    var group_id = $(this).attr('id');
                    var str="<div style='margin-left:1%;margin-top:1%'><textarea class='textbox' name='usermsg' style='float:left;' id='usermsg'></textarea><input name='submitmsg' type='submit' class='btn btn-success btn-lg' id='submitmsg' value='Send'/></div><div>";
                    $.ajax({
                        url:'groupmessages.php',
                        method:'get',
                        datatype:'text',
                        data:{"groupid":group_id},
                        success:function(data){
                            var obj = JSON.parse(data);
                            console.log(obj['text']);
                            console.log(data);
                            $('.chatDiv').html('<form class = "chat">'+str+"<br>"+data.replace(/\"/g, "")+'</form></div>');
                        }
                });
            });
            $(document).on('click','.btn btn-success btn-lg',function() {
                console.log($("#usrmsg").val());
                console.log(msg);
                    $.ajax({
                        url:'groupmessages.php',
                        method:'get',
                        datatype:'text',
                        data:{"msg":msg},
                        success:function(data){
                          console.log(data);
                        }
                });
            });
           });
    </script>
</select>
            </div>
             <div class="chatDiv" style="margin-left:15%">
            </div>
        </div>
        
</body>
</html>
