<?php 
session_start();
  if(!isset($_SESSION['idAdmin']))
    header("Location: index.php");
  require_once("../db/conexion.php");
 
//variables POST
$brand = $_POST['other_brand'];
$lower_brand = strtolower($brand);
$capital_brand = ucwords($lower_brand);

if ($capital_brand == "" || $capital_brand == NULL) {

	echo "<span style='color:red'>Ingrese una marca!!</span><br>";

} else {

	$query = "SELECT Marca FROM Marcas WHERE Marca = '".$capital_brand."'"; 
	$result_query = mysql_query($query,Conectar::con()) or die(mysql_error());
	$row = mysql_num_rows($result_query);

	if ($row == 1) { 

		echo "<span style='color:red'>Ya existe la marca, intente de nuevo!!</span><br>";

	} else { 

		//registra los categorias de los productos
		$sql = "INSERT INTO Marcas (IdMarca, Marca) VALUES ('', '".$capital_brand."')";
		$resultado_consulta_mysql = mysql_query($sql,Conectar::con());

	} 

}

include('consult_brand.php');
?>