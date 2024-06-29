<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class WebController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // estableciendo el layout (estructura) para todos los templates de este controller
        $this->setData();
        $this->viewBuilder()->setLayout("paginaweb");
        $this->Authentication->allowUnauthenticated([
            'index', 'productos', 'categorias', 'detalleProducto',
            'carritoCompras', 'confirmarPagar', 'pedidoConfirmado',
            'recuperarClave', 'cambiarClave',
            'misPedidos', '', 'loginWeb', 'logout', 'pedidoError', 'pagarPedido', 'registroWeb', 'libroReclamaciones'
        ]);
    }
    public function beforeFilter(EventInterface $event)
    {
        return parent::beforeFilter($event);
    }
    public function setData()
    {
        $categorias = $this->fetchTable('Categoria')->find()->order(['nom_categoria' => 'ASC']);
        $this->set("cats", $categorias);
    }
    public function login()
    {
    }
    public function index()
    {
        $texto_promocion = "";
        $this->set(compact('texto_promocion'));

        $items = $this->fetchTable('Producto')->find()->contain(['Categoria'])->limit('10')->order(['id' => 'desc']);
        $this->set("productos_nuevos", $items);

        $mas_vendidos = $this->getMasVendidos(5);
        $this->set("productos_mas_vendidos", $mas_vendidos);

        $cat_random = $this->getCategoriasRandom(3);
        $this->set("categorias_random", $cat_random);

        $this->set("view_title", 'Inicio');
        try {
            $fecha_oferta = date("Y-m-d H:i:s", strtotime($this->getConfiguracion('fecha_oferta')));
        } catch (\Throwable $th) {
            $fecha_oferta = date("Y-m-d H:i:s");
        }
        $this->set("fecha_oferta", $fecha_oferta);
    }
    public function nosotros()
    {
        //diseñar la plantilla
    }
    public function contacto()
    {
        //diseñar la plantilla
    }
    public function productos($id_categoria = '')
    {

        $lista_de_marcas = $this->fetchTable('Producto')->find()
            ->select(['marca_producto'])
            ->distinct(['marca_producto'])
            ->where(['categoria_id' => $id_categoria])
            ->toArray();
        $this->set('lista_de_marcas', $lista_de_marcas);
        $opt_marca = $this->request->getQuery('opt_marca', '');
        $this->set("opt_marca", $opt_marca);
        $opt_precio_ini = $this->request->getQuery('opt_precio_ini', '');
        $this->set("opt_precio_ini", $opt_precio_ini);
        $opt_precio_fin = $this->request->getQuery('opt_precio_fin', '');
        $this->set("opt_precio_fin", $opt_precio_fin);

        $opt_order = $this->request->getQuery('opt_order', '');
        $this->set("opt_order", $opt_order);
        $opciones_orden = [
            'precio_bajo' => 'Precio desde el mas bajo',
            'precio_alto' => 'Precio desde el mas alto',
            'alf_az' => 'Alfabeticamente A-Z',
            'alf_za' => 'Alfabeticamente Z-A'
        ];
        $this->set("opciones_orden", $opciones_orden);

        $items = $this->fetchTable('Producto')->find()->contain(['Categoria']);

        if ($id_categoria != '') {
            $items = $items->andWhere(['Producto.categoria_id' => $id_categoria]);
        }

        $opt_search = $this->request->getQuery('q', '');
        if ($opt_search != '') {
            $items = $items->andWhere(['OR' => [
                ['Producto.nom_producto LIKE' => "%{$opt_search}%"],
                ['Producto.marca_producto LIKE' => "%{$opt_search}%"],
                ['Categoria.nom_categoria LIKE' => "%{$opt_search}%"],

            ]]);
        }
        if ($opt_marca) {
            $items = $items->andWhere(['marca_producto' => $opt_marca]);
        }

        $this->set("opt_search", $opt_search);
        if ($opt_precio_ini != '') {
            $items = $items->andWhere(["precio_producto >=" => $opt_precio_ini]);
        }
        if ($opt_precio_fin != '') {
            $items = $items->andWhere(["precio_producto <=" => $opt_precio_fin]);
        }

        switch ($opt_order) {
            case 'precio_bajo':
                $items = $items->order(['precio_producto' => 'ASC']);
                break;
            case 'precio_alto':
                $items = $items->order(['precio_producto' => 'DESC']);
                break;
            case 'alf_az':
                $items = $items->order(['nom_producto' => 'ASC']);
                break;
            case 'alf_za':
                $items = $items->order(['nom_producto' => 'DESC']);
                break;
            default:
                $items = $items->order(['nom_producto' => 'ASC']);
                break;
        }

        $items = $this->paginate($items, ['limit' => '6']);
        $this->set("lista_de_productos", $items);

        $this->set("view_title", 'Productos');
        $mas_vendidos = $this->getMasVendidos(3);
        $this->set("productos_mas_vendidos", $mas_vendidos);
    }
    public function detalleProducto($ruta_producto = '')
    {
        $producto_id = $ruta_producto; // Establecer el ID por defecto como la ruta completa
        if (strpos($ruta_producto, '-') !== false) {
            $producto_id = substr($ruta_producto, 0, strpos($ruta_producto, '-'));
        }
        $producto = $this->fetchTable('Producto')
            ->find()
            ->contain(['Categoria'])
            ->where(['Producto.id' => $producto_id])
            ->first();
        $this->set("producto", $producto);
        $this->set("view_title", 'Detalles ');
    }
    public function categorias()
    {
        // cargamos el modelo de categoria
        $categorias = $this->fetchTable('Categoria')->find();
        $this->set("cats", $categorias);
        $this->set("view_title", 'Categorias');
    }
    public function carritoCompras()
    {
        //Vista donde se ve todo el carrito de compras
        $this->set("view_title", 'Carrito de Compras');
    }
    public function confirmarPagar()
    {
        $this->set("view_title", 'Confirmar Pedido');
    }
    public function pedidoConfirmado($id_pedido = '')
    {
        //Pantalla que se muestra luego de confirmar un pedido
        $this->set("view_title", 'Pedido Confirmado');
        $pedido = $this->fetchTable('Pedido')->find()
            ->where([
                'id_pedido' => (int) $id_pedido,
                'OR' => [['estado_orden' => 'PAGADO', 'metodo_entrega' => 'LOCAL'], ['estado_orden' => 'PROCESO', 'metodo_entrega' => 'DELIVERY']]
            ])->first();
        if (!$pedido) {
            return $this->redirect(['action' => 'pedidoError']);
        }
        $this->set("pedido", $pedido);
    }

    public function misPedidos($id_pedido = '')
    {
        //Lista de pedidos
        if (!$this->Authentication->getResult()->isValid()) {
            return $this->redirect(['controller' => 'web', 'action' => 'loginWeb']);
        }
        $this->usuario_sesion;
        $pedido_unico = $this->fetchTable('Pedido')->find()->where(['id_pedido' => $id_pedido, 'estado_orden != ' => 'NUEVO'])->first();
        if ($pedido_unico) {
            $detalle_pedido = $this->fetchTable('DetallePedido')->find()->where(['pedido_id' => $pedido_unico->id_pedido])->contain(['Producto']);
            $this->set('pedido_unico', $pedido_unico);
            $this->set('detalle_pedido', $this->paginate($detalle_pedido));
        } else {
            $pedidos = $this->fetchTable('Pedido')->find()->where(['usuario_id' => $this->usuario_sesion->id_usuario, 'estado_orden != ' => 'NUEVO'])->limit(20);
            $this->set('pedidos', $this->paginate($pedidos));
        }
        $this->set("view_title", 'Mis Pedidos');
    }
    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Web', 'action' => 'index']);
    }

    public function recuperarClave()
    {
        $data = $this->request->getData();
        if ($this->request->is('POST')) {
            $usuarioCtrl = new UsuarioController();
            $resp = $usuarioCtrl->generarCodigoRecuperacion($data['correo'] ?? '');
            if ($resp) {
                $this->Flash->success("Se le envio un enlace de recuperacion a su correo.");
                return $this->redirect(['controller' => 'Web', 'action' => 'index']);
            } else {
                $this->Flash->error("Error el correo no existe.");
            }
        }
        $this->set("view_title", 'Recuperar Clave');
        $this->set("form_data", $data);
    }
    public function cambiarClave($codigo = '')
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $usuarioCtrl = new UsuarioController();
            $resp = $usuarioCtrl->cambiarClave($codigo, $data);
            if ($resp) {
                $this->Flash->success("Se le envio una nueva contraseña a su correo.");
                return $this->redirect(['controller' => 'Web', 'action' => 'index']);
            } else {
                $this->Flash->error("Datos incorrectos.");
            }
            return $this->redirect(['controller' => 'web', 'action' => 'cambiarClave', $codigo]);
        }

        $this->set("view_title", 'Crear nueva contraseña');
    }

    protected function getMasVendidos($limit = 5)
    {
        $mas_vendido =  $this->fetchTable('DetallePedido')->find();
        $mas_vendido->select([
            'suma' => $mas_vendido->func()->sum('pedido_cantidad'),
            'producto_id',
        ])
            ->group('producto_id')
            ->orderDesc('suma')
            ->having(['suma >' => 1])
            ->limit($limit);
        foreach ($mas_vendido as $venta) {
            $venta->producto = $this->fetchTable('Producto')->find()->where(['id' => $venta->producto_id])->first();
        }
        return $mas_vendido;
    }
    protected function getCategoriasRandom($limit = 3)
    {

        $categorias = $this->fetchTable('Categoria')->find();               //Todas las categorias
        $count_cat = $categorias->count();                                  //Cantidad total de categorias
        $max = (int) round($count_cat / $limit, 0, PHP_ROUND_HALF_DOWN);    //Divide el total con el limite a buscar, para un numero de paginas
        $ran = random_int(1, $max);                                        //Obtiene un int random para el numero de pagina a seleccionar
        // Devuelve categorias seguen el limite solicitado
        // Al ser random se necesita un minimo de registros si no existen devolvera los que encuentre
        $categorias->limit($limit)->page($ran);

        foreach ($categorias as $cat) {
            $cat->producto = $this->fetchTable('Producto')->find()->where(['categoria_id' => $cat->id_categoria])->limit(3)->order(['id' => 'DESC']);
        }
        return $categorias;
    }

    public function pedidoError()
    {
        $this->Flash->error("Ocurrió un error con su pedido.");
        $this->set("view_title", 'Error con el pedido');
    }

    public function pagarPedido($id = '')
    {
        if ($this->usuario_cookie && $this->usuario_cookie->pedido) {
            $id = $this->usuario_cookie->pedido->id_pedido;
        }
        $pedido =  $this->fetchTable('Pedido')->find()->where(['Pedido.id_pedido' => $id, 'Pedido.estado_orden' => 'NUEVO'])->contain(['DetallePedido'])->first();
        if (!$pedido) {
            return $this->redirect(['action' => 'pedidoError']);
        }
        $this->set('imagen_yape', $this->getConfiguracion('imagen_yape'));
        $this->set('imagen_plin', $this->getConfiguracion('imagen_plin'));
        $this->set('pedido', $pedido);
        $this->set("view_title", 'Pagar pedido');
    }

    public function loginWeb()
    {
        $this->Flash->error("No inicio sesión.");
        return $this->redirect(['controller' => 'web', 'action' => 'index']);
    }
    public function registroWeb()
    {
        $usuario = $this->fetchTable('Usuario')->newEmptyEntity();
        $this->set("usuario", $usuario);
        $this->set("view_title", 'Crear nueva contraseña');
    }
    public function libroReclamaciones()
    {
        $usuario = $this->fetchTable('Usuario')->newEmptyEntity();
        $this->set("usuario", $usuario);
        $this->set("view_title", 'Crear nueva contraseña');
    }

    public function miCuenta()
    {   
        if($this->request->is(["patch", "post"])) {
            var_dump($this->request);
            exit();
        }
        

        if (!$this->Authentication->getResult()->isValid()) {
            return $this->redirect(['controller' => 'web', 'action' => 'loginWeb']);
        }

        $usuario = $this->fetchTable('usuario')->find()->where(['id_usuario' => $this->usuario_sesion->id_usuario])->first();
        // $pedidos = $this->fetchTable('Pedido')->find()->where(['usuario_id' => $this->usuario_sesion->id_usuario, 'estado_orden != ' => 'NUEVO'])->limit(20);

        $this->set("usuario", $usuario);
        $this->set("view_title", 'Mi Cuenta');

    }

    public function editarCuenta() {
        if($this->request->is(["patch", "post", "put"])) {
            $data = $this->request->getData();
            $usuario = $this->fetchTable('usuario')->find()->where(['id_usuario' => $this->usuario_sesion->id_usuario])->first();
            $usuario = $this->fetchTable('usuario')->patchEntity($usuario, $data);
            if($this->fetchTable('usuario')->save($usuario)) {
                $this->Flash->success("Datos actualizados correctamente.");
                return $this->redirect(['controller' => 'web', 'action' => 'miCuenta']);
            }
            $this->Flash->error("Error al actualizar los datos.");
        }
    }
}
