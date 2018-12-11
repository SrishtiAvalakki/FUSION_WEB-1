<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>User Search</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
		<style>
main {
    padding: 4rem;
    min-height: 40px;
}
h1,h2,h3{
    margin:0;
    font-weight:400;
}
h1,lg-heading,
h2,lg-heading,
h3,lg-heading {
    font-size: 6rem;
}
h1,sm-heading,
h2,sm-heading,
h3,sm-heading {
    margin-bottom: 2rem;
    padding: 0.2rem 1rem;
    background: rgba(255,255,255,0.5);
}
.text-secondary{
    color: #3334ff;
}
.about-info {
      display: grid;
      grid-gap: 30px;
      grid-template-areas:'bioimage bio bio' 'job1 job2 job3';
      grid-template-columns: repeat(3,1fr);
      }

.about-info .bio-image{
    grid-area: bio-image;
    margin-top:0px;
    margin-left:10px;
    height: 200px;
    width: 200px;
    border: 3px solid;

}

.about-info .bio{
    grid-area: bio;
    font-size: 1.5rem;
}


.about-info .job-1{
    grid-area:job1;
}


.about-info .job-2{
    grid-area:job2;
}


.about-info .job-3{
    grid-area:job3;
}

.about-info .job{
    background: white;
    padding: 0.5rem;
    border-bottom: #3334FF 5px solid;

}
		</style>
	</head>

	<body class="bsearch">

	<nav class="navbar navbar-inverse" id="nav_bar">
                        <div class= "container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#"><b>FIND A ROOMIE</b></a>
                            </div>
                            <div class="nav navbar-nav navbar-right" id ="nav_list">
                                <a class="navbar-brand"href="profileedit.php"><span class="glyphicon glyphicon-user"></span>Edit My Profile</a>
                                <a class="navbar-brand" href="groups/groups.php">Create<span class="glyphicon glyphicon-cog"></span>Group</a>
                                <a class="navbar-brand" href="search.php"><span class="glyphicon glyphicon-search"></span>Search Users</a>
                                <a class="navbar-brand"href="logout/logout.php"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a>
                            </div>
                        </div>
                </nav>

		<div class="container">
			<br />
			<br />
			<br />
			<h2>Find your new Roomie here!</h2><br />
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
    $(document).on('click','.dp',function(){
    var id=$(this).attr('id');
        $.ajax({
            url:"up1.php",
            method:"post",
            data:{'userID': id},
            success:function(data)
            {
                    //console.log(data);
                    $('.bsearch').html(data);

            }
             });
        });

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




