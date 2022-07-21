<?php
 require_once('Metodos.php');
 $metodos= new Metodos();
 $conexion= $metodos->conectarBD();


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

?>
