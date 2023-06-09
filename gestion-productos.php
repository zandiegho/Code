<?php 
session_start(); //Iniciar la sesión
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion de productos</title>
  <!-- Agregamos Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilos-productos.css">

  <script>
    // Obtener el nombre del usuario almacenado en la sesión
    var nombreUsuario = "<?php echo $_SESSION['nombreContact'] ?>"
    var nombreNegocio = "<?php echo $_SESSION['nameMarca'] ?>"
    var idBussines =    "<?php echo $_SESSION['idNegocio'] ?>"

    document.getElementById("idNegocioId").textContent =  idBussines;
    console.log('Id de Negocio es: ' + idBussines)
    
    /** ?php echo | ?> **/
    /* 
      $_SESSION['nameMarca'] = $nameShop;
      $_SESSION['idMarca'] = $idShopd;
      $_SESSION['idNegocio'] = $password;
      $_SESSION['nombreContact'] = $nombreContacto;
    */

    // Mostrar el nombre del usuario en el HTML
    window.onload = function () {
      document.getElementById("nombreContacto").textContent = nombreUsuario;
      document.getElementById("nameMarca").textContent = nombreNegocio;
    
    };
  </script>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"> <?php echo $_SESSION['nameMarca'] ?> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <!-- <li class="nav-item active">
          <a class="nav-link" href="index.html">Inicio</a>
        </li> -->

        <li class="nav-item">
          <a class="nav-link" href="mis-productos.php">Mis Productos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contacto</a>
        </li>

      </ul>
    </div>
  </nav>
  <div class="container div--container">

    <h1>Bienvenido(a), <?php echo $_SESSION['nameMarca'] ?> </h1>
    <!-- <h1>Bienvenido(a), !</h1> -->

    <div class="row justify-content-center">

      <div class="col  col--products">
        <h2>Crear Productos para <?php echo $_SESSION['idNegocio'] ?> </h2>
        <p class="p--products">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus porro perferendis
          velit, dolor similique,
          harum suscipit illum in ratione qui, non natus. Aliquam nemo nobis excepturi placeat praesentium labore
          repudiandae!</p>
        <button class="btn--crud">Comenzar a Crear</button>
      </div>

      <div class="col col--products">
        <h2>Eliminar Productos</h2>
        <p class="p--products">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus porro perferendis
          velit, dolor similique,
          harum suscipit illum in ratione qui, non natus. Aliquam nemo nobis excepturi placeat praesentium labore
          repudiandae!</p>
        <button class="btn--crud">Eliminar</button>
      </div>

    </div> <!-- fin row -->

    <hr>

    <div class="row">
      <div class="col">
        <h2>Agregar Productos</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio magni, neque autem aperiam eum provident
          eius assumenda dolorem rem voluptatibus suscipit non, esse in minima quidem necessitatibus! Veniam, quod ab.
        </p>
      </div> <!-- fIN COL 1 -->

      <div class="col">
        <form action="php/agregarProducto.php" method="post" enctype="multipart/form-data">

          <div class="div--nombreProducto">
            <label for="productName" class="form-label">Nombre de prodcuto</label>
            <input type="text" name="productName" id="productName">
          </div>

          <div class="div--nombreProducto">
            <label for="productPrice" class="form-label">Precio de prodcuto</label>
            <input type="number" name="productPrice" id="productPrice">
          </div>

          <div class="div--nombreProducto">
            <label for="productObs" class="form-label">Observación </label>
            <input type="text" name="productObs" id="productObs">
          </div>

          <div class="div--nombreProducto">
            <label for="productImage" class="form-label">Imgen</label>
            <input type="file" name="productImage" id="productImage">
          </div>

          <!-- Pasar valores Ocultos en hidden para insertar a la BD con el id del negocio-->
          <input type="hidden" name="idNegocio" id="idNegocioId" value="<?php echo $_SESSION['idNegocio']; ?>">

          <div class="btn--agregar">
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
          </div>

        </form>
      </div>

    </div> <!-- fin row agregar producto -->

  </div> <!-- fin container -->




  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $.ajax({
      url: 'php/conexion.php',
      type: 'GET', // O 'POST' u otro método HTTP según sea necesario
      dataType: 'json', // O el tipo de datos esperado en la respuesta
      success: function (data) {
        // Manejo de los datos de respuesta aquí
        console.log(data);
      },
      error: function (xhr, status, error) {

        // Manejo de errores aquí
        console.log(error);
      }
    });
  </script>
</body>


</html>