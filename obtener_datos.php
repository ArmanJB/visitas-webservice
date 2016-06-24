<?php

require 'Visitas.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    $retorno = Visitas::auth($body['user'], $body['token']);

    if ($retorno > 0) {
        $area = Visitas::getAreas();
        $departamento = Visitas::getDepartamentos();
        $oficial = Visitas::getOficiales();
        $motivo = Visitas::getMotivos();
        $escuela = Visitas::getEscuelas();

        if ($area and $departamento and $oficial and $motivo and $escuela) {
            $datos["estado"] = 1;
            $datos["areas"] = $area;
            $datos["departamentos"] = $departamento;
            $datos["oficiales"] = $oficial;
            $datos["motivos"] = $motivo;
            $datos["escuelas"] = $escuela;

            print json_encode($datos);
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Ha ocurrido un error"
            ));
        }
    }else{
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Token no existe"
        ));
    }
/*
    */
}





/*
require 'Visitas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $area = Visitas::getAreas();
    $departamento = Visitas::getDepartamentos();
    $oficial = Visitas::getOficiales();
    $motivo = Visitas::getMotivos();
    $escuela = Visitas::getEscuelas();

    if ($area and $departamento and $oficial and $motivo and $escuela) {
        $datos["estado"] = 1;
        $datos["areas"] = $area;
        $datos["departamentos"] = $departamento;
        $datos["oficiales"] = $oficial;
        $datos["motivos"] = $motivo;
        $datos["escuelas"] = $escuela;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}
*/


?>
