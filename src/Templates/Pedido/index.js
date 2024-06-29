
function limpiar(){
    $("[name=opt_num_pedido]").val("")
    $("[name=opt_nombre]").val("")
    $("[name=opt_fech_ini]").val("")
    $("[name=opt_fech_fin]").val("")
    $("[name=opt_estado]").val("")
    $("#formFiltro").submit();
}
