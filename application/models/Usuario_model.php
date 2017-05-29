<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * MODELO QUE SE ENCARGA DE OBTENER
 * DATOS DE LA TABLA USUARIOS SSS
 */


class Usuario_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_usuario_inicio_sesion($usuario,$password)
    {
        $r = $this->db->query("select * from usuarios where usuario = '$usuario' and pass= '$password'");
        return $r->row_array();
    }
    
    public function get_usuario_inicio_sesion_con_correo($correo,$password)
    {
        $r = $this->db->query("select * from usuarios where correo = '$correo' and pass= '$password'");
        return $r->row_array();
    }
    
    public function get_usuario_con_correo($correo)
    {
        $r = $this->db->query("select * from usuarios where correo = '$correo'");
        return $r->row_array();
    }
    
    public function get_usuario_con_usuario($usuario)
    {
        $r = $this->db->query("select * from usuarios where usuario = '$usuario'");
        return $r->row_array();
    }
    
    public function get_usuario_por_id($id)
    {
        $r = $this->db->query("select * from usuarios where id = $id");
        return $r->row_array();
    }
    
    public function get_usuarios()
    {
        $r = $this->db->query("select usuarios.*, estados_usuarios.estado as desc_estado, tipo_usuarios.tipo as desc_tipo from usuarios INNER JOIN estados_usuarios on estados_usuarios.id = usuarios.estado INNER JOIN tipo_usuarios on tipo_usuarios.id = usuarios.tipo_usuario ");
        return $r->result_array();
    }
    
    public function get_estados_usuarios()
    {
        $r = $this->db->query("SELECT * FROM estados_usuarios");
        return $r->result_array();
    }
    
    public function get_tipos_usuarios()
    {
        $r = $this->db->query("SELECT * FROM tipo_usuarios");
        return $r->result_array();
    }
    
    
    public function agregar_usuario($usuario,$pass,$correo,$tipo_usuario,$estado,$fecha_registro,$nombre,$apellido,$foto_perfil)
    {
        $datos = Array(
            "usuario"=>$usuario,
            "pass"=>$pass,
            "correo"=>$correo,
            "tipo_usuario"=>$tipo_usuario,
            "estado"=>$estado,
            "fecha_registro"=>$fecha_registro,
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "foto_perfil"=>$foto_perfil,
        );
        
        return $this->db->insert("usuarios",$datos);
    }
    
    public function editar_usuario($id,$usuario,$pass,$correo,$tipo_usuario,$estado,$fecha_registro,$nombre,$apellido,$foto_perfil)
    {
        $datos = Array(
            "usuario"=>$usuario,
            "correo"=>$correo,
            "tipo_usuario"=>$tipo_usuario,
            "estado"=>$estado,
            "fecha_registro"=>$fecha_registro,
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            
        );
        
        if($pass != "")
        {
            $datos["pass"]=$pass;
        }
        
        if($foto_perfil!="")
        {
            $datos["foto_perfil"]=$foto_perfil;  
        }
        
        $this->db->where("id",$id);
        
        return $this->db->update("usuarios",$datos);
    }
    
    public function get_modulos_usuario($id,$tipo_usuario)
    {
        $r =null;
        if($tipo_usuario == 1)
        {
            $r =$this->db->query("SELECT modulos.id as id_modulo, modulo from modulos");
        }
        else
        {
           $r = $this->db->query("SELECT modulos_usuarios.id_usuario,modulos_usuarios.id_usuario,modulos_usuarios.id_modulo,modulos.modulo as desc_modulo FROM modulos_usuarios INNER JOIN modulos on modulos.id = modulos_usuarios.id_modulo where modulos_usuarios.id_usuario = $id");
        }
        return $r->result_array();
    }
    
    public function get_modulos_faltantes_usuario($id)
    {
        $r = $this->db->query("SELECT modulos.* from modulos where modulos.id not in (SELECT modulos_usuarios.id_modulo as id FROM modulos_usuarios INNER JOIN modulos on modulos.id = modulos_usuarios.id_modulo where modulos_usuarios.id_usuario = $id)");
        return $r->result_array();
    }
    
    public function activar_modulo_usuario($id_modulo,$id_usuario)
    {
       $lo_tiene = $this->db->query("SELECT * FROM modulos_usuarios where id_usuario = $id_usuario and id_modulo = $id_modulo");
       $lo_tiene= $lo_tiene->row_array();
       
       $respuesta = true;
       
       if(!$lo_tiene)
       {
           $datos = Array(
               "id_modulo"=>$id_modulo,
               "id_usuario"=>$id_usuario,
           );
           
           $respuesta = $this->db->insert("modulos_usuarios",$datos);  
       }
       return $respuesta;
    }
    
    public function desactivar_modulo_usuario($id_modulo,$id_usuario)
    {
       $this->db->where("id_modulo",$id_modulo);
       $this->db->where("id_usuario",$id_usuario);
       
       return $this->db->delete("modulos_usuarios");
    }
    
    public function get_permiso_modulo_usuario($id_modulo,$id_usuario)
    {
       $r = $this->db->query("SELECT * FROM modulos_usuarios where id_usuario = $id_usuario and id_modulo = $id_modulo ");
       return $r->row_array(); 
    }
    
}

