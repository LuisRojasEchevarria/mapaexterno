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

    $("#cargo" ).prop( "disabled", false );
    $('#cargo option:eq(0)').prop('selected', true);
    $("#infraestructura" ).prop( "disabled", false );

    $('#rol').change(function() {        
        if($(this).val() == 'JEFE_PROYECTO' ){
            $( "#cargo" ).prop( "disabled", false );
        }else{
            $('#cargo option:eq(0)').prop('selected', true);
            $( "#cargo" ).prop( "disabled", true );
        }

        if($(this).val() == 'JEFE_PROYECTO' || $(this).val() == 'GESTOR_SOCIAL' ){
            $("#infraestructura" ).prop( "disabled", false );
        }else{
            $("#infraestructura" ).prop( "disabled", true );
        }
    });

});