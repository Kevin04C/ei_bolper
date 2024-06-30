<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;

/**
 * Admin Controller
 *
 * @property \App\Model\Table\AdminTable $Admin
 * @method \App\Model\Entity\Admin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailController extends AppController
{
    private $from_Email = "Tiendaeibolper@gmail.com";
    private $from_Name = "ei bolper";
    public function initialize(): void
    {
        parent::initialize();
    }

    public function enviarClienteNuevo($usuario = null, $clave = '')
    {
        try {
            $email = new Mailer("default");
            $email->setFrom($this->from_Email, $this->from_Name);
            $email->viewBuilder()
                ->setTemplate("correo_nuevo_cliente")
                ->setLayout("default");

            $email->setTo($usuario->correo_usuario)
                ->setSubject("Hola {$usuario->nom_usuario}, se registró correctamente a Ei Bolper")
                ->setEmailFormat('html')
                ->setViewVars([
                    'usuario'     =>  $usuario,
                    'clave'       =>  $clave
                ])
                ->setAttachments([
                    'logo.png' => [
                        'file' => WWW_ROOT . "public/logo_blanco.png",
                        'mimetype' => 'image/png',
                        'contentId' => 'logo'
                    ]
                ])
                //->setAttachments($files)

                ->deliver();

                return $email;
        } catch (\Throwable $th) {
            //throw $th;
            // retornarmos el mensaje
            return $th->getMessage();
        }
    }
    public function enviarUsuarioNuevo($usuario = null, $clave = '')
    {
        try {
            $email = new Mailer("default");
            $email->setFrom($this->from_Email, $this->from_Name);
            $email->viewBuilder()
                ->setTemplate("correo_nuevo_usuario")
                ->setLayout("default");

            $email->setTo($usuario->correo_usuario)
                ->setSubject("Hola {$usuario->nom_usuario}, bienvenido a la familia Ei Bolper")
                ->setEmailFormat('html')
                ->setViewVars([
                    'usuario'     =>  $usuario,
                    'clave'       =>  $clave
                ])
                ->setAttachments([
                    'logo.png' => [
                        'file' => WWW_ROOT . "public/logo_blanco.png",
                        'mimetype' => 'image/png',
                        'contentId' => 'logo'
                    ]
                ])
                //->setAttachments($files)
                ->deliver();

                return $email;
        } catch (\Throwable $th) {
            // retornarmos el mensaje
            return $th->getMessage();
            //throw $th;
        }
    }
    public function confirmarPedidoUsuario($pedido_id = '')
    {
        try {
            $pedido_obj =  $this->fetchTable('Pedido')->find()->where(['id_pedido' => (int)$pedido_id])->first();
            if ($pedido_obj) {
                $detalles = $this->fetchTable('DetallePedido')->find()->where(['pedido_id' => $pedido_obj->id_pedido])->contain(['Producto']);
                $email = new Mailer("default");
                $email->setFrom($this->from_Email, $this->from_Name);
                $email->viewBuilder()
                    ->setTemplate("correo_pedido_confirmado")
                    ->setLayout("default");

                $email
                    ->setTo($pedido_obj->cliente_correo)
                    ->setSubject("Confirmación de Pedido")
                    ->setEmailFormat('html')
                    ->setViewVars([
                        'pedido'     =>  $pedido_obj,
                        'detalles'     =>  $detalles,
                    ])
                    ->setAttachments([
                        'logo.png' => [
                            'file' => WWW_ROOT . "public/logo_blanco.png",
                            'mimetype' => 'image/png',
                            'contentId' => 'logo'
                        ]
                    ])
                    ->deliver();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function confirmarEntregaPedido($pedido_id = '')
    {
        try {
            $pedido_obj =  $this->fetchTable('Pedido')->find()->where(['id_pedido' => (int)$pedido_id])->first();
            if ($this->usuario_sesion && $pedido_obj) {
                $detalles = $this->fetchTable('DetallePedido')->find()->where(['pedido_id' => $pedido_obj->id_pedido])->contain(['Producto']);
                $email = new Mailer("default");
                $email->setFrom($this->from_Email, $this->from_Name);
                $email->viewBuilder()
                    ->setTemplate("correo_pedido_entregado")
                    ->setLayout("default");

                $email
                    ->setTo($pedido_obj->cliente_correo)
                    // ->setCc( $this->usuario_sesion->correo_usuario )
                    ->setSubject("Confirmación de entrega del Pedido")
                    ->setEmailFormat('html')
                    ->setViewVars([
                        'pedido'     =>  $pedido_obj,
                        'detalles'     =>  $detalles,
                    ])
                    ->setAttachments([
                        'logo.png' => [
                            'file' => WWW_ROOT . "public/logo_blanco.png",
                            'mimetype' => 'image/png',
                            'contentId' => 'logo'
                        ]
                    ])
                    ->setAttachments([
                        'factura.pdf' => [
                            'file' => WWW_ROOT . $pedido_obj->ruta_adjunto,
                            'mimetype' => 'application/pdf',
                            'contentId' => 'factura'
                        ]
                    ])
                    ->deliver();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function envioCodigoRecuperacion($url_cod = '', $correo_destino = '' , $usuario)
    {
        try {

            if ($url_cod != '' && $correo_destino != '') {
                $email = new Mailer("default");
                $email->setFrom($this->from_Email, $this->from_Name);
                $email->viewBuilder()
                    ->setTemplate("correo_recuperar_clave")
                    ->setLayout("default");

                $email
                    ->setTo($correo_destino)
                    ->setSubject("Recuperar contraseña")
                    ->setEmailFormat('html')
                    ->setViewVars([
                        'url_cod'     =>  $url_cod,
                        'usuario'     =>  $usuario,
                    ])
                    ->setAttachments([
                        'logo.png' => [
                            'file' => WWW_ROOT . "public/logo_blanco.png",
                            'mimetype' => 'image/png',
                            'contentId' => 'logo'
                        ]
                    ])
                    ->deliver();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function envioNuevaClave($clave = '', $usuario = null)
    {
        try {
            if ($usuario && $clave != '') {
                $email = new Mailer("default");
                $email->setFrom($this->from_Email, $this->from_Name);
                $email->viewBuilder()
                    ->setTemplate("correo_nueva_clave")
                    ->setLayout("default");

                $email
                    ->setTo($usuario->correo_usuario)
                    ->setSubject("Nueva contraseña")
                    ->setEmailFormat('html')
                    ->setViewVars([
                        'clave'     =>  $clave,
                        'usuario'     =>  $usuario,
                    ])
                    ->setAttachments([
                        'logo.png' => [
                            'file' => WWW_ROOT . "public/logo_blanco.png",
                            'mimetype' => 'image/png',
                            'contentId' => 'logo'
                        ]
                    ])
                    ->deliver();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function envioLibroReclamacion($data){
        try {
            $email = new Mailer("default");
            $email->setFrom($this->from_Email, $this->from_Name);
            $email->viewBuilder()
                ->setTemplate("correo_libro_reclamaciones")
                ->setLayout("default");
            $email
                ->setTo($this->from_Email)
                ->setSubject("Libro de Reclamaciones")
                ->setEmailFormat('html')
                ->setViewVars([
                    'data'     =>  $data
                ])
                ->setAttachments([
                    'logo.png' => [
                        'file' => WWW_ROOT . "public/logo_blanco.png",
                        'mimetype' => 'image/png',
                        'contentId' => 'logo'
                    ]
                ])
                ->deliver();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
