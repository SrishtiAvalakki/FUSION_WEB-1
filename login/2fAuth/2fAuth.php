<?php
session_start();



if(isset($_SESSION['2faAuth']) || isset($_SESSION['githubLogin']))
    if ($_SESSION['userid'] == '0') {
        header('Location: ../../admin.php');
    }
    else{
        header('Location: ../../index.php');
    }

    require 'Authenticator.php';
    $authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}
$QRCode = $authenticator->getQR('roomies', $_SESSION['auth_secret']);
?>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="2fAuth.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="../images/favicon.png" />
</head>

<body>
    <div class=" container align-middle vertical-center">
        <div class="row" style="height:100%;">
            <div class="col-sm-6 qr-wrapper">
                <div class="row" style="margin:20%;">
                    <img style="margin: 10%;" src=<?php echo $QRCode ?> />
                    <form action="check.php" method="POST" id="codeSubmitForm">
                        <input type="text" style="margin: 10%;" class="form-control" id="code" name="authenticatorCode">
                    </form>
                    <button style="margin: 10% 10% 10% 20%" type = "submit" form = "codeSubmitForm" class="learn-more">
                        <div class="circle">
                            <span class="icon arrow"></span>
                        </div>
                        <p class="button-text">Submit Code</p>
                    </button>
                </div>
            </div>
            <div class="col-sm-6">
                <object type="image/svg+xml" data="auth_illustration.svg">
            </div>
        </div>
    </div>
</body>