<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Categorium $categorium
 */
?>

<div class="">
    <div class="">
        <?= $this->Form->create($categoria,['enctype'=>'multipart/form-data']) ?>
        <fieldset>
            <div class="py-1">
                <?= $this->Form->control('nom_categoria', [ 'label' => 'Nombre', 'class' => 'form-control form-control-sm']); ?>
            </div>
            <div class="py-1">
                <?= $this->Form->control('desc_categoria', [ 'label' => 'Descripción', 'class' => 'form-control form-control-sm']); ?>
            </div>
            <div class="py-1">
                <?= $this->Form->control('img_1', [ 'label' => 'Imagen 1', 'type' => "file", 'class' => 'form-control', 'required' , 'id' => 'imagen1' , 'onchange' => 'readURL(event, "img_url_1")']); ?>
                <div style="max-width:100%" class="mt-2">
                    <img id="img_url_1" src="" style="object-fit:contain"  width="100%" />
                </div>
            </div>
        </fieldset>
        <?= $this->Form->button( '<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
