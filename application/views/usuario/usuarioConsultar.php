<div class="modal-header bg-primary">
    <button type="button" class="close" id="consultar-usuario-cerrar-btn" data-dismiss="modal">&times;</button>
    <h5 class="modal-title"></h5>
</div>

<div class="modal-body">
    <form id="form_consultar_usuario" class="form-horizontal" role="form" method="post" action="">
    
    <!-- form --> 
    <div class="form-body">
        <input type="hidden" class="form-control text-center" id="id" name="id" placeholder="" value="<?php echo $fila->id; ?>">

        <div class="row">
            <div class="col-md-3">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php 
                        $base_url = load_class('Config')->config['base_url'];
                        ?>
                        <img src="<?php echo $base_url.'upload/default.jpg' ?>" alt="" height="300px" width="200px" class="img-thumbnail" >
                </div>

            </div>

            <div class="col-md-9">

                <div class="validar form-group">
                    <label for="f_nomape" class="col-sm-4 control-label">NOMBRES Y APELLIDOS</label>
                    <div class="col-sm-8">
                        <input id="nomape" name="nomape" type="text" class="form-control text-center"  placeholder="" value="<?php echo $fila->V_NOMAPE; ?>" minlength="3" readonly>
                    </div>    
                </div>       

                <div class="validar form-group">
                    <label for="f_usuario" class="col-sm-4 control-label">USUARIO</label>
                    <div class="col-sm-8">
                        <input id="usuario" name="usuario" type="text" class="form-control text-center"  placeholder="" value="<?php echo $fila->V_USUARIO; ?>" minlength="3" readonly>
                    </div>
                </div>

                <div class="validar form-group">
                    <label for="f_numdoc" class="col-sm-4 control-label">DNI</label>
                    <div class="col-sm-8">
                        <input id="numdoc" name="numdoc" type="text" class="form-control text-center"  placeholder="" value="<?php echo $fila->V_NUM_DOC; ?>" minlength="3" readonly>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="f_rol" class="control-label">ROL</label>
                <div class="validar">
                    <select class="form-control" id="rol" name="rol" disabled>
                        <option value="JEFE_PROYECTO" <?php if($fila->V_ROL == 'JEFE_PROYECTO'){ echo 'selected'; } ?> >JEFE_PROYECTO</option>
                        <option value="PMO" <?php if($fila->V_ROL == 'PMO'){ echo 'selected'; } ?> >PMO</option>
                        <option value="GESTOR_SOCIAL" <?php if($fila->V_ROL == 'GESTOR_SOCIAL'){ echo 'selected'; } ?> >GESTOR_SOCIAL</option>
                        <option value="HIDROAMBIENTAL" <?php if($fila->V_ROL == 'HIDROAMBIENTAL'){ echo 'selected'; } ?> >HIDROAMBIENTAL</option>
                        <option value="COORDINADOR" <?php if($fila->V_ROL == 'COORDINADOR'){ echo 'selected'; } ?> >COORDINADOR</option>
                        <option value="DIRECTOR_DIGENIPAA" <?php if($fila->V_ROL == 'DIRECTOR_DIGENIPAA'){ echo 'selected'; } ?> >DIRECTOR_DIGENIPAA</option>
                        <option value="ADMINISTRADOR" <?php if($fila->V_ROL == 'ADMINISTRADOR'){ echo 'selected'; } ?> >ADMINISTRADOR</option>

                        <option value="UFGI" <?php if($fila->V_ROL == 'UFGI'){ echo 'selected'; } ?> >UFGI</option>
                        <option value="JEFATURA" <?php if($fila->V_ROL == 'JEFATURA'){ echo 'selected'; } ?> >JEFATURA</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <label for="f_estado" class="control-label">ESTADO</label>
                <div class="validar">
                    <select class="form-control" id="estado" name="estado" disabled>
                        <option value="1" <?php if($fila->I_EST == '1'){ echo 'selected'; } ?> >ACTIVO</option>
                        <option value="0" <?php if($fila->I_EST == '0'){ echo 'selected'; } ?> >BLOQUEADO</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="f_cargo" class="control-label">CARGO</label>
                <div class="validar">
                    <select class="form-control" id="cargo" name="cargo" disabled>
                        <option value=""></option>
                        <option value="JEFE_PROYECTO" <?php if($fila->V_CARGO == 'JEFE_PROYECTO'){ echo 'selected'; } ?> >JEFE_PROYECTO</option>
                        <option value="ASISTENTE_PROYECTO" <?php if($fila->V_CARGO == 'ASISTENTE_PROYECTO'){ echo 'selected'; } ?> >ASISTENTE_PROYECTO</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <label for="f_permiso" class="control-label">PERMISO</label>
                <div class="validar">
                    <select class="form-control" id="permiso" name="permiso" disabled>
                        <option value="" selected></option>
                        <option value="LECTURA" <?php if($fila->V_PERMISO == 'LECTURA'){ echo 'selected'; } ?> >LECTURA</option>
                        <option value="ESCRITURA" <?php if($fila->V_PERMISO == 'ESCRITURA'){ echo 'selected'; } ?> >ESCRITURA</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="validar col-md-12">
                <input id="h_infraestructura" name="h_infraestructura" type="hidden" value="<?php echo $fila_detallePermiso; ?>">
                <label for="f_infraestructura" class="control-label">INFRAESTRUCTURA</label>
                <select class="form-control" id="infraestructura" name="infraestructura[]" multiple="multiple" disabled>
                </select>
            </div>
        </div>



    </div> 
    <!-- form -->     
    </form>
</div>

<div class="modal-footer">
    <div id="consultar-usuario-dialog-error" class="alert-custom alert" style="width: 70%;"></div>
    <div id="consultar-usuario-dialog-loading" class="loading-custom text-gray-no-line-height"><i class="fa fa-refresh fa-spin fa-fw"></i></div>
    <button type="button" class="btn btn-default btn-tiny" id="consultar-usuario-cancelar-btn" data-dismiss="modal">Salir</button>
</div>

<!-- JS de página -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/usuario/usuarioConsultar.js"></script>
