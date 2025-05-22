<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] != "ok") {
    header("Location: index.php");
    exit;
}

$nombreUsuario = $_SESSION['nombreUsuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Mueblería/CSS/bootstrap.min.css"/>
    <title>Inicio</title>
</head>
<body>
 <?php
    $url="http://".$_SERVER['HTTP_HOST']."/Mueblería"
 ?>
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="<?php echo $url;?>/Administrador/inicio.php">Inicio </a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Administrador/seccion/productos.php">Muebles </a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Administrador/seccion/cerrar.php">Cerrar </a>
            <a class="nav-item nav-link" href="<?php echo $url;?>">Ver Sitio Web </a>
        </div>
    </nav>  
        </div> <div class="container">
            <br><br>
        <div class="row">