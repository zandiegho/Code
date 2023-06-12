<?php 

session_start(); //Iniciar la sesión

$nombreMarca = $_POST['nombreMarca'];
$idMarca = $_POST['idMarca'];
$nombreContacto = $_POST['nombreContacto'];
$apellidoContacto =$_POST['apellidoContacto'];
$telefono = $_POST['telefonoContacto'];
$correo = $_POST['mailContacto'];
$descripcion = $_POST['descrpcion'];

$_SESSION['nameMarca'] = $nombreMarca;
$_SESSION['nombreContact'] = $nombreContacto;
$_SESSION['apellidoContact'] = $apellidoContacto;
$_SESSION['telefonoContact'] = $telefono;
$_SESSION['correoContact'] = $correo;
$_SESSION['descripcion'] = $descripcion;

# header("Location: ../views/contacto.php");




if (isset($_FILES['imagen'])) {
    $archivo = $_FILES['imagen'];
    $nombreImagen = $archivo['name'];
    $tipo = $archivo['type'];
    $tamano = $archivo['size'];
    $temporal = $archivo['tmp_name'];
    
    if (move_uploaded_file($temporal, "../uploads/" . $nombreImagen)) {
        //echo "<br/>La imagen se cargó correctamente.";
        $rutaImagen = "localhost/code/uploads/$nombreImagen$tipo";
    } else {
        echo "Se produjo un error al cargar la imagen.";
    }
}

//.0echo "$nombreMarca , $idMarca , $nombreContacto , $apellidoContacto , $telefono , $correo , $descripcion";


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
    }

    //crear consulta para ingresar datos a BD
    $nameCScaped = mysqli_real_escape_string($conn, "$nameC");
    $telCScaped = mysqli_real_escape_string($conn, "$tel");
    $mailCScaped = mysqli_real_escape_string($conn, "$mail");

    $query = " INSERT INTO User (username, phone, mail) values (concat('$nameC' , ' ' , '$apellidoC') , '$telCScaped' , '$mailCScaped') " ;
    $result = mysqli_query($conn, $query);

    if($result){
        $id_user = mysqli_insert_id($conn);
    }

    $query2 = "INSERT INTO Negocio (nit, name, id_user) values ('$idS', '$nameS', '$id_user')";
    $result2 = mysqli_query($conn, $query2);

    if($result2){
       $id_bussines= mysqli_insert_id($conn);
        $_SESSION['idNegocio'] = $id_bussines;

    }

    $query3 = 
    "INSERT INTO datosnegocio (Descripcion, imagen, id_Bussines)
    values ('$descripcion', '$ruta', '$id_bussines')";
    
    $result3 = mysqli_query($conn, $query3);       

    if($result3){
        //echo "DATOS TOTALES INGRESADOS CORRECTAMENTE";
        //pasar a Registro Exitoso

        // Redirigir a la página "nuevo-destino.php" después de 5 segundos
        //header("refresh:2; url=../Registro-Exitoso.html");

        // Mostrar un mensaje antes de redirigir
        //echo "Redireccionando en 5 segundos...";

        // Detener la ejecución del script para que se muestre el mensaje
        //exit;

        $queryInsertProduct = 
        "INSERT INTO productos 
            (id_producto, nombreProducto, id_negocio, precio, imagen, descripcion)
        
            SELECT LPAD(COUNT(p.id_producto) + 1, 3, '0'), 
            'Producto Inicial de Prueba BD', 
            $id_bussines, 
            100, 
            'localhost/prueba', 
            'Descripcion producto de prueba'
        
        FROM productos p;
        ";

        $resultQueryInsertProduct = mysqli_query($conn, $queryInsertProduct);

        if($resultQueryInsertProduct){         
        

            ?>

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Registro Exitoso</title>
                <!-- Agregamos Bootstrap -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            </head>
            <body>
                <div class="div--html"></div>
                    <!-- Espacio del NAV -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#"> <?php print($nameS) ?> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Inicio</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Mis Productos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contacto</a>
                                </li>
                                
                            </ul>
                        </div>
                    </nav>

                    <div class="container my-5">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h2 class="mb-4">¡Registro exitoso!</h2>
                                        <p class="lead mb-5">¡Bienvenido/a, <?php printf($nameC .' '. $apellidoC)?> 
                                        
                                        </p>
                                        <!-- <a href="../gestion-productos.html" class="btn btn-primary">Ingresar al sitio de administración</a> -->
                                        <button class="btn btn-primary" onclick="redirect()"> Ingresar al sitio de administración </button>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Agregamos los scripts de Bootstrap -->
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

                    <script>
                        function redirect(){
                            console.log("boton Presionado")
                            location.replace('../gestion-productos.php')
                            exit;
                        }
                    </script>
                </div>
            </body>

            <?php

        }

        // Redirigir a la nueva página HTML


        #########################################################################

    }
}