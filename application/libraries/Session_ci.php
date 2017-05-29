<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * LIBRERIA QUE SE ENCARGA DE LAS SESSIONES EN CODEIGNITER
 */

class Session_ci 
{
    public $ci;
    private $array_sesion=Array();
    
    public function __construct() 
    {
        $this->ci= &get_instance(); 
    }
    
    public function getTipoUsuario()
    {
        return (int)$this->ci->session->userdata("tipo_usuario");
    }
    
    public function SesionIniciada()
    {
        return $this->ci->session->userdata("ingresado");
    }
    
    public function crearSesion($arreglo)
    {
        $contador=0;
        
        while($contador < count($arreglo) || current($arreglo))
        {
            $posicion = key($arreglo);
            $this->array_sesion[$contador]= $posicion;
            $contador++;
            next($arreglo);
        }
        
        $arreglo["ingresado"]=true;
        
        // SUBE EL MENU A LA SESION
        
        $this->ci->load->model("Usuario_model");
        $this->ci->load->library("AdminLTE");
        $this->ci->load->library("Funciones_generales");
       
        
        $funciones = new Funciones_generales();
        $tipo_usuario = (int)$arreglo["tipo_usuario"];
        $modulos_usuario = $this->ci->Usuario_model->get_modulos_usuario($arreglo["id"],$tipo_usuario);
        
        $menu_modulos=AdminLTE::getMenuModulos($modulos_usuario,Funciones_generales::get_name_controller_usuario_sin_sesion($arreglo["tipo_usuario"]));
        
        $arreglo["menu_modulos"]=$menu_modulos;
        //
        
        $this->ci->session->set_userdata($arreglo); 
    }
    
    public function destruirSesion()
    {
        
	$array_destructor= Array();
        
        for($i=0; $i < count($this->array_sesion);$i++)
        {
            $array_destructor[$this->array_sesion[$i]]="";
        }
        
        if($this->array_sesion != null)
        {
            $this->ci->session->unset_userdata($this->array_sesion);
            $this->array_sesion=Array();
            
        }
        
	$this->ci->session->sess_destroy();
    }    
    
}
