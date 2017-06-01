<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Localidades_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    public function get_localidades()
    {
        $r = $this->db->query("select localidades.*, provincias.provincia as desc_provincia from localidades INNER JOIN provincias on provincias.id = localidades.id_provincia");
        return $r->result_array();
    }
}
