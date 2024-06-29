<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Configuraciones Controller
 *
 * @property \App\Model\Table\ConfiguracionesTable $Configuraciones
 * @method \App\Model\Entity\Configuracione[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfiguracionesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->verificarAdm();
    }
    public function index()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $valor = date("Y-m-d H:i:s" , strtotime($data['fecha'] . " " . $data['hora']));

            $this->saveConfiguracion('fecha_oferta', $valor);
            $ruta = $this->subirArchivo( $data['adjunto'], uniqid() , 'img/config' );
            if($ruta != ''){
                $this->saveConfiguracion('imagen_promocion', $ruta);
            }
            $this->saveConfiguracion('whatsapp_soporte', $data['whatsapp_soporte'] ?? '' );
            $this->saveConfiguracion('whatsapp_ventas', $data['whatsapp_ventas'] ?? '' );

            $img_plin = $this->subirArchivo( $data['adjunto_plin'], uniqid() , 'img/config' );
            if($img_plin != ''){
                $this->saveConfiguracion('imagen_plin', $img_plin);
            }
            $img_yape = $this->subirArchivo( $data['adjunto_yape'], uniqid() , 'img/config' );
            if($img_yape != ''){
                $this->saveConfiguracion('imagen_yape', $img_yape);
            }

            $this->Flash->success(__('Datos actualizados.'));
            return $this->redirect(['action' => 'index']);
        }

        $top_links = [
            'title' => "Configurar Fecha de Oferta",
        ];
        
        $this->set("top_links", $top_links);
        $this->set("view_title", 'Configuraciones');

        try {
            $fecha_oferta = $this->getConfiguracion('fecha_oferta');
            $config_fecha = date("Y-m-d", strtotime($fecha_oferta)) ;
            $config_hora = date("H:i", strtotime($fecha_oferta)) ;
        } catch (\Throwable $th) {
            $config_fecha = date("Y-m-d");
            $config_hora = date("H:i");
        }

        $this->set('oferta_fecha',  $config_fecha );
        $this->set('oferta_hora', $config_hora );
        $this->set('imagen_promocion', $this->getConfiguracion('imagen_promocion'));
        $this->set('whatsapp_soporte', $this->getConfiguracion('whatsapp_soporte'));
        $this->set('whatsapp_ventas', $this->getConfiguracion('whatsapp_ventas'));
        $this->set('imagen_yape', $this->getConfiguracion('imagen_yape'));
        $this->set('imagen_plin', $this->getConfiguracion('imagen_plin'));

        
    }

    /**
     * View method
     *
     * @param string|null $id Configuracione id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $configuracione = $this->Configuraciones->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('configuracione'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $configuracione = $this->Configuraciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $configuracione = $this->Configuraciones->patchEntity($configuracione, $this->request->getData());
            if ($this->Configuraciones->save($configuracione)) {
                $this->Flash->success(__('The configuracione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The configuracione could not be saved. Please, try again.'));
        }
        $this->set(compact('configuracione'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Configuracione id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $configuracione = $this->Configuraciones->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $configuracione = $this->Configuraciones->patchEntity($configuracione, $this->request->getData());
            if ($this->Configuraciones->save($configuracione)) {
                $this->Flash->success(__('The configuracione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The configuracione could not be saved. Please, try again.'));
        }
        $this->set(compact('configuracione'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Configuracione id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configuracione = $this->Configuraciones->get($id);
        if ($this->Configuraciones->delete($configuracione)) {
            $this->Flash->success(__('The configuracione has been deleted.'));
        } else {
            $this->Flash->error(__('The configuracione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
