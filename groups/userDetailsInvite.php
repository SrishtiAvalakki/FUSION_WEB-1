<?php
require("../utils/connection.php");
require("../login/loginPage.php");
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];

if(isset($_POST['groups'])) {
   echo $groupId;
  //  $_SESSION["groupid"]=$_POST['groups'];
    $addGroup="select * from groups, usergroupmapping where usergroupmapping.userId='$userId' and groups.id=usergroupmapping.groupId";
    $result = $conn->query($addGroup);
    $response = [];
    if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // $str=$row['name'];

            $response['name'][] = $row;
        }
       
    }
    echo json_encode($response);
 }
 if(isset($_POST['leftOutUser'])) {
    $groupsss=$_POST['leftOutUser'];
   //echo $groupsss;
    $getUsers="select id,username from users where id NOT IN (select userId from usergroupmapping where groupId='$groupsss');";
    $result = $conn->query($getUsers);
    if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows['users'][] =$row;     
        }
        echo json_encode($rows);
    }
    else {
        echo json_encode("No Users");
    }
//echo "success";
 }
 
 if(isset($_POST['addUser'])) {
    $userId=$_POST['addUser'];
   echo $groupId;
   $getUsers="INSERT INTO `usergroupmapping`(`userId`, `groupId`) VALUES ($userId,$groupId);";
   $result = $conn->query($getUsers);
  // echo "success";
//echo "success";
 }
 ?>