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
                    <option value="6" selected>-Todas las ventas por rango-</option>
                </select>
            </div>

            <div class="col px-1" style=" padding-top: 1.2rem;">
                <button id="boton_consultar" class="btn btn-primary"> <i class="fas fa-search"></i> Buscar </button>
            </div>

        </div>

        

    
    </div>
    <br>
    <div class="row" >
        <div class="col-md-12">
            <h2 id="text_grafico">GRÁFICO DE LOS PRODUCTOS MÁS VENDIDOS</h2>
            <div id="graficoo">
                <canvas id="productosMasVendidosChart" height="100"></canvas>
            </div>
           
            <h2 id="ventas" style="display: none;"></h2>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var productosMasVendidosChart = null;
    
    document.addEventListener("DOMContentLoaded", function() {

        setInitValues();

        var topproducto = <?= json_encode($totalVentas) ?>;
        var ctx = document.getElementById('productosMasVendidosChart').getContext('2d');
        productosMasVendidosChart = new Chart(ctx, {
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
        console.log('Consultar');

        var fechaInicio    =  document.getElementById('opt_fech_ini').value;
        var fechaFin       =  document.getElementById('opt_fech_fin').value;
        var grafico_select = document.getElementById('list_opciones').value;

        $.ajax({
            // headers: { 'X-CSRF-Token': <?php $_csrfToken ?> },
            url: base + "usuario/obtener-informacion-grafico",
            data: { fechaInicio : fechaInicio, fechaFin : fechaFin, tipo : grafico_select },
            type: 'GET',
            dataType: 'JSON',
            success: function (r) {
                var list = r.data;

                var labels = [];
                var data = [];
                var label = "";
                var construir = false;
                
                for (var i = 0; i < list.length; i++) {
                    labels.push(list[i].nombre);
                };

                for (var i = 0; i < list.length; i++) {
                    data.push(list[i].cantidad);
                };

                document.getElementById('ventas').style.display = 'none';
                document.getElementById('graficoo').style.display = 'flex';

                if(grafico_select == 1){
                    document.getElementById('text_grafico').innerHTML = 'GRÁFICO DE LOS PRODUCTOS MÁS VENDIDOS';
                    label = 'Total Vendido';
                    construir = true;   
                }else if(grafico_select == 2){
                    document.getElementById('text_grafico').innerHTML = 'GRÁFICO DE LOS PRODUCTOS MENOS VENDIDOS';
                    label = 'Total Vendido';
                    construir = true;   
                }else if(grafico_select == 3){
                    document.getElementById('text_grafico').innerHTML = 'GRÁFICO DE LOS PRODUCTOS CON 0 STOCK';
                    label = 'Stock';
                    construir = true;   
                }else if(grafico_select == 4){
                    document.getElementById('text_grafico').innerHTML = 'GRÁFICO DE LOS DÍAS CON MENOS VENTAS';
                    label = 'Total Vendido';
                    construir = true;   
                }else if(grafico_select == 5){
                    document.getElementById('text_grafico').innerHTML = 'GRÁFICO DE LOS CLIENTES CON MÁS COMPRAS';
                    label = 'Total Comprado';
                    construir = true;   
                }else if(grafico_select == 6){
                    document.getElementById('text_grafico').innerHTML = 'LAS VENTAS POR RANGO';
                    label = 'Total Vendido';
                    // ocultamos el grafico porque sera solo un html 
                    document.getElementById('graficoo').style.display = 'none';
                    // mostramos el total de ventas 
                    document.getElementById('ventas').style.display = 'flex';
                    document.getElementById('ventas').innerHTML = 'Total de ventas: S/.' + list;
                    construir = true;   

                }
                

                // destriyo el anterior
                productosMasVendidosChart.destroy();
                if(!construir){
                    return;
                }
                var ctx = document.getElementById('productosMasVendidosChart').getContext('2d');
                productosMasVendidosChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: data ,
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

                
            },error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    // Seteamos valores
    function setInitValues() {
        // inicio del mes
        document.getElementById('opt_fech_ini').value = new Date().toISOString().split('T')[0].split('-')[0] + '-' + new Date().toISOString().split('T')[0].split('-')[1] + '-01';
        //  hoy 
        document.getElementById('opt_fech_fin').value = new Date().toISOString().split('T')[0];

        // grafico 1 por defecto
        document.getElementById('list_opciones').value = 1;
    };



</script>