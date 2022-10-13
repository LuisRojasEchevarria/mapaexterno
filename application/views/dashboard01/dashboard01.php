<!-- Contenido principal de página -->
<section class="content">

<?php
    $base_url = load_class('Config')->config['base_url'];
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <input id="h_base_url" name="h_base_url" type="hidden" class="form-control text-center"  placeholder="" value="<?php echo base_url();?>">
        <h3 class="box-title"><b>DASHBOARD 01</b></h3>
    </div>

    <div class="form-group" style="padding-bottom: 5%;">

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <input id="h_infraestructura" name="h_infraestructura" type="hidden" class="form-control text-center"  placeholder="" value="">
            <label for="f_infraestructura" class="control-label">INFRAESTRUCTURA</label>
            <select class="form-control" id="infraestructura" name="infraestructura" required>
            </select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label for="f_proyecto" class="control-label">PROYECTO</label>
            <select class="form-control" id="proyecto" name="proyecto" required>
            </select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" style="padding-right: 5%;">
            <label for="f_proyecto" class="control-label">BUSCAR</label>
            <button id="btn-buscar" type="button" class="btn btn-primary btn-info btn-md" ><i class="glyphicon glyphicon-search"></i> Buscar</button>
        </div>

    </div>


    <!-- Table row -->
    <div class="row">
        <!-- /.col1 -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 table-responsive">
          <table class="table table-striped">
            <tbody>
            <tr>
              <td colspan="2"><b>SNIP</b></td>
              <td colspan="2" id="snip"></td>
            </tr>
            <tr>
              <td colspan="2"><b>COD. UNI. INV.</b></td>
              <td colspan="2" id="coduniinv"></td>
            </tr>
            <tr>
              <td colspan="2"><b>PROYECTO DE INVERSIÓN</b></td>
              <td colspan="2" id="proyinv"></td>
            </tr>
            <tr>
              <td colspan="2"><b>CONTRATISTA</b></td>
              <td colspan="2" id="contratista"></td>
            </tr>
            <tr>
              <td colspan="2"><b>SUPERVISOR</b></td>
              <td colspan="2" id="supervisor"></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col1 -->

        <!-- /.col2 -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">


            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                    <div class="small-box bg-navy">
                        <div class="inner">
                            <h3 id="avance_proyecto"></h3>
                            <p>AVANCE</p>
                        </div>
                        <div class="icon">
                            <i class="ion-android-star-half"></i>
                        </div>
                    </div>

                </div>       

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3 id="pescadores"></h3>
                            <p>PESCADORES</p>
                        </div>
                        <div class="icon">
                            <i class="ion-android-boat"></i>
                        </div>
                    </div> 

                </div>       
            </div>


            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3 id="monto_inversion"></h3>
                            <p>MONTO INVERSIÓN</p>
                        </div>
                        <div class="icon">
                            <i class="ion-social-usd"></i>
                        </div>
                    </div>

                </div>       

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3 id="familiares"></h3>
                            <p>FAMILIAS</p>
                        </div>
                        <div class="icon">
                            <i class="ion-android-people"></i>
                        </div>
                    </div> 

                </div>       
            </div>

        </div>
        <!-- /.col2 -->

        <!-- /.col3 -->
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="box box-primary">
                        <div class="box-body box-profile">
                        <img id="foto_jefe_proyecto" class="profile-user-img img-responsive img-circle" src="" alt="User profile picture">
                        <h3 class="profile-username text-center" id="jefe_proyecto" ></h3>
                        <p class="text-muted text-center">JEFE DE PROYECTO</p>
                        <!-- /.box-body -->
                    </div>

                </div>       
            </div>
        </div>
        <!-- /.col3 -->

    </div>
    <!-- /.row -->

</div>

<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> -->
    <!-- MAPA -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">UBICACIÓN DEL DPA</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="box-body">

            <!-- Mapa -->
            <div id="map"></div>
            <p></p>
            <!-- /Mapa -->

        </div>
    </div>
    <!-- /.MAPA -->
</div>   


<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="ion-android-calendar"></i></span>

            <div class="info-box-content">
                <span class="info-box-number"><h5><b>REINICIO DE OBRA</b></h5></span>
                <span class="info-box-number"><h6 id="fecha_prog_reinicio">PROG. 01/09/2020</h6></span>
                <span class="info-box-number"><h6 id="fecha_ejec_reinicio">EJEC. 17/09/2020</h6></span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion-android-calendar"></i></span>

            <div class="info-box-content">
                <span class="info-box-number"><h5><b>CULMINACIÓN DE OBRA</b></h5></span>
                <span class="info-box-number"><h6 id="fecha_prog_culminacion"></h6></span>
                <span class="info-box-number"><h6 id="fecha_ejec_culminacion"></h6></span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion-android-calendar"></i></span>

            <div class="info-box-content">
                <span class="info-box-number"><h5><b>HABILITACIÓN SANITARIA</b></h5></span>
                <span class="info-box-number"><h6 id="fecha_prog_hs"></h6></span>
                <span class="info-box-number"><h6 id="fecha_ejec_hs"></small></span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="ion-android-calendar"></i></span>

            <div class="info-box-content">
                <span class="info-box-number"><h5><b>POSIBLE INAGURACIÓN</b></h6></span>
                <span class="info-box-number"><h6 id="fecha_prog_inaguracion"></h6></span>
                <span class="info-box-number"><h6 id="fecha_ejec_inaguracion"></h6></span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

<!-- </div>   -->




<!-- <div class="callout callout-primary"> -->
    <h4>EJECUCIÓN DE LA INVERSIÓN</h4>
<!-- </div> -->


<!-- CONTROL DE INVERSION -->
<div class="row">

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <!-- DONUT CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">PORCENTAJE DE AVANCE ACUMULADO</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                <canvas id="pieChart" style="height:250px"></canvas>
            </div>

            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Costo actualizado
                    <span class="pull-right">S/.28770504</span></a></li>
                <li><a href="#">Devengado acumulado 
                    <span class="pull-right">S/.24663999</span></a>
                </li>
                <li><a href="#">Primer devengado
                  <span class="pull-right">JUL 2015</span></a></li>
                <li><a href="#">Último devengado
                  <span class="pull-right">DIC 2020</span></a></li>
              </ul>
            </div>

        </div>
        <!-- /.DONUT -->
    </div>    

    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">

        <!-- BAR CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">HISTÓRICO DEL DEVENGADO DE LA INVERSIÓN (S/. MM)</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="barChart" style="height:250px"></canvas>
                </div>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">2015
                    <span class="pull-right">0.06%</span></a></li>
                <li><a href="#">2017 
                    <span class="pull-right">6.54%</span></a>
                </li>
                <li><a href="#">2018
                  <span class="pull-right">10.45%</span></a></li>
                <li><a href="#">2019
                  <span class="pull-right">9.44%</span></a></li>
              </ul>
            </div>        

        </div>
        <!-- /.box -->

    </div>


    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"> 

        <!-- BAR CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">VARIACIONES DEL COSTO ACTUALIZADO (S/. MM)</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="barChart01" style="height:250px"></canvas>
                </div>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">2016
                    <span class="pull-right">5%</span></a></li>
                <li><a href="#">2017 
                    <span class="pull-right">8.15%</span></a>
                </li>
                <li><a href="#">2020
                  <span class="pull-right">12.13%</span></a></li>
              </ul>
            </div>
        </div>
        <!-- /BAR CHART -->

    </div>


</div>

<!-- <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <div class="small-box bg-navy">
            <div class="inner">
                <h3>S/. 1 580 025.00</h3>
                <p>AVANCE PROGRAMADO</p>
            </div>
            <div class="icon">
                <i class="ion-cash"></i>
            </div>
        </div>

    </div>       

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <div class="small-box bg-primary">
            <div class="inner">
                <h3>S/. 380 500.00</h3>
                <p>AVANCE EJECUTADO</p>
            </div>
            <div class="icon">
                <i class="ion-cash"></i>
            </div>
        </div> 
    </div>       
</div> -->

<!-- /CONTROL DE INVERSION -->

<!-- <div class="callout callout-primary"> -->
    <h4>EJECUCIÓN DE LA OBRA</h4>
<!-- </div> -->


<!-- /.CONTROL DE LA OBRA -->
<div class="row">


    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">AVANCE ACUMULADO</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-wrench"></i></button>
                <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <p class="text-center">
            <strong></strong>
            </p>

            <!-- <div class="chart">
                <canvas id="salesChart" style="height: 300px;"></canvas>
            </div> -->

            <div id="line-chart" style="height: 300px;">.</div>

        </div>
        <!-- ./box-body -->
        <div class="box-footer">
            <!-- <div class="row"> -->

                <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                    <th style="background-color: #337ab7;color : #ffffff">TAMAÑO/META</th>
                    <th style="background-color: #337ab7;color : #ffffff">COSTO DE INVERSIÓN (S/.)</th>
                    <th style="background-color: #337ab7;color : #ffffff">ULTIMO PERIODO</th>
                    <th style="background-color: #337ab7;color : #ffffff">MONTO DE VALORIZACIÓN</th>
                    <th style="background-color: #337ab7;color : #ffffff">% AVANCE</th>
                    </tr>
                    <tr>
                    <td>1 M2</td>
                    <td>20,303,199</td>
                    <td>2019-12</td>
                    <td>17,110,477</td>
                    <td>75.4%</td>
                    </tr>
                </table>
                </div>



                <!-- <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                    </div>
                </div> -->
                <!-- /.col -->
                <!-- <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                    </div>
                </div> -->
                <!-- /.col -->
                <!-- <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                    </div>
                </div> -->
                <!-- /.col -->
                <!-- <div class="col-sm-3 col-xs-6">
                    <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                </div> -->
            <!-- </div> -->
            <!-- /.row -->
        </div>
        <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>


    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">AVANCE MENSUAL</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-wrench"></i></button>
                <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <p class="text-center">
            <strong></strong>
            </p>

            <div class="chart">
            <!-- Sales Chart Canvas -->
                <canvas id="barChart02" style="height: 292px;"></canvas>
            </div>
            <!-- /.col -->

        </div>
        <!-- ./box-body -->
        <div class="box-footer">
            <!-- <div class="row"> -->


                <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                    <th style="background-color: #337ab7;color : #ffffff">TAMAÑO/META</th>
                    <th style="background-color: #337ab7;color : #ffffff">COSTO DE INVERSIÓN (S/.)</th>
                    <th style="background-color: #337ab7;color : #ffffff">ULTIMO PERIODO</th>
                    <th style="background-color: #337ab7;color : #ffffff">MONTO DE VALORIZACIÓN</th>
                    <th style="background-color: #337ab7;color : #ffffff">% AVANCE</th>
                    </tr>
                    <tr>
                    <td>1 M2</td>
                    <td>20,303,199</td>
                    <td>2019-12</td>
                    <td>17,110,477</td>
                    <td>75.4%</td>
                    </tr>
                </table>
                </div>

                <!-- <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                    </div>
                </div> -->
                <!-- /.col -->
                <!-- <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                    </div>
                </div> -->
                <!-- /.col -->
                <!-- <div class="col-sm-3 col-xs-6">
                    <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                    </div>
                </div> -->
                <!-- /.col -->
                <!-- <div class="col-sm-3 col-xs-6">
                    <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                </div> -->
            <!-- </div> -->
            <!-- /.row -->
        </div>
        <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>


<!-- /.col -->
</div>


<!-- <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <div class="small-box bg-navy">
            <div class="inner">
                <h3>55%</h3>
                <p>AVANCE PROGRAMADO</p>
            </div>
            <div class="icon">
                <i class="ion-ios-cog-outline"></i>
            </div>
        </div>

    </div>       

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <div class="small-box bg-primary">
            <div class="inner">
                <h3>35%</h3>
                <p>AVANCE EJECUTADO</p>
            </div>
            <div class="icon">
                <i class="ion-ios-cog-outline"></i>
            </div>
        </div> 
    </div>       
</div> -->

<!-- /.CONTROL DE LA OBRA -->

<!-- <div class="callout callout-primary"> -->
    <!-- <h4>AVANCES POR ÁREA</h4> -->
<!-- </div> -->

<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> -->
    <!-- USERS LIST -->
    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">AVANCES POR ÁREA</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <img class="img-responsive" src="<?php echo $base_url.'upload/obra/avance.png' ?>" alt="User Image">
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

            <table class="table table-responsive table-bordered">
            <tr>
                <th style="width: 10px">#</th>
                <th>Área</th>
                <th>Progreso</th>
                <th style="width: 40px">%</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Área de administración</td>
                <td>
                <div class="progress progress-xs">
                    <div class="progress-bar" style="width: 55%" style="background-color: #001F3F;"></div>
                </div>
                </td>
                <td><span class="badge" style="background-color: #001F3F;">55%</span></td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Área de desinfección</td>
                <td>
                <div class="progress progress-xs">
                    <div class="progress-bar" style="width: 70%" style="background-color: #3c8dbc;"></div>
                </div>
                </td>
                <td><span class="badge" style="background-color: #3c8dbc;" >70%</span></td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Patio de maniobras</td>
                <td>
                <div class="progress progress-xs">
                    <div class="progress-bar" style="width: 30%" style="background-color: #00c0ef;"></div>
                </div>
                </td>
                <td><span class="badge" style="background-color: #00c0ef;">30%</span></td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Área de tareas previas</td>
                <td>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-teal" style="width: 90%" style="background-color: #39CCCC;"></div>
                </div>
                </td>
                <td><span class="badge" style="background-color: #39CCCC;">90%</span></td>
            </tr>
            </table>

            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

        </div>
    </div>

    <!-- <div class="box-footer text-center">
    </div> -->
    <!-- /.box-footer -->
    </div>
    <!--/.box -->
<!-- </div> -->





<!-- <div class="callout callout-primary"> -->
    <h4>HITOS DEL PROYECTO</h4>
<!-- </div> -->

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <!-- /.info-box -->
        <div class="info-box bg-navy">
        <span class="info-box-icon"><i class="ion-ios-pie-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Obras de mar</span>
            <!-- <span class="info-box-number"><h5>Fecha final 01/02/2021</h5></span> -->
            <h5>Fecha final 01/02/2021</h5>

            <div class="progress">
            <div class="progress-bar" style="width: 40%"></div>
            </div>
            <span class="progress-description">
                40%
                </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <!-- /.info-box -->
        <div class="info-box bg-green">
        <span class="info-box-icon"><i class="ion-ios-pie-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Obras de tierra</span>
            <h5>Fecha final 15/03/2021</h5>
            <!-- <span class="info-box-number">Fecha final 15/03/2021</span> -->

            <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
                70%
                </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <!-- /.info-box -->
        <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="ion-ios-pie-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Equipamiento</span>
            <h5>Fecha final 15/04/2021</h5>
            <!-- <span class="info-box-number">Fecha final 15/04/2021</span> -->

            <div class="progress">
            <div class="progress-bar" style="width: 58%"></div>
            </div>
            <span class="progress-description">
                58%
                </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <!-- /.info-box -->
        <div class="info-box bg-teal">
        <span class="info-box-icon"><i class="ion-ios-pie-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Habilitación sanitaria</span>
            <h5>Fecha final 30/07/2021</h5>
            <!-- <span class="info-box-number">Fecha final 30/07/2021</span> -->

            <div class="progress">
            <div class="progress-bar" style="width: 20%"></div>
            </div>
            <span class="progress-description">
                20%
                </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

</div>


<!-- <div class="callout callout-primary"> -->
    <h4>FOTOGRAFÍAS</h4>
<!-- </div> -->

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-navy">
        <div class="inner">
            <h3 id="area_total"></h3>
            <p>ÁREA TOTAL DEL DPA</p>
        </div>
        <div class="icon">
            <i class="ion-android-boat"></i>
        </div>
        <!-- <a href="#" class="small-box-footer"></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
        <div class="inner">
            <h3 id="area_construida_tierra"></h3>
            <p>ÁREA CONSTRUIDA OBRA TIERRA</p>
        </div>
        <div class="icon">
            <i class="ion-android-boat"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div> 
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
        <div class="inner">
            <h3 id="area_construida_mar"></h3>
            <p>ÁREA CONTRUIDA OBRA MAR</p>
        </div>
        <div class="icon">
            <i class="ion-android-boat"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-teal">
        <div class="inner">
            <h3 id="longitud_espigon"></h3>
            <p>LON. MUELLE ESPIGÓN</p>
        </div>
        <div class="icon">
            <i class="ion-android-boat"></i>

        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
</div>

<!-- FOTOS -->
<div class="gallery">
    <figure class="gallery__item gallery__item--1">
        <img src="<?php echo $base_url.'upload/obra/muelle0.png' ?>" alt="Gallery image 1" class="gallery__img">
    </figure>
    <figure class="gallery__item gallery__item--2">
        <img src="<?php echo $base_url.'upload/obra/muelle1.png' ?>" alt="Gallery image 2" class="gallery__img">
    </figure>
    <figure class="gallery__item gallery__item--3">
        <img src="<?php echo $base_url.'upload/obra/muelle2.png' ?>" alt="Gallery image 3" class="gallery__img">
    </figure>
    <figure class="gallery__item gallery__item--4">
        <img src="<?php echo $base_url.'upload/obra/muelle3.png' ?>" alt="Gallery image 4" class="gallery__img">
    </figure>
    <figure class="gallery__item gallery__item--5">
        <img src="<?php echo $base_url.'upload/obra/muelle4.png' ?>" alt="Gallery image 5" class="gallery__img">
    </figure>
</div>


<!-- <div class="callout callout-primary">
    <h4>EQUIPO DE PROYECTO</h4>
</div> -->
<p></p>
<!-- <h4>EQUIPO DE PROYECTO</h4> -->

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <!-- USERS LIST -->
    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">EQUIPO DE PROYECTO</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <ul class="users-list clearfix">
        <li>
            <img src="<?php echo $base_url.'upload/equipo/user01.jpg' ?>" alt="User Image">
            <a class="users-list-name" href="#">Alexander Pierce</a>
            <span class="users-list-date">Ingeniero Pesquero</span>
        </li>
        <li>
            <img src="<?php echo $base_url.'upload/equipo/user02.jpg' ?>" alt="User Image">
            <a class="users-list-name" href="#">Norman</a>
            <span class="users-list-date">Aquitecto</span>
        </li>
        <li>
            <img src="<?php echo $base_url.'upload/equipo/user03.jpg' ?>" alt="User Image">
            <a class="users-list-name" href="#">Jane</a>
            <span class="users-list-date">Arquitecto</span>
        </li>
        <li>
            <img src="<?php echo $base_url.'upload/equipo/user04.jpg' ?>" alt="User Image">
            <a class="users-list-name" href="#">John</a>
            <span class="users-list-date">Ingeniero Ambiental</span>
        </li>
        <li>
            <img src="<?php echo $base_url.'upload/equipo/user05.jpg' ?>" alt="User Image">
            <a class="users-list-name" href="#">Alexander</a>
            <span class="users-list-date">Ingeniero Eléctrico</span>
        </li>
        <li>
            <img src="<?php echo $base_url.'upload/equipo/user06.jpg' ?>" alt="User Image">
            <a class="users-list-name" href="#">Sarah</a>
            <span class="users-list-date">Ingeniera Ambiental</span>
        </li>
        <li>
            <img src="<?php echo $base_url.'upload/equipo/user07.jpg' ?>" alt="User Image">
            <a class="users-list-name" href="#">Nora</a>
            <span class="users-list-date">Arquitecto</span>
        </li>
        <li>
            <img src="<?php echo $base_url.'upload/equipo/user08.jpg' ?>" alt="User Image">
            <a class="users-list-name" href="#">Nadia</a>
            <span class="users-list-date">Arquitecto</span>
        </li>
        </ul>
        <!-- /.users-list -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
    </div>
    <!-- /.box-footer -->
    </div>
    <!--/.box -->
</div>



<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <!-- USERS LIST -->
    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">RIESGOS</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!-- /.info-box -->
            <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion-ios-speedometer-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Riesgo 01</span>
                <span class="info-box-number"></span>

                <div class="progress">
                <div class="progress-bar" style="width: 40%"></div>
                </div>
                <span class="progress-description">
                    40%
                    </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!-- /.info-box -->
            <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion-ios-speedometer-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Riesgo 02</span>
                <span class="info-box-number"></span>

                <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    70%
                    </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!-- /.info-box -->
            <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion-ios-speedometer-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Riesgo 03</span>
                <span class="info-box-number"></span>

                <div class="progress">
                <div class="progress-bar" style="width: 58%"></div>
                </div>
                <span class="progress-description">
                    58%
                    </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!-- /.info-box -->
            <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion-ios-speedometer-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Riesgo 04</span>
                <span class="info-box-number"></span>

                <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
                </div>
                <span class="progress-description">
                    20%
                    </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!-- /.info-box -->
            <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion-ios-speedometer-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Riesgo 05</span>
                <span class="info-box-number"></span>

                <div class="progress">
                <div class="progress-bar" style="width: 58%"></div>
                </div>
                <span class="progress-description">
                    58%
                    </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!-- /.info-box -->
            <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion-ios-speedometer-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Riesgo 06</span>
                <span class="info-box-number"></span>

                <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
                </div>
                <span class="progress-description">
                    20%
                    </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    </div>

    <div class="box-footer text-center">
    </div>
    <!-- /.box-footer -->
    </div>
    <!--/.box -->
</div>

</section>

<!-- JS de página -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard01/dashboardGraficos.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard01/dashboardNuevo.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard01/dashboardGraficos01.js"></script>