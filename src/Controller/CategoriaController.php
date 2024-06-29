<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Categoria Controller
 *
 * @property \App\Model\Table\CategoriaTable $Categoria
 * @method \App\Model\Entity\Categorium[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriaController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->verificarAdm();
    }
    public function index()
    {
        $categoria = $this->paginate($this->Categoria, ['limit' => '10']);

        $this->set(compact('categoria'));
        $this->set('view_title', 'Categorias');
        $top_links = [
            'title' => 'Categorias',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-plus"></i> Nueva Categoria',
                    'params' => [
                        'action'    => 'add'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    /**
     * View method
     *
     * @param string|null $id Categorium id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoria = $this->Categoria->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('categoria'));
        $this->set('view_title', 'Detalles de categoria');
        $top_links = [
            'title' => 'Detalle de la Categoria: ' . $categoria->nom_categoria  ,
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de Categorias',
                    'params' => [
                        'action'    => 'index'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoria = $this->Categoria->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $categoria = $this->Categoria->patchEntity($categoria, $this->request->getData());
            $file1 = $this->subirArchivo( $data['img_1'], uniqid() , 'categoria' );
            if($file1 != ''){
                $categoria->ruta_imagen = $file1;
            }
            if ($this->Categoria->save($categoria)) {
                $this->Flash->success(__('La categoría a sido guardada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrio un error, intente de nuevo.'));
        }
        $this->set(compact('categoria'));
        $this->set('view_title', 'Nueva Categorias');
        $top_links = [
            'title' => 'Categorias',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado',
                    'params' => [
                        'controller'    => 'Categoria', 'action' => 'index'

                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categorium id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categoria = $this->Categoria->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $file1 = $this->subirArchivo( $data['img_1'], uniqid() , 'categoria' );
            if($file1 != ''){
                $categoria->ruta_imagen = $file1;
            }
            $categoria = $this->Categoria->patchEntity($categoria, $this->request->getData());
            if ($this->Categoria->save($categoria)) {
                $this->Flash->success(__('La categoría a sido actualizada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrio un error, intente de nuevo.'));
        }
        $this->set(compact('categoria'));
        $this->set('view_title', 'Editar categoria');
        $top_links = [
            'title' => 'Editar categoria',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado',
                    'params' => [
                        'controller'    => 'Categoria', 'action' => 'index'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    /**
     * Delete method
     *
     * @param string|null $id Categorium id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoria = $this->Categoria->get($id);
        if ($this->Categoria->delete($categoria)) {
            $this->Flash->success(__('La categoría a sido eliminada.'));
        } else {
            $this->Flash->error(__('Ocurrio un error, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
