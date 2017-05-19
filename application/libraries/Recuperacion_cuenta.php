<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Recuperacion_cuenta
{
    public function __construct() {
        
    }
    
    public static function getHtmlMensajeDatosCuenta($correo_usuario,$usuario,$password)
    {
        $html=
        "<h2>Datos de su cuenta</h2>
         <p><b>Usuario</b>: $usuario</p>
         <p><b>Password</b>: $password</p>
         <p><b>Correo</b>: $correo_usuario</p>
         <br/><br/>
         <a href='".base_url()."index.php/Login'>Inicie sesion en el sistema ahora</a>";
        return $html;
    }
}

