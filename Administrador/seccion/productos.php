<?php include('../template/header.php'); ?>

<?php

 $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
 $txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
 $txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
 $txtAccion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

 include('../config/bd.php');

 switch ($txtAccion) {
  case "Agregar":
    $sentenciaSQL = $conexion->prepare("INSERT INTO productos (nombre, imagen) VALUES (:nombre, :imagen);");
    $sentenciaSQL->bindParam(':nombre', $txtNombre);
  
    $fecha = new DateTime();
    $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImagen']['name'] : "imagen.jpg";
    $tmpImagen = $_FILES['txtImagen']['tmp_name'];
  
    if ($tmpImagen != "") {
      move_uploaded_file($tmpImagen, "../../IMG/" . $nombreArchivo);
    }
  
    $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
    $sentenciaSQL->execute();
    header('Location:productos.php');
    exit();
  
  case "Modificar":
    $sentenciaSQL = $conexion->prepare("UPDATE productos SET nombre= :nombre WHERE ID= :id");
    $sentenciaSQL->bindParam(':nombre', $txtNombre);
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
    
    if ($txtImagen != "") {
        $fecha = new DateTime();
        $nombreArchivo = $fecha->getTimestamp() . "_" . $_FILES['txtImagen']['name'];
        $tmpImagen = $_FILES['txtImagen']['tmp_name'];
    
      if ($tmpImagen != "") {
        move_uploaded_file($tmpImagen, "../../IMG/" . $nombreArchivo);
    
    $sentenciaSQL = $conexion->prepare("SELECT imagen FROM productos WHERE ID= :id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
      $mueble = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
      if (isset($mueble["imagen"]) && ($mueble["imagen"] != "imagen.jpg")) {
       if (file_exists("../../IMG/" . $mueble["imagen"])) {
        unlink("../../IMG/" . $mueble["imagen"]);
        }
      }
    
    $sentenciaSQL = $conexion->prepare("UPDATE productos SET imagen= :imagen WHERE ID= :id");
    $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
    }
  }
    
    header('Location:productos.php');
    exit();
    
  case "Cancelar":
    header('Location:productos.php');
    exit();
      
  case "Seleccionar":
    $sentenciaSQL = $conexion->prepare("SELECT * FROM productos WHERE ID= :id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
      $mueble = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
      $txtNombre = $mueble['nombre'];
      $txtImagen = $mueble['imagen'];
    break;
        
  case "Borrar":
    $sentenciaSQL = $conexion->prepare("SELECT imagen FROM productos WHERE ID= :id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
      $mueble = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
          
      if (isset($mueble["imagen"]) && ($mueble["imagen"] != "imagen.jpg")) {
      if (file_exists("../../IMG/" . $mueble["imagen"])) {
        unlink("../../IMG/" . $mueble["imagen"]);
      }
    }
          
    $sentenciaSQL = $conexion->prepare("DELETE FROM productos WHERE ID=:id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
    header('Location:productos.php');
    exit();
          
 }
    $sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
    $sentenciaSQL->execute();
    $listaProductos= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">
  <div class="card">
    <div class="card-header">
      DATOS DEL MUEBLE
    </div>
    <div class="card-body">

      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtID">ID</label>
          <input type="text" readonly class="form-control" name="txtID" value="<?php echo $txtID; ?>" id="txtID" placeholder="ID">
        </div>

        <div class="form-group">
          <label for="txtNombre">Nombre</label>
          <input type="text" class="form-control" name="txtNombre" value="<?php echo $txtNombre; ?>" id="txtNombre" placeholder="Nombre">
        </div>

        <div class="form-group">
          <label for="txtImagen">Imagen</label>
          <?php echo $txtImagen; ?> 
          <?php if($txtImagen!=""){?> 
            <img src="../../IMG/<?php echo $mueble ['imagen']; ?>" width="50" class="rounded" alt=""> 
          <?php } ?>

          <input type="file" class="form-control-file" name="txtImagen" id="txtImagen" placeholder="Imagen">
        </div>
        <br>
        <div class="btn-group" role="group" aria-label="">
          <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
          <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
          <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-7">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Imagen</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>

 <?php foreach($listaProductos as $mueble){?>
      <tr>
        <td><?php echo $mueble['ID']; ?></td>
        <td><?php echo $mueble['nombre']; ?></td>
        <td>
          <img src="../../IMG/<?php echo $mueble ['imagen']; ?>" width="50" class="rounded" alt="">
        </td>
        <td>
          <form method="POST">
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $mueble["ID"];?>">
            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
          </form>
        </td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>

<?php include('../template/footer.php'); ?>
