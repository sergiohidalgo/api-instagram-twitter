<?php

//Acceso API Twitter:

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

echo $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
$data_twitter = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(), true);


    
foreach ($data_twitter['statuses'] as $statuse) {
    $data_post[] = array(
        'type' => 'twitter',
        'content' => $statuse['text'],
        'date' => $statuse['created_at'], //"DD/MM/YYYY h:m:s"
        'likes' =>  $statuse['favorite_count']
    );
}


echo '<pre>';
print_r($data_post);
echo '</pre>';