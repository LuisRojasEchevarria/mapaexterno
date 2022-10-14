//Llenando Filtros*******
$.ajax({
    url: window.base_url + 'mapa/listadepartamentos',
    type:'post',
    data: {
    },
    beforeSend: function(e){
        // console.log(e);
    },
    success: function(data){
        var c = JSON.parse(data);
        $('#filtro_depa').append('<option value="TODOS">TODOS</option>');
        c.forEach(function(valor,indice,array){
            // console.log(valor);
            if(valor.Dpto_Id != '00'){
                $('#filtro_depa').append('<option value="' + valor.Dpto_Id + '">' + valor.Dpto_Nombre + '</option>');
            }
        });
    },
    error: function(e){
        // console.log(e);
    }
});
$('#filtro_depa').change(function(){
    var val = $('#filtro_depa').val();
    console.log(val);
    $.ajax({
        url: window.base_url + 'mapa/listadeipa',
        type:'post',
        data: {
            depa: val
        },
        beforeSend: function(e){
            // console.log(e);
        },
        success: function(data){
            var c = JSON.parse(data);
            if(c!='ERROR'){
                $('#filtro_tipo').html('');
                if(c.length>1){
                    $('#filtro_tipo').append('<option value="TODOS">TODOS</option>');
                }
                c.forEach(function(valor,indice,array){
                    $('#filtro_tipo').append('<option value="' + valor.Infra_Id + '">' + valor.NOM + '</option>');
                });
            } else {
                $('#filtro_tipo').html('');
            }
        },
        error: function(e){
            // console.log(e);
        }
    });
    var mensaje = 'No encontramos Infraestructuras dentro de su búsqueda.';
    FiltrarIpas(mensaje);
});
$('#filtro_tipo').change(function(){
    var val = $('#filtro_tipo').val();
    if(val=='TODOS'){
        var mensaje = 'No encontramos Infraestructuras dentro de su búsqueda.';
        FiltrarIpas(mensaje);
    } else {
        $.ajax({
            url: window.base_url + 'mapa/obtenercoordenadas',
            type:'post',
            data: {
                id: val
            },
            beforeSend: function(e){
                // console.log(e);
            },
            success: function(data){
                var c = JSON.parse(data);
                var lat = '';
                var lon = '';
                if(c!='ERROR'){
                    c.forEach(function(valor,indice,array){
                        lat = valor.Infra_Latitud;
                        lon = valor.Infra_Longitud;
                        FocusMarker(lat,lon)
                    });
                } else {
                    lat = valor.Infra_DepLatitud;
                    lon = valor.Infra_DepLongitud;
                    FocusMarker(lat,lon)
                }
            },
            error: function(e){
                // console.log(e);
            }
        });
    }
    
    var mensaje = 'No encontramos Infraestructuras dentro de su búsqueda.';
    FiltrarIpas(mensaje);
});

$('#filtro_depa').select2({}).on('change', function() {});
$('#filtro_tipo').select2({}).on('change', function() {});

$('#btn_filtrar_mapa').click(function(){
    var mensaje = 'No encontramos Infraestructuras dentro de su búsqueda.';
    FiltrarIpas(mensaje);
});

$('#btn_limpiarfiltro_mapa').click(function(){
    $('#filtro_depa').val("TODOS").trigger("change");
    $('#filtro_tipo').html("");
    $('#filtro_nombre').val("");
});

document.getElementById("div_numflotante").style.display = "none";
document.getElementById("div_listadepa").style.display = "none";
document.getElementById("div_listatipo").style.display = "none";
document.getElementById("div_listahabi").style.display = "none";
document.getElementById("div_listatra").style.display = "none";
document.getElementById("div_listaope").style.display = "none";
document.getElementById("div_audio").style.display = "none";
$('#btn_cerrar_numflotante').click(function(){
    document.getElementById("div_numflotante").style.display = "none";
});

//Iniciando mapa********
var USGS_USImageryTopo ;
var mapboxAttribution = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
var mapboxUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
var streets;
var satellite; 
var CyclOSM;
var osm;
var map;
var baseMaps;
var layerControl;
var Marcador;

function initMap(){
    USGS_USImageryTopo = L.tileLayer('https://basemap.nationalmap.gov/arcgis/rest/services/USGSImageryTopo/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 20,
        attribution: ''
        // attribution: 'Tiles courtesy of the <a href="https://usgs.gov/">U.S. Geological Survey</a>'
    });
    
    streets = L.tileLayer(mapboxUrl, {
        id: 'mapbox/streets-v11', 
        tileSize: 512, 
        maxZoom: 20,
        zoomOffset: -1, 
        attribution: ''
    });
    
    satellite = L.tileLayer(mapboxUrl, {
        id: 'mapbox/satellite-v9', 
        tileSize: 512, 
        maxZoom: 20,
        zoomOffset: -1, 
        attribution: ''
    });
    
    CyclOSM = L.tileLayer('https://{s}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: ''
        // attribution: '<a href="https://github.com/cyclosm/cyclosm-cartocss-style/releases" title="CyclOSM - Open Bicycle render">CyclOSM</a> | Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: ''
        // attribution: '© OpenStreetMap'
    });
    
    map = L.map('map', {
        center: [-12.064137562030421, -77.03555666235727],
        zoom: 5,
        layers: [satellite]
    });
    
    baseMaps = {
        "Satélite": satellite,
        "Calles": streets
    };

    layerControl = L.control.layers(baseMaps).addTo(map);
    layerControl.addBaseLayer(USGS_USImageryTopo, "Topográfico");
    layerControl.addBaseLayer(CyclOSM, "Ciclovías");
    layerControl.addBaseLayer(osm, "OpenStreetMap");

    L.geoJson(regiones).addTo(map);

    $('.leaflet-interactive').attr('stroke','#ffffff');
    $('.leaflet-interactive').attr('fill','#ffffff');

    // Marcador = L.ExtraMarkers.Icon({
    //     icon: 'fa-ship',
    //     markerColor: 'green-light',
    //     shape: 'circle',
    //     prefix: 'fa'
    // });

    iniMarcadores();

}

function iniMarcadores(){
    $.ajax({
        url: window.base_url + 'mapa/ipas',
        type:'post',
        data: {
        },
        beforeSend: function(e){
            $('#divmapa-loading').show();
            // console.log(e);
        },
        success: function(data){
            var c = JSON.parse(data);
            c.forEach(function(valor,indice,array){
                // console.log(valor);
                var GrupoMarcador = new L.marker([valor.Infra_Latitud,valor.Infra_Longitud])
                    .bindPopup('<a href="#"><span><h4 style="text-align: center;"><b>'+valor.Infra_Nombre+'</b></h4></span></a><span><h2 style="font-size: 14px; text-align: center;">'+valor.Departamento+' - '+valor.Provincia+' - '+valor.Distrito+'</h2></span>')
                    // .setIcon(greenIcon)
                    .on('click', function(e) { markerOnClick(e, valor.Infra_Id); })
                    .on('mouseover', function(ev) { ev.target.openPopup(); });
                    marcadorposicion.push(GrupoMarcador);
                    
            });
            for(i=0; i<marcadorposicion.length; i++){
                map.addLayer(marcadorposicion[i]);
            }
            $('#divmapa-loading').hide();
        },
        error: function(e){
            // console.log(e);
        }
    });
}

// L.marker([-12.064137562030421, -77.03555666235727]).addTo(map)
//     .bindPopup('FONDEPES')
//     .setIcon(Marcador);
    // .openPopup();

var marcadorposicion = new Array();
var arrayipadepa = new Array();
var arrayipahabi = new Array();
var arrayipatra = new Array();
var arrayipatipo = new Array();
var arrayipaope = new Array();
var arrayipanohabi = new Array();
var arrayipanotra = new Array();
var arrayipanoope = new Array();

function BorrarMarcador() {
    for(i=0;i<marcadorposicion.length;i++) {
        map.removeLayer(marcadorposicion[i]);
    }
    if(marcadorposicion.length>0){
        marcadorposicion.length = 0;
    } else {
        
    }
}

function ResetArray(){
    if(arrayipadepa.length>0){
        arrayipadepa.length = 0;
    }
    if(arrayipatipo.length>0){
        arrayipatipo.length = 0;
    }
    if(arrayipahabi.length>0){
        arrayipahabi.length = 0;
    }
    if(arrayipatra.length>0){
        arrayipatra.length = 0;
    }
    if(arrayipaope.length>0){
        arrayipaope.length = 0;
    }
    if(arrayipanohabi.length>0){
        arrayipanohabi.length = 0;
    }
    if(arrayipanotra.length>0){
        arrayipanotra.length = 0;
    }
    if(arrayipanoope.length>0){
        arrayipanoope.length = 0;
    }
}

function FiltrarIpas(mensaje){
    var depa = $('#filtro_depa').val();
    var tipo = $('#filtro_tipo').val();
    var nombreipa = $('#filtro_nombre').val();
    if(tipo == '' || tipo == null || tipo == undefined){ tipo = 'TODOS'; }

    $.ajax({
        url: window.base_url + 'mapa/ipasxfiltro',
        type:'post',
        data: {
            depa: depa,
            tipo: tipo,
            nombre: nombreipa
        },
        beforeSend: function(e){
            $('#divmapa-loading').show();
            // console.log(e);
        },
        success: function(data){
            var c = JSON.parse(data);
            if(c != 'ERROR'){
                BorrarMarcador();
                ResetArray();
                CerrarDivDatos();  
                CerrarNum();
                CerrarDepa();
                CerrarTipo();
                CerrarHabi();
                CerrarTra();
                CerrarOpe();
                CerrarNoHabi();
                CerrarNoTra();
                CerrarNoOpe();
                var contipadepa = 0;
                var contipatipo = 0;
                var contipahabi = 0;
                var contipatra = 0;
                var contipaope = 0;
                var contipanohabi = 0;
                var contipanotra = 0;
                var contipanoope = 0;
                var numipas = 0;
                var valipadepa = '';
                var valipatipo = '';
                var valipahabi = '';
                var valipatra = '';
                var valipaope = '';
                var valipanohabi = '';
                var valipanotra = '';
                var valipanoope = '';
                numipas = c.length;
                var trtipo = '';
                var trhabi = '';
                var trtra = '';
                var trope = '';
                var trnohabi = '';
                var trnotra = '';
                var trnoope = '';
                if(depa !='TODOS'){
                    contipadepa = c.length;
                    valipadepa = c[0].Departamento;
                    var depalati = c[0].Infra_DepLatitud;
                    var depalong = c[0].Infra_DepLongitud;
                    map.setView([depalati, depalong], 8);
                    for(d=0; d<c.length; d++){
                        arrayipadepa.push([c[d].Infra_Nombre,c[d].Infra_Latitud,c[d].Infra_Longitud]);
                    }
                } else {
                    map.setView([-12.064137562030421, -77.03555666235727], 5);
                }
                if(tipo !='TODOS'){
                    for(t=0; t<c.length; t++){
                        if(c[t].Infra_Tipo == tipo){ 
                            contipatipo++;
                            arrayipatipo.push([c[t].Infra_Nombre,c[t].Infra_Latitud,c[t].Infra_Longitud]);
                        }
                    }
                    valipatipo = tipo;
                    if(contipatipo>0){
                        trtipo = '<tr>'+
                                    '<td style="padding-left: 20px; font-size: 20px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+
                                        '<b style="font-size: 22px;">'+contipatipo+'</b> de Tipo '+valipatipo+''+
                                    '</td>'+
                                    //     '<button type="button" id="verlistatipo" onclick="AbrirListaTipo('+valipatipo+');" style="background-color: transparent; border: none;">'+
                                    //     '<i class="fa-solid fa-eye"></i></button>'+
                                    // '</td>'+
                                '</tr>';
                    }
                } 
                for(h=0; h<c.length; h++){
                    if(c[h].B_HAB == 1){ 
                        contipahabi++;
                        arrayipahabi.push([c[h].Infra_Nombre,c[h].Infra_Latitud,c[h].Infra_Longitud]);
                    } else if (c[h].B_HAB == 0){ 
                        contipanohabi++;
                        arrayipanohabi.push([c[h].Infra_Nombre,c[h].Infra_Latitud,c[h].Infra_Longitud]);
                    } 
                }
                if(contipahabi>1){ valipahabi = 'Habilitados'; } else { valipahabi = 'Habilitado'; }
                if(contipanohabi>1){ valipanohabi = 'No Habilitados'; } else { valipanohabi = 'No Habilitado'; }
                if(contipahabi>0){
                    trhabi = '<tr>'+
                                '<td style="padding-left: 20px; font-size: 20px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+
                                    '<b style="font-size: 22px;">'+contipahabi+'</b> '+valipahabi+' '+
                                    '<button type="button" id="verlistahabi" onclick="AbrirListaHabi(1);" style="background-color: transparent; border: none;">'+
                                    '<i class="fa-solid fa-eye"></i></button>'+
                                '</td>'+
                            '</tr>';
                }
                if(contipanohabi>0){
                    trnohabi = '<tr>'+
                                '<td style="padding-left: 20px; font-size: 20px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+
                                    '<b style="font-size: 22px;">'+contipanohabi+'</b> '+valipanohabi+' '+
                                    '<button type="button" id="verlistanohabi" onclick="AbrirListaNoHabi(0);" style="background-color: transparent; border: none;">'+
                                    '<i class="fa-solid fa-eye"></i></button>'+
                                '</td>'+
                            '</tr>';
                }
                for(s=0; s<c.length; s++){
                    if(c[s].B_TRANS == 1){ 
                        contipatra++; 
                        arrayipatra.push([c[s].Infra_Nombre,c[s].Infra_Latitud,c[s].Infra_Longitud]);
                    } else if(c[s].B_TRANS == 0){ 
                        contipanotra++; 
                        arrayipanotra.push([c[s].Infra_Nombre,c[s].Infra_Latitud,c[s].Infra_Longitud]);
                    }
                }
                if(contipatra>1){ valipatra = 'Transferidos'; } else { valipatra = 'Transferido'; }
                if(contipanotra>1){ valipanotra = 'No Transferidos'; } else { valipanotra = 'No Transferido'; }
                if(contipatra>0){
                    trtra = '<tr>'+
                                '<td style="padding-left: 20px; font-size: 20px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+
                                    '<b style="font-size: 22px;">'+contipatra+'</b> '+valipatra+' '+
                                    '<button type="button" id="verlistatra" onclick="AbrirListaTra(1);" style="background-color: transparent; border: none;">'+
                                    '<i class="fa-solid fa-eye"></i></button>'+
                                '</td>'+
                            '</tr>';
                }
                if(contipanotra>0){
                    trnotra = '<tr>'+
                                '<td style="padding-left: 20px; font-size: 20px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+
                                    '<b style="font-size: 22px;">'+contipanotra+'</b> '+valipanotra+' '+
                                    '<button type="button" id="verlistanotra" onclick="AbrirListaNoTra(0);" style="background-color: transparent; border: none;">'+
                                    '<i class="fa-solid fa-eye"></i></button>'+
                                '</td>'+
                            '</tr>';
                }
                for(o=0; o<c.length; o++){
                    if(c[o].I_EST == 1){ 
                        contipaope++;
                        arrayipaope.push([c[o].Infra_Nombre,c[o].Infra_Latitud,c[o].Infra_Longitud]);
                    } else if(c[o].I_EST == 0){ 
                        contipanoope++;
                        arrayipanoope.push([c[o].Infra_Nombre,c[o].Infra_Latitud,c[o].Infra_Longitud]);
                    }
                }
                if(contipaope>1){ valipaope = 'Operativos'; } else { valipaope = 'Operativo'; }
                if(contipanoope>1){ valipanoope = 'No Operativos'; } else { valipanoope = 'No Operativo'; }
                if(contipaope>0){
                    trope = '<tr>'+
                                '<td style="padding-left: 20px; font-size: 20px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+
                                    '<b style="font-size: 22px;">'+contipaope+'</b> '+valipaope+' '+
                                    '<button type="button" id="verlistaope" onclick="AbrirListaOpe(1);" style="background-color: transparent; border: none;">'+
                                    '<i class="fa-solid fa-eye"></i></button>'+
                                '</td>'+
                            '</tr>';
                }
                if(contipanoope>0){
                    trnoope = '<tr>'+
                                '<td style="padding-left: 20px; font-size: 20px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+
                                    '<b style="font-size: 22px;">'+contipanoope+'</b> '+valipanoope+' '+
                                    '<button type="button" id="verlistanoope" onclick="AbrirListaNoOpe(0);" style="background-color: transparent; border: none;">'+
                                    '<i class="fa-solid fa-eye"></i></button>'+
                                '</td>'+
                            '</tr>';
                }
                if(c.length==1){ FocusMarker(c[0].Infra_Latitud,c[0].Infra_Longitud);}
                c.forEach(function(valor,indice,array){
                    var GrupoMarcador = new L.marker([valor.Infra_Latitud,valor.Infra_Longitud])
                        .bindPopup('<a href="#"><span><h4 style="text-align: center;"><b>'+valor.Infra_Nombre+'</b></h4></span></a><span><h2 style="font-size: 14px; text-align: center;">'+valor.Departamento+' - '+valor.Provincia+' - '+valor.Distrito+'</h2></span>')
                        // .setIcon(greenIcon)
                        .on('click', function(e) { markerOnClick(e, valor.Infra_Id); })
                        .on('mouseover', function(ev) { ev.target.openPopup(); });
                        marcadorposicion.push(GrupoMarcador);
                });
                for(i=0; i<marcadorposicion.length; i++){
                    map.addLayer(marcadorposicion[i]);
                }
                $('#div_num_modificar').html('');
                $('#div_num_modificar').html(''+
                    '<table class="table-condensed" style="width: 100%;">'+
                        '<thead>'+
                            '<th id="arrastrar_num" style="padding-left: 20px; padding-right: 10px; padding-bottom: 0px; background-color: #9fbf60; color: #16385C; width: 100%; border-radius: 15px 15px 0px 0px; text-align: left; font-size:20px;">'+
                                '<button type="button" class="close" id="btn_cerrar_numflotante" onclick="CerrarNum();" style="color: black;font-weight: bold;font-size: 18px;">&times;</button>'+
                                '<b style="font-size: 55px; line-height: 70px;">'+ numipas +'</b> DPA <a href="#" type="button" id="vernombredepa" onClick="AbrirListaDepa();" style="color: #16385C !important;">'+ valipadepa +'</a>'+
                            '</th>'+
                        '</thead>'+
                        '<tbody class="table-wrapper-scroll-y my-custom-scrollbar">'+
                            ''+ trtipo + ''+
                            ''+ trhabi + ''+
                            ''+ trnohabi + ''+
                            ''+ trtra + ''+
                            ''+ trnotra + ''+
                            ''+ trope + ''+
                            ''+ trnoope + ''+
                        '</tbody>'+
                    '</table>'+
                '');
                if(depa !='TODOS' || tipo !='TODOS'){
                    document.getElementById("div_numflotante").style.display = "block";
                }
                $('#tablalistadepa thead').html('');
                $('#tablalistadepa tbody').html('');
                if(depa !='TODOS'){
                    $('#tablalistadepa thead').append(''+
                        '<th id="arrastrar_depa" style="background-color: #9fbf60; color: #16385C; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px; padding-left: 20px;" colspan="1">DPA EN '+ valipadepa +''+
                            '<button type="button" class="close" id="btn_cerrar_div_listadepa" onclick="CerrarDepa();" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>'+
                        '</th>'+
                    '');
                    for(nd=0; nd<arrayipadepa.length; nd++){
                        $('#tablalistadepa tbody').append(''+
                            '<tr>'+
                                '<td style="padding-left: 20px; font-size: 14px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+arrayipadepa[nd][0]+' <i class="fa fa-location-dot" onclick="FocusMarker('+arrayipadepa[nd][1]+','+arrayipadepa[nd][2]+');"></i></td>'+
                            '</tr>'+
                        '');
                    }
                }
                $('#tablalistatipo thead').html('');
                $('#tablalistatipo tbody').html('');
                if(tipo !='TODOS'){
                    $('#tablalistatipo thead').append(''+
                        '<th id="arrastrar_tipo" style="background-color: #9fbf60; color: #16385C; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px; padding-left: 20px;" colspan="1">IPAS DE TIPO '+ valipatipo +''+
                            '<button type="button" class="close" id="btn_cerrar_div_listatipo" onclick="CerrarTipo();" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>'+
                        '</th>'+
                    '');
                    for(nd=0; nd<arrayipatipo.length; nd++){
                        $('#tablalistatipo tbody').append(''+
                            '<tr>'+
                                '<td style="padding-left: 20px; font-size: 14px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+arrayipatipo[nd][0]+' <i class="fa fa-location-dot" onclick="FocusMarker('+arrayipatipo[nd][1]+','+arrayipatipo[nd][2]+');"></i></td>'+
                            '</tr>'+
                        '');
                    }
                }
                $('#tablalistahabi thead').html('');
                $('#tablalistahabi tbody').html('');
                $('#tablalistahabi thead').append(''+
                    '<th id="arrastrar_habi" style="background-color: #9fbf60; color: #16385C; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px; padding-left: 20px;" colspan="1">DPA HABILITADOS'+
                        '<button type="button" class="close" id="btn_cerrar_div_listahabi" onclick="CerrarHabi();" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>'+
                    '</th>'+
                '');
                for(nd=0; nd<arrayipahabi.length; nd++){
                    $('#tablalistahabi tbody').append(''+
                        '<tr>'+
                            '<td style="padding-left: 20px; font-size: 14px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+arrayipahabi[nd][0]+' <i class="fa fa-location-dot" onclick="FocusMarker('+arrayipahabi[nd][1]+','+arrayipahabi[nd][2]+');"></i></td>'+
                        '</tr>'+
                    '');
                }
                $('#tablalistatra thead').html('');
                $('#tablalistatra tbody').html('');
                $('#tablalistatra thead').append(''+
                    '<th id="arrastrar_tra" style="background-color: #9fbf60; color: #16385C; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px; padding-left: 20px;" colspan="1">DPA TRANSFERIDOS'+
                        '<button type="button" class="close" id="btn_cerrar_div_listatra" onclick="CerrarTra();" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>'+
                    '</th>'+
                '');
                for(nd=0; nd<arrayipatra.length; nd++){
                    $('#tablalistatra tbody').append(''+
                        '<tr>'+
                            '<td style="padding-left: 20px; font-size: 14px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+arrayipatra[nd][0]+' <i class="fa fa-location-dot" onclick="FocusMarker('+arrayipatra[nd][1]+','+arrayipatra[nd][2]+');"></i></td>'+
                        '</tr>'+
                    '');
                }
                $('#tablalistaope thead').html('');
                $('#tablalistaope tbody').html('');
                $('#tablalistaope thead').append(''+
                    '<th id="arrastrar_ope" style="background-color: #9fbf60; color: #16385C; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px; padding-left: 20px;" colspan="1">DPA OPERATIVOS'+
                        '<button type="button" class="close" id="btn_cerrar_div_listaope" onclick="CerrarOpe();" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>'+
                    '</th>'+
                '');
                for(nd=0; nd<arrayipaope.length; nd++){
                    $('#tablalistaope tbody').append(''+
                        '<tr>'+
                            '<td style="padding-left: 20px; font-size: 14px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+arrayipaope[nd][0]+' <i class="fa fa-location-dot" onclick="FocusMarker('+arrayipaope[nd][1]+','+arrayipaope[nd][2]+');"></i></td>'+
                        '</tr>'+
                    '');
                }
                $('#tablalistanohabi thead').html('');
                $('#tablalistanohabi tbody').html('');
                $('#tablalistanohabi thead').append(''+
                    '<th id="arrastrar_habi" style="background-color: #9fbf60; color: #16385C; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px; padding-left: 20px;" colspan="1">DPAS NO HABILITADOS'+
                        '<button type="button" class="close" id="btn_cerrar_div_listanohabi" onclick="CerrarNoHabi();" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>'+
                    '</th>'+
                '');
                for(nd=0; nd<arrayipanohabi.length; nd++){
                    $('#tablalistanohabi tbody').append(''+
                        '<tr>'+
                            '<td style="padding-left: 20px; font-size: 14px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+arrayipanohabi[nd][0]+' <i class="fa fa-location-dot" onclick="FocusMarker('+arrayipanohabi[nd][1]+','+arrayipanohabi[nd][2]+');"></i></td>'+
                        '</tr>'+
                    '');
                }
                $('#tablalistanotra thead').html('');
                $('#tablalistanotra tbody').html('');
                $('#tablalistanotra thead').append(''+
                    '<th id="arrastrar_tra" style="background-color: #9fbf60; color: #16385C; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px; padding-left: 20px;" colspan="1">DPAS NO TRANSFERIDOS'+
                        '<button type="button" class="close" id="btn_cerrar_div_listanotra" onclick="CerrarNoTra();" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>'+
                    '</th>'+
                '');
                for(nd=0; nd<arrayipanotra.length; nd++){
                    $('#tablalistanotra tbody').append(''+
                        '<tr>'+
                            '<td style="padding-left: 20px; font-size: 14px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+arrayipanotra[nd][0]+' <i class="fa fa-location-dot" onclick="FocusMarker('+arrayipanotra[nd][1]+','+arrayipanotra[nd][2]+');"></i></td>'+
                        '</tr>'+
                    '');
                }
                $('#tablalistanoope thead').html('');
                $('#tablalistanoope tbody').html('');
                $('#tablalistanoope thead').append(''+
                    '<th id="arrastrar_ope" style="background-color: #9fbf60; color: #16385C; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px; padding-left: 20px;" colspan="1">DPAS NO OPERATIVOS'+
                        '<button type="button" class="close" id="btn_cerrar_div_listanoope" onclick="CerrarNoOpe();" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>'+
                    '</th>'+
                '');
                for(nd=0; nd<arrayipanoope.length; nd++){
                    $('#tablalistanoope tbody').append(''+
                        '<tr>'+
                            '<td style="padding-left: 20px; font-size: 14px;"><i class="fa-solid fa-minus" style="font-size: 15px;"></i> '+arrayipanoope[nd][0]+' <i class="fa fa-location-dot" onclick="FocusMarker('+arrayipanoope[nd][1]+','+arrayipanoope[nd][2]+');"></i></td>'+
                        '</tr>'+
                    '');
                }
                $('#divmapa-loading').hide();
            } else {
                swal({
                    title: "ERROR",
                    text: "No se encontraron registros",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar",
                    footer: '<center><b><i>'+ mensaje +'</i></b></center>'
                });
                $('#divmapa-loading').hide();
            }
        },
        error: function(e){
            // console.log(e);
        }
    });
}

function MostrarIpasLista(de,ti,ha,ta,op){
    var depa = de;
    var tipo = ti;
    var habi = ha;
    var transf = ta;
    var ope = op;

    $.ajax({
        url: window.base_url + 'mapa/ipasxfiltro',
        type:'post',
        data: {
            depa: depa,
            tipo: tipo,
            habi: habi,
            transf: transf,
            ope: ope
        },
        beforeSend: function(e){
            $('#divmapa-loading').show();
            // console.log(e);
        },
        success: function(data){
            var c = JSON.parse(data);
            if(c != 'ERROR'){
                BorrarMarcador();
                c.forEach(function(valor,indice,array){
                    var GrupoMarcador = new L.marker([valor.Infra_Latitud,valor.Infra_Longitud])
                        .bindPopup('<a href="#"><span><h4 style="text-align: center;"><b>'+valor.Infra_Nombre+'</b></h4></span></a><span><h2 style="font-size: 14px; text-align: center;">'+valor.Departamento+' - '+valor.Provincia+' - '+valor.Distrito+'</h2></span>')
                        // .setIcon(greenIcon)
                        .on('click', function(e) { markerOnClick(e, valor.Infra_Id); })
                        .on('mouseover', function(ev) { ev.target.openPopup(); });
                        marcadorposicion.push(GrupoMarcador);
                });
                for(i=0; i<marcadorposicion.length; i++){
                    map.addLayer(marcadorposicion[i]);
                }
                $('#divmapa-loading').hide();
            } else {
                swal({
                    title: "ERROR",
                    text: "No se encontraron registros",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar",
                    footer: '<center><b><i>No encontramos Infraestructuras dentro de su búsqueda.</i></b></center>'
                });
                $('#divmapa-loading').hide();
            }
        },
        error: function(e){
            // console.log(e);
        }
    });
}

function FocusMarker(lat,lon){
    map.setView([lat, lon], 12);
    CerrarDivDatos();
}

function CerrarDivDatos(){
    document.getElementById("seccion_cards").style.cssText = "position: absolute;top: 115px;right: 15px;width: 640px;display: none;transition: right 0.5s; z-index: 1997;padding-left: 0px;padding-right: 0px;height: 630px;overflow-y: auto;";
    document.getElementById("div_audio").style.cssText = "position: absolute; top: 570px; left: 350px; width: auto; height: auto; display: none; z-index: 1997; padding: 0px; background-color: transparent;";
    $('#div_audio').html('');
}

$('#btn_cerrar_divdatosipa').click(function(){
    CerrarDivDatos();
});

function CerrarNum(){
    document.getElementById("div_numflotante").style.cssText = "position: absolute;top: 90px;left: 20px;width: 300px;height: 280px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function CerrarDepa(){
    document.getElementById("div_listadepa").style.cssText = "position: absolute;top: 380px;left: 20px;width: 300px;height: 250px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function AbrirListaDepa(){
    document.getElementById("div_listadepa").style.display = "block";
    document.getElementById("div_listatipo").style.display = "none";
    document.getElementById("div_listahabi").style.display = "none";
    document.getElementById("div_listatra").style.display = "none";
    document.getElementById("div_listaope").style.display = "none";
    document.getElementById("div_listanohabi").style.display = "none";
    document.getElementById("div_listanotra").style.display = "none";
    document.getElementById("div_listanoope").style.display = "none";
    document.getElementById("div_audio").style.display = "none";
}
function CerrarTipo(){
    document.getElementById("div_listatipo").style.cssText = "position: absolute;top: 380px;left: 20px;width: 300px;height: 250px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function AbrirListaTipo(DPA){
    var de = $('#filtro_depa').val();
    var tip = DPA;
    var ha = $('#filtro_hab').val();
    var ta = $('#filtro_trans').val();
    var op = $('#filtro_ope').val();
    document.getElementById("div_listatipo").style.display = "block";
    document.getElementById("div_listadepa").style.display = "none";
    document.getElementById("div_listahabi").style.display = "none";
    document.getElementById("div_listatra").style.display = "none";
    document.getElementById("div_listaope").style.display = "none";
    document.getElementById("div_listanohabi").style.display = "none";
    document.getElementById("div_listanotra").style.display = "none";
    document.getElementById("div_listanoope").style.display = "none";
    document.getElementById("div_audio").style.display = "none";
    MostrarIpasLista(de,tip,ha,ta,op);
}
function CerrarHabi(){
    document.getElementById("div_listahabi").style.cssText = "position: absolute;top: 380px;left: 20px;width: 300px;height: 250px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function AbrirListaHabi(ha){
    var de = $('#filtro_depa').val();
    var ti = $('#filtro_tipo').val();
    var hab = ha;
    var ta = $('#filtro_trans').val();
    var op = $('#filtro_ope').val();
    document.getElementById("div_listahabi").style.display = "block";
    document.getElementById("div_listadepa").style.display = "none";
    document.getElementById("div_listatipo").style.display = "none";
    document.getElementById("div_listatra").style.display = "none";
    document.getElementById("div_listaope").style.display = "none";
    document.getElementById("div_listanohabi").style.display = "none";
    document.getElementById("div_listanotra").style.display = "none";
    document.getElementById("div_listanoope").style.display = "none";
    document.getElementById("div_audio").style.display = "none";
    MostrarIpasLista(de,ti,hab,ta,op);
}
function CerrarTra(){
    document.getElementById("div_listatra").style.cssText = "position: absolute;top: 380px;left: 20px;width: 300px;height: 250px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function AbrirListaTra(ta){
    var de = $('#filtro_depa').val();
    var ti = $('#filtro_tipo').val();
    var ha = $('#filtro_hab').val();
    var tas = ta;
    var op = $('#filtro_ope').val();
    document.getElementById("div_listatra").style.display = "block";
    document.getElementById("div_listadepa").style.display = "none";
    document.getElementById("div_listatipo").style.display = "none";
    document.getElementById("div_listahabi").style.display = "none";
    document.getElementById("div_listaope").style.display = "none";
    document.getElementById("div_listanohabi").style.display = "none";
    document.getElementById("div_listanotra").style.display = "none";
    document.getElementById("div_listanoope").style.display = "none";
    document.getElementById("div_audio").style.display = "none";
    MostrarIpasLista(de,ti,ha,tas,op);
}
function CerrarOpe(){
    document.getElementById("div_listaope").style.cssText = "position: absolute;top: 380px;left: 20px;width: 300px;height: 250px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function AbrirListaOpe(op){
    var de = $('#filtro_depa').val();
    var ti = $('#filtro_tipo').val();
    var ha = $('#filtro_hab').val();
    var ta = $('#filtro_trans').val();
    var opr = op;
    document.getElementById("div_listaope").style.display = "block";
    document.getElementById("div_listadepa").style.display = "none";
    document.getElementById("div_listatipo").style.display = "none";
    document.getElementById("div_listahabi").style.display = "none";
    document.getElementById("div_listatra").style.display = "none";
    document.getElementById("div_listanohabi").style.display = "none";
    document.getElementById("div_listanotra").style.display = "none";
    document.getElementById("div_listanoope").style.display = "none";
    document.getElementById("div_audio").style.display = "none";
    MostrarIpasLista(de,ti,ha,ta,opr);
}

function CerrarNoHabi(){
    document.getElementById("div_listanohabi").style.cssText = "position: absolute;top: 380px;left: 20px;width: 300px;height: 250px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function AbrirListaNoHabi(ha){
    var de = $('#filtro_depa').val();
    var ti = $('#filtro_tipo').val();
    var hab = ha;
    var ta = $('#filtro_trans').val();
    var op = $('#filtro_ope').val();
    document.getElementById("div_listahabi").style.display = "none";
    document.getElementById("div_listadepa").style.display = "none";
    document.getElementById("div_listatipo").style.display = "none";
    document.getElementById("div_listatra").style.display = "none";
    document.getElementById("div_listaope").style.display = "none";
    document.getElementById("div_listanohabi").style.display = "block";
    document.getElementById("div_listanotra").style.display = "none";
    document.getElementById("div_listanoope").style.display = "none";
    document.getElementById("div_audio").style.display = "none";
    MostrarIpasLista(de,ti,hab,ta,op);
}
function CerrarNoTra(){
    document.getElementById("div_listanotra").style.cssText = "position: absolute;top: 380px;left: 20px;width: 300px;height: 250px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function AbrirListaNoTra(ta){
    var de = $('#filtro_depa').val();
    var ti = $('#filtro_tipo').val();
    var ha = $('#filtro_hab').val();
    var tas = ta;
    var op = $('#filtro_ope').val();
    document.getElementById("div_listatra").style.display = "none";
    document.getElementById("div_listadepa").style.display = "none";
    document.getElementById("div_listatipo").style.display = "none";
    document.getElementById("div_listahabi").style.display = "none";
    document.getElementById("div_listaope").style.display = "none";
    document.getElementById("div_listanohabi").style.display = "none";
    document.getElementById("div_listanotra").style.display = "block";
    document.getElementById("div_listanoope").style.display = "none";
    document.getElementById("div_audio").style.display = "none";
    MostrarIpasLista(de,ti,ha,tas,op);
}
function CerrarNoOpe(){
    document.getElementById("div_listanoope").style.cssText = "position: absolute;top: 380px;left: 20px;width: 300px;height: 250px;display: none;background-color: #d9d9d9;border-radius: 15px;z-index: 1997;padding: 0px;";
}
function AbrirListaNoOpe(op){
    var de = $('#filtro_depa').val();
    var ti = $('#filtro_tipo').val();
    var ha = $('#filtro_hab').val();
    var ta = $('#filtro_trans').val();
    var opr = op;
    document.getElementById("div_listaope").style.display = "none";
    document.getElementById("div_listadepa").style.display = "none";
    document.getElementById("div_listatipo").style.display = "none";
    document.getElementById("div_listahabi").style.display = "none";
    document.getElementById("div_listatra").style.display = "none";
    document.getElementById("div_listanohabi").style.display = "none";
    document.getElementById("div_listanotra").style.display = "none";
    document.getElementById("div_listanoope").style.display = "block";
    document.getElementById("div_audio").style.display = "none";
    MostrarIpasLista(de,ti,ha,ta,opr);
}

// $('#vernombredepa').click(function(){
//     AbrirListaDepa();
// });
// $('#verlistatipo').click(function(){
//     AbrirListaTipo();
// });
// $('#verlistahabi').click(function(){
//     AbrirListaHabi();
// });
// $('#verlistatra').click(function(){
//     AbrirListaTra();
// });
// $('#verlistaope').click(function(){
//     AbrirListaOpe();
// });

function markerOnClick(e, id)
{
    // console.log(id);
    $.ajax({
        url: window.base_url + 'mapa/buscarxid',
        type:'post',
        data: {
            id: id
        },
        beforeSend: function(e){
            // console.log(e);
        },
        success: function(data){
            var valor = JSON.parse(data);
            valor = valor[0];
            // console.log(valor);
            var tb = 'vertical-align: middle; background-color: #d9d9d9;';
            var th = 'padding: 3px; text-align: left; border: 1px #ffffff solid;';
            var td = 'padding: 3px; border: 1px #ffffff solid;';
            var xsl = 'border-left: none;';
            var xsr = 'border-right: none;';
            var pl10 = 'padding-left: 10px;';
            var brad00015 = 'border-radius: 0px 0px 0px 15px;;';
            var brad00150 = 'border-radius: 0px 0px 15px 0px;';
            var xsi = 'color: green; font-size: 16px;';
            var xno = 'color: red; font-size: 16px;';
            var ihcond = '';
            var habdet = '';
            var po = 0;
            var pno = 0;
            var pp = 0;
            if(valor.B_HAB == '1'){
                ihcond = '<i class="glyphicon glyphicon-ok-circle" style="'+ xsi +'"></i>';
            } else if(valor.B_HAB == '0'){
                ihcond = '<i class="glyphicon glyphicon-remove-circle" style="'+ xno +'"></i>';
            }
            if(valor.I_HAB_DET == '2'){
                habdet = 'INTEGRAL (DESCARGA)';
            } else if(valor.I_HAB_DET == '1'){
                habdet = 'PARCIAL (DESCARGA/TAREAS PREVIAS)';
            } else {
                habdet = 'NINGUNO';
            }
            var itcond = '';
            if(valor.B_TRANS == '1'){
                itcond = '<i class="glyphicon glyphicon-ok-circle" style="'+ xsi +'"></i> TRANSFERIDO';
            } else if(valor.B_TRANS == '0'){
                itcond = '<i class="glyphicon glyphicon-remove-circle" style="'+ xno +'"></i> NO TRANSFERIDO';
            }
            var estcon = '';
            if(valor.I_EST == '1'){
                estcon = '<i class="fa fa-circle" style="color: #82B64C;"></i> OPERATIVO';
                po = 100;
                pno=0;
                pp=0;
            } else if(valor.I_EST == '0'){
                estcon = '<i class="fa fa-circle" style="color: #FF0000;"></i> NO OPERATIVO';
                po = 0;
                pno=100;
                pp=0;
            } else if(valor.I_EST == '2'){
                estcon = '<i class="fa fa-circle" style="color: #FFC000;"></i> PARCIALMENTE OPERATIVO';
                po = 0;
                pno=50;
                pp=50;
            } else {
                estcon = 'SIN DATOS';
            }
            var vfase = '';
            if(valor.I_FASE == '0'){
                vfase = 'NO PROGRAMADO';
            } else if(valor.I_FASE == '1'){
                vfase = 'PREINVERSIÓN';
            } else if(valor.I_FASE == '2'){
                vfase = 'EXPEDIENTE TÉCNICO';
            } else if(valor.I_FASE == '3'){
                vfase = 'OBRA MENOR';
            } else if(valor.I_FASE == '4'){
                vfase = 'OBRA PRINCIPAL';
            } else if(valor.I_FASE == '5'){
                vfase = 'RECEPCIÓN Y LIQUIDACIÓN DE OBRA';
            }
            if(valor.Infra_Nombre=='' || valor.Infra_Nombre==null || valor.Infra_Nombre==undefined){valor.Infra_Nombre='';}
            if(valor.Infra_Tipo=='' || valor.Infra_Tipo==null || valor.Infra_Tipo==undefined){valor.Infra_Tipo='-';}
            if(valor.Departamento=='' || valor.Departamento==null || valor.Departamento==undefined){valor.Departamento='';}
            if(valor.Provincia=='' || valor.Provincia==null || valor.Provincia==undefined){valor.Provincia='';}
            if(valor.Distrito=='' || valor.Distrito==null || valor.Distrito==undefined){valor.Distrito='';}
            if(valor.N_DIST_NOR_TIE=='' || valor.N_DIST_NOR_TIE==null || valor.N_DIST_NOR_TIE==undefined){valor.N_DIST_NOR_TIE='-';}
            if(valor.N_DIST_NOR_MAR=='' || valor.N_DIST_NOR_MAR==null || valor.N_DIST_NOR_MAR==undefined){valor.N_DIST_NOR_MAR='-';}
            if(valor.NomInfNor=='' || valor.NomInfNor==null || valor.NomInfNor==undefined){valor.NomInfNor='-'; valor.N_DIST_NOR_TIE='-'; valor.N_DIST_NOR_MAR='-';}
            if(valor.N_DIST_SUR_TIE=='' || valor.N_DIST_SUR_TIE==null || valor.N_DIST_SUR_TIE==undefined){valor.N_DIST_SUR_TIE='-';}
            if(valor.N_DIST_SUR_MAR=='' || valor.N_DIST_SUR_MAR==null || valor.N_DIST_SUR_MAR==undefined){valor.N_DIST_SUR_MAR='-';}
            if(valor.NomInfSur=='' || valor.NomInfSur==null || valor.NomInfSur==undefined){valor.NomInfSur='-'; valor.N_DIST_SUR_TIE='-'; valor.N_DIST_SUR_MAR='-';}
            if(valor.B_TRANS_DET=='' || valor.B_TRANS_DET==null || valor.B_TRANS_DET==undefined){valor.B_TRANS_DET='-';}
            if(valor.V_DISPOSITIVO_LEGAL=='' || valor.V_DISPOSITIVO_LEGAL==null || valor.V_DISPOSITIVO_LEGAL==undefined){valor.V_DISPOSITIVO_LEGAL='-';}
            if(valor.V_RECURSO_HIDROBIOLOGICO=='' || valor.V_RECURSO_HIDROBIOLOGICO==null || valor.V_RECURSO_HIDROBIOLOGICO==undefined){valor.V_RECURSO_HIDROBIOLOGICO='-';}
            if(valor.I_NUM_PESC=='' || valor.I_NUM_PESC==null || valor.I_NUM_PESC==undefined){valor.I_NUM_PESC='0';}
            if(valor.I_NUM_FAM=='' || valor.I_NUM_FAM==null || valor.I_NUM_FAM==undefined){valor.I_NUM_FAM='0';}
            if(valor.I_NUM_EMB=='' || valor.I_NUM_EMB==null || valor.I_NUM_EMB==undefined){valor.I_NUM_EMB='0';}
            if(valor.N_VOL_DES=='' || valor.N_VOL_DES==null || valor.N_VOL_DES==undefined){valor.N_VOL_DES='-';}
            if(valor.V_MES_PICO=='' || valor.V_MES_PICO==null || valor.V_MES_PICO==undefined){valor.V_MES_PICO='-';}
            if(valor.N_PORCT_REAL=='' || valor.N_PORCT_REAL==null || valor.N_PORCT_REAL==undefined){valor.N_PORCT_REAL=0;}
            // if(valor.Infra_Nombre=='' || valor.Infra_Nombre==null || valor.Infra_Nombre==undefined){valor.Infra_Nombre='';}
            var tipo_mostrar = '';
            switch (valor.Infra_Tipo) {    
                case 'AFA':
                    tipo_mostrar = 'AFA - ATRACADERO FLOTANTE ARTESANAL';
                    break;
                case 'CA':
                    tipo_mostrar = 'CA - CENTRO ACUÍCOLA';
                    break;
                case 'CEP':
                    tipo_mostrar = 'CEP - CENTRO DE ENTRENAMIENTO PESQUERO';
                    break;
                case 'CP':
                    tipo_mostrar = 'CP - CENTRO PESQUERO';
                    break;
                case 'DPA':
                    tipo_mostrar = 'DPA - DESEMBARCADERO PESQUERO ARTESANAL';
                    break;
                case 'MFA':
                    tipo_mostrar = 'MFA - MUELLE FISCAL ARTESANAL';
                    break;
                case 'MPA':
                    tipo_mostrar = 'MPA - MUELLE PESQUERO ARTESANAL';
                    break;
                case 'SC':
                    tipo_mostrar = 'SC - ';
                    break;
                case 'TPZ':
                    tipo_mostrar = 'TPZ - TERMINAL PESQUERO ZONAL';
                    break;
            }
            $('#datos_ipa').html('');
            $('#datos_ipa').html(''+
                '<div class="table-responsive" style="width: 100%; border-radius: 0px 0px 15px 15px !important;">'+      
                    '<table class="table-condensed" style="width: 100%;">'+
                        '<thead>'+
                            '<th style="background-color: #16385C; color: #ffffff; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px;" colspan="7">INFORMACIÓN GENERAL</th>'+
                        '</thead>'+
                        '<tbody style="'+ tb +'">'+
                            '<tr>'+
                                '<th style="'+ th +' '+ xsr +' '+ pl10 +'">NOMBRE:</th>'+
                                '<td style="'+ td +' '+ xsl +'" colspan="6">'+ valor.Infra_Nombre +'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<th style="'+ th +' '+ xsr +' '+ pl10 +'">TIPO:</th>'+
                                '<td style="'+ td +' '+ xsl +'" colspan="6">'+ tipo_mostrar+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<th style="'+ th +' '+ xsr +' '+ pl10 +'">UBICACIÓN:</th>'+
                                '<td style="'+ td +' '+ xsl +'" colspan="6">'+ valor.Departamento +' - '+ valor.Provincia +' - '+ valor.Distrito +'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<th style="'+ th +' '+ xsr +' '+ pl10 +'">HABILITADO:</th>'+
                                '<td style="'+ td +' '+ xsl +'" colspan="6">'+ ihcond +' '+ habdet +'</td>'+
                            '</tr>'+
                            // '<tr>'+
                            //     '<th style="'+ th +' '+ xsr +' '+ pl10 +'">TRANSFERIDO:</th>'+
                            //     '<td style="'+ td +' '+ xsl +'" colspan="6">'+ itcond +' '+ valor.B_TRANS_DET +'</td>'+
                            // '</tr>'+
                            '<tr>'+
                                '<th style="'+ th +' '+ xsr +' '+ pl10 +'">ESTADO:</th>'+
                                '<td style="'+ td +' '+ xsl +'" colspan="6">'+ estcon +' - '+ itcond +' - '+ valor.V_DISPOSITIVO_LEGAL +'</td>'+
                            '</tr>'+
                            // '<tr>'+
                            //     '<th style="'+ th +' '+ xsr +' '+ pl10 +'">FASE:</th>'+
                            //     '<td style="'+ td +' '+ xsl +'" colspan="6">'+ vfase +'</td>'+
                            // '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '</div>'+
            '');

            $('#estadistica_ipa').html('');
            $('#estadistica_ipa').html(''+
                '<div id="containercircle" style="width: 550px; height: 350px; margin: 0 auto; text align: center;">'+
                '</div>'+
                // '<div id="containergraf" style="width: 550px; height: 400px; margin: 0 auto;">'+
                // '</div>'+
            '');

            // var mi = parseFloat(valor.Monto_Inv);
            // var ca = parseFloat(valor.Costo_Apro);
            // var da = parseFloat(valor.Dev_Acum);
            // var pp = 0;
            // var restaplan = (100 - pp);
            // var pr = parseFloat(valor.N_PORCT_REAL);
            // var restareal = (100 - pr);
            // if(pr == 0){
            //     pp = 60;
            //     restareal = (100 - pp);
            // }

            Highcharts.chart('containercircle', {
                title: {
                    text: valor.Infra_Nombre,
                    align: 'center'
                },
                credits: {
                    enabled: false
                },
                xAxis: {
                    categories: ['']
                },
                yAxis: {
                    title: {
                    text: ''
                    }
                },
                labels: {
                    items: [{
                    //     html: '<b>% Planificado</b>',
                    //     style: {
                    //         left: '130px',
                    //         top: '18px',
                    //         color: ( // theme
                    //             Highcharts.defaultOptions.title.style &&
                    //             Highcharts.defaultOptions.title.style.color
                    //         ) || 'black'
                    //     }
                    // },{
                        html: '',//'<b>% Avance</b>',
                        style: {
                            left: '250px',
                            top: '18px',
                            color: ( // theme
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || 'black'
                        }
                    }]
                },
                colors: 
                    //verde, rojo
                    ['#82B64C', '#FFC000', '#FF0000']
                ,
                plotOptions: {
                    pie: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'top',
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },            
                series: [{
                //     type: 'pie',
                //     name: '%',
                //     innerSize: '50%',
                //     startAngle: -90,
                //     endAngle: 90,
                //     size: 100,
                //     center: [160, 100],
                //     data: [
                //         ['Planificado', pp],
                //         {
                //             name: 'Restante',
                //             y: restaplan,
                //             showInLegend: false,
                //             dataLabels: {
                //                 enabled: false
                //             }
                //         }
                //     ]
                // }, {
                    type: 'pie',
                    name: '%',
                    innerSize: '50%',
                    startAngle: 0,
                    endAngle: 360,
                    size: 180,
                    center: [250, 80],
                    data: [
                        ['Operativo: '+po+'%', po],
                        ['Remodelación por administración actual: '+pp+'%', pp],
                        {
                            name: 'No Operativo',
                            y: pno,
                            showInLegend: true,
                            dataLabels: {
                                enabled: false
                            }
                        }
                    ]
                }]
            });
            
            $('#multimedia_ipa').html('');
            $('#multimedia_ipa').html(''+
                '<table class="table-condensed">'+
                    '<thead>'+
                        '<th style="background-color: #16385C; color: #ffffff; width: 685px; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px;" colspan="7">FOTOGRAFÍAS</th>'+
                    '</thead>'+
                '</table>'+
                '<div class="container" style="width: 100%;">'+
                    '<div id="myCarousel" class="carousel slide" data-ride="carousel">'+
                        //Indicators
                        '<ol id="myCarousel_ol" class="carousel-indicators">'+
                        '</ol>'+
                        //Wrapper for slides
                        '<div id="myCarousel_inner" class="carousel-inner">'+
                        '</div>'+
                        //Left and right controls
                        '<a class="left carousel-control" href="#myCarousel" data-slide="prev">'+
                            '<span class="glyphicon glyphicon-chevron-left"></span>'+
                            '<span class="sr-only">Previous</span>'+
                        '</a>'+
                        '<a class="right carousel-control" href="#myCarousel" data-slide="next">'+
                            '<span class="glyphicon glyphicon-chevron-right"></span>'+
                            '<span class="sr-only">Next</span>'+
                        '</a>'+
                    '</div>'+
                '</div>'+
            '');

            var nombreipabuscar = valor.nombredpa;
            nombreipabuscar = nombreipabuscar.replace(' ','');
            var urldocumento = window.base_url.split('/')[0]+'/'+window.base_url.split('/')[1]+'/'+window.base_url.split('/')[2]+'/DOCUMENTO/';

            $.ajax({
                url: window.base_url + 'mapa/obtenercantidadfotos',
                type:'post',
                data: {
                    carpeta: nombreipabuscar
                },
                beforeSend: function(e){
                    $('#divmapa-loading').show();
                    // console.log(e);
                },
                success: function(data){
                    var c = JSON.parse(data);
                    if(c != 'ERROR'){
                        if( c > 0){
                            var tarchi = c;
                            // console.log(tarchi);
                            for(i=0; i<tarchi; i++){
                                var active = '';
                                var itemactive = '';
                                if(i == 0) {active = 'class="active"'; itemactive = 'active';}
                                $('#myCarousel_ol').append(''+
                                    '<li data-target="#myCarousel" data-slide-to="'+i+'" '+active+'></li>'+
                                '');
                                $('#myCarousel_inner').append(''+
                                    '<div class="item '+itemactive+'">'+
                                        '<img src="' +urldocumento+ 'SIMON/Mapas_Imagenes_Externos/' +nombreipabuscar+ '/dpa/Imagen' +i+ '.jpg" alt="" style="width: 100%; height:309px;">'+
                                    '</div>'+
                                '');
                            }
                            document.getElementById("multimedia_ipa").style.display = "block";
                        } else {
                            document.getElementById("multimedia_ipa").style.display = "none";
                        }
                        $('#divmapa-loading').hide();
                    } else {
                        // console.log('no hay imagenes ni carpeta');
                        document.getElementById("multimedia_ipa").style.display = "none";
                        $('#divmapa-loading').hide();
                    }
                },
                error: function(e){
                    document.getElementById("multimedia_ipa").style.display = "none";
                    $('#divmapa-loading').hide();
                }
            });

            $.ajax({
                url: window.base_url + 'mapa/obtenercantidadaudio',
                type:'post',
                data: {
                    carpeta: nombreipabuscar
                },
                beforeSend: function(e){
                    $('#divmapa-loading').show();
                    // console.log(e);
                },
                success: function(data){
                    var c = JSON.parse(data);
                    $("#audioplay").removeAttr("autoplay");
                    $("#audioplay").removeAttr("controls");
                    $("#audioplay").removeAttr("load");
                    $("#div_audio").html('');
                    document.getElementById("div_audio").style.display = "none";
                    if(c != 'ERROR'){
                        if( c > 0){
                            var tarchi = c;
                            // console.log(tarchi);
                            $('#div_audio').html('<audio id="audioplay" muted></audio>');
                            $("#audioplay").html('');
                            $("#audioplay").html(''+
                            //     '<source src="' +urldocumento+ 'SIMON/Mapas_Audios_Externos/' +nombreipabuscar+ '/audio/audio0.mp3" type="audio/mp3">'+
                            //     '<source src="' +urldocumento+ 'SIMON/Mapas_Audios_Externos/' +nombreipabuscar+ '/audio/audio0.wav" type="audio/wav">'+
                                '<source src="' +urldocumento+ 'SIMON/Mapas_Audios_Externos/' +nombreipabuscar+ '/audio/audio0.ogg" type="audio/ogg">'+
                            '');
                            document.getElementById("div_audio").style.display = "block";
                            $("#audioplay").attr("load","load");
                            $("#audioplay").attr("controls","true");
                            $("#audioplay").attr("autoplay","true");
                            $("#audioplay").load();
                        } else {
                            document.getElementById("div_audio").style.display = "none";
                        }
                        $('#divmapa-loading').hide();
                    } else {
                        // console.log('no hay audio en la carpeta');
                        document.getElementById("div_audio").style.display = "none";
                        $('#divmapa-loading').hide();
                    }
                },
                error: function(e){
                    document.getElementById("div_audio").style.display = "none";
                    $('#divmapa-loading').hide();
                }
            });

            document.getElementById("seccion_cards").style.display = "block";
            // $('#valcard').val(1);
            // $('#btn_cards').click();
        },
        error: function(e){
            // console.log(e);
        }
    });
}

$('#seccion_cards').click(function(){
    dragElement(this);
});
$('#div_audio').click(function(){
    dragElement(this);
});
$('#div_numflotante').click(function(){
    dragElement(this);
});
$('#div_listadepa').click(function(){
    dragElement(this);
});
$('#div_listatipo').click(function(){
    dragElement(this);
});
$('#div_listahabi').click(function(){
    dragElement(this);
});
$('#div_listatra').click(function(){
    dragElement(this);
});
$('#div_listaope').click(function(){
    dragElement(this);
});
$('#div_listanohabi').click(function(){
    dragElement(this);
});
$('#div_listanotra').click(function(){
    dragElement(this);
});
$('#div_listanoope').click(function(){
    dragElement(this);
});
function dragElement(elmnt) {
    // console.log('drag');
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById(elmnt.id)) {
        /* if present, the header is where you move the DIV from:*/
        document.getElementById(elmnt.id).onmousedown = dragMouseDown;
    } else {
        /* otherwise, move the DIV from anywhere inside the DIV:*/
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        /* stop moving when mouse button is released:*/
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

$(document).ready(function() {
                                    
});