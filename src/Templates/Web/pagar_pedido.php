
<div class="section">
    <!-- container -->
    <div class="container">
        <?php if ($pedido->metodo_pago == 'yape' || $pedido->metodo_pago == 'plin' ): ?> 
            <?= $this->Form->create( null, [ 'onsubmit' => 'submitPagarPedido(event)' , 'id' => 'form_pedido' , "enctype" => "multipart/form-data" , 'style' => 'text-align:center;']) ?>
            <div class="payment-method">
                <div class="form-group">
                    <label for="">Adjuntar voucher de pago</label>
                    <input type="file" class="form-control" name="adjunto_pago" id="id_archivo_img" required />
                </div>
            </div>
            <button type="submit" class="primary-btn order-submit" id="btn_submit"> Guardar pago <i class="fa fa-arrow-circle-right"></i></button> 
            <?= $this->Form->end(); ?>
        <?php endif; ?> 
    </div>
</div>
<?php echo $this->Html->ScriptBlock("var pedido_id = " . json_encode($pedido->id_pedido)  ); ?>
<?php echo $this->Html->ScriptBlock("var metodo_pago = " . json_encode($pedido->metodo_pago)  ); ?>

