<?php defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

class Webservice extends CI_Controller
{
    public $funciones_generales;
    public $adminlte;
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function get_inicio_sesion($usuario=null,$password=null)
    {
        $respuesta = false;

        $this->load->model("Usuario_model");

        if($usuario != "" && $usuario != null && $password != "" && $password != null)
        {
            $this->load->library("Md5");
            
            $password = Md5::cifrar($password);

            $usuario_response= $this->Usuario_model->get_usuario_inicio_sesion($usuario,$password);

            if($usuario_response && $usuario_response["estado"]==1)
            {
                $respuesta = true;
            }
        }
        
        echo json_encode($respuesta);
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

