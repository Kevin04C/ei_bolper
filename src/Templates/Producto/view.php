<div>
    <h3># <?= h($producto->id) ?> | <?= h($producto->nom_producto) ?></h3>
    <div>
        <strong> Categoria: </strong> <?= $producto->categorium ? $producto->categorium->nom_categoria : '' ?>
    </div>
    <div class="row">
        <div class="col-3 py-2">
            <strong> Nombre: </strong><?= $producto->nom_producto ?>
        </div>
        <div class="col-3 py-2">
            <strong> Marca: </strong><?= $producto->marca_producto ?>
        </div>
        <div class="col-3 py-2">
            <strong> Precio: </strong><?= $producto->precio_producto ?>
        </div>
        <div class="col-3 py-2">
            <strong> Descuento: </strong><?= $producto->desc_producto ?>
        </div>
        <div class="col-6 py-2">
            <strong> Descripción: </strong>
            <blockquote>
                <?= $producto->principal ?>
            </blockquote>
        </div>
        <div class="col-4 py-2">
            <strong>Estado: </strong><?= $producto->stock == '1' ? 'En Stock' : 'Sin Stock' ?> ( <?= $producto->cantidad ?> )
        </div>
        <div class="col-4 py-2">
            <strong>F. Creación: </strong> <?php try {
                                                echo $producto->fecha_publicacion->format("d-m-Y H:i");
                                            } catch (\Throwable $th) {
                                            } ?>
        </div>
        <div class="col-4 py-2">
            <strong> F. Modificación: </strong> <?php try {
                                                    echo $producto->fecha_actualizacion->format("d-m-Y H:i");
                                                } catch (\Throwable $th) {
                                                } ?>
        </div>
        <div>
            <strong>
                Galeria:
            </strong>
        </div>
        <div class="col-4 py-2">
            <?php if ($producto && $producto->imagen1 != '' && file_exists(WWW_ROOT . $producto->imagen1)) : ?>
                <img id="img_url_1" src="<?= $this->Url->build("/" .  $producto->imagen1, ['fullBase' => true]) ?>" style="object-fit:contain" width="100%" />
            <?php endif; ?>
        </div>
        <div class="col-4 py-2">
            <?php if ($producto && $producto->imagen2 != '' && file_exists(WWW_ROOT . $producto->imagen2)) : ?>
                <img id="img_url_2" src="<?= $this->Url->build("/" . $producto->imagen2, ['fullBase' => true]) ?>" style="object-fit:contain" width="100%" />
            <?php endif; ?>
        </div>
        <div class="col-4 py-2">
            <?php if ($producto && $producto->imagen3 != '' && file_exists(WWW_ROOT . $producto->imagen3)) : ?>
                <img id="img_url_3" src="<?= $this->Url->build("/" . $producto->imagen3, ['fullBase' => true]) ?>" style="object-fit:contain" width="100%" />
            <?php endif; ?>
        </div>
    </div>
    <hr>
</div>