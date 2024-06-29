<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DetallePedido Controller
 *
 * @property \App\Model\Table\DetallePedidoTable $DetallePedido
 * @method \App\Model\Entity\DetallePedido[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DetallePedidoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->verificarAdm();
    }
    public function index()
    {
        $detallePedido = $this->paginate($this->DetallePedido);

        $this->set(compact('detallePedido'));
    }

    /**
     * View method
     *
     * @param string|null $id Detalle Pedido id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $detallePedido = $this->DetallePedido->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('detallePedido'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $detallePedido = $this->DetallePedido->newEmptyEntity();
        if ($this->request->is('post')) {
            $detallePedido = $this->DetallePedido->patchEntity($detallePedido, $this->request->getData());
            if ($this->DetallePedido->save($detallePedido)) {
                $this->Flash->success(__('The detalle pedido has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The detalle pedido could not be saved. Please, try again.'));
        }
        $this->set(compact('detallePedido'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Detalle Pedido id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $detallePedido = $this->DetallePedido->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $detallePedido = $this->DetallePedido->patchEntity($detallePedido, $this->request->getData());
            if ($this->DetallePedido->save($detallePedido)) {
                $this->Flash->success(__('The detalle pedido has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The detalle pedido could not be saved. Please, try again.'));
        }
        $this->set(compact('detallePedido'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Detalle Pedido id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $detallePedido = $this->DetallePedido->get($id);
        if ($this->DetallePedido->delete($detallePedido)) {
            $this->Flash->success(__('The detalle pedido has been deleted.'));
        } else {
            $this->Flash->error(__('The detalle pedido could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
