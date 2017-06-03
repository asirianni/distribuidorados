<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Este controlador pertenece al acceso del cliente en el sistema.
         * 
	 */
    
	public $adminlte;
        public $template;
        
        public function __construct() {
            parent::__construct();
            $this->load->library("AdminLTE");
            $this->load->library("Cliente_template");
            $this->adminlte= new AdminLTE();
            $this->template= new Cliente_template();
        }
        public function index()
	{
            $salida["mensajes_error"]=Array();
            $salida["mensaje_success"]="";
           
            $this->ci->session->sess_destroy();
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
        
        
        public function principal_cliente()
        {
            if($this->validar_acceso())
            {
                $output["css"]=$this->adminlte->get_css_datatables();
                $output["css"].=$this->adminlte->get_css_datetimepicker();
                $output["js"]=$this->adminlte->get_js_datatables();
                $output["js"].=$this->adminlte->get_js_datetimepicker();
                $output["menu"]= $this->template->get_menu();
                $output["footer"]= $this->template->get_footer();
                $this->load->model("Clientes_model");
                    
                $output["listado_productos"]= $this->Clientes_model->get_lista_productos($this->session->userdata("lista"));
                $this->load->view("back/cliente/lista_de_productos",$output);
            }
            else
            {
                redirect("Welcome");
            }
        }
        
        
        public function mi_lista_de_pedidos()
        {
            if($this->validar_acceso())
            {
                $output["css"]=$this->adminlte->get_css_datatables();
                $output["css"].=$this->adminlte->get_css_datetimepicker();
                $output["js"]=$this->adminlte->get_js_datatables();
                $output["js"].=$this->adminlte->get_js_datetimepicker();
                $output["menu"]= $this->template->get_menu();
                $output["footer"]= $this->template->get_footer();
                $this->load->model("Clientes_model");
                    
                $output["listado_pedidos"]= $this->Clientes_model->get_mi_lista_pedidos();
                
                $this->load->view("back/cliente/lista_de_pedidos",$output);
            }
            else
            {
                redirect("Welcome");
            }
        }
        
        public function ver_detalle_de_mi_pedido($numero_pedido = null)
        {
            if($this->validar_acceso() && $numero_pedido!= null)
            {
                $this->load->model("Clientes_model");
                $mi_pedido= $this->Clientes_model->get_pedido($numero_pedido);
                
                if($mi_pedido && $this->validar_acceso())
                {
                    $output["css"]=$this->adminlte->get_css_datatables();
                    $output["css"].=$this->adminlte->get_css_datetimepicker();
                    $output["js"]=$this->adminlte->get_js_datatables();
                    $output["js"].=$this->adminlte->get_js_datetimepicker();
                    $output["menu"]= $this->template->get_menu();
                    $output["footer"]= $this->template->get_footer();
                    

                    $output["pedido"]=$mi_pedido;
                    $output["detalle"]= $this->Clientes_model->get_detalle_pedido($numero_pedido);

                    $this->load->view("back/cliente/ver_pedido",$output);
                }
                else
                {
                    redirect("Welcome");
                }
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
        
        public function agregar_pedido()
        {
            if($this->validar_acceso() && $this->input->is_ajax_request())
            {
                $this->load->model("Clientes_model");
                
                $detalle= $this->input->post("detalle");
                
                $date = new DateTime($this->input->post("fecha_entrega"));
                
                $fecha_entrega= $date->format('Y-m-d');
                
                $respuesta = $this->Clientes_model->agregar_pedido_y_detalle($fecha_entrega,$detalle);
            
                echo json_encode((boolean)$respuesta);
            }
            else
            {
                redirect("Welcome");
            }
        }
        
        public function exportar_mi_lista_productos()
        {
            if($this->validar_acceso())
            {
                header("Content-type: application/vnd.ms-excel; name='excel'");
                header("Content-Disposition: filename=Lista-de-Productos.xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            
                $this->load->model("Clientes_model");
                    
                $listado_productos= $this->Clientes_model->get_lista_productos($this->session->userdata("lista"));
                
                $html=
                "
                    <table>
                        <thead>
                            <tr>
                                <th>PRODUCTO</th>
                                <th>PRECIO</th>
                                <th style='width: 50px;'></th>
                            </tr>
                        </thead>
                        <tbody>";
                
                    foreach($listado_productos as $value)
                    {
                $html.= "<tr>
                            <td>".$value["descripcion"]."</td>
                            <td>$".$value["precio"]."</td>
                        </tr>";
                    }
                $html.= "</tbody>
            </table>
                ";
                
                echo $html;
            }
            else
            {
                redirect("Welcome");
            }
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
