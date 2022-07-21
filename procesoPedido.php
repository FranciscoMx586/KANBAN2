<?php
require_once('Metodos.php');
$metodos= new metodos();
$conexion= $metodos->conectarBD();
$nom= $_POST['nombre'];
$precio= $_POST['precio'];
$descri= $_POST['descri'];
$cantidad =$_POST['cantidad'];
$existencia =$_POST['cantidad'];
$categoria= $_POST['categoria'];

//Variables para recibir la imagen desde el formulario
$type=$_FILES['imagen']['type'];
$tmp_name = $_FILES['imagen']["tmp_name"];
$name = $_FILES['imagen']["name"];   

$val="select count(art_nom) as res from articulo where art_nom='$nom'";
    
$found= mysqli_query($conexion[0],$val);
    
while($ob=mysqli_fetch_array($found)){
       $existe= $ob['res'];
} 

if($existe==0){
           
  /*$nuevo_path="imgs/users/".$name;    strcmp($nuevo_path,'imgs/perfiles/')==0*/  

if(empty($name)){   //Esta línea de código es para detectar si el usuario subió una foto.
   $nuevo_path= 'imagenes/funkoprueba.jpg';
}else{
  $nuevo_path="imagenes/prods/".$name;
  move_uploaded_file($tmp_name,$nuevo_path);  //Todas estas líneas son para subir la imagen al servidor de la 28 a la 31
  $array=explode('.',$nuevo_path);
  $ext= end($array);
}
 
$query="INSERT INTO articulo 
(art_nom, art_precio, art_descr, art_cant, art_categoria, art_existencia, imagen) 
VALUES('$nom','$precio','$descri','$cantidad','$categoria','$existencia','$nuevo_path')"; 

$retval= mysqli_query($conexion[0],$query);
    
if($retval){
   header("Location: crearProd.php?res=1");   //En caso de que todo salga con exito, mandará un 1
}else{
   header("Location: crearProd.php?res=2");   //En caso de tener un problema con la bd, mandará un 2
       
   } 

}else{
   header("Location: crearProd.php?res=3"); //En caso de existir el usuario, retornará el número 4
}

?>
