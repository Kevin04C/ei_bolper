$( document ).ready(function() {
    $("#input_dni").mask("########")
    $("#input_telefono").mask("#########")
    $("#input_telefono").on('input',( e )=>{
        var a = e.target.value;
        if( a == '' ){
            $("#input_telefono").val(9)
        }
    })
    $("#input_dni").on('input',( e )=>{
        $("#formg_dni").removeClass('has-error')
    })
    $("#input_email").on('input',( e )=>{
        $("#formg_correo").removeClass('has-error')
    })
    $("#input_clave").on('input',( e )=>{
        $("#formg_clave").removeClass('has-error')
    })
    $("#input_confirmar_clave").on('input',( e )=>{
        $("#formg_confirmar_clave").removeClass('has-error')
    })

});

function validateEmail( email) {
    var emailReg = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    return emailReg.test( email );
}
function showMsg( message ){
    var msg = `
    <div class="message-error" onclick="this.classList.add('hidden');">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ${message}
    </div>
    `;
    $("#msg_form").html(msg);
}
function submitForm( e ) {
    e.preventDefault();
    $("#msg_form").html('')
    if($('#input_dni').val() == '' || ($('#input_dni').val()).length != 8 ){
        $("#formg_dni").addClass('has-error')
        showMsg( 'DNI inválido' )
        return false
    }
    if( !validateEmail($('#input_email').val()) ){
        $("#formg_correo").addClass('has-error')
        showMsg( 'Correo electrónico inválido' )
        return false
    }

    if($('#input_clave').val() == ''){
        $("#formg_clave").addClass('has-error')
        showMsg( 'Escriba una contraseña' )
        return false
    }
    if($('#input_confirmar_clave').val() == ''){
        $("#formg_confirmar_clave").addClass('has-error')
        showMsg( 'Confirme su contraseña' )
        return false
    }
    if ( $('#input_clave').val() != $('#input_confirmar_clave').val() ) {
        $("#formg_clave").addClass('has-error')
        $("#formg_confirmar_clave").addClass('has-error')
        showMsg( 'Las contraseñas no coinciden' )
        return false
    }

    if ($('#input_clave').val() == $('#input_confirmar_clave').val() ){
        var password = $('#input_clave').val()
        var errores = validarContraseña(password);  

        if(errores.length > 0) {
            for (const error of errores) {
                showMsg(error);
            }
            return false;
        }
    }


    var endpoint = `${base}usuario/registro-cliente-web/`

    var formData = new FormData();
    formData.append('nombres', $('#input_nombre').val() );
    formData.append('dni', $('#input_dni').val() );
    formData.append('telefono', $('#input_telefono').val() );
    formData.append('correo', $('#input_email').val() );
    formData.append('direccion', $('#input_direccion').val() );
    formData.append('contrasena', $('#input_clave').val() );

    $.ajax({
        headers: { 'X-CSRF-Token': csrfToken },
        url: endpoint,
        data: formData,
        type: 'POST',
        dataType: 'JSON',
        processData: false,
        cache: false,
        contentType: false,
        success: function(r){
            if(r.success){
                alert(r.message)
                location.reload()
            }else{                                
                showMsg( r.message)
            }
        },
        error: function(r){
            alert("Ocurrio un error, vuelva a intentarlo en unos minutos")
        },
        complete: function(){
            
        }
    });   
    return false
}

function showPwd (me, target) {
    var inp = $("#" + target).attr('type');
    if(inp == 'password'){
        $(me).html('<i class="fa fa-eye-slash"></i>')
        $("#" + target).attr('type', 'text');
    }else if(inp == 'text'){
        $("#" + target).attr('type', 'password');
        $(me).html('<i class="fa fa-eye"></i>')
    }
}

function validarContraseña(contraseña) {
    var errores = [];

    // Verificar longitud mínima
    if (contraseña.length < 8) {
        errores.push("La contraseña debe tener al menos 8 caracteres.");
    }

    // Verificar al menos un número
    if (!/\d/.test(contraseña)) {
        errores.push("La contraseña debe contener al menos un número.");
    }

    // Verificar al menos una letra mayúscula
    if (!/[A-Z]/.test(contraseña)) {
        errores.push("La contraseña debe contener al menos una letra mayúscula.");
    }

    return errores;
}