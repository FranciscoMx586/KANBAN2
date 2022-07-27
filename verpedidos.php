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
        <div class="titulo-tabla">Pedidos</div>
        <?php
        $buscar = "SELECT cliente.nom_cliente as Cliente, `estado_pedido` as Estado, `archivo_pedido` as Archivo, `fecha_pedido` as Fecha, `hora_pedido` as Hora, `obs_pedido` as Observaciones, pedido.id_pedido FROM `pedido`, cliente WHERE pedido.cliente = cliente.id_cliente ORDER BY `Fecha` ASC, hora";
        $resultado = mysqli_query($conexion[0], $buscar);
        while ($row = mysqli_fetch_array($resultado)) {
            $cliente = $row['Cliente'];
            $estado = $row['Estado'];
            $Archivo = $row['Archivo'];
            $fecha = $row['Fecha'];
            $fecha = strtotime($fecha);
            $fecha = date("d/m", $fecha);
            $id_pedido = $row['id_pedido'];
            $Observaciones = $row['Observaciones'];
        ?>
            <div>
                <?php echo $cliente . "&nbsp;&nbsp;&nbsp;" . $fecha . "&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp";

                $buscar2 = "SELECT * FROM cita WHERE pedido = $id_pedido";
                $resultado2 = mysqli_query($conexion[0], $buscar2);

                if (mysqli_num_rows($resultado2) > 0) {
                    while ($row2 = mysqli_fetch_array($resultado2)) {
                        $fechacita = $row2['fecha_cita'];
                        $fechacita = strtotime($fechacita);
                        $fechacita = date("d/m", $fechacita);
                        $horacita = $row2['hora_cita'];
                        $horacita = strtotime($horacita);
                        $horacita = date("H:i", $horacita);
                        echo $fechacita . "&nbsp;" . $horacita . "&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;";
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
                                    echo $rowU['model_unid'] . "&nbsp;&nbsp;&nbsp;";
                                }

                                $buscarC = "SELECT * FROM chofer WHERE id_chf = $chofer";
                                $resultadoC = mysqli_query($conexion[0], $buscarC);
                                while ($rowC = mysqli_fetch_array($resultadoC)) {
                                    echo $rowC['nom_chf'] . "&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;";
                                }
                            } else {
                                echo "Trans-Externo &nbsp;&nbsp;&nbsp;" . $row3["nom_trans"] . "&nbsp;&nbsp;&nbsp;|| &nbsp;&nbsp;&nbsp;";
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

                                    echo $fecha_carga . "&nbsp;" . $hora_carga . "&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;";
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

                                        echo $fecha_rep . "&nbsp;" . $hora_rep . "&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;";
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

                                            echo $fecha_entrega . "&nbsp;" . $hora_entrega . "&nbsp;&nbsp;&nbsp;";
                                        }
                                    } else {
                                        echo "Sin Entrega";
                                    }
                                } else {
                                    echo "SIN REPARTO";
                                }
                            } else {
                                echo "SIN CARGAS";
                            }
                        }
                    } else {
                        echo "SIN TRANSPORTES";
                    }
                } else {
                    echo "SIN CITA";
                }

                ?> </div>
        <?php } ?>

    </div>


</body>

</html>