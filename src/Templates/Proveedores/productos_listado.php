
<form id="form_filtro">
    <div class="row">
        <div class="col-12 col-md-9 py-2">
            <?= $this->Form->control('categoria_id',[ 'name' => 'opt_categoria', 'class' => 'form-select', 'options' => $categorias, 'empty' => '-Seleccione-' ]); ?>
        </div>
        <div class="col-md-3" style="max-width: 240px">
            <br>
            <?= $this->Form->button('<i class="fa fa-search"></i> Buscar', ['class' => 'btn btn-primary btn-sm', 'escapeTitle' => false, 'id' => 'btn_buscar', 'type' => 'submit']) ?>
            
            <?= $this->Form->button('<i class="fa fa-eraser"></i> Limpiar', ['class' => 'btn btn-danger btn-sm', 'escapeTitle' => false, 'id' => 'btn_limpiar', 'type' => 'button']) ?>
        </div>
    </div>
</form>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('categoria_id', ['label' => 'Categorias']) ?></th>
                <th><?= $this->Paginator->sort('nom_producto', ['label' => 'Nombre']) ?></th>
                <th>Detalles</th>
                <th>Galería</th>
                <th> <?= $this->Paginator->sort('cantidad') ?> | <?= $this->Paginator->sort('stock') ?></th>
                <th>Fechas</th>
                <th class="actions text-center"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= $this->Number->format($producto->id) ?></td>
                <td>
                    <div>
                        <span class="badge bg-primary">Cat</span> <?= $producto->categoria ? $producto->categoria->nom_categoria : '' ?>
                    </div>
                </td>

                <td><?= h($producto->nom_producto) ?></td>

                <td>
                    <?= h($producto->marca_producto) ?>
                    <?= $this->Number->format($producto->precio_producto) ?>
                    <?= $this->Number->format($producto->desc_producto) ?>
                </td>

                <td>
                    <?php if($producto->imagen1 != '' && file_exists(WWW_ROOT . $producto->imagen1)) : ?>
                        <li>
                            <a href="<?= $this->Url->build("/" . $producto->imagen1, ['fullBase' => true]) ?>" target="_blank" rel="noopener noreferrer"> 
                                Imagen 1 <i class="fas fa-external-link-alt"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($producto->imagen2 != '' && file_exists(WWW_ROOT . $producto->imagen2)) : ?>
                        <li>
                            <a href="<?= $this->Url->build("/" . $producto->imagen2, ['fullBase' => true]) ?>" target="_blank" rel="noopener noreferrer"> 
                                Imagen 2 <i class="fas fa-external-link-alt"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($producto->imagen3 != '' && file_exists(WWW_ROOT . $producto->imagen3)) : ?>
                        <li>
                            <a href="<?= $this->Url->build("/" . $producto->imagen3, ['fullBase' => true]) ?>" target="_blank" rel="noopener noreferrer"> 
                                Imagen 3 <i class="fas fa-external-link-alt"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </td>
                
               <td> 
                <div><?= h($producto->cantidad) ?> </div>
                <div><?= h($producto->Estado === '1' ? 'Sin Stock' : 'En Stock') ?> </div>
               </td>

                <td>
                    <div>
                        F. Creacion: <?php try { echo $producto->fecha_publicacion->format("d-m-Y H:i"); } catch (\Throwable $th) {} ?>
                    </div>
                    <div>
                        F. Modificacion:  <?php try { echo $producto->fecha_actualizacion->format("d-m-Y H:i"); } catch (\Throwable $th) {} ?>
                    </div>
                </td>
                <td class="actions text-center" style="width:120px">
                    <div class="dropdown">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </a>
                        <ul class="dropdown-menu"  style="min-width: 130px">
                            <li>
                                <?= $this->Html->link(__('Detalles'), ['action' => 'view', $producto->id], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $producto->id], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $producto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $producto->id), 'class' => 'dropdown-item']) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->element('paginador') ?>


