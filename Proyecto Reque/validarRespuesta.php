<?php

session_start();

$username = $_SESSION['username'];
$respuesta = $_POST['respuestaPregunta'];

if (!empty($respuesta)) {
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "proyectologin";
	$conexion = new mysqli($host, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_error()) {
		die('Connect Error('. mysqli_connect_errorno().')'. mysqli_connect_error());
	} else {
		$statement = $conexion->prepare("SELECT getRespuesta(?)") or die($conexion->error);
		$statement->bind_param("s", $username) or die($statement->error);
		$statement->execute() or die($statement->error);
		$statement->bind_result($respuestaBase);
		$statement->fetch();
		if ($respuestaBase != $respuesta) {
			echo "La respuesta no es correcta. Intente de nuevo<br><a href='preguntaSecreta.html'> Volver</a>";
			die();
		} else {
			header('Location: cambiarContrasena.html');
		}
	}
	$statement->close();
	$conexion->close();
} else {
	echo "Debe ingresar una respuesta";
	die();
}

?>