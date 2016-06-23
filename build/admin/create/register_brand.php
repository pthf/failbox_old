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
		$convert_name = explode(' ', $capital_brand);
		$convert_name = strtolower(implode('-', $convert_name));
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

		//registra los categorias de los productos
		$sql = "INSERT INTO Marcas (IdMarca, Marca, RouteMarca) VALUES ('', '".$capital_brand."', '".$route_name."')";
		$resultado_consulta_mysql = mysql_query($sql,Conectar::con());

	} 

}

include('consult_brand.php');
?>