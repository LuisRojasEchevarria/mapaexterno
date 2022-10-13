$(document).ready(function() {

    $('#infraestructura').select2({
        placeholder: "Escoger...",
        allowClear: true,
        width: '100%',
        language: 'es',
        ajax: {
            url: window.base_url + 'Dashboard01/OpcionesSelect',
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

        var id = $('#infraestructura').val();
        if (id == null) {
            $('#h_infraestructura').val('');
            return;
        }
        $('#h_infraestructura').val( id );
        $('#proyecto').val('');

        $('#proyecto').select2({
            placeholder: "Escoger...",
            allowClear: true,
            width: '100%',
            language: 'es',
            ajax: {
                url: window.base_url + 'Dashboard01/OpcionesSelectP',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        tabla: 'proyecto01',
                        columna: params.term,
                        valor: params.term,
                        page: params.page,
                        parametro: $('#h_infraestructura').val()
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
        });
    
    });

    //---------  VALORES POR DEFECTO
    $("#avance_proyecto").text('0%');
    $("#pescadores").text('0');
    $("#monto_inversion").text('0');
    $("#familiares").text('0');
    var base_url = $("#h_base_url").val();
    $("#foto_jefe_proyecto").attr("src", base_url + "upload/default.jpg");


    //--------- BUSQUEDA
    $(document).off('click.Buscar').on('click.Buscar', '#btn-buscar', function() {

        var vproyecto = $('#proyecto').val();
        var vinfraestructura = $('#infraestructura').val();

        if( vproyecto > 0 && vinfraestructura > 0 ){
            console.log(vproyecto);
            console.log(vinfraestructura);    

            var formData = new FormData();
            formData.append('infraestructura', vinfraestructura);
            formData.append('proyecto', vproyecto);

            $.ajax({
                type: 'POST',
                data: formData,
                url: window.base_url + 'Dashboard01/buscar',
                contentType: false,
                processData: false,
                success: function(result) {

                    var resp = jQuery.parseJSON(result);
                    console.log(resp);

                    if (result.substr(0, 3) === 'ERR') {
                        var serverError = result.substr(4);
                        mensajeFormulario($('#nuevo-obra-error'), 'error', true, serverError);
                    } else {

                        $("#snip").text(resp['V_COD_SNIP']);
                        $("#coduniinv").text(resp['V_COD_UNI_INV']);
                        $("#proyinv").text(resp['V_NOM']);
                        $("#contratista").text(resp['CONTRATISTA']);
                        $("#supervisor").text(resp['SUPERVISOR']);
    
                        var vmonto_inversion = resp['N_MON_INVERSION'];
                        vmonto_inversion = (vmonto_inversion / 1000000);
                        vmonto_inversion = Math.trunc(vmonto_inversion) + ' M';
    
                        $("#avance_proyecto").text('0 %');
                        $("#pescadores").text(resp['I_NUM_PESC']);
                        $("#monto_inversion").text(vmonto_inversion);
                        $("#familiares").text(resp['I_NUM_FAM']);

                        $("#jefe_proyecto").text(resp['JEFE_PROYECTO']);
                        var base_url = $("#h_base_url").val();
                        $("#foto_jefe_proyecto").attr("src", base_url + "upload/jefe/" + resp['FOTO_JEFE_PROYECTO'] );
    
                        var vnombredpa = resp['Infra_Nombre'];
                        var vlatitud = parseFloat(resp['Infra_Latitud']);
                        var vlongitud = parseFloat(resp['Infra_Longitud']);

                        initMap(vnombredpa,vlatitud,vlongitud);
                    }

                }
            });

        }else{
            mensajeSwal('buscar.dashboard');
        }


    });


    //--------- MAPA
    initMap('SEDE CENTRAL',-12.063266743004826,-77.0359750846559);

    function initMap(pnomre,platitud,plongitud) {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: platitud, lng: plongitud},
          zoom: 18,
          mapTypeId: google.maps.MapTypeId.SATELLITE
        });        


        var marker = new google.maps.Marker({
            position: {lat: platitud, lng: plongitud},
            map: map,
            title: pnomre,
            // icon: "https://reviblog.net/wp-content/uploads/2017/03/marcador.png",
          });

        marker.setMap(map); 

    //   google.maps.event.addListener(marker, 'click', function() {
    //     alert('Latitud = '+marker.getPosition().lat()+ ', Longitud = '+marker.getPosition().lng());
    //   });
        
    }

    //-------------------
});