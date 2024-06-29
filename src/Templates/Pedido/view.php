
<div>
    <h5>Pedido # <?= h($pedido->id_pedido) ?></h5>
    <div>Cliente: <?= $pedido->has('usuario')  ? $pedido->usuario->nom_usuario : '-'?> </div>
    <div>Estado: <?= $pedido->estado_orden  ?> </div>
    <div>Total: <?= $pedido->total ?> </div>
    <div>Metodo de Entrega: <?= $pedido->metodo_entrega ?> </div>
    <div>Metodo de pago: <?= $pedido->metodo_pago ?> </div>
    <div> 
        <a class="" href="<?= $this->Url->build("/". $pedido->ruta_adjunto) ?>" target="_blank" > Ver adjunto </a>
    </div>
</div>
<div class="py-4">
    <h5>Datos de Facturacion</h5>
    <div>
        <div> Nombre : <?= $pedido->cliente_nombre ?> </div>
        <div> Coreo : <?= $pedido->cliente_correo ?> </div>
        <div> Dirección : <?= $pedido->cliente_direccion ?> </div>
        <div> Teléfono : <?= $pedido->cliente_telefono ?> </div>
        <div> Departamento : <?= $pedido->cliente_departamento ?> </div>
        <div> Cod. Postal : <?= $pedido->cliente_codigo_postal ?> </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-center" style="width:80px"><?= $this->Paginator->sort('cantidad') ?></th>
                <th>Producto</th>
                <th><?= $this->Paginator->sort('producto_puitarionincigv', ['label' => 'P. Unitario']) ?></th>
                <th><?= $this->Paginator->sort('producto_total', ['label' => 'Total']) ?></th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalle_pedido as $k => $detalle): ?>
            <tr>
                <td><?= (int) $k + 1 ?></td>
                <td class="text-center"><?= $this->Number->format($detalle->pedido_cantidad) ?></td>
                <td>
                    <?= $detalle->has('producto') 
                    ? $detalle->producto->nom_producto 
                    : '' ?>
                </td>
                <td>
                    S/. <?= $this->Number->format($detalle->producto_punitarioincigv, ['precision' => 2, 'places' => 2]) ?>
                </td>
                <td>
                    S/. <?= $this->Number->format($detalle->producto_total, ['precision' => 2, 'places' => 2]) ?>
                    
                </td>
                <td>
                    <?php if($detalle->producto && $detalle->producto->imagen1 != '' && file_exists(WWW_ROOT. $detalle->producto->imagen1 )) : ?>
                        <div
                            data-bs-placement="left"
                            data-bs-toggle="tooltip" data-bs-html="true" 
                            data-bs-offset="-550,0"
                            data-bs-title="<div> <img src='<?= $this->Url->build("/" . $detalle->producto->imagen1) ?>' alt='Imagen del Producto' width='500' </div>"
                        >
                            <img src="<?= $this->Url->build("/" . $detalle->producto->imagen1) ?>" alt="Imagen del Producto" height="50px"/>
                        </div>
                    <?php endif; ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->element('paginador') ?>
</div>
<style>
    .tooltip-arrow{
        display: none !important;
    }
    .tooltip.show{
        opacity: 0.92 !important;
    }
    .tooltip-inner{
        max-width: 80vw !important;
    }
</style>