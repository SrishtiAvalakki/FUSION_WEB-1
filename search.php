<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>User Search</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
	</head>
	<body>
	<nav class="navbar navbar-inverse" id="nav_bar">
						<div class= "container-fluid">
							<div class="navbar-header">
								<a class="navbar-brand" href="index.php"><b>FIND A ROOMIE</b></a>
							</div>
							<div class="nav navbar-nav navbar-right" id ="nav_list">
								<a class="navbar-brand"href="profileedit.php"><span class="glyphicon glyphicon-user"></span>Edit Profile</a>
								<a class="navbar-brand" href="groups/groups.php">Create<span class="glyphicon glyphicon-cog"></span>Group</a>
								
								<a class="navbar-brand"href="login/login.html"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a>
							</div>
						</div>
     </nav>
		<div class="container">
			<br />
			<br />
			<br />
			<h2 style="align:center">Find your new Roomie here!</h2><br />
			<div class="form-group">
				<div class="input-group">
			
					<span class="input-group-addon" id="display_noUsers">Search</span>
				
					<input type="text" name="search_text" id="search_text" placeholder="Search by User Name" class="form-control" />
				</div>
			</div>
			<br />
            <div id="result"></div>
		</div>
		<div style="clear:both"></div>
		<br />
		
		<br />
		<br />
		<br />
	</body>
</html>


<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch.php",
			method:"post",
			data:{query:query},
			datatype:'JSON',
			success:function(data)
			{
				console.log(data);
				if(data!= null) {
				var JSONObject = JSON.parse(data);
            	console.log(JSONObject['id']);
				$('#result').html("<div class='names' id=name_id"+JSONObject['id']+">"+JSONObject['displayName']+"</div>");
			}
			else if(data==="No Users"){
				$('#result').html("<p>"+"No Messages"+"</p>");
			}
			}
		});
		
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
$(document).on('click','.names',function() {
	var id = $(this).attr('id'); 
	var userdetailsID=parseInt(id.split('id')[1]);
	//console.log(userdetailsID);
                 $.ajax({
                        url:'fetch.php',
                        datatype:'text',
						method:'POST',
                        data:{"userdetailsID":userdetailsID},
						success:function(data)
						{
							if(data!="No Users") {
							var JSONObject = JSON.parse(data);
            				//console.log(JSONObject['id']);
							$('#result').append("<div class='names' id=name_id"+JSONObject['id']+">"+JSONObject['displayName']+"<br>Email:"+JSONObject['emailId']+JSONObject['about']+JSONObject['hobbies']+"</div>");
							} 
							else
							{
								$('#display_noUsers').append("<p>"+data+"</p>");
							}
						}
                });
            });
</script>


