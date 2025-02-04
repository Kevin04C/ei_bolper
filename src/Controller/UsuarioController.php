<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

/**
 * Usuario Controller
 *
 * @property \App\Model\Table\UsuarioTable 
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuarioController extends AppController
{


    public function initialize(): void
    {
        parent::initialize();
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'loginWeb', 'logout', 'registroClienteWeb', 'isLogueado', 'obtenerInformacionGrafico' , 'libroReclamaciones']);
    }

    public function index()
    {
        $this->verificarAdm();
        $usuario = $this->paginate($this->Usuario->find()->where(['or' => [['tipo' => 'ADM']]]), ['limit' => '10']);
        $top_links = [
            'title' => "Usuarios",
            'links' =>  [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-plus"></i> Usuario',
                    'params' => [
                        'action'    => 'add'
                    ],

                ]
            ]
        ];

        $this->set(compact('usuario'));
        $this->set("top_links", $top_links);
        $this->set("view_title", 'Usuarios');
    }
    public function add()
    {
        $this->verificarAdm();
        $usuario = $this->Usuario->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if ((($data['correo_usuario'] ?? '') == '') || $this->Usuario->find()->where(['correo_usuario' => $data['correo_usuario']])->first()) {
                $this->Flash->error(__("Correo usuario no disponible"));
            } else {
                $usuario = $this->Usuario->patchEntity($usuario, $data);

                if ($this->Usuario->save($usuario)) {
                    $this->Flash->success(__('El Usuario a sido guardado.'));

                    return $this->redirect(['action' => 'index']);
                }
                $msg = $usuario->getError('correo_usuario')['_isUnique'] ?? "Ocurrio un error, intente de nuevo.";
                $this->Flash->error(__($msg));
            }
        }

        $this->set(compact('usuario'));
        $options_usuario = ['CLIENTE' => 'Cliente', 'ADM' => 'Administrador'];
        $this->set('options_usuario', $options_usuario);
        $top_links = [
            'title' => "Nuevo Usuarios",
            'links' =>  [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de  Usuarios',
                    'params' => [
                        'action'    => 'index'
                    ],

                ]
            ]
        ];

        $this->set("top_links", $top_links);
        $this->set("view_title", 'Nuevo Usuario');
    }

    public function edit($id = null, $tipo = '')
    {
        $this->verificarAdm();
        $usuario = $this->Usuario->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if ((($data['correo_usuario'] ?? '') == '') || $this->Usuario->find()->where(['correo_usuario' => $data['correo_usuario'], 'id_usuario !=' => $id])->first()) {
                $this->Flash->error(__("Correo usuario no disponible"));
            } else {
                $usuario = $this->Usuario->patchEntity($usuario, $data);
                if ($this->Usuario->save($usuario)) {
                    $this->Flash->success(__('El registro a sido actualizado.'));

                    return $this->redirect(['action' => $tipo == 'cliente' ? 'clientes' : 'index']);
                }
                $this->Flash->error(__('Ocurrió un error intente de nuevo.'));
            }
        }
        $options_usuario = ['CLIENTE' => 'Cliente', 'ADM' => 'Administrador', 'PROVEEDOR' => 'Proveedor'];
        $this->set('options_usuario', $options_usuario);
        $this->set(compact('usuario'));
        $top_links = [
            'title' => "Editar",
            'links' =>  [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de ' . $tipo == 'cliente' ? 'Clientes' : 'Usuario',
                    'params' => [
                        'action'    => $tipo == 'cliente' ? 'clientes' : 'index'
                    ],

                ]
            ]
        ];

        $this->set("top_links", $top_links);
        $this->set("view_title", 'Pedidos por Clientes');
    }

    public function delete($id = null, $tipo = '')
    {
        $this->verificarAdm();
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuario->get($id);
        if ($this->Usuario->delete($usuario)) {
            $this->Flash->success(__('El registro a sido eliminado.'));
        } else {
            $this->Flash->error(__('Ocurrió un error intente de nuevo.'));
        }

        return $this->redirect(['action' => $tipo == 'cliente' ? 'clientes' : 'index']);
    }

    public function clientes()
    {
        $this->verificarAdm();
        $clientes = $this->Usuario->find()->where(['tipo =' => 'CLIENTE']);
        $opt_nombres = $this->request->getQuery('opt_nombres', '');
        $opt_tipo = $this->request->getQuery('opt_tipo', '');
        if (isset($opt_nombres) && $opt_nombres != '') {
            $clientes = $clientes->andWhere(['nom_usuario LIKE' => "%{$opt_nombres}%"]);
        }
        if (isset($opt_tipo) && $opt_tipo != '') {
            $clientes = $clientes->andWhere(['tipo' => $opt_tipo]);
        }

        $clientes = $this->paginate($clientes, ['limit' => '10']);
        $top_links = [
            'title' => "Listado de Clientes",
        ];

        $this->set(compact('clientes', 'opt_nombres', 'opt_tipo'));
        $this->set("top_links", $top_links);
        $this->set("view_title", 'Clientes');
    }
    public function clientePedidos($id = null)
    {
        $this->verificarAdm();
        $cliente = $this->Usuario->find()->where(['id_usuario' => (int)$id])->first();
        if (!$cliente) {
            $this->Flash->error(__('El Cliente no existe.'));
            return $this->redirect(['action' => 'index']);
        }
        $pedido = $this->fetchTable('Pedido')->find()->where(['Pedido.usuario_id' => $cliente->id_usuario])->contain(['DetallePedido' => ['Producto']]);

        $pedido = $this->paginate($pedido, ['limit' => '10']);

        $this->set(compact('cliente', 'pedido'));
        $top_links = [
            'title' => "Pedidos por Cliente",
            'links' =>  [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de  Clientes',
                    'params' => [
                        'action'    => 'clientes'
                    ],

                ]
            ]
        ];

        $this->set("top_links", $top_links);
        $this->set("view_title", 'Pedidos por Clientes');
    }

    #Auth
    public function login()
    {

        $this->viewBuilder()->setLayout("none");

        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.

        if ($result->isValid()) {
            #Si es un login desde la web redirecciona a la misma web
            $opt = $this->request->getQuery('opt', '');
            $action_2 = $this->request->getQuery('action_2', '');
            $action_3 = $this->request->getQuery('action_3', '');
            if ($opt == 'web' && $action_2 == '') {
                if ($this->request->getData('pedido_id', '') != '') {
                    $this->asignarPedidoUsuarioSesion($this->request->getData('pedido_id', ''));
                }
                return $this->redirect(['controller' => 'Web', 'action' => 'index']);
            } elseif ($opt == 'web' && $action_2 != '') {
                return $this->redirect(['controller' => 'Web', 'action' => $action_2, $action_3]);
            }
            return $this->redirect(['controller' => 'usuario', 'action' => 'dashboard']);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Usuario o contraseña incorrecta.');
            #Si es un login desde la web redirecciona a la misma web
            if ($this->request->getQuery('opt', '') == 'web') {
                return $this->redirect(['controller' => 'web', 'action' => 'index']);
            }
        }
    }
    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Usuario', 'action' => 'login']);
    }
    public function dashboard()
    {
        $this->verificarSesion();

        if ($this->usuario_sesion['tipo'] != 'ADM') {
            return $this->redirect(['controller' => 'Proveedores', 'action' => 'productosListado']);
        }

        $detallePedidoTable = $this->fetchTable('DetallePedido');
        $query = $detallePedidoTable->find();
        $query->select([
            'producto_id' => 'DetallePedido.producto_id',
            'producto_nombre' => 'DetallePedido.producto_nombre',
            'total_vendido' => $query->func()->sum('DetallePedido.pedido_cantidad')
        ])
            ->join([
                'table' => 'pedido',
                'alias' => 'p',
                'type' => 'INNER',
                'conditions' => 'DetallePedido.pedido_id = p.id_pedido'
            ])
            ->where(['p.estado_orden IN' => ['ENTREGADO', 'PAGADO']])
            ->group(['DetallePedido.producto_id', 'DetallePedido.producto_nombre'])
            ->order(['total_vendido' => 'DESC'])
            ->limit(3);

        $topProducts = $query->all();

        

        $pedidoTable = $this->fetchTable('Pedido');
        $totalVentasQuery = $pedidoTable->find();
        $totalVentasQuery->select([
            'total_ventas' => $totalVentasQuery->func()->sum('Pedido.total')
        ])
        ->where(['Pedido.estado_orden IN' => ['ENTREGADO', 'PAGADO']]);

        $primer_dia_mes = date('Y-m-01');
        $dia_actual_mes = date("Y-m-d");

        $totalVentas = $totalVentasQuery->first()->total_ventas;
        $clientesQueMasHanComprado = $this->clientesQueMasHanComprado($primer_dia_mes, $dia_actual_mes);
        $productosMenosVendidos = $this->productosMenosVendidos($primer_dia_mes, $dia_actual_mes);
        $diasConMenosVentas = $this->diasConMenosVentas($primer_dia_mes, $dia_actual_mes);
        $productosSinStock = $this->productosSinStock();

        $this->set('view_title', 'Inicio');
        $this->set('topProducts', $topProducts);
        $this->set('totalVentas', $totalVentas);
        $this->set('clientesQueMasHanComprado', $clientesQueMasHanComprado);
        $this->set('productosMenosVendidos', $productosMenosVendidos);
        $this->set('diasConMenosVentas', $diasConMenosVentas);
        $this->set('productosSinStock', $productosSinStock);
    }



    public function registrarUsuarioPedido($data = [])
    {
        $user = $this->Usuario->newEmptyEntity();
        $user = $this->Usuario->patchEntity($user, $data);
        $user->tipo = "CLIENTE";
        if (isset($data['crear_usuario']) && $data['crear_usuario'] == '1') {
            $pass =  $data['contrasena'];
        }
        $user->contrasena = $pass;
        $user = $this->Usuario->save($user);
        if ($user) {
            if (isset($data['crear_usuario']) && $data['crear_usuario'] == '1') {
                $emailCtrl = new EmailController();
                $emailCtrl->enviarUsuarioNuevo($user, $pass);
            }
            return $user;
        } else {
            return null;
        }
    }

    public function generarCodigoRecuperacion($correo = '')
    {
        $usuario = $this->Usuario->find()->where(['correo_usuario' => $correo, 'correo_usuario !=' => ''])->first();
        if ($usuario) {
            $uid = uniqid('recuperacion');
            $usuario->cod_recuperacion = $uid;
            $usuario = $this->Usuario->save($usuario);
            $url = Router::url("/cambiar-clave/" . $uid, true);

            $emailCtrl = new EmailController();
            $emailCtrl->envioCodigoRecuperacion($url, $correo, $usuario);
            return true;
        }
        return null;
    }
    public function cambiarClave($cod = '', $data = '')
    {
        $correo = $data['correo'] ?? '';
        $pass = $data['clave'] ?? '';
        $usuario = $this->Usuario->find()->where(['cod_recuperacion' => $cod, 'correo_usuario' => $correo])->first();
        if ($usuario && $pass != '') {
            $usuario->contrasena = $pass;
            $usuario->cod_recuperacion = '';
            $usuario = $this->Usuario->save($usuario);
            if ($usuario) {
                $emailCtrl = new EmailController();
                $emailCtrl->envioNuevaClave($pass, $usuario);
                return $usuario;
            }
        }
        return null;
    }
    public function validarRegistroPedido($data = [])
    {
        $exist = $this->fetchTable('Usuario')->find()->where(['correo_usuario' => $data['correo_usuario']])->first();
        if ($exist) {
            $resp = [
                'status' => false,
                'message' => 'Correo no disponible, ingrese otro.'
            ];
            return $resp;
        }
        if (!isset($data['contrasena']) || $data['contrasena'] == '') {
            $resp = [
                'status' => false,
                'message' => 'Debe proporcionar una contraseña.'
            ];
            return $resp;
        }

        return [
            'status' => true,
            'message' => 'done'
        ];
    }

    public function registroClienteWeb()
    {
        $data = $this->request->getData();
        if ($this->request->is('post')) {

            if ((($data['dni'] ?? '') == '') || $this->Usuario->find()->where(['dni' => $data['dni']])->first()) {
                return $this->response->withType('application/json')->withStringBody(json_encode([
                    'success' => false, 'message' => 'El DNI ya esta en uso', 'data' => null
                ]));
            }

            // Correo es obligatorio y con expresion regular 
            if (($data['correo'] ?? '') == '' || !filter_var($data['correo'], FILTER_VALIDATE_EMAIL)) {
                return $this->response->withType('application/json')->withStringBody(json_encode([
                    'success' => false, 'message' => 'El correo no es valido', 'data' => null
                ]));
            }


            if ((($data['correo'] ?? '') == '') || $this->Usuario->find()->where(['correo_usuario' => $data['correo']])->first()) {
                return $this->response->withType('application/json')->withStringBody(json_encode([
                    'success' => false, 'message' => 'El correo ya esta en uso', 'data' => null
                ]));
            }
            $usuario = $this->Usuario->newEmptyEntity();

            $usuario->dni = $data['dni'] ?? '';
            $usuario->nom_usuario = $data['nombres'] ?? '';
            $usuario->correo_usuario = $data['correo'] ?? '';
            $usuario->telef_usuario = $data['telefono'] ?? '';
            $usuario->contrasena = $data['contrasena'] ?? '';
            $usuario->direccion = $data['direccion'] ?? '';

            $usuario_ = $this->Usuario->save($usuario);

            if ($this->Usuario->save($usuario)) {
                // if ($usuario_) {
                $emailCtrl = new EmailController();
                $response = $emailCtrl->enviarClienteNuevo($usuario_, $data['contrasena']);
                return $this->response->withType('application/json')->withStringBody(json_encode([
                    'success' => true, 'message' => 'Registro exitoso, revise su correo', 'data' => $response
                ]));
            }
        }
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'success' => false, 'message' => 'Ocurrio un error, intente de nuevo', 'data' => null
        ]));
    }

    public function isLogueado()
    {
        // escuchar si es get 
        // var_dump($this->request);
        // exit();
        $isLogueado = $this->usuario_sesion ? true : false;
        if ($this->request->is('get')) {
            return $this->response->withType('application/json')->withStringBody(json_encode([
                'success' => true, 'message' => 'devolviendo session', 'data' => $isLogueado
            ]));
        };
    }

    public function clientesQueMasHanComprado($fechaInicio, $fechaFin)
    {
        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido');
        $usuarioTable = TableRegistry::getTableLocator()->get('Usuario');

        // Crear la consulta personalizada
        $query = $pedidoTable->find();
        $query->select([
            'usuario_id',
            'nombre' => 'Usuario.nom_usuario',
            'cantidad' => $query->func()->count('*')
        ])
            ->innerJoinWith('Usuario')
            ->where([
                'Usuario.tipo' => 'CLIENTE',
                function ($exp, $q) use ($fechaInicio, $fechaFin) {
                    return $exp->between('DATE(fecha_orden)', $fechaInicio, $fechaFin);
                }
            ])
            ->group(['usuario_id', 'Usuario.nom_usuario'])
            ->order(['total' => 'DESC'])
            ->limit(3);

        // Ejecutar la consulta y obtener los resultados
        $resultados = $query->toArray();

        // Retornar los resultados
        return $resultados;
    }

    public function diasConMenosVentas($fechaInicio, $fechaFin)
    {
        $connection = ConnectionManager::get('default');
        $sql = "SELECT DATE(fecha_orden) AS nombre, COUNT(*) AS cantidad
            FROM pedido
            WHERE estado_orden = 'ENTREGADO' AND DATE(fecha_orden) BETWEEN :fechaInicio AND :fechaFin
            GROUP BY DATE(fecha_orden)
            ORDER BY cantidad ASC
            LIMIT 0, 3";
            
        $params = [
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ];

        $resultados = $connection->execute($sql, $params)->fetchAll("assoc");
        return $resultados;
        
    }

    public function productosMenosVendidos($fechaInicio, $fechaFin)
    {
        // Obtener instancia de PedidoTable y ProductoTable
        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido');
        $productoTable = TableRegistry::getTableLocator()->get('Producto');

        // Crear la consulta para obtener los productos más vendidos
        $query = $pedidoTable->find();
        $query->select([
            'producto_id' => 'Producto.id',
            'nombre' => 'Producto.nom_producto',
            'cantidad' => $query->func()->sum('Pedido.cantidad')
        ])
            ->innerJoinWith('DetallePedido.Producto')
            ->where([
                'pedido.estado_orden' => 'ENTREGADO',
                function ($exp, $q) use ($fechaInicio, $fechaFin) {
                    return $exp->between('DATE(pedido.fecha_orden)', $fechaInicio, $fechaFin);
                }
            ])
            ->group(['Producto.id', 'Producto.nom_producto'])
            ->order(['total' => 'ASC'])
            ->limit(3);

        // Ejecutar la consulta y obtener los resultados
        $resultados = $query->toArray();

        // Retornar los resultados
        return $resultados;
    }

    public function productosSinStock()
    {
        // Obtener instancia de ProductoTable
        $productoTable = TableRegistry::getTableLocator()->get('Producto');

        // Crear la consulta para obtener los productos con stock igual a 0
        $query = $productoTable->find();
        $query->select([
            'nombre' => 'nom_producto',
            'cantidad' => 'cantidad'
        ])
            ->where(['cantidad' => 0])
            ->limit(3);

        // Ejecutar la consulta y obtener los resultados
        $resultados = $query->toArray();

        // Retornar los resultados
        return $resultados;
    }

    public function obtenerInformacionGrafico()
    {
        // $this->verificarAdm();
        if ($this->request->is(["get"])) {
            $fechaInicio = $this->request->getQuery("fechaInicio");
            $fechaFin = $this->request->getQuery("fechaFin");
            $tipo = $this->request->getQuery("tipo");
            $data = null;

            switch ($tipo) {
                case '1':
                    $data = $this->productosMasVendidos($fechaInicio, $fechaFin);
                    break;
                case '2':
                    $data = $this->productosMenosVendidos($fechaInicio, $fechaFin);
                    break;
                case '3':
                    $data = $this->productosSinStock();
                    break;
                case '4':
                    $data = $this->diasConMenosVentas($fechaInicio, $fechaFin);
                    break;
                case '5':
                    $data = $this->clientesQueMasHanComprado($fechaInicio, $fechaFin);
                    break;
                case '6':
                    $data = $this->ventasTotalesByFecha($fechaInicio, $fechaFin);
                    break;
                default:
                    break;
            }

            return $this->response->withType('application/json')->withStringBody(json_encode([
                'success' => true,
                'data' => $data,
            ]));
        }
    }
    public function productosMasVendidos($fechaInicio, $fechaFin)
    {
        $detallePedidoTable = $this->fetchTable('DetallePedido');
        $query = $detallePedidoTable->find();
        $query->select([
            'producto_id' => 'DetallePedido.producto_id',
            'nombre' => 'DetallePedido.producto_nombre',
            'cantidad' => $query->func()->sum('DetallePedido.pedido_cantidad')
        ])
            ->join([
                'table' => 'pedido',
                'alias' => 'p',
                'type' => 'INNER',
                'conditions' => 'DetallePedido.pedido_id = p.id_pedido'
            ])
            ->where(['p.estado_orden IN' => ['ENTREGADO', 'PAGADO']])
            ->group(['DetallePedido.producto_id', 'DetallePedido.producto_nombre'])
            ->order(['cantidad' => 'DESC'])
            ->limit(3);

        $topProducts = $query->all();
        return $topProducts;
    }

    public function ventasTotalesByFecha($fechaInicio, $fechaFin){

        $connection = ConnectionManager::get('default');
        $sql = "SELECT  COALESCE(SUM(total),0) AS total_ventas
            FROM pedido
            WHERE (estado_orden = 'ENTREGADO' OR estado_orden = 'PAGADO') AND DATE(fecha_orden) BETWEEN '$fechaInicio' AND '$fechaFin';";
        $params = [

        ];

        $resultados = $connection->execute($sql, $params)->fetchAll("assoc");
        return $resultados[0]['total_ventas'];
    }

    public function libroReclamaciones(){
       
        $data = $this->request->getData();
        if ($this->request->is('post')) {
            $emailCtrl = new EmailController();
            $response = $emailCtrl->envioLibroReclamacion($data);
            if (true) {
                return $this->response->withType('application/json')->withStringBody(json_encode([
                    'success' => true, 'message' => 'Reclamo registrado', 'data' => $response
                ]));
            }
        }
        return $this->response->withType('application/json')->withStringBody(json_encode([
            'success' => false, 'message' => 'Ocurrio un error, intente de nuevo', 'data' => null
        ]));
    }
}
