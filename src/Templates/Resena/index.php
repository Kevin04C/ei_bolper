<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Resena> $resena
 */
?>
<div class="resena index content">
    <?= $this->Html->link(__('New Resena'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Resena') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id_resena') ?></th>
                    <th><?= $this->Paginator->sort('producto_id') ?></th>
                    <th><?= $this->Paginator->sort('calidad') ?></th>
                    <th><?= $this->Paginator->sort('valor') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('resumen') ?></th>
                    <th><?= $this->Paginator->sort('fecha_revision') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resena as $resena): ?>
                <tr>
                    <td><?= $this->Number->format($resena->id_resena) ?></td>
                    <td><?= $resena->has('producto') ? $this->Html->link($resena->producto->id, ['controller' => 'Producto', 'action' => 'view', $resena->producto->id]) : '' ?></td>
                    <td><?= $this->Number->format($resena->calidad) ?></td>
                    <td><?= $this->Number->format($resena->valor) ?></td>
                    <td><?= h($resena->nombre) ?></td>
                    <td><?= h($resena->resumen) ?></td>
                    <td><?= h($resena->fecha_revision) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $resena->id_resena]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resena->id_resena]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resena->id_resena], ['confirm' => __('Are you sure you want to delete # {0}?', $resena->id_resena)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
