<!-- Contenido principal de página -->
<section class="content">
<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>REGISTRO DE CONFIGURACIÓN</b></h3>
        </div>
        <!-- Botones -->
        <div class="form-group row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <button id="btn-nuevo" type="button" class="btn btn-primary btn-info btn-md" ><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            </div>                
        </div>
        <!-- -->          

</div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div id="tabla-configuracion-container"></div>
            </div>
        </div>
    </div>

    <input type="hidden" id="configuracion-data-input" value="<?php echo $configuracion_data; ?>">
</section>

<!-- JS de página -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/configuracion/configuracion.js"></script>