<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporte Kanban</title>

    <link rel="stylesheet" href="./estilos.css">

</head>

<body>
    <script>
        function Mostrar() {
            document.getElementById('unidades').style.display = 'block';
            document.getElementById('choferes').style.display = 'block';
            document.getElementById('registro-chofer').style.display = 'none';
        }


        function Ocultar() {
            document.getElementById('unidades').style.display = 'none';
            document.getElementById('choferes').style.display = 'none';
            document.getElementById('registro-chofer').style.display = 'block';
        }
    </script>

    <style>
        #unidades {
            display: none;
        }

        #choferes {
            display: none;
        }

        .registro-chofer {
            display: none;
        }
    </style>

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
    <div class="contenedor-transporte">
        <div class="transporte">
            <form action="" class="form-registro">
                <h1 id="titulo">TRANSPORTE</h1>
                <div id="transporte">
                    <input class="campos" type="button" value="Externo" onclick="Ocultar();">
                    <input class="campos" type="button" value="Propio" onclick="Mostrar();">
                </div>
                <br>
                <div id="unidades">
                    <p>Unidad de transporte</p>
                    <select class="campos">
                        <option value="KW-03">KW-03</option>
                        <option value="FL-14">FL-14</option>
                        <option value="FL-19">FL-19</option>
                        <option value="FD-14">FD-14</option>
                        <option value="N--20">N--20</option>
                    </select>
                </div>
                <div id="choferes">
                    <p>Chofer designado para el viaje</p>
                    <select class="campos">
                        <option value="Chofer1">Chofer 1</option>
                        <option value="Chofer2">Chofer 2</option>
                        <option value="Chofer3">Chofer 3</option>
                        <option value="Chofer4">Chofer 4</option>
                        <option value="Chofer5">Chofer 5</option>
                    </select>
                </div>
                <textarea class="comentarios" placeholder="Comentarios"></textarea>
                <input class="boton" type="submit" value="Guardar">
            </form>
        </div>

        <div class="registro-chofer" id="registro-chofer">
            <form action="" class="form-registro">
                <p id="p-registro-chofer">REGISTRAR NUEVO CHOFER</p>
                <input class="campos" type="text" placeholder="Nombre Completo">
                <input class="campos" type="text" placeholder="RFC">
                <input class="campos" type="text" placeholder="Número de licencia">
                <input class="campos" type="text" placeholder="Tipo de licencia">
                <input class="campos" type="text" placeholder="Telefono">
                <input class="campos" type="email" placeholder="Correo Electronico">
                <input class="campos" type="text" placeholder="Direccion">
                <input class="boton" type="submit" value="Guardar">
            </form>
        </div>
    </div>
</body>

</html>