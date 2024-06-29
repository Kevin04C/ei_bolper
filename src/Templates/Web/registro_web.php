    <div class="contenedor-form">
        <div id="msg_form">            
        </div>
        <?= $this->Form->create($usuario , [ 'onsubmit' => 'return submitForm(event)']) ?>
        <div class="text-center">
            <h3>Datos del Cliente</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group msg-form-border">
                    <label for=""> Nombres </label>
                    <input type="text" class="form-control" name="nombre" id="input_nombre" placeholder="Escriba su nombre completo" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group msg-form-border" id="formg_dni">
                    <label for=""> DNI </label>
                    <input type="text" class="form-control" name="dni" id="input_dni" placeholder="########" maxlength="8">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group msg-form-border">
                    <label for=""> Teléfono </label>
                    <input type="text" class="form-control" name="telefono" id="input_telefono" placeholder="Escriba su numero de teléfono" maxlength="9">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group msg-form-border">
                    <label for=""> Direccion </label>
                    <input type="text" class="form-control" name="direccion" id="input_direccion" placeholder="Escriba su dirección actual">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group msg-form-border" id="formg_correo">
                    <label for="">Correo</label>
                    <input type="email" class="form-control" name="email" id="input_email" placeholder="Escriba su correo electrónico" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group msg-form-border" id="formg_clave">
                    <label for=""> Contraseña </label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="clave" id="input_clave" placeholder="Escriba una contraseña" required>
                        <div class="input-group-addon"> <a href="javascript:void(0)" onclick="showPwd(this, 'input_clave')"> <i class="fa fa-eye"></i> </a> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group msg-form-border" id="formg_confirmar_clave">
                    <label for=""> Repetir contraseña </label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="confirmar_clave" id="input_confirmar_clave" placeholder="Confirme su contraseña" required>
                        <div class="input-group-addon"> <a href="javascript:void(0)" onclick="showPwd(this, 'input_confirmar_clave')"> <i class="fa fa-eye"></i> </a> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?= $this->Form->button( '<i class="fa fa-save"></i> Registrarse', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
            </div>

        </div>
        <?= $this->Form->end() ?>
    </div>