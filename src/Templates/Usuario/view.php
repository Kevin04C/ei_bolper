<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Usuario'), ['action' => 'edit', $usuario->id_usuario], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Usuario'), ['action' => 'delete', $usuario->id_usuario], ['confirm' => __('Are you sure you want to delete # {0}?', $usuario->id_usuario), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Usuario'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Usuario'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usuario view content">
            <h3><?= h($usuario->id_usuario) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom Usuario') ?></th>
                    <td><?= h($usuario->nom_usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Correo Usuario') ?></th>
                    <td><?= h($usuario->correo_usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contrasena') ?></th>
                    <td><?= h($usuario->contrasena) ?></td>
                </tr>
                <tr>
                    <th><?= __('Departamento') ?></th>
                    <td><?= h($usuario->departamento) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo') ?></th>
                    <td><?= h($usuario->tipo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Usuario') ?></th>
                    <td><?= $this->Number->format($usuario->id_usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telef Usuario') ?></th>
                    <td><?= $this->Number->format($usuario->telef_usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Codigo Postal') ?></th>
                    <td><?= $this->Number->format($usuario->codigo_postal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($usuario->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($usuario->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Direccion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($usuario->direccion)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Pedido') ?></h4>
                <?php if (!empty($usuario->pedido)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id Pedido') ?></th>
                            <th><?= __('Usuario Id') ?></th>
                            <th><?= __('Producto Id') ?></th>
                            <th><?= __('Cantidad') ?></th>
                            <th><?= __('Fecha Orden') ?></th>
                            <th><?= __('Metodo Pago') ?></th>
                            <th><?= __('Estado Orden') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($usuario->pedido as $pedido) : ?>
                        <tr>
                            <td><?= h($pedido->id_pedido) ?></td>
                            <td><?= h($pedido->usuario_id) ?></td>
                            <td><?= h($pedido->producto_id) ?></td>
                            <td><?= h($pedido->cantidad) ?></td>
                            <td><?= h($pedido->fecha_orden) ?></td>
                            <td><?= h($pedido->metodo_pago) ?></td>
                            <td><?= h($pedido->estado_orden) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Pedido', 'action' => 'view', $pedido->id_pedido]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Pedido', 'action' => 'edit', $pedido->id_pedido]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pedido', 'action' => 'delete', $pedido->id_pedido], ['confirm' => __('Are you sure you want to delete # {0}?', $pedido->id_pedido)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
