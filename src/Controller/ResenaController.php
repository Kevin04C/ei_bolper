<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Resena Controller
 *
 * @property \App\Model\Table\ResenaTable $Resena
 * @method \App\Model\Entity\Resena[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResenaController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->verificarAdm();
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Producto'],
        ];
        $resena = $this->paginate($this->Resena);

        $this->set(compact('resena'));
    }

    /**
     * View method
     *
     * @param string|null $id Resena id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resena = $this->Resena->get($id, [
            'contain' => ['Producto'],
        ]);

        $this->set(compact('resena'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resena = $this->Resena->newEmptyEntity();
        if ($this->request->is('post')) {
            $resena = $this->Resena->patchEntity($resena, $this->request->getData());
            if ($this->Resena->save($resena)) {
                $this->Flash->success(__('The resena has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resena could not be saved. Please, try again.'));
        }
        $producto = $this->Resena->Producto->find('list', ['limit' => 200])->all();
        $this->set(compact('resena', 'producto'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Resena id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resena = $this->Resena->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resena = $this->Resena->patchEntity($resena, $this->request->getData());
            if ($this->Resena->save($resena)) {
                $this->Flash->success(__('The resena has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resena could not be saved. Please, try again.'));
        }
        $producto = $this->Resena->Producto->find('list', ['limit' => 200])->all();
        $this->set(compact('resena', 'producto'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Resena id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resena = $this->Resena->get($id);
        if ($this->Resena->delete($resena)) {
            $this->Flash->success(__('The resena has been deleted.'));
        } else {
            $this->Flash->error(__('The resena could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
