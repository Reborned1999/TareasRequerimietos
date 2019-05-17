<?php

$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$nombreUsuario = $_POST['nombreUsuario'];
$fechaNacimiento = $_POST['bday'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];
$pregunta = $_POST['pregunta'];
$respuestaPregunta = $_POST['respuestaPregunta'];

if (!empty($nombre) || !empty($apellido1) || !empty($apellido2) || !empty($nombreUsuario) || !empty($fechaNacimiento) || !empty($password) || !empty($passwordConfirm) || !empty($pregunta) || !empty($respuestaPregunta)) {
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "proyectologin";

	$conexion = new mysqli($host, $dbUsername, $dbPassword, $dbName);

	if (mysqli_connect_error()) {
		die('Connect Error('. mysqli_connect_errorno().')'. mysqli_connect_error());
	} else {
		if ($password != $passwordConfirm) {
			die("Las contraseñas no coinciden<br><a href='index.html'> Volver</a>");
		}

		$statement = $conexion->prepare("SELECT doesUserExist(?)") or die($conexion->error);
		$statement->bind_param("s", $nombreUsuario) or die($statement->error);
		$statement->execute() or die($statement->error);
		$statement->bind_result($resultado);
		$statement->fetch();

		if ($resultado == "") {
			$statement->close();
			$password = sha1($password);
			$statement = $conexion->prepare("CALL registrarUsuario(?, ?, ?, ?, ?, ?, ?, ?)");
			$statement->bind_param("ssssssis", $nombre, $apellido1, $apellido2, $fechaNacimiento, $nombreUsuario, $password, $pregunta, $respuestaPregunta);
			$statement->execute();
			echo "Datos ingresados correctamente<br><a href='index.html'></a>";
			header('Location: crearCuenta.html');
		} else {
			echo "El nombre de usuario ya existe<br><a href='crearCuenta.html'></a>";
		}
		$statement->close();
		$conexion->close();
	}
} else {
	echo "Error al ingresar los datos<br><a href='index.html'> Volver</a>";
	die();
}
?>
