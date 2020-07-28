<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 6 DWES Sergio Gordillo</title>
    <script src="main.js"></script>
</head>
<body>

    <?php
        require_once 'dao.php';
        require_once 'alumno.php'; 
        $dao = new Dao();

        if(isset($_POST['enviar'])){
            $Dni=$_POST['Dni'];
            $Nombre=$_POST['Nombre']; 
            $Apellido1=$_POST['Apellido1'];
            $Apellido2=$_POST['Apellido2'];
            $Edad=$_POST['Edad'];

            if($_POST['Pais'] != "-1"){
                $Pais=$_POST['Pais'];
                $Provincia=$_POST['Provincia'];
                $Localidad=$_POST['Localidad'];

                $alumno=new Alumno($Dni, $Nombre, $Apellido1, $Apellido2, $Edad, $Pais, $Provincia, $Localidad);
                $dao->insertarAlumno($alumno); //Llamo al método insertar
            }else {
                echo "Has de seleccionar un país, una provincia y una localidad.";
            }

       

        }

    ?>

    <form method="POST" name="formulario" action="<?php $_SERVER['PHP_SELF']?>">

        <label for="dni">Escribe tu DNI</label>
        <input type="text" name="Dni" id="Dni">
        <br> <br>
        <label for="nombre">Escribe tu Nombre</label>
        <input type="text" name="Nombre" id="Nombre">
        <br> <br>
        <label for="apellido1">Escribe tu primer apellido</label>
        <input type="text" name="Apellido1" id="Apellido1" >
        <br> <br>
        <label for="apellido2">Escribe tu segundo apellido</label>
        <input type="text" name="Apellido2" id="Apellido2">
        <br> <br>
        <label for="edad">Escribe tu edad</label>
        <input type="text" name="Edad" id="Edad">
        <br> <br>
        <label for="pais"> Indica tu país </label>
        <select name="Pais" id="Pais">
            <option value="-1">Seleccione un pais</option>
        <?php 
            $data = $dao->listarPaises();
            foreach ($data as $indice => $pais) {
                echo '<option value="'.$pais->Id.'">' .$pais->Nombre. '</option>';
            }
        ?>
        </select>
        <br> <br>
        <label for="provincia"> Indica tu provincia </label>
        <select name="Provincia" id="Provincia">
            
        </select>
        <br> <br>
        <label for="localidad"> Indica tu localidad </label>
        <select name="Localidad" id="Localidad">

        </select>

        <input type="submit" name="enviar" value="Insertar alumno"/>

    </form>
    
</body>
</html>