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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $admin->id_admin],
                ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id_admin), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Admin'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="admin form content">
            <?= $this->Form->create($admin) ?>
            <fieldset>
                <legend><?= __('Edit Admin') ?></legend>
                <?php
                    echo $this->Form->control('usuario');
                    echo $this->Form->control('contrasena');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
