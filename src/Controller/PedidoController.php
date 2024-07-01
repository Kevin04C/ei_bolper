<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;

/**
 * Pedido Controller
 *
 * @property \App\Model\Table\PedidoTable $Pedido
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PedidoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['agregarProductoPedido', 'eliminarRegistroPedido', 'confirmarPedido', 'pagarPedidoFinal']);
    }
    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);
        $this->verificarAdm();
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuario', 'DetallePedido'],
        ];
        $pedido = $this->Pedido->find();
        
        $opt_num_pedido = $this->request->getQuery('opt_num_pedido', '');
        $opt_nombre = $this->request->getQuery('opt_nombre', '');
        $opt_fech_ini = $this->request->getQuery('opt_fech_ini', '');
        $opt_fech_fin = $this->request->getQuery('opt_fech_fin', '');
        $opt_estado = $this->request->getQuery('opt_estado', '');

        if ($opt_num_pedido != '') {
            $pedido = $pedido->andWhere(['CAST(Pedido.id_pedido AS VARCHAR(20)) LIKE' => "%$opt_num_pedido%"]);
        }
        if ($opt_nombre != '') {
            $pedido = $pedido->andWhere(['Usuario.nom_usuario LIKE' => "%$opt_nombre%"]);
        }
        if ($opt_fech_ini != '') {
            $pedido = $pedido->andWhere(['Pedido.fecha_orden >=' => $opt_fech_ini . " 00:00:00"]);
        }
        if ($opt_fech_fin != '') {
            $pedido = $pedido->andWhere(['Pedido.fecha_orden <=' => $opt_fech_fin . " 23:59:59"]);
        }
        if ($opt_estado != '') {
            $pedido = $pedido->andWhere(['Pedido.estado_orden' => $opt_estado]);
        }

        $pedido = $this->paginate($pedido , ['limit' => 10 , 'order' => ['id_pedido' => 'DESC']]);
        $this->set( compact('pedido','opt_num_pedido','opt_nombre','opt_fech_ini','opt_fech_fin','opt_estado') );
        $top_links = [
            'title' => "Pedidos",
        ];
        
        $this->set("top_links", $top_links);
        $this->set("view_title", 'Lista de Pedidos');

        $this->set("estados", [ 'NUEVO' => 'Nuevo' ,'PROCESO' => 'Proceso', 'ENTREGADO' => 'Entregado' ]);
    }

    public function view($id = null)
    {
        $pedido = $this->Pedido->get($id, [
            'contain' => ['Usuario'],
        ]);
        $detalle_pedido = $this->fetchTable('DetallePedido')->find()->where(['pedido_id' => $pedido->id_pedido])->contain(['Producto']);
        $detalle_pedido = $this->paginate($detalle_pedido, [ 'limit' => '10'] );
        $this->set(compact('pedido'));
        $this->set(compact('detalle_pedido'));
        $top_links = [
            'title' => "Detalles del Pedido " . $pedido->id_pedido,
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de Pedidos',
                    'params' => [
                        'controller'    => 'Pedido', 'action' => 'index'
                    ],
                ]
            ],
        ];
        
        $this->set("top_links", $top_links);
        $this->set("view_title", 'Detalle del Pedido');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pedido = $this->Pedido->get($id);
        if ($this->Pedido->delete($pedido)) {
            $this->Flash->success(__('El pedido ha sido eliminado.'));
        } else {
            $this->Flash->error(__('Ocurrio un error, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function pedidoEntregado($id = null)
    {
        $pedido = $this->Pedido->find()->where(['id_pedido' => (int)$id ])->first();
        if(!$pedido || $pedido->estado_orden == 'ENTREGADO'){
            $msg = !$pedido ? 'El pedido no existe.' : 'El pedido ya fue entregado';
            $this->Flash->error(__($msg));
            return $this->redirect(['action' => 'index']);
        }
        $data = $this->request->getData();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ruta = $this->subirArchivo( $data['adjunto'], $pedido->id_pedido . "-" . uniqid() , 'img/pedidos' );
            $pedido->ruta_adjunto = $ruta != '' ? $ruta : '';
            $pedido->estado_orden = 'ENTREGADO';
            if( $pedido->metodo_entrega == 'DELIVERY' ){
                $detalle_pedido_registros = $this->fetchTable('DetallePedido')->find()->contain(['Producto'])->where(['DetallePedido.pedido_id' => $pedido->id_pedido] );
                foreach ($detalle_pedido_registros as $reg) {
                    if($reg->producto){
                        $prod = $reg->producto;
                        $prod->cantidad = ((int) $prod->cantidad) - ((int) $reg->pedido_cantidad);
                        $prod = $this->fetchTable('Producto')->save($prod);
                    }
                }
            }
            $pedido = $this->Pedido->save($pedido);
            if ($pedido) {
                $emailCtrl = new EmailController();
                $emailCtrl->confirmarEntregaPedido($pedido->id_pedido);
                $this->Flash->success(__("El Pedido #{$pedido->id_pedido} a sido registrado como Entregado."));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error intente de nuevo.'));
            
        }
        $this->set(compact('pedido'));
        $this->set('view_title', 'Actualizar Pedido');
        $top_links = [
            'title' => 'Confirmar entrega',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de Pedidos',
                    'params' => [
                        'controller'    => 'Pedido', 'action' => 'index'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    public function pedidoCancelar($id = null)
    {
        $pedido = $this->Pedido->find()->where(['id_pedido' => (int)$id ])->first();
        if(!$pedido || $pedido->estado_orden == 'ENTREGADO'){
            $msg = !$pedido ? 'El pedido no existe.' : 'El pedido ya fue entregado';
            $this->Flash->error(__($msg));
            return $this->redirect(['action' => 'index']);
        }
        $pedido->estado_orden = 'CANCELADO';
        $pedido = $this->Pedido->save($pedido);
        if ($pedido) {
            // $emailCtrl = new EmailController();
            // $emailCtrl->cancelarPedido($pedido->id_pedido);
            // $this->Flash->success(__("El Pedido #{$pedido->id_pedido} a sido cancelado."));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Ocurrió un error intente de nuevo.'));
    }

    #Funciones que se usan como API para el pedido desde la web
    public function agregarProductoPedido(){
        $resp = [
            'success' => false,
            'data' => [],
            'message' => 'No se enviaron los datos correctos'
        ];
        $data = $this->request->getData();
        $id_prod = $data['id_producto'] ?? '';
        $prod = $this->fetchTable('Producto')->find()->where(['id' => $id_prod])->first();
        if($prod){
            if($this->cookies->has('usuario_cookie')){
                $cookie = $this->cookies->get('usuario_cookie');
                $usuario = $cookie->getValue();
                $pedido_id = $usuario->pedido ? $usuario->pedido->id_pedido : '';
                $pedido_registro = $this->fetchTable('Pedido')->find()->where(['Pedido.id_pedido' => (int) $pedido_id ])->first();
                

                if(!$pedido_registro){
                    $pedido_registro = $this->fetchTable('Pedido')->newEntity([
                        'usuario_id' => $usuario->id_usuario,
                        'estado' => 'INICIAL',
                        'fecha_orden' => date("Y-m-d H:i:s")
                    ]);
                    $pedido_registro = $this->fetchTable('Pedido')->save($pedido_registro);
                }

                $detalle_pedido_registro = $this->fetchTable('DetallePedido')->find()->where(['DetallePedido.producto_id' => $prod->id , 'DetallePedido.pedido_id' => $pedido_registro->id_pedido ])->first();

                if(!$detalle_pedido_registro){
                    $detalle_pedido_registro = $this->fetchTable('DetallePedido')->newEntity([
                        'pedido_id' => $pedido_registro->id_pedido,
                        'pedido_cantidad' => $data['cantidad'] ?? 1,
                        'producto_id' => $prod->id,
                        'producto_nombre' => $prod->nom_producto,
                        'producto_punitarioincigv' => ($this->oferta_activa) ? $prod->desc_producto :  $prod->precio_producto,
                        'producto_total' => (float)$data['cantidad'] *( ($this->oferta_activa) ? (float) $prod->desc_producto :  (float)$prod->precio_producto ),
                        'oferta_activa' => ($this->oferta_activa) ? '1' : '0'
                    ]);
                }else{
                    $detalle_pedido_registro->pedido_cantidad = (int) $detalle_pedido_registro->pedido_cantidad + 1;
                }
                $detalle_pedido_registro->producto_total = (float) $detalle_pedido_registro->producto_punitarioincigv * (int) $detalle_pedido_registro->pedido_cantidad;
                $detalle_pedido_registro = $this->fetchTable('DetallePedido')->save($detalle_pedido_registro);

                $detalle_pedido_registros = $this->fetchTable('DetallePedido')->find()->contain(['Producto'])->where(['DetallePedido.pedido_id' => $pedido_registro->id_pedido] );
                $total = 0;
                $subtotal = 0;
                $igv = 0;
                foreach ($detalle_pedido_registros as $reg) {
                    $total += (float) $reg->producto_total;
                }
                $pedido_registro->total = $total;
                $pedido_registro = $this->fetchTable('Pedido')->save($pedido_registro);
                $pedido_registro->detalle_pedido = $detalle_pedido_registros;
                $resp = [
                    'success' => true,
                    'data' => $pedido_registro,
                    'message' => ''
                ];

            }
        }
        return $this->response->withType('application/json')->withStringBody(json_encode($resp));

    }

    public function eliminarRegistroPedido(){
        $resp = [
            'success' => false,
            'data' => [],
            'message' => ''
        ];
        $data = $this->request->getData();
        $detalle_pedido_id = $data['detalle_pedido_id'] ?? '';
        $detalle_pedido = $this->fetchTable('DetallePedido')->find()->where(['id' => $detalle_pedido_id])->first();
        if($detalle_pedido){
            $this->fetchTable('DetallePedido')->delete($detalle_pedido);
            if($this->cookies->has('usuario_cookie')){
                $cookie = $this->cookies->get('usuario_cookie');
                $usuario = $cookie->getValue();
                if($usuario->pedido){
                    $pedido_registro = $this->fetchTable('Pedido')->find()->where(['Pedido.id_pedido' => (int) $usuario->pedido->id_pedido ])->first();
                    $detalle_pedido_registros = $this->fetchTable('DetallePedido')->find()->contain(['Producto'])->where(['DetallePedido.pedido_id' => $pedido_registro->id_pedido] );
                    $total = 0;
                    $subtotal = 0;
                    $igv = 0;
                    foreach ($detalle_pedido_registros as $reg) {
                        $total += (float) $reg->producto_total;
                    }
                    $pedido_registro->total = $total;
                    $pedido_registro = $this->fetchTable('Pedido')->save($pedido_registro);
                    $pedido_registro->detalle_pedido = $detalle_pedido_registros;
                    $resp = [
                        'success' => true,
                        'data' => $pedido_registro,
                        'message' => ''
                    ];
                }
            }
        }
        return $this->response->withType('application/json')->withStringBody(json_encode($resp));
    }

    public function confirmarPedido(){
        $resp = [
            'success' => false,
            'data' => [],
            'message' => 'No se enviaron los datos correctos'
        ];
        $data = $this->request->getData();
        $id_pedido = $data['id_pedido'] ?? '';
        $pedido = $this->fetchTable('Pedido')->find()->where(['id_pedido' => $id_pedido])->first();
        $msg = '';
        if($pedido){
            $cookie = $this->cookies->get('usuario_cookie'); 
            $usuario = $cookie->getValue();
            $usuarioCtrl = new UsuarioController();
            if($this->usuario_sesion){
                $usuario = $this->fetchTable('Usuario')->find()->where(['Usuario.id_usuario' => ($this->usuario_sesion->id_usuario ?? -1)])->first();
            }else if(isset($data['crear_usuario']) && $data['crear_usuario'] == '1' ){
                $validacion = $usuarioCtrl->validarRegistroPedido($data);
                if( !$validacion['status'] ){
                    $resp = [
                        'success' => $validacion['status'],
                        'data' => null,
                        'message' => $validacion['message']
                    ];
                    return $this->response->withType('application/json')->withStringBody(json_encode($resp));
                }
                $usuario = $usuarioCtrl->registrarUsuarioPedido($data);
                if(!$usuario){
                    $resp = [
                        'success' => false,
                        'data' => null,
                        'message' => 'Ocurrio un error al registrar su usario.'
                    ];
                    return $this->response->withType('application/json')->withStringBody(json_encode($resp));
                }
                $msg = 'Cuenta creada, para ver sus pedidos inicie sesión';
            }

            $pedido->usuario_id = $usuario->id_usuario;
            $detalle_pedido_registros = $this->fetchTable('DetallePedido')->find()->contain(['Producto'])->where(['DetallePedido.pedido_id' => $pedido->id_pedido] );
            $total = 0;
            $subtotal = 0;
            $igv = 0;
            $can = 0;
            foreach ($detalle_pedido_registros as $reg) {
                $total += (float) $reg->producto_total;
                $can += 1;
            }
            $pedido->total = $total;
            $pedido->cantidad = (int)$can;

            #Datos para el pedido
            
            if($this->usuario_sesion && $this->usuario_sesion->tipo != 'DESCONOCIDO' && !isset($data['cambiar_envio']) ){
                $pedido->cliente_nombre = $usuario->nom_usuario ?? '';
                $pedido->cliente_correo = $usuario->correo_usuario ?? '';
                $pedido->cliente_direccion = $usuario->direccion ?? '';
                $pedido->cliente_telefono = $usuario->telef_usuario ?? '';
                $pedido->cliente_departamento = $usuario->departamento ?? '';
                $pedido->cliente_codigo_postal = $usuario->codigo_postal ?? '';
            }else{
                $pedido->cliente_nombre = $data['nom_usuario'] ?? '';
                $pedido->cliente_correo = $data['correo_usuario'] ?? '';
                $pedido->cliente_direccion = $data['direccion'] ?? '';
                $pedido->cliente_telefono = $data['telef_usuario'] ?? '';
                $pedido->cliente_departamento = $data['departamento'] ?? '';
                $pedido->cliente_codigo_postal = $data['codigo_postal'] ?? '';
            }

            $pedido->ruta_pago_adjunto = '';
            $pedido->metodo_pago = ($data['metodo_pago'] ?? '');
            $pedido->metodo_entrega = $data['metodo_entrega'] ?? 'LOCAL';
            // if( $pedido->metodo_entrega == 'DELIVERY'){
            //     // Proceso es para marcar que el pedido espera su total confirmacion.
            //     $pedido->estado_orden = 'PROCESO';
            // }else{
                $pedido->estado_orden = 'NUEVO';
            // }

            $pedido = $this->Pedido->save($pedido);
            // $this->eliminarPedidosNuevosUsuario($usuario->id_usuario);
            // $emailCtrl->confirmarPedidoUsuario($pedido->id_pedido);
            // OJO se puede enviar un email al correo que se registro para el pedido
            $resp = [
                'success' => true,
                'data' => $pedido->id_pedido,
                'message' => $msg
            ];
        }
        return $this->response->withType('application/json')->withStringBody(json_encode($resp));
    }

    protected function eliminarPedidosNuevosUsuario($usuario_id){
        $pedidos = $this->Pedido->find()->where(['usuario_id' => $usuario_id , 'estado_orden' => 'NUEVO']);
        foreach($pedidos as $pp){
            if($this->Pedido->delete($pp)){
                $this->fetchTable('DetallePedido')->deleteAll(['pedido_id' => $pp->id_pedido ]);
            }
        }
    }
    public function pagarPedidoFinal(){
        $resp = [
            'success' => false,
            'data' => null,
            'message' => 'Ocurrio un error. Intente mas tarde.'
        ];
        $data = $this->request->getData();
        try {
            $id_pedido = $data['id_pedido'] ?? '';
            $pedido = $this->Pedido->find()->where(['id_pedido' => (int) $id_pedido])->first();
            if($pedido){
                $data = $this->request->getData();
                $emailCtrl = new EmailController();           
                $detalle_pedido_registros = $this->fetchTable('DetallePedido')->find()->contain(['Producto'])->where(['DetallePedido.pedido_id' => $pedido->id_pedido] );
                foreach ($detalle_pedido_registros as $reg) {
                    if($reg->producto){
                        $prod = $reg->producto;
                        $prod->cantidad = ((int) $prod->cantidad) - ((int) $reg->pedido_cantidad);
                        $prod = $this->fetchTable('Producto')->save($prod);
                    }
                }
                $pedido->estado_orden = 'PAGADO';
                $ruta = $this->subirArchivo( $data['adjunto_pago'], $pedido->id_pedido . "-" . uniqid() , 'img/pedidos' );
                $pedido->ruta_pago_adjunto = $ruta != '' ? $ruta : '';
                $pedido = $this->Pedido->save($pedido);

                $emailCtrl->confirmarPedidoUsuario($pedido->id_pedido);
                $this->eliminarPedidosNuevosUsuario($pedido->usuario_id);
                $resp = [
                    'success' => true,
                    'data' => null,
                    'message' => 'Pedido pagado y procesado, consulte su correo.'
                ];
            }else{
                $resp = [
                    'success' => false,
                    'data' => null,
                    'message' => 'El pedido por pagar no existe.'
                ];
            }
        } catch (\Throwable $th) {
            $resp = [
                'success' => false,
                'data' => null,
                'message' => 'Ocurrio un error. Intente otro método de pago.'
            ];
        }
        return $this->response->withType('application/json')->withStringBody(json_encode($resp));
    }
}
