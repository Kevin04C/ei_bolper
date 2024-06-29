<div class="form-clave">
    <?= $this->Form->create(null, ['method' => 'POST'])?>
        <div style="margin-bottom: 10px" class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input type="email" class="form-control" name="correo" placeholder="Correo" required value="<?= $form_data['correo'] ?? ''?>">
        </div>
        <button type="submit" class="button-subm" >Solicitar cambio de contraseña </button>
    <?= $this->Form->end() ?>
</div>
<style>
    .form-clave{
        width: 400px;
        margin: auto;
        padding-top: 50px;
        padding-bottom: 40px;
    }
</style>