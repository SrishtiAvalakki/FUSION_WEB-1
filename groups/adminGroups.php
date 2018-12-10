<?php
//require '../utils/checkAuthorisation.php'; 
?>
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
    </head>
<body>
<div class="topnav" id="myTopnav">
						<div class="row" >
							<div class="topic">
								<a href="../admin.php" style="font-size: 17px; font-family: 'Comic Sans MS'">
									<b>FIND A ROOMIE</b>
								</a>
							</div>
							<div class="tabs" style="float: right;">
						
								<a href="../login/login.php">Sign Out</a>
							</div>
						</div>
        </div>
        <div class="row">
			<div class="sidenav">
            </div>
        <script>

       $(document).ready(function(){
                var str = "<br>";
                    $.ajax({
                        url:'groups_admin.php',
                        method:'get',
                        datatype:'text',
                        data:{"groups":"groups"},
                        
                        success:function(data){    
                           if(data!=null){
                            var obj = JSON.parse(data);
                            obj['name'].forEach(function(e){
                              
                                str += "<a class = 'link1' id ='"+e['id']+"'>"+e['name']+"</a><div class='deleteGroup' id='"+e['id']+"'><i class='fa fa-trash-o' style='padding-left:15px;font-size:24px;color:red'></i></div><div class='archiveGroup' id='"+e['id']+"'><i class='fa fa-archive' style='padding-left:15px;font-size:24px;color:#1e90ff'></i></div>";
                                
                            });
                            
                            $('.sidenav').html(str);
                            
                            //location.href = "index.php";
                        }
                        }
                       
                    });
                    
                    $(document).on('click','.archiveGroup',function() {
                var archiveGroupId = $(this).attr('id'); 
                //console.log(archiveGroupId);
               $.ajax({
                    url:'groups_admin.php',
                    datatype:'text',
                    method:'POST',
                    data:{"archiveGroupId":archiveGroupId},
                    success:function(data){
                       
                         var obj = JSON.parse(data);
                         console.log(obj['isArchived']);
                         if(obj['isArchived']==='0') {
                             alert("Archived");
                         }
                         else {
                            alert("unarchived");
                         }
                        // obj['users'].forEach(function(e){
                        //     console.log(e);
                        //     });
                            
                        //     // $('.sidenav').html(str);
                            
                        //     //location.href = "index.php";
                        // }
                    }
                });
            });
            $(document).on('click','.deleteGroup',function() {
                var id = $(this).attr('id'); 
                console.log(id);
               $.ajax({
                    url:'groups_admin.php',
                    datatype:'text',
                    method:'POST',
                    data:{"id":id},
                    success:function(data){
                    console.log(data);
                    }
                });
            });
            $(document).on('click','.link1',function() {
                    var group_id = $(this).attr('id');
                   //console.log(group_id);
                 $.ajax({
                        url:'groups_admin.php',
                        datatype:'text',
                        method:'POST',
                        data:{"groupid":group_id},
                        success:function(data){
                            var obj = JSON.parse(data);
                            var str = "";
                            //str+="<select>";
                               obj['users'].forEach(function(e){
                                     str+="<div>"+e['username']+"</div><div class='deleteUser' id='"+e['id']+"'><i class='fa fa-trash-o' style='padding-left:15px;font-size:24px;color:red'></i></div><br/>";
                                }); 
                          $('.chatDiv1').html(str+"<button id="+group_id+" class='AddUsers'>Add users</button><div class='displayNewUsers'></div>");
                                         
                        }
            });
            });
            $(document).on('click','.AddUsers',function() {
                var user = $(this).attr('id'); 
                console.log(user);
               $.ajax({
                    url:'groups_admin.php',
                    datatype:'text',
                    method:'POST',
                    data:{"user":user},
                    success:function(data){
                        console.log(data);
                        var obj = JSON.parse(data);
                        var str = "";
                        obj['users'].forEach(function(e){
                            str+="<div>"+e['username']+"</div><div class='addSingleUser' id='"+e['id']+"'><i class='fa fa-plus' style='padding-left:15px;font-size:24px;color:green'></i></div><br/>";
                                }); 
                            $('.displayNewUsers').html(str);
                            }
                    });

                });
        $(document).on('click','.addSingleUser',function() {
                var singleUser = $(this).attr('id'); 
                //console.log(singleUser);
               $.ajax({
                    url:'groups_admin.php',
                    datatype:'text',
                    method:'POST',
                    data:{"singleUser":singleUser},
                    success:function(data){
                   //console.log(data);
                    }
                });
            });
            $(document).on('click','.deleteUser',function() {
                var user_id = $(this).attr('id'); 
                //console.log(user_id);
               $.ajax({
                    url:'groups_admin.php',
                    datatype:'text',
                    method:'POST',
                    data:{"user_id":user_id},
                    success:function(data){
                    //console.log(data);
                    }
                });
            });
                    });
        </script>

             <div class="chatDiv1" style="margin-left:15%" id="chatDiv">
            </div>
        </div>
        </html>