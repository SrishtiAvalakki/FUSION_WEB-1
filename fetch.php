<?php
$connect = mysqli_connect("localhost", "admin", "monarchs", "roomies");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM users 
	WHERE username LIKE '%".$search."%' && id!= 0 order by id 
    ";
    $result = mysqli_query($connect, $query); 

if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>User Name</th>
							<th> Profile Picture</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td ><p id ="'.$row["id"].'" class ="dp" > '.$row["username"].'</p></td>
				<td><img src= "'.$row['image'].'" class ="imgg" height="100px" width="100px"> </td>
			</tr>
		';
	}
    echo $output;
}
else
{
	echo 'Data Not Found';
}
}
?>