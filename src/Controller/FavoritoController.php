<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;

/**
 * Favorito Controller
 *
 * @property \App\Model\Table\FavoritoTable $Favorito
 * @method \App\Model\Entity\Favorito[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FavoritoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['agregarFavorito']);
    }
    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);
        $this->verificarAdm();
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuario', 'Producto'],
        ];
        $favorito = $this->paginate($this->Favorito);

        $this->set(compact('favorito'));
    }
    public function view($id = null)
    {
        $favorito = $this->Favorito->get($id, [
            'contain' => ['Usuario', 'Producto'],
        ]);

        $this->set(compact('favorito'));
    }
    public function add()
    {
        $favorito = $this->Favorito->newEmptyEntity();
        if ($this->request->is('post')) {
            $favorito = $this->Favorito->patchEntity($favorito, $this->request->getData());
            if ($this->Favorito->save($favorito)) {
                $this->Flash->success(__('The favorito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The favorito could not be saved. Please, try again.'));
        }
        $usuario = $this->Favorito->Usuario->find('list', ['limit' => 200])->all();
        $producto = $this->Favorito->Producto->find('list', ['limit' => 200])->all();
        $this->set(compact('favorito', 'usuario', 'producto'));
    }
    public function edit($id = null)
    {
        $favorito = $this->Favorito->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $favorito = $this->Favorito->patchEntity($favorito, $this->request->getData());
            if ($this->Favorito->save($favorito)) {
                $this->Flash->success(__('The favorito has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The favorito could not be saved. Please, try again.'));
        }
        $usuario = $this->Favorito->Usuario->find('list', ['limit' => 200])->all();
        $producto = $this->Favorito->Producto->find('list', ['limit' => 200])->all();
        $this->set(compact('favorito', 'usuario', 'producto'));
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $favorito = $this->Favorito->get($id);
        if ($this->Favorito->delete($favorito)) {
            $this->Flash->success(__('The favorito has been deleted.'));
        } else {
            $this->Flash->error(__('The favorito could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function agregarFavorito(){
        $resp = [
            'success' => false,
            'data' => [],
            'message' => 'Inicie sesion para agregar favoritos'
        ];
        $producto_id = $this->request->getData('producto_id', '');
        if($this->usuario_sesion){
            $fav = $this->Favorito->find()->where(['producto_id' => $producto_id, 'usuario_id' => $this->usuario_sesion->id_usuario ])->first();
            if( !$fav ){
                $fav = $this->Favorito->newEntity([
                    'usuario_id' => $this->usuario_sesion->id_usuario ,
                    'producto_id' => $producto_id  ,
                    'fecha_publicacion' => date("Y-m-d H:i:s"),
                ]);
                $fav = $this->Favorito->save($fav);
            }
            $cantidad =  $this->Favorito->find()->where(['usuario_id' => $this->usuario_sesion->id_usuario ])->count();
            $resp = [
                'success' => true,
                'data' => $cantidad,
                'message' => 'Producto en favoritos'
            ];
        }
        return $this->response->withType('application/json')->withStringBody(json_encode($resp));
    }
}
