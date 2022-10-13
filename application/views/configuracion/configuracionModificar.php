<div class="modal-header bg-primary">
    <button type="button" class="close" id="modificar-configuracion-cerrar-btn" data-dismiss="modal">&times;</button>
    <h5 class="modal-title"></h5>
</div>

<div class="modal-body">
    <form id="form_modificar_configuracion" class="form-horizontal" role="form" method="post" action="">
    
    <!-- form --> 
    <div class="form-body">
        <input type="hidden" class="form-control text-center" id="id" name="id" placeholder="" value="<?php echo $fila->id; ?>">

        <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="f_codigo" class="control-label">CODIGO</label>
                <input id="codigo" name="codigo" type="number" class="form-control text-center" placeholder="" value="<?php echo $fila->I_COD; ?>" required>
            </div>       
        </div>

        <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="f_nombre" class="control-label">NOMBRE</label>
                <input id="nombre" name="nombre" type="text" class="form-control text-center" placeholder="" value="<?php echo $fila->V_NOM; ?>" maxlength="100" required>
            </div>       
        </div>

        <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                <label for="f_descripcion" class="control-label" >DESCRIPCIÓN</label>
                <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese la descripción" maxlength="500" ><?php echo $fila->V_DESC; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                <label for="f_flag" class="control-label" >FLAG</label>
                <input id="flag" name="flag" type="number" class="form-control text-center" placeholder="" value="<?php echo $fila->I_FLAG; ?>" maxlength="100" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="f_tipo" class="control-label">TIPO</label>
                <input id="tipo" name="tipo" type="text" class="form-control text-center" placeholder="" value="<?php echo $fila->V_TIPO; ?>" required>
            </div>       
        </div>

        <div class="form-group row">
            <div class="validar col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="f_estado">ESTADO</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="1" <?php if($fila->B_FLAG_DEL == '1'){ echo 'selected'; } ?> >ACTIVO</option>
                    <option value="0" <?php if($fila->B_FLAG_DEL == '0'){ echo 'selected'; } ?> >INACTIVO</option>
                </select>                
            </div>            
        </div>       

    </div> 
    <!-- form -->     
    </form>
</div>

<div class="modal-footer">
    <div id="modificar-configuracion-dialog-error" class="alert-custom alert" style="width: 70%;"></div>
    <div id="modificar-configuracion-dialog-loading" class="loading-custom text-gray-no-line-height"><i class="fa fa-refresh fa-spin fa-fw"></i></div>
    <button type="button" class="btn btn-primary btn-tiny" id="modificar-configuracion-aplicar-btn">Guardar</button>
    <button type="button" class="btn btn-default btn-tiny" id="modificar-configuracion-cancelar-btn" data-dismiss="modal">Salir</button>
</div>
