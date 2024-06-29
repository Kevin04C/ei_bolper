<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Http\Cookie\CookieCollection;
use Cake\Http\Cookie\Cookie;
class AppController extends Controller
{
    public $usuario_sesion = null;
    protected $usuario_cookie = null;
    protected $cookies = null;
    protected $oferta_activa = false;
    public function initialize(): void
    {
        parent::initialize();
        $this->cookies = new CookieCollection([]);
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->usuario_sesion = $this->Authentication->getIdentity();
        $this->setConfiguraciones();
    }
    public function beforeFilter(EventInterface $event)
    {
        $this->cargarCookieUsuarioSesion();
        return parent::beforeFilter($event);
    }

    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);
        $this->loadTemplateFiles();
        $this->set("usuario_sesion", $this->usuario_sesion);        
    }
    protected function loadTemplateFiles()
    {
        $controller = $this->request->getParam("controller");
        $action = $this->request->getParam("action");
        if (!$action){
            return false;
        }
        $action = \Cake\Utility\Inflector::underscore($action);
        $script_filepath = APP;
        $script_filepath = $script_filepath . "Templates" . DS . $controller . DS . $action . ".js";
        $styles_filepath = APP;
        $styles_filepath = $styles_filepath . "Templates" . DS . $controller . DS . $action . ".css";

        $script = file_exists($script_filepath) ? file_get_contents($script_filepath) : "";
        $styles = file_exists($styles_filepath) ? file_get_contents($styles_filepath) : "";

        $this->set("script", $script);
        $this->set("styles", $styles);
    }
    public function subirArchivo($uploaded, $nombre, $myfolder)
    {
        try {
            if ($uploaded->getError() == 0) {
                $ext = pathinfo($uploaded->getClientFilename(), PATHINFO_EXTENSION);
                $ruta = WWW_ROOT . $myfolder;
                if (!is_dir($ruta)){ mkdir($ruta); chmod($ruta, 0777);  }
                $full_file_path = $ruta . "/" . $nombre . '.' . $ext;
                $uploaded->moveTo($full_file_path);
                return   $myfolder . "/" . $nombre . '.' . $ext;
            } else {
                return "";
            }
        } catch (\Throwable $e) {
            return "";
        }
    }
    protected function cargarCookieUsuarioSesion(){
        try {
            $id_usuario = '';
            if($this->usuario_sesion){
                $id_usuario = $this->usuario_sesion->id_usuario;
            }else{
                if(isset($_COOKIE['usuario_cookie']) ){
                    $user_json = json_decode($_COOKIE['usuario_cookie']);
                    if($user_json){
                        $id_usuario = $user_json->id_usuario;
                    }
                }
            }
        } catch (\Throwable $th) {
            $id_usuario = '';
        }

        $usuario_data = $this->getUsuarioCookie($id_usuario);

        $cookie = (new Cookie('usuario_cookie'))
            ->withValue( $usuario_data )
            ->withExpiry(new \DateTime('+1 month'))
            ->withPath('/')
            ->withDomain($_SERVER['SERVER_NAME'])
            ->withSecure(false)
            ->withHttpOnly(true);
        $this->cookies = $this->cookies->add($cookie);
        
        if($this->cookies->has('usuario_cookie')){
            $cookie = $this->cookies->get('usuario_cookie');
            $this->set('user_cookie', $cookie->getValue());
        }
    }
    private function getUsuarioCookie($id_usuario = ''){
        $usuario_registro = $this->fetchTable('Usuario')->find()->where(['Usuario.id_usuario' =>  (int) $id_usuario ])->first();
        // if($usuario_registro && $usuario_registro->tipo != 'DESCONOCIDO' && !$this->usuario_sesion ){
        //     $usuario_registro = null;
        // }
        // // if($usuario_registro->tipo != 'DESCONOCIDO' && !$this->usuario_sesion ){
        // //     $usuario_registro = null;
        // // }
        if(!$usuario_registro){
            $usuario_registro = $this->fetchTable('Usuario')->newEntity([
                'nom_usuario' => 'Desconocido',
                'tipo' => 'DESCONOCIDO',
                'fecha_creacion' => date("Y-m-d H:i:s"),
                'fecha_actualizacion' => date("Y-m-d H:i:s"),
            ]);
            $usuario_registro = $this->fetchTable('Usuario')->save($usuario_registro); 
            $usuario_for_cookie = [
                'id_usuario' => $usuario_registro->id_usuario,
                'nombre' => $usuario_registro->nom_usuario,
            ];
            setcookie("usuario_cookie", json_encode([]), time() - 3600, '/' , $_SERVER['SERVER_NAME']);
            setcookie('usuario_cookie', json_encode($usuario_for_cookie) , time() + 2592000, '/' , $_SERVER['SERVER_NAME']);
        }
        $pedido = $this->fetchTable('Pedido')->find()->where(['Pedido.usuario_id' =>  (int) $usuario_registro->id_usuario, 'Pedido.estado_orden' => 'NUEVO' ])->order(['Pedido.modified' => 'desc'])->contain(['DetallePedido' => ['Producto']])->first();
        $usuario_registro->pedido = $pedido;
        $this->usuario_cookie = $usuario_registro;
        return $usuario_registro;
    }
    protected function actualizarUsuarioCookie($usuario){
        if(!$usuario){
            return false;
        }
        $usuario_for_cookie = [
            'id_usuario' => $usuario->id_usuario,
            'nombre' => $usuario->nom_usuario,
        ];
        setcookie("usuario_cookie", json_encode([]), time() - 3600, '/' , $_SERVER['SERVER_NAME']);
        setcookie('usuario_cookie', json_encode($usuario_for_cookie) , time() + 2592000, '/' , $_SERVER['SERVER_NAME']);
        $usuario->pedido = null;
        $cookie = (new Cookie('usuario_cookie'))
            ->withValue( $usuario )
            ->withExpiry(new \DateTime('+1 month'))
            ->withPath('/')
            ->withDomain($_SERVER['SERVER_NAME'])
            ->withSecure(false)
            ->withHttpOnly(true);
        $this->cookies = $this->cookies->add($cookie);
    }

    protected function getConfiguracion($name = ''){
        $var = $this->fetchTable('Configuraciones')->find()->where(['varname' => $name ])->first();
        if(!$var){
            $var = $this->fetchTable('Configuraciones')->newEntity([ 'varname' => $name , 'varvalue' => '' ]);
            $var = $this->fetchTable('Configuraciones')->save($var);
        }
        return $var ? $var->varvalue : '';
    }
    protected function saveConfiguracion($name = '' , $value = ''){
        $var = $this->fetchTable('Configuraciones')->find()->where(['varname' => $name ])->first();
        if(!$var){
            $var = $this->fetchTable('Configuraciones')->newEntity([ 'varname' => $name ]);
        }
        $var->varvalue = $value;
        $var = $this->fetchTable('Configuraciones')->save($var);
        return $var ? $var->varvalue : '';
    }
    protected function setConfiguraciones (){
        try {
            $fecha_oferta = $this->getConfiguracion('fecha_oferta');
            if(strtotime($fecha_oferta) > strtotime(date("Y-m-d H:i:s"))){
                $this->oferta_activa = true;
            }else{
                $this->oferta_activa = false;
            }
        } catch (\Throwable $th) {
            $this->oferta_activa = false;
        }
        
        $this->set("oferta_activa", $this->oferta_activa);
        $this->set("imagen_promocion", $this->getConfiguracion('imagen_promocion'));
        $this->set("whatsapp_soporte", $this->getConfiguracion('whatsapp_soporte'));
        $this->set("whatsapp_ventas", $this->getConfiguracion('whatsapp_ventas'));
    }
    /**
     * Funcion que verifica si el usuario en sesion es ADM si no lo es redirecciona al INDEX de la Web
     * Si el controller no tiene vista sin autenticacion se llama en el initializa
     * Si el controller tiene vistas para consultas ajax se llama en el beforeRenderer
     * Si el controller tiene vistas que se renderizaran (usuario/login) estara al inicio de cada funcion del controller 
     * que no necesite validacion, login, logout;
     */
    protected function verificarAdm(){
        if($this->usuario_sesion && $this->usuario_sesion->tipo != 'ADM'){
            return $this->redirect(['controller'=> 'web', 'action' => 'index']);
        }
    }
    protected function verificarProv(){
        if( !$this->usuario_sesion || !($this->usuario_sesion->tipo == 'PROVEEDOR')){
            return $this->redirect(['controller'=> 'web', 'action' => 'index']);
        }
    }
    protected function verificarSesion(){
        if( $this->usuario_sesion && ($this->usuario_sesion->tipo != 'PROVEEDOR' && $this->usuario_sesion->tipo != 'ADM')){
            return $this->redirect(['controller'=> 'web', 'action' => 'index']);
        }
    }
    /**
     * 
     */
    protected function asignarPedidoUsuarioSesion($pedido_id = ''){
        $pedido = $this->fetchTable('Pedido')->find()->where(['id_pedido' => $pedido_id , 'estado_orden' => 'NUEVO'])->first();
        if($pedido && $this->usuario_sesion){
            $pedido->usuario_id = $this->usuario_sesion->id_usuario;
            // $pedido->usuario_id = $this->usuario_sesion->id_usuario;
            $pedido = $this->fetchTable('Pedido')->save($pedido);
        }
    }
}
