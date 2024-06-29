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
            <?php foreach ($usuario as $us): ?>
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
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $us->id_usuario], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $us->id_usuario], ['confirm' => __('Are you sure you want to delete # {0}?', $us->id_usuario) , 'class' => 'dropdown-item']) ?>
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