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
    <title>Pedidos Kanban PromoQuin</title>
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="menu">
                <a href="panel-logistica.php">Inicio</a>
            </nav>
        </div>
    </header>
    <br><br><br>
    <div class="contenedor-pedidos">
        <div class="title-table">Panel de los Pedidos</div>
        <?php
        $buscar = "SELECT cliente.nom_cliente as Cliente, `estado_pedido` 
        as Estado, `archivo_pedido` as Archivo, `fecha_pedido` as Fecha, 
        `hora_pedido` as Hora, `obs_pedido` as Observaciones, pedido.id_pedido 
        FROM `pedido`, cliente WHERE pedido.cliente = cliente.id_cliente ORDER BY 
        `Fecha` ASC, hora";

        $resultado = mysqli_query($conexion[0], $buscar);
        while ($row = mysqli_fetch_array($resultado)) {
            $cliente = $row['Cliente'];
            $estado = $row['Estado'];
            $Archivo = $row['Archivo'];
            $fecha = $row['Fecha'];
            $fecha = strtotime($fecha);
            $fecha = date("d/m/y", $fecha);
            $id_pedido = $row['id_pedido'];
            $Observaciones = $row['Observaciones'];
        ?>

            <div class="card">
                <?php
                ?>
                <div class="item-table">
                    <p class="titulos-card">Cliente del Pedido</p>
                    <p class="echo-cliente"><?php echo $cliente; ?></p>
                    <p class="titulos-card">Fecha del Pedido</p>
                    <p><?php echo $fecha; ?></p>
                    <p class="titulos-card">Imagen del Pedido</p>
                    <p><img src="<?php echo $Archivo; ?>"></p>
                </div>

                <?php
                $buscar2 = "SELECT * FROM cita WHERE pedido = $id_pedido";
                $resultado2 = mysqli_query($conexion[0], $buscar2);

                if (mysqli_num_rows($resultado2) > 0) {
                    while ($row2 = mysqli_fetch_array($resultado2)) {
                        $fechacita = $row2['fecha_cita'];
                        $fechacita = strtotime($fechacita);
                        $fechacita = date("d/m/y", $fechacita);
                        $horacita = $row2['hora_cita'];
                        $horacita = strtotime($horacita);
                        $horacita = date("H:i", $horacita);
                ?>
                        <div class="item-table">
                            <p class="titulos-card">Fecha de la Cita</p>
                            <p><?php echo $fechacita; ?></p>
                            <p class="titulos-card">Hora del registro de la Cita</p>
                            <p><?php echo $horacita; ?></p>
                        </div>
                        <?php
                    }

                    $buscar3 = "SELECT * FROM transporte WHERE pedido = $id_pedido";
                    $resultado3 = mysqli_query($conexion[0], $buscar3);
                    if (mysqli_num_rows($resultado3) > 0) {
                        while ($row3 = mysqli_fetch_array($resultado3)) {
                            $tipotrans = $row3['tipo_trans'];
                            if ($tipotrans == "P") {
                                $unidad = $row3['unidad'];
                                $chofer = $row3['chofer'];

                                $buscarU = "SELECT * FROM unidad WHERE id_unid = $unidad";
                                $resultadoU = mysqli_query($conexion[0], $buscarU);
                                while ($rowU = mysqli_fetch_array($resultadoU)) {
                        ?>
                                    <div class="item-table">
                                        <p class="titulos-card">Modelo de la Unidad</p>
                                        <p><?php echo $rowU['model_unid'];  ?></p>
                                    </div>

                                <?php
                                }

                                $buscarC = "SELECT * FROM chofer WHERE id_chf = $chofer";
                                $resultadoC = mysqli_query($conexion[0], $buscarC);
                                while ($rowC = mysqli_fetch_array($resultadoC)) {
                                ?>
                                    <div class="item-table">
                                        <p class="titulos-card">Nombre del Chofer</p>
                                        <p><?php echo $rowC['nom_chf']."&nbsp;".$rowC['apeP_chf']."&nbsp;".$rowC['apeM_chf']; ?></p>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="item-table">
                                    <p class="titulos-card">Transporte Externo</p>
                                    <p><?php echo $row3["nom_trans"]; ?></p>
                                </div>

                                <?php
                            }

                            $buscarA = "SELECT * FROM carga WHERE pedido = $id_pedido";
                            $resultadoA = mysqli_query($conexion[0], $buscarA);
                            if (mysqli_num_rows($resultadoA) > 0) {
                                while ($rowA = mysqli_fetch_array($resultadoA)) {
                                    $id_carga = $rowA['id_carga'];
                                    $fecha_carga = $rowA['fecha_carga'];
                                    $fecha_carga = strtotime($fecha_carga);
                                    $fecha_carga = date("d/m", $fecha_carga);
                                    $hora_carga = $rowA['hora_carga'];
                                    $hora_carga = strtotime($hora_carga);
                                    $hora_carga = date("H:i", $hora_carga);
                                ?>
                                    <div class="item-table">
                                        <p class="titulos-card">Fecha de Carga</p>
                                        <p><?php echo $fecha_carga; ?></p>
                                    </div>
                                    <?php
                                }

                                $buscarR = "SELECT * FROM reparto WHERE pedido = $id_pedido";
                                $resultadoR = mysqli_query($conexion[0], $buscarR);
                                if (mysqli_num_rows($resultadoR) > 0) {
                                    while ($rowR = mysqli_fetch_array($resultadoR)) {
                                        $fecha_rep = $rowR['fecha_rep'];
                                        $fecha_rep = strtotime($fecha_rep);
                                        $fecha_rep = date("d/m", $fecha_rep);
                                        $hora_rep = $rowR['hora_rep'];
                                        $hora_rep = strtotime($hora_rep);
                                        $hora_rep = date("H:i", $hora_rep);
                                    ?>
                                        <div class="item-table">
                                            <p class="titulos-card">Fecha de Reparto</p>
                                            <p><?php echo $fecha_rep; ?></p>
                                            <p class="titulos-card">Hoa de registro de la Entrega</p>
                                            <p><?php echo $hora_rep; ?></p>
                                        </div>

                                        <?php
                                    }

                                    $buscarE = "SELECT * FROM entrega WHERE pedido = $id_pedido";
                                    $resultadoE = mysqli_query($conexion[0], $buscarE);
                                    if (mysqli_num_rows($resultadoE) > 0) {
                                        while ($rowE = mysqli_fetch_array($resultadoE)) {
                                            $fecha_entrega = $rowE['fecha_entrega'];
                                            $fecha_entrega = strtotime($fecha_entrega);
                                            $fecha_entrega = date("d/m", $fecha_entrega);
                                            $hora_entrega = $rowE['hora_entrega'];
                                            $hora_entrega = strtotime($hora_entrega);
                                            $hora_entrega = date("H:i", $hora_entrega);
                                        ?>
                                            <div class="item-table">
                                                <p class="titulos-card">Fecha de Entrega</p>
                                                <p><?php echo $fecha_entrega ?></p>
                                                <p class="titulos-card">Hora del registro de la Entrega</p>
                                                <p><?php echo $hora_entrega ?></p>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="item-table">
                                        <p class="tarea-pendiente"><?php echo "SIN ENTREGA"; ?></p>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="item-table">
                                    <p class="tarea-pendiente"><?php echo "SIN REPARTO"; ?></p>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="item-table">
                                <p class="tarea-pendiente"><?php echo "SIN CARGA"; ?></p>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        ?>
                        <div class="item-table">
                        <p class="tarea-pendiente"><?php echo "SIN TRANSPORTE"; ?></p>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="item-table">
                        <p class="tarea-pendiente"><?php echo "SIN CITA"; ?></p>
                    </div>
                <?php
                }

                ?>
            </div>
        <?php } ?>

    </div>

</body>

</html>