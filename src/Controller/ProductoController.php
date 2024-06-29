<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ProductoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->verificarAdm();
    }

    public function index()
    {
        $this->verificarAdm();
        $this->paginate = [
            'limit' => 10,
            'order' => ['id' => 'desc'],
            'contain' => ['Categoria']
        ];

        $categorias = $this->fetchTable('Categoria')->find('list', [
            'keyField' => 'id_categoria',
            'valueField' => 'nom_categoria'
        ]);
        $selectedCategoria = $this->request->getQuery('opt_categoria');

        // Obtener los productos filtrados seg��n las selecciones
        $productoQuery = $this->Producto->find();

        if (!empty($selectedCategoria)) {
            $productoQuery->where(['categoria_id' => $selectedCategoria]);
        }


        $producto = $this->paginate($productoQuery);

        $this->set(compact('producto', 'categorias', 'selectedCategoria'));
        $this->set('view_title', 'Productos');

        $top_links = [
            'title' => 'Productos',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-plus"></i> Nuevo Producto',
                    'params' => [
                        'action' => 'add'
                    ]
                ]
            ],
        ];

        $this->set('top_links', $top_links);
    }



    public function view($id = null)
    {
        $producto = $this->Producto->get($id, [
            'contain' => [
                'Categoria',
            ],
        ]);


        $this->set(compact('producto'));
        $this->set('view_title', 'Detalles de Producto');

        $top_links = [
            'title' => 'Detalles',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de Productos',
                    'params' => [
                        'action' => 'index'
                    ]
                ]
            ],
        ];

        $this->set('top_links', $top_links);
    }

    public function add()
    {
        $producto = $this->Producto->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $file1 = $this->subirArchivo($data['img_1'], uniqid(), 'img');
            $file2 = $this->subirArchivo($data['img_2'], uniqid(), 'img');
            $file3 = $this->subirArchivo($data['img_3'], uniqid(), 'img');

            $producto = $this->Producto->patchEntity($producto, $data);

            if ($file1 !== '') {
                $producto->imagen1 = $file1;
            }

            if ($file2 !== '') {
                $producto->imagen2 = $file2;
            }

            if ($file3 !== '') {
                $producto->imagen3 = $file3;
            }

            if ($this->Producto->save($producto)) {
                $this->Flash->success(__('El Producto ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Ocurrió un error, por favor inténtelo de nuevo.'));
        }

        $categorias = $this->fetchTable('Categoria')->find('list', [
            'keyField' => 'id_categoria',
            'valueField' => 'nom_categoria'
        ]);

        $proveedores = $this->fetchTable('Proveedores')->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre_comercial'
        ]);

        $this->set(compact('producto', 'categorias',  'proveedores'));
        $this->set('view_title', 'Nuevo Producto');

        $top_links = [
            'title' => 'Nuevo Producto',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de Productos',
                    'params' => [
                        'controller' => 'Producto', 'action' => 'index'
                    ]
                ]
            ],
        ];

        $this->set('top_links', $top_links);
    }

    public function edit($id = null)
    {
        $producto = $this->Producto->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $file1 = $this->subirArchivo($data['img_1'], uniqid(), 'img');
            $file2 = $this->subirArchivo($data['img_2'], uniqid(), 'img');
            $file3 = $this->subirArchivo($data['img_3'], uniqid(), 'img');

            $producto = $this->Producto->patchEntity($producto, $data);

            if ($file1 !== '') {
                @unlink(WWW_ROOT . $producto->imagen1);
                $producto->imagen1 = $file1;
            }

            if ($file2 !== '') {
                @unlink(WWW_ROOT . $producto->imagen2);
                $producto->imagen2 = $file2;
            }

            if ($file3 !== '') {
                @unlink(WWW_ROOT . $producto->imagen3);
                $producto->imagen3 = $file3;
            }

            if ($this->Producto->save($producto)) {
                $this->Flash->success(__('El Producto ha sido actualizado.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Ocurri�� un error, por favor int��ntelo de nuevo.'));
        }

        $categorias = $this->fetchTable('Categoria')->find('list', [
            'keyField' => 'id_categoria',
            'valueField' => 'nom_categoria'
        ]);

        $proveedores = $this->fetchTable('Proveedores')->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre_comercial'
        ]);

        $this->set(compact('producto', 'categorias', 'proveedores'));
        $this->set('view_title', 'Editar Producto');

        $top_links = [
            'title' => 'Editar Producto',
            'links' => [
                'btnNuevo' => [
                    'name' => '<i class="fa fa-fw fa-list"></i> Listado de Productos',
                    'params' => [
                        'controller' => 'Producto', 'action' => 'index'
                    ]
                ]
            ],
        ];

        $this->set('top_links', $top_links);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $producto = $this->Producto->get($id);

        if ($this->Producto->delete($producto)) {
            $this->Flash->success(__('El Producto ha sido eliminado.'));
        } else {
            $this->Flash->error(__('Ocurri�� un error, por favor int��ntelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
