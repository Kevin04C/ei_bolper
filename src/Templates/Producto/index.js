$(document).ready(function() {
    $("#btn_limpiar").click(function() {
        console.log(123);
        $("[name=opt_categoria]").val('');
        $("#form_filtro").submit();
    });
});
$( document ).ready(function() {

    
});
function abrirGaleria(nombre,imagen1, imagen2, imagen3){

}
function readURL(event , id){
    var getImagePath = URL.createObjectURL(event.target.files[0]);
    $('#'+id).prop('src', getImagePath );
}