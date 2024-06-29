<?= $this->Form->create($producto, ['enctype' => 'multipart/form-data']) ?>
<fieldset class="row">
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('categoria_id', ['class' => 'form-select', 'options' => $categorias, 'empty' => '-Seleccione-']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('proveedor_id', ['class' => 'form-select', 'options' => $proveedores, 'empty' => '-Seleccione un proveedor-']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('nom_producto', ['label' => 'Nombre del Producto', 'class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('marca_producto', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('precio_producto',  ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('cantidad', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('stock', ['class' => 'form-select', 'options' => ['0' => 'Sin Stock', '1' => 'En Stock'], 'empty' => '-', 'required']); ?>
    </div>
    <div class="col-12 py-2">
        <?= $this->Form->control('principal', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 py-2">
        <?= $this->Form->control('general', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('img_1', ['label' => 'Imagen 1', 'type' => "file", 'class' => 'form-control', 'required', 'id' => 'imagen1', 'onchange' => 'readURL(event, "img_url_1")']); ?>
        <div style="max-width:100%" class="mt-2">
            <img id="img_url_1" src="" style="object-fit:contain" width="100%" />
        </div>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('img_2', ['label' => 'Imagen 2', 'type' => "file", 'class' => 'form-control', 'id' => 'imagen2', 'onchange' => 'readURL(event, "img_url_2")']); ?>
        <div style="max-width:100%" class="mt-2">
            <img id="img_url_2" src="" style="object-fit:contain" width="100%" />
        </div>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('img_3', ['label' => 'Imagen 3', 'type' => "file", 'class' => 'form-control', 'id' => 'imagen3', 'onchange' => 'readURL(event, "img_url_3")']); ?>
        <div style="max-width:100%" class="mt-2">
            <img id="img_url_3" src="" style="object-fit:contain" width="100%" />
        </div>
    </div>
    <div class="col-12 py-2">
        <?= $this->Form->button('<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-primary btn-sm', 'escapeTitle' => false]) ?>
    </div>
</fieldset>
<?= $this->Form->end() ?>