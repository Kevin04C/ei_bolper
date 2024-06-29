<?= $this->Form->create($usuario) ?>
<fieldset class="row">
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('dni', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('nom_usuario', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('contrasena', [ 'label' => 'Contraseña', 'class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('correo_usuario', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('telef_usuario', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 py-2">
        <?= $this->Form->control('direccion', ['class' => 'form-control' ,'autogrow' , 'style' => 'height:38px']); ?>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('departamento', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('codigo_postal', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-4 py-2">
        <?= $this->Form->control('tipo', ['class' => 'form-select' , 'options' => $options_usuario ]); ?>
    </div>
    <label>
        **Para los usuarios proveedores se crean desde su formulario en el menú Proveedores
    </label>
    <div class="col-12 py-2">
            <?= $this->Form->button( '<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
        </div>
</fieldset>
<?= $this->Form->end() ?>