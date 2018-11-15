<?php
$connect = mysqli_connect("localhost", "root", "", "roomies");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM users 
	WHERE username LIKE '%".$search."%'
	";
	$result = mysqli_query($connect, $query);

//else{$query = "SELECT * FROM users ORDER BY id";}

if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>User Name</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["username"].'</td>
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