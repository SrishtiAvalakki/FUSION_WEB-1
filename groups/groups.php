
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .header {
    padding: 50px;
    text-align: center;
    background: #1abc9c;
    color: white;
    }
    /* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 625px;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
    </style>
    <div class="header">
        <h1>ADD NEW GROUP</h1>
    <!-- <title>Add Group</title> -->
    </div>
    <br/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
			</div>
		</div>
</div>
<div class="row">
<center>
<label class="label"><h3>Name of Group:</h3></label>
<input class="input" type="text" id="groupName" name="groupTitle" placeholder="Text input" value="" required>
<br/>
<label class="label"><h3>Group Type:</h3></label>
<br>
<label class = "container">Public
    <input type="radio" checked = "checked" name="isPrivate" value="Public" checked ><span class="checkmark"></span></label>
<br>
<label class="container">Private
    <input type="radio" name="isPrivate" value="Private" checked><span class="checkmark"></span></label>
<!-- <br> -->

<label class="label"><h3>Add Names:</h3></label>
<?php
       require('../utils/connection.php');
       $displayNames="SELECT * FROM `users` where id != '$userId' and id!='0';";
       $result = $conn->query($displayNames);
       if ($result-> num_rows > 0) {
        foreach($result as $rows) {
          echo  '<input type="checkbox" value='.$rows['username'].' id="'.$rows['id'].'" name="members">
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
                //usersGroup.push($(this).attr('id'));
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
<a href="../index.php" style="color:black"><u>Cancel</u></a>
</center>
</div>
</body>
</html>

