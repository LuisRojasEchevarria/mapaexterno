<!--
 // main.php
 // Seccion central de template principal (donde se cargan las vistas)
 -->
<!-- Wrapper contenido -->
<div class="content-wrapper" style="background-color: white;">
    <!-- Contenedor contenido -->
    <div class="container-fluid" id="vista-central"></div>

    <!-- Contenedor para icono loading (cuando se cambian páginas) -->
    <div class="container-fluid" id="vista-central-loading" style="display: none; position: absolute; top: 50%; left: 50%; transform: translateY(-50%);">
        <div class="text-center text-gray-no-line-height" id="vista-central-loading-texto"></div>
        <div class="text-xl text-center text-gray-no-line-height"><i class="fa fa-refresh fa-spin fa-fw"></i></div>
    </div>
</div>