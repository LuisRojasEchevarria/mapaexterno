<?php
$base_url = load_class('Config')->config['base_url']; 
?>
<!--
 // footer.php
 // Seccion pie de template principal
 -->
            <!-- Main Footer -->
            <footer class="main-footer" style="background-color: #d2d6de;">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <strong><p class="text-left">SIMON - Sistema de Monitoreo</p></strong>
                    </div>    

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <strong><p class="text-right">FONDEPES <?php echo date('Y'); ?> </p></strong>
                    </div>    

                </div>    
            </footer>
        </div>

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
        
                
    </body>
</html>