// Agrega un evento change a todos los contadores
document.querySelectorAll('input[type="number"]').forEach(function (input) {
    input.addEventListener('change', function () {
        var cantidad = parseInt(this.value);
        var idProducto = this.id.split('-')[1];

        console.log('ID del producto:', idProducto);
        console.log('Cantidad seleccionada:', cantidad);
        // Aquí puedes agregar lógica adicional para manejar la cantidad seleccionada
    });
});


function agregarAlPedido(id) {
    var cantidadInput = document.getElementById('cantidad-' + id);
    var cantidad = parseInt(cantidadInput.value);
    console.log('ID del producto:', id);
    console.log('Cantidad seleccionada:', cantidad);
    
    // Aquí puedes agregar lógica adicional para manejar la cantidad seleccionada y agregar el producto al pedido
    // Puedes utilizar AJAX para enviar los datos al servidor y procesarlos en PHP
    // Por ejemplo, puedes enviar una petición POST con los datos del producto y la cantidad al servidor
    // y manejarlo en un archivo PHP para agregar el producto al pedido
    
    // Ejemplo de envío de petición POST con Fetch API:
    fetch('procesar_pedido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            idProducto: idProducto,
            cantidad: cantidad
        })
    })
    .then(response => response.json())
    .then(data => {
        // Manejar la respuesta del servidor si es necesario
        console.log(data);
    })
    .catch(error => {
        // Manejar errores en la petición
        console.error('Error:', error);
    });
}


