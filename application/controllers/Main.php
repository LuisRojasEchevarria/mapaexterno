<?php
// Main.php
// Controlador para cargar vista de template principal incluyendo header, menu, contenedor contenido y footer
defined('BASEPATH') OR exit('No direct script access allowed');
// Seteando zona horaria para Lima, Perú
date_default_timezone_set("America/Lima");

class Main extends CI_Controller {
    public function index() {
        
        // Pasando año actual para footer
        $data['anio_actual'] = date('Y');
        
        // Cargando estructura principal del sistema (en view main.php carga inicialmente home.php)
        $this->load->view('template/header.php');
        $this->load->view('template/menu.php');
        $this->load->view('template/main.php');
        $this->load->view('template/footer.php', $data);
    }
}