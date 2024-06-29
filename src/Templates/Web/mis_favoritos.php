<div class="section">
	<div class="container">
        <div style="font-size:2em;margin-bottom:30px">
            Mis Favoritos
        </div>
        <div class="table-responsie">
            <table class="table tabke-striped">
                <thead>
                    <tr>
                        <th> Nombre del Producto </th>
                        <th> Imagen </th>
                        <th> F. Agregado </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($favoritos as $fav): ?>
                        <tr>
                            <td> 
                                <?= $fav->producto ? $fav->producto->nom_producto : '' ?> 
                            </td>
                            <td>
                                <div>
                                    <img class="img-detalle" src="<?= $fav->producto ? $this->Url->build( "/" . $fav->producto->imagen1 ) : "" ?>" alt="Imagen del Producto">
                                </div>
                            </td>   
                            <td> <?php try { echo $fav->fecha_publicacion->format("d-m-Y H:i"); } catch (\Throwable $th) {} ?> </td>
                            <td>
                                <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'eliminarFavorito', $fav->id_favorito], ['confirm' => __('¿Eliminar favorito?', $fav->id_favorito), 'escapeTitle' => false ,'style' => 'font-size:1.2em' ] ) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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