<?php
require("./utils/connection.php");
require("./login/loginPage.php");
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];

if(isset($_GET['groupid'])) {
    $str="";
    $rows = array();
    $groupIDs=$_GET['groupid'];
    $_SESSION["groupid"]=$groupIDs;
    $displayMessages="select messages.id,messages.groupId, messages.userId, messages.text, messages.sentTime, messages.likes, users.displayName from messages, users where messages.userId = users.id and messages.groupid =$groupIDs order by messages.sentTime desc;";
    $result = $conn->query($displayMessages);
    if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] =$row;     
        }
        echo json_encode($rows);
    }
    else {
        echo json_encode("No Messages");
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

 if(isset($_POST['msg'])) {

    $message=$_POST['msg'];
    $insertQuery = "INSERT INTO `messages`(`groupId`, `userId`, `text`, `sentTime`) values ('$groupId','$userId','$message', now());";            
    $insertResult = $conn->query($insertQuery);       
    //echo "success";
    //echo "<script>alert()</script>";
    // echo "console.log('jgjkhk');";
    }

    if(isset($_POST['likes']))  {
        $msgId=$_POST["likes"];
        $updateLikes="UPDATE `messages` SET `likes`=`likes`+1 WHERE messages.id='$msgId';";
        $addQuery = "INSERT INTO `usermessagegrouplikes`(`userId`, `messageId`) VALUES ('$userId','$msgId');"; 
        $addUserLikes="SELECT messages.id, if((SELECT COUNT(*) 
        from usermessagegrouplikes 
        where usermessagegrouplikes.userId = users.id
        and messageId = messages.id), \"TRUE\", \"FALSE\") as `AlreadyLiked?` from messages;"; 
        $resultQuery = $conn -> query($addQuery);
        if($resultQuery) {
            $result=$conn->query($updateLikes);
        }
        echo "likes";
    }
    if(isset($_POST['dislikes']))  {
        $msgId = $_POST["dislikes"];
        $updateLikes="UPDATE `messages` SET `likes`=`likes`-1 WHERE messages.id='$msgId';";  
        $addUserLikes="SELECT messages.id, if((SELECT COUNT(*) 
        from usermessagegrouplikes 
        where usermessagegrouplikes.userId = users.id
        and messageId = messages.id), \"TRUE\", \"FALSE\") as `AlreadyLiked?` from messages;"; 
        $deleteLike = "DELETE FROM `usermessagegrouplikes` WHERE `messageId`='$msgId' and `userId`='$userId';";
        $deleteResult = $conn -> query($deleteLike);
        if($deleteResult){
            $result=$conn->query($updateLikes);
        }
        echo "dislikes";
  }
  if(isset($_POST["comment_msg"]))  {
    $messageId=$_POST['message_id'];
    $comment=$_POST['comment_msg'];
    echo $comment;
    if($comment!=NULL) {
    $insertComment="INSERT INTO `comments`(`messageId`, `text`, `sentTime`) VALUES ($messageId,\"$comment\",now());";
    $result1 = $conn->query($insertComment);
    $displayMessages="SELECT * FROM `comments` where messageId=$messageId;";
    $result = $conn->query($displayMessages);
    if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] =$row;     
        }
        echo json_encode($rows);
    }
    else {
        echo json_encode("No Messages");
    }
   // echo $result1;
    }
   
    
}
 ?>