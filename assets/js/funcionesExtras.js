// funcionesExtras.js
// Funciones utilizadas en toda el sistema

// Función para mostrar mensaje de Aviso / Error en páginas
function mensajePagina(tipo, autoclose, mensaje) {
    $.alert(mensaje, {
        title: (tipo === 'error' ? 'Error' : 'Aviso'),
        autoClose: autoclose,
        closeTime: 5000,
        type: tipo,
        position: ['bottom-right', [0, 20]]
    });

}

//Función
function mensajeSwal(msj) {
    switch (msj) {
        case 'guardar.ok':
            {
                Swal.fire('Conforme', 'Registro guardado correctamente', 'success');
                break;
            }
        case 'guardar.error':
            {
                Swal.fire({
                    title: 'Error',
                    text: 'El registro no se pudo guardar',
                    type: 'error',
                    timer: 3000
                });
                break;
            }
        case 'borrar.ok':
            {
                Swal.fire({
                    title: 'Borrado',
                    text: 'El registro se eliminó satisfactoriamente',
                    type: 'success',
                    timer: 2000
                });
                break;
            }
        case 'borrar.error':
            {
                Swal.fire({
                    title: 'Error',
                    text: 'El registro no se pudo borrar',
                    type: 'error',
                    timer: 3000
                });
                break;
            }
        case 'buscar.existe':
            {
                Swal.fire({
                    title: 'Información',
                    text: 'Existe información registrada',
                    type: 'success',
                    timer: 3000
                });
                break;
            }
        case 'buscar.noexiste':
            {
                Swal.fire({
                    title: 'Información',
                    text: 'No existe información registrada',
                    type: 'error',
                    timer: 3000
                });
                break;
            }
        case 'buscar.dashboard':
            {
                Swal.fire({
                    title: 'Información',
                    text: 'Necesita elegir la infraestructura y el proyecto',
                    type: 'error',
                    timer: 3000
                });
                break;
            }    
        case 'error.servidor':
            {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al conectarse al servidor, verifique que tenga conexión de internet.',
                    type: 'error',
                    timer: 5000
                });
                break;
            }

    }
}


// Función para mostrar mensaje de Aviso / Error en Formularios
function mensajeFormulario(contenedor, tipo, autoclose, mensaje) {
    contenedor.removeClass(tipo === 'error' ? 'alert-success' : 'alert-danger').addClass(tipo === 'error' ? 'alert-danger' : 'alert-success');
    contenedor.css('display', 'block');
    if (autoclose) contenedor.text(mensaje).delay(5000).fadeOut(500);
    else contenedor.text(mensaje).fadeIn(500);
}

// Aplica filtro por columnas en tablas
function instalarFiltrosPorColumnas(tabla, col) {
    // Recorre todas las columas instalando filtros
    tabla.columns(col === -1 ? '' : col).every(function() {
        var column = this;

        // Busca clase "filtro" en tfoot th para aplicar el elemento filtro sino agrega un select deshabilitado
        if ($(column.footer()).attr('class') === 'filtro') {
            var select = $('<select class="selectpicker form-control dropup" multiple></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    // Reemplaza comas por "|" para búsqueda múltiple
                    var valProcessed = $.trim($(this).val()).replace(/\,/g, '|');

                    // Aplicando filtro
                    column
                        .search(valProcessed, true, false)
                        .draw();
                });

            // Agregando data filtrada a opciones de elemento "select"
            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
            });
        } else {
            $('<select class="selectpicker form-control dropup" disabled></select>').appendTo($(column.footer()).empty());
        }
    });

    // Inicializando selectpicker
    $('.selectpicker').selectpicker({
        multiple: true,
        container: 'body',
        size: 4,
        actionsBox: true,
        multipleSeparator: ', ',
        title: 'Filtro',
        liveSearch: true,
        dropupAuto: false,
        selectedTextFormat: 'count > 0',
        style: 'btn-sm'
    });

    // Ajustando columnas
    tabla.columns.adjust();
}

// Elimina filtros por columnas
function desinstalarFiltrosPorColumnas(tabla) {
    // Elimina objeto selectpicker
    $('.selectpicker').selectpicker('deselectAll');
    $('.selectpicker').selectpicker('destroy');

    // Recorre todas las columnas, eliminando elemento select
    tabla.columns().every(function() {
        var column = this;
        $(column.footer()).empty();
    });
}

// Procesa archivos de texto o CSV y los convierte en tabla HTML
function procesarArchivoTabla(archivo, tabla, divTabla, divError, numFields, divOpc, divInfo, divLoad, divTablaCont, btnAplicar, inputFile) {

    // Corrobora que el archivo
    var ext = archivo.name.substr(-3);

    if (ext !== 'txt' && ext !== 'csv') {
        $(divError).css("display", "block");
        $(divError).text('Archivos tipo .' + ext.toUpperCase() + ' no están permitidos').delay(5000).fadeOut(500);
        return false;
    }

    // Creando el objeto de lectura de archivo y la variable para el resultado de procesamiento / Tipos: 'windows-1252', 'UT8'
    var reader = new FileReader();
    reader.readAsText(archivo, 'UTF8');

    // Handler de error
    reader.onerror = function(readerEvent) {
        $(divError).css("display", "block");
        $(divError).text('Error al cargar el archivo "' + archivo.name + '"').delay(5000).fadeOut(500);
        return false;
    };

    // Handler de carga
    reader.onload = function(readerEvent) {
        var lineasTotal = readerEvent.target.result.split(/\r\n|\n/);

        // Extrayendo datos linea por linea
        for (var i = 0; i < lineasTotal.length; i++) {

            // Abriendo elemento fila y recorriendo cada fila de archivo
            var del = ',';
            var data = lineasTotal[i].split(del);

            // Si el número de campo no concuerda con el seteado, aborta
            if (data.length !== numFields) {
                $(divError).css("display", "block");
                $(divError).text('El archivo cargado presenta un número de columnas diferentes a tabla destino').delay(5000).fadeOut(500);
                return false;
            } else {
                tabla += '<tr>';
                for (var j = 0; j < data.length; j++) {
                    tabla += '<td>' + data[j] + '</td>';
                }

                // Cerrando elemento fila
                tabla += '</tr>';
            }
        }

        // Cerrando tabla
        tabla += '</tbody></table>';

        // Obteniendo ID de tabla generada
        var tablaId = tabla.match('<table id="(.*)" class')[1];

        // Agregando tabla a contenedor
        $(divTabla).html(tabla);

        // Borrando funcionabilidad Datatables (si habia)
        if ($.fn.dataTable.isDataTable('#' + tablaId)) {
            $('#' + tablaId).DataTable().clear().destroy();
        }

        // Agregando funcionabilidad Datatables a tabla
        $('#' + tablaId).DataTable({
            "bDestroy": true,
            "paging": false,
            "sScrollY": '200px',
            "bScrollCollapse": true,
            "bSort": false,
            "bAutoWidth": true,
            "sScrollX": "100%",
            "sScrollXInner": "100%",
            "bLengthChange": false,
            "bProcessing": true,
            "dom": 'rtip',
            "language": {
                "lengthMenu": "Mostrando _MENU_ entradas por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando _TOTAL_ / _MAX_ registros",
                "infoEmpty": "",
                "infoFiltered": "",
                "search": "",
                "paginate": {
                    "first": "Pri",
                    "last": "Ult",
                    "next": "Sgte",
                    "previous": "Ant"
                }
            }
        });

        // Si la carga esta correcta, crea etiqueta para archivo y displaya controles de Dialog
        crearEtiquetaArchivo(archivo, divInfo, divLoad, divOpc, divTablaCont, btnAplicar, inputFile);
    };
}

// Crea un objeto con informacion de archivo cargado y realiza transisción de Divs de carga e información
function crearEtiquetaArchivo(archivo, divInfo, divLoad, divOpc, divTabla, btnAplicar, inputFile) {
    var archivoPanel = $('<div class="col-lg-12" id="archivo-cargado"><div class="panel panel-info"><div class="panel-body">' + archivo.name + ' (' + (archivo.size ? (archivo.size / 1024 | 0) + 'KB)' : '') + '<button type="button" class="close" data-target="#archivo-cargado" data-dismiss="alert">&times;</button></div></div></div>');
    $(divInfo).append(archivoPanel);

    // Oculta y muestra divs
    $(divLoad).hide();
    $(divTabla).fadeIn(500);
    $(divInfo).fadeIn(500);
    $(divOpc).fadeIn(500);
    $(btnAplicar).prop("disabled", false);

    // Refresca tabla de datos de archivo importado (cuadrar headers)
    $(divTabla).find('table').DataTable().columns.adjust();

    // Cuando se cierra el archivo cargado se regresa al estado original y resetea el seleccionador de archivos
    $('#archivo-cargado').on('closed.bs.alert', function() {
        $(divInfo).hide();
        $(divTabla).hide();
        $(divOpc).hide();
        $(btnAplicar).prop("disabled", true);
        $(divInfo).find('#archivo-cargado').remove();
        $(inputFile).replaceWith($(inputFile).val('').clone(true));
        $(divLoad).fadeIn(500);
    });
}

// Función para ajustar tabla a contenedor (para paginas con 1 tabla)
function redimensionarTabla(factor) {
    var bodyHeight = parseInt($('.dataTables_scrollBody').css('height'), 10);
    var headerHeight = parseInt($('.dataTables_scrollHead').css('height'), 10);
    var buttonsHeight = parseInt($('.dataTables_wrapper').css('height'), 10) - headerHeight - bodyHeight;
    $('.dataTables_scrollBody').css('height', ($(window).height() - (headerHeight + buttonsHeight + factor)) + 'px');
}

// Función para ajustar tabla a contenedor (para pagina Estados / Tipos - cada tabla de 1/4 de altura de página)
function redimensionarTablaEstados(factor) {
    var bodyHeight = parseInt($('.dataTables_scrollBody').css('height'), 10);
    var headerHeight = parseInt($('.dataTables_scrollHead').css('height'), 10);
    var buttonsHeight = parseInt($('.dataTables_wrapper').css('height'), 10) - headerHeight - bodyHeight;
    $('.dataTables_scrollBody').css('height', (Math.round(0.50 * $(window).height()) - (headerHeight + buttonsHeight + factor)) + 'px');
}

// Función para ajustar mapa a la altura de página
function redimensionarMapa(factor) {
    $('.mapa').css('height', ($(window).height() - factor) + 'px');
}

// Función para centrar mapa, abarcando todos los marcadores presentes
function centrarMapaMarcadores(data, googleObj, mapa) {
    if (data.length > 0) {
        //  Pasando coordenadas a objeto
        var coordLista = new Array();
        for (var i = 0; i < data.length; i++) {
            coordLista.push(new googleObj.maps.LatLng(data[i][1], data[i][2]));
        }

        // Creando limites
        var limites = new googleObj.maps.LatLngBounds();
        for (var i = 0; i < coordLista.length; i++) {
            limites.extend(coordLista[i]);
        }

        // Realizando ajuste
        mapa.setCenter(limites.getCenter());
        mapa.fitBounds(limites);
    } else {
        // Si no hay marcadores cargados, centra en mapa en "Perú"
        mapa.setCenter(new googleObj.maps.LatLng(-8.529773, -75.439524));
        mapa.setZoom(6);
    }
}

// Función para generar macadores e info Google Maps
function crearMarcadoresMapa(googleObj, mapGoogle, data, markers, lines) {
    var marker, i;
    var infoWindow = new googleObj.maps.InfoWindow();

    for (i = 0; i < data.length; i++) {
        // Solicitando marcador de acuerdo a color ingresado
        var iconInicio = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|' + data[i][3].substring(1);
        var iconFin = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|C0FF37';

        // Marcador por cada coordenada (estado NO RECUPERADO marcador no visible)
        marker = new googleObj.maps.Marker({
            position: new googleObj.maps.LatLng(data[i][1], data[i][2]),
            icon: ((i % 2) === 0 ? iconInicio : iconFin),
            visible: (i % 2 !== 0 && data[i][0].indexOf('NO RECUPERADO') > 0) ? false : true,
            map: mapGoogle
        });

        // Almacenando marcador en arreglo
        markers.push(marker);

        // Leyenda para cada marcador
        googleObj.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(data[i][0]);
                infoWindow.open(mapGoogle, marker);
            };
        })(marker, i));

        // Simbolo de flecha para definir dirección
        var flechaSimbolo = {
            path: googleObj.maps.SymbolPath.FORWARD_OPEN_ARROW
        };

        // Linea que une puntos de inicio y fin (estado NO RECUPERADO linea no visible)
        if ((i % 2) === 0) {
            var line = new googleObj.maps.Polyline({
                path: [{ lat: data[i][1], lng: data[i][2] }, { lat: data[i + 1][1], lng: data[i + 1][2] }],
                visible: (data[i][0].indexOf('NO RECUPERADO') > 0) ? false : true,
                icons: [{
                    icon: flechaSimbolo,
                    offset: '50%'
                }],
                strokeColor: '#0000FF',
                strokeOpacity: 1.0,
                strokeWeight: 3
            });

            // Almacenando polyLine en arreglo
            lines.push(line);

            // Agregando linea a mapa
            line.setMap(mapGoogle);
        }
    }
}

// Función para convertir una llave de objeto JSON a un arreglo
function convertirJSONArray(dataObj, key) {
    var arr = [];

    for (var i = 0; i < dataObj.length; i++) {
        arr.push(dataObj[i][key]);
    }

    return arr;
}

// Función para convertir el resultado de jQuery.serializeArray en objeto JSON
$.fn.serializeJSON = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

// Función para obtener elementos unicos y ordenar arreglo (ASC y DESC)
function uniqueItemsAndSort(list, typeSort) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) === -1) result.push(e);
    });

    if (typeSort === 'ASC') return result.sort();
    else if (typeSort === 'DESC') return result.reverse();
    else return result;
}

// Handler de evento al dar tecla Enter en elemento
$.fn.pressEnter = function(fn) {
    return this.each(function() {
        $(this).bind('enterPress', fn);
        $(this).keyup(function(e) {
            if (e.keyCode === 13) {
                $(this).trigger("enterPress");
            }
        });
    });
};

// Calcula diferencia entre 2 DateTime (devuelve número de horas:minutos)
function diffDateTime(dtInicio, dtFin) {
    var dtInicioObj = new Date(dtInicio);
    var dtFinObj = new Date(dtFin);

    var diff = Math.abs(dtFinObj - dtInicioObj);
    var hDec = (((diff / 1000) / 60) / 60);
    var mDec = (hDec % 1);
    var h = Math.floor(hDec);
    var m = Math.round(mDec * 60);

    if (h < 10) h = '0' + h;
    if (m < 10) m = '0' + m;

    return h + ':' + m;
}

// Calcula diferencia entre 2 Date (devuelve número de dias)
function diffDate(fechaInicioStr, fechaFinStr) {
    var msDia = 24 * 60 * 60 * 1000;
    var fechaInicio = new Date(fechaInicioStr);
    var fechaFin = new Date(fechaFinStr);
    return Math.round(Math.abs((fechaInicio.getTime() - fechaFin.getTime()) / (msDia)));
}

// Devuelve fecha actual formateada para input[type=date]
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

// Devuelve hora actual formateada para input[type=date]
Date.prototype.toTimeInputValue = (function() {
    var d = new Date();
    var h = d.getHours();
    var m = d.getMinutes();

    if (h < 10) h = '0' + h;
    if (m < 10) m = '0' + m;

    return h + ':' + m;
});

// Convierte fecha/hora formato UNIX a yyyy-mm-dd hh:mm:ss
function unixTimeConverter(UNIX_timestamp) {
    if (typeof UNIX_timestamp !== 'undefined') {
        var a = new Date(UNIX_timestamp);
        var year = a.getFullYear();
        var month = a.getMonth() < 9 ? '0' + (a.getMonth() + 1) : (a.getMonth() + 1);
        var date = a.getDate() < 10 ? '0' + a.getDate() : a.getDate();
        var hour = a.getHours() < 10 ? '0' + a.getHours() : a.getHours();
        var min = a.getMinutes() < 10 ? '0' + a.getMinutes() : a.getMinutes();
        var sec = a.getSeconds() < 10 ? '0' + a.getSeconds() : a.getSeconds();
        var timestamp = year + '-' + month + '-' + date + ' ' + hour + ':' + min + ':' + sec;
        return timestamp;
    } else return 'NO DISPONIBLE';
}

// Convierte colores en HEX a RGB
function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

// Formatea número flotante en notación moneda (a,aaa,aaa.bb)
function formatMoneda(val) {
    // Separa parte entera de decimal
    var n = val.toString().split(".");

    // Aplica coma a la primera parte
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // Combina parte entera con decimal
    return n.join(".");
}