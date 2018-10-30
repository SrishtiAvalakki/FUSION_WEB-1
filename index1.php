<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['displayname']) || !isset($_SESSION['userid']) || !isset($_SESSION['groupid'])){
    $newURL = "login/login.html";
    header('Location: '.$newURL);
}
?>
<head>
    <title>HomePage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    /* h1 {
        background-image: url("../image.jpg");
    } */
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
        }

        .header {
            /* background-image: url("../image.jpg"); */
            /* background-image: url("image.webp"); */
            padding: 10px;
            text-align: center;

            background: #199a8d;
            color: white;
        }

        .header h1 {
            font-size: 50px;

        }

        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
        }

        .navbar a.right {
            float: right;
            background-color: #333;

        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            height: 50%;

        }

        .tab {
            float: left;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            width: 30%;
            height: 300px;
            top: 50px
        }

        /* Style the buttons inside the tab */
        .tab button {
            display: block;
            background-color: inherit;
            color: black;
            padding: 22px 16px;
            width: 100%;
            border: none;
            outline: none;
            text-align: left;
            cursor: pointer;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current "tab button" class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            float: left;
            padding: 0px 12px;
            border: 1px solid #ccc;
            width: 70%;
            border-left: none;
            height: 300px;
        }
    </style>
</head>

<body>

<?php
if(isset($_GET["Group"]))
{
    $_SESSION["groupid"] = $_GET["Group"];
}
?>
    <script>
        function openChat(evt, groupId) {
            var i, tabcontent, tablinks;
            var irame = document.getElementByName('chat')[0];
            irame.src = irame.src + "groupId="+groupId;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(groupName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
    </script>
    <div class="header">
        <h1>Find a Roomie</h1>
    </div>
    <div class="navbar">
        <a href="login/login.html" class="right">SignOut</a>
    </div>
    <div class="tab">
        <form action = "" method = "GET">
        <button class="tablinks" name = "Group" value = "1" onclick="openChat(event, '1')" id="defaultOpen" >Groups</button>

        <?php
            //session_start();
        
            require('utils/connection.php');
            
            $displayPrivateGroups="Select groups.name, groups.id 
            from users, groups, usergroupmapping
            where users.id = usergroupmapping.userId
            and usergroupmapping.groupId = groups.id
            and groups.name !='global'
            and userId = ".$_SESSION["userid"];
            $result = $conn->query($displayPrivateGroups);
            if ($result-> num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<button class="tablinks" name = "Group" value="'.$row['id'].'"
                    onclick="openChat(event, '.$row['id'].')">'.$row['name'].'</button>';
                }
            }
        ?>
        </form>
    </div>

    <div class="row">
        <iframe name="chat" src="chat/chat.php" style="width:150%;height:400px"></iframe>
    </div>
</body>

</html>