fetch('./php/register.php')
.then(response => response.json())
.then(data => {
  var nombre = data.id_user;
  console.log(nombre);
  // Aquí puedes utilizar el nombre en JavaScript
});