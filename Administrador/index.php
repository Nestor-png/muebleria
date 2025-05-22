<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['usuario'] == "nestor" && $_POST['contrasenia'] == "sistema") {
        $_SESSION['usuario'] = "ok";
        $_SESSION['nombreUsuario'] = "nestor";
        header('Location:inicio.php');
        exit;
    } else {
        $mensaje = "Error: El usuario y la contraseña son incorrectos";
    }
}
?>

<!doctype html>
 <html lang="es">
  <head>
    <title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../CSS/bootstrap.min.css"/>
  </head>
  <body>
      

      <div class="container">
        <div class="row">
      <div class="col-md-4">
      </div>    
        <div class="col-md-4">
          <br> <br>
            <div class="card">
                <div class="card-header">
                    Iniciar Sesión
                </div>
                <div class="card-body">
                  <!--mensaje de error-->
                  <?php if(isset($mensaje)){?>
                  <div class="alert alert-danger" role="alert">
                    <strong></strong>
                    <?php echo $mensaje;}?>
                  
                  </div>
                   <form method="post">

                   <div class = "form-group">
                   <label for="exampleInputEmail1">Usuario</label>
                   <input type="text" class="form-control" id="exampleInputEmail1" name="usuario" aria-describedby="emailHelp" placeholder="Ingrese Usuario">
                   </div>
                   <div class="form-group">
                   <label for="exampleInputPassword1">Contraseña</label>
                   <input type="password" class="form-control" id="exampleInputPassword1" name="contrasenia" placeholder="Ingrese Contraseña">
                   </div>
                   <button type="submit" class="btn btn-primary">INGRESAR AL ADMINISTRADOR</button>

                   </form>
                </div>
            </div>
            </div>
            
        </div>
      </div>

  </body>
 </html>