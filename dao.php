<?php

require_once 'dbPDO.php';

class Dao {

    private $db;

    function __construct(){

        // Lugar donde esta la BD
        define("HOST_DB", "localhost");
        // Usuario que se conecta a la BD
        define("USER_DB", "root");
        // Contraseña del usuario
        define("PASS_DB", "");
        // Nombre de la BD
        define("NAME_DB", "tarea6");

        $this->db = new dbPDO(HOST_DB, USER_DB, PASS_DB, NAME_DB);

    }

    function insertarAlumno($alumno){

        $this->db->connect(); 

        $sql="INSERT INTO alumnos VALUES(";
        $sql.="'".$alumno->Dni."',"; 
        $sql.="'".$alumno->Nombre."',"; 
        $sql.="'".$alumno->Apellido1."',"; 
        $sql.="'".$alumno->Apellido2."',"; 
        $sql.="".$alumno->Edad.","; 
        $sql.="".$alumno->Pais.","; 
        $sql.="".$alumno->Provincia.","; 
        $sql.="".$alumno->Localidad.")"; 

        $query = $this->db->executeInstruction($sql);

        $this->db->close(); 

    }

    function listarPaises(){
        $data = $this->db->executeQuery("SELECT * FROM paises");
        return $data;
    }
    
    function listarProvincias($idPais){
        $data = $this->db->executeQuery("SELECT * FROM provincias WHERE IdPais= " . $idPais);
        return $data;
    }
    
    function listarLocalidades($idPais, $idProvincia){
        $data = $this->db->executeQuery("SELECT * FROM localidades WHERE IdPais= " . $idPais . " and IdProvincia = " . $idProvincia);
        return $data;
    }


}



?>