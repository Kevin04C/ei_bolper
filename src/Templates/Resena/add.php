<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resena $resena
 * @var \Cake\Collection\CollectionInterface|string[] $producto
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Resena'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resena form content">
            <?= $this->Form->create($resena) ?>
            <fieldset>
                <legend><?= __('Add Resena') ?></legend>
                <?php
                    echo $this->Form->control('producto_id', ['options' => $producto]);
                    echo $this->Form->control('calidad');
                    echo $this->Form->control('valor');
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('resumen');
                    echo $this->Form->control('revision');
                    echo $this->Form->control('fecha_revision');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
