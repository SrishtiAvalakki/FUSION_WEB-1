
<?php
require("./utils/connection.php");
require("./login/loginPage.php");
$userId= $_SESSION["userid"];
$groupId=$_SESSION["groupid"];

if(isset($_POST['group__id'])) {
     echo "success";
 
 }
if(isset($_GET['groupid'])) {
    $str="";
    //$rows = array();
    $groupIDs=$_GET['groupid'];
    $_SESSION["groupid"]=$groupIDs;
    $displayMessages="select groups.isArchived,messages.id,messages.groupId, messages.userId, messages.text, messages.sentTime, messages.likes, users.displayName, users.image from messages, users,groups where messages.userId = users.id and messages.groupid =$groupIDs and groups.id=$groupIDs order by messages.sentTime desc;";
    $result = $conn->query($displayMessages);
    $response=[];
    if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $response[] =$row;     
        }
        echo json_encode($response);
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
            $response['name'][] = $row;
        }
       
    }
    echo json_encode($response);
 }

 if(isset($_POST['msg'])) {
    
    $message = mysqli_real_escape_string($conn,$_POST['msg']);
    $insertQuery = "INSERT INTO `messages`(`groupId`, `userId`, `text`, `sentTime`) values ('$groupId','$userId','$message', now());";            
    $resultQuery = $conn -> query($insertQuery);   
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
    $comment = mysqli_real_escape_string($conn,$_POST['comment_msg']);
    if($comment!=NULL) {
    $insertComment="INSERT INTO `comments`(`messageId`, `text`, `sentTime`) VALUES ($messageId,\"$comment\",now());";
    $result1 = $conn->query($insertComment);
    
    }
    
}
if(isset($_POST["message_idInt"]))  {
    $mes=$_POST["message_idInt"];
    $displayComment="SELECT comments.id,messages.Id,users.displayName,comments.text,comments.sentTime,comments.likes FROM `comments`,`messages`,`users` where messages.id=comments.messageId and messages.userId=users.id and comments.messageId=$mes";
    $result1 = $conn->query($displayComment);
    if ($result1-> num_rows > 0) {
        $records=array();
        while($row = $result1->fetch_assoc()) {
             array_push($records,$row);
        }
       
    }
     echo json_encode($records);
    }
 ?>