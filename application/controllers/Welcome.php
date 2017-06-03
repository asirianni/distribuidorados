<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Este controlador pertenece al acceso del cliente en el sistema.
         * 
	 */
    
	public $adminlte;
        
        public function __construct() {
            parent::__construct();
            $this->load->library("AdminLTE");
             $this->adminlte= new AdminLTE();
        }
        public function index()
	{
            $salida["mensajes_error"]=Array();
            $salida["mensaje_success"]="";

            if($this->session->userdata("ingresado") != true && $this->session->userdata("tipo_usuario") != "cliente")
            {
                if($this->input->post())
                {

                    $this->load->model("Clientes_model");
                    $this->load->library("Correo");
                    $this->load->library("Md5");

                    $correo = $this->input->post("correo");
                    $password = Md5::cifrar($this->input->post("password"));


                    $registro = $this->Clientes_model->get_cliente_inicio_sesion($correo,$password);

                    if($registro)
                    {
                        if((int)$registro["estado"] == 1)
                        {
                            $registro["ingresado"]=true;
                            $registro["tipo_usuario"]="cliente";
                            
                            $this->session->set_userdata($registro);
                            redirect("Welcome/principal_cliente");
                        }
                        else
                        {
                            $salida["mensajes_error"][0]= "El usuario no se encuentra operativo.";
                            $this->load->view('back/cliente/iniciar_sesion',$salida);
                        }
                    }
                    else
                    {
                       $salida["mensajes_error"][0]= "Correo y/o contraseña incorrectos"; 
                       $this->load->view('back/cliente/iniciar_sesion',$salida);
                    }

                }
                else 
                {
                    $this->load->view('back/cliente/iniciar_sesion',$salida);
                }
            }
            else
            {
                redirect("Welcome/principal_cliente");
            }
	}
        
        
        public function principal_cliente()
        {
            if($this->validar_acceso())
            {
                $output["css"]=$this->adminlte->get_css_datatables();
                $output["js"]=$this->adminlte->get_js_datatables();
            
                $this->load->model("Clientes_model");
                    
                $output["listado_productos"]= $this->Clientes_model->get_lista_productos($this->session->userdata("lista"));
                $this->load->view("back/cliente/lista_de_productos",$output);
            }
            else
            {
                redirect("Welcome");
            }
        }
        
        
        public function ver_catalogo()
	{
            $this->load->view('welcome_message');
	}
        
        
        private function validar_acceso()
        {
            $respuesta = false;
            
            if($this->session->userdata("ingresado") == true && $this->session->userdata("tipo_usuario") == "cliente")
            {
                $respuesta = true;
            }
            
            return $respuesta;
        }
}
