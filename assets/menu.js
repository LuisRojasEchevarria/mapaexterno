// menu.js
// Funciones para vista menu.php

$(document).ready(function() {

    // Evento para ajustar columnas de tabla al accionar sidebar-toggle (si hay una dataTable presente en vista)
    $('a.sidebar-toggle').on('click', function() {
        if ($.fn.dataTable.isDataTable($("table[id^='tabla-']"))) {
            setTimeout(function() {
                $("table[id^='tabla-']").DataTable().columns.adjust();
                //redimensionarTabla(140);
            }, 300);
        }
    });

    // Evento para click en items de menú de navegación
    $('[id*="anchor-pagina"]').on('click', function() {
        var idPagina = $(this).attr('id').split('-')[2];
        var loadingTexto = idPagina === 'home' ? 'Inicializando Sistema...' : 'Cargando datos de ' + $(this).text() + '...';

        // Bloqueando y mostrando mensaje de carga de página
        $('#vista-central').html('');
        $('<div class="modal-backdrop fade"></div>').appendTo(document.body);
        $('#vista-central-loading-texto').html(loadingTexto);
        $('#vista-central-loading').fadeIn('slow');
        // Recibiendo contenido de página (flag en "true" por estar llamando página completa + data)
        $.ajax({
            type: 'GET',
            url: window.base_url + '' + idPagina,
            data: 'primera_carga=true',
            success: function(result) {
                // Oculta mensaje de carga de página
                $('#vista-central-loading').hide();
                $('.modal-backdrop').fadeOut(300, function() { $(this).remove(); });

                // Carga página en contenedor de vista main.php
                $('#vista-central').hide().html(result).fadeIn('slow');
            }
        });
        //Cambiar foto de la mascota
        if(idPagina === 'mapa/indexinfraestructuras' || idPagina === 'mapa/indexproyectos'){
            $('#logo_mascota_d').html('');
            $('#logo_mascota_d').html('<img src="' + window.base_url + 'assets/img/mascota_base_explorador.jpeg" class="" alt="Mapa Interactivo" width ="100%" height="130%" ><legend style="display: flex;"><h4></h4></legend>');
        } else {
            $('#logo_mascota_d').html('');
            $('#logo_mascota_d').html('<img src="' + window.base_url + 'assets/img/mascota_base.png" class="" alt="Mapa Interactivo" width ="100%" height="130%" ><legend style="display: flex;"><h4></h4></legend>');
        }
    });
});