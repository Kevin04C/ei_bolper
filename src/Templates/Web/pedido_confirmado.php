
<div class="section">
    <div class="container" >
        <div class="message-info" onclick="this.classList.add('hidden');">
        <?php 
            if($pedido && $pedido->metodo_entrega =='DELIVERY'){
                echo "Pedido confirmado, se le llamará al celular que proporciono para el pago correspondiente al envío.";
            }else{
                echo "Pedido confirmado, le escribiremos a su correo.";
            }
        ?>
        </div>
    </div>
</div>
<style>
    .message-info{
        padding: 10px;
        background-color: #85C1E9;
        border: 1px solid #3498DB;
        border-radius: 10px;
    }
</style>