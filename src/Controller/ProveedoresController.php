<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Proveedores Controller
 *
 * @property \App\Model\Table\ProveedoresTable $Proveedores
 * @method \App\Model\Entity\Proveedore[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProveedoresController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
    }

    
    public function index()
    {   
        $this->verificarAdm();
        $proveedores = $this->paginate($this->Proveedores ,['limit' => '10', 'contain' => ['Usuario']]);

        $top_links = [
            'title' => 'Proveedores',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-plus"></i> Nuevo Proveedor',
                    'params' => [
                        'action'    => 'add'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);

        $this->set(compact('proveedores'));
        $this->set('view_title', 'Proveedores');
    }

    public function view($id = null)
    {
        $this->verificarAdm();

        $proveedor = $this->Proveedores->get($id, [
            'contain' => ['Usuario'],
        ]);

        $this->set(compact('proveedor'));
        $this->set('view_title', 'Detalles del Proveedor');
        $top_links = [
            'title' => 'Detalle del Proveedor: ' . $proveedor->nombre_comercial  ,
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de Proveedores',
                    'params' => [
                        'action'    => 'index'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    public function add()
    {
        $this->verificarAdm();
        $proveedor = $this->Proveedores->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $validate = $this->validateFileds($data);
            if(!$validate['success']){
                $us = $data['correo_usuario'] ?? '';
                $user_exist = $this->fetchTable('Usuario')->find()->where(['correo_usuario' => $us])->first();
                if($user_exist){
                    $this->Flash->error(__('Ese correo de usuario ya existe.'));
                }else{
                    $proveedor = $this->Proveedores->patchEntity($proveedor, $this->request->getData());
                    $proveedor = $this->Proveedores->save($proveedor);
                    if ( $proveedor ) {
                        $user_prov = $this->fetchTable('Usuario')->newEmptyEntity();
                        $user_prov->nom_usuario = $data['nom_usuario'] ?? '';
                        $user_prov->correo_usuario = $data['correo_usuario'] ?? '';
                        $user_prov->contrasena = $data['contrasena'] ?? '';
                        $user_prov->tipo = 'PROVEEDOR';
                        $user_prov = $this->fetchTable('Usuario')->save($user_prov);
                        if($user_prov){
                            $proveedor->usuario_id = $user_prov->id_usuario;
                            $proveedor = $this->Proveedores->save($proveedor);
                            $this->Flash->success(__('El proveedor a sido guardado.'));
                            return $this->redirect(['action' => 'index']);
                        }
                        $this->Proveedores->delete($proveedor);
                    }
                    $this->Flash->error(__('Ocurrio un error, intente de nuevo.'));
                }
            }else{
                $this->Flash->error(__('Campos sin llenar, '. $validate['msg'] ));
            }
        }
        $this->set(compact('proveedor'));
        $this->set('view_title', 'Nuevo Proveedor');
        $top_links = [
            'title' => 'Nuevo Proveedor',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado',
                    'params' => [
                        'controller'    => 'proveedores', 'action' => 'index'

                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    public function edit($id = null)
    {
        $this->verificarAdm();

        $proveedor = $this->Proveedores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $proveedor = $this->Proveedores->patchEntity($proveedor, $this->request->getData());
            if ($this->Proveedores->save($proveedor)) {
                $this->Flash->success(__('El proveedor a sido actualizado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrio un error, intente de nuevo.'));
        }

        $this->set(compact('proveedor'));
        $this->set('view_title', 'Editar proveedor');
        $top_links = [
            'title' => 'Editar proveedor',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado',
                    'params' => [
                        'controller'    => 'proveedores', 'action' => 'index'
                    ],

                ]
            ],
        ];
        $this->set('top_links', $top_links);
    }

    public function delete($id = null)
    {
        $this->verificarAdm();
        $this->request->allowMethod(['post', 'delete']);
        $proveedore = $this->Proveedores->get($id);
        if ($this->Proveedores->delete($proveedore)) {
            $user = $this->fetchTable('Usuario')->find()->where(['id_usuario' => $proveedore->usuario_id])->first();
            $this->fetchTable('Usuario')->delete($user);
            $this->Flash->success(__('Proveedor eliminado.'));
        } else {
            $this->Flash->error(__('El proveedor no se puede eliminar. Intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    protected function validateFileds ($data) {
        if ($data === null) {
            $data = $this->request->getData();
        }
        $keys = [
            'nombre_comercial' => 'Nombre comercial',
            'nom_usuario' => 'Nombres de usuario',
            'correo_usuario' => 'Correo de usuario',
            'contrasena' => 'Contraseña',
        ];
        $flag = false;
        $key_label = '';
        foreach ($keys as $key => $val) {
            if (!isset($data[$key]) || $data[$key] == '') {
                $flag = true;
                $key_label = $val;
                break;
            }
        }
        return [ 'success' => $flag, 'msg' => $key_label ];
    }

    public function productosListado(){
        $this->verificarProv();
        $proveedor = $this->Proveedores->find()->where(['usuario_id' => $this->usuario_sesion->id_usuario])->first();
        
        $categorias = $this->fetchTable('Categoria')->find('list', [
            'keyField' => 'id_categoria',
            'valueField' => 'nom_categoria'
        ]);

        $selectedCategoria = $this->request->getQuery('opt_categoria');
        $productos = $this->fetchTable('Producto')->find()->where(['proveedor_id' => $proveedor ? $proveedor->id : -1 ]);

        if (!empty($selectedCategoria)) {
            $productos = $productos->andWhere(['categoria_id' => $selectedCategoria]);
        }

        $productos = $this->paginate($productos, ['order' => ['id' => 'desc'],
            'contain' => ['Categoria']
        ]);
        $this->set(compact('categorias', 'selectedCategoria'));

        $top_links = [
            'title' => 'Mis productos',
            'links' => [
            ],
        ];
        $this->set('top_links', $top_links);

        $this->set(compact('productos'));
        $this->set('view_title', 'Proveedores');
    }
}
