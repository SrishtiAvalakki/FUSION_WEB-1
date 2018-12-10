<?php

session_start();

if (isset($_SESSION['githubLogin'])) {
    $username = $_SESSION['githubUsername'];
    $gravatarURL = 'https://github.com/'.$username.'.png?size=400';
    $_SESSION['gravatarURL'] = $gravatarURL;
}

?>