<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Subcategoria Controller
 *
 * @property \App\Model\Table\SubcategoriaTable $Subcategoria
 * @method \App\Model\Entity\Subcategorium[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubcategoriaController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->verificarAdm();
    }
    public function index()
    {
        $subcategoria = $this->paginate($this->Subcategoria, ['limit' => '10', 'contain' => ['Categoria']]);

        $this->set(compact('subcategoria'));
        $this->set('view_title', 'Sub Categorias');
        $top_links = [
            'title' => 'Subcategorias',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-plus"></i> Nueva Subcategoria',
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
     * @param string|null $id Subcategorium id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subcategoria = $this->Subcategoria->get($id, [
            'contain' => [ 'Categoria' ],
        ]);

        $this->set(compact('subcategoria'));
        $this->set('view_title', 'Detalles de Subcategoria');
        $top_links = [
            'title' => 'Detalle de la Subcategoria: ' . $subcategoria->nom_subcategoria  ,
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de Subcategorias',
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
        $subcategoria = $this->Subcategoria->newEmptyEntity();
        if ($this->request->is('post')) {
            $subcategoria = $this->Subcategoria->patchEntity($subcategoria, $this->request->getData());
            if ($this->Subcategoria->save($subcategoria)) {
                $this->Flash->success(__('La Subcategoría a sido guardada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error intente de nuevo.'));
        }
        $categorias = $this->fetchTable('Categoria')->find('list',[
            'keyField'      =>  'id_categoria',
            'valueField'    =>  'nom_categoria'
        ]);
        $this->set("categorias", $categorias);
        $this->set(compact('subcategoria'));
        $this->set('view_title', 'Nueva Sub Categoria');
        $top_links = [
            'title' => 'Nueva Subcategoria',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-plus"></i> Listado de Subcategorias',
                    'params' => [
                        'controller'    => 'Subcategoria', 'action' => 'index'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subcategorium id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subcategorium = $this->Subcategoria->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subcategorium = $this->Subcategoria->patchEntity($subcategorium, $this->request->getData());
            if ($this->Subcategoria->save($subcategorium)) {
                $this->Flash->success(__('La Subcategoría a sido actualizada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error intente de nuevo.'));
        }
        $categorias = $this->fetchTable('Categoria')->find('list',[
            'keyField'      =>  'id_categoria',
            'valueField'    =>  'nom_categoria'
        ]);
        $this->set("categorias", $categorias);
        $this->set(compact('subcategorium'));
        $this->set('view_title', 'Editar Subcategoria');
        $top_links = [
            'title' => 'Editar Subcategoria',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-plus"></i> Listado de Subcategorias',
                    'params' => [
                        'controller'    => 'Subcategoria', 'action' => 'index'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subcategorium id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subcategorium = $this->Subcategoria->get($id);
        if ($this->Subcategoria->delete($subcategorium)) {
            $this->Flash->success(__('La Subcategoría a sido eliminada.'));
        } else {
            $this->Flash->error(__('Ocurrió un error intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getAll(){
       
        $resp = [
            'success' => false,
            'data' => [],
            'message' => 'Inicie sesion primero'
        ];
        $sub = $this->Subcategoria->find();
        $opt_categoria = $this->request->getQuery('opt_categoria', '');
        if($opt_categoria != ''){
            $sub = $sub->andWhere(['id_categoria' => $opt_categoria]);
        }
        $resp = [
            'success' => true,
            'data' => $sub,
            'message' => ''
        ];
        return $this->response->withType('application/json')->withStringBody(json_encode($resp));
    }
}
