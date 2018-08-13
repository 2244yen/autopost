<?php 

    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ .  '/config.php';

    $config = new config();

    $fb = new Facebook\Facebook(array(
        'app_id' => $config::$app_id,
        'app_secret' => $config::$app_secret,
        'default_graph_sdk' => 'v2.2'
    ));

    $params = array(
        'req_perms' => 'manage_pages, publish_pages, public_profile'
    );

    $helper = $fb->getRedirectLoginHelper();

    $loginUrl = $helper->getLoginUrl('https://auto-post-ld.herokuapp.com/callback.php', $params);

    echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

    header('Location: '. $loginUrl);
    exit;
