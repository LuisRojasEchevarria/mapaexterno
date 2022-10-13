<?php
// Archivo.php
// Clase con funciones para manipulación de archivos

defined('BASEPATH') OR exit('No direct script access allowed');

class Archivo {
        
    // Función para configurar método de carga de archivos ($ext = ext1|ext2|ext3)
    public function cargar($nomInput, $nomArchivo, $rutaCarga, $ext) {
        // Parámetros de configuración
        $config['file_name'] = $nomArchivo;
        $config['upload_path'] = $rutaCarga;
        $config['allowed_types'] = $ext;
        $config['max_size'] = 2000;
        
        // Cargando libreria
        $CI = &get_instance();
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);
        
        // Moviendo archivo a servidor
        return $CI->upload->do_upload($nomInput) ? true : false;
    }
    
    // Función para buscar y eliminar archivos que contienen un nombre
    public function eliminar($aguja, $rutaCarpeta, $ext) {
        // Formateando extensiones a|b|c -> {a,b,c}
        $extComas = str_replace('|', ',', $ext);
        
        // Creando directorio de busqueda
        $dirBuscar = glob($rutaCarpeta . '*.{' . $extComas . '}', GLOB_BRACE);
        
        foreach($dirBuscar as $archivo) {
            if(strpos($archivo, $aguja) !== false) {
                if(file_exists($archivo)) unlink($archivo);
            }
        }
    }
    
    // Función para reemplazar archivo ($ext = ext1|ext2|ext3)
    public function reemplazar($nomInput, $nomArchivo, $rutaCarga, $ext) {
        // Obteniendo id de archivo (ID-timestamp.extension)
        $id = explode('-', $nomArchivo)[0] . '-';
        
        // Eliminando y guardando nuevo archivo
        $this->eliminar($id, $rutaCarga, $ext);
        return $this->cargar($nomInput, $nomArchivo, $rutaCarga, $ext);
    }
    
    // Funcion para convertir tipo de archivo en extensión de archivo
    public function conversorImagenExtension($archivoTipo) {
        switch($archivoTipo) {
            case 'image/jpeg':
                return '.jpg';
            case 'image/bmp':
                return '.bmp';
            case 'image/png':
                return '.png';
        }
    }
}

