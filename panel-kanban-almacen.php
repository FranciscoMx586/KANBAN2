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
    <title>Panel Almacen</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="panel-almacen.php">PromoQuin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                </div>
            </div>
        </nav>
        </div>
    </header>
    <div class="container w-75 mt-5 rounded shadow">
        <div class="row align-items-strech mt-5">
            <div class="col rounded shadow-sm border p-3">
                <img class="img-pedido" src="imagenes/carga.png" alt="">
                <a class="btn btn-primary d-grid" href="form-carga.php">Carga</a>
            </div>
            <div class="col rounded shadow-sm border p-3">
                <img class="img-cita" src="imagenes/transporte.png" alt="">
                <a class="btn btn-primary d-grid" href="form-reparto.php">Reparto</a>
            </div>
            <div class="col rounded shadow-sm border p-3">
                <img class="img-transporte" src="imagenes/entrega.png" alt="">
                <a class="btn btn-primary d-grid" href="form-entrega.php">Entrega</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>