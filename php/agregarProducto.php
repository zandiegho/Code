<?php
session_start(); //Iniciar la sesión

$nameProduct    = $_POST["productName"];
$priceProduct   = $_POST["productPrice"];
$obsProduct     = $_POST["productObs"];
$idBussines     = $_POST["idNegocio"];

$_SESSION["idBussines"] = $idBussines;

if (isset($_FILES['productImage'])) {
    $archivo = $_FILES['productImage'];
    $nombreImagen = $archivo['name'];
    $tipo = $archivo['type'];
    $tamano = $archivo['size'];
    $temporal = $archivo['tmp_name'];
    
    if (move_uploaded_file($temporal, "../uploads/products/" . $nombreImagen)) {
        //echo "<br/>La imagen se cargó correctamente.";
        $rutaImagen = "uploads/products/$nombreImagen";
    } else {
        echo "Se produjo un error al cargar la imagen.";
    }
}

echo "nombre: $nameProduct";
echo "<br/>Id de Negocio: $idBussines";
echo "<br/>precio: $priceProduct";
echo "<br/>ruta: $rutaImagen";
echo "<br/>observaciones: $obsProduct";

#VALIDACION DE CAMPOS OK

/* CONECTAR A BASE DE DATOS */
$conexion = mysqli_connect("localhost:3306", "root", "", "sistemaPos");
if (!$conexion) {
    echo "<br/>Error: No se pudo conectar a MySQL." . PHP_EOL;
} 
else{
    echo "<br/><br/>Conectado a MySQL." . PHP_EOL;

    /* CREAR CONSULTA */

    $sql = 
    "INSERT INTO productos (id_producto, nombreProducto, id_negocio, precio, imagen, descripcion)
    SELECT CONCAT(n.id_bussines , '_' , LPAD(COUNT(p.id_producto) + 1, 3, '0') ), '$nameProduct', $idBussines, $priceProduct, '$rutaImagen', '$obsProduct'
    FROM negocio n, productos p
    WHERE n.id_bussines = $idBussines AND p.id_negocio = n.id_bussines;" ;

    if (mysqli_query($conexion, $sql)) {
        echo "Se ha añadido el producto correctamente.";
        // Redireccionar a Mis Productos.
        header("Location: ../mis-productos.php");
    } 
    else{
        echo "Error: No se pudo añadir el producto." . PHP_EOL ;
    }

    /* 
    $sql = "INSERT INTO productos (nombreProducto, precio, descripcion, imagen, id_negocio) 
            VALUES ('$nameProduct', '$priceProduct', '$obsProduct', '$rutaImagen', 36)";
    # EJECUTAR CONSULTA 
    if (mysqli_query($conexion, $sql)) {
        echo "Se ha añadido el producto correctamente.";
    } 
    else{
        echo "Error: No se pudo añadir el producto." . PHP_EOL ;
    }
    */
}





