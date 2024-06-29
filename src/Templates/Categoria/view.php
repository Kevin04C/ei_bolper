
<div class="row">
        <div class="categoria view content">
            <h3> # <?= h($categoria->id_categoria) ?> | <?= h($categoria->nom_categoria) ?> </h3>
            <div class="text">
                <strong>Descripcion: </strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($categoria->desc_categoria)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
