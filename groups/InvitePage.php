<html>
<?php
session_start();
if(!isset($_SESSION['displayname']) || !isset($_SESSION['userid']) || !isset($_SESSION['groupid'])){
    session_destroy();
    $newURL = "../login/login.html";
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
								<a href="../index.php" style="font-size: 17px; font-family: 'Comic Sans MS'">
									<b>FIND A ROOMIE</b>
								</a>
							</div>
							<div class="tabs" style="float: right;">
							<a href="../login/login.html">Sign Out</a>
							</div>
						</div>
        </div>
        <div class="row">
        <div class="sidenav">
       <script>
        $(document).ready(function(){
                var str = "<br>";
                    $.ajax({
                        url:'userDetailsInvite.php',
                        method:'POST',
                        datatype:'text',
                        data:{"groups":"groups"},
                        
                        success:function(data){
                            console.log(data);    
                           if(data!=null){
                            var obj = JSON.parse(data);
                            
                            obj['name'].forEach(function(e){
                              
                                str += "<a class = 'nowAddUsers' id ='"+e['groupId']+"'>"+e['name']+"</a>";
                              
                            });
                          
                            $('.sidenav').html(str);
                            
                            //location.href = "index.php";
                        }
                        }
                       
                    });
                    $(document).on('click','.nowAddUsers',function() {
                     var id = $(this).attr('id');  
                    // console.log(id);
                    var str="";
                    $.ajax({
                        url:'userDetailsInvite.php',
                        method:'POST',
                        datatype:'text',
                        data:{"leftOutUser":id},
                         success:function(data){
                            console.log(data);
                             if(data!="\"No Users\"")
                             {
                                var JSONObject = JSON.parse(data);
                                console.log(JSONObject);
                                JSONObject['users'].forEach(function(e){
                                   str+="<div>"+e['username']+"<div class='addingUsersToGroup' id='"+e['id']+"'><i class='fa fa-plus' style='padding-left:15px;font-size:24px;color:green'></i></div>";
                                    });
                           }
                                   else {
                                       str+="<div>No Users</div>";
                                   }
                         
                         $('.usersDiv').html(str);
                         }
                        });
                        
                });
    
              $(document).on('click','.addingUsersToGroup',function() {
                     var id = $(this).attr('id');  
                    console.log("userId=",id);
                    //var str="";
                    $.ajax({
                        url:'userDetailsInvite.php',
                        method:'POST',
                        datatype:'text',
                        data:{"addUser":id},
                         success:function(data){
                            console.log("groupId",data);
                            // // var JSONObject = JSON.parse(data);
                            //  console.log(data);
                            //  var JSONObject = JSON.parse(data);
                            //  JSONObject['users'].forEach(function(e) {
                            //     str+="<div>"+e['username']+"<i class='fa fa-plus' style='padding-left:15px;font-size:24px;color:green'></i>"+"</div>";
                        // });
                        //  $('.usersDiv').html(str);
                         }
                });
              });
        });

</script>
            </div>
             <div class="usersDiv" style="margin-left:15%" id="chatDiv">
            </div>
        </div>
</body>
</html>