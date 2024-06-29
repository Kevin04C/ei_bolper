<div   style="border: 2px solid #E1E6EA;padding: 10px 15px 10px 15px;max-width: 600px;justify-content: center"  >
    <div style="background-color:#15161D; text-align:center">
        <img style=" max-height: 70px;margin-left: auto;margin-right: auto" src="cid:logo" alt="logo"  />
    </div>
    <p>
        ¡Hola <?=$usuario->nom_usuario?>!. muchas gracias por registrarte en nuestra página web. A continuación, le proporcionamos las credenciales correspondientes:
        <br>
        <br>
        <label style="display: inline-block;max-width:80px;width: 80px"> <b>Correo</b></label>
        : <?= $usuario->correo_usuario ?>
        <br/>
        <br>
        <label style="display: inline-block;max-width:80px;width: 80px"><b>Clave</b></label>
        : <?= $clave ?><br/>
        <br>
        <br>
    </p>

</div>
