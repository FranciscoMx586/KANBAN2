<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
    <title>Login</title>
</head>

<body>
    <div class="container w-90 mt-3 rounded shadow">
        <div class="row align-items-strech rounded shadow">
            <div class="col">
                <h2 class="fw-bold text-center py-5">Bienvenido Colaborador</h2>
                <img class="img-login" src="imagenes/logo-login2.png" alt="">
                <form action="subir-datos.php" class="login-form" method="post" id="login">
                    <div class="mb-4">
                        <label class="form-label" for="email">Correo Electronico</label>
                        <input class="form-control" id="email" type="email" name="correo">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <input class="form-control" type="password" name="contra" placeholder="Contraseña">
                    </div>
                    <div class="mb-4 d-grid">
                        <input class="btn btn-primary" type="submit" name="iniciar"" value="Iniciar sesión">
                    </div>

                </form>
            </div>

        </div>

    </div>
</body>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</html>