<?php

$nameShop = $_POST["nombreEstablecimiento"];
$idShop = $_POST["idEstablecimiento"];
$password = $_POST["codigoEstablecimiento"];

echo "$nameShop $idShop $password";

//Sanitizar variables de html a php
if(isset($nameShop) && isset($idShop) && isset($password) ){
  conex($nameShop, $idShop, $password);
}

function conex($shop, $id, $pass){
    //create conection to bd Mysql
    $servername = "localhost:3306"; //--> Ip servidor base de datos
    $username = "root"; //--> nombre usuario base de datos
    $password = ""; //--> contraseña base de datos 
    $dbname = "SistemaPos"; //--> nombre de la base de datos

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "<br/>Conexión Exitosa";

    //crear consulta a tabla asesor donde documento sea igual a $docAsesor
    $query = " 
    SELECT nit, name
    FROM Negocio
    WHERE nit = '$id' AND name = '$shop' AND id_bussines = $pass ";
    
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $shop = $row['name'];
            $id = $row['nit'];
        }        
    }
    else { 
      # echo "No hay resultados para el documento especificado."; 
      echo "<script language='javascript'>alert('Error de autentificacion');window.location.href='http://localhost/code/login.html'</script>";
    }
    
    

    /* function comprobarEntrada($nombre_usuario){
  //compruebo que el tamaño del string sea válido.
  if (strlen($nombre_usuario)<1 || strlen($nombre_usuario)>100){
      //retornar a pagina de Inicio con alert de error
      echo "<script language='javascript'>alert('Error de autentificacion por palabara no permitidas');window.location.href='http://localhost/code/login.html'</script>";
      # echo $nombre_usuario . " no es válido<br>";
      
      return false;
  }
} */
}