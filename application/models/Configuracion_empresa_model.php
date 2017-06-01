<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_empresa_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    public function get_configuraciones()
    {
        $r = $this->db->query("select * from configuracion_empresa");
        return $r->result_array();
    }
    
    public function get_configuracion($id)
    {
        $r = $this->db->query("select * from configuracion_empresa where codigo = $id");
        $r= $r->row_array();
        return $r["valor"];
    }
    
    public function editar_configuracion($id,$valor)
    {
        $this->db->where("codigo",$id);
        return $this->db->update("configuracion_empresa",Array("valor"=>$valor));
    }
}