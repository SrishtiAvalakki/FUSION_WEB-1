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
    </head>
<body>
<div class="topnav" id="myTopnav">
						<div class="row" >
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
                            
                            //location.href = "index.php";
                        }
                       
                    });
            $(document).on('click','.link',function(e) {
                var str1="<form action='#' method='POST' id='insert_message'><div style='margin:1%'><textarea class='textbox' name='usermsg' style='float:left;' id='usermsg'></textarea><input name='submitmsg' type='submit' class='btn btn-success btn-lg' id='submitmsg' value='Send'/></div></form>";
                             $('.chatDiv').html(str1);
                // location.reload();
                    var group_id = $(this).attr('id');
                   
                 $.ajax({
                        url:'groupmessages.php',
                        datatype:'text',
                        data:{"groupid":group_id},
                        success:function(data){
                             console.log(data);
                            var JSONObject = JSON.parse(data);
                            var length = JSONObject.length;
                            for(var i=0;i<length;i++) {
                            var obj = JSONObject[i];
                            //console.log(obj['text']);
                            $('.chatDiv').append("<br><div class='container'><div id='name_tag'><div id='message_tag' required><img src='images/IMG_0812.jpg' alt='Avatar' style='width:90%;'><p><b>"+obj['displayName']+"</b>:"+obj['text']+ "</p><span class='time-right'></div></span>"+obj['likes']+"</div>"+obj['sentTime']+"</div>");
                           
                         }
                        //  $('.chatDiv').append(str+"<br><div class='container'><div id='name_tag'><div id='message_tag'><img src='images/IMG_0812.jpg' alt='Avatar' style='width:90%;'><p>"+obj['text']+"</p><span class='time-right'></div>"+obj['sentTime']+"</span></div></div>");
                        //location.reload();
                        
                        }
                        
                });
            });
            $(document).on('click','#submitmsg',function() {
                 var text_value = $("#usermsg").val();
                console.log(text_value);
                    $.ajax({
                        url:'groupmessages.php',
                        method:'POST',
                        datatype:'text',
                        data:{"msg":text_value},
                         success:function(data){
                             $('.chatDiv').append(data);
                             //location.reload();
                             //window.location.reload();
                        }
                });
            });
           });
    </script>
</select>
            </div>
             <div class="chatDiv" style="margin-left:15%" id="chatDiv">
            </div>
        </div>
</body>
</html>
