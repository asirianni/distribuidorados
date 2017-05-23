<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Compras_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_proveedores()
    {
        $r = $this->db->query("SELECT * FROM proveedor WHERE estado != 'baja'");
        return $r->result_array();
    }
    
    public function baja_proveedor($id)
    {
        $this->db->where("id",$id);
        return $this->db->update("proveedor",Array("estado"=>"baja"));
    }
    
    public function agregar_proveedor($razon_social,$telefono,$correo,$direccion,$cuil,$estado,$fecha_alta,$ingresos_brutos,$localidad)
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
        );
        
        return $this->db->insert("proveedor",$datos);
    }
    
    public function editar_proveedor($id,$razon_social,$telefono,$correo,$direccion,$cuil,$estado,$fecha_alta,$ingresos_brutos,$localidad)
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
        );
        
        $this->db->where("id",$id);
        return $this->db->update("proveedor",$datos);
    }
}

