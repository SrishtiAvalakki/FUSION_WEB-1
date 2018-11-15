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
			<h2 align="center">Find your new Roomie here!</h2><br />
			<div class="form-group">
				<div class="input-group">
			
					<span class="input-group-addon">Search</span>
				
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
			success:function(data)
			{
				$('#result').html(data);
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
</script>




