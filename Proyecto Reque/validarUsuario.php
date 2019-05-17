<?php  

session_start();

$username = $_POST['username'];

if (!empty($username)) {
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "proyectologin";
	$conexion = new mysqli($host, $dbUsername, $dbPassword, $dbName);
	if (mysqli_connect_error()) {
		die('Connect Error('. mysqli_connect_errorno().')'. mysqli_connect_error());
	} else {
		$statement = $conexion->prepare("SELECT doesUserExist(?)") or die($conexion->error);
		$statement->bind_param("s", $username) or die($statement->error);
		$statement->execute() or die($statement->error);
		$statement->bind_result($resultado);
		$statement->fetch();
		if ($resultado == "") {
			echo "El usuario que ingresó no existe<br><a href='olvidoContrasena.html'> Volver</a>";
			die();
		} else {
			$_SESSION['username'] = $resultado;
			header('Location: preguntaSecreta.php');
		}
	}
	$statement->close();
	$conexion->close();
} else {
	echo "Debe ingresar un nombre de usuario";
	die();
}

?>