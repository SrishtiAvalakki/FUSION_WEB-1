<?php
require("./utils/connection.php");
require("./login/loginPage.php");
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];

if(isset($_POST['noOfGroups'])) {
   $noOfGroups="select count(groupId) from messages where userId=$userId";
   $result = $conn->query($noOfGroups);
echo json_encode($result);

}
?>
