<div class="row">
        <div class="categoria view content">
            <h3> # <?= h($subcategoria->id_subcategoria) ?> | <?= h($subcategoria->nom_subcategoria) ?> </h3>
            <div class="text">
                <strong>Categoria Padre: </strong>
                <li>
                    <?= $subcategoria ? $subcategoria->categorium->nom_categoria : '' ?> 
                </li>
            </div>
        </div>
    </div>
</div>