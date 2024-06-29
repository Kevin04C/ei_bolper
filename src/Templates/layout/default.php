<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $view_title ?> |  BOLPER </title>
    <meta name="description" content="Venta de equipos de cómputo">
    <meta name="author" content="DataStore">
    <?php

    echo $this->Html->css("https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i");
    echo $this->Html->css("/assets/font-awesome/css/all.min.css");
    echo $this->Html->css("/assets/bootstrap-5.2/css/bootstrap.css");
    echo $this->Html->css("/assets/gerware/gerware.css");
    echo $this->Html->css("/assets/select2/css/select2.min.css");

    if (isset($styles)) {
        echo "<style type='text/css'>{$styles}</style>";
    }
    echo $this->Html->ScriptBlock("var base = '" . $this->Url->Build("/panel/", ['fullBase' => true]) . "'");
    echo $this->Html->ScriptBlock("var base_root = '" . $this->Url->Build("/", ['fullBase' => true]) . "'");
    ?>
</head>
<body>
<div class="d-flex" id="wrapper" >
    <div class="bg-secondary" id="sidebar-wrapper">
        <nav id="sidebar" >
            <div class="sidebar-heading text-center p-2">
                <span class="navbar-brand">
                    <?php
                        echo $this->Html->Image('/public/logo.png', ['id' => 'LogoImagen', 'class'=> 'img img-fluid' ,'style' => 'max-height:80px; max-width:200px;']);
                    ?>
                </span>
            </div>
            <div class="gw-userinfo">
                <div class="row">
                    <div class="col-md-8">
                        <?= $usuario_sesion['nom_usuario'];?> <small><b> (<?= $usuario_sesion['tipo'] ?>)</b> </small>
                    </div>
                    <div class="col-4 text-right">
                        <small>
                            <?= $this->Html->Link("Salir <i class='fas fa-sign-out-alt fa-fw'></i>",['controller' => 'Usuario', 'action' =>  'logout'], ['style'=>'color:#59CB2F;','escape' => false]);?>
                        </small>
                    </div>
                </div>
            </div>
            <?php
                if ($usuario_sesion):
                    echo $this->Element("navleft");
                endif;
            ?>
        </nav>
    </div>
    <div id="page-content-wrapper">
        <?php
        echo $this->Element("navtop");
        echo "<div class='gw-contenedor' style='padding-top:10px'>";
        echo $this->Flash->render();
        echo "<div class='gw-contenedor-contenido'>";
        echo $this->fetch("content");
        echo "</div>";
        echo "</div>";
        ?>
        <!-- Modal de prueba de aviso-->
    </div>
</div>
<?php
echo $this->Html->Script("/assets/jquery/jquery.js");
echo $this->Html->Script("/assets/popper.js");
echo $this->Html->Script("/assets/bootstrap-5.2/js/bootstrap.bundle.min.js");
echo $this->Html->Script("/assets/jquery.autocomplete.min.js");
echo $this->Html->Script("/assets/jquery.mask.min.js");
echo $this->Html->Script("/assets/gerware/gerware.js");
echo $this->Html->Script("/assets/select2/js/select2.min.js");

if (isset($script)) {
    echo $this->Html->ScriptBlock($script);
    echo $this->Html->scriptBlock(" var _csrfToken = '" . $this->request->getParam('_csrfToken') . "';" );
}

?>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
   
</script>
</body>
</html>
