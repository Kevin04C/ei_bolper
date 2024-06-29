<div class="form-clave">
    <div id="msg">
    </div>
    <?= $this->Form->create(null, ['id' => 'form-clave', 'method' => 'post'])?>
        <div style="margin-bottom: 10px" class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" required>
        </div>
        <div style="margin-bottom: 10px" class="input-group">
            <span class="input-group-addon" style="cursor:pointer" onclick="mostrarClave('clave')"><i id="clave_icon" class="fa fa-eye-slash"></i></span>
            <input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña" required>
        </div>
        <div style="margin-bottom: 10px" class="input-group">
            <span class="input-group-addon" style="cursor:pointer" onclick="mostrarClave('clave_confirm')"><i id="clave_confirm_icon" class="fa fa-eye-slash"></i></span>
            <input type="password" class="form-control" name="clave_confirm" id="clave_confirm" placeholder="Confirmar Contraseña" required>
        </div>
        <button type="button" class="button-subm" id="btn-subm" >Solicitar cambio de contraseña </button>
    <?= $this->Form->end() ?>
</div>
<style>
    .form-clave{
        width: 400px;
        margin: auto;
        padding-top: 50px;
        padding-bottom: 40px;
    }
    .message-error{
        padding: 10px;
        background-color: #F1948A;
        border: 1px solid #E74C3C ;
        border-radius: 10px;
    }
</style>
<script>
    function ocultarMensajeFlash(me){
        me.style.display = 'none';
    }
</script>