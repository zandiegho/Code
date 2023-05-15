// create function for button on html
function validarDispositivoNavegador() {
    if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
        let typeNavigator = "iOS";
        console.log(typeNavigator);
    } else if (/Android/i.test(navigator.userAgent)) {
        let typeNavigator = "Android";
        console.log(typeNavigator);
    } else if (/webOS/i.test(navigator.userAgent)) {
        let typeNavigator = "webOS";
        console.log(typeNavigator);
    } else if (/Windows Phone/i.test(navigator.userAgent)) {
        let typeNavigator = "Windows Phone";
        console.log(typeNavigator);
    } else {
        let typeNavigator = "dispositivo desconocido";
        console.log(typeNavigator);
    }

    if (/MSIE|Trident/i.test(navigator.userAgent)) {
        let typeNavigator = "Internet Explorer";
        console.log(typeNavigator);
    } else if (/Firefox/i.test(navigator.userAgent)) {
        let typeNavigator = "Firefox";
        console.log(typeNavigator);
    } else if (/Chrome/i.test(navigator.userAgent)) {
        let typeNavigator = "Chrome";
        console.log(typeNavigator);
    } else if (/Safari/i.test(navigator.userAgent)) {
        let typeNavigator = "Safari";
        console.log(typeNavigator);
    } else if (/Opera|OPR/i.test(navigator.userAgent)) {
        let typeNavigator = "Opera";
        console.log(typeNavigator);
    } else {
        let typeNavigator = "navegador desconocido";
        console.log(typeNavigator);
    }

}

window.onload = function () {
    validarDispositivoNavegador();
};

let checkbox = document.getElementById("checkbox")
let btnAcceder = document.getElementById("btnAcceder")

btnAcceder.disabled = true

checkbox.addEventListener("change", function() {
    // Verificar si el checkbox está marcado
    if (checkbox.checked) {
      // Habilitar el botón
      btnAcceder.disabled = false;
      verificar()
    } else {
      // Deshabilitar el botón
      btnAcceder.disabled = true;
    }
  });

  function verificar() {
    // Obtener el elemento del cargador y el botón
    var loader = document.getElementById("loader");
    var verificar = document.getElementById("btnAcceder");
    var divBtn = document.getElementById("divBtn");

    // Mostrar el cargador y ocultar el botón
    loader.style.display = "block";
    verificar.style.display = "none";
    divBtn.style.textAlign = "center";


    // Simular una tarea que toma tiempo
    setTimeout(function() {
      // Ocultar el cargador y mostrar el botón
      divBtn.style.textAlign = "center";
      divBtn.style.position = "relative"
      
      loader.style.display = "none";
      verificar.style.textAlign = "center"
      verificar.style.display = "block";
      verificar.style.margin = "auto"
    }, 3000);
  }



