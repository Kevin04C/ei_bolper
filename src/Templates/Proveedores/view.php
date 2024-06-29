<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proveedore $proveedor
 */
?>
<div class="row">
   
    <div class="column-responsive column-80">
        <div class="proveedores view content">
            <table>
                <tr>
                    <th style="width: 200px;"><?= __('Razon Social') ?></th>
                    <td><?= h($proveedor->razon_social) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre Comercial') ?></th>
                    <td><?= h($proveedor->nombre_comercial) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefono') ?></th>
                    <td><?= h($proveedor->telefono) ?></td>
                </tr>
                <tr>
                    <th><?= __('Correo') ?></th>
                    <td><?= h($proveedor->correo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= $proveedor->usuario === null ? '' : $proveedor->usuario->nom_usuario ?></td>
                </tr>
                <tr>
                    <th><?= __('Creado') ?></th>
                    <td><?= h($proveedor->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripcion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($proveedor->descripcion)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
