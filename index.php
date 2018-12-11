<!DOCTYPE html>
<?php
require "getGravatar.php";
$_SESSION['2faAuth'] = 'true';

if(!isset($_SESSION['authSatisified'])) {
    header('Location: '.'login/login.php');
}
$userId=$_SESSION["userid"];
$groupId=$_SESSION["groupid"];
//$userId=4;
//echo "$userId";
include 'utils/ChromePhp.php';
if(!isset($_SESSION['displayname']) || !isset($_SESSION['userid']) || !isset($_SESSION['groupid']))
{
    $newURL = "login/login.php";
    header('Location: '.$newURL);
}
  // Create database connection
  $db = mysqli_connect("localhost", "admin", "monarchs", "roomies");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  
  if (isset($_POST['upload']))
   {
    $image = $_FILES['image'];
    $fileName =$_FILES['image']['name'];
    $fileTmpName =$_FILES['image']['tmp_name'];
    $fileSize =$_FILES['image']['size'];
    $fileError =$_FILES['image']['error'];
    $fileType =$_FILES['image']['type'];
    $fileExt =explode('.' , $fileName);
    $fileActualExt = strtolower(end($fileExt));


    // Get text
      $types = array('jpeg', 'gif', 'png', 'jpg','JPEG','JPG','PNG');
      $ftypes = array('pdf', 'docx', 'doc', 'ppt','xml','json');
     if (in_array($fileActualExt, $types))
       {
        $fileNameNew = "messageImage".$groupId.uniqid('',true).".".$fileActualExt;
        $fileDestination ='images/'.$fileNameNew;
        move_uploaded_file($fileTmpName,$fileDestination);
        // file is okay continue
        $sql = "INSERT INTO `messages`(`groupId`, `userId`, `text`, `sentTime`) values ('$groupId','$userId','$fileDestination', now());";            
        mysqli_query($db, $sql);
        header("Location:index.php");


        } 
    else
     {
        echo '<script language="javascript">';
        echo 'alert("image uploaded in the wrong format!")';
        echo '</script>';
       
        } 
        
        if (in_array($fileActualExt, $ftypes))
        {
         
 
         $fileNameNew = "messageFile".$groupId.uniqid('',true).".".$fileActualExt;
         $fileDestination ='images/'.$fileNameNew;
         move_uploaded_file($fileTmpName,$fileDestination);
         // file is okay continue
         $sql = "INSERT INTO `messages`(`groupId`, `userId`, `text`, `sentTime`) values ('$groupId','$userId','$fileDestination', now());";            
         mysqli_query($db, $sql);
         header("Location:index.php");
 
 
         } 
     else
      {
         echo '<script language="javascript">';
         echo 'alert("File Uploaded in the wrong format!")';
         echo '</script>';
        
         } 
    }
?>

<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<?php
//session_start();
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
        <link rel="shortcut icon" href="images/favicon.png" type="image/png"/>
        <title>HomePage</title>
        <style>
            .bio-image{
         height: 200px;
         width: 200px;
    border: 3px solid;

}
    </style>        
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
							<a href="newup.php">Profile</a>
                                <a href="groups/groups.php">Create Group</a>
                                <a href="contact_details.html">CONTACT US</a>
								<a href="help.html">HELP</a>
								<a href="logout/logout.php">Sign Out</a>
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
            $(document).on('click','.link',function(e) {
                var str1="<form action='index.php' method='POST' enctype='multipart/form-data'>"
                    +"<div style='margin:1%'>"
                         +"<textarea class='textbox' name='usermsg' style='float:left;' id='usermsg'></textarea>"
                             +"<input name='submitmsg' method='POST' action='index.php' type='submit' class='btn btn-success btn-lg' id='submitmsg'enctype='multipart/form-data' value='Send'/>"
                             +"<form method='POST' action='index.php' enctype='multipart/form-data'>"
                             +"<input type='file' name='image'>"
                             +"<button type='submit' name='upload' method='POST' action='index.php' enctype='multipart/form-data'>POST</button>"
                             +"</form>"
                     +"</div>"
               +"</form>";
                
                    var group_id = $(this).attr('id');
                    var str="";
                 $.ajax({
                        url:'groupmessages.php',
                        datatype:'text',
                        data:{"groupid":group_id},
                        success:function(data){
                            var JSONObject = JSON.parse(data);
                            var length = JSONObject.length;
                            for(var i=0;i<length;i++) {
                                
                            var obj = JSONObject[i];
                           
                            if(obj['displayName']!=null)
                            {
                                var image = obj['text'];
                                var displayName = "<?php echo $_SESSION['displayname'] ?>";
                                if (obj['displayName'] == displayName) {
                                    var gravatarURL = "<?php echo $_SESSION['gravatarURL'] ?>";
                                    console.log(gravatarURL);
                                    var ifgravatar = "<?php echo isset($_SESSION['gravatarURL'])?>";
                                    console.log(gravatarURL == '');
                                    console.log(ifgravatar != false);
                                    console.log(ifgravatar);
                                    if (ifgravatar != false) {
                                        obj['image'] = gravatarURL;
                                    }
                                }
                                result = image.match(/[^"\'=\s]+\.(jpg|png|jpeg)/);
                                if(result!=null){
                                    if(obj['isArchived']==='1'){
                                console.log("notarchived");
                               str+="<div class = message_"+obj['id']+"><br><div id='m_id"+obj['id']+"'value='"+obj['id']+"'><div class='container'>"
                                +"<div id='name_tag' style='margin:30px'>"
                                +"<div id='message_tag'>"
                                +"<img src="+"'"+obj['image']+"' alt='Avatar'>"
                                +"<b>"+obj['displayName']+"</b>:"
                                +"<p><sub>"+obj['sentTime']+"</sub></p>"
                                +"<a target='+_blank' href='"+obj['text']+"'><img src='"+obj['text']+"' style= 'height:200px; background-color:#f5f5f5;border:1px solid #ccc;max-width: 200px; border: 3px solid;border-radius: 0px;background-color:#f5f5f5;border:1px solid #ccc;'></a>"                               
                                +"<br><br>"
                                +"</div>"
                                +"</div>"
                                    +"<button id = 'likes' value="+obj['id']+"<i style='padding: 10px;' class='fa fa-thumbs-up' value="+obj['id']+"</i></button><button id = 'dislikes' value="+obj['id']+"<i style='padding: 10px;' class='fa fa-thumbs-down' value="+obj['id']+"</i></button>"+obj['likes']+"<button><i class='fa fa-comments-o comment' id='"+obj['id']+"' style='font-size:24px'></i>"
                                   +"<button class='show_messages' id='show_"+obj['id']+"'><label> show messages</label></button></button>"
                            +"</div>"
                            +"</div>"
                            +"</div>";
                           } else {
                            console.log("archived");
                          str+="<div class = message_"+obj['id']+"><br>"
                            +"<div id='m_id"+obj['id']+"'value='"+obj['id']+"'>"
                                +"<div class='container'>"
                                    +"<div id='name_tag' style='margin:30px'>"
                                        +"<div id='message_tag'>"
                                            +" <img src="+"'"+obj['image']+"' alt='Avatar' style='width:90%;'>"
                                                    +"<b>"+obj['displayName']+"</b>:"
                                                    +"<p><sub>"+obj['sentTime']+"</sub></p>"
                                                    +"<pre style='padding:10px'>"+obj['text']+ "</pre><br><br>"
                                            +"</div>"
                                        +"</div>"
                                    +"</div>"
                                +"</div>"
                            +"</div>";
                           }
                                }
                               else if(obj['text'].match(/[^"\'=\s]+\.(pdf|doc|docx)/)!=null){
                                    if(obj['isArchived']==='1'){
                             str+="<div class = message_"+obj['id']+"><br><div id='m_id"+obj['id']+"'value='"+obj['id']+"'><div class='container'>"
                                +"<div id='name_tag' style='margin:30px'>"
                                +"<div id='message_tag'>"
                                +"<img src="+"'"+obj['image']+"' alt='Avatar'>"
                                +"<b>"+obj['displayName']+"</b>:"
                                +"<p><sub>"+obj['sentTime']+"</sub></p>"
                                +"<a target='+_blank' href='"+obj['text']+"'>FileUploaded</a>"                               
                                +"<br><br>"
                                +"</div>"
                                +"</div>"
                                    +"<button id = 'likes' value="+obj['id']+"<i style='padding: 10px;' class='fa fa-thumbs-up' value="+obj['id']+"</i></button><button id = 'dislikes' value="+obj['id']+"<i style='padding: 10px;' class='fa fa-thumbs-down' value="+obj['id']+"</i></button>"+obj['likes']+"<button><i class='fa fa-comments-o comment' id='"+obj['id']+"' style='font-size:24px'></i>"
                                   +"<button class='show_messages' id='show_"+obj['id']+"'><label> show messages</label></button></button>"
                            +"</div>"
                            +"</div>"
                            +"</div>";
                           } else {
                          str+="<div class = message_"+obj['id']+"><br>"
                            +"<div id='m_id"+obj['id']+"'value='"+obj['id']+"'>"
                                +"<div class='container'>"
                                    +"<div id='name_tag' style='margin:30px'>"
                                        +"<div id='message_tag'>"
                                            +" <img src="+"'"+obj['image']+"' alt='Avatar' style='width:90%;'>"
                                                    +"<b>"+obj['displayName']+"</b>:"
                                                    +"<p><sub>"+obj['sentTime']+"</sub></p>"
                                                    +"<pre style='padding:10px'>"+obj['text']+ "</pre><br><br>"
                                            +"</div>"
                                        +"</div>"
                                    +"</div>"
                                +"</div>"
                            +"</div>";
                           }
                                }
                                else {
                                    if(obj['isArchived']==='1'){
                             str+="<div class = message_"+obj['id']+"><br><div id='m_id"+obj['id']+"'value='"+obj['id']+"'><div class='container'>"
                                +"<div id='name_tag' style='margin:30px'>"
                                +"<div id='message_tag'>"
                                +"<img src="+"'"+obj['image']+"' alt='Avatar' style='width:90%;'>"
                                +"<b>"+obj['displayName']+"</b>:"
                                +"<p><sub>"+obj['sentTime']+"</sub></p>"
                                +obj['text']
                                
                                +"<br><br>"
                                +"</div>"
                                +"</div>"
                                    +"<button id = 'likes' value="+obj['id']+"<i style='padding: 10px;' class='fa fa-thumbs-up' value="+obj['id']+"</i></button><button id = 'dislikes' value="+obj['id']+"<i style='padding: 10px;' class='fa fa-thumbs-down' value="+obj['id']+"</i></button>"+obj['likes']+"<button><i class='fa fa-comments-o comment' id='"+obj['id']+"' style='font-size:24px'></i>"
                                   +"<button class='show_messages' id='show_"+obj['id']+"'><label> show messages</label></button></button>"
                            +"</div>"
                            +"</div>"
                            +"</div>";
                           } else {
                       str+="<div class = message_"+obj['id']+"><br>"
                            +"<div id='m_id"+obj['id']+"'value='"+obj['id']+"'>"
                                +"<div class='container'>"
                                    +"<div id='name_tag' style='margin:30px'>"
                                        +"<div id='message_tag'>"
                                            +" <img src="+"'"+obj['image']+"' alt='Avatar' style='width:90%;'>"
                                                    +"<b>"+obj['displayName']+"</b>:"
                                                    +"<p><sub>"+obj['sentTime']+"</sub></p>"
                                                    +"<pre style='padding:10px'>"+obj['text']+ "</pre><br><br>"
                                            +"</div>"
                                        +"</div>"
                                    +"</div>"
                                +"</div>"
                            +"</div>";
                           }
                                }
                            
                            } else {
                                str+="<p>No messages</p>";
                                break;
                            }
                            }  
                            $('.chatDiv').html(str1); 
                            $('.chatDiv').append(str); 
                                            
                        }

                        
                });
            });
            $(document).on('click','#likes',function() {
                  var noOflikes = $("#likes").val();
                $.ajax({
                        url:'groupmessages.php',
                        method:'POST',
                        datatype:'text',
                        data:{"likes":noOflikes},
                         success:function(data){
                            console.log(data);
                        }
                });
            });
            $(document).on('click','#dislikes',function() {
                  var noOfDislikes = $("#dislikes").val();
                    $.ajax({
                        url:'groupmessages.php',
                        method:'POST',
                        datatype:'text',
                        data:{"dislikes":noOfDislikes},
                         success:function(data){
                            console.log(data);
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
                        }
                });
            });

            $(document).on('click','#upload',function() {
                 var text_value = $("#usermsg").val();
                console.log(text_value);
                    $.ajax({
                        url:'newup.php',
                        method:'POST',
                        datatype:'text',
                        data:{"msg":text_value},
                         success:function(data){
                             $('.chatDiv').append(data);
                        }
                });
            });

            $(document).on('click','.comment',function() {
                var id = $(this).attr('id'); 
                if(!($(this).hasClass('show1')))
                  { 
                    $('.message_'+id).append("<br><div class='form-group' id='messages'><form action='#' method='POST'><p><textarea class='form-control' style='width:10%; margin-left:20%' id="+id+" required></textarea><button type='submit' class='btn btn-default' id='submit_msg1' style='margin-left:30%'>Submit</button></p></form></div></div>");
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
                            }
                         }
                });
              });
              $(document).on('click','.show_messages',function() {
                  var mes_id=$(this).attr('id');
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
                          $('#m_id'+JSONObject[i]['Id']).append("<div class= 'container' ><div class = 'displayComments'>"+JSONObject[i]['text']+"<span> : <b>"+JSONObject[i]['displayName']+"</b></span>"+"</div></div>");
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
             <div class="chatDiv" style="margin-left:15%" id="chatDiv">
            </div>

        </div>
</body>
</html>
