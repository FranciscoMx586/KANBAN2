<?php
 session_start();
 error_reporting(0);
$varsesion = $_SESSION['tipo'];
if($varsesion == null || $varsesion = ''){
    header('Location: index.php');
}
 session_destroy();
 header('Location: index.php');
?>
