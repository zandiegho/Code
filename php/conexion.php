<?php

//create conection to bd Mysql
$servername = "localhost:3306"; //--> Ip servidor base de datos
$username = "root"; //--> nombre usuario base de datos
$password = ""; //--> contraseña base de datos 
$dbname = "SistemaPos"; //--> nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    $this->info('Message');
}  

$query = "SELECT * FROM productos" ;
$result = $conn->query($query);
#$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    // Crear un array para almacenar los datos
    $users = array();

    // Recorrer los resultados y agregarlos al array
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    // Enviar el array como respuesta
    header('Content-Type: application/json');
    echo json_encode($users);
    #$id_user = mysqli_insert_id($conn);
}
else{
    // No se encontraron resultados
    echo "No se encontraron usuarios.";
}

// Cerrar la conexión a la base de datos
$conn->close();