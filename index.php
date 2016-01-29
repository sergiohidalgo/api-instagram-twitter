<?php

header('Content-Type: application/json');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/class/HttpConnection.class.php';

//Twitter
$settings = array(
    'oauth_access_token' => "68351031-wxTG76QDz24LELSRehZ8kFCuKEIp2BFAnHTrbdHdE",
    'oauth_access_token_secret' => "f108HeUMXFXeQh90H5NSqSDcMw8sYR6NJwIFzGa8MpRig",
    'consumer_key' => "rUjeccFpVFgEYyDtAycBEJ2xN",
    'consumer_secret' => "CpDfljxmbcyYJBF1XOZpN3IFmjirjlccsB6Or7M5cdWmpZqRJl"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23meat&count=25';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

$data_twitter = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(), true);

foreach ($data_twitter['statuses'] as $statuse) {

    //Formato a fecha
    $date = new DateTime($statuse['created_at']);
    $date->modify('-3 hours');
    $date_format = $date->format('d/m/Y H:i:s');

    //Construcción de array para json
    $data_post[] = array(
        'type' => 'twitter',
        'content' => $statuse['text'],
        'date' => $date_format,
        'likes' => $statuse['favorite_count']
    );
}
//fin twitter


//Instagram
$http = new HttpConnection();
$http->init();
$data_instagram = json_decode($http->get("https://api.instagram.com/v1/tags/meat/media/recent?access_token=44110995.1677ed0.6d87a7ce19f544c99e2912686465de59&count=25"), true);
$http->close();

foreach ($data_instagram['data'] as $data) {

    //Formato a fecha
    $horas_restantes = 4;
    $date_format = $data['created_time'] - ($horas_restantes * 3600);
    $date_format = date('d/m/Y H:i:s', ($date_format));

    //Construcción de array para json
    $data_post[] = array(
        'type' => 'instagram',
        'content' => $data['images']['standard_resolution']['url'] . ' ' . $data['caption']['text'],
        'date' => $date_format,
        'likes' => $data['likes']['count']
    );
}
//fin instagram

//Router
$router = new AltoRouter();
$router->setBasePath('');
$router->map('GET','/posts/', 'posts.php', 'posts');
$router->map('GET','/posts/likes', 'likes.php', 'likes');

$match = $router->match();

if($match) {
    require $match['target'];
} else {
    header("HTTP/1.0 404 Not Found");
    require '404.php';
}
//fin router