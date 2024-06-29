<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resena $resena
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Resena'), ['action' => 'edit', $resena->id_resena], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Resena'), ['action' => 'delete', $resena->id_resena], ['confirm' => __('Are you sure you want to delete # {0}?', $resena->id_resena), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Resena'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Resena'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resena view content">
            <h3><?= h($resena->id_resena) ?></h3>
            <table>
                <tr>
                    <th><?= __('Producto') ?></th>
                    <td><?= $resena->has('producto') ? $this->Html->link($resena->producto->id, ['controller' => 'Producto', 'action' => 'view', $resena->producto->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($resena->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Resumen') ?></th>
                    <td><?= h($resena->resumen) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Resena') ?></th>
                    <td><?= $this->Number->format($resena->id_resena) ?></td>
                </tr>
                <tr>
                    <th><?= __('Calidad') ?></th>
                    <td><?= $this->Number->format($resena->calidad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Valor') ?></th>
                    <td><?= $this->Number->format($resena->valor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Revision') ?></th>
                    <td><?= h($resena->fecha_revision) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Revision') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($resena->revision)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
