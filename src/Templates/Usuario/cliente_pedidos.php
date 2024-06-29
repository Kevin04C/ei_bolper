<div>
    <h3> # <?= h($cliente->id_usuario) ?> | <?= h($cliente->nom_usuario) ?> </h3>
    <div class="text">
        <strong>Correo: </strong>
        <?= h($cliente->correo_usuario) ?>
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id_pedido', ['label' => 'Id']) ?></th>
                <th><?= $this->Paginator->sort('cantidad') ?></th>
                <th>Detalle</th>
                <th class="actions text-center"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedido as $ped): ?>
            <tr>
                <td><?= $this->Number->format($ped->id_pedido) ?></td>
                <td><?= $this->Number->format($ped->cantidad) ?></td>
                <td>
                    Fecha: <?= h($ped->fecha_orden) ?> <br>
                    Estado: <?= $pedido->estado_orden  ?> <br>
                    Total: $. <?= h($ped->total) ?> 
                </td>
                <td class="actions text-center" style="width:120px">
                    <div class="dropdown">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </a>
                        <ul class="dropdown-menu"  style="min-width: 130px">
                            <li>
                                <?= $this->Html->link(__('Detalles'), ['controller' => 'Pedido','action' => 'view', $ped->id_pedido] , ['class' => 'dropdown-item']) ?>
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
