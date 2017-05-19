<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends MY_Controller
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
        if($this->funciones_generales->dar_permiso(1))
        {
            $output["css"]="";
            $output["js"]="";
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $this->load->view("back/admin/escritorio",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function abm_usuarios()
    {
        if($this->funciones_generales->dar_permiso(1))
        {
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            $output["usuarios"]= $this->Usuario_model->get_usuarios();
            $output["estados_usuarios"]=$this->Usuario_model->get_estados_usuarios();
            $output["tipos_usuarios"]=$this->Usuario_model->get_tipos_usuarios();
            
            $this->load->view("back/admin/abm_usuarios",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function administrar_modulos_de_usuario($id_usuario = null)
    {
        if($this->funciones_generales->dar_permiso(1) && $id_usuario != null)
        {
            $output["css"]="";
            $output["js"]="";
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            $output["modulos_existentes"] = $this->Usuario_model->get_modulos_usuario($id_usuario);
            $output["modulos_faltantes"] = $this->Usuario_model->get_modulos_faltantes_usuario($id_usuario); 
            $output["id_usuario"]=$id_usuario;
            $output["usuario"]=$this->Usuario_model->get_usuario_por_id($id_usuario);
            $this->load->view("back/admin/adm_modulos_usuario",$output);
        }
        else
        {
            redirect("Administrador/abm_usuarios");
        }
    }
    
    public function activar_modulo_usuario()
    {
        if($this->funciones_generales->dar_permiso(1) && $this->input->is_ajax_request())
        {
            $id_usuario= $this->input->post("id_usuario");
            $id_modulo= $this->input->post("id_modulo");
            
            $respuesta = $this->Usuario_model->activar_modulo_usuario($id_modulo,$id_usuario);
        
            echo json_encode($respuesta);
        }
    }
    
    public function desactivar_modulo_usuario()
    {
        if($this->funciones_generales->dar_permiso(1) && $this->input->is_ajax_request())
        {
            $id_usuario= $this->input->post("id_usuario");
            $id_modulo= $this->input->post("id_modulo");
            
            $respuesta = $this->Usuario_model->desactivar_modulo_usuario($id_modulo,$id_usuario);
        
            echo json_encode($respuesta);
        }
    }
    
    public function mi_perfil()
    {
        if($this->funciones_generales->dar_permiso(1))
        {
            $output["css"]=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();

            $this->load->library("Md5");
            
            // OBTENIENDO PERFIL

            $output["mi_perfil"]=$this->Usuario_model->get_usuario_por_id($this->session->userdata("id"));

            $output["mi_perfil"]["pass"]= Md5::descifrar($output["mi_perfil"]["pass"]);
            $output["estados_usuarios"]=$this->Usuario_model->get_estados_usuarios();
            $output["tipos_usuarios"]=$this->Usuario_model->get_tipos_usuarios();
                
            $this->load->view("back/admin/mi_perfil",$output);      
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function actualizar_perfil()      
    {
        if($this->funciones_generales->dar_permiso(1) && $this->input->is_ajax_request())
        {
            
            $foto_perfil="";
            
            // SUBIR IMAGEN 
            $config['upload_path']          = './recursos/images/foto_perfil/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['overwrite']= false;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('foto_perfil'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                
                $foto_perfil=$data["upload_data"]["file_name"];
            }
              
            //$this->input->post("foto_perfil");
            $usuario= $this->input->post("usuario_editar_perfil");
            $pass= "";
            $nueva_password= $this->input->post("nueva_password");
            $nueva_password2=$this->input->post("nueva_password2");
            
            if($nueva_password!="" && $nueva_password==$nueva_password2)
            {
                $this->load->library("Md5");
                $pass = Md5::cifrar($nueva_password);
            }
            
            $id=$this->session->userdata("id");
            $nombre=$this->input->post("nombre_editar_perfil");
            $apellido= $this->input->post("apellido_editar_perfil");
            $correo= $this->input->post("correo_editar_perfil");
            $tipo_usuario= $this->input->post("tipo_editar_perfil");
            $fecha_registro = $this->input->post("fecha_registro_editar_perfil");
            $estado = $this->input->post("estado_editar_perfil");
            
            $respuesta = $this->Usuario_model->editar_usuario($id,$usuario,$pass,$correo,$tipo_usuario,$estado,$fecha_registro,$nombre,$apellido,$foto_perfil);
            
            $this->funciones_generales->actualizarSesion();
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_usuario()
    {
        $respuesta = false;
        
        
        if($this->funciones_generales->dar_permiso(1) && $this->input->is_ajax_request())
        {
            
            // SUBIR IMAGEN 
            $config['upload_path']          = './recursos/images/foto_perfil/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['overwrite']= false;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('foto_perfil_agregar_usuario'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                
                $respuesta= true;
            }
            
            // SI SE SUBIO LA IMAGEN
            
            if($respuesta)
            {
                $this->load->library("Md5");
                // SE INTENTA CREAR EL USUARIO
                $foto_perfil=$data["upload_data"]["file_name"];
                
                $usuario= $this->input->post("usuario_agregar_usuario");
                $pass= $this->input->post("password_agregar_usuario");
                $pass= Md5::cifrar($pass);
                $correo= $this->input->post("correo_agregar_usuario");
                $tipo_usuario= $this->input->post("tipo_agregar_usuario");
                $estado= $this->input->post("estado_agregar_usuario");
                $fecha_registro= $this->input->post("fecha_registro_agregar_usuario");
                $nombre= $this->input->post("nombre_agregar_usuario");
                $apellido= $this->input->post("apellido_agregar_usuario");
                
                $respuesta= $this->Usuario_model->agregar_usuario($usuario,$pass,$correo,$tipo_usuario,$estado,$fecha_registro,$nombre,$apellido,$foto_perfil);
            }
        }
        
        echo json_encode($respuesta);
    }
    
    public function editar_usuario()
    {
        $respuesta = false;
        
        
        if($this->funciones_generales->dar_permiso(1) && $this->input->is_ajax_request())
        {
            $data;
            // SUBIR IMAGEN 
            $config['upload_path']          = './recursos/images/foto_perfil/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 5000;
            $config['max_width']            = 4000;
            $config['max_height']           = 4000;
            $config['overwrite']= false;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('foto_perfil_editar_usuario'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                
                $respuesta= true;
            }
            
            // SI SE SUBIO LA IMAGEN
            
            
            $foto_perfil="";
            
            if($respuesta)
            {
                $foto_perfil=$data["upload_data"]["file_name"];
            }
            
            // SE INTENTA CREAR EL USUARIO
            
            
            $id=$this->input->post("id_editar_usuario");
            $usuario= $this->input->post("usuario_editar_usuario");
            
            $pass="";
            
            $pass_nueva_1= $this->input->post("nueva_password_editar_usuario");
            $pass_nueva_2= $this->input->post("nueva_password2_editar_usuario");
            
            if($pass_nueva_1 != "" && $pass_nueva_1 == $pass_nueva_2)
            {
                $this->load->library("Md5");
                $pass=Md5::cifrar($pass_nueva_1);
            }
            
            $correo= $this->input->post("correo_editar_usuario");
            $tipo_usuario= $this->input->post("tipo_editar_usuario");
            $estado= $this->input->post("estado_editar_usuario");
            $fecha_registro= $this->input->post("fecha_registro_editar_usuario");
            $nombre= $this->input->post("nombre_editar_usuario");
            $apellido= $this->input->post("apellido_editar_usuario");
                
            $respuesta= $this->Usuario_model->editar_usuario($id,$usuario,$pass,$correo,$tipo_usuario,$estado,$fecha_registro,$nombre,$apellido,$foto_perfil);
            
        }
        
        echo json_encode($respuesta);
    }
    
    public function get_usuario()
    {
        $respuesta = false;
        
        
        if($this->funciones_generales->dar_permiso(1) && $this->input->is_ajax_request())
        {
            $respuesta = $this->Usuario_model->get_usuario_por_id($this->input->post("id")); 
            $this->load->library("Md5");
            $respuesta["pass"]= Md5::descifrar($respuesta["pass"]);
        }
        
        echo json_encode($respuesta);
    }
    
    public function get_modulos_usuario()
    {
        $respuesta = false;
        
        if($this->funciones_generales->dar_permiso(1) && $this->input->is_ajax_request())
        {
            $modulos_existentes = $this->Usuario_model->get_modulos_usuario($this->input->post("id"));
            $modulos_faltantes = $this->Usuario_model->get_modulos_faltantes_usuario($this->input->post("id")); 
            $respuesta= Array($modulos_existentes,$modulos_faltantes);
            
        }
        
        echo json_encode($respuesta);
    }
}

