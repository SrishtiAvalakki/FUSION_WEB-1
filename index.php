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
								<a href="search.php" style="font-size: 17px; font-family: 'Comic Sans MS'">
									<b>FIND A ROOMIE</b>
								</a>
							</div>
							<div class="tabs" style="float: right;">
							<a href="up.php">Profile</a>
								<a href="groups/groups.php">Create Group</a>
								<a href="help.html">Help</a>
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
                            // $('.sidenav').html("<a class='inviteGroups'>INVITE GROUPS+</a>");
                            //location.href = "index.php";
                        }
                       
                    });
            $(document).on('click','.link',function(e) {
                var str1="<form action='#' method='POST'><div style='margin:1%'><textarea class='textbox' name='usermsg' style='float:left;' id='usermsg'></textarea><input name='submitmsg' type='submit' class='btn btn-success btn-lg' id='submitmsg' value='Send'/></div></form>";
                             $('.chatDiv').html(str1);
                    var group_id = $(this).attr('id');
                   
                 $.ajax({
                        url:'groupmessages.php',
                        datatype:'text',
                        data:{"groupid":group_id},
                        success:function(data){

                            var JSONObject = JSON.parse(data);
                            var length = JSONObject.length;
                            for(var i=0;i<length;i++) {
                            var obj = JSONObject[i];
                            if(obj['displayName']!=null){
                            $('.chatDiv').append("<div class = message_"+obj['id']+"><br></div><div id='m_id"+obj['id']+"'value='"+obj['id']+"'></div><div class='container'><div id='name_tag'><div id='message_tag'></div><img src='bg-image.jpg' alt='Avatar' style='width:90%;'><b>"+obj['displayName']+"</b>:<pre>"+obj['text']+ "</pre><br/><p><small><sub>"+obj['sentTime']+"</sub></small></p></div><br/><button id = 'likes' value="+obj['id']+"<i style='padding: 5px;margin-left:5px;margin-top:5px' class='fa fa-thumbs-up' value="+obj['id']+"</i></button><button id = 'dislikes' value="+obj['id']+"<i style='padding: 5px;margin-left:5px;margin-top:5px;' class='fa fa-thumbs-down' value="+obj['id']+"</i></button>"+obj['likes']+"<button><i class='fa fa-comments-o comment' id='"+obj['id']+"' style='font-size:24px;padding:0px;margin-right:5px;margin-bottom:5px'></i><button class='show_messages' id='show_"+obj['id']+"'><label> Show Messages</label></button></button></div></div></div><br/><br/>");
                           } else {
                            $('.chatDiv').append("<p><br/>"+"No Messages"+"</p>");
                            break;
                           }
                            }                        
                        }

                        
                });
            });
            $(document).on('click','#likes',function() {
                  var noOflikes = $("#likes").val();
                //console.log(noOflikes);
                    $.ajax({
                        url:'groupmessages.php',
                        method:'POST',
                        datatype:'text',
                        data:{"likes":noOflikes},
                         success:function(data){
                            console.log(data);
                             //location.reload();
                             //window.location.reload();
                        }
                });
                // alert(text_value);
            });
            $(document).on('click','#dislikes',function() {
                  var noOfDislikes = $("#dislikes").val();
                // console.log(text_value);
                    $.ajax({
                        url:'groupmessages.php',
                        method:'POST',
                        datatype:'text',
                        data:{"dislikes":noOfDislikes},
                         success:function(data){
                            console.log(data);
                             //location.reload();
                             //window.location.reload();
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

            $(document).on('click','.comment',function() {
                var id = $(this).attr('id'); 
                if(!($(this).hasClass('show1')))
                  { 
                    $('.message_'+id).append("<br><div class='form-group' id='messages'><form action='#' method='POST'><p><textarea class='form-control' style='width:10%; margin-left:20%; margin-top: 5px' id="+id+" required></textarea><button type='submit' class='btn btn-default' id='submit_msg1' style='margin-left:30%'>Submit</button></p></form></div></div>");
                    $(this).addClass('show1');
                  } else {
                      $('.form-group').hide();
                      $(this).removeClass('show1');
                  } 
            });
            
            $(document).on('click','#submit_msg1',function() {
                
                var id = $(".form-control").attr('id');  
                var text_val=$(".form-control").val();
                $.ajax({
                        url:'groupmessages.php',
                        method:'POST',
                        datatype:'text',
                        data:{"comment_msg":text_val,"message_id":id},
                         success:function(data){
                            console.log("hello -- ksjfkls");
                            var JSONObject = JSON.parse(data);
                            var length = JSONObject.length;
                            for(var i=0;i<length;i++) {
                            var obj = JSONObject[i];
                            // console.log(obj['text']);
                            //console.log(obj['id']);
                        
                           
                            }
                         }
                });
              });
              $(document).on('click','.show_messages',function() {
                  var mes_id=$(this).attr('id');
                  //$(this).addClass('show');
                  if(!($(this).hasClass('show')))
                  {
                  var message_idInt=parseInt(mes_id.split('_')[1]);
                  $.ajax({
                        url:'groupmessages.php',
                        method:'POST',
                        datatype:'JSON',
                        data:{"message_idInt":message_idInt},
                        success:function(data){
                            var JSONObject = JSON.parse(data);
                            var length = Object.keys(JSONObject).length;
                            for(var i=0;i<length;i++) {
                                console.log(JSONObject[i]);
                          $('#m_id'+JSONObject[i]['Id']).append("<div class = 'displayComments'>"+JSONObject[i]['text']+JSONObject[i]['displayName']+"</div>");
                        }
                    }
                }); 
                $(this).addClass('show');
                  }else{
                      $('.displayComments').hide();
                      $(this).removeClass('show');
                  } 


              });
           });
    </script>
</select>
            </div>
             <div class="chatDiv" style="margin-left:15%; margin-top:5px" id="chatDiv">
            </div>

        </div>
</body>
</html>
