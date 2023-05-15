<?php 

$nombreMarca = $_POST['nombreMarca'];
$idMarca = $_POST['idMarca'];
$nombreContacto = $_POST['nombreContacto'];
$apellidoContacto =$_POST['apellidoContacto'];
$telefono = $_POST['telefonoContacto'];
$correo = $_POST['mailContacto'];
$descripcion = $_POST['descrpcion'];

if (isset($_FILES['imagen'])) {
    $archivo = $_FILES['imagen'];
    $nombreImagen = $archivo['name'];
    $tipo = $archivo['type'];
    $tamano = $archivo['size'];
    $temporal = $archivo['tmp_name'];
    
    if (move_uploaded_file($temporal, "../uploads/" . $nombreImagen)) {
        echo "<br/>La imagen se cargó correctamente.";
        $rutaImagen = "localhost/code/uploads/$nombreImagen$tipo";
    } else {
        echo "Se produjo un error al cargar la imagen.";
    }
}

echo "$nombreMarca , $idMarca , $nombreContacto , $apellidoContacto , $telefono , $correo , $descripcion";


if(isset($nombreMarca) && isset($idMarca) && isset($nombreContacto) && isset($telefono) && isset($correo)){
    conex($nombreMarca, $idMarca, $nombreContacto, $apellidoContacto, $telefono, $correo, $descripcion, $rutaImagen);
  }

function conex($nameS, $idS, $nameC, $apellidoC, $tel, $mail, $descripcion, $ruta){
    
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
    }else{
        echo "<br/>Conexión Exitosa";
    }

    //crear consulta para ingresar datos a tabla User y a tabla negocio
    $nameCScaped = mysqli_real_escape_string($conn, "$nameC");
    $telCScaped = mysqli_real_escape_string($conn, "$tel");
    $mailCScaped = mysqli_real_escape_string($conn, "$mail");

    $query = " INSERT INTO User (username, phone, mail) values (concat('$nameC' , ' ' , '$apellidoC') , '$telCScaped' , '$mailCScaped') " ;
    mysqli_query($conn, $query);

    $id_user = mysqli_insert_id($conn);


    $query2 = "INSERT INTO Negocio (nit, name, id_user) values ('$idS', '$nameS', '$id_user')";
    mysqli_query($conn, $query2);

    $id_bussines= mysqli_insert_id($conn);


    $query3 = 
    "INSERT INTO datosnegocio (Descripcion, imagen, id_Bussines)
    values ('$descripcion', '$ruta', '$id_bussines')";
    
    mysqli_query($conn, $query3);       

}