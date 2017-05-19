<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_usuario
{
    public static function getMenu($tipo_usuario)
    {
        $html = "";
        
        switch($tipo_usuario)
        {
            case 1: $html= Menu_usuario::getMenuAdministrador();
                break;
            case 2:$html= Menu_usuario::getMenuVendedor();
                break;
            case 3:$html= Menu_usuario::getMenuContador();
                break;
            case 4:$html= Menu_usuario::getMenuTransportista();
                break;
        }
        
        return $html;
    }
    
    public static function getMenuAdministrador()
    {
        $html=
        "<li><a href='".  base_url()."index.php/Administrador'><i class='fa fa-desktop'></i> <span>Escritorio</span></a></li>".
        "<li><a href='".  base_url()."index.php/Administrador/abm_usuarios'><i class='fa fa-user'></i> <span>Usuarios</span></a></li>";
    
        
        return $html;
    }
    
    public static function getMenuVendedor()
    {
        $html=
        "<li><a href='".  base_url()."index.php/Vendedor'><i class='fa fa-desktop'></i> <span>Escritorio</span></a></li>";
        
        return $html;
    }
    
    public static function getMenuContador()
    {
        $html=
        "<li><a href='".  base_url()."index.php/Contador'><i class='fa fa-desktop'></i> <span>Escritorio</span></a></li>";
        
        return $html;
    }
    
    public static function getMenuTransportista()
    {
        $html=
        "<li><a href='".  base_url()."index.php/Transportista'><i class='fa fa-desktop'></i> <span>Escritorio</span></a></li>";
        return $html;
    }
}

