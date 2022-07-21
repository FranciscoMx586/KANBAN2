<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Kanban</title>

    <link rel="stylesheet" href="./estilos.css">

</head>


<body>
    <header class="header">
        <div class="container">
            <nav class="menu">
                <a href="panel-logistica.php">Inicio</a>
                <a href="pedido.php">Pedido</a>
                <a href="cita.php">Cita</a>
                <a href="transporte.php">Transporte</a>
            </nav>
        </div>
    </header>
    <form action="" class="form-registro">
        <h1 id="titulo">PEDIDO</h1>
        <input class="fecha" type="date" name="fecha" id="fecha">
        <input class="campos" type="text" placeholder="Detalles pedido">
        <textarea class="comentarios" name="comentarios" placeholder="Comentarios"></textarea>
        <input class="boton" type="submit" value="Guardar">
    </form>

</body>

</html>