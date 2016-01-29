<?php

header('Content-Type: application/json');

//Ordenar por likes
foreach ($data_post as $clave => $fila) {
    $volumen[$clave] = $fila['date'];
}
array_multisort($volumen, SORT_DESC, $data_post);

echo json_encode($data_post);