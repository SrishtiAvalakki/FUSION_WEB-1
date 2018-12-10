<?php
require("./utils/connection.php");
require("./login/loginPage.php");
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];

if(isset($_POST['noOfGroups'])) {
   $noOfGroups="select count(groups.id) from groups;";
   $totalnoOfGroups="select count(usergroupmapping.groupId) from usergroupmapping where usergroupmapping.userId='$userId'";
   $result = $conn->query($noOfGroups);
   if ($result-> num_rows > 0) {
      while($row = $result->fetch_assoc()) {
         $groupsNo=$row['count(groups.id)'];
         $response[] =$row['count(groups.id)'];     
      }
     
  }
  $result1 = $conn->query($totalnoOfGroups);
  if ($result1-> num_rows > 0) {
   while($row = $result1->fetch_assoc()) {
       $response[] =$row['count(usergroupmapping.groupId)'];   
       $totalNo= $row['count(usergroupmapping.groupId)']; 
   }
  
}
$groups=($totalNo/$groupsNo)*100;
$updateGroups="UPDATE users SET groups='$groups' WHERE id='$userId'";
$result5 = $conn->query($updateGroups);

$totalnoOfPosts="select count(messages.id) from messages;";
$noOfPosts="select count(messages.id) from messages where userId='$userId';";
$result2 = $conn->query($noOfPosts);
if ($result2-> num_rows > 0) {
   while($row = $result2->fetch_assoc()) {
      $NoOfPosts=$row['count(messages.id)'];
      $response[] =$row['count(messages.id)'];     
   }
  
}
$result3 = $conn->query($totalnoOfPosts);
if ($result3-> num_rows > 0) {
   while($row = $result3->fetch_assoc()) {
      $totalNoPosts=$row['count(messages.id)'];
      $response[] =$row['count(messages.id)'];     
   }
  
}
$posts=($NoOfPosts/$totalNoPosts)*100;

//echo $NoOfPosts."--".$posts."---".$totalNoPosts;
  echo json_encode($response);
}
?>
