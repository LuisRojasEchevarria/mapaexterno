<div class="modal-header bg-primary">
    <button type="button" class="close" id="nuevo-usuario-cerrar-btn" data-dismiss="modal">&times;</button>
    <h5 class="modal-title"></h5>
</div>

<div class="modal-body">
    <form id="form_nuevo_usuario" class="form-horizontal" role="form" method="post" action="">
    
    <!-- form --> 
    <div class="form-body">
        <input type="hidden" class="form-control text-center" id="id" name="id" placeholder="" value="">

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
                        <input id="nomape" name="nomape" type="text" class="form-control text-center"  placeholder="" value="" minlength="3" required>
                    </div>    
                </div>       

                <div class="validar form-group">
                    <label for="f_usuario" class="col-sm-4 control-label">USUARIO</label>
                    <div class="col-sm-8">
                        <input id="usuario" name="usuario" type="text" class="form-control text-center"  placeholder="" value="" minlength="3" required>
                    </div>
                </div>

                <div class="validar form-group">
                    <label for="f_numdoc" class="col-sm-4 control-label">DNI</label>
                    <div class="col-sm-8">
                        <input id="numdoc" name="numdoc" type="text" class="form-control text-center"  placeholder="" value="" minlength="3" required>
                    </div>
                </div>

            </div>

        </div>




        <div class="row">

            <div class="col-md-6">
                <label for="f_rol" class="control-label">ROL</label>
                <div class="validar">
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="JEFE_PROYECTO" selected>JEFE_PROYECTO</option>
                        <option value="PMO">PMO</option>
                        <option value="GESTOR_SOCIAL">GESTOR_SOCIAL</option>
                        <option value="HIDROAMBIENTAL">HIDROAMBIENTAL</option>
                        <option value="COORDINADOR">COORDINADOR</option>
                        <option value="DIRECTOR_DIGENIPAA">DIRECTOR_DIGENIPAA</option>
                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                        <option value="UFGI">UFGI</option>
                        <option value="JEFATURA">JEFATURA</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <label for="f_estado" class="control-label">ESTADO</label>
                <div class="validar">
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="1" selected>ACTIVO</option>
                        <option value="0">BLOQUEADO</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <label for="f_cargo" class="control-label">CARGO</label>
                <div class="validar">
                    <select class="form-control" id="cargo" name="cargo">
                        <option value="" selected></option>
                        <option value="JEFE_PROYECTO">JEFE_PROYECTO</option>
                        <option value="ASISTENTE_PROYECTO">ASISTENTE_PROYECTO</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <label for="f_permiso" class="control-label">PERMISO</label>
                <div class="validar">
                    <select class="form-control" id="permiso" name="permiso" required>
                        <option value="" selected></option>
                        <option value="LECTURA">LECTURA</option>
                        <option value="ESCRITURA">ESCRITURA</option>
                    </select>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="validar col-md-12">
                <label for="f_infraestructura" class="control-label">INFRAESTRUCTURA</label>
                <select class="form-control" id="infraestructura" name="infraestructura[]" multiple="multiple">
                </select>
            </div>
        </div>


    </div> 
    <!-- form -->     
    </form>
</div>

<div class="modal-footer">
    <div id="nuevo-usuario-dialog-error" class="alert-custom alert" style="width: 70%;"></div>
    <div id="nuevo-usuario-dialog-loading" class="loading-custom text-gray-no-line-height"><i class="fa fa-refresh fa-spin fa-fw"></i></div>
    <button type="button" class="btn btn-primary btn-tiny" id="nuevo-usuario-aplicar-btn">Guardar</button>
    <button type="button" class="btn btn-default btn-tiny" id="nuevo-usuario-cancelar-btn" data-dismiss="modal">Salir</button>
</div>

<!-- JS de página -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/usuario/usuarioNuevo.js"></script>
