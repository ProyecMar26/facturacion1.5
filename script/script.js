function obtenerFechaHora() {
    // Crear un objeto de fecha
    var fechaHora = new Date();

    // Obtener los componentes de la fecha y hora
    var dia = fechaHora.getDate();
    var mes = fechaHora.getMonth(); // Obtener el índice del mes
    var año = fechaHora.getFullYear();
    var horas = fechaHora.getHours();
    var minutos = fechaHora.getMinutes();
    var segundos = fechaHora.getSeconds();

    // Nombres de los meses
    var nombresMeses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    var nombreMes = nombresMeses[mes]; // Nombre del mes en formato corto
    var mesNumero = (mes + 1).toString().padStart(2, '0'); // Número del mes con ceros a la izquierda

    // Formatear la salida (agregar ceros a la izquierda si es necesario)
    if (horas < 10) {
        horas = '0' + horas;
    }
    if (minutos < 10) {
        minutos = '0' + minutos;
    }
    if (segundos < 10) {
        segundos = '0' + segundos;
    }

    // Construir las cadenas de fecha y hora
    var fechaHoraLarga = horas + ':' + minutos + ':' + segundos + ' ' + dia + ' ' + nombreMes + ' ' + año;
    var fechaHoraCorta = horas + ':' + minutos + ':' + segundos + ' ' + dia + '/' + mesNumero + '/' + año;

    // Devolver las cadenas
    return {
        largo: fechaHoraLarga,
        corto: fechaHoraCorta
    };
}

// Función para actualizar el div con la fecha y hora actual
function actualizarFechaHora() {
    var fechaHoraDiv = document.getElementById('fecha-hora');
    var formatos = obtenerFechaHora();
    fechaHoraDiv.setAttribute('data-full', formatos.largo);
    fechaHoraDiv.setAttribute('data-short', formatos.corto);
}

// Esperar a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function() {
    // Actualizar la fecha y hora inmediatamente al cargar la página
    actualizarFechaHora();
    // Actualizar la fecha y hora cada segundo
    setInterval(actualizarFechaHora, 1000);
});

function toggleMenu() {
    const menu = document.getElementById('lista-menu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

// También puedes agregar un evento para cerrar el menú si haces clic fuera de él
window.addEventListener('click', function(event) {
    if (!event.target.matches('.boton_menu')) {
        const menu = document.getElementById('lista-menu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        }
    }
});

function toggleNavbar() {
    const navbar = document.querySelector('.side-navbar');
    navbar.classList.toggle('active');
}


