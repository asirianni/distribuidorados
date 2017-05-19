<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * CONTROLADOR QUE SE ENCARGA DE QUE EL USUARIO
 * PUEDA INICIAR SESSION EN EL SISTEMA 
 */

class Login extends CI_Controller
{
    public $session_ci= null;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Usuario_model");
        $this->session_ci= new Session_ci();
        
    }
    
    // INDEX ES LA FUNCION DE LOGIN DE LA WEB
    
    public function index()
    {
        $salida["mensajes_error"]=Array();
        $salida["mensaje_success"]="";
        
        if($this->session->userdata("ingresado"))
        {
           $this->session_ci->destruirSesion(); 
        }
        
        if($this->input->post())
        {
            $this->load->library("Correo");
            $this->load->library("Md5");
            
            $usuario_correo= $this->input->post("usuario_correo");
            $password = Md5::cifrar($this->input->post("password"));
            
            $usuario_response = null;
            
            if($usuario_correo != "" && $password != "")
            {
                if(Correo::validar_correo($usuario_correo))
                {
                    $usuario_response= $this->Usuario_model->get_usuario_inicio_sesion_con_correo($usuario_correo,$password);
                }
                else
                {
                    $usuario_response= $this->Usuario_model->get_usuario_inicio_sesion($usuario_correo,$password);
                }

                if($usuario_response && $usuario_response["estado"]==1)
                {
                    $this->session_ci->crearSesion($usuario_response);
                    
                    $this->load->library("Funciones_generales");
                    
                    $redirect = new Funciones_generales();
                    redirect($redirect->redireccionar_usuario());
                }
                else
                {
                    if($usuario_response["estado"]==2)
                    {
                        $salida["mensajes_error"][0]="El usuario se encuentra suspendido";
                        $this->load->view("login/iniciar_sesion",$salida);
                    }
                    else
                    {
                        if(Correo::validar_correo($usuario_correo))
                        {
                            $user_error = $this->Usuario_model->get_usuario_con_correo($usuario_correo);

                            if($user_error)
                            {
                                $salida["mensajes_error"][0]="La contraseña ingresada no es correcta";
                                $this->load->view("login/iniciar_sesion",$salida);
                            }
                            else
                            {
                                $salida["mensajes_error"][0]="El correo ingresado no esta registrado";
                                $this->load->view("login/iniciar_sesion",$salida);
                            }
                        }
                        else
                        {
                            $user_error = $this->Usuario_model->get_usuario_con_usuario($usuario_correo);

                            if($user_error)
                            {
                                $salida["mensajes_error"][0]="La contraseña ingresada no es correcta";
                                $this->load->view("login/iniciar_sesion",$salida);
                            }
                            else
                            {
                                $salida["mensajes_error"][0]="El usuario ingresado no esta registrado";
                                $this->load->view("login/iniciar_sesion",$salida);
                            }
                        }
                    }
                }
            }
            else
            {
                if($usuario_correo == "" && $password == "")
                {
                    $salida["mensajes_error"][0]="Por favor ingrese un usuario o correo valido";
                    $salida["mensajes_error"][1]="Por favor ingrese una contraseña";
                }
                else
                {
                    if($usuario_correo == "")
                    {
                        $salida["mensajes_error"][0]="Por favor ingrese un usuario o correo valido";
                    }
                    else
                    {
                        $salida["mensajes_error"][0]="Por favor ingrese una contraseña";
                    }
                }
                
                $this->load->view("login/iniciar_sesion",$salida);
            }
        }
        else 
        {
            $this->load->view("login/iniciar_sesion",$salida);
        }
    }
    
    public function olvide_mis_datos()
    {
        $salida["mensaje_aviso"]="";
        
        if($this->input->post())
        {
            $this->load->model("Usuario_model");
            $this->load->library("Correo");
            
            $usuario_correo = $this->input->post("usuario_correo");
            
            $response_user = null;
            $es_correo= false;
            
            if(Correo::validar_correo($usuario_correo))
            {
                $response_user = $this->Usuario_model->get_usuario_con_correo($usuario_correo);
                $es_correo= true;
            }
            else
            {
                $response_user= $this->Usuario_model->get_usuario_con_usuario($usuario_correo);
            }
            
            if($response_user)
            {
                $correo_usuario = $response_user["correo"];
                $usuario= $response_user["usuario"];
                $password  = $response_user["password"];
                
                $this->load->library("Recuperacion_cuenta");
                
                $mensaje = Recuperacion_cuenta::getHtmlMensajeDatosCuenta($correo_usuario,$usuario,$password);
                $asunto = "Datos de su cuenta: $usuario";
                $emisor= "mario.olivera96@gmail.com";
                
                if(Correo::enviar_correo($mensaje, $asunto, $emisor, $correo_usuario))
                {
                    $salida["mensajes_error"]=Array();
                    $salida["mensaje_success"]="Se han en enviado los datos de su cuenta, revise su correo";
                    $this->load->view("login/iniciar_sesion",$salida);
                }
                else
                {
                    $salida["mensaje_aviso"]="Ha ocurrido un error y no se han podido mandar los datos";
                    $this->load->view("login/recuperar_datos",$salida);
                }
            }
            else
            {
                if($es_correo){$salida["mensaje_aviso"]="No se encontró ningun usuario con el correo ingresado";}
                else{$salida["mensaje_aviso"]="No se encontró el usuario ingresado";}
                $this->load->view("login/recuperar_datos",$salida);
            }
        }
        else
        {
            $this->load->view("login/recuperar_datos",$salida);
        }
        
        
    }
}

