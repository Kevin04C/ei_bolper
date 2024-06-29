
$( document ).ready(function() {
    isLogueado();
});


$("#carrito_id").on('click', function(){
    isLogueado();
})

var notificador = new Notification(document.querySelector('.notification'));
var estaLogueado = false;
// console.log(estaLogueado);
var Carrito = {
    pedido: null,
    items: [],
    total: 0.00,
    setData : function(data){
        try {
            Carrito.pedido = data;
            Carrito.items = data.detalle_pedido.map((e)=>{
                return e;
            });
        } catch (error) {
            Carrito.items = [];
        }
        Carrito.generarCarrito();
    },
    agregarProducto : function(id_producto){
        $.ajax({
            headers: { 'X-CSRF-Token': csrfToken },
            url: base + "pedido/agregar-producto-pedido",
            data: { id_producto : id_producto, cantidad: 1 },
            type: 'POST',
            dataType: 'JSON',
            success: function (r) {
                console.log(r)
                if (r.success) {
                    Carrito.pedido = r.data;
                    Carrito.items = r.data.detalle_pedido.map((e)=>{
                        return e;
                    })
                    notificador.info('Producto agregado');
                }
                Carrito.generarCarrito();
            },error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    },
    removerProducto : function( registro_id , callback=()=> {} ){
        $.ajax({
            headers: { 'X-CSRF-Token': csrfToken },
            url: base + "pedido/eliminar-registro-pedido",
            data: { detalle_pedido_id : registro_id },
            type: 'POST',
            dataType: 'JSON',
            success: function (r) {
                if (r.success) {
                    Carrito.pedido = r.data;
                    Carrito.items = r.data.detalle_pedido.map((e)=>{
                        return e;
                    })
                    notificador.info('Producto eliminado');
                }
                Carrito.generarCarrito();
            },error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }, complete: function () {
                callback()
            }, 
        });
    },
    generarCarrito : function(){
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
                    <h4 class="product-price"><span class="qty"> ${e.pedido_cantidad} x  
                    ${Number.parseFloat(e.producto_punitarioincigv).toFixed(2)} </span> = ${Number.parseFloat(e.producto_total).toFixed(2)} </h4>
                </div>
                <button class="delete" onclick="Carrito.removerProducto(${e.id})"><i class="fa fa-close"></i></button>
            </div>`;
            total = Number.parseFloat(e.producto_total) + Number.parseFloat(total);
            cantidad_prod += 1;
        })
        
        $("#carrito_id #carrito_cantidad").html(cantidad_prod);
        if(cantidad_prod == 0){
            $("#carrito_lista_id").html(`
                <div class=".cart-list">
                    <div class="cart-empty">
                        <small> Su carrito de compras esta vacío </small>
                    </div>
                </div>
                `);
            $("#carrito_id #carrito_cantidad").html('0');
        }else{
            
            $("#carrito_lista_id").html(`
                <div class='cart-list'>
                    ${html} 
                </div>
                <div class="cart-summary">
                    <small> ${Number.parseInt(cantidad_prod)} items seleccionados </small>
                    <h5> S/. ${Number.parseFloat(total).toFixed(2)}</h5>
                </div>
                <div id="sesion_button" class="cart-btns">
                 
                  
                  
               
                </div>
            `);
            // <a href="${base_root}confirmar-pagar"> Pagar <i class="fa fa-arrow-circle-right"></i></a>
        }
    },
    actualizarInputPedidoId(id_pedido){
        // $("[name=pedido_cookie_id]").val(id_pedido)
    }

    
}
function consultarCarrito(e){

    // validamos el correo si existe y si es valido login-username
    // if(!validateEmail($('#login-username').val()) ){
    //     $("#formg_correo").addClass('has-error')
    //     showMsg( 'Correo electrónico inválido' )
    //     return
    // };

    if( $("#flag_login").val() == '1' ){
        e.preventDefault();
        if(Carrito.items.length >= 1){
            if(confirm("¿Conservar carrito de compras?")){
                $("#pedido_id").val(Carrito.pedido != null ? Carrito.pedido.id_pedido : '');
            }
        }
        $("#flag_login").val("0");
        $("#form_sesion_web").submit();
    }
}

// function showMsg( message ){
//     var msg = `
//     <div class="message-error" onclick="this.classList.add('hidden');">
//         <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ${message}
//     </div>
//     `;
//     $("#msg_form").html(msg);
// }

// function validateEmail( email) {
//     var emailReg = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
//     return emailReg.test( email );
// }

function isLogueado(){
    $.ajax({
        headers: { 'X-CSRF-Token': csrfToken },
        url: base + "usuario/is-logueado",
        type: 'GET',
        dataType: 'JSON',
        success: function (r) { 
            estaLogueado = r.data;
            if(estaLogueado){
                $("#sesion_button").html(`
                    <a href="${base_root}confirmar-pagar"> Pagar <i class="fa fa-arrow-circle-right"></i></a>
                `);
            }else{
                $("#sesion_button").html(` <a style=" background-color: #35453d; !important" > Debe iniciar sesion para pagar <i class="fa fa-arrow-circle-right"></i></a>`);
            }



           
        },error: function (xhr, ajaxOptions, thrownError) {
            // alert(xhr.status);
            // alert(thrownError);
        }
    });
}
