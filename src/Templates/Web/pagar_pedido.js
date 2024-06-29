
$( document ).ready(function() {
});

function submitPagarPedido(e) {
    e.preventDefault();
    $("#btn_submit").attr('disabled', true)
    $("#btn_submit").css('background-color', 'grey')
    $("#btn_submit").html(`Guardando pago <i class="fa fa-spinner fa-spin"></i>`)
    
    var formElement = document.getElementById("form_pedido");
    var formData = new FormData(formElement);
    formData.append('id_pedido', pedido_id );
    formData.append('metodo_pago', metodo_pago );

    $.ajax({
        headers: { 'X-CSRF-Token': csrfToken },
        url: base + "pedido/pagar-pedido-final",
        data: formData,
        type: 'POST',
        dataType: 'JSON',
        processData: false,
        cache: false,
        contentType: false,
        success: function (r) {
            console.log(r)
            if (r.success) {
                window.location.replace( base + "web/pedido-confirmado/" + pedido_id )
            }else{
                alert('Ocurrio un error con su pedido.')
            }
        },error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }, complete: function () {
            $("#btn_submit").attr('disabled', false)
            $("#btn_submit").css('background-color', '#D10024')
            $("#btn_submit").html(`Guardar Pago <i class="fa fa-arrow-circle-right"></i>`)
        }, 
    });
}