<div class="section">
    <!-- container -->
    <div class="container">
        <?php if (isset($producto)) : ?>
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="<?= $this->Url->build('/' . $producto->imagen1) ?>" alt="">
                        </div>
                        <div class="product-preview">
                            <img src="<?= $this->Url->build('/' . $producto->imagen2) ?>" alt="">
                        </div>
                        <div class="product-preview">
                            <img src="<?= $this->Url->build('/' . $producto->imagen3) ?>" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="<?= $this->Url->build('/' . $producto->imagen1) ?>" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="<?= $this->Url->build('/' . $producto->imagen2) ?>" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="<?= $this->Url->build('/' . $producto->imagen3) ?>" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">
                            <?= $producto->nom_producto ?>
                        </h2>
                        <div>
                            <h3 class="product-price">S/. <?= $producto->precio_producto ?>

                            </h3>
                            <span class="product-available" style=""><?= $producto->cantidad ?> Producto(s) </span>
                        </div>
                        <p align="justify">
                            <?= $producto->principal ?>
                        </p>
                        <?php if ($producto->cantidad > 0) : ?>
                            <div class="add-to-cart">
                                <button class="add-to-cart-btn" onclick="Carrito.agregarProducto(<?= $producto->id ?>)"><i class="fa fa-shopping-cart"></i> agregar al carrito</button>
                            </div>
                        <?php endif; ?>

                        <ul class="product-links">
                            <li>Categoria:</li>
                            <li><a href="#"><?= $producto->categorium ? $producto->categorium->nom_categoria : '' ?></a></li>
                        </ul>

                        <!-- <ul class="product-links">
                            <li>Encu&eacute;ntranos en:</li>
                            <li><a href="https://www.facebook.com/DataCenterHz/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://api.whatsapp.com/send?phone=51944195972&text=Hola" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                            <li><a href="https://www.instagram.com/datacenterperu.huaraz/" target="_blank"><i class="fa fa-instagram"></i></a></li>

                        </ul> -->

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Descripción</a></li>
                            <!-- <li><a data-toggle="tab" href="#tab2">Especificaciones técnicas</a></li> -->
                        </ul>
                        <!-- /product tab nav -->
                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p align="justify">
                                            <?= $producto->principal ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->
                            <!-- tab2  -->
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <?= $producto->general ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab2  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        <?php else : ?>
            <div style="font-size:2em;margin-bottom:30px">
                No existe el producto seleccionado
            </div>
        <?php endif; ?>
    </div>
    <!-- /container -->
</div>