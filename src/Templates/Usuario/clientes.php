<form id="form_filtro">
    <div class="row">
        <div class="col-md-7">
            <?= $this->Form->control('opt_nombres', ['label' => 'Nombres', 'class' => 'form-control form-control-sm' ,'value' => $opt_nombres ?? ''] ) ?>
        </div>
        <div class="col-md">
                <!-- ENVOLVERLO DENTRO DE UN <? ?>  PARA QUE FUNCIONE DE NUEVO-->
                 <!-- $this->Form->control('opt_tipo' , ['label' => 'Tipo', 'class' => 'form-select form-select-sm', 'options' => ['DESCONOCIDO' => 'DESCONOCIDO', 'CLIENTE' => 'CLIENTE'] , 'empty' => '-Seleccione-' ,'value' => $opt_tipo ?? ''] )  -->
        </div>
        <div class="col-md-3" style="max-width:240px">
            <br>
            <?= $this->Form->button( '<i class="fa fa-search"></i> Buscar', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
            <?= $this->Form->button( '<i class="fa fa-eraser"></i> Limpiar', ['class' => 'btn btn-danger btn-sm' , 'escapeTitle' => false , 'id' => 'btn_limpiar' , 'type' => 'button' ]) ?>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id_usuario') ?></th>
                <th><?= $this->Paginator->sort('nom_usuario') ?></th>
                <th><?= $this->Paginator->sort('correo_usuario') ?></th>
                <th><?= $this->Paginator->sort('telef_usuario') ?></th>
                <th><?= $this->Paginator->sort('departamento') ?></th>
                <th><?= $this->Paginator->sort('codigo_postal') ?></th>
                <th><?= $this->Paginator->sort('tipo') ?></th>
                <th><?= $this->Paginator->sort('created',['label' => 'F. Creación']) ?></th>
                <th class="actions text-center"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $us): ?>
            <tr>
                <td><?= $this->Number->format($us->id_usuario) ?></td>
                <td><?= h($us->nom_usuario) ?></td>
                <td><?= h($us->correo_usuario) ?></td>
                <td><?= $this->Number->format($us->telef_usuario) ?></td>
                <td><?= h($us->departamento) ?></td>
                <td><?= $this->Number->format($us->codigo_postal) ?></td>
                <td><?= h($us->tipo) ?></td>
                <td>
                    <?php try { echo $us->fecha_creacion->format("d-m-Y H:i"); } catch (\Throwable $th) {} ?>        
                </td>
                <td class="actions text-center" style="width:120px">
                    <div class="dropdown">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </a>
                        <ul class="dropdown-menu"  style="min-width: 130px" >
                            <li>
                                <?= $this->Html->link(__('Ver Pedidos'), ['action' => 'cliente-pedidos', $us->id_usuario], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $us->id_usuario , 'cliente'], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $us->id_usuario, 'cliente'], ['confirm' => __('Are you sure you want to delete # {0}?', $us->id_usuario) , 'class' => 'dropdown-item']) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->element('paginador') ?>
</div>