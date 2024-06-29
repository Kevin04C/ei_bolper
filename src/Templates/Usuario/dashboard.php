<div class="container">
    <div class="row">
        <div class="col-md-6">
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
        </div>
        <div class="col-md-6">
            <h2>VENTAS TOTALES: S/.<?php echo h($totalVentas); ?></h2>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>GRÁFICO DE LOS PRODUCTOS MÁS VENDIDOS</h2>
            <canvas id="productosMasVendidosChart" height="100"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
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
</script>