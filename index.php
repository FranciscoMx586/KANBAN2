<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Login</title>
</head>

<body>
    <div class="login-cuerpo">
        <p>Bienvenido Colaborador</p>
        <img src="imagenes/logo-login.png" alt="">
        <form action="procesoInicio.php" class="login-form" method="post" id="login">
            <input type="email" name="correo" placeholder="Email o nombre de usuario">
            <input type="password" name="contra" placeholder="Contraseña">
            <input id="envi" type="submit" name="iniciar" value="Iniciar sesión">
        </form>
    </div>
</body>

</html>