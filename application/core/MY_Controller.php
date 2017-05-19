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
            $output["unidades_medidas"]=$this->Stock_productos_model->get_unidades_medidas();
            $this->load->view("back/modulos/stock_de_productos/listado",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
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
            
            $output["listado_clientes"]= $this->Registro_de_clientes_model->get_clientes_no_suspendidos();
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
            
            $contenido= 
            "<table class='table table-striped'>
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
            <tbody>
            ";
            
            
            foreach($listado_clientes as $value)
            {
                
                $contenido.=                
                "<tr>
                    <td>".$value["dni_cuit_cuil"]."</td>
                    <td>".$value["razon_social"]."</td>
                    <td>".$value["desc_localidad"]."</td>
                    <td>".$value["telefono"]."</td>
                    <td>".$value["desc_inscripcion"]."</td>
                    <td>".$value["desc_estado"]."</td>   
                </tr>";
                            
            }
            
            $contenido.= 
            "</tbody>
            </table>";
            
            $output["contenido"]=$contenido;
            $this->load->view("back/impresor/impresor",$output);
        }
    }
    
    public function generar_excel_clientes()
    {
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=ficheroExcel.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $_POST['datos_a_enviar'];
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
            
            $output["listado_pedidos"]=$this->Registro_de_pedidos_model->get_listado_pedidos();
            $output["controller_usuario"]=$this->controller_usuario;
            $output["lista_clientes"]=$this->Registro_de_clientes_model->get_clientes_no_suspendidos();
            $this->load->view("back/modulos/registro_de_pedidos/abm_pedidos",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
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
            $output["listado_productos_faltantes"]= $this->Registro_de_pedidos_model->get_listado_productos_faltantes($numero_pedido);
            $output["controller_usuario"]=$this->controller_usuario;
            $this->load->view("back/modulos/registro_de_pedidos/editar_pedido",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    // FIN MODULO REGISTRO DE PEDIDOS
    
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
            $output["listado_productos"]=$this->Stock_productos_model->get_listado_productos();
            
            $this->load->view("back/modulos/facturacion/facturacion",$output);
        }
        else
        {
            redirect($this->funciones_generales->redireccionar_usuario());
        }
    }
    
    
    
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
}

