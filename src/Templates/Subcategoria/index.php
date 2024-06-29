<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id_subcategoria', ['label' => 'Id']) ?></th>
                <th><?= $this->Paginator->sort('id_categoria', ['label' => 'Categoria']) ?></th>
                <th><?= $this->Paginator->sort('nom_subcategoria') ?></th>
                <th class="actions text-center"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subcategoria as $subcategorium): ?>
            <tr>
                <td><?= $this->Number->format($subcategorium->id_subcategoria) ?></td>
                <td>
                    <?= $subcategorium->categorium->nom_categoria ?>
                </td>
                <td><?= h($subcategorium->nom_subcategoria) ?></td>
                <td class="actions text-center" style="width:120px">
                    <div class="dropdown">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </a>
                        <ul class="dropdown-menu"  style="min-width: 130px; " >
                            <li>
                                <?= $this->Html->link(__('Detalles'), ['action' => 'view', $subcategorium->id_subcategoria] , ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $subcategorium->id_subcategoria], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $subcategorium->id_subcategoria], ['confirm' => __('Are you sure you want to delete # {0}?', $subcategorium->id_categoria) , 'class' => 'dropdown-item']) ?>
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
