<?php
session_start();
function goToAuthURL()
{
    $clientId = "a62bb872973626a835c4";
    $redirectUrl = "http://svara001.cs518.cs.odu.edu/callback.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $constructedUrl = 'https://github.com/login/oauth/authorize?client_id=' . $clientId . "&redirect_url=" . $redirectUrl . "&scope=user";
        header("location: $constructedUrl");
    }
}

function getData()
{
    $clientId = "a62bb872973626a835c4";
    $redirectUrl = "http://svara001.cs518.cs.odu.edu/callback.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $post = http_build_query(array(
                'client_id' => $clientId,
                'redirect_url' => $redirectUrl,
                'client_secret' => 'f11db38c7a83fb28e6862c7d5d1e9a6910ba37b6',
                'code' => $code,
            ));
        }

        $accessData = file_get_contents("https://github.com/login/oauth/access_token?" . $post);
        $explodedArray = explode('access_token=', $accessData);
        $explodedArrayWithAT = explode('&scopre=user', $explodedArray[1]);
        $accessToken = $explodedArrayWithAT[0];

        $opts = ['http' => [
            'method' => 'GET',
            'header' => ['User-Agent: PHP']
        ]
        ];
        $context = stream_context_create($opts);
        $emailURL = "https://api.github.com/user/emails?access_token=$accessToken";
        $emailRequest = file_get_contents($emailURL, false, $context);
        $emailJson = json_decode($emailRequest, true);
        $email = $emailJson[0];
        $_SESSION['githubUseremail'] = $email;

        $url = "https://api.github.com/user?access_token=$accessToken";
        $data = file_get_contents($url, false, $context);
        $user_data = json_decode($data, true);
        $username = $user_data['login'];
        $_SESSION['githubUsername'] = $username;
        return $email;
    }
}
