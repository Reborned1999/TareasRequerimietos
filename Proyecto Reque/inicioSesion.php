<?php
$username = $_POST['username'];
$password = $_POST['password'];

if(!empty($username) || !empty($password)){
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "proyectoLogin";
	
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	if(mysqli_connect_error()){
		echo('Connection Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	}else{
		$encrypted = sha1($password);
		$stmt = $conn->prepare("call getUsuario(?,?)");
		$stmt->bind_param("ss", $username, $encrypted);
		$stmt->execute();
		//$stmt->bind_result($result);
		$stmt->store_result();
		$rnum=$stmt->num_rows;
		if($rnum == 1){
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
			die("Conexión establecida. <br>
			Bienvenido $username");
		}
		mysqli_stmt_close($stmt);
		$stmt = $conn->prepare("call isUser(?)");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		//$stmt->bind_result($result);
		$stmt->store_result();
		$rnum=$stmt->num_rows;
		if($rnum != 1){
			die("Not an existing user.<br><a href='index.html'> Volver</a>");
		}else{
			die("Incorrect password <br><a href='index.html'> Volver</a>");
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}else{
	echo "Información faltante";
	die();
}
?>