<?php

//Ordenar por likes
foreach ($data_post as $clave => $fila) {
    $volumen[$clave] = $fila['likes'];
}
array_multisort($volumen, SORT_DESC, $data_post);

echo json_encode($data_post);
