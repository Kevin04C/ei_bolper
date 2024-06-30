<div class="container">
    <div class="">
        <!-- <div class="col-md-6">
            <h2>Tabla de los 3 productos vendidos</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Total Vendido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($topProducts as $product) : ?>
                        <tr>
                            <td><?php echo h($product->producto_nombre); ?></td>
                            <td><?php echo h($product->total_vendido); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> -->
        <div class="" 
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;"
        >
            <h2>VENTAS TOTALES: S/.<?php echo h($totalVentas); ?></h2>
            <buttona id="imprimir_button" class="btn btn-secondary btn-sm">Imprimir Grafico</button>
        </div>

        <div class="row mb-3">

            <div class="col px-1">
                Fecha Inicio
                <input id="opt_fech_ini" name="opt_fech_ini" class="form-control" placeholder="Fecha" type="date" /> 
            </div>
            <div class="col px-1">
                Fecha Fin
                <input id="opt_fech_fin" name="opt_fech_fin" class="form-control" placeholder="Fecha" type="date" /> 
            </div>
            <div  class="col px-1">
                Tipo de graficos
                <select id="list_opciones" name="opt_estado" class="form-select">
                    <option value="1" selected>-Productos más vendidos-</option>
                    <option value="2" selected>-Productos menos vendidos-</option>
                    <option value="3" selected>-Productos con 0 stock-</option>
                    <option value="4" selected>-Días con menos ventas-</option>
                    <option value="5" selected>-Clientes con más compras-</option>
                </select>
            </div>

            <div class="col px-1" style=" padding-top: 1.2rem;">
                <button id="boton_consultar" class="btn btn-primary"> <i class="fas fa-search"></i> Buscar </button>
            </div>

        </div>

        

    
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2 id="text_grafico">GRÁFICO DE LOS PRODUCTOS MÁS VENDIDOS</h2>
            <canvas id="productosMasVendidosChart" height="100"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    document.addEventListener("DOMContentLoaded", function() {

        setInitValues();

        var topproducto = <?= json_encode($totalVentas) ?>;
        var ctx = document.getElementById('productosMasVendidosChart').getContext('2d');
        var productosMasVendidosChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($topProducts as $product) {
                        echo '"' . h($product->producto_nombre) . '", ';
                    } ?>
                ],
                datasets: [{
                    label: 'Total Vendido',
                    data: [
                        <?php foreach ($topProducts as $product) {
                            echo h($product->total_vendido) . ', ';
                        } ?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            },
                        }
                    }
                }
            }
        });
    });

    document.getElementById('imprimir_button').addEventListener('click', function() {
        window.print();
    });

    document.getElementById('boton_consultar').addEventListener('click', function() {
        // console.log('Consultar');
        var fechaInicio    =  document.getElementById('opt_fech_ini').value;
        var fechaFin       =  document.getElementById('opt_fech_fin').value;
        var grafico_select = document.getElementById('list_opciones').value;

        


    });

    // Seteamos valores
    function setInitValues() {
        // inicio del mes
        document.getElementById('opt_fech_ini').value = new Date().toISOString().split('T')[0].split('-')[0] + '-' + new Date().toISOString().split('T')[0].split('-')[1] + '-01';
        //  hoy 
        document.getElementById('opt_fech_fin').value = new Date().toISOString().split('T')[0];
    };



</script>