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
    <title>Pedido</title>
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
                        <input required class="form-control" type="date" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> name="fecha" id="fecha" required>
                    </div>
                    <!--<div class="col-12 mb-3">
                        <label class="form-label">Imagen del Pedido</label>
                        <input type="file" name="imagen-pedido" required accept="image/*" class="form-control">
                    </div>-->
                    <div class="col-12 mb-3">
                        <label class="form-label">Seccion de comentarios</label>
                        <textarea id="comentarios" class="form-control" name="comentarios" placeholder="Comentarios"></textarea>
                    </div>
                    <div class="mb-4 d-grid">
                        <input class="btn btn-primary" type="submit" name="subir-pedido" value="Guardar">
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>