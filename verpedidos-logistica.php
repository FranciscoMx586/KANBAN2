<?php
require_once('Metodos.php');
$metodos = new metodos();
$conexion = $metodos->conectarBD();
?>
<?php 
session_start();
error_reporting(0);
$varsesion = $_SESSION['tipo'];
if($varsesion == null || $varsesion = ''){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Pedidos Kanban PromoQuin</title>
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="panel-logistica.php">PromoQuin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                </div>
            </div>
        </nav>
    </header>
    <div class="container w-80 mt-5 mb-5 rounded shadow text-center">
        <!--<h2 class="fw-bold text-center py-5">Panel de los Pedidos</h2>-->
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
            $hora_pedido = $row['Hora'];
            $fecha_pedido = $row['Fecha'];
            $fecha = strtotime($fecha_pedido);
            $fecha = date("d/m/y", $fecha);
            $id_pedido = $row['id_pedido'];
            $Observaciones = $row['Observaciones'];
        ?>

            <div class="row p-2 ">
                <?php
                ?>
                <div id="card-pedido" class="col rounded shadow-sm border p-3">
                    <p class="titulos-card">Cliente del Pedido</p>
                    <p class="echo-cliente"><?php echo $cliente; ?></p>
                    <p class="titulos-card">Fecha del Pedido</p>
                    <p><?php echo $fecha; ?></p>

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
                        $idcita = $row2['id_cita'];
                ?>
                        <div id="card-cita" class="col rounded shadow-sm border p-3 ">
                            <p class="titulos-card">Fecha de la Cita</p>
                            <p><?php echo $fechacita; ?></p>
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
                                    <div id="card-unidad" class="col rounded shadow-sm border p-3">
                                        <p class="titulos-card">Modelo de la Unidad</p>
                                        <p><?php echo $rowU['model_unid'];  ?></p>
                                    </div>

                                <?php
                                }

                                $buscarC = "SELECT * FROM chofer WHERE id_chf = $chofer";
                                $resultadoC = mysqli_query($conexion[0], $buscarC);
                                while ($rowC = mysqli_fetch_array($resultadoC)) {
                                ?>
                                    <div id="card-chofer" class="col rounded shadow-sm border p-3">
                                        <p class="titulos-card">Nombre del Chofer</p>
                                        <p><?php echo $rowC['nom_chf'] . "&nbsp;" . $rowC['apeP_chf'] . "&nbsp;" . $rowC['apeM_chf']; ?></p>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div id="card-externo" class="col rounded shadow-sm border p-3">
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
                                    $fecha_carga = date("d/m/y", $fecha_carga);
                                    $hora_carga = $rowA['hora_carga'];
                                    $hora_carga = strtotime($hora_carga);
                                    $hora_carga = date("H:i", $hora_carga);
                                ?>
                                    <div id="card-carga" class="col rounded shadow-sm border p-3">
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
                                        $fecha_rep = date("d/m/y", $fecha_rep);
                                        $hora_rep = $rowR['hora_rep'];
                                        $hora_rep = strtotime($hora_rep);
                                        $hora_rep = date("H:i", $hora_rep);
                                    ?>
                                        <div id="card-reparto" class="col rounded shadow-sm border p-3">
                                            <p class="titulos-card">Fecha de Reparto</p>
                                            <p><?php echo $fecha_rep; ?></p>

                                        </div>

                                        <?php
                                    }

                                    $buscarE = "SELECT * FROM entrega WHERE pedido = $id_pedido";
                                    $resultadoE = mysqli_query($conexion[0], $buscarE);
                                    if (mysqli_num_rows($resultadoE) > 0) {
                                        while ($rowE = mysqli_fetch_array($resultadoE)) {
                                            $fecha_entrega = $rowE['fecha_entrega'];
                                            $fecha_entrega = strtotime($fecha_entrega);
                                            $fecha_entrega = date("d/m/y", $fecha_entrega);
                                            $hora_entrega = $rowE['hora_entrega'];
                                            $hora_entrega = strtotime($hora_entrega);
                                            $hora_entrega = date("H:i", $hora_entrega);
                                        ?>
                                            <div id="card-entrega" class="col rounded shadow-sm border p-3">
                                                <p class="titulos-card">Fecha de Entrega</p>
                                                <p><?php echo $fecha_entrega ?></p>

                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col rounded shadow-sm border p-3">
                                            
                                            <button href="#" class="btn btn-danger">SIN ENTREGA</button>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col rounded shadow-sm border p-3">
                            
                                        <button href="#" class="btn btn-danger">SIN REPARTO</button>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="col rounded shadow-sm border p-3">
                                    
                                    <button href="#" class="btn btn-danger">SIN CARGA</button>
                                </div>
                        <?php
                            }
                        }
                    } else {
                        ?>
                        <div class="col rounded shadow-sm border p-3">
                            <a href="form-transporte.php" class="btn btn-danger">SIN TRANSPORTE</a>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="col rounded shadow-sm border p-3">
            
                        <a href="form-cita.php?id_pedido=<?php echo $id_pedido; ?>" class="btn btn-danger">SIN CITA</a>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php } ?>

    </div>

</body>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</html>