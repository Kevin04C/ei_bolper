<div>
    <?= $this->Form->create(null,['enctype'=>'multipart/form-data']); ?>
    <div class="row">
        <div class="col-md-3 form-group">
            <label for="">Fecha Promocion</label>
            <input class="form-control" name="fecha" type="date" value="<?= $oferta_fecha ?>" />
        </div>
        <div class="col-md-3 form-group">
            <label for="">Hora Promocion</label>
            <input class="form-control" name="hora" type="time" value="<?= $oferta_hora ?? '' ?>" />
        </div>
        <div class="col-md-3 form-group">
            <label for="">Whatsapp Soporte</label>
            <input class="form-control" name="whatsapp_soporte" value="<?= $whatsapp_soporte ?? '' ?>" />  
        </div>
        <div class="col-md-3 form-group">
            <label for="">Whatsapp Ventas</label>
            <input class="form-control" name="whatsapp_ventas" value="<?= $whatsapp_ventas ?? '' ?>" />  
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-4 form-group">
            <?= $this->Form->control('adjunto', [ 'label' => 'Imagen promociÃ³n', 'type' => "file", 'class' => 'form-control',  'id' => 'imagen1' , 'onchange' => 'readURL(event, "img_url_1")' ,  "accept"=>"img/*"]); ?>
            <div class="mt-2 text-center">
                <img id="img_url_1" src="<?=  $this->Url->build("/". $imagen_promocion ?? '') ?>" style="object-fit:contain;max-height:400px;width:100%" />
            </div>
        </div>
        <div class="col-md-4 form-group">
            <?= $this->Form->control('adjunto_yape', [ 'label' => 'QR Yape', 'type' => "file", 'class' => 'form-control',  'id' => 'imagen2' , 'onchange' => 'readURL(event, "img_url_2")' ,  "accept"=>"img/*"]); ?>
            <div class="mt-2 text-center">
                <img id="img_url_2" src="<?=  $this->Url->build("/". $imagen_yape ?? '') ?>" style="object-fit:contain;max-height:400px;width:100%" />
            </div>
        </div>
        <div class="col-md-4 form-group">
            <?= $this->Form->control('adjunto_plin', [ 'label' => 'Imagen promociÃ³n', 'type' => "file", 'class' => 'form-control',  'id' => 'imagen3' , 'onchange' => 'readURL(event, "img_url_3")' ,  "accept"=>"img/*"]); ?>
            <div class="mt-2 text-center">
                <img id="img_url_3" src="<?=  $this->Url->build("/". $imagen_plin ?? '') ?>" style="object-fit:contain;max-height:400px;width:100%" />
            </div>
        </div>
    </div>
    <div class="row pt-3">
    <div class="col-md-12 form-group">
        <label for="">Texto de promoci¨®n</label>
        <?= $this->Form->textarea('texto_promocion', [ 'class' => 'form-control', 'rows' => '3' ]) ?>
    </div>
    
    <div class="pt-5 px-2">
        <?= $this->Form->button( '<i class="fa fa-save"></i> Actualizar', ['class' => 'btn btn-primary btn-sm' , 'escapeTitle' => false ]) ?>
    </div>
    <?= $this->Form->end(); ?>
</div>