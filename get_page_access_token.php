<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/config.php';

    use Facebook\Authentication\AccessToken;
    use Facebook\FacebookApp;
    use Facebook\FacebookRequest;

    // session_start();

    $config = new config();

    $app_id = $config::$app_id;
    $app_secret = $config::$app_secret;
    $page_id = $config::$page_id;

    $app = new FacebookApp($app_id, $app_secret);

    $fb = new Facebook\Facebook(array(
        'app_id' => $app_id,
        'app_secret' => $app_secret,
        'default_graph_version' => 'v2.5'
    ));

    $access_token = new AccessToken($_SESSION['user_token']);

    $request = new FacebookRequest(
        $app,
        $access_token,
        'GET', 
        '/' . $page_id,
        array( 'fields' => 'access_token')
    );

    try {
        $response = $fb->getClient()->sendRequest($request);
        $graphNode = $response->getGraphNode();
        $_SESSION['page_token'] = $graphNode['access_token'];
        // echo 'Page Access Token: ' . $graphNode['access_token'];
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    } 