
<form action="" method="get" id="formFiltro">
    <div class="row mb-3">
        <div class="col px-1">
            <input name="opt_num_pedido" class="form-control" placeholder="# Pedido" value="<?= $opt_num_pedido ?>" /> 
        </div>
        <div class="col px-1">
            <input name="opt_nombre" class="form-control" placeholder="Nombre usuario" value="<?= $opt_nombre ?>" /> 
        </div>
        <div class="col px-1">
            <input name="opt_fech_ini" class="form-control" placeholder="Fecha" type="date" value="<?= $opt_fech_ini ?>" /> 
        </div>
        <div class="col px-1">
            <input name="opt_fech_fin" class="form-control" placeholder="Fecha" type="date" value="<?= $opt_fech_fin ?>" /> 
        </div>
        <div class="col px-1">
            <?php $estados ?>
            <select name="opt_estado" class="form-select">
                <option value="" selected>-Todos-</option>
                <?php foreach($estados as $k => $ee): ?>
                    <option value="<?= $k ?>" <?= $k == $opt_estado ? 'selected' : '' ?>> <?= $ee ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary"> <i class="fas fa-search"></i> Buscar </button>
            <button class="btn btn-danger" type="button" onclick="limpiar()"> <i class="fas fa-eraser"></i> Limpiar </button>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id_pedido', ['label' => 'Id']) ?></th>
                <th><?= $this->Paginator->sort('usuario_id', ['label' => 'Usuario']) ?></th>
                <th><?= $this->Paginator->sort('cantidad') ?></th>
                <th>Detalle</th>
                <th>Img Pago</th>
                <th class="actions text-center"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedido as $ped): ?>
            <tr>
                <td><?= str_pad((String) $ped->id_pedido , '7', '0', STR_PAD_LEFT) ?></td>
                <td>
                    <?= $ped->has('usuario') 
                    ? $ped->usuario->nom_usuario 
                    : '' ?>
                </td>
                <td><?= $this->Number->format($ped->cantidad) ?></td>
                <td>
                    Fecha: <?php try { echo $ped->fecha_orden->format("d-m-Y"); } catch (\Throwable $th) {} ?> <br>
                    Estado: 
                    <?php if($ped->estado_orden == 'ENTREGADO'): ?>
                        <span class="badge bg-success"> <?= h($ped->estado_orden) ?> </span> 
                    <?php elseif($ped->estado_orden == 'PROCESO'): ?>
                        <span class="badge bg-primary"> <?= h($ped->estado_orden) ?> </span> 
                    <?php elseif($ped->estado_orden == 'PAGADO'): ?>
                        <span class="badge bg-info"> <?= h($ped->estado_orden) ?> </span> 
                    <?php elseif($ped->estado_orden == 'NUEVO'): ?>
                        <span class="badge bg-secondary"> <?= h($ped->estado_orden) ?> </span> 
                    <?php elseif($ped->estado_orden == 'CANCELADO'): ?>
                        <span class="badge bg-danger"> <?= h($ped->estado_orden) ?> </span> 
                    <?php endif; ?>
                    <br>
                    Total: $. <?= h($ped->total) ?> 
                </td>
                <td style="width:100px">
                    <?php if($ped->ruta_pago_adjunto != '' && file_exists(WWW_ROOT . $ped->ruta_pago_adjunto )) : ?>
                        <a href="<?= $this->Url->build( "/". $ped->ruta_pago_adjunto , ['fullBase'=> true]) ?>" target="_blank" rel="noopener noreferrer"> 
                            Adjunto de Pago <i class="fas fa-external-link-alt"></i>
                        </a>
                    <?php endif; ?>
                </td>
                <td class="actions text-center" style="width:120px">
                    <div class="dropdown">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </a>
                        <ul class="dropdown-menu"  style="min-width: 130px">
                            <li>
                                <?= $this->Html->link(__('Detalles'), ['action' => 'view', $ped->id_pedido] , ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                                <?php if($ped->estado_orden == 'PROCESO' || $ped->estado_orden == 'PAGADO'): ?>
                                    <!-- <a href="<?= $this->Url->build("/". $ped->ruta_adjunto) ?>" target="_blank" class="dropdown-item" > Ver Voucher </a > -->
                                    <?= $this->Html->link(__('Cancelar Pedido'), ['action' => 'pedido-cancelar', $ped->id_pedido], ['class' => 'dropdown-item']) ?>
                                    <?= $this->Html->link(__('Entregar Pedido'), ['action' => 'pedido-entregado', $ped->id_pedido], ['class' => 'dropdown-item']) ?>
                                <?php endif; ?>
                            </li>
                            <li>
                                <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $ped->id_pedido], ['confirm' => __('Are you sure you want to delete # {0}?', $ped->id_pedido) , 'class' => 'dropdown-item']) ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->element('paginador') ?>
</div>
