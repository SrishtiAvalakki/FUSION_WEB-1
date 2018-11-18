<?php
require("./utils/connection.php");
if(isset($_POST["query"]))
{	
	$search=mysqli_real_escape_string($conn,$_POST["query"]);
	$query = "SELECT * FROM users WHERE username LIKE '%".$search."%' and id!='0';";
	$result = $conn->query($query);
	if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
       
	}
	else {
		echo "No Users";
	}
}
if(isset($_POST["userdetailsID"])){
	$u_Id=$_POST["userdetailsID"];
	$query = "SELECT * FROM users WHERE id=$u_Id and id!='0'";
	$result = $conn->query($query);
	if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
       
	}
	else {
		echo json_encode($records);
	}
}
?>