<?php

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
        'content' => $data['caption']['text'],
        'date' => $date_format,
        'likes' => $data['likes']['count']
    );
}

print_r($data_post);