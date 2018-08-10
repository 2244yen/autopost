<?php
    require_once __DIR__ . '/vendor/autoload.php';
    session_start();

    $fbData = array(
        'app_id' => '204724790399360',
        'app_secret' => 'eafde13d5200413c35241dd20608b084',
        'profile_id' => '100007514203990',
        'default_graph_version' => 'v2.5'
    );

    $fb = new Facebook\Facebook($fbData);

    $params = array(
        'req_perms' => 'manage_pages, publish_pages, public_profile'
    );

    $helper = $fb->getRedirectLoginHelper();

    $loginUrl = $helper->getLoginUrl('https://auto-post-ld.herokuapp.com/callback.php', $params);

    header('Location: '. $loginUrl);
    exit;
