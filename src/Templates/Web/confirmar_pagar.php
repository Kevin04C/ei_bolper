<div class="section">
    <!-- container -->
    <div class="container">
        <?= $this->Form->create(null, ['onsubmit' => 'confirmarPedido(event)', 'id' => 'form_pedido', "enctype" => "multipart/form-data"]) ?>
        <!-- row -->
        <div class="row">

            <div class="col-md-7">
                <?php if (!$usuario_sesion) : ?>
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Datos de Facturación</h3>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="nom_usuario" placeholder="Nombre Completo" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="correo_usuario" id="input_correo_usuario" placeholder="Correo" required>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="direccion" placeholder="Dirección" required>
                            <small id="passwordHelpInline" class="text-muted">
                                Incluye Jr. - Av. - Psje. - Urb...
                            </small>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="departamento" placeholder="Ubicación" required>
                            <small id="passwordHelpInline" class="text-muted">
                                Incluye Departamento - Provincia - Distrito
                            </small>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="codigo_postal" id="codigo_postal" placeholder="Código Postal">
                        </div>
                        <div class="form-group">
                            <input class="input" type="tel" name="telef_usuario" id="telef_usuario" placeholder="Telefono">
                        </div>
                        <div class="form-group">
                            <div class="input-checkbox">
                                <input type="checkbox" id="create_account" name="crear_usuario" value="1">
                                <label for="create_account">
                                    <span></span>
                                    Selecciona para crear cuenta
                                </label>
                                <div class="caption">
                                    <p>Ingrese una contraseña para su Nueva Cuenta</p>
                                    <input class="input" type="password" name="contrasena" id="input_contrasena" placeholder="Ingrese su contraseña">
                                    <small id="passwordHelpInline" class="text-muted">
                                        Ingresar entre 6 - 12 carácteres
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Billing Details -->
                <?php else : ?>
                    <!-- Shiping Details -->
                    <div class="shiping-details">
                        <div class="section-title">
                            <h3 class="title">Usuario en sesión</h3>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="shiping-address" name="cambiar_envio" value="1">
                            <label for="shiping-address">
                                <span></span>
                                ¿Cambiar direccion de envio?
                            </label>
                            <div class="caption">
                                <div class="form-group">
                                    <input class="input" type="text" name="nom_usuario" placeholder="Nombres">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="email" name="correo_usuario" placeholder="Correo">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="direccion" placeholder="Dirección">
                                    <small id="passwordHelpInline" class="text-muted">
                                        Incluye Jr. - Av. - Psje. - Urb...
                                    </small>
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="departamento" placeholder="Ubicación">
                                    <small id="passwordHelpInline" class="text-muted">
                                        Incluye Departamento - Provincia - Distrito
                                    </small>
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="codigo_postal" placeholder="Código Postal">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="tel" name="telef_usuario" placeholder="Telefono">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Shiping Details -->
                <?php endif; ?>

                <!-- Order notes -->

                <div class="form-group">
                    <select class="input" name="metodo_entrega" placeholder="Metodo de entrega" required>
                        <option value="">-Metodo de entrega-</option>
                        <option value="LOCAL">Recojo en Local</option>
                        <option value="DELIVERY">Pago contra entrega </option>
                    </select>
                </div>
                <div class="order-notes">
                    <textarea class="input" name="notas_adicionales" placeholder="Indique específicamente dónde será enviado y proporcione los datos de la factura o boleta"></textarea>
                </div>
                <!-- /Order notes -->
            </div>

            <!-- Order Details -->
            <div class="col-md-5 order-details align-items-stretch">
                <div class="section-title text-center">
                    <h3 class="title">Tu compra</h3>
                </div>
                <div id="lista_productos">
                </div>
                <div id="img_pagar">
                    <span style="margin-right:10px;font-weight:bold">
                        Método de pago:
                    </span>
                    <input type="radio" value='yape' name="metodo_pago" id="radio_yape">
                    <label for="radio_yape" style="font-weight:normal !important">Yape</label>
                </div>

                <div class="">
                    <input type="checkbox" id="terms" name="tyc" required>
                    <label for="terms" style="font-weight: lighter !important;">
                        <span></span>
                        Acepto los términos y condiciones</a>
                    </label>
                </div>
                <button type="submit" class="primary-btn order-submit" id="btn_submit"> Guardar y continuar <i class="fa fa-arrow-circle-right"></i></button>
            </div>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
        <?= $this->Form->end(); ?>

        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
            </div>

        </div>
        <!-- /container -->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const inputCodigoPostal = document.getElementById('codigo_postal');
            const inputTelefono = document.getElementById('telef_usuario');

            function validateNumberInput(event) {
                const input = event.target;
                input.value = input.value.replace(/[^0-9]/g, '');
            }

            inputCodigoPostal.addEventListener('input', validateNumberInput);
            inputTelefono.addEventListener('input', validateNumberInput);
        });
    </script>
    <style>
        .form-usuario {
            display: grid;
            gap: 10px;
            width: 60%;
            margin: auto;
        }

        .card-btn button {
            display: inline-block;
            padding: 12px;
            background-color: #D10024;
            color: #FFF;
            text-align: center;
            font-weight: 700;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
            border: none;
        }
    </style>