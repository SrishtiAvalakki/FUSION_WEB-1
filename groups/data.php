<?php
 require('../login/loginPage.php');
require("../utils/connection.php");
$title = $_POST['title'];
$userGroup = $_POST['usersgroup'];
$groupType  = $_POST['groupType'];
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];
if($groupType==="Public") {
    $type = 0;
    }
    else {
        $type = 1;
     }
     $addGroup="INSERT INTO `groups`(`name`, `isPrivate`) VALUES ('$title','$type')";
     $result = $conn->query($addGroup);

     $addSessionUser="INSERT INTO `usergroupmapping`(`userId`,`groupId`) VALUES ('$userId',(SELECT `id` FROM `groups` WHERE `name` = '$title'));";
     $result2 = $conn->query($addSessionUser);

     $addUIDGID="INSERT INTO `usergroupmapping`(`userId`,`groupId`) VALUES ('$userGroup',(SELECT `id` FROM `groups` WHERE `name` = '$title'));";
    //  $groupUIDGID="INSERT INTO `usergroupmapping`(`userId`, `groupId`) VALUES ((SELECT id FROM `users` where username LIKE '$userGroup'),(SELECT `id` FROM `groups` WHERE `name` LIKE '$title'))";
    $result1 = $conn->query($addUIDGID);
     echo "success";
 ?>