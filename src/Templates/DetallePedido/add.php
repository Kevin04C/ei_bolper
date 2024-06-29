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
            <?= $this->Html->link(__('List Detalle Pedido'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="detallePedido form content">
            <?= $this->Form->create($detallePedido) ?>
            <fieldset>
                <legend><?= __('Add Detalle Pedido') ?></legend>
                <?php
                    echo $this->Form->control('pedido_id');
                    echo $this->Form->control('producto_id');
                    echo $this->Form->control('pedido_cantidad');
                    echo $this->Form->control('producto_nombre');
                    echo $this->Form->control('producto_punitarioincigv');
                    echo $this->Form->control('producto_subtotal');
                    echo $this->Form->control('pedido_igv');
                    echo $this->Form->control('producto_total');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
