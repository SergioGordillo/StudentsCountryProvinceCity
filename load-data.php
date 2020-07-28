<?php

    $data = json_decode($_POST['data']);
 
    require 'dao.php';
    $dao = new Dao();

    if($data->metodo == "provincias"){
        $datos = $dao->listarProvincias($data->idpais);
    }else if ($data->metodo == "localidades") {
        $datos = $dao->listarLocalidades($data->idpais, $data->idprovincia);
    }

    echo json_encode($datos);

?>