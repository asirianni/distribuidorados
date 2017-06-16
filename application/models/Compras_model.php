<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    public function get_proveedores()
    {
        $r = $this->db->query("SELECT * FROM proveedor WHERE estado != 'baja'");
        return $r->result_array();
    }
    
    public function get_proveedor($id)
    {
        $r = $this->db->query("SELECT * FROM proveedor WHERE id = $id");
        return $r->row_array();
    }
    
    public function get_ultimo_proveedor()
    {
        $r = $this->db->query("SELECT * FROM proveedor WHERE id in (select max(id) as id from proveedor)");
        return $r->row_array();
    }
    
    public function baja_proveedor($id)
    {
        $this->db->where("id",$id);
        return $this->db->update("proveedor",Array("estado"=>"baja"));
    }
    
    public function agregar_proveedor($razon_social,$telefono,$correo,$direccion,$cuil,$estado,$fecha_alta,$ingresos_brutos,$localidad,$tipo_inscripcion)
    {
        
        $datos = Array(
            "razon_social"=>$razon_social,	
            "telefono" =>$telefono,	
            "correo" =>$correo,	
            "direccion" =>$direccion,	
            "cuil" =>$cuil,	
            "estado" =>$estado,	
            "fecha_alta"=>$fecha_alta,
            "ingresos_brutos"=>$ingresos_brutos,
            "localidad"=>$localidad,
            "tipo_inscripcion"=>$tipo_inscripcion,
        );
        
        $insertado= $this->db->insert("proveedor",$datos);
        
        if($insertado)
        {
            $insertado = $this->get_ultimo_proveedor();
        }
        
        return $insertado;
    }
    
    public function editar_proveedor($id,$razon_social,$telefono,$correo,$direccion,$cuil,$estado,$fecha_alta,$ingresos_brutos,$localidad,$tipo_inscripcion)
    {
        
        $datos = Array(
            "razon_social"=>$razon_social,	
            "telefono" =>$telefono,	
            "correo" =>$correo,	
            "direccion" =>$direccion,	
            "cuil" =>$cuil,	
            "estado" =>$estado,	
            "fecha_alta"=>$fecha_alta,
            "ingresos_brutos"=>$ingresos_brutos,
            "localidad"=>$localidad,
            "tipo_inscripcion"=>$tipo_inscripcion,
        );
        
        $this->db->where("id",$id);
        return $this->db->update("proveedor",$datos);
    }
}

