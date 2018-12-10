<?php
        require '../utils/checkAuthorisation.php'; 
         require('../login/loginPage.php');
         require('../utils/connection.php');
         $userId= $_SESSION["userid"];
        $groupId=$_SESSION["groupid"];
        // var_dump($_POST);
        if(isset($_POST['submitmsg']))
        {
        $insertQuery = "INSERT INTO `messages`(`groupId`, `userId`, `text`, `sentTime`) 
         select usergroupmapping.groupId,'$userId','$_POST[usermsg]', now() from usergroupmapping 
         where usergroupmapping.groupId='$groupId' and usergroupmapping.userId='$userId';";
         $insertResult = $conn->query($insertQuery);
         echo $conn->error;
         $displayMessages=" select messages.text, messages.sentTime, users.displayName
         from messages, users
         where messages.userId = users.id
         and messages.groupid = ".$_SESSION["groupid"]."
         order by messages.sentTime;";
        $result = $conn->query($displayMessages);
        }
        ?>
<html>
<head>
    <title>Flat Design ChatBox</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
.fa {
    font-size: 25px;
    cursor: pointer;
    user-select: none;
}

.fa:hover {
  color: darkblue;
}
</style>
  <?php
        
        if(isset($_POST["likes"]))  {
          
            // echo $_POST["likes"];
            // require('../login/loginPage.php');
            // require('../login/loginPage.php');
            // echo $_SESSION["userid"];
            $msgId=$_POST["likes"];
            // echo $msgId;
            $updateLikes="UPDATE `messages` SET `likes`=`likes`+1 WHERE messages.id=$msgId;";
            $addQuery = "INSERT INTO `usermessagegrouplikes`(`userId`, `messageId`) VALUES ($userId,$msgId)"; 
            $addUserLikes="SELECT messages.id, if((SELECT COUNT(*) 
            from usermessagegrouplikes 
            where usermessagegrouplikes.userId = users.id
            and messageId = messages.id), \"TRUE\", \"FALSE\") as `AlreadyLiked?` from messages;"; 
            // $result = $conn->query($updateLikes);
            $resultQuery = $conn -> query($addQuery);
            // echo $result;
            if($resultQuery) {
                $result = $conn->query($updateLikes);
            }
           //  $result1 = $conn->query($addUserLikes);
            // echo $result1;
        }
        if(isset($_POST["dislikes"]))  {
            $msgId = $_POST["dislikes"];
            // echo $msgId;
            $updateLikes="UPDATE `messages` SET `likes`=`likes`-1 WHERE messages.id='$msgId';";  
            $addUserLikes="SELECT messages.id, if((SELECT COUNT(*) 
            from usermessagegrouplikes 
            where usermessagegrouplikes.userId = users.id
            and messageId = messages.id), \"TRUE\", \"FALSE\") as `AlreadyLiked?` from messages;"; 
           // $result = $conn->query($updateLikes);
            $deleteLike = "DELETE FROM `usermessagegrouplikes` WHERE `messageId`=$msgId and `userId`=$userId;";
            //  echo $result;
          //  $result1 = $conn->query($addUserLikes);
            $deleteResult = $conn -> query($deleteLike);
            if($deleteResult){
                $result = $conn->query($updateLikes);
            }
           // echo $result1;
        }
?>
</head>
<body>
    <div>
        <div class="ChatBox">
            <div>
        <?php 
      
        $displayMessages=" select messages.id, messages.text, messages.sentTime, users.displayName , messages.likes
        from messages, users
        where messages.userId = users.id
        and messages.groupid = ".$_SESSION["groupid"]."
        order by messages.sentTime;";
        $result = $conn->query($displayMessages);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['displayName'] == $_SESSION["displayname"]){
                    echo ' 
                    <div class ="other-message float-right messageCard">
                    <span class="time-right">'.$row['displayName'].'</span>
                    <span class="message-text" style="float:right;clear:right;" >'.htmlspecialchars($row['text']).'</span>
                    <span class="time-right" style = "clear:right;" >'.$row['sentTime'].'</span>
                    <form action = "" method ="POST">
                    <button name = "likes" value='.$row['id'].'>
                    <i style="padding: 10px;" class="fa fa-thumbs-up" value='.$row['id'].'></i>
                    </button>
                    <button name = "dislikes" value="'.$row['id'].'">
                    <i style="padding: 10px;" class="fa fa-thumbs-down" value="0"></i></button>'.$row['likes'].'
                    </form>
                    </div>
                    ';
                }
                else {
                    echo ' 
                <div class="messageCard float-left my-message">
                <span class="time-left">'.$row['displayName'].'</span>
                <span class="message-text" style="float:left;clear:left;" >'.htmlspecialchars($row['text']).'</span>
                <span class="time-left" style="clear:left;" >'.$row['sentTime'].'</span>
                <form action = "" method ="POST">
                    <button name = "likes" value="'.$row['id'].'">
                    <i style="padding: 10px;" class="fa fa-thumbs-up" value="1"></i>
                    </button>
                    <button name = "dislikes" value="'.$row['id'].'">
                    <i style="padding: 10px;" class="fa fa-thumbs-down" value="0"></i></button>'.$row['likes'].'
                    </button>
                    </form>
                </div>';
                    
                }
            }
        } else {
            echo "No Messages";
        }
        ?>
        </div>
            </div>
        <form name="message" class="messageForm" action="" method = "POST">
        <div>
            <textarea name="usermsg" style="width: 90%; height: 500px; float:left;" id="usermsg"></textarea>
            <input name="submitmsg" type="submit" class="btn btn-success btn-lg" id="submitmsg" value="Send" />
        </div>
        </form>
    </div>
</body>

</html>