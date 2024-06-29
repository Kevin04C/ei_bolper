<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\DetallePedido> $detallePedido
 */
?>
<div class="detallePedido index content">
    <?= $this->Html->link(__('New Detalle Pedido'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Detalle Pedido') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('pedido_id') ?></th>
                    <th><?= $this->Paginator->sort('producto_id') ?></th>
                    <th><?= $this->Paginator->sort('pedido_cantidad') ?></th>
                    <th><?= $this->Paginator->sort('producto_nombre') ?></th>
                    <th><?= $this->Paginator->sort('producto_punitarioincigv') ?></th>
                    <th><?= $this->Paginator->sort('producto_subtotal') ?></th>
                    <th><?= $this->Paginator->sort('pedido_igv') ?></th>
                    <th><?= $this->Paginator->sort('producto_total') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detallePedido as $detallePedido): ?>
                <tr>
                    <td><?= $this->Number->format($detallePedido->id) ?></td>
                    <td><?= $detallePedido->pedido_id === null ? '' : $this->Number->format($detallePedido->pedido_id) ?></td>
                    <td><?= $detallePedido->producto_id === null ? '' : $this->Number->format($detallePedido->producto_id) ?></td>
                    <td><?= $detallePedido->pedido_cantidad === null ? '' : $this->Number->format($detallePedido->pedido_cantidad) ?></td>
                    <td><?= h($detallePedido->producto_nombre) ?></td>
                    <td><?= $detallePedido->producto_punitarioincigv === null ? '' : $this->Number->format($detallePedido->producto_punitarioincigv) ?></td>
                    <td><?= $detallePedido->producto_subtotal === null ? '' : $this->Number->format($detallePedido->producto_subtotal) ?></td>
                    <td><?= $detallePedido->pedido_igv === null ? '' : $this->Number->format($detallePedido->pedido_igv) ?></td>
                    <td><?= $detallePedido->producto_total === null ? '' : $this->Number->format($detallePedido->producto_total) ?></td>
                    <td><?= h($detallePedido->created) ?></td>
                    <td><?= h($detallePedido->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $detallePedido->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $detallePedido->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $detallePedido->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detallePedido->id)]) ?>
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
