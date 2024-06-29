<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Categorium> $categoria
 */
?>
<div class="">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id_categoria') ?></th>
                <th><?= $this->Paginator->sort('nom_categoria') ?></th>
                <th class="actions text-center"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoria as $categorium): ?>
            <tr>
                <td><?= $this->Number->format($categorium->id_categoria) ?></td>
                <td><?= h($categorium->nom_categoria) ?></td>
                <td class="actions text-center" style="width:120px">
                    <div class="dropdown">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </a>
                        <ul class="dropdown-menu"  style="min-width: 130px">
                            <li>
                                <?= $this->Html->link(__('Detalles'), ['action' => 'view', $categorium->id_categoria] , ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $categorium->id_categoria], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $categorium->id_categoria], ['confirm' => __('Are you sure you want to delete # {0}?', $categorium->id_categoria) , 'class' => 'dropdown-item']) ?>
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

