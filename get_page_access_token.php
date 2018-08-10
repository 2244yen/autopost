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
        'default_graph_version' => 'v2.5'
    ));

    $access_token = new AccessToken('EAAC6MjRokYABAB9ouFlBS4wTXqBwXOqPvFC0G8QpgEABiHPQO5NixMz8ViHRzKMmbh2WCNMfMlOmH6On3XwRbN9ZCWcrimuUmmuYtKeBnQNWGwF7hNYJqup8RRPx88NFST2O8EcItYKFggHBUXj9Wr2RY5jT2FzLYmc8VpaM2LNZCPZAiOV4QwZBcE60Hwi6TZASNgnXUUgZDZD');

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
        echo 'Page Access Token: ' . $graphNode['access_token'];
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      //EAAJsV0SXvqEBABeZAwALz2PluIqkceTEQ01lE5E5XSUfEmiCeNzrHTwRNeK4q8QAdhjHLdFBwSCPhaSJZAZC2HlNk38frQuSpIKf4FPdokBZCmbWlF0iXxPeCuw17WKGiEUEN17plVgaMoUdxUGjqFBRVVmGqWo2ovVd2iW1fwxDFrHUlfhSl4GdNyqftrpH7BZBG4kJ4pgywYbJn1zja