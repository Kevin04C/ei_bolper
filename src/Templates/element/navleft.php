<ul class="list-unstyled gw-navleft">

    <?php if ($usuario_sesion['tipo'] == 'ADM') : ?>
        <li>
            <a href="<?= $this->Url->Build(['controller' => 'Usuario', 'action' => 'dashboard']) ?>">
                <i class="fas fa-chart-line fa-fw"></i> Inicio
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->Build(['controller' => 'Categoria', "action" => "index"]) ?>">
                <i class="fa fa-puzzle-piece fa-fw"></i> Categorias
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->Build(['controller' => 'Producto']) ?>">
                <i class="fas fa-tag fa-fw"></i> Productos
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->Build(['controller' => 'Pedido', 'action' => 'index']) ?>">
                <i class="fas fa-calendar-check fa-fw"></i> Pedidos
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->Build(['controller' => 'Usuario', 'action' => 'index']) ?>">
                <i class="fa fa-user-circle fa-fw"></i> Usuarios
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->Build(['controller' => 'Usuario', 'action' => 'clientes']) ?>">
                <i class="fas fa-users fa-fw"></i> Clientes
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->Build(['controller' => 'proveedores', 'action' => 'index']) ?>">
                <i class="fas fa-users fa-fw"></i> Proveedores
            </a>
        </li>

    <?php endif; ?>
    <?php if ($usuario_sesion['tipo'] == 'PROVEEDOR') : ?>
        <li>
            <a href="<?= $this->Url->Build(['controller' => 'Proveedores', 'action' => 'productos-listado']) ?>">
                <i class="fa fa-puzzle-piece fa-fw"></i> Productos
            </a>
        </li>
    <?php endif; ?>

    <li>
        <hr />
        <?= $this->Html->Link("<i class='fas fa-sign-out-alt fa-fw'></i> Salir del Sistema", ['controller' => 'Usuario', 'action' =>  'logout'], ['class' => '', 'escape' => false]); ?>
    </li>

</ul>