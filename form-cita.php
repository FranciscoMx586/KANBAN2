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
    <title>Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
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
                    <div class="navbar-nav">
                        <a class="nav-link" href="panel-kanban-logistica.php">Inicio</a>
                        <a class="nav-link a-nav" href="form-pedido.php" >Pedido</a>
                        <a class="nav-link a-nav" href="form-cita.php">Cita</a>
                        <a class="nav-link a-nav" href="form-transporte.php">Transporte</a>
                    </div>
                </div>
            </div>
        </nav>
        </div>
    </header>
    <div id="panel-cita">
        <section class="container">
            <div class=" row my-3">
                <form action="subir-datos.php" id="formulario-logistica" method="post">
                    <h2 class="form-titulo">Formulario De Cita</h2>
                    <div>
                        <label class="form-label">Pedidos</label>
                        <select class="form-select form-select-sm mb-3"  name="cliente" required>
                            <?php
                            if (isset($_GET['id_pedido'])) {
                                $id_pedido = $_GET['id_pedido'];
                                $get_info = "SELECT * FROM (SELECT cliente.nom_cliente as Cliente, pedido.id_pedido as id, `estado_pedido` as Estado, `archivo_pedido` as Archivo, `fecha_pedido` as Fecha, `hora_pedido` as Hora, `obs_pedido` as Observaciones FROM `pedido`, cliente WHERE pedido.cliente = cliente.id_cliente ORDER BY `Fecha` ASC, hora) as pedidos WHERE id = '$id_pedido'";
                                $get_info2 = mysqli_query($conexion[0], $get_info);
                                while ($rowinfo = mysqli_fetch_array($get_info2)) {
                                    $cliente = $rowinfo['Cliente'];
                                    $fecha = $rowinfo['Fecha'];
                                    $hora = $rowinfo['Hora'];
                                }
                                $getPedido1 = "SELECT * FROM pedidos WHERE Cliente = '$cliente' 
                                AND Fecha = '$fecha' AND Hora = '$hora' 
                                UNION 
                                SELECT * FROM `pedidos` WHERE Estado = 'Pendiente'";
                            }else{
                                $getPedido1 = "SELECT * FROM pedidos WHERE Estado='Pendiente'";
                            }
                            
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
                        <input required class="form-control" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> type="date" name="fecha" id="fecha">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>