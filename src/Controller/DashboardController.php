<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Dashboard Controller
 *
 * @method \App\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $detallePedidoTable = TableRegistry::getTableLocator()->get('DetallePedido');
        

        $query = $detallePedidoTable->find();
        $query->select([
            'producto_id',
            'producto_nombre',
            'total_vendido' => $query->func()->sum('pedido_cantidad')
        ])
            ->innerJoinWith('Pedido', function ($q) {
                return $q->where(['Pedido.estado_orden IN' => ['ENTREGADO', 'PAGADO']]);
            })
            ->group(['producto_id', 'producto_nombre'])
            ->order(['total_vendido' => 'DESC'])
            ->limit(3);

        $productosMasVendidos = $query->toArray();
        $clientesQueMasHanComprado = $this->clientesQueMasHanComprado();  
        // debug($productosMasVendidos);

        $this->set(compact('productosMasVendidos'));
    }

    /**
     * View method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dashboard = $this->Dashboard->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('dashboard'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dashboard = $this->Dashboard->newEmptyEntity();
        if ($this->request->is('post')) {
            $dashboard = $this->Dashboard->patchEntity($dashboard, $this->request->getData());
            if ($this->Dashboard->save($dashboard)) {
                $this->Flash->success(__('The dashboard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard could not be saved. Please, try again.'));
        }
        $this->set(compact('dashboard'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dashboard = $this->Dashboard->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dashboard = $this->Dashboard->patchEntity($dashboard, $this->request->getData());
            if ($this->Dashboard->save($dashboard)) {
                $this->Flash->success(__('The dashboard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard could not be saved. Please, try again.'));
        }
        $this->set(compact('dashboard'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dashboard = $this->Dashboard->get($id);
        if ($this->Dashboard->delete($dashboard)) {
            $this->Flash->success(__('The dashboard has been deleted.'));
        } else {
            $this->Flash->error(__('The dashboard could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function clientesQueMasHanComprado() {
        // Obtener instancias de los modelos necesarios
        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido');
        $usuarioTable = TableRegistry::getTableLocator()->get('Usuario');

        // Crear la consulta personalizada
        $query = $pedidoTable->find();
        $query->select([
                'usuario_id',
                'nom_usuario' => 'Usuario.nom_usuario',
                'total' => $query->func()->count('*')
            ])
            ->innerJoinWith('Usuario')
            ->where(['Usuario.tipo' => 'CLIENTE'])
            ->group(['usuario_id', 'Usuario.nom_usuario'])
            ->order(['total' => 'DESC'])
            ->limit(3);

        // Ejecutar la consulta y obtener los resultados
        $resultados = $query->toArray();
        return $resultados;
    }
}
