<?php
require_once('Metodos.php');
$metodos = new metodos();
$conexion = $metodos->conectarBD();

if (isset($_POST['subir-pedido'])) {

    $id_cliente = $_POST['cliente'];
    $fecha = $_POST['fecha'];
    $comentarios = $_POST['comentarios'];
    date_default_timezone_set('America/Mexico_City');
    $hora = date('H:i:s');

    $type = $_FILES['imagen-pedido']['type'];
    $tmp_name = $_FILES['imagen-pedido']["tmp_name"];
    $name = $_FILES['imagen-pedido']["name"];

    if (empty($name)) {   //Esta línea de código es para detectar si el usuario subió una foto.
        $nuevo_path = 'imagenes/pedido.jpg';
    } else {
        $nuevo_path = "imagenes/pedidos/" . $name;
        move_uploaded_file($tmp_name, $nuevo_path);  //Todas estas líneas son para subir la imagen al servidor de la 28 a la 31
        $array = explode('.', $nuevo_path);
        $ext = end($array);
    }

    $query = "INSERT INTO pedido (id_pedido, estado_pedido, fecha_pedido, hora_pedido, archivo_pedido, obs_pedido, cliente) 
                          VALUES (NULL, 'Pendiente', '$fecha', '$hora', '$nuevo_path', '$comentarios', '$id_cliente')";

    $retval = mysqli_query($conexion[0], $query);

    if($retval){
        header("Location: panel-kanban-logistica.php?res=1");
     }
    }

     
    if (isset($_POST['form-cita'])) {

        $id_pedido = $_POST['cliente'];
        $fecha = $_POST['fecha'];
        $comentarios = $_POST['comentarios'];
        date_default_timezone_set('America/Mexico_City');
        $hora = date('H:i:s');

        $query1 = "SELECT * FROM pedido WHERE id_pedido = '$id_pedido'";
        $retval1 = mysqli_query($conexion[0], $query1);
        
        while ($row = mysqli_fetch_array($retval1)){
            $id_cliente = $row['cliente'];
        }

        $query3 = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
        $retval3 = mysqli_query($conexion[0], $query3);
        
        while ($row = mysqli_fetch_array($retval3)){
            $nombre_cliente = $row['nom_cliente'];
        }

        $query2 = "INSERT INTO cita (id_cita, fecha_cita, hora_cita, nom_cita, direcc_cita, obs_cita, pedido) 
                            VALUES (NULL, '$fecha', '$hora', '$nombre_cliente', 'Enrique Segoviano', '$comentarios', '$id_pedido')";

        $retval2 = mysqli_query($conexion[0], $query2);

        if($retval2){
            header("Location: panel-kanban-logistica.php?res=1");
         }

    }

    if (isset($_POST['transporte-propio'])) {

        $archivo_trans = $_POST['archivo_trans'];
        header("Location: panel-kanban-logistica.php?res=$archivo_trans");
        
            $id_pedido = $_POST['id_pedido'];
            $id_unidad = $_POST['id_unid'];
            $id_chofer = $_POST['id_chf'];
            $comentarios = $_POST['comentarios'];

        
        $query1 = "SELECT * FROM pedido WHERE id_pedido = '$id_pedido'";
        $retval1 = mysqli_query($conexion[0], $query1);

        while ($row = mysqli_fetch_array($retval1)){
            $id_cliente = $row['cliente'];
        }
        
    }

    if (isset($_POST['transporte-externo'])) {

        header("Location: panel-kanban-logistica.php?res=2");
        $archivo_trans = $_POST['cliente'];
        $nombre = $_POST['Nombre'];
        $apeP = $_POST['apeP'];
        $apeM = $_POST['apeM'];
        $rfc = $_POST['rfc'];
        $licnum = $_POST['licnum'];
        $lictipo = $_POST['lictipo'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $direcc = $_POST['direcc'];

        $obs = $_POST['comentarios'];

        $query = "SELECT * FROM pedido WHERE archivo_pedido = '$archivo_trans'";
        $retval1 = mysqli_query($conexion[0], $query);
        while ($row = mysqli_fetch_array($retval1)){
            $id_pedido = $row['id_pedido'];
        }

        $query2 = "SELECT * FROM cita WHERE pedido = '$id_pedido'";
        $retval2 = mysqli_query($conexion[0], $query2);
        while ($row2 = mysqli_fetch_array($retval2)){
            $id_cita = $row2['id_cita'];
        }

        $query3 = "INSERT INTO `transporte` (`id_trans`, `tipo_trans`, `nom_trans`, `apeP_trans`, `apeM_trans`,
         `rfc_trans`, `lictipo_trans`, `licnum_trans`, `tel_trans`, `email_trans`, `direcc_trans`, `obs_trans`, `cita`, `pedido`, `unidad`, `chofer`) 
        VALUES (NULL, 'E', '$nombre', '$apeP', '$apeM', '$rfc', '$licnum', '$lictipo', '$tel', '$email', '$direcc', '$obs', '$id_cita', '$id_pedido', '1', '1')";
        $retval3 = mysqli_query($conexion[0], $query3);

        if($retval3){
            header("Location: panel-kanban-logistica.php?res=1");
         }
    }


?>