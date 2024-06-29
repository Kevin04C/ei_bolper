<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DetallePedido $detallePedido
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Detalle Pedido'), ['action' => 'edit', $detallePedido->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Detalle Pedido'), ['action' => 'delete', $detallePedido->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detallePedido->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Detalle Pedido'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Detalle Pedido'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="detallePedido view content">
            <h3><?= h($detallePedido->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Producto Nombre') ?></th>
                    <td><?= h($detallePedido->producto_nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($detallePedido->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pedido Id') ?></th>
                    <td><?= $detallePedido->pedido_id === null ? '' : $this->Number->format($detallePedido->pedido_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Producto Id') ?></th>
                    <td><?= $detallePedido->producto_id === null ? '' : $this->Number->format($detallePedido->producto_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pedido Cantidad') ?></th>
                    <td><?= $detallePedido->pedido_cantidad === null ? '' : $this->Number->format($detallePedido->pedido_cantidad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Producto Punitarioincigv') ?></th>
                    <td><?= $detallePedido->producto_punitarioincigv === null ? '' : $this->Number->format($detallePedido->producto_punitarioincigv) ?></td>
                </tr>
                <tr>
                    <th><?= __('Producto Subtotal') ?></th>
                    <td><?= $detallePedido->producto_subtotal === null ? '' : $this->Number->format($detallePedido->producto_subtotal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pedido Igv') ?></th>
                    <td><?= $detallePedido->pedido_igv === null ? '' : $this->Number->format($detallePedido->pedido_igv) ?></td>
                </tr>
                <tr>
                    <th><?= __('Producto Total') ?></th>
                    <td><?= $detallePedido->producto_total === null ? '' : $this->Number->format($detallePedido->producto_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($detallePedido->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($detallePedido->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
