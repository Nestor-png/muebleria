<?php include ("TEMPLATE/cabecera.php");?>
<?php include ("Administrador/config/bd.php");

  $sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
  $sentenciaSQL->execute();
  $listaProductos= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
  <?php foreach ($listaProductos as $mueble) { ?>
    <div class="col-md-3">
      <div class="card">
        <img class="card-img-top" src="img/<?php echo $mueble['imagen']; ?>" alt="" height="350px">
        <div class="card-body">
          <h4 class="card-title"><?php echo $mueble['nombre']; ?></h4>
          <a class="btn btn-primary" href="#" role="button">Ver Más</a>
        </div>
      </div>    
    </div>
  <?php } ?>
</div>

<?php include ("TEMPLATE/pie.php");?>
