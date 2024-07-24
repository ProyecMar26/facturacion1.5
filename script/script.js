function redireccionar() {
  window.location.href = 'pagina_principal';
}
// fechaHora.js

// Función para obtener la fecha y hora actual
function obtenerFechaHora() {
    // Crear un objeto de fecha
    var fechaHora = new Date();

    // Obtener los componentes de la fecha y hora
    var dia = fechaHora.getDate();
    var mes = fechaHora.getMonth() + 1; // Se suma 1 porque los meses van de 0 a 11
    var año = fechaHora.getFullYear();
    var horas = fechaHora.getHours();
    var minutos = fechaHora.getMinutes();
    var segundos = fechaHora.getSeconds();

    // Formatear la salida (agregar ceros a la izquierda si es necesario)
    if (mes < 10) {
        mes = '0' + mes;
    }
    if (dia < 10) {
        dia = '0' + dia;
    }
    if (horas < 10) {
        horas = '0' + horas;
    }
    if (minutos < 10) {
        minutos = '0' + minutos;
    }
    if (segundos < 10) {
        segundos = '0' + segundos;
    }

    // Construir la cadena de fecha y hora
    var fechaHoraActual = dia + '/' + mes + '/' + año + ' ' + horas + ':' + minutos + ':' + segundos;

    // Devolver la cadena
    return fechaHoraActual;
}


function toggleMenu() {
  var listaMenu = document.getElementById("lista-menu");
  if (listaMenu.style.display === "block") {
    listaMenu.style.display = "none";
  } else {
    listaMenu.style.display = "block";
  }
}



