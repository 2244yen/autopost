<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/config.php';

    // session_start();
    
    $config = new config();
    $fbData = array(
        'app_id' => $config::$app_id,
        'app_secret' => $config::$app_secret,
        'default_graph_version' => 'v2.2'
    );
 
    $fb = new Facebook\Facebook($fbData);

    $helper = $fb->getRedirectLoginHelper();
 
    try {
        $access_token = $helper->getAccessToken();
        $oAuth2Client = $fb->getOAuth2Client();
        $accessToken = $oAuth2Client->getLongLivedAccessToken($access_token);
        $_SESSION['user_token'] = $accessToken;
        echo $accessToken;
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }