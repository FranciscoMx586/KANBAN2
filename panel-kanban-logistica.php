<?php
require_once('Metodos.php');
$metodos = new metodos();
$conexion = $metodos->conectarBD();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Kanban Logistica</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<div class="contenedor_loader">
    <div class="loader"></div>
</div>
<script src="JS/script.js"></script>
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

    #panel-pedido {
        display: none;
    }

    #panel-cita {
        display: none;
    }

    #panel-transporte {
        display: none;
    }
</style>

<script>
    function MostrarPedido() {
        document.getElementById('panel-pedido').style.display = 'block';
        document.getElementById('panel-cita').style.display = 'none';
        document.getElementById('panel-transporte').style.display = 'none';

    }

    function MostrarCita() {
        document.getElementById('panel-pedido').style.display = 'none';
        document.getElementById('panel-cita').style.display = 'block';
        document.getElementById('panel-transporte').style.display = 'none';
    }

    function MostrarTransporte() {
        document.getElementById('panel-pedido').style.display = 'none';
        document.getElementById('panel-cita').style.display = 'none';
        document.getElementById('panel-transporte').style.display = 'block';
    }

    function Interno() {

        document.getElementById('formulario-propio').style.display = 'block';
        document.getElementById('formulario-externo').style.display = 'none';
    }


    function Externo() {
        document.getElementById('formulario-propio').style.display = 'none';
        document.getElementById('formulario-externo').style.display = 'block';
    }
</script>

<body>
    <header class="header">
        <div class="container">
            <nav class="menu">
                <a href="panel-logistica.php">Inicio</a>
                <a onclick="MostrarPedido();">Pedido</a>
                <a onclick="MostrarCita();">Cita</a>
                <a onclick="MostrarTransporte();">Transporte</a>
            </nav>
        </div>
    </header>


    <div id="panel-pedido">
        <div class="form-contenedor">
            <form action="subir-datos.php" class="form-pedido" method="post">
                <h2 class="form-titulo">Formulario De Pedido</h2>
                <p>Seleccionar Cliente</p>
                <select required name="cliente" class="controls">
                    <?php
                    $getCliente1 = "SELECT * FROM cliente";
                    $getCliente2 = mysqli_query($conexion[0], $getCliente1);

                    while ($row = mysqli_fetch_array($getCliente2)) {
                        $id = $row['id_cliente'];
                        $nombre = $row['nom_cliente'];
                    ?>
                        <option required value="<?php echo $id;?>"><?php echo $nombre;  ?></option>
                    <?php
                    }
                    ?>
                </select>
                <p>Fecha Del Pedido</p>
                <input required class="controls" type="date" name="fecha" id="fecha" required>
                <p>Imagen del pedido</p>
                <input required accept="image/* class="archivo-pedido" type="file" name="imagen-pedido" placeholder="Imagen Del Pedido">
                <p>Seccion de comentacios</p>
                <textarea class="controls" name="comentarios" placeholder="Comentarios"></textarea>
                <input class="boton-pedido" type="submit" name="subir-pedido" value="Guardar">
            </form>
        </div>

    </div>


    <div id="panel-cita">
        <div class="form-contenedor">
            <form action="subir-datos.php" class="form-cita" method="post">
                <h2 class="form-titulo">Formulario De Cita</h2>
                <div>
                    <p>Pedidos</p>
                    <select required name="cliente" class="controls">
                        <?php
                        $getPedido1 = "SELECT * FROM pedidos WHERE Estado = 'Pendiente'";
                        $getPedido2 = mysqli_query($conexion[0], $getPedido1);

                        while ($row = mysqli_fetch_array($getPedido2)) {
                            $archivo = $row['Archivo'];
                            $cliente = $row['Cliente'];
                            $fecha = $row['Fecha'];
                            $getPedido3 = "SELECT * FROM pedido WHERE fecha_pedido = '$fecha'  AND archivo_pedido = '$archivo'  ";
                            $getPedido4 = mysqli_query($conexion[0], $getPedido3);
                            while ($row = mysqli_fetch_array($getPedido4)) {
                                $id_pedido = $row['id_pedido'];
                            }
                        ?>
                            <option value="<?php echo $id_pedido; ?>"><?php echo $cliente . "\n" . "" .  $fecha;  ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <p>Fecha De La Cita</p>
                <input required class="controls" type="date" name="fecha" id="fecha">
                <p>Seccion de comentarios</p>
                <textarea class="controls" name="comentarios" placeholder="Comentarios"></textarea>
                <input class="boton-cita" type="submit" name="form-cita" value="Guardar">
            </form>
        </div>
    </div>

    <div id="panel-transporte">
        <div class="form-contenedor-transporte">
            <form action="" class="form-transporte">
                <h2 class="form-titulo">Formulario De Transporte</h2>
                <div id="citas-confirmados">
                </div>
                <p>Seleccionar Tipo De Transporte</p>
                </br>
                <div id="transporte">
                    <input class="controls" type="button" value="Externo" onclick="Externo();">
                    <input class="controls" type="button" value="Propio" onclick="Interno();">
                </div>
            </form>
        </div>

        <div class="registro-chofer" id="formulario-externo">
            <form action="subir-datos.php" class="form-transporte-chofer" method="post">
            <p>Pedidos con Cita</p>
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
                
                <h2 class="form-titulo">Registrar Nuevo Chofer</h2>
                <input required class="controls" name="Nombre" type="text" placeholder="Nombre/s*">
                <input required class="controls" name="apeP" type="text" placeholder="Apellido Paterno*">
                <input required class="controls" name="apeM" type="text" placeholder="Apellido Materno*">
                <p>Tipo de Licencia</p>
                    <select required name="lictipo" class="controls">
                    <option value="A"> (A) Servicio Transporte Público y Taxi</option>
                    <option value="B"> (B) Vehículos de Transporte Público de Carga y Particular</option>
                    <option value="C"> (C) Vehículos Particulares que no excedan las 3.5 Toneladas </option>
                    <option value="D"> (D) Vehículos de 2 o 3 ruedas</option>
                    <option value="M"> (M) Permiso de menor de edad y extranjero</option>
                    </select>
                <p>Seccion de Comentarios</p>
                <textarea class="controls" name="comentarios" placeholder="Comentarios del Transporte"></textarea>
                <input class="boton-transporte" type="submit" name="transporte-externo" value="Guardar">
            </form>
        </div>

        <div class="registro-chofer" id="formulario-propio">
            <form action="subir-datos.php" method="POST" class="form-transporte-chofer">
                
            <p>Pedidos con Cita</p>
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

                <p>Chofer designado para el viaje</p>
                <select required name="cliente" class="controls">
                    <?php
                    $getChofer1 = "SELECT * FROM chofer WHERE id_chf > 1";
                    $getChofer2 = mysqli_query($conexion[0], $getChofer1);

                    while ($row = mysqli_fetch_array($getChofer2)) {
                        $id = $row['id_chf'];
                        $nombre = $row['nom_chf'];
                        $apepad = $row['apeP_chf'];
                        $apemad = $row['apeM_chf'];
                    ?>
                        <option value="<?php echo $id;  ?>"><?php echo $nombre . "" . $apepad . "" . $apemad;  ?></option>
                    <?php
                    }
                    ?>

                </select>

                <p>Unidad de transporte</p>
                <select required name="cliente" class="controls">
                    <?php
                    $getUnidad1 = "SELECT * FROM unidad WHERE id_unid > 1";
                    $getUnidad2 = mysqli_query($conexion[0], $getUnidad1);

                    while ($row = mysqli_fetch_array($getUnidad2)) {
                        $id = $row['id_unid'];
                        $modelo = $row['model_unid'];
                        $año = $row['año_unid'];
                    ?>
                        <option value="<?php echo $id;  ?>"><?php echo $modelo . "" . $año;  ?></option>
                    <?php
                    }
                    ?>

                </select>
                <p>Seccion de Comentarios</p>
                <textarea class="controls" name="comentarios" placeholder="Comentarios"></textarea>
                <input class="boton-transporte" name="transporte-propio" type="submit" value="Guardar">
            </form>
        </div>
    </div>
</body>
</html>