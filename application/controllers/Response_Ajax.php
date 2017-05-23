<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Response_Ajax extends CI_Controller
{
    public $function_general;
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model("Usuario_model");
        $this->load->library("Funciones_generales");
        $this->function_general= new Funciones_generales();
    }
    
    public function agregar_producto()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $descripcion= $this->input->post("descripcion");
            $stock= $this->input->post("stock");
            $punto_critico= $this->input->post("punto_critico");
            $rubro= $this->input->post("rubro");
            $unidad_medida= $this->input->post("unidad_medida");
            $costo= (float)$this->input->post("costo");
            
            $margen_1= (float)$this->input->post("margen_1_agregar");
            $margen_2= (float)$this->input->post("margen_2_agregar");
            $margen_3= (float)$this->input->post("margen_3_agregar");
            $margen_4= (float)$this->input->post("margen_4_agregar");
               
            $lista_1 = $margen_1*$costo;
            $lista_2 = $margen_2*$costo;
            $lista_3 = $margen_3*$costo;
            $lista_4 = $margen_4*$costo;
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->agregar_producto($descripcion,$stock,$punto_critico,$rubro,$unidad_medida,$costo,$margen_1,$lista_1,$margen_2,$lista_2,$margen_3,$lista_3,$margen_4,$lista_4);
        
            echo json_encode($respuesta);
        }
    }
    
    public function editar_producto()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $id_producto= $this->input->post("id_producto");
            $descripcion= $this->input->post("descripcion");
            $stock= $this->input->post("stock");
            $punto_critico= $this->input->post("punto_critico");
            $rubro= (int)$this->input->post("rubro");
            $unidad_medida= (int)$this->input->post("unidad_medida");
            $rubro2= (int)$this->input->post("rubro2");
            $unidad_medida2= (int)$this->input->post("unidad_medida2");
            $costo= (float)$this->input->post("costo");
            
            $margen_1= (float)$this->input->post("margen_1");
            $margen_2= (float)$this->input->post("margen_2");
            $margen_3= (float)$this->input->post("margen_3");
            $margen_4= (float)$this->input->post("margen_4");
               
            $lista_1 = $margen_1*$costo;
            $lista_2 = $margen_2*$costo;
            $lista_3 = $margen_3*$costo;
            $lista_4 = $margen_4*$costo;
            
            if($rubro2 != 0 && $rubro2!=$rubro)
            {
                $rubro=$rubro2;
            }
            
            if($unidad_medida2 != 0 && $unidad_medida2!=$unidad_medida)
            {
                $unidad_medida=$unidad_medida2;
            }
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->editar_producto($id_producto,$descripcion,$stock,$punto_critico,$rubro,$unidad_medida,$costo,$margen_1,$lista_1,$margen_2,$lista_2,$margen_3,$lista_3,$margen_4,$lista_4);
        
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_precio_vigente()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $id_producto= $this->input->post("id_producto");
            $precio=$this->input->post("precio");
            $fecha_vigente_desde=$this->input->post("fecha_vigente_desde");
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->agregar_precio_vigente($id_producto,$precio,$fecha_vigente_desde);
        
            echo json_encode($respuesta);
        }
    }
    
    public function editar_precio_vigente()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $id= $this->input->post("id");
            $precio= $this->input->post("precio");
            $fecha_vigente_desde= $this->input->post("fecha_vigente_desde");
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->editar_precio_vigente($id,$precio,$fecha_vigente_desde);
        
            echo json_encode($respuesta);
        }
    }
    
    public function eliminar_precio_vigente()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $id= $this->input->post("id");
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->eliminar_precio_vigente($id);
        
            echo json_encode($respuesta);
        }
    }
    
    public function eliminar_ubicacion_de_producto()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $id= $this->input->post("id");
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->eliminar_ubicacion_de_producto($id);
        
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_ubicacion_a_producto()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $id_producto= $this->input->post("id_producto");
            $id_ubicacion= $this->input->post("id_ubicacion");
                    
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->agregar_ubicacion_a_producto($id_producto,$id_ubicacion);
        
            echo json_encode($respuesta);
        }
    }
    
    public function editar_rubro()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $id_rubro= $this->input->post("id_rubro");
            $descripcion= $this->input->post("descripcion");
                    
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->editar_rubro($id_rubro,$descripcion);
        
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_rubro()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            
            $descripcion= $this->input->post("descripcion");
                    
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->agregar_rubro($descripcion);
        
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_ubicacion()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            
            $descripcion= $this->input->post("descripcion");
                    
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->agregar_ubicacion($descripcion);
        
            echo json_encode($respuesta);
        }
    }
    
    public function editar_ubicacion()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            
            $descripcion= $this->input->post("descripcion");
            $id_ubicacion= $this->input->post("id_ubicacion");
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->editar_ubicacion($id_ubicacion,$descripcion);
        
            echo json_encode($respuesta);
        }
    }
    
    public function editar_unidad_de_medida()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            
            $id= $this->input->post("descripcion");
            $descripcion= $this->input->post("descripcion");
            $cantidad= $this->input->post("cantidad");
            $medida= $this->input->post("unidad_de_medida");
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->editar_unidad_de_medida($id,$descripcion,$cantidad,$medida);
        
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_unidad_de_medida()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            
            $descripcion= $this->input->post("descripcion");
            $cantidad= $this->input->post("cantidad");
            $medida= $this->input->post("unidad_de_medida");
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->agregar_unidad_de_medida($descripcion,$cantidad,$medida);
        
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_movimiento_y_detalle()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(3))
        {
            $fecha = $this->input->post("fecha");
            $tipo_comprobante= $this->input->post("tipo_comprobante");
            $concepto= $this->input->post("concepto");
            $usuario= $this->session->userdata("id");
            $detalle= $this->input->post("detalle");
            
            $this->load->model("Stock_productos_model");
            $respuesta = $this->Stock_productos_model->agregar_movimiento_y_detalle($fecha,$tipo_comprobante,$concepto,$usuario,$detalle);
        
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_cliente()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(2))
        {
            $dni_cuit_cuil= $this->input->post("dni_cuit_cuil");
            $razon_social= $this->input->post("razon_social");
            $nombre= $this->input->post("nombre");
            $apellido= $this->input->post("apellido");
            $telefono= $this->input->post("telefono");
            $correo= $this->input->post("correo");
            $direccion= $this->input->post("direccion");
            $contrasenia= $this->input->post("contrasenia");
            $localidad= $this->input->post("localidad");
            $tipo_inscripcion= $this->input->post("tipo_inscripcion");
            $descuento_gral= $this->input->post("descuento_gral");
            $estado= $this->input->post("estado");
            $ingresos_brutos= $this->input->post("ingresos_brutos");
            $lista= $this->input->post("lista");
            
            $this->load->library("Md5");
            $contrasenia= Md5::cifrar($contrasenia);
            
            $this->load->model("Registro_de_clientes_model");
            $respuesta = $this->Registro_de_clientes_model->agregar_cliente($dni_cuit_cuil,$razon_social,$nombre,$apellido,$telefono,$correo,$direccion,$contrasenia,$localidad,$tipo_inscripcion,$estado,$descuento_gral,$ingresos_brutos,$lista);
            
            echo json_encode($respuesta);
        }
    }
    
    
    public function editar_cliente()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(2))
        {
            $id= $this->input->post("id");
            $dni_cuit_cuil= $this->input->post("dni_cuit_cuil");
            $razon_social= $this->input->post("razon_social");
            $nombre= $this->input->post("nombre");
            $apellido= $this->input->post("apellido");
            $telefono= $this->input->post("telefono");
            $correo= $this->input->post("correo");
            $direccion= $this->input->post("direccion");
            $contrasenia= $this->input->post("contrasenia");
            $localidad= $this->input->post("localidad");
            $tipo_inscripcion= $this->input->post("tipo_inscripcion");
            $descuento_gral= $this->input->post("descuento_gral");
            $estado= $this->input->post("estado");
            $localidad2=(int)$this->input->post("localidad2");
            $tipo_inscripcion2=(int)$this->input->post("tipo_inscripcion2");
            $estado2=(int)$this->input->post("estado2");
            $ingresos_brutos= $this->input->post("ingresos_brutos");
            $lista= $this->input->post("lista");
            
            if($estado2 != 0 && $estado2 != $estado)
            {
                $estado=$estado2;
            }
            
            if($localidad2 != 0 && $localidad2 != $localidad)
            {
                $localidad=$localidad2;
            }
            
            if($tipo_inscripcion2 != 0 && $tipo_inscripcion2 != $tipo_inscripcion)
            {
                $tipo_inscripcion=$tipo_inscripcion2;
            }
            
            
            $this->load->library("Md5");
            $contrasenia= Md5::cifrar($contrasenia);
            
            $this->load->model("Registro_de_clientes_model");
            $respuesta = $this->Registro_de_clientes_model->editar_cliente($id,$dni_cuit_cuil,$razon_social,$nombre,$apellido,$telefono,$correo,$direccion,$contrasenia,$localidad,$tipo_inscripcion,$estado,$descuento_gral,$ingresos_brutos,$lista);
            
            echo json_encode($respuesta);
        }
    }
    
    public function get_cliente()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(2))
        {
            $this->load->library("Md5");
            $id= $this->input->post("id");
            
            $this->load->model("Registro_de_clientes_model");
            $respuesta = $this->Registro_de_clientes_model->get_cliente($id);
            $respuesta["contrasenia"]=Md5::descifrar($respuesta["contrasenia"]);
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_pedido_y_detalle()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(4))
        {
            $fecha= $this->input->post("fecha");
            $fecha_entrega= $this->input->post("fecha_entrega");
            $cliente= $this->input->post("cliente");
            $estado= $this->input->post("estado");
            $detalle= $this->input->post("detalle");
            
            $this->load->model("Registro_de_pedidos_model");
            
            
            
            $respuesta = $this->Registro_de_pedidos_model->agregar_pedido_y_detalle($fecha,$fecha_entrega,$cliente,$estado,$detalle);
            echo json_encode($respuesta);
        }
    }
    
    public function editar_pedido_y_detalle()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(4))
        {
            $numero_pedido= $this->input->post("numero_pedido");
            $fecha= $this->input->post("fecha");
            $fecha_entrega= $this->input->post("fecha_entrega");
            $cliente= $this->input->post("cliente");
            $estado= $this->input->post("estado");
            $detalle= $this->input->post("detalle");
            
            $this->load->model("Registro_de_pedidos_model");
            
            
            
            $respuesta = $this->Registro_de_pedidos_model->editar_pedido_y_detalle($numero_pedido,$fecha,$fecha_entrega,$cliente,$estado,$detalle);
            echo json_encode($respuesta);
        }
    }
    
    public function editar_pedido()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(4))
        {
            $numero= $this->input->post("numero");
            $fecha= $this->input->post("fecha");
            $fecha_entrega= $this->input->post("fecha_entrega");
            $cliente= $this->input->post("cliente");
            $cliente2= $this->input->post("cliente2");
            $estado= $this->input->post("estado");
            
            if($cliente2 != 0 && $cliente2 != $cliente)
            {
                $cliente=$cliente2;
            }
            $this->load->model("Registro_de_pedidos_model");
            
            $respuesta = $this->Registro_de_pedidos_model->editar_pedido($numero,$fecha,$fecha_entrega,$cliente,$estado);
            echo json_encode($respuesta);
        }
    }
    
    public function editar_configuracion_empresa()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso(1))
        {
            $valor= $this->input->post("valor");
            $id= $this->input->post("id");
            
            $this->load->model("Configuracion_empresa_model");
            $respuesta = $this->Configuracion_empresa_model->editar_configuracion($id,$valor);
            echo json_encode($respuesta);
        }
    }
    
   public function get_pedidos_cliente_pendientes()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(5))
        {
            $id= $this->input->post("id");
            $this->load->model("Facturacion_model");
            $respuesta = $this->Facturacion_model->get_pedidos_cliente_pendientes($id);
            
            echo json_encode($respuesta);
        }
    }
    
    public function get_remitos_cliente_pendientes()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(5))
        {
            $id= $this->input->post("id");
            $this->load->model("Facturacion_model");
            $respuesta = $this->Facturacion_model->get_remitos_cliente_pendientes($id);
            
            echo json_encode($respuesta);
        }
    }
    
    public function get_detalle_remito_sin_cobrar()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(5))
        {
            $numero_remito= $this->input->post("numero_remito");
            $this->load->model("Facturacion_model");
            $respuesta = $this->Facturacion_model->get_detalle_remito_sin_cobrar($numero_remito);
            
            echo json_encode($respuesta);
        }
    }
    
    public function get_detalle_pedido_sin_cobrar()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(5))
        {
            $numero_pedido= $this->input->post("numero_pedido");
            $this->load->model("Facturacion_model");
            $respuesta = $this->Facturacion_model->get_detalle_pedido_sin_cobrar($numero_pedido);
            
            echo json_encode($respuesta);
        }
    }
    
    public function crear_factura()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(5))
        {
            
            $punto_venta= $this->input->post("punto_de_venta");
            $fecha= $this->input->post("fecha");
            $cliente= $this->input->post("cliente");
            $remito_o_pedido= $this->input->post("remito_o_pedido");
            $numero_remito_pedido= $this->input->post("numero_remito_pedido");
            $tipo_factura= $this->input->post("tipo_factura");
            $condicion_venta= $this->input->post("condicion_venta");
            $estado= 1;
            $detalle= $this->input->post("detalle");
            $descuento_general= $this->input->post("descuento_general");
            
            
            $total= $this->input->post("total");
            
            $this->load->model("Facturacion_model");
            $respuesta = $this->Facturacion_model->crear_factura($punto_venta,$fecha,$cliente,$remito_o_pedido,$numero_remito_pedido,$tipo_factura,$condicion_venta,$estado,$total,$descuento_general,$detalle);
            
            echo json_encode($respuesta);
        }
    }
    
    public function get_listado_productos_segun_usuario()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(4))
        {
            $this->load->model("Registro_de_clientes_model");
            $this->load->model("Registro_de_pedidos_model");
            
            $cliente = $this->Registro_de_clientes_model->get_cliente($this->input->post("cliente"));
            
            $lista = $cliente["lista"];
            
            $respuesta= $this->Registro_de_pedidos_model->get_listado_productos_segun_lista($lista);
            
            echo json_encode($respuesta);
        }
    }
    
    public function eliminar_movimiento()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(5))
        {
            $this->load->model("Movimiento_caja_model");
            $this->load->model("Caja_model");
            $codigo_mov = $this->input->post("codigo");
            $movimiento = $this->Movimiento_caja_model->getMovimientoComprobante($codigo_mov);
            
            $this->Movimiento_caja_model->eliminar_movimiento($codigo_mov);
            $this->Movimiento_caja_model->eliminar_detalle_caja($codigo_mov);
            
            $caja = $this->Caja_model->obtener_caja(Date("Y-m-d"));
            
            $entradas = $caja["entradas"];
            $salidas = $caja["salidas"];
            $saldo = $caja["saldo"];
            
            if ($movimiento["tipo_mov"] == "e")
            {
                $entradas = (float)$entradas - (float)$movimiento["importe"];
                $saldo = (float)$saldo - (float)$movimiento["importe"];
            }
            else
            {
                $salidas = (float)$salidas - (float)$movimiento["importe"];
                $saldo = (float)$saldo + (float)$movimiento["importe"];
            }
                
            $this->Caja_model->actualizar_caja($entradas,$salidas,$saldo,"a");
        }
    }  
    
    
    public function baja_proveedor()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(7))
        {
            $id= $this->input->post("id");
            $this->load->model("Compras_model");
            $respuesta = $this->Compras_model->baja_proveedor($id);
            echo json_encode($respuesta);
        }
    }
    
    public function agregar_proveedor()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(7))
        {
            $razon_social = $this->input->post("razon_social");
            $telefono = $this->input->post("telefono");
            $correo = $this->input->post("correo");
            $direccion = $this->input->post("direccion");
            $cuil = $this->input->post("cuil");
            $fecha_alta = $this->input->post("fecha_alta");
            $estado = "confirmado";
            $ingresos_brutos = $this->input->post("ingresos_brutos");
            $localidad= $this->input->post("localidad");
            
            $this->load->model("Compras_model");
            $respuesta = $this->Compras_model->agregar_proveedor($razon_social,$telefono,$correo,$direccion,$cuil,$estado,$fecha_alta,$ingresos_brutos,$localidad);
            echo json_encode($respuesta);
        }
    }
    
    public function editar_proveedor()
    {
        if($this->input->is_ajax_request() && $this->function_general->dar_permiso_a_modulo(7))
        {
            $id = $this->input->post("id");
            $razon_social = $this->input->post("razon_social");
            $telefono = $this->input->post("telefono");
            $correo = $this->input->post("correo");
            $direccion = $this->input->post("direccion");
            $cuil = $this->input->post("cuil");
            $fecha_alta = $this->input->post("fecha_alta");
            $estado = "confirmado";
            $ingresos_brutos = $this->input->post("ingresos_brutos");
            
            $localidad= (int)$this->input->post("localidad");
            $localidad2= (int)$this->input->post("localidad2");
            
            if($localidad2 != 0)
            {
                $localidad= $localidad2;
            }
            
            $this->load->model("Compras_model");
            $respuesta = $this->Compras_model->editar_proveedor($id,$razon_social,$telefono,$correo,$direccion,$cuil,$estado,$fecha_alta,$ingresos_brutos,$localidad);
            echo json_encode($respuesta);
        }
    }
}

