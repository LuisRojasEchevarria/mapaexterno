$(document).ready(function() {

    $('#infraestructura').select2({
        placeholder: "Escoger...",
        allowClear: true,
        width: '100%',
        language: 'es',
        ajax: {
            url: window.base_url + 'Usuario/OpcionesSelect',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    tabla: 'infraestructura01',
                    columna: params.term,
                    valor: params.term,
                    page: params.page
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            cache: true
        },
        minimumInputLength: 0
    }).on('change', function() {
        // $('#infraestructura_norte').val($('#infraestructura_norte').val());
    });


    imprimirSelect(jQuery.parseJSON(decodeURIComponent($('#h_infraestructura').val())));

    function imprimirSelect(data) {
        var infraestructuraSelect = $('#infraestructura');

        for (var i = 0; i < data.length; i++) {
            $.get(window.base_url + 'Usuario/OpcionesSelect', { tabla: 'infraestructura02', columna: data[i].I_ID_INF }, function(result) {

                var campos = JSON.parse(result.substring(1, result.length - 1));
                var option = new Option(campos.text, campos.id, true, true);
                infraestructuraSelect.append(option).trigger('change');
                infraestructuraSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
        }
    }

});