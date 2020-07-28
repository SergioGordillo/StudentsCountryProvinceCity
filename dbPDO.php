<?php

class dbPDO {

    private $host;
    private $user;
    private $pass;
    private $dbname;

    private $connection;

    function __construct($host, $user, $pass, $dbname)
    {        
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
    }

    function connect(){
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
 
        $this->connection = new PDO(
            'mysql:host='.$this->host.';dbname='.$this->dbname,
            $this->user,
            $this->pass,
            $opciones
        );

    }

    function close(){
        $this->connection = null;
    }

    function isOpen(){
        return !is_null($this->connection);
    }

    function executeQuery($sql){

        $this->connect(); 

        $datos=array(); //Creo array
        $query = $this->connection->query($sql);
        $query->execute();
        while($row=$query->fetch(PDO::FETCH_OBJ)){
            array_push($datos, $row); //Meto cada fila en el array
        }

        $this->close(); 
        return $datos;
    }

    function executeInstruction($sql){
        $this->connect(); 

        $query = $this->connection->query($sql); 
        $query->execute();

        $this->close(); 
    }

}

?>