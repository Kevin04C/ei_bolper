$( document ).ready(function() {
    $("#btn-subm").on('click', function(){
        if(validar()){
            $("#form-clave").submit();
        }
    })
});
function mostrarClave(e){
    if($(`#${e}`).attr('type') == 'input'){
        $(`#${e}`).attr('type', 'password')
        $(`#${e}_icon`).removeClass('fa-eye')
        $(`#${e}_icon`).addClass('fa-eye-slash')
    }else{
        $(`#${e}`).attr('type', 'input')
        $(`#${e}_icon`).removeClass('fa-eye-slash')
        $(`#${e}_icon`).addClass('fa-eye')
    }
}
function validar(){
    if( $("#correo").val() == '' || $("#clave").val() == '' || $("#clave_confirm").val() == '' ) {
        setMsg("Complete todos los campos")
        return false
    }else if(  $("#clave").val() != $("#clave_confirm").val() ){
        setMsg("Las contraseñas no coinciden")
        return false
    }else{
        var emailField = $("#correo").val();
        var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{1,10})+$/;
        if( !(validEmail.test(emailField)) ){
            setMsg('Correo inválido.');
            return false;
        }
    }
    return true
}
function setMsg (msg){
    $("#msg").html(
        `
            <div class="" style="padding-bottom:10px">
                <div class="" >
                    <div class="message-error" onclick="this.classList.add('hidden');">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 
                        ${msg}
                    </div>
                </div>
            </div>
        `
    )
}