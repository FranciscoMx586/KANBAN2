<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Almacen</title>
    <link rel="stylesheet" href="./estilos.css">
</head>
<div class="contenedor_loader">
    <div class="loader"></div>
    <script src="JS/script.js"></script>
</div>
<style>

    #panel-carga {
        display: none;
    }

    #panel-reparto {
        display: none;
    }

    #panel-entrega {
        display: none;
    }
</style>

<script>
    function MostrarCarga() {
        document.getElementById('panel-carga').style.display = 'block';
        document.getElementById('panel-reparto').style.display = 'none';
        document.getElementById('panel-entrega').style.display = 'none';

    }

    function MostrarReparto() {
        document.getElementById('panel-carga').style.display = 'none';
        document.getElementById('panel-reparto').style.display = 'block';
        document.getElementById('panel-entrega').style.display = 'none';
    }

    function MostrarEntrega() {
        document.getElementById('panel-carga').style.display = 'none';
        document.getElementById('panel-reparto').style.display = 'none';
        document.getElementById('panel-entrega').style.display = 'block';
    }

</script>
<body>
    <header class="header">

        <div class="container">
            <nav class="menu">
                <a href="panel-almacen.php">Inicio</a>
                <a onclick="MostrarCarga();">Carga</a>
                <a onclick="MostrarReparto();">Reparto</a>
                <a onclick="MostrarEntrega();">Entrega</a>
            </nav>
        </div>
    </header>

    <div id="panel-carga">
        <div class="form-contenedor">
            <form action="" class="form-cita">
                <h2 class="form-titulo">Formulario De Carga</h2>
                <div id="pedidos-confirmados">
                    <p>Pedidos listos para Carga</p>
                    <select required name="cliente" class="controls">
                        <?php
                        $getCita1 = "SELECT * FROM pedidos WHERE Estado = 'Carga'";
                        $getCita2 = mysqli_query($conexion[0], $getCita1);

                        while ($row = mysqli_fetch_array($getCita2)) {
                            $archivo_trans = $row['Archivo'];
                            $cliente_trans = $row['Cliente'];
                            $fecha = $row['Fecha'];
                        ?>
                            <option value="<?php echo $archivo_trans;  ?>"><?php echo $cliente_trans . "" . $fecha;  ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <input class="controls" type="date" name="fecha" id="fecha">
                <textarea class="controls" name="comentarios" placeholder="Comentarios"></textarea>
                <input class="boton-cita" type="submit" value="Guardar">
            </form>
        </div>
    </div>

    <div id="panel-reparto">
        <div class="form-contenedor">
            <form action="" class="form-cita">
                <h2 class="form-titulo">Formulario De Reparto</h2>
                <div id="pedidos-confirmados">
                    <p>Pedidos listos para viaje</p>
                    <select required name="cliente" class="controls">
                        <?php
                        $getCita1 = "SELECT * FROM pedidos WHERE Estado = 'Agendado'";
                        $getCita2 = mysqli_query($conexion[0], $getCita1);

                        while ($row = mysqli_fetch_array($getCita2)) {
                            $archivo_trans = $row['Archivo'];
                            $cliente_trans = $row['Cliente'];
                            $fecha = $row['Fecha'];
                        ?>
                            <option value="<?php echo $archivo_trans;  ?>"><?php echo $cliente_trans . "" . $fecha;  ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <input class="controls" type="date" name="fecha" id="fecha">
                <textarea class="controls" name="comentarios" placeholder="Comentarios"></textarea>
                <input class="boton-cita" type="submit" value="Guardar">
            </form>
        </div>
    </div>

    <div id="panel-entrega">
        <div class="form-contenedor">
            <form action="" class="form-cita">
                <h2 class="form-titulo">Formulario De Entrega</h2>
                <div id="pedidos-confirmados">
                    <p>Pedidos Por Finalizar</p>
                    <select required name="cliente" class="controls">
                        <?php
                        $getCita1 = "SELECT * FROM pedidos WHERE Estado = 'Agendado'";
                        $getCita2 = mysqli_query($conexion[0], $getCita1);

                        while ($row = mysqli_fetch_array($getCita2)) {
                            $archivo_trans = $row['Archivo'];
                            $cliente_trans = $row['Cliente'];
                            $fecha = $row['Fecha'];
                        ?>
                            <option value="<?php echo $archivo_trans;  ?>"><?php echo $cliente_trans . "" . $fecha;  ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <input class="controls" type="date" name="fecha" id="fecha">
                <textarea class="controls" name="comentarios" placeholder="Comentarios"></textarea>
                <input class="boton-cita" type="submit" value="Guardar">
            </form>
        </div>
    </div>
</body>

</html>