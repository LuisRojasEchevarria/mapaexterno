<!--
 // menu.php
 // Menú de navegación de template principal
 -->
<!-- Sidebar principal izquierda -->
<aside class="main-sidebar" style="border-right: 1px solid #d2d6de;">
    <section class="sidebar">
      <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

        <!-- Sidebar user panel -->
        <div class="user-panel">
        </div>

        <?php 
        if( $this->session->srolmenu == 'UFGI' || $this->session->srolmenu == 'GESTOR_SOCIAL' || $this->session->srolmenu == 'HIDROAMBIENTAL' || $this->session->srolmenu == 'PMO' || $this->session->srolmenu == 'ADMINISTRADOR' ){ ?>
            <!-- Menu Mapas -->            
            <li class="treeview">
                <a href="#"><i class="fa fa-map" style="font-size: 28px;"></i> <span><h4><b>MAPAS</b></h4></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#" id="anchor-pagina-mapa/indexinfraestructuras"><h4>IPAs</h4></a></li>
                </ul>
            </li>
            <!-- /Menu Mapas -->            

        <?php 
        } ?>






            <?php
            $base_url = load_class('Config')->config['base_url']; 
            ?>

        </ul>

    </section>


</aside>
