<?php
require("./utils/connection.php");
require("./login/loginPage.php");
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];

if(isset($_GET['groupid'])) {
    $groupIDs=$_GET['groupid'];
    $_SESSION["groupid"]=$groupIDs;
    $displayMessages="select messages.groupId, messages.userId, messages.text, messages.sentTime, users.displayName from messages, users where messages.userId = users.id and messages.groupid =$groupIDs order by messages.sentTime;";
    $result = $conn->query($displayMessages);
    if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
    }
    else {
        echo json_encode("no Messages");
    }
 
 }
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

 if(isset($_GET['msg'])) {
    echo "success";
     }

 ?>