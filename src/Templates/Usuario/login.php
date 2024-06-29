<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion | Data Center</title>
    <?php
    echo $this->Html->meta(
        'favicon.ico',
        '/favicon.ico',
        ['type' => 'icon']
    );
    echo $this->Html->css("/assets/bootstrap/css/bootstrap.css");
    echo $this->Html->css("/assets/font-awesome/css/all.min.css");
    echo $this->Html->ScriptBlock("var base = '" . $this->Url->Build("/intranet/", ['fullBase' => true]) . "'");
    ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center ">
                <?php echo $this->Flash->render(); ?>
            </div>
            <div class="col-lg-4 col-md-6 mx-auto pt-5" >
                <div class="card shadow" style="background-color: #FFFFFF">
                    <div class="card-body" >
                        <?= $this->Form->create(null);?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuario" name="correo_usuario" id="usuarioLogin" type="text" autofocus autocomplete="off" >
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Clave" name="contrasena" id="claveLogin" type="password">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-outline-primary w-100 ingresar" id="btnLogin">
                                <i class="fa fa-sign-in-alt fa-fw" ></i> Ingresar
                            </button>
                            <br/>
                            <br/>
                            <div class="text-center recuperar-clave">
                                <?= $this->Html->Link("¿Olvidaste tu clave?", ['controller' => 'web','action' => 'recuperarClave']) ?>
                            </div>
                        </fieldset>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="recuperarClave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" class="modal-content" onsubmit="return recuperarClave();">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recupera tu Clave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user fa-fw"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Usuario / Correo" name="usuario2" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary" id="recuperarClaveButton">
                                <i class="fas fa-paper-plane fa-fw"></i>
                                Reestablecer
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <?php
        echo $this->Html->Script("/assets/jquery/jquery.js");          // jQuery
        echo $this->Html->Script("/assets/bootstrap/js/bootstrap.bundle.min.js");          // bootstrap
    ?>
    <script>
        $( document ). ready(function() {
            $('#recuperarClave').on('shown.bs.modal', function (event) {
                $("[name=usuario2]").focus();
            })
            $('#recuperarClave').on('hide.bs.modal', function (event) {
                $("[name=usuario2]").val('');
                $("#recuperarClaveButton").attr("disabled", false)
                $("#recuperarClaveButton").html("<i class='fas fa-paper-plane fa-fw'></i> Reestablecer");
            })

        })
    </script>
</body>
</html>