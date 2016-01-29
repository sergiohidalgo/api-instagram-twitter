<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/class/HttpConnection.class.php';

//Router
$router = new AltoRouter();
$router->setBasePath('');
$router->map('GET','/posts', 'posts.php', 'posts');
$router->map('GET','/posts/likes', 'likes.php', 'likes');

$match = $router->match();

if($match) {
    require $match['target'];
} else {
    header("HTTP/1.0 404 Not Found");
    require '404.php';
}