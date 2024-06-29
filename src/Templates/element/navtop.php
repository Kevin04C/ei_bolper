<nav class="navbar navbar-expand-lg gw-navtop px-2">
    <button class="btn btn-light" id="menu-toggle">
        <span class="navbar-toggler-icon"> <i class="fas fa-bar fa-fw"></i> </span>
    </button>
    <div class=" d-none d-sm-block mr-auto">
        <ul class="navbar-nav">
            <?php
            if (isset($top_links)) {
                if (isset($top_links['title'])) :
                    echo "<li class='nav-link px-2 gw-navtop-titulo'>". $top_links['title'] . "</li>";
                endif;
                echo "<li class='nav-item'><a href='#' id='btnFullBack'  class='nav-link'><i class='fas fa-chevron-circle-left'></i> Atrás</a></li>";
                if (isset($top_links['links'])) :
                    foreach ($top_links['links'] as $id => $link) {
                        $params2 = ['id' => $id, 'escape' => false, 'class' => 'nav-link'];
                        $params2 = isset($link['params2']) ? array_merge($params2, $link['params2']) : $params2;

                        echo "<li class='nav-item'>";
                        echo $this->Html->Link($link['name'], $link['params'], $params2);
                        echo "</li>";
                    }
                endif;
                if (isset($top_links['functions'])) :
                    foreach ($top_links['functions'] as $id => $link) {
                        echo "<li class='nav-item'>";
                        echo "<a href='javascript:void(0)' class='nav-link' onclick='" . $link['funcion'] . "'>" . $link['name'] . "</a>";
                        echo "</li>";
                    }
                endif;
            }
            ?>

        </ul>
    </div>
</nav>