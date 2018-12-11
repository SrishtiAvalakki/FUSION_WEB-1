<!DOCTYPE html>
<?php
//require '../utils/checkAuthorisation.php'; 
?>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Group</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/png" href="../images/favicon.png"/>    
</head>
    <?php
         require('../login/loginPage.php');
         $userId= $_SESSION["userid"];
        $groupId=$_SESSION["groupid"];
        ?>
<body>
<div class="topnav" id="myTopnav">
		<div class="row">
			<div class="topic">
					<h1><b>ADD NEW GROUP</b></h1>
			</div>
		</div>
</div>
<div class="row">

<label class="label">Name of Group:</label>
<input class="input" type="text" id="groupName" name="groupTitle" placeholder="Text input" value="" required>
<br>
<label class="label">Group Type:</label>
<br>
<label>
    <input type="radio" name="isPrivate" value="Public" checked>Public</label>
<br>
<label><input type="radio" name="isPrivate" value="Private">Private</label>
<br>
<label class="label">Add Names:</label>
<br>
<?php
       require('../utils/connection.php');
       $displayNames="SELECT * FROM `users` where id != '$userId' and id!='0';";
       $result = $conn->query($displayNames);
       if ($result-> num_rows > 0) {
        foreach($result as $rows) {
          echo  '<input type="checkbox" value="'.$rows['username'].'" id="'.$rows['id'].'" name="members">
                <label>'.$rows['username'].'</label>';
          echo '<br>';
        }
    }
?>
<script>
    
$(document).ready(function() {
    $('#create_group').click(function() {
        var title = $('#groupName').val();
        var groupType = $("input[name='isPrivate']:checked").val();
        var usersGroup = "";
        $.each($("input[name='members']:checked"), function(){            
                usersGroup = $(this).attr('id');
                $.ajax({
                    url:'data.php',
                    data:{'title':title,'groupType':groupType,'usersgroup':usersGroup},
                    method:'post',
                    datatype:'text',
                    success:function(data){
                    // console.log(data);
                    }
                });
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
            });

    });
});
</script>
<button class="button is-link" id = 'create_group' name="Submit">Submit</button>
<a href="../admin.php" style="color:black"><u>Cancel</u></a>
</div>
</body>
</html>

