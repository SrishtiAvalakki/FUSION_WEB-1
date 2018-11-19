<?php
include('db.php');
 
$limit = 10;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT `id`, `text`, `sentTime`, `likes`
FROM `messages` LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  
 
while ($row = mysqli_fetch_assoc($rs_result)) {
    echo "{$row['id']}  <br> ".
    "{$row['sentTime']} <br> ".
    "{$row['likes']} <br> ".
    "{$row['text']} <br> ".
    "<br>";
 }
?>  
    