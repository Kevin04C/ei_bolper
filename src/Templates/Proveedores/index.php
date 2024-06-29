
<div class="">
    <table class="table">
        <thead>
            <tr>
                <th> RUC </th>
                <th> Detalle </th>
                <th> Información </th>
                <th> Usuario </th>
                <th class="actions text-center"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proveedores as $proveedor): ?>
            <tr>
                <td><?= h($proveedor->ruc) ?></td>
                <td>
                    <div> <?= $proveedor->nombre_comercial ?> </div>
                    <div> <?= $proveedor->razon_social ?> </div>
                </td>
                <td>
                    <div> <?= $proveedor->telefono ?> </div>
                    <div> <?= $proveedor->correo ?> </div>
                </td>
                <td><?= $proveedor->usuario ? $proveedor->usuario->nom_usuario : '---' ?></td>
                <td class="actions text-center" style="width:120px">
                    <div class="dropdown">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </a>
                        <ul class="dropdown-menu"  style="min-width: 130px">
                            <li>
                                <?= $this->Html->link(__('Detalles'), ['action' => 'view', $proveedor->id] , ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $proveedor->id], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $proveedor->id], ['confirm' => __('Desea eliminar el proveedor # {0}?', $proveedor->id) , 'class' => 'dropdown-item']) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->element('paginador') ?>

