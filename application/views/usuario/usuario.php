<!-- Contenido principal de página -->
<section class="content" style="background-color: white;">
<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>REGISTRO DE USUARIOS</b></h3>
            <input type="hidden" id="permiso_usuario" value="<?php echo $this->session->spermiso; ?>">
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
                <div id="tabla-usuario-container"></div>
            </div>
        </div>
    </div>

    <input type="hidden" id="usuario-data-input" value="<?php echo $usuario_data; ?>">
</section>

<!-- JS de página -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/usuario/usuario.js"></script>