<?php
    if (!session_id()) {
        session_start();
    }

    require_once __DIR__ . '/vendor/autoload.php'; 

    use Facebook\Facebook;
    use Facebook\Exceptions\FacebookResponseException;
    use Facebook\Exceptions\FacebookSDKException;

    /*
    * Configuration and setup Facebook SDK
    */
    $appId         = '204724790399360'; //Facebook App ID
    $appSecret     = 'eafde13d5200413c35241dd20608b084'; //Facebook App Secret
    $redirectURL   = 'https://auto-post-ld.herokuapp.com/'; //Callback URL
    $fbPermissions = array('publish_actions'); //Facebook permission

    $fb = new Facebook(array(
        'app_id' => $appId,
        'app_secret' => $appSecret,
        'default_graph_version' => 'v2.6',
    ));

    // Get redirect login helper
    $helper = $fb->getRedirectLoginHelper();

    // Try to get access token
    try {
        if(isset($_SESSION['facebook_access_token'])){
            $accessToken = $_SESSION['facebook_access_token'];
        }else{
            $accessToken = $helper->getAccessToken();
        }
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }