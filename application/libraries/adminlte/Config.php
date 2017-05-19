<?php defined('BASEPATH') OR exit('No direct script access allowed');

 abstract class Config
 {
    public $image_logo_header= "recursos/dist/img/logo-empresa.png";
    
    // HEADER
    
    //public $texto_header = "NUTRILOG";
    
    // BUSQUEDA
    public $permitir_busqueda= false;
    public $controlador_funcion_resultado= "Buscar_respuesta";
    
    // FOTO PERFIL
    public $permitir_foto_perfil= true;
     
 }

