<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use Facebook\Authentication\AccessToken;
    use Facebook\FacebookApp;
    use Facebook\FacebookRequest;

    require_once __DIR__ . '/config.php';

    // session_start();
    $config = new config();

    $app_id = $config::$app_id;
    $app_secret = $config::$app_secret;
    $page_id = $config::$page_id;

    $app = new FacebookApp($app_id, $app_secret);
    $fb = new Facebook\Facebook(array(
        'app_id' => $app_id,
        'app_secret' => $app_secret,
        'default_graph_version' => 'v2.5',
    ));

    //Page access token has been got from get_page_access_token.php
    $access_token = $_SESSION['page_token'];

    $post_data = array(
        'message' => 'test message'
        );
    $request = new FacebookRequest($app, $access_token, 'POST', '/' . $page_id . '/feed', $post_data);
    // Send the request to Graph
    try {
        $response = $fb->getClient()->sendRequest($request);
        $graphNode = $response->getGraphNode();
        echo 'Post ID: ' . $graphNode['id'];
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
