<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin $admin
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Admin'), ['action' => 'edit', $admin->id_admin], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Admin'), ['action' => 'delete', $admin->id_admin], ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id_admin), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Admin'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Admin'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="admin view content">
            <h3><?= h($admin->id_admin) ?></h3>
            <table>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= h($admin->usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contrasena') ?></th>
                    <td><?= h($admin->contrasena) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Admin') ?></th>
                    <td><?= $this->Number->format($admin->id_admin) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
