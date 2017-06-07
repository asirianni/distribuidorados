<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedor extends MY_Controller
{
    public $funciones_generales;
    public $adminlte;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Funciones_generales");
        $this->load->library("AdminLTE");
        $this->load->model("Usuario_model");
        
        $this->funciones_generales= new Funciones_generales();
        
        $this->adminlte= new AdminLTE();
    }
    
    public function index()
    {
        if($this->funciones_generales->dar_permiso(2))
        {
            $output["css"]="";
            $output["js"]="";
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $output["controller_usuario"]=$this->controller_usuario;
            
            $output["permiso_productos"]= $this->funciones_generales->dar_permiso_a_modulo(3);
            $output["permiso_clientes"]= $this->funciones_generales->dar_permiso_a_modulo(2);
            $output["permiso_facturacion"]= $this->funciones_generales->dar_permiso_a_modulo(5);
            $output["permiso_reportes"]=$this->funciones_generales->dar_permiso_a_modulo(8);
            $output["permiso_pedidos"]= $this->funciones_generales->dar_permiso_a_modulo(4);
            $output["permiso_compras"]= $this->funciones_generales->dar_permiso_a_modulo(7);
            $this->load->view("back/vendedor/escritorio",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
}

