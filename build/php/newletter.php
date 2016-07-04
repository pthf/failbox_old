<?php
	require_once("../admin/db/conexion.php");
	
	$email = $_POST['email'];
  
	$query = "SELECT * FROM Newsletter WHERE Email = '".$email."'";
	$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
	$row = mysqli_num_rows($resultado);

	if ($row == 0) {
		$query1 = "INSERT INTO Newsletter VALUES(null,'".$email."')";
		$resultado1 = mysqli_query(Conectar::con(),$query1) or die(mysqli_error());
	} else {
		echo -1;
	}
?>
