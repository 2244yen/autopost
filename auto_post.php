<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use Facebook\Authentication\AccessToken;
    use Facebook\FacebookApp;
    use Facebook\FacebookRequest;

    session_start();

    $app_id = '204724790399360';
    $app_secret = 'eafde13d5200413c35241dd20608b084';
    $page_id = '1685036604955076';

    $app = new FacebookApp($app_id, $app_secret);
    $fb = new Facebook\Facebook(array(
        'app_id' => $app_id,
        'app_secret' => $app_secret,
        'default_graph_version' => 'v2.5',
    ));

    //Page access token has been got from get_page_access_token.php
    $access_token = 'EAAC6MjRokYABADVJVpMPpQoCQW6EdfDeUhhp9pQlFlnpqsKiP0lsW0wDrmbM5ZCNsdKiifplr81lOxZBZBLl878iy6C9OZA5bfAhW5CGCuTrU237InTlybFtAKYDdhPic961FHUWjIdbiAWyleQZBh1ZAj2tcEWPiX573zzPFPTfqP0gUZCeyHTMRjJ6Ys119pHuZAyPaJoXfwZDZD';

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
