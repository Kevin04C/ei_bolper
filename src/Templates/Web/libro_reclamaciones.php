    <div class="contenedor-form">
        <div id="msg_form">
        </div>
        <?= $this->Form->create($usuario, ['onsubmit' => 'return submitForm(event)', 'id' => "form_libro_reclamaciones"]) ?>
        <div class="text-center">
            <h3>Libro de reclamaciones</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group msg-form-border">
                    <label for=""> Nombre completo </label>
                    <input type="text" class="form-control" name="nombre" id="input_nombre" placeholder="Escriba su nombre completo" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group msg-form-border">
                    <label for=""> Documento de identidad </label>
                    <select name="tipo_doc" id="" class="form-control">
                        <option value="">-Ninguno-</option>
                        <option value="dni">DNI</option>
                        <option value="ruc">RUC</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group msg-form-border" id="formg_dni">
                    <label for=""> Nº doc. identidad </label>
                    <input type="text" class="form-control" name="dni" id="input_dni" placeholder="########" maxlength="8">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group msg-form-border">
                    <label for=""> Teléfono </label>
                    <input type="text" class="form-control" name="telefono" id="input_telefono" placeholder="Ej.: 987654321" maxlength="9">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group msg-form-border">
                    <label for=""> Dirección </label>
                    <input type="text" class="form-control" name="direccion" id="input_direccion" placeholder="Ej.: Av. Los Ángeles 1025">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group msg-form-border" id="formg_correo">
                    <label for="">Correo</label>
                    <input type="email" class="form-control" name="email" id="input_email" placeholder="Ej.: usuario@dominio.com" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group msg-form-border" id="formg_descripcion">
                    <label for="">Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="input_descripcion" placeholder="Describa aqui su reclamo"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <?= $this->Form->button('<i class="fa fa-upload"></i> Enviar', ['class' => 'btn btn-primary', 'style' => 'width:100%', 'escapeTitle' => false, 'id' => "btn_submit"]) ?>
            </div>

        </div>
        <?= $this->Form->end() ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const inputTelefono = document.getElementById('input_telefono');
            const inputDni = document.getElementById('input_dni');

            function validateNumberInput(event) {
                const input = event.target;
                input.value = input.value.replace(/[^0-9]/g, '');
            }

            inputTelefono.addEventListener('input', validateNumberInput);
            inputDni.addEventListener('input', validateNumberInput);
        });

        function submitForm(event) {
            event.preventDefault();
            var regexp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/


            if(!regexp.test($("#input_email").val())) {
                showMsg("Correo inválido");
                return;
            }

            $("#btn_submit").attr('disabled', true)
            $("#btn_submit").css('background-color', 'grey')
            $("#btn_submit").html(`Guardando reclamo <i class="fa fa-spinner fa-spin"></i>`)

            var form = document.getElementById("form_libro_reclamaciones");
            console.log(form);
            var formData = new FormData(form);

            $.ajax({
            headers: { 'X-CSRF-Token': csrfToken },
            url: base + "usuario/libro-reclamaciones",
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            cache: false,
            contentType: false,
            success: function (r) {
                if (r.success) {
                    alert(r.message)
                    location.reload();
                }else{
                    alert('Ocurrio un error con su pedido.')
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }, complete: function () {
                $("#btn_submit").attr('disabled', false)
                $("#btn_submit").css('background-color', '')
                $("#btn_submit").html(` <i class="fa fa-upload"></i> Enviar`)
            }, 
         });

        }

        function showMsg(message) {
            var msg = `
    <div class="message-error" onclick="this.classList.add('hidden');">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ${message}
    </div>
    `;
            $("#msg_form").html(msg);
        }
    </script>