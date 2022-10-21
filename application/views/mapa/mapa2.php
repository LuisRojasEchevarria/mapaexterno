<?php
date_default_timezone_set('UTC'); 
$base_url = load_class('Config')->config['base_url']; 
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>IPAS</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
  <header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">DESEMBARCADEROS PESQUEROS ARTESANALES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        
      </div>
    </div>
  </nav>
</header>
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">

  </div>
</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
  <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <strong><p class="text-muted text-left">Desembarcaderos Pesqueros Artesanales</p></strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <strong><p class="text-muted text-right">FONDEPES <?php echo date('Y'); ?> </p></strong>
        </div>    
    </div>   
  </div>
</footer>


    
  </body>
</html>
<!-- LIBRERIAS JS -->

<!-- jQuery -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/jQuery/jquery-2.2.4.min.js"></script>

<!-- JQuery Validation -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/jQuery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/jQuery-validation/localization/messages_es.js"></script>
<!-- Bootstrap Select -->
<script type="text/javascript" src="<?php echo $base_url;?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Guarda globalmente base_url para usarlo en JS -->

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


    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
        }

    function showPosition(position){
        latitud=position.coords.latitude;
        longitud=position.coords.longitude;
        document.getElementById("latitud").value = latitud;
        document.getElementById("longitud").value = longitud;
    }

    window.base_url = <?php echo json_encode($base_url); ?>;
</script>
