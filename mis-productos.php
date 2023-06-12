<?php 
session_start(); //Iniciar la sesión

if(!isset($_SESSION["idNegocio"])){ //Si no hay sesión activa, redire
    header('Location: php/login.php');
}

$idBussines = $_SESSION["idNegocio"];
# echo "<br/>$idBussines\_%";


/* CONECTAR A BASE DE DATOS */
$conexion = mysqli_connect("localhost:3306", "root", "", "sistemaPos");
if (!$conexion) {
    # echo "<br/>Error: No se pudo conectar a MySQL." . PHP_EOL;
} 
else{
    #echo "<br/><br/>Conectado a MySQL." . PHP_EOL;
}

    /* CREAR CONSULTA */
    $consulta = " SELECT * 
	FROM productos
	WHERE id_producto 
    LIKE '$idBussines\_%' ";

    $result = $conexion->query($consulta); 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="css/estilos-products.css" rel="stylesheet">

</head>

<body>
    <div class="container">

        <h1>Mis Productos</h1>

        <button class="btn btn-primary" id="btn-crear" onclick="mostrarFormulario()">Crear Producto</button>


        <form action="php/agregarProducto.php" id="formNewProduct" 
        method="post" enctype="multipart/form-data" hidden>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="productName" id="nombre
                " placeholder="Nombre del producto">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" class="form-control" name="productObs" id="descripcion
                    " placeholder="Descripcion del producto">
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="text" class="form-control" name="productPrice" id="precio
                    " placeholder="Precio del producto">
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control" name="productImage" id="imagen">
            </div>

            <!-- Pasar valores Ocultos en hidden para insertar a la BD con el id del negocio-->
            <input type="hidden" name="idNegocio" id="idNegocioId" value="<?php echo $_SESSION['idNegocio']; ?>">

            <button type="submit" class="btn btn-primary">Crear</button>
        </form>

        <hr>

        <div class="row">

            <!-- cards productos -->
            <?php
            if ($result->num_rows > 0) {
                // Recorre los resultados y los muestra en cards
                while ($row = $result->fetch_assoc()) {
                    $idProducto = $row['id_producto'];
                    $nombreProducto = $row['nombreProducto'];
                    $precio = $row['precio'];
                    $imagen = $row['imagen'];
                    $descripcion = $row['descripcion'];    
                    
                    $precioF = number_format($precio , 0 , '.' , ".");
                    
                    ?>

                <div class="col-lg-3 col-md-6">
                    <div class="card targeta">
                        <img src="<?php echo $imagen; ?>" alt="Imagen del producto" width="200">

                        <div class="card-body">
                            <h3><?php echo $nombreProducto; ?></h3>
                            <p><b>Precio:</b> <?php echo '$ '.$precioF; ?></p>
                            <p><b>Descripción: </b> <?php echo $descripcion; ?></p>

                            <!-- Contador de cantidad -->
                            <div>
                                <label for="cantidad-<?php echo $idProducto; ?>">Cantidad:</label>
                                <input type="number" id="cantidad-<?php echo $idProducto; ?>" min="1" value="1">
                                <button class="btn btn-primary"
                                    onclick="agregarAlPedido(<?php echo $idProducto; ?>)">Agregar</button>
                            </div>

                        </div>
                    </div>
                </div>

                <?php 
            }
        } else {
            echo "Aun no No hay productos que esperas para agregarlos";
        }
        // Cierra la conexión a la base de datos
        $conexion->close();
        ?> 
        </div> <!-- Fin row -->
    </div> <!-- Fin .Container -->

    <!-- scripts -->
    <script src="js/gestionPedidos.js"></script>

    <script>
        // Agrega un producto al carrito de compras
        /* function agregarAlPedido(idProducto) {
            // Obtiene el valor del input
            let cantidad = document.getElementById("cantidad-" + idProducto).value;
            // Valida que la cantidad sea mayor a 0
            if (cantidad > 0) {
                // Obtiene el valor del input
            } */
    function mostrarFormulario(){

        var formNewProduct = document.getElementById("formNewProduct");
        formNewProduct.style.display = "block";
        formNewProduct.removeAttribute('hidden');
    }
    </script>


    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
</body>

</html>