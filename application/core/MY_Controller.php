<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $funciones_generales;
    public $adminlte;
    public $controller_usuario;
    
    public function __construct() {
        parent::__construct();
        
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        
        $this->load->library("Funciones_generales");
        $this->load->library("AdminLTE");
        $this->load->model("Usuario_model");
        
        $this->funciones_generales= new Funciones_generales();
        
        $this->adminlte= new AdminLTE();
        
        $this->controller_usuario= $this->funciones_generales->get_name_controller_usuario();
        
        
    }
    
    // MI PERFIL -> Hace lo heredan todos los usuarios 
    // menos el adm que lo sobreescribe
    
    public function mi_perfil()
    {
        $sesion_ci= new Session_ci();
        if($sesion_ci->SesionIniciada())
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
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/vistas_generales/mi_perfil",$output);      
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function actualizar_perfil()      
    {
        $sesion_ci= new Session_ci();
        if($sesion_ci->SesionIniciada() && $this->input->is_ajax_request())
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
            
            $this->load->model("Usuario_model");
            
            $usuario_datos= $this->Usuario_model->get_usuario_por_id($id);
            
            $tipo_usuario= $usuario_datos["tipo_usuario"];
            $fecha_registro = $usuario_datos["fecha_registro"];
            $estado = $usuario_datos["estado"];
            $respuesta = $this->Usuario_model->editar_usuario($id,$usuario,$pass,$correo,$tipo_usuario,$estado,$fecha_registro,$nombre,$apellido,$foto_perfil);
            
            $this->funciones_generales->actualizarSesion();
            echo json_encode($respuesta);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    
    // FIN MI PERFIL
    
    
    // PERTENECIENTE A MODULO STOCK DE PRODUCTOS -> 2
    
    public function stock_de_productos_listado()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $output["controller_usuario"]=$this->controller_usuario;
            // LOGIC
            
            $output["listado_productos"]= $this->Stock_productos_model->get_listado_productos();
            $output["rubros"]=$this->Stock_productos_model->get_rubros();
            $output["subrubros"]=$this->Stock_productos_model->get_subrubros();
            $output["unidades_medidas"]=$this->Stock_productos_model->get_unidades_medidas();
            $this->load->view("back/modulos/stock_de_productos/listado",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    function exportar_productos_excel()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(4);
        
        if($permiso)
        {
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Lista-de-Productos.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $this->load->model("Stock_productos_model");
            $listado_productos= $this->Stock_productos_model->get_listado_productos();
            
            $html=
            "
                <table>
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Costo</th>
                        <th>List 1</th>
                        <th>List 2</th>
                        <th>List 3</th>
                        <th>List 4</th>
                        <th>Stock</th>
                        <th>Punto Critico</th>
                        <th>Rubro</th>
                        <th>Unidad de medida</th>
                      </tr>
                    </thead>
                    <tbody>";
            
                foreach($listado_productos as $value)
                            {
                                
                                $html.= 
                                "<tr>
                                    <td>".$value["id"]."</td>
                                    <td>".$value["descripcion"]."</td>
                                    <td>$".$value["costo"]."</td>
                                    <td>$".$value["lista_1"]."</td>
                                    <td>$".$value["lista_2"]."</td>
                                    <td>$".$value["lista_3"]."</td>
                                    <td>$".$value["lista_4"]."</td>
                                    <td>".$value["stock"]."</td>
                                    <td>".$value["punto_critico"]."</td>
                                   <td>".$value["desc_rubro"]."</td>
                                   <td>".$value["medida_desc"]."</td>
                                       
                                </tr>";
                            }
                    $html.="</tbody>
                  </table>
            ";
            
            echo $html;
        }
    }
    
    public function precios_vigentes_de_producto($id_producto = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso && $id_producto != null)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            
            $output["listado_precios_vigentes"]= $this->Stock_productos_model->get_precios_vigentes_de_producto($id_producto);
            $output["id_producto"]=$id_producto;
            $output["producto"]=$this->Stock_productos_model->get_producto($id_producto);
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/stock_de_productos/precios_vigentes_de_producto",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function ubicaciones_de_producto($id_producto = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso && $id_producto != null)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            
            $output["ubicaciones_de_producto"]= $this->Stock_productos_model->get_ubicaciones_de_producto($id_producto);
            $output["ubicaciones_faltantes_de_producto"]= $this->Stock_productos_model->get_ubicaciones_faltantes_de_producto($id_producto);
            $output["id_producto"]=$id_producto;
            $output["producto"]=$this->Stock_productos_model->get_producto($id_producto);
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/stock_de_productos/ubicaciones_de_producto",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function stock_de_productos_rubros()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["listado_rubros"]=$this->Stock_productos_model->get_rubros();
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/stock_de_productos/abm_rubros",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function stock_de_productos_subrubros()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["listado_subrubros"]=$this->Stock_productos_model->get_subrubros();
            $output["listado_rubros"]=$this->Stock_productos_model->get_rubros();
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/stock_de_productos/abm_subrubros",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function stock_de_productos_codigos_de_barra()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["listado_codigos_de_barra"]=$this->Stock_productos_model->get_codigos_de_barra();
            $output["listado_productos"]= $this->Stock_productos_model->get_listado_productos();
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/stock_de_productos/abm_codigos_barra",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function stock_de_productos_ubicaciones()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["listado_ubicaciones"]=$this->Stock_productos_model->get_ubicaciones();
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/stock_de_productos/abm_ubicaciones",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function stock_de_productos_medidas()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["listado_unidades_de_medidas"]=$this->Stock_productos_model->get_unidades_de_medidas();
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/stock_de_productos/abm_medidas",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function stock_de_productos_movimientos()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            $this->load->model("Usuario_model");
            
            $desde_consultar=null;
            $hasta_consultar=null;
            $concepto_consultar=null;
            $tipo_comprobante=null;
            $usuario=null;
            $producto=null;
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["listado_movimientos"]=$this->Stock_productos_model->get_movimientos();
            $output["tipos_comprobantes"]= $this->Stock_productos_model->get_tipos_de_comprobantes();
            $output["usuarios"]= $this->Usuario_model->get_usuarios();
            $output["lista_productos"]=$this->Stock_productos_model->get_listado_productos();
            $output["controller_usuario"]=$this->controller_usuario;
            
            // VARIABLES DE SELECCION
            $output["desde_consultar"]=$desde_consultar;
            $output["hasta_consultar"]=$hasta_consultar;
            $output["concepto_consultar"]=$concepto_consultar;
            $output["tipo_comprobante"]=$tipo_comprobante;
            $output["usuario"]=$usuario;
            $output["producto"]=$producto;
            //
            
            $this->load->view("back/modulos/stock_de_productos/abm_movimientos",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function stock_de_productos_consultar()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($this->input->post())
        {
            $desde_consultar=$this->input->post("desde_consultar");
            $hasta_consultar=$this->input->post("hasta_consultar");
            $concepto_consultar=$this->input->post("concepto_consultar");
            $tipo_comprobante=$this->input->post("tipo_comprobante");
            $usuario=$this->input->post("usuario");
            $producto=$this->input->post("producto");
            
            $this->load->model("Stock_productos_model");
            $this->load->model("Usuario_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["listado_movimientos"]=$this->Stock_productos_model->get_movimientos_filtro($desde_consultar,$hasta_consultar,$concepto_consultar,$tipo_comprobante,$usuario,$producto);
            $output["tipos_comprobantes"]= $this->Stock_productos_model->get_tipos_de_comprobantes();
            $output["usuarios"]= $this->Usuario_model->get_usuarios();
            $output["lista_productos"]=$this->Stock_productos_model->get_listado_productos();
            $output["controller_usuario"]=$this->controller_usuario;
            
            // VARIABLES DE SELECCION
            $output["desde_consultar"]=$desde_consultar;
            $output["hasta_consultar"]=$hasta_consultar;
            $output["concepto_consultar"]=$concepto_consultar;
            $output["tipo_comprobante"]=$tipo_comprobante;
            $output["usuario"]=$usuario;
            $output["producto"]=$producto;
            //
            
            
            $this->load->view("back/modulos/stock_de_productos/abm_movimientos",$output);
        }
        else
        {
            redirect($this->controller_usuario."/stock_de_productos_movimientos");
        }
    }
    
    public function stock_de_productos_movimientos_agregar()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(3);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            $this->load->model("Usuario_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["listado_productos"]= $this->Stock_productos_model->get_listado_productos();
            $output["tipos_comprobantes"]= $this->Stock_productos_model->get_tipos_de_comprobantes();
            $output["usuarios"]= $this->Usuario_model->get_usuarios();
            $output["numero_comprobante"]=$this->Stock_productos_model->get_proximo_numero_comprobante();
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/stock_de_productos/agregar_movimiento",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    // FIN MODULO STOCK DE PRODUCTOS
    
    // COMIENZO MODULO DE CLIENTES
    public function registro_de_clientes()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(2);
        
        if($permiso)
        {
            $this->load->model("Registro_de_clientes_model");
            $this->load->model("Localidades_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            
            $output["listado_clientes"]= $this->Registro_de_clientes_model->get_clientes();
            $output["controller_usuario"]=$this->controller_usuario;
            $output["lista_estados_cliente"]=$this->Registro_de_clientes_model->get_estados_clientes();
            $output["lista_tipos_inscripciones"]=$this->Registro_de_clientes_model->get_tipo_inscripciones();
            $output["listado_localidades"]=$this->Localidades_model->get_localidades();
            $output["listado_de_descuentos"]=$this->Registro_de_clientes_model->get_descuentos();
            $this->load->view("back/modulos/registro_de_clientes/abm_clientes",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function imprimir_listado_clientes()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(2);
        
        if($permiso)
        {
            $this->load->model("Registro_de_clientes_model");
            $listado_clientes= $this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            
            
            $output["listado_clientes"]=$listado_clientes;
            $this->load->view("back/modulos/registro_de_clientes/imprimir_listado_clientes",$output);
        }
    }
    
    public function generar_excel_clientes()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(2);
        
        if($permiso)
        {
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Lista-de-Clientes.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $this->load->model("Registro_de_clientes_model");
            $listado_clientes= $this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            
            
            $html=
           "<table>
                <tr>
                    <td><h2>Listado de clientes</h2></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
            <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th>CUIL-DNI-CUIT</th>
                                <th>RAZON SOCIAL</th>
                                <th>LOCALIDAD</th>
                                <th>TELEFONO</th>
                                <th>TIPO INSCRIPCION</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                    <tbody>";
            foreach($listado_clientes as $value)
            {
                $html.=               
                    "<tr>
                        <td>".$value["dni_cuit_cuil"]."</td>
                        <td>".$value["razon_social"]."</td>
                        <td>".$value["desc_localidad"]."</td>
                        <td>".$value["telefono"]."</td>
                        <td>".$value["desc_inscripcion"]."</td>
                        <td>".$value["desc_estado"]."</td>   
                    </tr>";

            }
                $html.= "</tbody>
        </table>";
            
            
            echo $html;
        }
    }
    
    // FIN MODULO DE CLIENTES
    
    
    // COMIENZO MODULO REGISTRO DE PEDIDOS
    
    public function registro_de_pedidos()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(4);
        
        if($permiso)
        {
            $this->load->model("Registro_de_pedidos_model");
            $this->load->model("Registro_de_clientes_model");
            
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            
            $desde_consultar=null;
            $hasta_consultar=null;
            $cliente_consultar=0;
            $estado_consultar="todos";
            
            $output["listado_pedidos"]=null;
            
            if($this->input->post())
            {
                $desde_consultar=$this->input->post("desde_consultar");
                $hasta_consultar=$this->input->post("hasta_consultar");
                $cliente_consultar=$this->input->post("cliente_consultar");
                $estado_consultar=$this->input->post("estado_consultar");
                $output["listado_pedidos"]=$this->Registro_de_pedidos_model->get_listado_pedidos_consulta($desde_consultar,$hasta_consultar,$cliente_consultar,$estado_consultar);
            }
            else
            {
                $desde_consultar=$this->Registro_de_pedidos_model->get_fecha_min();
                $hasta_consultar=$this->Registro_de_pedidos_model->get_fecha_max();
                $output["listado_pedidos"]=$this->Registro_de_pedidos_model->get_listado_pedidos();
            }
            
            $output["desde_consultar"]=$desde_consultar;
            $output["hasta_consultar"]=$hasta_consultar;
            $output["cliente_consultar"]=$cliente_consultar;
            $output["estado_consultar"]=$estado_consultar;
            
            $output["listado_clientes"]=$this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            
            $output["controller_usuario"]=$this->controller_usuario;
            $output["lista_clientes"]=$this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            $this->load->view("back/modulos/registro_de_pedidos/abm_pedidos",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    function exportar_pedidos_excel()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(4);
        
        if($permiso)
        {
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Lista-de-Pedidos.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $desde_consultar=$this->input->post("desde_consultar");
            $hasta_consultar=$this->input->post("hasta_consultar");
            $cliente_consultar=$this->input->post("cliente_consultar");
            $estado_consultar=$this->input->post("estado_consultar");
            
            $this->load->model("Registro_de_pedidos_model");
            $listado_pedidos=$this->Registro_de_pedidos_model->get_listado_pedidos_consulta($desde_consultar,$hasta_consultar,$cliente_consultar,$estado_consultar);

            $html=
            "
                <table>
                    <tr>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                    </tr>
                    <tr>
                        <td>".$desde_consultar."</td>
                        <td>".$hasta_consultar."</td>
                        <td>".$cliente_consultar."</td>
                        <td>".$estado_consultar."</td>
                    </tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>F. Entrega</th>
                            <th>Cliente</th>
                            <th>Cuit-Dni-cuil cliente</th>
                            <th>Desc. gral</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach($listado_pedidos as $value)
                    {

                        $html.= 
                       "<tr>
                            <td>".$value["fecha"]."</td>
                            <td>".$value["fecha_entrega"]."</td>
                            <td>".$value["nombre"]." ".$value["apellido"]."</td>
                            <td>".$value["dni_cuit_cuil"]."</td>
                            <td>".$value["descuento_gral"]."%</td>
                            <td>".$value["estado"]."</td> 
                        </tr>";
                    }
            
            $html.="</tbody>
                </table>";
            
            echo $html;
        }
    }
    
    public function registro_de_pedidos_agregar()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(4);
        
        if($permiso)
        {
            $this->load->model("Registro_de_pedidos_model");
            $this->load->model("Registro_de_clientes_model");
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            $output["listado_pedidos"]=$this->Registro_de_pedidos_model->get_listado_pedidos();
            $output["controller_usuario"]=$this->controller_usuario;
            $output["lista_clientes"]=$this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            $output["listado_productos"]= $this->Stock_productos_model->get_listado_productos();
            $this->load->view("back/modulos/registro_de_pedidos/agregar_pedido",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function registro_de_pedidos_editar($numero_pedido = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(4);
        
        if($permiso && $numero_pedido != null)
        {
            $this->load->model("Registro_de_pedidos_model");
            $this->load->model("Registro_de_clientes_model");
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            $output["pedido"]=$this->Registro_de_pedidos_model->get_pedido($numero_pedido);
            $output["detalle_pedido"]=$this->Registro_de_pedidos_model->get_detalle_pedido($numero_pedido);
            $output["lista_clientes"]=$this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            $output["numero_pedido"]=$numero_pedido;
            $output["listado_productos"]= $this->Stock_productos_model->get_listado_productos();
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/registro_de_pedidos/editar_pedido",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function imprimir_pedido($numero_pedido = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(4);
        
        if($permiso && $numero_pedido != null)
        {
            $this->load->model("Registro_de_pedidos_model");
            $this->load->model("Configuracion_empresa_model");
            $this->load->model("Registro_de_clientes_model");
            
            $output["pedido"]=$pedido= $this->Registro_de_pedidos_model->get_pedido($numero_pedido);
            $output["detalle_pedido"]=$this->Registro_de_pedidos_model->get_detalle_pedido($numero_pedido);
            $output["cliente"]=$this->Registro_de_clientes_model->get_cliente($pedido["cliente"]);
                    
            $output["logo"]=$this->Configuracion_empresa_model->get_configuracion(3);
            $output["tipo_de_inscripcion"]=$this->Configuracion_empresa_model->get_configuracion(4);
            $output["cuit"]=$this->Configuracion_empresa_model->get_configuracion(1);
            $output["ingresos_brutos"]=$this->Configuracion_empresa_model->get_configuracion(2);
            $output["inicio_actividad"]=$this->Configuracion_empresa_model->get_configuracion(5);
            
            $this->load->view("back/modulos/registro_de_pedidos/imprimir-pedido",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    // FIN MODULO REGISTRO DE PEDIDOS
    
    // COMIENDO MODULO FACTURACION
    public function facturacion()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(5);
        
        if($permiso)
        {
            $this->load->model("Registro_de_clientes_model");
            $this->load->model("Localidades_model");
            $this->load->model("Facturacion_model");
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            $output["controller_usuario"]=$this->controller_usuario;
            $output["lista_estados_cliente"]=$this->Registro_de_clientes_model->get_estados_clientes();
            $output["lista_tipos_inscripciones"]=$this->Registro_de_clientes_model->get_tipo_inscripciones();
            $output["listado_localidades"]=$this->Localidades_model->get_localidades();
            $output["listado_de_descuentos"]=$this->Registro_de_clientes_model->get_descuentos();
            $output["listado_clientes"]=$this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            $output["condiciones_de_venta"]=$this->Facturacion_model->get_condiciones_de_venta();
            $output["puntos_de_venta"]=$this->Facturacion_model->get_puntos_de_venta();
            $output["tipos_factura"]=$this->Facturacion_model->get_tipos_factura();
            $output["numero_proximo"]=$this->Facturacion_model->get_proximo_numero_factura();
            $output["controller_usuario"]=$this->controller_usuario;
            
            $this->load->view("back/modulos/facturacion/facturacion",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function imprimir_factura($numero = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(5);
        $permiso2= $this->funciones_generales->dar_permiso_a_modulo(6);
        $numero_factura = null;
        
        if($this->input->post())
        {
            $numero_factura =(int)$this->input->post("numero");
        }
        else
        {
            $numero_factura = $numero;
        }
        
        
        if($permiso || $permiso2 && $numero_factura != null && $numero != 0)
        {
            $this->load->model("Facturacion_model");
            $this->load->model("Configuracion_empresa_model");
            
            $output["logo"]=$this->Configuracion_empresa_model->get_configuracion(3);
            $output["factura"]=$this->Facturacion_model->get_factura($numero_factura);
            $output["detalle_factura"]=$this->Facturacion_model->get_detalle_factura($numero_factura);
            $output["tipo_de_inscripcion"]=$this->Configuracion_empresa_model->get_configuracion(4);
            $output["cuit"]=$this->Configuracion_empresa_model->get_configuracion(1);
            $output["ingresos_brutos"]=$this->Configuracion_empresa_model->get_configuracion(2);
            $output["inicio_actividad"]=$this->Configuracion_empresa_model->get_configuracion(5);
            
            
            $this->load->view("back/modulos/facturacion/imprimir-factura",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function caja($fecha = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(5);
        
        if($permiso)
        {
            $this->load->helper("form");
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $output["controller_usuario"]=$this->controller_usuario;
            
            $this->load->model("Caja_model");
            $this->load->model("Movimiento_caja_model");

            if($fecha == null)
            {
                $fecha = "".Date("Y-m-d");
            }

            $caja = $this->Caja_model->obtener_caja($fecha);
            
            if(!$caja)
            {
                $this->Caja_model->abrir_caja();
                $caja = $this->Caja_model->obtener_caja($fecha);
            }
            
            $entradas = $caja["entradas"];
            $salidas = $caja["salidas"];
            $total = $caja["saldo"];

            $listado_entradas = $this->Caja_model->obtener_listado_entradas($fecha);
            $listado_salidas = $this->Caja_model->obtener_listado_salidas($fecha);

            
            $output["entradas"]=$entradas;
            $output["salidas"]=$salidas;
            $output["total"]=$total;
            $output["listado_entradas"]=$listado_entradas;
            $output["listado_salidas"]=$listado_salidas;
            $output["fecha"]=$fecha;
                        
            
            $this->load->view('back/modulos/facturacion/caja', $output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function registrar_movimiento()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(5);
        
        if($permiso)
        {
            $this->load->model("Caja_model");
            $numero= $this->Caja_model->obtener_ultimo_movimiento();
            $fecha=date('Y-m-d');
            $concepto= $pedido= $this->input->post("concepto");
            $importe= $this->input->post("importe");
            $detalle= $this->input->post("detalle");
            $empleado=$this->session->userdata('id');

            $caja = $this->Caja_model->obtener_caja(Date("Y-m-d"));
            
            if($caja)
            {
                $entradas = $caja["entradas"];
                $salidas = $caja["salidas"];
                $saldo = $caja["saldo"];

                if($concepto == "e")
                {
                   $entradas = (float)$entradas + (float)$importe;
                   $saldo = (float)$saldo + (float)$importe;
                }
                else
                {
                   $salidas = (float)$salidas + (float)$importe;
                   $saldo = (float)$saldo - (float)$importe;
                }

                $this->Caja_model->actualizar_caja($entradas,$salidas,$saldo,"a");
            }
            else 
            {
                $this->Caja_model->abrir_caja();
                $caja = $this->Caja_model->obtener_caja(Date("Y-m-d"));

                $entradas = $caja["entradas"];
                $salidas = $caja["salidas"];
                $saldo = $caja["saldo"];

                if($concepto == "e")
                {
                   $entradas = (float)$entradas + (float)$importe;
                   $saldo = (float)$saldo + (float)$importe;
                }
                else
                {
                   $salidas = (float)$salidas + (float)$importe;
                   $saldo = (float)$saldo - (float)$importe;
                }

                $this->Caja_model->actualizar_caja($entradas,$salidas,$saldo,"a");
            }

            $this->Caja_model->registrar_movimiento_caja($numero, $fecha, $concepto, $importe, $detalle, $empleado,7,$concepto);
            redirect($this->controller_usuario."/caja");
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function imprimir_datos_movimiento_caja($comprobante)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(5);
        
        if($permiso)
        {
            $output["css"]="";
            $output["js"]="";
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $output["controller_usuario"]=$this->controller_usuario;

            $this->load->model("Caja_model");

            $output["comprobante"] = $this->Caja_model->getDatosDeMovimiento($comprobante);
            $this->load->view("back/modulos/facturacion/imprimir_datos_movimiento_caja",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function ver_factura($numero = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(5);
        $permiso2= $this->funciones_generales->dar_permiso_a_modulo(6);
        
        if($permiso || $permiso2 && $numero != null)
        {
            $this->load->model("Registro_de_clientes_model");
            $this->load->model("Localidades_model");
            
            $this->load->model("Facturacion_model");
            $this->load->model("Configuracion_empresa_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["controller_usuario"]=$this->controller_usuario;
            $output["factura"]=$this->Facturacion_model->get_factura($numero);
            $output["detalle_factura"]=$this->Facturacion_model->get_detalle_factura($numero);
            $output["tipo_de_inscripcion"]=$this->Configuracion_empresa_model->get_configuracion(4);
            $output["cuit"]=$this->Configuracion_empresa_model->get_configuracion(1);
            $output["ingresos_brutos"]=$this->Configuracion_empresa_model->get_configuracion(2);
            $output["inicio_actividad"]=$this->Configuracion_empresa_model->get_configuracion(5);
            
            $this->load->view("back/modulos/facturacion/ver_factura",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    // FIN MODULO FACTURACION
    
    // COMIENZO MODULO ESTADOS DE CUENTAS
    
    public function estados_de_cuentas()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(6);
        
        if($permiso)
        {
            $this->load->model("Registro_de_clientes_model");
            $this->load->model("Localidades_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datetimepicker();
            $output["js"].=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            $desde = null;
            $hasta = null;
            $tipo = "todos";
            $cliente_consultar="todos";
            
            if($this->input->post())
            {
                $desde = $this->input->post("desde_consultar");
                $hasta = $this->input->post("hasta_consultar");
                $tipo = $this->input->post("tipo_consultar");
                $cliente_consultar = $this->input->post("cliente_consultar");
            }
            else
            {
                $desde = $this->Registro_de_clientes_model->get_fecha_min_cuenta_clientes();
                $hasta = $this->Registro_de_clientes_model->get_fecha_max_cuenta_clientes();
            }
            
            $output["desde_consultar"]=$desde;
            $output["hasta_consultar"]=$hasta;
            $output["tipo_consultar"]=$tipo;
            $output["cliente_consultar"]=$cliente_consultar;
            // LOGIC
            
            $output["listado_clientes"]=$this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            $output["listado_cuentas_clientes"]= $this->Registro_de_clientes_model->get_cuentas_clientes_con_consulta($desde,$hasta,$tipo,$cliente_consultar);
            $output["controller_usuario"]=$this->controller_usuario;
            $output["lista_estados_cliente"]=$this->Registro_de_clientes_model->get_estados_clientes();
            $output["lista_tipos_inscripciones"]=$this->Registro_de_clientes_model->get_tipo_inscripciones();
            $output["listado_localidades"]=$this->Localidades_model->get_localidades();
            $output["listado_de_descuentos"]=$this->Registro_de_clientes_model->get_descuentos();
            $this->load->view("back/modulos/registro_de_clientes/cuentas_clientes",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function imprimir_cuentas_clientes()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(6);
        
        if($permiso && $this->input->post())
        {
            $this->load->model("Registro_de_clientes_model");
            
            $desde=$this->input->post("desde_imprimir");
            $hasta=$this->input->post("hasta_imprimir");
            $tipo=$this->input->post("tipo_imprimir");
            $cliente_consultar=$this->input->post("cliente_imprimir");
                    
                    
            $listado_cuentas_clientes= $this->Registro_de_clientes_model->get_cuentas_clientes_con_consulta($desde,$hasta,$tipo,$cliente_consultar);
            
            
            
            $output["listado_cuentas_clientes"]=$listado_cuentas_clientes;
            $this->load->view("back/modulos/registro_de_clientes/impresor-cuentas-clientes",$output);
        }
    }
    
    public function imprimir_cuenta_cliente($id = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(6);
        
        if($permiso && $id != null)
        {
            $this->load->model("Registro_de_clientes_model");
            
            $cuenta_cliente= $this->Registro_de_clientes_model->get_cuenta_cliente($id);
            
            $output["cuenta_cliente"]=$cuenta_cliente;
            $this->load->view("back/modulos/registro_de_clientes/imprimir_cuenta_cliente",$output);
        }
    }
    
    public function generar_excel_cuentas_clientes()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(6);
        
        if($permiso && $this->input->post())
        {
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Lista-de-Cuentas-Clientes.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $this->load->model("Registro_de_clientes_model");
            
            $desde=$this->input->post("desde_imprimir");
            $hasta=$this->input->post("hasta_imprimir");
            $tipo=$this->input->post("tipo_imprimir");
            $cliente_consultar=$this->input->post("cliente_imprimir");
                    
                    
            $listado_cuentas_clientes= $this->Registro_de_clientes_model->get_cuentas_clientes_con_consulta($desde,$hasta,$tipo,$cliente_consultar);
            
            $html=
           "<table>
                <tr>
                    <th>Fecha desde</th>
                    <th>Fecha Hasta</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                </tr>
                <tr>
                    <td>$desde</td>
                    <td>$hasta</td>
                    <td>$tipo</td>
                    <td>$cliente_consultar</td>
                </tr>
            </table>
            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                </tr>
            </table>
            ";
            
            $html .=
            "<table>
                    <thead>
                      <tr>
                        <th>FECHA</th>
                        <th>CLIENTE</th>
                        <th>ENTRADA</th>
                        <th>SALIDA</th>
                      </tr>
                    </thead>
                    <tbody>";
            
            foreach($listado_cuentas_clientes as $value)
            {
                $html.=
                    "<tr>
                        <td>".$value["fecha"]."</td>
                        <td>".$value["cliente_dni_cuit_cuil"]." - ".$value["cliente_nombre"]." ".$value["cliente_apellido"]."</td>";
                        
                        if((float)$value["importe_recibo"] != 0)
                        {
                            $html.= "<td>".$value["importe_recibo"]."</td>";
                            $html.= "<td>0</td>";
                        }
                        else if((float)$value["importe_factura"] != 0)
                        {
                            $html.= "<td>0</td>";
                            $html.= "<td>".$value["importe_factura"]."</td>";
                        }
                        else
                        {
                            $html.= "<td>0</td>";
                            $html.= "<td>0</td>";
                        }
                        
                        
                    $html.="</tr>";
            }
       $html.= "</tbody>
        </table>";
            
            echo $html;
        }
    }
    
    // FIN MODULO ESTADOS DE CUENTAS
   
    // COMIENZO MODULO COMPRAS
    
    public function abm_proveedores()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(7);
        
        if($permiso)
        {
            $this->load->model("Compras_model");
            $this->load->model("Localidades_model");
            $this->load->model("Registro_de_clientes_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            
            $output["listado_proveedores"]=$this->Compras_model->get_proveedores();
            
            $output["controller_usuario"]=$this->controller_usuario;
            $output["listado_localidades"]=$this->Localidades_model->get_localidades();
            $output["lista_tipos_inscripciones"]=$this->Registro_de_clientes_model->get_tipo_inscripciones();
           
            $this->load->view("back/modulos/compras/abm_proveedores",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function factura_compra()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(7);
        
        if($permiso)
        {
            $this->load->model("Registro_de_clientes_model");
            $this->load->model("Localidades_model");
            $this->load->model("Facturacion_model");
            $this->load->model("Stock_productos_model");
            
            
            $this->load->model("Compras_model");
            
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            $output["controller_usuario"]=$this->controller_usuario;
            
            $output["listado_proveedores"]=$this->Compras_model->get_proveedores();
            
            $output["lista_estados_cliente"]=$this->Registro_de_clientes_model->get_estados_clientes();
            $output["lista_tipos_inscripciones"]=$this->Registro_de_clientes_model->get_tipo_inscripciones();
            $output["listado_localidades"]=$this->Localidades_model->get_localidades();
            $output["listado_de_descuentos"]=$this->Registro_de_clientes_model->get_descuentos();
            $output["condiciones_de_venta"]=$this->Facturacion_model->get_condiciones_de_venta();
            $output["puntos_de_venta"]=$this->Facturacion_model->get_puntos_de_venta();
            $output["tipos_factura"]=$this->Facturacion_model->get_tipos_factura();
            $output["numero_proximo"]=$this->Facturacion_model->get_proximo_numero_factura();
            $output["controller_usuario"]=$this->controller_usuario;
            
            $output["lista_productos"]=$this->Stock_productos_model->get_listado_productos();
            
            $this->load->view("back/modulos/compras/factura_compra",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function imprimir_factura_compra()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(7);
        $numero_factura = (int)$this->input->post("numero");
        
        if($permiso && $numero_factura != 0)
        {
            $this->load->model("Facturacion_model");
            $this->load->model("Configuracion_empresa_model");
            
            $output["logo"]=$this->Configuracion_empresa_model->get_configuracion(3);
            $output["factura"]=$this->Facturacion_model->get_factura_compra($numero_factura);
            $output["detalle_factura"]=$this->Facturacion_model->get_detalle_factura_compra($numero_factura);
            $output["tipo_de_inscripcion"]=$this->Configuracion_empresa_model->get_configuracion(4);
            $output["cuit"]=$this->Configuracion_empresa_model->get_configuracion(1);
            $output["ingresos_brutos"]=$this->Configuracion_empresa_model->get_configuracion(2);
            $output["inicio_actividad"]=$this->Configuracion_empresa_model->get_configuracion(5);
            
            
            $this->load->view("back/modulos/compras/imprimir-factura",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    // FIN MODULO COMPRAS
    
    // COMIENZO MODULO REPORTES
    
    public function reporte_de_pedidos()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $this->load->model("Reportes_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            
            $output["listado_reporte_compras"]=$this->Reportes_model->lista_reporte_de_pedidos();
            
            $output["controller_usuario"]=$this->controller_usuario;
            
            $this->load->view("back/modulos/reportes/reporte_de_pedidos",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function generar_reporte_de_pedido_excel()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Reporte-de-Compras.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            
            $this->load->model("Reportes_model");
            $listado_reporte_pedidos=$this->Reportes_model->lista_reporte_de_pedidos();
            
            $html=
            "
             <table>
                    <thead>
                      <tr>
                        <th>CODIGO</th>
                        <th>PRODUCTO</th>
                        <th>COSTO</th>
                        <th>STOCK</th>
                        <th>TOTAL PEDIDOS</th>
                        <th>TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>";
            $total_pesos= 0;
            foreach($listado_reporte_pedidos as $value)
            {
                $total_registro = (float)$value["cantidad_a_pedir"] * (float)$value["costo"];
                $total_pesos+= $total_registro;
                $html.= 
                    "<tr>
                        <td>".$value["cod_producto"]."</td>
                        <td>".$value["descripcion"]."</td>
                        <td>".$value["costo"]."</td>
                        <td>".$value["stock"]."</td>
                        <td>".$value["cantidad_a_pedir"]."</td>
                        <td>$".$total_registro."</td>
                    </tr>";
            }
        $html.= "<tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Total:".$total_pesos."</b></td>
                    </tfoot></tbody>
                  </table>";
            
            echo $html;
        }
    }
    
    public function reporte_de_venta()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $this->load->model("Facturacion_model");
            $this->load->model("Registro_de_clientes_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $output["controller_usuario"]=$this->controller_usuario;
            $output["listado_clientes"]=$this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            $output["estados_factura"]=$this->Facturacion_model->get_estados_factura();
            
            $output["leyenda_lista"]="Lista de ventas";
            $output["hasta_consultar"]=$this->Facturacion_model->get_fecha_max();
            $output["desde_consultar"]=$this->Facturacion_model->get_fecha_min();
            $output["cliente_consultar"]="0";
            $output["estado_factura_consultar"]="0";
            
            if($this->input->post())
            {
                $output["leyenda_lista"]="Lista de ventas";
                $output["hasta_consultar"]=$this->input->post("hasta_consultar");
                $output["desde_consultar"]=$this->input->post("desde_consultar");
                $output["cliente_consultar"]=$this->input->post("cliente_consultar");
                $output["estado_factura_consultar"]=$this->input->post("estado_factura_consultar");
                
                $output["listado_facturas"]= $this->Facturacion_model->get_facturas_con_consultas($this->input->post("desde_consultar"),$this->input->post("hasta_consultar"),$this->input->post("cliente_consultar"),$this->input->post("estado_factura_consultar"));
            }
            else
            {
                $output["listado_facturas"]= $this->Facturacion_model->get_facturas_con_consultas($output["desde_consultar"],$output["hasta_consultar"],$output["cliente_consultar"],$output["estado_factura_consultar"]);
            }
            
            $this->load->view("back/modulos/reportes/reporte_de_ventas",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function reporte_de_caja()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $this->load->model("Reportes_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $output["controller_usuario"]=$this->controller_usuario;
            
            
            $desde=$this->Reportes_model->get_caja_fecha_min();
            $hasta=$this->Reportes_model->get_caja_fecha_max();
            
            if($this->input->post())
            {
                $desde = $this->input->post("desde_consultar");
                $hasta = $this->input->post("hasta_consultar");
            }
            
            $output["listado_caja"]= $this->Reportes_model->get_listado_caja($desde,$hasta);
            
            $output["desde_consultar"]= $desde;
            $output["hasta_consultar"]= $hasta;
            $this->load->view("back/modulos/reportes/reporte_de_caja",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    function exportar_reporte_caja()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $hasta=$this->input->post("hasta_imprimir");
            $desde=$this->input->post("desde_imprimir");
           
            
            
            $this->load->model("Reportes_model");
            $listado_caja= $this->Reportes_model->get_listado_caja($desde,$hasta);
            
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Reporte-de-Caja.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $html=
            "
                <table>
                    <tr>
                        <th>DESDE</th>
                        <th>HASTA</th>
                        
                    </tr>
                    <tr>
                        <td>".$desde."</td>
                        <td>".$hasta."</td>
                    </tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                </table>
                <table>
                    <thead>
                      <tr>
                        th>FECHA</th>
                        <th>ENTRADAS</th>
                        <th>SALIDAS</th>
                        <th>SALDO</th>
                        <th>ESTADO</th>
                      </tr>
                    </thead>
                    <tbody>";
            
                foreach($listado_caja as $value)
                {
                    $html.= "
                    <tr>
                        <td>".$value["fecha"]."</td>
                        <td>".$value["entradas"]."</td>
                        <td>".$value["salidas"]."</td>
                        <td>".$value["saldo"]."</td>
                        <td>".$value["estado"]."</td>
                    </tr>";
                }
                    $html.= "</tbody>
                  </table>";
            echo $html;
        }
    }
    
    function imprimir_reporte_caja()
    {
        
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $hasta=$this->input->post("hasta_imprimir");
            $desde=$this->input->post("desde_imprimir");
            
            
            $this->load->model("Facturacion_model");
            $this->load->model("Reportes_model");
            $output["listado_caja"]= $this->Reportes_model->get_listado_caja($desde,$hasta);
            
            $this->load->view("back/modulos/reportes/imprimir_reporte_caja",$output);
        }
    }
    
    function exportar_reporte_ventas()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $hasta=$this->input->post("hasta_imprimir");
            $desde=$this->input->post("desde_imprimir");
            $cliente=(int)$this->input->post("cliente_imprimir");
            $estado=(int)$this->input->post("estado_imprimir");
            
            
            $this->load->model("Facturacion_model");
            $listado_facturas= $this->Facturacion_model->get_facturas_con_consultas($desde,$hasta,$cliente,$estado);
            
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Reporte-de-Ventas.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $html=
            "
                <table>
                    <tr>
                        <th>DESDE</th>
                        <th>HASTA</th>
                        <th>CLIENTE</th>
                        <th>ESTADO</th>
                    </tr>
                    <tr>
                        <td>".$desde."</td>
                        <td>".$hasta."</td>
                        <td>".$cliente."</td>
                        <td>".$estado."</td>
                    </tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                </table>
                <table>
                    <thead>
                      <tr>
                        <th>FECHA</th>
                        <th>CLIENTE</th>
                        <th>FACTURA</th>
                        <th>TIPO</th>
                        <th>IMPORTE</th>
                        <th>ESTADO</th>
                      </tr>
                    </thead>
                    <tbody>";
            
                foreach($listado_facturas as $value)
                {
                    $html.= "<tr>
                                <td>".$value["fecha"]."</td>
                                <td>".$value["cliente_dni_cuit_cuil"]." - ".$value["cliente_nombre"]." ".$value["cliente_apellido"]."</td>
                                <td>".$value["numero"]."</td>
                                <td>".$value["desc_tipo_factura"]."</td>
                                <td>$".$value["total"]."</td>
                                <td>".$value["desc_estado"]."</td>     
                            </tr>";
                }  
                    $html.= "</tbody>
                  </table>";
            echo $html;
        }
    }
    
    function imprimir_lista_facturas()
    {
        
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $hasta=$this->input->post("hasta_imprimir");
            $desde=$this->input->post("desde_imprimir");
            $cliente=(int)$this->input->post("cliente_imprimir");
            $estado=(int)$this->input->post("estado_imprimir");
            
            
            $this->load->model("Facturacion_model");
            $output["listado_facturas"]= $this->Facturacion_model->get_facturas_con_consultas($desde,$hasta,$cliente,$estado);
            
            $this->load->view("back/modulos/reportes/impresor-facturas",$output);
        }
    }
    
    
    public function reporte_de_compras()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $this->load->model("Facturacion_model");
            $this->load->model("Registro_de_clientes_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["css"].=$this->adminlte->get_css_datetimepicker();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["js"].=$this->adminlte->get_js_datetimepicker();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $output["controller_usuario"]=$this->controller_usuario;
            $output["estados_factura"]=$this->Facturacion_model->get_estados_factura();
            
            $output["leyenda_lista"]="Lista de compras";
            $output["hasta_consultar"]=$this->Facturacion_model->get_fecha_max_compra();
            $output["desde_consultar"]=$this->Facturacion_model->get_fecha_min_compra();
            $output["estado_factura_consultar"]="0";
            
            if($this->input->post())
            {
                $output["leyenda_lista"]="Lista de compras";
                $output["hasta_consultar"]=$this->input->post("hasta_consultar");
                $output["desde_consultar"]=$this->input->post("desde_consultar");
                $output["estado_factura_consultar"]=$this->input->post("estado_factura_consultar");
                
                $output["listado_facturas"]= $this->Facturacion_model->get_facturas_compras_con_consultas($this->input->post("desde_consultar"),$this->input->post("hasta_consultar"),$this->input->post("estado_factura_consultar"));
            }
            else
            {
                $output["listado_facturas"]= $this->Facturacion_model->get_facturas_compras_con_consultas($output["desde_consultar"],$output["hasta_consultar"],$output["estado_factura_consultar"]);
            }
            
            $this->load->view("back/modulos/reportes/reporte_de_compras",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function ver_factura_compra($numero_factura = null)
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(7);
        
        
        if($permiso && $numero_factura != null)
        {
            $this->load->model("Facturacion_model");
            $this->load->model("Configuracion_empresa_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            // LOGIC
            $output["controller_usuario"]=$this->controller_usuario;
            $output["factura"]=$this->Facturacion_model->get_factura_compra($numero_factura);
            $output["detalle_factura"]=$this->Facturacion_model->get_detalle_factura_compra($numero_factura);
            $output["tipo_de_inscripcion"]=$this->Configuracion_empresa_model->get_configuracion(4);
            $output["cuit"]=$this->Configuracion_empresa_model->get_configuracion(1);
            $output["ingresos_brutos"]=$this->Configuracion_empresa_model->get_configuracion(2);
            $output["inicio_actividad"]=$this->Configuracion_empresa_model->get_configuracion(5);
            
            $this->load->view("back/modulos/reportes/ver_factura_compra",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    function exportar_reporte_compras()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $hasta=$this->input->post("hasta_imprimir");
            $desde=$this->input->post("desde_imprimir");
            $estado=(int)$this->input->post("estado_imprimir");
            
            
            $this->load->model("Facturacion_model");
            $listado_facturas= $this->Facturacion_model->get_facturas_compras_con_consultas($desde,$hasta,$estado);
           
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Reporte-de-Compras.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $html=
            "
                <table>
                    <tr>
                        <th>DESDE</th>
                        <th>HASTA</th>
                        <th>ESTADO</th>
                    </tr>
                    <tr>
                        <td>".$desde."</td>
                        <td>".$hasta."</td>
                        <td>".$estado."</td>
                    </tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                </table>
                <table>
                    <thead>
                      <tr>
                        <th>FECHA</th>
                        <th>FACTURA</th>
                        <th>TIPO</th>
                        <th>IMPORTE</th>
                        <th>ESTADO</th>
                      </tr>
                    </thead>
                    <tbody>";
            
                foreach($listado_facturas as $value)
                {
                    $html.= "<tr>
                                <td>".$value["fecha"]."</td>
                                <td>".$value["numero"]."</td>
                                <td>".$value["desc_tipo_factura"]."</td>
                                <td>$".$value["total"]."</td>
                                <td>".$value["desc_estado"]."</td>     
                            </tr>";
                }  
                    $html.= "</tbody>
                  </table>";
            echo $html;
        }
    }
    
    function imprimir_lista_facturas_de_compra()
    {
        
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $hasta=$this->input->post("hasta_imprimir");
            $desde=$this->input->post("desde_imprimir");
            $estado=(int)$this->input->post("estado_imprimir");
            
            
            $this->load->model("Facturacion_model");
            $output["listado_facturas"]= $this->Facturacion_model->get_facturas_compras_con_consultas($desde,$hasta,$estado);
           
            $this->load->view("back/modulos/reportes/impresor-facturas-compras",$output);
        }
    }
    
    public function reporte_de_productos()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            $output["controller_usuario"]=$this->controller_usuario;
            // LOGIC
            
            $output["listado_productos"]= $this->Stock_productos_model->get_listado_reporte_productos();
            $this->load->view("back/modulos/reportes/reporte_productos",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    
    
    function exportar_reporte_productos_excel()
    {
        $permiso= $this->funciones_generales->dar_permiso_a_modulo(8);
        
        if($permiso)
        {
            $this->load->model("Stock_productos_model");
            $listado_productos= $this->Stock_productos_model->get_listado_reporte_productos();
            
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: filename=Reporte-de-Productos.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            $html=
            "
                <table>
                    <thead>
                      <tr>
                        <th>CODIGO PRODUCTO</th>
                        <th>DESCRIPCION</th>
                        <th>RUBRO</th>
                        <th>SUBRUBRO</th>
                        <th>LISTA 1</th>
                        <th>LISTA 2</th>
                        <th>LISTA 3</th>
                        <th>LISTA 4</th>
                      </tr>
                    </thead>
                    <tbody>";
            
                foreach($listado_productos as $value)
                {
                    $html.= "
                            <tr>
                                <td>".$value["codigo_producto"]."</td>
                                <td>".$value["descripcion"]."</td>
                                <td>$".$value["desc_rubro"]."</td>
                                <td>$".$value["desc_subrubro"]."</td>
                                <td>$".$value["lista_1"]."</td>
                                <td>$".$value["lista_2"]."</td>
                                <td>$".$value["lista_3"]."</td>
                                 <td>".$value["lista_4"]."</td>
                            </tr>";
                            }
                    $html.= "</tbody>
                  </table>";
            echo $html;
        }
    }
    
    // FIN MODULO REPORTES
    
    
    public function abm_configuracion_empresa()
    {
        $permiso= $this->funciones_generales->dar_permiso(1);
        
        if($permiso)
        {
            $this->load->model("Configuracion_empresa_model");
            
            $output["css"]=$this->adminlte->get_css_datatables();
            $output["css"].=$this->adminlte->get_css_select2();
            $output["js"]=$this->adminlte->get_js_datatables();
            $output["js"].=$this->adminlte->get_js_select2();
            $output["menu"]=$this->adminlte->getMenu();
            $output["header"]=$this->adminlte->getHeader();
            $output["menu_configuracion"]=$this->adminlte->getMenuConfiguracion();
            $output["footer"]=$this->adminlte->getFooter();
            
            $output["configuraciones"]= $this->Configuracion_empresa_model->get_configuraciones();
            
            $this->load->view("back/modulos/configuracion_empresa/abm_configuraciones",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    public function generar_excel()
    {
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=Exportacion.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $_POST['datos_a_enviar'];
    }
}

