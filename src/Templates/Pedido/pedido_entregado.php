<?= $this->Form->create($pedido,['enctype'=>'multipart/form-data']) ?>
    <fieldset>
        <div class="py-2 text-center">
            <?php if($pedido->ruta_pago_adjunto != '' && file_exists( WWW_ROOT . $pedido->ruta_pago_adjunto )): ?>
                <a href="<?= $this->Url->build("/". $pedido->ruta_pago_adjunto)?>" target="_blank">
                    <img src="<?= $this->Url->build("/". $pedido->ruta_pago_adjunto)?>" style="max-height:250px;object-fit: contain" />
                </a>
                <div class="pt-2">
                    <label for="">Voucher del cliente</label>
                </div>
            <?php else:?>
                <div class="pt-2">
                    <label for="">Este pedido no tiene pagos</label>
                </div>
            <?php endif; ?>
        </div>
        <div class="py-2">
            <?= $this->Form->control('adjunto', [ 'label' => 'Adjuntar una Boleta o Factura', 'type' => "file", 'class' => 'form-control', 'required' ,  "accept"=>"application/pdf"]); ?>
        </div>
        <div class="message-info" >
            Guardar este formulario registrara el pedido como Entregado y ya no se podra editar.
        </div>
        <div class="py-2" >
            <?= $this->Form->button( '<i class="fa fa-save"></i> Confirmar entrega', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
        </div>
    </fieldset>
<?= $this->Form->end() ?>
<style>
    .message-info{
        padding: 10px;
        background-color: #85C1E9;
        border: 1px solid #3498DB;
        border-radius: 10px;
        color: white;
        padding-top: 10px;
        padding-bottom: 10px;
    }
</style>

