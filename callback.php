<?php
    require_once __DIR__ . '/vendor/autoload.php';
    session_start();
 
    $fbData = array(
        'app_id' => '204724790399360',
        'app_secret' => 'eafde13d5200413c35241dd20608b084',
        'default_graph_version' => 'v2.2'
    );
 
    $fb = new Facebook\Facebook($fbData);

    $helper = $fb->getRedirectLoginHelper();
 
    try {
        $access_token = $helper->getAccessToken();
        $oAuth2Client = $fb->getOAuth2Client();
        $accessToken = $oAuth2Client->getLongLivedAccessToken($access_token);
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