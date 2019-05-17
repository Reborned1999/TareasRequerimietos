<?php

session_start();

$username = $_SESSION['username'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];

if (!empty($password) || !empty($passwordConfirm)) {
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "proyectologin";
	$conexion = new mysqli($host, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_error()) {
		die('Connect Error('. mysqli_connect_errorno().')'. mysqli_connect_error());
	} else {
		if ($password != $passwordConfirm) {
			die("Las contraseñas no coinciden<br><a href='cambiarContrasena.html'> Volver</a>");
		}
		$password = sha1($password);
		$statement = $conexion->prepare("CALL cambiarContrasena(?, ?)") or die($conexion->error);
		$statement->bind_param("ss", $username, $password) or die($statement->error);
		$statement->execute() or die($statement->error);
		echo "Contraseña actualizada correctamente<br><a href='index.html'> Volver</a>";
	}
	$statement->close();
	$conexion->close();
} else {
	echo "Debe ingresar una contraseña";
	die();
}

?>