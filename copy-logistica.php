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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

    #formulario-externo {
        display: none;
    }

    #formulario-propio {
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
        document.getElementById('formulario-externo').style.display = 'none';
        document.getElementById('formulario-propio').style.display = 'none';

    }

    function MostrarCita() {
        document.getElementById('panel-pedido').style.display = 'none';
        document.getElementById('panel-cita').style.display = 'block';
        document.getElementById('panel-transporte').style.display = 'none';
        document.getElementById('formulario-externo').style.display = 'none';
        document.getElementById('formulario-propio').style.display = 'none';
    }

    function MostrarTransporte() {
        document.getElementById('panel-pedido').style.display = 'none';
        document.getElementById('panel-cita').style.display = 'none';
        document.getElementById('panel-transporte').style.display = 'block';
        document.getElementById('formulario-externo').style.display = 'none';
        document.getElementById('formulario-propio').style.display = 'none';
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="panel-logistica.php">PromoQuin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="panel-logistica.php">Inicio</a>
                        <a class="nav-link a-nav" onclick="MostrarPedido();">Pedido</a>
                        <a class="nav-link a-nav" onclick="MostrarCita();">Cita</a>
                        <a class="nav-link a-nav" onclick="MostrarTransporte();">Transporte</a>
                    </div>
                </div>-->
            </div>
        </nav>
        </div>
    </header>

    <div id="panel-pedido">
        <section class="container">
            <div class="row my-3">
                <form action="subir-datos.php" id="formulario-logistica" method="POST" enctype="multipart/form-data">
                    <h2 class="form-titulo">Formulario De Pedido</h2>
                    <label class="form-label">Seleccionar Cliente</label>
                    <select required name="cliente" class="form-select form-select-sm mb-3">
                        <?php
                        $getCliente1 = "SELECT * FROM cliente";
                        $getCliente2 = mysqli_query($conexion[0], $getCliente1);

                        while ($row = mysqli_fetch_array($getCliente2)) {
                            $id = $row['id_cliente'];
                            $nombre = $row['nom_cliente'];
                        ?>
                            <option required value="<?php echo $id; ?>"><?php echo $nombre;  ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="col-12 mb-3">
                        <label class="form-label">Fecha Del Pedido</label>
                        <input required class="form-control" type="date" name="fecha" id="fecha" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Imagendel Pedido</label>
                        <input type="file" name="imagen-pedido" required accept="image/*" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Seccion de comentacios</label>
                        <textarea id="comentarios" class="form-control" name="comentarios" placeholder="Comentarios"></textarea>
                    </div>
                    <div class="mb-4 d-grid">
                        <input class="btn btn-primary" type="submit" name="subir-pedido" value="Guardar">
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div id="panel-cita">
        <section class="container">
            <div class=" row my-3">
                <form action="subir-datos.php" id="formulario-logistica" method="post">
                    <h2 class="form-titulo">Formulario De Cita</h2>
                    <div>
                        <label class="form-label">Pedidos</label>
                        <select class="form-select form-select-sm mb-3" required name="cliente">
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
                    <div class="col-12 mb-3">
                        <label class="form-label">Fecha De La Cita</label>
                        <input required class="form-control" type="date" name="fecha" id="fecha">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Seccion de comentarios</label>
                        <textarea class="form-control" name="comentarios" placeholder="Comentarios"></textarea>
                    </div>
                    <div class="mb-4 d-grid">
                        <input class="btn btn-primary" type="submit" name="form-cita" value="Guardar">
                    </div>
                </form>
            </div>
        </section>

    </div>

    <div id="panel-transporte">
        <section class="container">
            <div class="col my-3">
                <form action="" id="formulario-logistica">
                    <h2 class="form-titulo">Formulario De Transporte</h2>
                    <div id="citas-confirmados">
                    </div>
                    <label class="form-label">Seleccionar Tipo De Transporte</label>
                    <br>
                    <input class="btn btn-primary" type="button" value="Externo" onclick="Externo();">
                    <input class="btn btn-primary" type="button" value="Propio" onclick="Interno();">
                </form>
            </div>
        </section>
    </div>

    <div class="mb-3" id="formulario-externo">
        <form action="subir-datos.php" id="formulario-logistica" method="post">
            <h2 class="form-titulo">Registrar Nuevo Chofer</h2>
            <label class="form-label">Pedidos con Cita</label>
            <select required name="id_pedido" class="form-select form-select-sm mb-3">
                <?php
                $getCita1 = "SELECT * FROM 
                        (SELECT cliente.nom_cliente as Cliente, `estado_pedido` as Estado, `archivo_pedido` as Archivo, `fecha_pedido` as Fecha, `hora_pedido` as Hora, `obs_pedido` as Observaciones, pedido.id_pedido as idPedido FROM `pedido`, cliente WHERE pedido.cliente = cliente.id_cliente ORDER BY `Fecha` ASC, hora) 
                        as pedidosconid WHERE Estado = 'Agendado'";
                $getCita2 = mysqli_query($conexion[0], $getCita1);
                while ($row = mysqli_fetch_array($getCita2)) {
                    $id_pedido = $row['idPedido'];
                    $cliente_trans = $row['Cliente'];
                    $fecha = $row['Fecha'];
                ?>
                    <option value="<?php echo $id_pedido;  ?>"><?php echo $cliente_trans . "" . $fecha;  ?></option>
                <?php
                }
                ?>
            </select>
            <div class="col-12 mb-3">
                <label class="form-label">Nombre</label>
                <input required class="form-control" name="Nombre" type="text">
            </div>
            <label class="form-label">Apellido Paterno</label>
            <div class="col-12 mb-3">
                <input required class="form-control" name="apeP" type="text">
            </div>
            <label class="form-label">Apellido Materno</label>
            <div class="col-12 mb-3">
                <input required class="form-control" name="apeM" type="text">
            </div>
            <label class="form-label">Tipo de Licencia</label>
            <select class="form-select form-select-sm mb-3" required name="lictipo">
                <option value="A"> (A) Servicio Transporte Público y Taxi</option>
                <option value="B"> (B) Vehículos de Transporte Público de Carga y Particular</option>
                <option value="C"> (C) Vehículos Particulares que no excedan las 3.5 Toneladas </option>
                <option value="D"> (D) Vehículos de 2 o 3 ruedas</option>
                <option value="M"> (M) Permiso de menor de edad y extranjero</option>
            </select>
            <div class="col-12 mb-3">
                <label class="form-label">Seccion de Comentarios</label>
                <textarea class="form-control" name="comentarios" placeholder="Comentarios del Transporte"></textarea>
            </div>
            <div class="mb-4 d-grid">
                <input class="btn btn-primary" type="submit" name="transporte-externo" value="Guardar">
            </div>
        </form>
    </div>

    <div class=" mb-3 registro-chofer" id="formulario-propio">
        <form action="subir-datos.php" method="POST" id="formulario-logistica">
            <label class="form-label">Pedidos con Cita</label>
            <select required name="id_pedido" class="form-select form-select-sm mb-3">
                <?php
                $getCita1 = "SELECT * FROM 
                        (SELECT cliente.nom_cliente as Cliente, `estado_pedido` as Estado, `archivo_pedido` as Archivo, `fecha_pedido` as Fecha, `hora_pedido` as Hora, `obs_pedido` as Observaciones, pedido.id_pedido as idPedido FROM `pedido`, cliente WHERE pedido.cliente = cliente.id_cliente ORDER BY `Fecha` ASC, hora) 
                        as pedidosconid WHERE Estado = 'Agendado'";
                $getCita2 = mysqli_query($conexion[0], $getCita1);

                while ($row = mysqli_fetch_array($getCita2)) {
                    $id_pedido = $row['idPedido'];
                    $cliente_trans = $row['Cliente'];
                    $fecha = $row['Fecha'];
                ?>
                    <option value="<?php echo $id_pedido;  ?>"><?php echo $cliente_trans . "" . $fecha;  ?></option>
                <?php
                }
                ?>

            </select>
            <label class="form-label">Chofer designado para el viaje</label>
            <select required name="id_chf" class="form-select form-select-sm mb-3">
                <?php
                $getChofer1 = "SELECT * FROM chofer WHERE id_chf > 1";
                $getChofer2 = mysqli_query($conexion[0], $getChofer1);

                while ($row = mysqli_fetch_array($getChofer2)) {
                    $id = $row['id_chf'];
                    $nombre = $row['nom_chf'];
                    $apepad = $row['apeP_chf'];
                    $apemad = $row['apeM_chf'];
                ?>
                    <option value="<?php echo $id;  ?>"><?php echo $nombre . " " . $apepad . " " . $apemad;  ?></option>
                <?php
                }
                ?>
            </select>
            <p>Unidad de transporte</p>
            <select required name="id_unid" class="form-select form-select-sm mb-3">
                <?php
                $getUnidad1 = "SELECT * FROM unidad WHERE id_unid > 1";
                $getUnidad2 = mysqli_query($conexion[0], $getUnidad1);

                while ($row = mysqli_fetch_array($getUnidad2)) {
                    $id = $row['id_unid'];
                    $modelo = $row['model_unid'];
                    $año = $row['año_unid'];
                ?>
                    <option value="<?php echo $id;  ?>"><?php echo $modelo . " " . $año;  ?></option>
                <?php
                }
                ?>
            </select>
            <div class="col-12 mb-3">
            <label class="form-label">Seccion de Comentarios</label>
            <textarea id="comentarios" class="form-control" name="comentarios" placeholder="Comentarios"></textarea>
            </div>
            <div class="class="mb-4 d-grid"">
            <input class="btn btn-primary" name="transporte-propio" type="submit" value="Guardar">
            </div>
        </form>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>