<?php

require __DIR__ . '/vendor/autoload.php';

$settings = array(
    'oauth_access_token' => "68351031-wxTG76QDz24LELSRehZ8kFCuKEIp2BFAnHTrbdHdE",
    'oauth_access_token_secret' => "f108HeUMXFXeQh90H5NSqSDcMw8sYR6NJwIFzGa8MpRig",
    'consumer_key' => "rUjeccFpVFgEYyDtAycBEJ2xN",
    'consumer_secret' => "CpDfljxmbcyYJBF1XOZpN3IFmjirjlccsB6Or7M5cdWmpZqRJl"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23meet';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
//echo $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

$array_twitter = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest());

//print_r($array_twitter);

///////////////////////////////////////////////////////////////


$router = new AltoRouter();
$router->setBasePath('');
$router->map('GET','/posts', 'posts.php', 'posts');
$router->map('GET','/posts/likes/', 'likes.php', 'likes');

$match = $router->match();

if($match) {
    require $match['target'];
} else {
    header("HTTP/1.0 404 Not Found");
    require '404.php';
}