<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Webservice extends CI_Controller
{
    public $funciones_generales;
    public $adminlte;
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function get_productos()
    {
        $this->load->model("Stock_productos_model");

        $respuesta = $this->Stock_productos_model->get_listado_productos();
        
        echo json_encode($respuesta);
    }

    public function get_clientes()
    {
        $this->load->model("Registro_de_clientes_model");

        $respuesta = $this->Registro_de_clientes_model->get_clientes_ws();
        
        echo json_encode($respuesta);
    }

    public function get_pedidos()
    {
        $this->load->model("Registro_de_pedidos_model");
        $respuesta = $this->Registro_de_pedidos_model->get_listado_pedidos();
        echo json_encode($respuesta);
    }
}

