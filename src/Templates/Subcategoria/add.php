<?= $this->Form->create($subcategoria) ?>
<fieldset class="d-grid gap-2 mb-2">
    <?php
        echo $this->Form->control('id_categoria',[ 'class' => 'form-select', 'options' => $categorias , 'empty' => true ,'type' => 'select']);
        echo $this->Form->control('nom_subcategoria', [ 'class' => 'form-control']);
    ?>
</fieldset>
<?= $this->Form->button( '<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
<?= $this->Form->end() ?>