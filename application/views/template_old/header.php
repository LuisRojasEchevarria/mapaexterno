<?php
date_default_timezone_set('UTC'); 
$base_url = load_class('Config')->config['base_url']; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MAPA FONDEPES</title>
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

    <!-- mapa -->   
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOAej_yRgfnzkdK1e2iUreJaptZ0hqHQA"></script>

    <style>
      html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
      }
      #map {
        height: 250px;
        width: 100%;
      }
      #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
      }
      #legend h3 {
        margin-top: 0;
      }
      #legend img {
        vertical-align: middle;
      }
    </style>
    
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        <!-- Header principal -->
        <header class="main-header">
            <!-- Logo -->
            <a id="anchor-pagina-home" href="<?php echo $base_url; ?>assets/plugins/AdminLTE/img/avatar5.png" class="logo">
              <!-- Logo pequeño para menu sidebar (50x50px) -->
              <span class="logo-mini"><img src="<?php echo $base_url;?>assets/img/logo.png" class="" alt="MAPA"></span>
              <!-- Logo para estado regular de tamaño -->
              <span class="logo-lg"><img src="<?php echo $base_url;?>assets/img/logo.png" class="user-image" alt="MAPA"><b>MAPA</b></span>
            </a>

            <!-- Header Menú Navegación -->
            <nav class="navbar navbar-static-top" role="navigation" style="border-bottom: 1px solid #d2d6de;">
                <!-- Sidebar toggle button -->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Abrir navegación</span>
                </a>
                <!-- Navbar Menú Derecho -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!--Menú Cuenta Usuario -->
                        <li class="dropdown user user-menu">
                            <!-- Menú Toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <!-- Imagen y nombre de Usuario -->
                              <img src="<?php echo $base_url; ?>assets/plugins/AdminLTE/img/avatar5.png" class="user-image" alt="Imágen usuario">                              
                              <span class="hidden-xs"><span class="hidden-xs"><?php echo $this->session->sname;?></span></span>
                              <span ><span class="hidden-xs"></span></span>  
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo $base_url; ?>assets/plugins/AdminLTE/img/avatar5.png" class="img-circle" alt="Imagen de usuario">
                                    <p>
                                    <?php echo $this->session->sname;?>
                                    </p>
                                </li>
                                <!-- Menu Cuenta Usuario cuerpo -->
                                <li class="user-body">  
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                    <a href="<?php echo $base_url?>login/log_out" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                    </div>
                                </li>                                                            
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>