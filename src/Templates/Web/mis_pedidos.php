<div class="section">
	<div class="container">
        <div style="font-size:2em;margin-bottom:30px">
            Mis Pedidos
        </div>
        <div class="table-responsie">
            <?php if(isset($pedidos)): ?>
            <table class="table tabke-striped">
                <thead>
                    <tr>
                        <th> Codigo </th>
                        <th> Fecha </th>
                        <th> Estado </th>
                        <th> Total </th>
                        <th style="width:30px"> Acc. </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pedidos as $pedido): ?>
                        <tr>
                            <td> <?= $pedido->id_pedido ?> </td>
                            <td> <?= $pedido->fecha_orden->format("d-m-Y H:i"); ?> </td>
                            <td> <?= $pedido->estado_orden ?> </td>
                            <td> <?= $pedido->total ?> </td>
                            <td class="text-center" style="font-size:1.2em"> <a href="<?= $this->Url->build(['action' => 'mis-pedidos' , $pedido->id_pedido]) ?>" > <i class="fa fa-eye"></i> </a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div style="padding-bottom:10px">
                <a href="<?= $this->Url->build(['action' => 'mis-pedidos']) ?>" > <i class="fa fa-list"></i> Volver a mis pedidos </a>
            </div>
            <div>
                Pedido : <?= $pedido_unico->id_pedido ?> <br>
                Fecha : <?php try { echo $pedido_unico->fecha_orden->format("d-m-Y H:i"); } catch (\Throwable $th) {} ?>
            </div>
            <table class="table tabke-striped">
                <thead>
                    <th> Codigo </th>
                    <th> Nombre </th>
                    <th> Cantidad</th>
                    <th> P. Unitario</th>
                    <th> Total </th>
                </thead>
                <tbody>
                    <?php foreach($detalle_pedido as $detalle): ?>
                    <tr>
                        <td> <?= $detalle->id ?> </td>
                        <td> 
                            <div>
                                <img class="img-detalle" src="<?= $detalle->producto ? $this->Url->build( "/" . $detalle->producto->imagen1 ) : "" ?>" alt="Imagen del Producto">
                                <label style="padding-left:20px">
                                    <?= $detalle->producto_nombre ?> 
                                </label>
                            </div>
                        </td>
                        <td> <?= $detalle->pedido_cantidad ?> </td>
                        <td> <?= $detalle->producto_punitarioincigv ?> </td>
                        <td> <?= $detalle->producto_total ?> </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
            <div class="text-center">
                <?= $this->element('paginador') ?>
            </div>
        </div>
    </div>
</div>
<style>
    .img-detalle{
        width: 80px;
        object-fit: contain;
    }
</style>