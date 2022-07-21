<?php
 class Metodos{
     
      private $db="kanban";
     
      function conectarBD(){
        $conexion= mysqli_connect("localhost","root","")or die ("no se contecto a la base de datos");
        $base= mysqli_select_db($conexion,$this->db);
          
        $conec = array();
        $conec[0]= $conexion;
        $conec[1]= $base;

        mysqli_set_charset($conexion,"utf8");
        
        return $conec;
    }
 }
?>
