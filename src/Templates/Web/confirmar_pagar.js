$( document ).ready(function() {
    generarListaItems();
    $("#shiping-address").on('change', function(){
        if($(this).prop('checked')){
            $("[name=nom_usuario]").attr('required', true);
            $("[name=correo_usuario]").attr('required', true);
            $("[name=direccion]").attr('required', true);
            $("[name=departamento]").attr('required', true);
            $("[name=codigo_postal]").attr('required', true);
            $("[name=telef_usuario]").attr('required', true);
        }else{
            $("[name=nom_usuario]").attr('required', false);
            $("[name=correo_usuario]").attr('required', false);
            $("[name=direccion]").attr('required', false);
            $("[name=departamento]").attr('required', false);
            $("[name=codigo_postal]").attr('required', false);
            $("[name=telef_usuario]").attr('required', false);
        }
    })
   
    $("#create_account").on('change', function(){
        if($(this).prop('checked')){
            $("[name=contrasena]").attr('required', true);
        }else{
            $("[name=contrasena]").attr('required', false);
        }
    })
    $("[name=metodo_entrega]").on('change', function(){
        if($(this).val() == 'DELIVERY'){
            $("[name=metodo_pago]").attr('required', false);
            $("#img_pagar").css('display', 'none');
        }else{
            $("[name=metodo_pago]").attr('required', true);
            $("#img_pagar").css('display', 'block');
        }
    })
    
   
});
function generarListaItems(){
    var total = 0;
    var cantidad_prod = 0;
    var html = '';
    Carrito.items.forEach((e)=>{
        html += `
        <div class="product-widget">
            <div class="product-img">
                <img src="${base_root}${ e.producto ? e.producto.imagen1 : 'img/product01.png' }" alt="Imagen del Producto">
            </div>
            <div class="product-body">
                <h3 class="product-name"><a href="#"> ${e.producto_nombre} </a></h3>
                ${e.oferta_activa == '1' ? '<span> Precio en Oferta  </span>' : ''}
                <div>
                    <h4 class="product-price">
                    <span class="qty"> 
                        ${e.pedido_cantidad} x  ${Number.parseFloat(e.producto_punitarioincigv).toFixed(2)}
                    </span> 
                    =
                    <span style="margin-left:20px"> 
                        ${Number.parseFloat(e.producto_total).toFixed(2)} </h4>
                    </span> 
                </div>
            </div>
            <button class="delete" onclick="eliminarItem(${e.id})"><i class="fa fa-close"></i></button>
        </div>`;
        total = Number.parseFloat(e.producto_total) + Number.parseFloat(total);
        cantidad_prod += 1;
    })

    $("#lista_productos").html(`
        <div class='cart-list'>
            ${html} 
        </div>
        <hr>
        <div class="cart-summary">
            <div style="display:flex;justify-content:space-between">
               <small> Total de items seleccionados: </small>
                <small> ${Number.parseInt(cantidad_prod)} </small>
            </div>
            <br><h5 style="display:flex;justify-content:space-between"> 
                 <span> Total: </span>
                <span> S/. ${Number.parseFloat(total).toFixed(2)} </span>
            </h5>
        </div>
    `);
    if(Carrito.items.length <= 0){
        $("#btn_submit").attr('disabled', true)
        $("#btn_submit").css('background-color', 'grey')
    }
}
function eliminarItem(id) {
    Carrito.removerProducto(id, generarListaItems);
}
function confirmarPedido(e) {
    e.preventDefault();

    $("#btn_submit").attr('disabled', true)
    $("#btn_submit").css('background-color', 'grey')
    $("#btn_submit").html(`Confirmar Pedido <i class="fa fa-spinner fa-spin"></i>`)
    if(Carrito.items.length <= 0){
        alert('No hay productos en su carrito de compras');
        return;
    }
    

    var formElement = document.getElementById("form_pedido");
    var formData = new FormData(formElement);
    formData.append('id_pedido', Carrito.pedido.id_pedido );
    var redireccion = '';
    if($("[name=metodo_entrega]").val() == 'DELIVERY'){
        redireccion = "pedido-confirmado";
    }else {
        redireccion = "pagar-pedido";
    }
    
    $.ajax({
        headers: { 'X-CSRF-Token': csrfToken },
        url: base + "pedido/confirmar-pedido",
        data: formData,
        type: 'POST',
        dataType: 'JSON',
        processData: false,
        cache: false,
        contentType: false,
        success: function (r) {
            console.log(r)
            if (r.success) {
                if( r.message != ''){
                    alert(r.message)
                }
                // if( $("#create_account").prop("checked") ){
                //     var a = $("#form_sesion_web").attr('action')
                //     $("#form_sesion_web").attr('action', a + "&action_2="+ redireccion + "&action_3=" + r.data )
                //     $("#flag_login").val("0");
                //     $("#form_sesion_web [name=correo_usuario]").val($("#input_correo_usuario").val());
                //     $("#form_sesion_web [name=contrasena]").val($("#input_contrasena").val());
                //     $("#form_sesion_web").submit();
                // }else{
                    window.location.replace( base_root + redireccion + "/" + r.data )
                // }
            }else{
                alert(r.message)
                Carrito.generarCarrito();
            }
        },error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }, complete: function () {
            $("#btn_submit").attr('disabled', false)
            $("#btn_submit").css('background-color', '#D10024')
            $("#btn_submit").html(`Confirmar Pedido <i class="fa fa-arrow-circle-right"></i>`)
        }, 
    });
}