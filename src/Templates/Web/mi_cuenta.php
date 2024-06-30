<div class="section">
  <div class="container">
    <h3>Mi cuenta</h3>

    <?= $this->Form->create($usuario, ['controller' => 'web', 'action' => 'editarCuenta']) ?>
    <div>
      <div class="mb-2">
        <div class="col-md-6 mb-4">
          <div class="form">
            <?= $this->Form->control('nom_usuario', ["label" => "Nombre", 'class' => 'form-control']); ?>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form">
          <?= $this->Form->control('dni', ["label" => "DNI", 'class' => 'form-control', "disabled" => true]); ?>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form">
        <?= $this->Form->control('telef_usuario', ["label" => "Telefono", 'class' => 'form-control', "maxlength" => "9"]); ?>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form">
        <?= $this->Form->control('correo_usuario', ["label" => "Correo", 'class' => 'form-control', 'disabled' => true]); ?>
      </div>
    </div>
    <div class="col-md-12" style="margin-bottom: 100px;">
      <div class="form">
        <?= $this->Form->control('direccion', ['class' => 'form-control']); ?>
      </div>
    </div>
    <div>
      <?= $this->Form->button('<i class="fa fa-save"></i> Actualizar', ['class' => 'btn btn-primary btn-sm', 'escapeTitle' => false]) ?>
    </div>
  </div>

</div>
<?= $this->Form->end() ?>

</div>
<style>
  .img-detalle {
    width: 80px;
    object-fit: contain;
  }
</style>

<script>
  window.addEventListener("load", function () {
            var inputTelefono = document.getElementById("telef-usuario");
            console.log({ inputTelefono });

            inputTelefono.addEventListener("input", function (e) {
                var value = e.target.value;
                if (value === '') {
                    inputTelefono.value = 9;
                } else {
                    value = value.replace(/\D/g, '');
                    if (value.length > 9) value = value.slice(0, 9);

                    var maskedValue = '';
                    for (var i = 0; i < value.length; i++) {
                        maskedValue += value[i];
                    }

                    inputTelefono.value = maskedValue;
                }
            });

            inputTelefono.addEventListener("keydown", function (e) {
                var key = e.keyCode || e.charCode;
                if (key == 8 || key == 46) return; // Allow backspace and delete

                if (inputTelefono.value.length >= 9) {
                    e.preventDefault();
                }
            });
        });
</script>