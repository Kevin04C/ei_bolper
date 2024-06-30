<!Doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $view_title ?> | BOLPER</title>
    <meta name="description" content="En Data Center Peru Company E.I.R.L. Hay Ordenadores de Todo el Tipo a Buen Precio. | Mira las Gamas de Equipos y Compra los que Necesites. ¡Visítanos en Huaraz!">
    <meta name="keywords" content="store data center, equipos de computo,computadoras,servicio tecnico, reparacion de ordenadores, laptops, accesorios informaticos, audifonos, ssd, tarjeta grafica, combos gamer, Piezas, Accesorios y Equipos, tienda en Huaraz,Data Center">
    <meta name="author" content="Store Data Center">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SR3HN6QBNJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-SR3HN6QBNJ');
    </script>




    <?php
    echo $this->Html->css("https://fonts.googleapis.com/css?family=Montserrat:400,500,700");
    echo $this->Html->css("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css");
    echo $this->Html->css("bootstrap.min.css");
    // echo $this->Html->css("/assets/bootstrap-5.2/css/bootstrap.css");
    echo $this->Html->css("slick.css");
    echo $this->Html->css("slick-theme.css");
    echo $this->Html->css("nouislider.min.css");
    echo $this->Html->css("style.css");
    if (isset($styles)) {
        echo "<style type='text/css'>{$styles}</style>";
    }
    echo $this->Html->ScriptBlock("var base = '" . $this->Url->Build("/panel/", ['fullBase' => true]) . "'");
    echo $this->Html->ScriptBlock("var base_root = '" . $this->Url->Build("/", ['fullBase' => true]) . "'");

    ?>

</head>


<body>
    <!-- Messenger Chat plugin Code -->

    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "112912411798294");
        chatbox.setAttribute("attribution", "install_email");
        chatbox.setAttribute("attribution_version", "biz_inbox");
    </script>

    <!-- Messenger Plugin de chat Code -->
    <div id="container" class="container">
        <!-- HEADER -->
        <header>
            <!-- MAIN HEADER -->
            <div id="header">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-3">
                            <div class="header-logo">
                                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="logo">
                                    <img style="height:68px;" src="<?= $this->Url->build("/public/logo_blanco.png") ?>" alt="">
                                </a>
                            </div>
                            <div class="header-ctn">
                                <div class="dropdown" style="cursor:pointer">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-list"></i>
                                        <span>Categorias</span>
                                    </a>
                                    <div class="cart-dropdown cart-left">
                                        <div class="drop-categorias">
                                            <?php foreach ($cats as $categoria) : ?>
                                                <?php if ($this->request->getParam("controller") == 'Web' && $this->request->getParam("action") == 'productos') : ?>
                                                    <li class="<?= isset($this->request->getParam("pass")[0]) && $this->request->getParam("pass")[0] == $categoria->id_categoria ? 'active' : '' ?>">
                                                    <?php else : ?>
                                                    <li>
                                                    <?php endif; ?>
                                                    <a href="<?= $this->Url->build(['controller' => 'web', 'action' => 'productos', $categoria->id_categoria]) ?> "> <?= $categoria->nom_categoria ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /LOGO -->

                        <!-- SEARCH BAR -->
                        <div class="col-md-5">
                            <div class="header-search">
                                <form method="get" action="<?= $this->Url->build(['action' => 'productos', $this->request->getParam("pass")[0] ?? '']) ?>">
                                    <input class="input" placeholder="Busque aquí" name="q" value="<?= $opt_search ?? '' ?>">
                                    <button class="search-btn" type="submit">Buscar</button>
                                </form>
                            </div>
                        </div>
                        <!-- /SEARCH BAR -->

                        <!-- ACCOUNT -->
                        <div class="col-md-3 clearfix">
                            <div class="header-ctn">
                                <!-- LOGIN -->
                                <div class="dropdown">
                                    <?php if ($usuario_sesion) : ?>
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-address-card-o"></i>
                                            <span><?= $usuario_sesion ? ($usuario_sesion->nom_usuario == '' ? 'Usuario' : $usuario_sesion->nom_usuario)  : 'Usuario' ?></span>
                                        </a>
                                        <div class="cart-dropdown">
                                            <?= $this->Form->create(null, ['action' => $this->Url->build(['controller' => 'Web', 'action' => 'logout'])]) ?>

                                            <div style="margin-bottom: 10px" class="input-group">
                                                Nombres: <?= $usuario_sesion ? ($usuario_sesion->nom_usuario == '' ? 'Usuario' : $usuario_sesion->nom_usuario) : 'Usuario' ?>
                                            </div>
                                            <div class="cart-btns">
                                                <a class="cart-pedidos" href="<?= $this->Url->build(['action' => 'mi-cuenta']) ?>">Mi Cuenta</a>
                                                <a class="cart-pedidos" href="<?= $this->Url->build(['action' => 'mis-pedidos']) ?>">Mis pedidos</a>
                                                <button class="button-subm"> Salir <i class="fa fa-arrow-circle-right"></i></button>
                                            </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    <?php else : ?>
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
                                            <i class="fa fa-address-card-o"></i>
                                            <span>Mi cuenta</span>
                                        </a>
                                        <div class="cart-dropdown">
                                            <?= $this->Form->create(null, ['action' => $this->Url->build(['controller' => 'Usuario', 'action' => 'login', '?' => ['opt' => 'web']]), 'method' => 'post', 'id' => 'form_sesion_web', 'onsubmit' => 'consultarCarrito(event)']) ?>
                                            <input name="pedido_cookie_id" type="hidden" />
                                            <div style="margin-bottom: 10px" class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                                <input id="login-username" type="text" class="form-control" name="correo_usuario" value="" placeholder="Correo" required>
                                            </div>
                                            <div style="margin-bottom: 10px" class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                                <input id="login-password" type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
                                            </div>

                                            <div class="row" style="padding-bottom: 15px;">
                                                <!-- <div class="col-md-6"> -->
                                                <!-- Checkbox -->
                                                <!-- <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                                            <label class="form-check-label" for="form2Example31"> Recordarme </label>
                                                        </div>
                                                    </div> -->

                                                    <!-- <div id="msg_form">            
                                                    </div> -->

                                                <div class="col-md-12 text-center" style="padding-top: 4px;">
                                                    <!-- Simple link -->
                                                    <a href="<?= $this->Url->build(['action' => 'recuperarClave']) ?>" style="color:gray">¿Olvidaste tu contraseña?</a>
                                                </div>
                                                <br>
                                            </div>
                                            <input id="pedido_id" type="hidden" name="pedido_id">
                                            <input id="flag_login" value="1" type="hidden" />
                                            <div class="cart-btns row">
                                                <!-- <div class="col-md-6">
                                                        <a href="#">Registro</a>
                                                    </div>
                                                    <div class="col-md-6"> -->
                                                <button type="submit" class="button-subm">Acceder <i class="fa fa-arrow-circle-right"></i></button>
                                                <a class="btn btn-registro" href="<?= $this->Url->build(['action' => 'registro-web']) ?>"> Registrarse <i class="fa fa-id-card"></i></a>
                                                <!-- </div> -->
                                            </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- /LOGIN -->

                                <!-- Cart -->
                                <div class="dropdown" id="carrito_id" style="cursor:pointer">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Mi Carrito</span>
                                        <div class="qty" id="carrito_cantidad">0</div>
                                    </a>
                                    <div class="cart-dropdown" id="carrito_lista_id">
                                        <div class="cart-empty">
                                            <small> Su carrito de compras esta vacío </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Cart -->

                                <!-- Menu Toogle -->
                                <div class="menu-toggle">
                                    <a href="#">
                                        <i class="fa fa-bars"></i>
                                        <span>Menu</span>
                                    </a>
                                </div>
                                <!-- /Menu Toogle -->
                            </div>
                        </div>
                        <!-- /ACCOUNT -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- /MAIN HEADER -->
        </header>
        <!-- /HEADER -->

        <!-- NAVIGATION
        <nav id="navigation">
            <div class="container">
                <div id="responsive-nav">
                    <ul class="main-nav nav navbar-nav">
                        <li class="<?= $this->request->getParam("controller") == 'Web' && $this->request->getParam("action") == 'index' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'web', 'action' => 'index']) ?> ">Inicio</a>
                        </li>                        
                        <li class="<?= $this->request->getParam("controller") == 'Web' && $this->request->getParam("action") == 'productos' ? 'active' : '' ?>">
                            <a href="<?= $this->Url->build(['controller' => 'web', 'action' => 'productos']) ?> ">Productos</a>
                        </li>                        
                    </ul>
                </div>
            </div>
        </nav>
    /NAVIGATION -->

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <!-- FOOTER -->
        <footer id="footer">
            <!-- top footer -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-4 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Nosotros</h3>
                                <p>Somos una empresa de venta de productos electricos.</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Ubicaci&oacute;n</h3>
                                <ul class="footer-links">
                                    <li><i class="fa fa-map-marker"></i> AA.HH. Los Rosales, Av. La Marina - Sechura, Piura, Perú</li>
                                    <li> <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3970.9709436668363!2d-80.81304800000001!3d-5.571314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNcKwMzQnMTYuNyJTIDgwwrA0OCc0Ny4wIlc!5e0!3m2!1ses-419!2spe!4v1719200335151!5m2!1ses-419!2spe" width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="clearfix visible-xs"></div>

                        <div class="col-md-4 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Informaci&oacute;n</h3>
                                <ul class="footer-links">
                                    <li><a href="<?= $this->Url->build(['controller' => 'web', 'action' => 'libro-reclamaciones']) ?>"> Libro de reclamaciones</a></li><br>
                                    <img src="<?= $this->Url->build("/img/libro.png", ['fullBase' => true]) ?>" class="d-block w-100" alt="..." style="width: 100px; height: auto;">

                                </ul>
                            </div>
                        </div>

                        <!-- <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Service</h3>
                                <ul class="footer-links">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Wishlist</a></li>
                                    <li><a href="#">Track My Order</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /top footer -->

            <!-- bottom footer -->
            <div id="bottom-footer" class="section">
                <a href="#"><i class="fa fa-handshake-o" aria-hidden="true"></i></a>
                <!--<div class="container">
                  
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <ul class="footer-payments">
                                <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                                <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                            </ul>
                            <span class="copyright">
                                <a target="_blank" href="https://www.templateshub.net"></a>
                            </span>
                        </div>
                    </div>
                    
                </div>-->

            </div>
            <!-- /bottom footer -->

        </footer>
        <!-- /FOOTER -->
    </div>

    <?= $this->element('boton_whatsapp') ?>
    <?= $this->element('notificacion') ?>
    <style>
        #container {
            width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <?php

    echo $this->Html->scriptBlock(sprintf(
        'var csrfToken = %s;',
        json_encode($this->request->getAttribute('csrfToken'))
    ));
    ?>
    <?= $this->Html->script("jquery.min.js"); ?>
    <?= $this->Html->script("bootstrap.min.js"); ?>
    <!-- <?= $this->Html->Script("/assets/bootstrap-5.2/js/bootstrap.bundle.min.js"); ?> -->
    <?= $this->Html->script("jquery.zoom.min.js"); ?>
    <?= $this->Html->script("nouislider.min.js"); ?>
    <?= $this->Html->script("slick.min.js"); ?>
    <?= $this->Html->script("main.js"); ?>
    <?= $this->Html->script("script.js"); ?>
    <?= $this->Html->script("jquery.mask.js"); ?>

    <?php
    if ($user_cookie->pedido && $user_cookie->pedido->detalle_pedido) {
        echo $this->Html->scriptBlock(" Carrito.setData(" . json_encode($user_cookie->pedido) . "); ");
    }
    if (isset($script)) {
        echo $this->Html->ScriptBlock($script);
    }
    ?>
</body>

</html>