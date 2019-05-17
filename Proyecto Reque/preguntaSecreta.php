<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Proyecto Reque</title>
    <link rel="stylesheet" href="styleIndex.css">
  </head>
  <body>
<!--action="index.html"--> 
<form class="box" action="validarRespuesta.php" method="post">
  
  <img src="images/colorDots.png" alt="Dots">
  <h1>Responde la pregunta de seguridad</h1>
  </br>
  <b>

  <?php

  session_start();

  $username = $_SESSION['username'];

  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "proyectologin";
  $conexion = new mysqli($host, $dbUsername, $dbPassword, $dbName);
  if (mysqli_connect_error()) {
      die('Connect Error('. mysqli_connect_errorno().')'. mysqli_connect_error());
  } else {
      $statement = $conexion->prepare("SELECT getPregunta(?)") or die($conexion->error);
      $statement->bind_param("s", $username) or die($statement->error);
      $statement->execute() or die($statement->error);
      $statement->bind_result($pregunta);
      $statement->fetch();
      echo $pregunta;
      $statement->close();
      $conexion->close();
  }

  ?>
  
  </b>
  <input type="text" name="respuestaPregunta" placeholder="Respuesta">
  <input type="submit" name="" value="Aceptar">
  </br>
  <b>¿Ya tienes una cuenta?</b><a href="index.html"> Iniciar Sesión</a>
  
</form>


  </body>
</html>
