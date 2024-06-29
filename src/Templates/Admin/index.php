<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Admin> $admin
 */
?>
<div class="admin index content">
    <?= $this->Html->link(__($boton), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __($titulo) ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id_admin') ?></th>
                    <th><?= $this->Paginator->sort('usuario') ?></th>
                    <th><?= $this->Paginator->sort('contrasena') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admin as $admin): ?>
                <tr>
                    <td><?= $this->Number->format($admin->id_admin) ?></td>
                    <td><?= h($admin->usuario) ?></td>
                    <td><?= h($admin->contrasena) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $admin->id_admin]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $admin->id_admin]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $admin->id_admin], ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id_admin)]) ?>
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
