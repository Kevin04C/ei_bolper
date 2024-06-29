$( document ).ready(function() {
    $("#btn_limpiar").click( function(){
        console.log(123)
        $("[name=opt_nombres]").val('')
        $("[name=opt_tipo]").val('')
        $("#form_filtro").submit()
    })
});