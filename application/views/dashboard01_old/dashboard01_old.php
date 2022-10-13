<!-- Contenido principal de página -->
<section class="content">

<?php
    $base_url = load_class('Config')->config['base_url'];
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <input id="h_base_url" name="h_base_url" type="hidden" class="form-control text-center"  placeholder="" value="<?php echo base_url();?>">
        <h3 class="box-title"><b>DASHBOARD</b></h3>
    </div>

    <div class="form-group row">

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <input id="h_infraestructura" name="h_infraestructura" type="hidden" class="form-control text-center"  placeholder="" value="">
            <label for="f_infraestructura" class="control-label">INFRAESTRUCTURA</label>
            <select class="form-control" id="infraestructura" name="infraestructura" required>
            </select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <label for="f_proyecto" class="control-label">PROYECTO</label>
            <select class="form-control" id="proyecto" name="proyecto" required>
            </select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
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
                            <p>FAMILIARES</p>
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
                        <p class="text-muted text-center">Jefe de Proyectos</p>
                        <!-- /.box-body -->
                    </div>

                </div>       
            </div>
        </div>
        <!-- /.col3 -->

    </div>
    <!-- /.row -->

</div>


<!-- Mapa -->
<div id="map"></div>
<p></p>
<!-- /Mapa -->

<!-- FECHAS -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-navy"><i class="ion-android-calendar"></i></span>

        <div class="info-box-content">
            <span class="info-box-number">REINICIO DE OBRA</span>
            <span class="info-box-number"><small>PROG. 01/09/2020</small></span>
            <span class="info-box-number"><small>EJEC. 17/09/2020</small></span>
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
            <span class="info-box-number">CULMINACIÓN DE OBRA</span>
            <span class="info-box-number"><small>PROG. 15/12/2020</small></span>
            <span class="info-box-number"><small>EJEC. 15/12/2020</small></span>
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
            <span class="info-box-number">HABILITACIÓN SANITARIA</span>
            <span class="info-box-number"><small>PROG. 15/12/2020</small></span>
            <span class="info-box-number"><small>EJEC. 15/12/2020</small></span>
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
            <span class="info-box-number">POSIBLE INAGURACIÓN</span>
            <span class="info-box-number"><small>PROG. 20/12/2020</small></span>
            <span class="info-box-number"><small>EJEC. 20/12/2020</small></span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.FECHAS -->


<div class="callout callout-primary">
    <h4>CONTROL DE INVERSIÓN</h4>
</div>


<!-- CONTROL DE INVERSION -->
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <!-- DONUT CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Control de Inversión</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                <canvas id="pieChart" style="height:250px"></canvas>
            </div>
        </div>
        <!-- /.DONUT -->
    </div>    

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

        <!-- BAR CHART -->
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Avance de Obra</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="chart">
            <canvas id="barChart" style="height:160px"></canvas>
            </div>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>


    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"> 

        <!-- BAR CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Riesgos</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                <!-- /.box-body -->
                <div class="no-border">
                <div class="row">
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                            data-fgColor="#FF0000" data-min="0" data-max="20">

                    <div class="knob-label">Riesgo 01</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                            data-fgColor="#FF0000" data-min="0" data-max="20">

                    <div class="knob-label">Riesgo 02</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="15" data-width="60" data-height="60"
                            data-fgColor="#F4D03F" data-min="0" data-max="20">

                    <div class="knob-label">Riesgo 03</div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                </div>
                <!-- /.box-footer -->

                <!-- /.box-body -->
                <div class="no-border">
                <div class="row">
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                    <input type="text" class="knob" data-readonly="true" value="17" data-width="60" data-height="60"
                            data-fgColor="#F4D03F" data-min="0" data-max="20">

                    <div class="knob-label">Riesgo 04</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                    <input type="text" class="knob" data-readonly="true" value="10" data-width="60" data-height="60"
                            data-fgColor="#138D75" data-min="0" data-max="20">

                    <div class="knob-label">Riesgo 05</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="8" data-width="60" data-height="60"
                            data-fgColor="#138D75" data-min="0" data-max="20">

                    <div class="knob-label">Riesgo 06</div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                </div>
                <!-- /.box-footer -->

            </div>
        </div>
        <!-- /BAR CHART -->

    </div>


</div>

<div class="row">
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
</div>

<!-- /CONTROL DE INVERSION -->

<div class="callout callout-primary">
    <h4>CONTROL DE LA OBRA</h4>
</div>


<!-- /.CONTROL DE LA OBRA -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">CURVA S</h3>

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
            <div class="row">

            <div class="col-md-8">
                <p class="text-center">
                <strong></strong>
                </p>

                <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="salesChart" style="height: 300px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
            </div>
            <!-- /.col -->


            <div class="col-md-4">
                <p class="text-center">
                <strong>AVANCE POR ÁREA</strong>
                </p>

                <div class="progress-group">
                <span class="progress-text">ÁREA DE ADMINISTRACIÓN</span>
                <span class="progress-number"><b>80</b>/100</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-navy" style="width: 80%"></div>
                </div>
                </div>
                
                <div class="progress-group">
                <span class="progress-text">ÁREA DE DESINFECCIÓN</span>
                <span class="progress-number"><b>85</b>/100</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-navy" style="width: 85%"></div>
                </div>
                </div>
                
                <div class="progress-group">
                <span class="progress-text">PATIO DE MANIOBRAS</span>
                <span class="progress-number"><b>75</b>/100</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-navy" style="width: 75%"></div>
                </div>
                </div>
                
                <div class="progress-group">
                <span class="progress-text">ÁREA DE TAREAS PREVIAS</span>
                <span class="progress-number"><b>55</b>/100</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-navy" style="width: 55%"></div>
                </div>
                </div>

                <div class="progress-group">
                <span class="progress-text">PLANTA DE TRATAMIENTO</span>
                <span class="progress-number"><b>65</b>/100</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-navy" style="width: 65%"></div>
                </div>
                </div>

                <div class="progress-group">
                <span class="progress-text">PLANTA DE FRÍOS</span>
                <span class="progress-number"><b>45</b>/100</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-navy" style="width: 45%"></div>
                </div>
                </div>

                <div class="progress-group">
                <span class="progress-text">CASETA DE CONTROL</span>
                <span class="progress-number"><b>75</b>/100</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-navy" style="width: 75%"></div>
                </div>
                </div>

                <div class="progress-group">
                <span class="progress-text">MUELLE</span>
                <span class="progress-number"><b>35</b>/100</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-navy" style="width: 35%"></div>
                </div>
                </div>

            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- ./box-body -->
        <div class="box-footer">
            <div class="row">
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
<!-- /.col -->
</div>


<div class="row">
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
</div>

<!-- /.CONTROL DE LA OBRA -->

<div class="callout callout-primary">
    <h4>HITOS DE LA OBRA</h4>
</div>

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <!-- /.info-box -->
        <div class="info-box bg-navy">
        <span class="info-box-icon"><i class="ion-ios-pie-outline"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Obras de mar</span>
            <span class="info-box-number">Fecha final 01/02/2021</span>

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
            <span class="info-box-number">Fecha final 15/03/2021</span>

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
            <span class="info-box-number">Fecha final 15/04/2021</span>

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
            <span class="info-box-number">Fecha final 30/07/2021</span>

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


<div class="callout callout-primary">
    <h4>FOTOGRAFÍAS</h4>
</div>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-navy">
        <div class="inner">
            <h3>2,705 M2</h3>
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
            <h3>0</h3>
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
            <h3>0</h3>
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
            <h3>240 ML</h3>
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


<div class="callout callout-primary">
    <h4>EQUIPO DE PROYECTO</h4>
</div>

<div class="row">
    <!-- USERS LIST -->
    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Integrantes del equipo</h3>
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

</section>

<!-- JS de página -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard01/dashboardGraficos.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard01/dashboardNuevo.js"></script>