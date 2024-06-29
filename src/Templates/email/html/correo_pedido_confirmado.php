<div   style="border: 2px solid #E1E6EA;padding: 10px 15px 10px 15px;max-width: 600px;justify-content: center"  >
    <div style="background-color:#15161D; text-align:center">
        <img style=" max-height: 70px;margin-left: auto;margin-right: auto" src="cid:logo" alt="logo"  />
    </div>
    <p>
        ¡Hola <?=$pedido->cliente_nombre?>! su pedido a sido registrado y confirmado. Gracias por usar la página Data Center
        <br>
        <br>
        <div>
            <h5>Pedido # <?= h($pedido->id_pedido) ?></h5>
            <div>Total: <?= $pedido->total ?> </div>
            <div>Metodo de Entrega: <?= $pedido->metodo_entrega ?> </div>
        </div>
        <table style="width: 100%; padding-top:15px" border="1">
            <?php foreach ($detalles as $k => $detalle): ?>
            <tr>
                <th># Pedido</th>
                <th>Cant.</th>
                <th>Producto</th>
                <th>P. Uni</th>
                <th>Total</th>
            </tr>
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
            </tr>
            <?php endforeach; ?>
        </table>
    </p>

</div>
