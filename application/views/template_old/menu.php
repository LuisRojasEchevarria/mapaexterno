<!--
 // menu.php
 // Menú de navegación de template principal
 -->
<!-- Sidebar principal izquierda -->
<aside class="main-sidebar" style="border-right: 1px solid #d2d6de;">
    <section class="sidebar">
      <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <!-- Menu Dashboard -->            
            <li class="treeview">
                <a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#" id="anchor-pagina-dashboard01">Obra 01</a></li>
                    <li><a href="#" id="anchor-pagina-dashboard02">Obra 02</a></li>
                </ul>
            </li>
            <!-- /Menu Mantenimientos -->

        <?php 
        //if( $this->session->srol == 'SA'){ ?>
            <!-- Menu Mantenimientos -->            
            <li class="treeview">
                <a href="#"><i class="glyphicon glyphicon-th-large"></i> <span>Mantenimientos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- <li><a href="#" id="anchor-pagina-configuracion">Configuración</a></li> -->
                    <li><a href="#" id="anchor-pagina-infraestructura">Infraestructura</a></li>
                    <li><a href="#" id="anchor-pagina-jefe">Jefe Proyecto</a></li>
                    <li><a href="#" id="anchor-pagina-coordinador">Coordinador</a></li>
                    <li><a href="#" id="anchor-pagina-equipo">Equipo Proyecto</a></li>
                    <li><a href="#" id="anchor-pagina-contratista">Emp. Contratista</a></li>
                    <li><a href="#" id="anchor-pagina-supervisor">Emp. Supervisora</a></li>
                </ul>
            </li>
            <!-- /Menu Mantenimientos -->
            <?php 
            //} ?>


            <?php // if($this->session->srol == 'SA'){ ?>
            <!-- Menu Operaciones -->            
            <li class="treeview">
                <a href="#"><i class="glyphicon glyphicon-folder-open"></i> <span>Proyecto</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                        <li><a href="#" id="anchor-pagina-proyecto">Proyecto</a></li>
                        <li><a href="#" id="anchor-pagina-obra">Obra</a></li>
                </ul>                    
            </li>
            <!-- /Menu Operaciones -->
            <?php //} ?>

            <?php if( $this->session->srol == 'SUPER ADMINISTRADOR' ){ ?>
            <!-- Menu  -->            
            <li class="treeview">
                <a href="#"><i class="glyphicon glyphicon-user"></i> <span>Usuarios</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                        <li><a href="#" id="anchor-pagina-usuario">Usuarios</a></li>
                </ul>
            </li>
            <!-- /Menu  --> 
            <?php } ?>

        </ul>
    </section>
</aside>
