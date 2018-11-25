<?php
   $dbhost = "localhost";
   $dbuser = "admin";
   $dbpass = "monarchs";
   $dbname = "roomies";
         
 
   $conn = new mysqli($dbhost, $dbuser, $dbpass ,$dbname);
   /* $conn = new mysqli($servername, $username, $password);*/
         
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   /*mysql_select_db('roomies');*/
         
   /* Get total number of records from messages table */
   $sql = "SELECT count(id) FROM messages ";
   $retval = mysqli_query($conn,$sql);
   // $retval = $conn->query($sql);
   /* if ($conn->query($sql) === TRUE) {
   echo "Quary executed successfully";
   } else {
   echo "Error executing quary: " . $conn->error;
   }
   */
   if(! $retval ) {
      die('Could not get data: ' . mysqli_error());
   }
   $row = mysqli_fetch_array($retval );
   $rec_count = $row[0];
         
   if( isset($_GET{'page'} ) ) {
      $page = $_GET{'page'} + 1;
      $offset = $rec_limit * $page ;
   }
   else {
      $page = 0;
      $offset = 0;
   }
   
      
   // $left_rec = $rec_count - ($page * $rec_limit);
   $sql = "SELECT `id`, `text`, `sentTime`, `likes`
   FROM `messages` LIMIT 0,10";
            
   $retval = mysqli_query( $conn,$sql );
         
   if(! $retval ) {
      die('Could not get data: ' . mysqli_error());
   }
         
   while($row = mysqli_fetch_array($retval)) {
      echo "ID :{$row['id']}  <br> ".
      "Sent Time : {$row['sentTime']} <br> ".
      "Likes : {$row['likes']} <br> ".
      "Text : {$row['text']} <br> ".
      "--------------------------------<br>";
   }
         
   if( $page > 0 ) {
   $last = $page - 2;
   // echo "<a href = \"$_PHP_SELF?page = $last\">Last 10 Records</a> |";
   // echo "<a href = \"$_PHP_SELF?page = $page\">Next 10 Records</a>";
   }
   else if( $page == 0 ) {
   // echo "<a href = \"$_PHP_SELF?page = $page\">Next 10 Records</a>";
   }
   else if( $left_rec < $rec_limit ) {
   $last = $page - 2;
   // echo "<a href = \"$_PHP_SELF?page = $last\">Last 10 Records</a>";
   }
         
   mysqli_close($conn);
   ?>