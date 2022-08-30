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
    <title>Reparto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="panel-almacen.php">PromoQuin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="panel-kanban-almacen.php">Inicio</a>
                        <a class="nav-link a-nav" href="form-carga.php" >Carga</a>
                        <a class="nav-link a-nav" href="form-reparto.php">Reparto</a>
                        <a class="nav-link a-nav" href="form-entrega.php">Entrega</a>
                    </div>
                </div>
            </div>
        </nav>
        </div>
    </header>
    <div id="panel-reparto">
        <section class="container">
            <div class="row my-3">
                <form action="subir-datos.php" method="post" id="formulario-almacen">
                    <h2 class="form-titulo">Formulario De Reparto</h2>
                    <div class="col-12 mb-3">
                        <label class="form-label">Pedidos listos para Viaje</label>
                        <select required name="id_pedido" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <?php
                            $getcarga = "SELECT * FROM 
                        (SELECT cliente.nom_cliente as Cliente, `estado_pedido` as Estado, `archivo_pedido` as Archivo, `fecha_pedido` as Fecha, `hora_pedido` as Hora, `obs_pedido` as Observaciones, pedido.id_pedido as idPedido FROM `pedido`, cliente WHERE pedido.cliente = cliente.id_cliente ORDER BY `Fecha` ASC, hora) 
                        as pedidosconid WHERE Estado = 'En Carga'";
                            $getcarga2 = mysqli_query($conexion[0], $getcarga);

                            while ($rowcarga = mysqli_fetch_array($getcarga2)) {
                                $id_pedido = $rowcarga['idPedido'];
                                $cliente_carga = $rowcarga['Cliente'];
                                $fecha = $rowcarga['Fecha'];
                            ?>
                                <option value="<?php echo $id_pedido;  ?>"><?php echo $cliente_carga . "" . $fecha;  ?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="fecha">Fecha de Reparto</label>
                        <input class="form-control" type="date" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> name="fecha" id="fecha">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="comentarios">Comentarios</label>
                        <textarea id="comentarios" class="form-control" name="comentarios" placeholder="Comentarios"></textarea>
                    </div>
                    <div class="d-grid">
                    <input class="btn btn-primary d-grid" name="subir-reparto" type="submit" value="Guardar">
                    </div>
                </form>
            </div>
        </section>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>