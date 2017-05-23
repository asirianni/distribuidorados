<?php defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH."libraries/adminlte/Menu_usuario.php";
require APPPATH."libraries/adminlte/Header_usuario.php";
require APPPATH."libraries/adminlte/Config.php";
require APPPATH."libraries/adminlte/Menu_Config.php";


class AdminLTE extends Config
{
    public $ci;
    
    private $header;
    private $main_sidebar;
    private $footer;
    
    
    
    public function __construct() 
    {
        $this->ci = &get_instance();
    }
    
    public function getMenu()
    {
        $html= 
                
        "<!-- Left side column. contains the logo and sidebar -->
            <aside class='main-sidebar'>
              <!-- sidebar: style can be found in sidebar.less -->
              <section class='sidebar'>
                <!-- Sidebar user panel -->
                <!--<div class='user-panel'>
                  <div class='pull-left image'>";
                    if($this->permitir_foto_perfil)
                    {
                        $html.="<img src='".base_url()."recursos/images/foto_perfil/".$this->ci->session->userdata("foto_perfil")."' class='img-circle' alt='User Image'>";
                    }
                    else
                    {
                       $html.="<img src='".base_url()."recursos/images/foto_perfil/foto_default.png' class='img-circle' alt='User Image'>"; 
                    }
        $html.="  </div>
                  <div class='pull-left info'>
                    <p>".$this->ci->session->userdata("nombre")." ".$this->ci->session->userdata("apellido")."</p>
                    <a href='#'><i class='fa fa-circle text-success'></i> Online</a>
                  </div>
                </div>-->";
            if($this->permitir_busqueda)
            {
             $html.="<!-- search form -->
                    <form action='".  base_url()."index.php/".$this->controlador_funcion_resultado."' method='get' class='sidebar-form'>
                      <div class='input-group'>
                        <input type='text' name='q' class='form-control' placeholder='Search...'>
                            <span class='input-group-btn'>
                              <button type='submit' name='search' id='search-btn' class='btn btn-flat'><i class='fa fa-search'></i>
                              </button>
                            </span>
                      </div>
                    </form>
                    <!-- /.search form -->";      
            }
                
       $html.=" <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class='sidebar-menu'>
                  <li class='header'>MENU DE NAVEGACION</li>";
       
                  $html.=Menu_usuario::getMenu($this->ci->session->userdata("tipo_usuario"));
                  
                  // SE AGREGA TAMBIEN LOS MODULOS A LOS QUE TIENE ACCESO
                  $html.=$this->ci->session->userdata("menu_modulos");
                  
        
        $html.="</ul>
              </section>
              <!-- /.sidebar -->
            </aside>";
        
        Menu_usuario::getMenu($this->ci->session->userdata("tipo_usuario"));
        return $html;
    }
    
    public function getHeader()
    {
        $html= Header_usuario::getHeader($this->ci->session->userdata("tipo_usuario"),$this->ci->session->userdata("nombre"),$this->ci->session->userdata("apellido"),$this->ci->session->userdata("fecha_registro"),$this->ci->session->userdata("foto_perfil"));      
        return $html;
    }
    
    public function getMenuConfiguracion()
    {
        $html= Menu_Config::getMenuConfig($this->ci->session->userdata("tipo_usuario"));
        return $html;
    }
    
    public function getFooter()
    {
        $html=
        "<footer class='main-footer'>
            <div class='pull-right hidden-xs'>
              <b>Version</b> 1.1
            </div>
            &nbsp;
            <!--<strong>Copyright &copy; 2014-2016 <a href='http://almsaeedstudio.com'>Almsaeed Studio</a>.</strong> All rights
            reserved.-->
         </footer>";
        return $html;
    }
    
    
    public function get_css_datatables()
    {
        $html=
        "<!-- DataTables -->
        <link rel='stylesheet' href='".base_url()."recursos/plugins/datatables/dataTables.bootstrap.css'>
        ";
        return $html;
    }
    
    public function get_css_datetimepicker()
    {
        $html=
        "<!--DATE TIME PICKER-->
        <link rel='stylesheet' type='text/css' href='".base_url()."recursos/plugins/datetimepicker/jquery.datetimepicker.css'/>
        ";
        return $html;
    }
    
    public function get_css_select2()
    {
        $html=
        "<!--Select2-->
        <link rel='stylesheet' type='text/css' href='".base_url()."recursos/plugins/select2/select2.min.css'/>
        ";
        return $html;
    }
    
    public function get_js_datatables()
    {
        $html=
        "<!-- DataTables -->
        <script src='".base_url()."recursos/plugins/datatables/jquery.dataTables.min.js'></script>
        <script src='".base_url()."recursos/plugins/datatables/dataTables.bootstrap.min.js'></script>";
        return $html;
    }
    
    public function get_js_datetimepicker()
    {
        $html=
        "<!-- bootstrap datepicker -->
        <script src='".base_url()."recursos/plugins/datetimepicker/bootstrap-datepicker.js'></script>
        <!-- bootstrap color picker -->
        <script src='".base_url()."recursos/plugins/datetimepicker/bootstrap-colorpicker.min.js'></script>
        <!-- bootstrap time picker -->
        <script src='".base_url()."recursos/plugins/datetimepicker/bootstrap-timepicker.min.js'></script>
        <script src='".base_url()."recursos/plugins/datetimepicker/jquery.datetimepicker.js'></script>  ";
        return $html;
    }
    
    public function get_js_select2()
    {
        $html=
        "<!-- Select2 -->
        <script src='".base_url()."recursos/plugins/select2/select2.min.js'></script>";
        return $html;
    }
    
    public static function getMenuModulos($modulos,$controller_user)
    {
        $html="";
        
        foreach($modulos as $value)
        {
            $id_modulo = (int)$value["id_modulo"];
            
            switch($id_modulo)
            {
                case 2: $html.="<li><a href='".base_url()."index.php/".$controller_user."/registro_de_clientes'><i class='fa fa-users'></i> <span>Registro de Clientes</span></a></li>"; 
                    break;
                
                
                case 3:
                    $html.="<li class='treeview'>
                                <a href='#'>
                                  <i class='fa fa-cube'></i> <span>Productos</span>
                                  <span class='pull-right-container'>
                                    <i class='fa fa-angle-left pull-right'></i>
                                  </span>
                                </a>
                                <ul class='treeview-menu'>
                                  <li><a href='".base_url()."index.php/".$controller_user."/stock_de_productos_listado'><i class='fa fa-circle-o'></i>Listado</a></li>
                                    <li><a href='".base_url()."index.php/".$controller_user."/stock_de_productos_rubros'><i class='fa fa-circle-o'></i>Rubros</a></li>
                                    <!--<li><a href='".base_url()."index.php/".$controller_user."/registro_de_pedidos'><i class='fa fa-circle-o'></i> Precios</a></li>-->
                                    <li><a href='".base_url()."index.php/".$controller_user."/stock_de_productos_ubicaciones'><i class='fa fa-circle-o'></i> Ubicaciones</a></li>
                                    <li><a href='".base_url()."index.php/".$controller_user."/stock_de_productos_medidas'><i class='fa fa-circle-o'></i> Medidas</a></li>
                                    <!--<li><a href='".base_url()."index.php/".$controller_user."/stock_de_productos_movimientos'><i class='fa fa-circle-o'></i> Movimientos</a></li>-->
                                </ul>
                             </li>";
                    break;
                
                case 4: $html.="<li><a href='".base_url()."index.php/".$controller_user."/registro_de_pedidos'><i class='fa fa-edit'></i> <span>Pedidos</span></a></li>";
                     break;
                
                case 5: $html.="<li class='treeview'>
                                <a href='#'>
                                  <i class='fa fa-calculator'></i> <span>Facturacion</span>
                                  <span class='pull-right-container'>
                                    <i class='fa fa-angle-left pull-right'></i>
                                  </span>
                                </a>
                                <ul class='treeview-menu'>
                                  <li><a href='".base_url()."index.php/".$controller_user."/caja'><i class='fa fa-circle-o'></i>Caja diaria</a></li>
                                  <li><a href='".base_url()."index.php/".$controller_user."/facturacion'><i class='fa fa-circle-o'></i>Facturacion</a></li>
                                </ul>
                             </li>";
                    break;
                
                case 6: $html.="<li><a href='".base_url()."index.php/".$controller_user."'><i class='fa fa-bars'></i> <span>Estados de cuenta</span></a></li>"; 
                    break;
                case 7: $html.="<li class='treeview'>
                                <a href='#'>
                                  <i class='fa fa-bar-chart'></i> <span>Compras</span>
                                  <span class='pull-right-container'>
                                    <i class='fa fa-angle-left pull-right'></i>
                                  </span>
                                </a>
                                <ul class='treeview-menu'>
                                  <li><a href='".base_url()."index.php/".$controller_user."/abm_proveedores'><i class='fa fa-circle-o'></i>Proveedores</a></li>
                                  <li><a href='".base_url()."index.php/".$controller_user."/factura_compra'><i class='fa fa-circle-o'></i>Factura compra</a></li>
                                </ul>
                             </li>";
                    break;
                case 8: $html.="<li class='treeview'>
                                    <a href='#'>
                                      <i class='fa fa-book'></i> <span>Reportes</span>
                                      <span class='pull-right-container'>
                                        <i class='fa fa-angle-left pull-right'></i>
                                      </span>
                                    </a>
                                    <ul class='treeview-menu'>
                                      <li><a href='".base_url()."index.php/".$controller_user."/reporte_de_compra'><i class='fa fa-circle-o'></i>Reporte de compra</a></li>
                                      <li><a href='".base_url()."index.php/".$controller_user."/reporte_de_venta'><i class='fa fa-circle-o'></i>Reporte de vompra</a></li>
                                    </ul>
                                 </li>";
                    break;
                
            }
        }
        return $html;
    }
}
