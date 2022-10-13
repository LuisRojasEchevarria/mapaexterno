<?php
date_default_timezone_set('UTC'); 
$base_url = load_class('Config')->config['base_url']; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IPAS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- ESTILOS CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_url;?>assets/img/favicon.ico" />
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/bootstrap/css/bootstrap.min.css">
    
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/bootstrap-select/css/bootstrap-select.css">
    
    <!-- Font Awesome 4.6.3. -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css">
    
    <!-- Ionicons -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/plugins/ionicons/ionicons.min.css"/>

    <!-- sweetalert2.js -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/plugins/sweetalert2/sweetalert2.min.css"/>

    <!-- Datatables Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    
    <!-- AdminLTE estilo principal -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/AdminLTE/css/AdminLTE.min.css">
    
    <!-- AdminLTE Skin seleccionada -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/plugins/AdminLTE/css/skins/skin-blue-light.min.css">
    
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/plugins/select2/select2.min.css">
    
    <!-- daterangepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/plugins/daterangepicker/daterangepicker.css">

    <!-- CSS personalizado -->    
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/css/skins/_all-skins.min.css">

    <!-- FOTOS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/css/fotos.css">
    <!-- Separador de miles - Autonumeric -->
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <!-- mapa -->   
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOAej_yRgfnzkdK1e2iUreJaptZ0hqHQA"></script>
    <!-- mapa externo -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/leaflet/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
    <!-- css dependiendo la pantalla -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url?>assets/css/mapaexterno-pc.css">
</head>

<body class="hold-transition skin-blue-light sidebar-mini" style="height: 100%;">
    <div class="wrapper">
        <!-- Header principal -->
        <header class="main-header" style="background: #3c8dbc; height: 53.39px !important; vertical-align: middle;">
            <h2 style="text-align: center !important; color: white; margin: 0px; padding-top: 10px;"><b>DESEMBARCADEROS PESQUEROS ARTESANALES</b></h2>
        </header>
        <section id="seccion_mapa" class="content col-lg-12" style="background-color: white; height: 100vh; position:absotule;">
            <!-- <div class="col-lg-2"></div> -->
            <ul style="list-style-type: none; margin: 0; padding: 0; overflow: hidden; border: 1px solid #e7e7e7; background-color: #f3f3f3; position: relative; width: 100%;">
                <li style="float: left">
                    <a style="display: block; color: #666; text-align: center; padding: 14px 16px; text-decoration: none;">
                        <label class="control-label">DPTO: </label>
                        <select id="filtro_depa" name="filtro_depa" style="width: 200px;">
                        </select>
                    </a>
                </li>
                <li style="float: left">
                    <a style="display: block; color: #666; text-align: center; padding: 14px 16px; text-decoration: none;">
                        <label class="control-label">DPA: </label>
                        <select id="filtro_tipo" name="filtro_tipo" style="width: 200px;">
                        </select>
                    </a>
                </li>
                <li style="float: left">
                    <a style="display: block; color: #666; text-align: center; padding: 14px 16px; text-decoration: none;">
                        <!-- <label class="control-label">TIPO: </label> -->
                        <input id="filtro_nombre" name="filtro_nombre" type="text" class="form-control" placeholder="Buscar..." value="">
                    </a>
                </li>
                <li style="float: left">
                    <a style="display: block; color: #666; text-align: center; padding: 14px 16px; text-decoration: none;">
                        <button style="margin-top:0px; padding-top: 5px; padding-bottom: 5px; background-color: #49b6bb; border-color: #49b6bb;" id="btn_filtrar_mapa" type="button" class="btn btn-warning btn-lg">
                            <i class="glyphicon glyphicon-search"></i> Buscar
                        </button>
                    </a>
                </li>
                <li style="float: left">
                    <a style="display: block; color: #666; text-align: center; padding: 14px 16px; text-decoration: none;">
                        <button style="margin-top:0px; padding-top: 5px; padding-bottom: 5px;" id="btn_limpiarfiltro_mapa" type="button" class="btn btn-warning btn-lg">
                            Limpiar
                        </button>
                    </a>
                </li>
            </ul>
            <div id="div_numflotante" class="numflotante">
                <div id="div_num_modificar" class="table-responsive" style="width: 100%;">
                    
                </div>
            </div>
            <div id="div_listadepa" class="listaipas">
                <div id="div_tablalistadepa" class="table-responsive" style="width: 100%;">
                    <table id="tablalistadepa" class="table-condensed" style="width: 100%;">
                        <thead>
                        </thead>
                        <tbody class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 210px;">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="div_listatipo" class="listaipas">
                <div id="div_tablalistatipo" class="table-responsive" style="width: 100%;">
                    <table id="tablalistatipo" class="table-condensed" style="width: 100%;">
                        <thead>
                        </thead>
                        <tbody class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 210px;">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="div_listahabi" class="listaipas">
                <div id="div_tablalistahabi" class="table-responsive" style="width: 100%;">
                    <table id="tablalistahabi" class="table-condensed" style="width: 100%;">
                        <thead>
                        </thead>
                        <tbody class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 210px;">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="div_listatra" class="listaipas">
                <div id="div_tablalistatra" class="table-responsive" style="width: 100%;">
                    <table id="tablalistatra" class="table-condensed" style="width: 100%;">
                        <thead>
                        </thead>
                        <tbody class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 210px;">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="div_listaope" class="listaipas">
                <div id="div_tablalistaope" class="table-responsive" style="width: 100%;">
                    <table id="tablalistaope" class="table-condensed" style="width: 100%;">
                        <thead>
                        </thead>
                        <tbody class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 210px;">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="div_audio" class="audiodiv">
                <audio id="audioplay" autoplay controls>
                </audio>
            </div>
            <div id="divmapa-loading" class="loading-custom text-gray-no-line-height" style="text-align: center; vertical-align: middle; position: fixed;"><i class="fa fa-refresh fa-spin fa-fw"></i></div>
            <div id="map"></div>
        </section>
        <div id="seccion_cards" class="col-lg-4" style="background-color: white;">
            <div id="cards" class="col-lg-12" style="padding: 5px; background-color: #efefef;">
                <button type="button" class="close" id="btn_cerrar_divdatosipa" style="color: black;font-weight: bold;font-size: 28px;">&times;</button>
                <div id="datos_ipa" class="validar row col-lg-12" style="margin: 5px; background-color: #d9d9d9; border-radius: 15px;">
                    <label class="control-label" style="text-align: left;">RESUMEN DE INFORMACIÓN</label>
                </div>
                <table class="table-condensed" style="margin-left: 5px;">
                    <thead>
                        <th style="background-color: #16385C; color: #ffffff; width: 580px; border-radius: 15px 15px 0px 0px; text-align: left; padding: 4px 12px;" colspan="7">INFORMACIÓN ESTADÍSTICA</th>
                    </thead>
                </table> -
                <div id="estadistica_ipa" class="validar row col-lg-12" style="margin: 5px; background-color: white; border-radius: 0px 0px 15px 15px;">
                    <label class="control-label" style="text-align: left;">ESTADÍSTICA</label>
                </div>
                <div id="multimedia_ipa" class="validar row col-lg-12" style="margin: 5px; background-color: #d9d9d9; border-radius: 15px;">
                    <label class="control-label" style="text-align: left;">ARCHIVOS MULTIMEDIA</label>
                </div>
            </div>
        </div>     
    </div>
</body>
<!-- Main Footer -->
<footer class="main-footer" style="background-color: #d2d6de; margin: 0">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <strong><p class="text-left">Desembarcaderos Pesqueros Artesanales</p></strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <strong><p class="text-right">FONDEPES <?php echo date('Y'); ?> </p></strong>
        </div>    
    </div>    
</footer>

<!-- Guarda globalmente base_url para usarlo en JS -->
<script type="text/javascript">
    window.base_url = <?php echo json_encode($base_url); ?>;
</script>
        
<!-- LIBRERIAS JS -->

<!-- jQuery -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/jQuery/jquery-2.2.4.min.js"></script>

<!-- JQuery Validation -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/jQuery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/jQuery-validation/localization/messages_es.js"></script>

<!-- Bootstrap Core -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Bootstrap Select -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- DataTables -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- AdminLTE Core -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/AdminLTE/js/app.min.js"></script>	

<!-- DataTables Buttons -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

        
<!-- Alert.js -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/alerts/alert.js"></script>

<!-- sweetalert2.js -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- TableToJSON -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/Table2JSON/jquery.tabletojson.min.js"></script>

<!-- Select2 -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/select2/i18n/es.js"></script>

<!-- daterangepicker -->        
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/daterangepicker/moment.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Chart.js -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/chartjs/Chart.min.js"></script>        

<!-- knob.js -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/knob/jquery.knob.js"></script>

<!-- FLOT CHARTS -->
<script src="<?php echo $base_url;?>assets/plugins/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo $base_url;?>assets/plugins/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo $base_url;?>assets/plugins/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo $base_url;?>assets/plugins/Flot/jquery.flot.categories.js"></script>


<!-- Scripts de views principales menu.php y main.php -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/menu.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/main.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/funcionesExtras.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/variablesGlobales.js"></script>
<!-- JS de página mapa externo -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/leaflet/leaflet.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/leaflet/peru_regiones.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/mapa/mapa.js"></script>

<script>
    setTimeout(function () {
        $('#divmapa-loading').show();
        initMap();
    }, 1500);
</script>
</html>
