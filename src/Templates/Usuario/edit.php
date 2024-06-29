<?= $this->Form->create($usuario) ?>
<fieldset class="row">
    <div class="col-12 col-md-6 py-2">
        <?= $this->Form->control('dni', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <?= $this->ForFm->control('nom_usuario', ['class' => 'form-control']); ?>
    </div>
    <div class="col-12 col-md-6 py-2">
        <label for="">Contraseña</label>
        <input type="text" class="form-control" >
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
        <label for=""> Tipo/ROL</label>
        <select disabled class="form-select">
            <option value=""> --- </option>
            <?php foreach($options_usuario as $key => $value): ?>
                <option value="<?= $key ?>" <?= $key == $usuario->tipo ? 'selected' : ''?>> <?= $value ?> </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="col-12 py-2">
        <?= $this->Form->button( '<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
    </div>
</fieldset>
<?= $this->Form->end() ?>