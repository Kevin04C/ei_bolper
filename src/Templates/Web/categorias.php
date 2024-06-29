<div class="row">
    <div class="col-md-4">
        <h2>Categorias</h2>
        <ul>
        <?php foreach($cats as $cat): ?>
            <li><?= $cat->nom_categoria ?> </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-8">
        Aui se ven los productos
        <?= $this->Html->Image("carpeta2/cake-logo.png")?>
    </div>
</div>
<?= $this->Html->Script("ejemplo2.js"); ?>
