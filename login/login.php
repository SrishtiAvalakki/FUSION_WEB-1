<?php
require "github_login/init.php";
require "checkIfAlreadyLoggedIn.php";
?>
<!DOCTYPE html>
<html>

<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="github_login/bootstrap-social-links.css">
    <link rel="shortcut icon" type="image/png" href="../images/favicon.png"/>
</head>
<style>
    input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    
}

input[type=submit] {
    width: 40%;
    background-color: #4CAF50;
    color: white;
    padding: .375rem .75rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    line-height: 1.5;
    border-radius: .25rem;
     
}

  input[type=submit]:hover {
  background-color: #45a049;
}
 
div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.headingText {
    text-align: left;
    padding-left: 20px;
    font-family: 'Comic Sans MS'
}

body {
   /* background-color: #3598DC; */
   background-image: url(../bg-image.jpg);
   background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
    background-size: cover;
}

.outerBox {
    margin-left: 30%;
    margin-right: 30%;
    margin-top: 5%;
}

.loginLink {
    text-align: center;
    width: 100%;
    text-decoration: underline;    
}
</style>

<body>
    <div class="outerBox">
        <h1 class="headingText">Login</h1>
        <span style="text-align: center;padding-left: 20px;">Please fill in the form to create an account!</span>
        <div class="w3-col m6 w3-dark-grey w3-center">

            <form action="loginPage.php" method="POST">

                <input type="text" id="emailId" name="emailId" placeholder="Email ID">

                <input type="password" id="pass" name="password" placeholder="Password">

                <div class="container row" style="width:inherit;">
                    <input type="submit" value="Login with Email" class="signup col-sm" name="submit">

                    <a class="btn btn-block btn-social btn-github col-sm" 
                    style="color:white;width:40%;margin-left: 0.25rem" href="github_login/githubLogin.php">
                        <span class="fa fa-github" style="color:white;"></span>
                        Sign in with Github
                    </a>
                </div>
                <!--localhost-->
                <!-- <div class="g-recaptcha" data-sitekey="6LdKiHwUAAAAAJanuKKjNvd_GJlgH_fDGDrxdSIB"></div> -->
                <!-- <div class="g-recaptcha" data-sitekey="6LfJHXwUAAAAAKzyMdDRETNST_k5LHCOXXMwyQHO" data-callback="reCaptchad"></div> -->
                <!--docker-->
                 <div class="g-recaptcha" data-sitekey="6LfJHXwUAAAAAKzyMdDRETNST_k5LHCOXXMwyQHO"></div> 

            </form>

        </div>
        <span style="text-align: center ; width: 100% ; display: block">
            <a class="loginLink" href="../signup/signup.html">Create an account</a>
        </span>
    </div>
</body>

</html>