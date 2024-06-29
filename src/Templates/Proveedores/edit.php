<div class="">
    <div class="">
        <?= $this->Form->create($proveedor) ?>
        <fieldset class="pb-2">
            <div class="row py-1">
                <div class="col-md-4 py-1">
                    <?= $this->Form->control('ruc', [ 'label' => 'RUC', 'class' => 'form-control form-control-sm']); ?>
                </div>
            </div>
            <div class="py-1">
                <?= $this->Form->control('nombre_comercial', [ 'label' => 'Nombre Comercial', 'class' => 'form-control form-control-sm']); ?>
            </div>
            <div class="py-1">
                <?= $this->Form->control('razon_social', [ 'label' => 'Razón Social', 'class' => 'form-control form-control-sm']); ?>
            </div>
            <div class="py-1">
                <?= $this->Form->control('descripcion', [ 'label' => 'Descripción', 'class' => 'form-control form-control-sm']); ?>
            </div>
            <div class="row">
                <div class="col-md-6 py-1">
                    <?= $this->Form->control('telefono', [ 'label' => 'Telefono', 'class' => 'form-control form-control-sm']); ?>
                </div>
                <div class="col-md-6 py-1">
                    <?= $this->Form->control('correo', [ 'label' => 'Correo', 'class' => 'form-control form-control-sm']); ?>
                </div>
            </div>
            <label>
               ** Los Datos para el usuario se editan desde el listado de usuarios.
            </label>
        </fieldset>
        <?= $this->Form->button( '<i class="fa fa-save"></i> Guardar', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>