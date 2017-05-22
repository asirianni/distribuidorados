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
    
    public function agregar_proveedor()
    {
        $datos = Array(
            
        );
        
        return $this->db->insert("proveedor",$atos);
    }
}

