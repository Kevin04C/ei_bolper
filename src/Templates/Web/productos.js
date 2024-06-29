$( document ).ready(function() {
    $(".filtro_input").on('change', function(){
        console.log("a")
        $("#form_filtros").submit()
    })
    $(".filtro_precio").on('change', function(){
        console.log("a")
    })
    cargarPrecios();
});
function cargarPrecios(){
    $("#price-min").val(opt_precio_ini);
    $("#price-max").val(opt_precio_fin);

    var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {

        if(opt_precio_ini == ''){
            opt_precio_ini = 1
        }
        if( opt_precio_fin == ''){
            opt_precio_fin = 9999
        }
		priceSlider.noUiSlider.updateOptions({
            start: [opt_precio_ini, opt_precio_fin],
        });
    }
}
