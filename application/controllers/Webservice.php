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

    private function validar_usuario($usuario,$password)
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

        return $respuesta;
    }
    
    public function get_inicio_sesion($usuario=null,$password=null)
    {
        $respuesta= $this->validar_usuario($usuario,$password);
        echo json_encode($respuesta);
    }

    public function get_actualizacion($usuario=null,$password=null)
    {
        $respuesta = Array("validado"=>false,"productos"=>null,"pedidos"=>null,"clientes"=>null);

        $validado = $this->validar_usuario($usuario,$password);

        if($validado)
        {
            $respuesta["validado"]= $validado;

            $this->load->model("Stock_productos_model");

            $respuesta["productos"] = $this->Stock_productos_model->get_listado_productos();

            $this->load->model("Registro_de_clientes_model");

            $respuesta["clientes"] = $this->Registro_de_clientes_model->get_clientes_ws();
        
            $this->load->model("Registro_de_pedidos_model");
            $respuesta["pedidos"] = $this->Registro_de_pedidos_model->get_listado_pedidos();
        } 

        echo json_encode($respuesta);
    }

    
}

