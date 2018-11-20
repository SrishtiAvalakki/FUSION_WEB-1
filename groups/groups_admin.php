<?php
require("../utils/connection.php");
require("../login/loginPage.php");
$userId= 0;
$groupId=$_SESSION["groupid"];
if(isset($_GET['groups'])) {
   
    $addGroup="select * from groups where id in (SELECT groupId FROM `usergroupmapping` where userId='$userId');";
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
 if(isset($_POST['groupid'])) {
   $groupIdno=$_POST['groupid'];
   //echo $groupId;
   $_SESSION["groupid"]=$groupIdno;
    $getUsers="select users.id,users.username from users where id!='0' and id in (select userid from usergroupmapping where groupId='$groupIdno');";
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
 }
 if(isset($_POST['id'])) {
    $groupID=$_POST['id'];
    $deleteMessage="delete from messages where groupId='$groupID'";
    $result1 = $conn->query($deleteMessage);
    $deleteJOIN="delete from usergroupmapping where groupId='$groupID'";
    $result2 = $conn->query($deleteJOIN);
    $deleteGroup="delete from groups where id='$groupID'";
    $result3 = $conn->query($deleteGroup);
    echo "success";
 }
 if(isset($_POST['user_id'])) {
    $userID=$_POST['user_id'];
    $deleteMessage="delete from messages where userId='$userID'";
    $result1 = $conn->query($deleteMessage);
    $deleteJOIN="delete from usergroupmapping where userId='$userID'";
    $result2 = $conn->query($deleteJOIN);
    $deleteGroup="delete from groups where userId='$userID'";
    $result3 = $conn->query($deleteGroup);
    echo "success";
 }
 if(isset($_POST['user'])) {
    $groupId=$_POST['user'];
   //echo $groupId;
    $getUsers="select id,username from users where id not in (select userId from usergroupmapping where groupId='$groupId');";
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
 
 if(isset($_POST['singleUser'])) {
    $newSingleUser=$_POST['singleUser'];
    $getUsers="INSERT INTO `usergroupmapping`(`userId`, `groupId`) VALUES ($newSingleUser,$groupId);";
    $result =  mysqli_real_escape_string($conn->query($getUsers));
    echo "adding";
//echo "success";
 }
 
 if(isset($_POST['archiveGroupId'])) {
     $archiveState=$_POST['archiveGroupId'];
    $changeArchiveMode="UPDATE groups SET isArchived = !isArchived WHERE id = '$archiveState';";
    $result = $conn->query($changeArchiveMode);
    $getGroups="select isArchived from groups where id='$archiveState';";
    $result1=$conn->query($getGroups);
    if ($result1-> num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            echo json_encode($row); 
        }
        
    }
    
 }
?>