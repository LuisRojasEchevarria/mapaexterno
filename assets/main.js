// main.js
// Funciones para vista main.php

$(document).ready(function() {
    // Setea asíncrono de Ajax
    $.ajaxPrefilter( function( options, originalOptions, jqXHR ) {
        options.async = true;
    });

    // Deshabilita caching para todos los AJAX requests
    $.ajaxSetup({
        cache: false
    });
    
    // Evento para detectar si hay o no conexión a Internet (notificacion al usuario)
    var connectionError;
    $(window).on("offline", function() {
        $('<div class="modal-backdrop fade in"></div>').appendTo(document.body);
        connectionError = $.alert('No hay conexión a Internet', {
            title: 'Error',
            autoClose: false,
            type: 'danger',
            position: ['bottom-right', [0, 20]]
        });
    });

    $(window).on("online", function() {
        if(connectionError) {
            $(".modal-backdrop").fadeOut(300, function() {
                $(this).remove();
            });
            connectionError.remove();
        }
    });

    // Carga página "Home"
    $('#anchor-pagina-home').click();
});

