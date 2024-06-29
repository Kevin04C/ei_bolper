<div   style="border: 2px solid #E1E6EA;padding: 10px 15px 10px 15px;max-width: 600px;justify-content: center"  >
    <div style="background-color:#15161D; text-align:center">
        <img style=" max-height: 70px;margin-left: auto;margin-right: auto" src="cid:logo" alt="logo"  />
    </div>
    <p>
        ¡Hola! <?=$usuario->nom_usuario?>, se solicitó un restablecimiento de contraseña para tu cuenta, haz clic en el boton que aparece a continuación para cambiar su contraseña.
    </p>
    <a class="btn btn-primary" href="<?= $url_cod ?>" role="button" target="_blank">cambiar contraseña</a>
    <p>
      Si no realizaste la solicitud de cambio de contraseña, solo ignora este mensaje.
    </p>
     <p>
     Este enlace solo es válido dentro de los próximos 60 minutos. 
    </p>
     <p>
     Saludos,
     Ei Bolper.
    </p>

</div>