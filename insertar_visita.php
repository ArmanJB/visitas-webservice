<?php

require 'Visitas.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    $retorno = Visitas::insertVisita($body['fecha'], $body['id_escuela'], $body['id_oficial']);

    for ($i=0; $i < count($body['motivos']); $i++) { 
    	Visitas::insertDetalle($retorno, $body['motivos'][$i]);
    }

    if ($retorno > 0) {
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Creación éxitosa')
        );
    } else {
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Creación fallida')
        );
    }
}

?>