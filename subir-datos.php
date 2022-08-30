<?php
require_once('Metodos.php');
$metodos = new metodos();
$conexion = $metodos->conectarBD();

if (isset($_POST['subir-pedido'])) {

    /*if(file_exists($_FILES['imagen-pedido']['tmp_name'])){
        if(move_uploaded_file($_FILES['imagen-pedido']['tmp_name'],'imagenes/pedidos/'.$_FILES['imagen-pedido']['name'])){
            $url = 'imagenes/pedidos/'.$_FILES['imagen-pedido']['name'];*/
            $id_cliente = $_POST['cliente'];
            $fecha = $_POST['fecha'];
            $comentarios = $_POST['comentarios'];
            date_default_timezone_set('America/Mexico_City');
            $hora = date('H:i:s');
            $query = "INSERT INTO pedido (id_pedido, estado_pedido, fecha_pedido, hora_pedido, archivo_pedido, obs_pedido, cliente) 
                          VALUES (NULL, 'Pendiente', '$fecha', '$hora', '', '$comentarios', '$id_cliente')";

            $retval = mysqli_query($conexion[0], $query);

            if($retval){
                header("Location: panel-kanban-logistica.php?res=1");
            }
        /*}else{echo "No se ha subido segundo if";}
    }else{
        ?> <h1>ERROR AL CARGAR EL ARCHIVO</h1> <?php
    }*/

    }

    if(isset($_POST['iniciar'])){

        $usuario= $_POST['correo'];
        $contra= $_POST['contra'];

        if((!empty($usuario) || !empty($contra) ) && (isset($usuario) || isset($contra)) ){
            $buscar="select correo, nombre, apep, apem, tipo from usuario
            where correo='$usuario' and contrasena='$contra' ";
            $resultado= mysqli_query($conexion[0],$buscar);

            if($resultado){
            $filas= mysqli_num_rows($resultado);
                if($filas != 0){
                    while($ob= mysqli_fetch_array($resultado)){
                    $tipo= $ob['tipo'];
                    $nombre= $ob['nombre'];
                    $correo= $ob['correo'];
                    $apep= $ob['apep'];
                }
                
                session_start();
                $_SESSION['nombre']= $nombre;
                $_SESSION['apep']= $apep;
                $_SESSION['correo']= $correo;
                $_SESSION['tipo']= $tipo;

                if($tipo == "almacen"){
                    header('Location: panel-almacen.php');
                }

                if($tipo == "logistica"){
                    header('Location: panel-logistica.php');
                }

                if($tipo == "admin"){
                    header('Location: panel-admin.php');
                }               
            
                
            }else{
                header('Location: index.php?ok=2'); //en caso de que no exista un usuario
            }

            }else{
                header('Location: index.php?ok=0'); //en caso de fallar la conexión con la base de datos
            }

        }else{
            header('Location: index.php?ok=3'); //en caso de que no se llenen bien los campos
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
        
            $id_pedido = $_POST['id_pedido'];
            $id_unidad = $_POST['id_unid'];
            $id_chofer = $_POST['id_chf'];
            $comentarios = $_POST['comentarios'];

        
        $query1 = "SELECT * FROM pedido WHERE id_pedido = '$id_pedido'";
        $retval1 = mysqli_query($conexion[0], $query1);

        while ($row = mysqli_fetch_array($retval1)){
            $id_cliente = $row['cliente'];
        }

        $query2 = "SELECT * FROM cita WHERE pedido = '$id_pedido'";
        $retval2 = mysqli_query($conexion[0], $query2);

        while ($row2 = mysqli_fetch_array($retval2)){
            $id_cita = $row2['id_cita'];
        }

        $query3 = "INSERT INTO `transporte` (`id_trans`, `tipo_trans`, `nom_trans`, `apeP_trans`, `apeM_trans`,
         `rfc_trans`, `lictipo_trans`, `licnum_trans`, `tel_trans`, `email_trans`, `direcc_trans`, `obs_trans`, `cita`, `pedido`, `unidad`, `chofer`) 
        VALUES (NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$comentarios', '$id_cita', '$id_pedido', '$id_unidad', '$id_chofer')";
        $retval3 = mysqli_query($conexion[0], $query3);

        if($retval3){
            header("Location: panel-kanban-logistica.php?res=$id_pedido");
         }
        
    }

    if (isset($_POST['transporte-externo'])) {
        

        $id_pedido = $_POST['id_pedido'];
        $nombre = $_POST['Nombre'];
        $apeP = $_POST['apeP'];
        $apeM = $_POST['apeM'];

        $rfc = NULL;
        $licnum = NULL;
        $lictipo = $_POST['lictipo'];
        $tel = NULL;
        $email = NULL;
        $direcc = NULL;

        $obs = $_POST['comentarios'];

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
            header("Location: panel-kanban-logistica.php?res=$id_pedido");
         }
    }

    if (isset($_POST['subir-carga'])) {
        

        $id_pedido = $_POST['id_pedido'];
        $fecha = $_POST['fecha'];
        $obs = $_POST['comentarios'];
        date_default_timezone_set('America/Mexico_City');
        $hora = date('H:i:s');

        $queryT = "SELECT * FROM transporte WHERE pedido = '$id_pedido'";
        $retvalT = mysqli_query($conexion[0], $queryT);
        while ($rowT = mysqli_fetch_array($retvalT)){
            $id_trans = $rowT['id_trans'];
        }

        $querycarga = "INSERT INTO `carga` (`id_carga`, `fecha_carga`, `hora_carga`, `obs_carga`, `transporte`, `pedido`) 
        VALUES (NULL, '$fecha', '$hora', '$obs', '$id_trans', '$id_pedido')";
        $retval4 = mysqli_query($conexion[0], $querycarga);

        if($retval4){
            header("Location: panel-kanban-almacen.php?res=$id_pedido");
         }
    }

    if (isset($_POST['subir-reparto'])) {
        

        $id_pedido = $_POST['id_pedido'];
        $fecha = $_POST['fecha'];
        $obs = $_POST['comentarios'];
        date_default_timezone_set('America/Mexico_City');
        $hora = date('H:i:s');

        $queryC = "SELECT * FROM carga WHERE pedido = '$id_pedido'";
        $retvalC = mysqli_query($conexion[0], $queryC);
        while ($rowC = mysqli_fetch_array($retvalC)){
            $id_carga = $rowC['id_carga'];
        }

        $queryreparto = "INSERT INTO `reparto` (`id_rep`, `fecha_rep`, `hora_rep`, `obs_rep`, `carga`, `pedido`) 
        VALUES (NULL, '$fecha', '$hora', '$obs', '$id_carga', '$id_pedido')";
        $retval5 = mysqli_query($conexion[0], $queryreparto);

        if($retval5){
            header("Location: panel-kanban-almacen.php?res=$id_pedido");
         }
    }

    if (isset($_POST['subir-entrega'])) {
        

        $id_pedido = $_POST['id_pedido'];
        $fecha = $_POST['fecha'];
        $obs = $_POST['comentarios'];
        date_default_timezone_set('America/Mexico_City');
        $hora = date('H:i:s');

        $queryRep = "SELECT * FROM reparto WHERE pedido = '$id_pedido'";
        $retvalR = mysqli_query($conexion[0], $queryRep);
        while ($rowR = mysqli_fetch_array($retvalR)){
            $id_rep = $rowR['id_rep'];
        }

        $queryEntrega = "INSERT INTO `entrega` (`id_entrega`, `fecha_entrega`, `hora_entrega`, `direcc_entrega`, `nom_entrega`, `apeP_entrega`, `apeM_entrega`, `obs_entrega`, `reparto`, `pedido`) 
        VALUES (NULL, '$fecha', '$hora', 'Direccion', 'Nombre', 'Apellido1', 'Apellido2', '$obs', '$id_rep', '$id_pedido')";
        $retval6 = mysqli_query($conexion[0], $queryEntrega);

        if($retval6){
            header("Location: panel-kanban-almacen.php?res=$id_pedido");
         }
    }


?>