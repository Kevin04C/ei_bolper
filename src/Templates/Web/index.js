$( document ).ready(function() {
    
    // Set the date we're counting down to
    var countDownDate = new Date(fecha_oferta).getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the distance between now and the count down date
         var distance = now - countDownDate;
            
        // Time calculations for days, hours, minutes and seconds
       var years = Math.floor(distance / 31536000000);
        var months = Math.floor(distance / 2592000000) % 12;
        var minutes = Math.floor((distance % 3600000) / 60000);
        var seconds = Math.floor((distance % 60000) / 1000);
            
        // Display the result in an element with id="demo"
        
         document.getElementById("time_anio").innerHTML = years;
         document.getElementById("time_mes").innerHTML = months;
        document.getElementById("time_minuto").innerHTML = minutes;
        document.getElementById("time_segundo").innerHTML = seconds;
            
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("time_anio").innerHTML = '-';
            document.getElementById("time_mes").innerHTML = '--';
            document.getElementById("time_minuto").innerHTML = '--';
            document.getElementById("time_segundo").innerHTML = '--';
        }
    }, 1000);
    $("#modal_promocion").modal('show');
});

function cerrarModal () {
    $("#modal_promocion").modal('hide');
}