<div class="modal-header bg-primary">
    <button type="button" class="close" id="consultar-configuracion-cerrar-btn" data-dismiss="modal">&times;</button>
    <h5 class="modal-title"></h5>
</div>

<div class="modal-body">
    <form id="form_consultar_configuracion" class="form-horizontal" role="form" method="post" action="">
    <!-- form --> 
    <div class="form-body">
        <input type="hidden" class="form-control text-center" id="id" name="id" placeholder="" value="">

        <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="f_precio_festejado" class="control-label">PRECIO FESTEJADO</label>
                <input id="precio_festejado" name="precio_festejado" type="number" class="form-control text-center" placeholder="" value="<?php echo $fila->precio_festejado; ?>" maxlength="11" readonly>
            </div>       
        </div>

        <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="f_precio_invitado" class="control-label">PRECIO INVITADO</label>
                <input id="precio_invitado" name="precio_invitado" type="number" class="form-control text-center" placeholder="" value="<?php echo $fila->precio_invitado; ?>" maxlength="11" readonly>
            </div>       
        </div>

        <!-- <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="f_precio_minimo_abono" class="control-label">PRECIO MÍNIMO DE ABONO</label>
                <input id="precio_minimo_abono" name="precio_minimo_abono" type="number" class="form-control text-center" placeholder="" value="<?php echo $fila->precio_minimo_abono; ?>" maxlength="11" readonly>
            </div>       
        </div> -->

        <div class="form-group row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php 
                if($fila->imagen_paquete != '' ){
                    $base_url = load_class('Config')->config['base_url'];
                ?>
                <img src="<?php echo $base_url.'upload/'. $fila->imagen_paquete; ?>" alt="" height="100px" width="100px" class="img-thumbnail" >
                <?php
                }
                ?>
            </div>
        </div>

    </div> 
    <!-- form -->     
    </form>
</div>

<div class="modal-footer">
    <div id="consultar-configuracion-dialog-error" class="alert-custom alert" style="width: 70%;"></div>
    <div id="consultar-configuracion-dialog-loading" class="loading-custom text-gray-no-line-height"><i class="fa fa-refresh fa-spin fa-fw"></i></div>
    <button type="button" class="btn btn-default btn-tiny" id="consultar-configuracion-cancelar-btn" data-dismiss="modal">Salir</button>
</div>
