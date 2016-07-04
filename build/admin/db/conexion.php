<?php
class Conectar
{
	//establecemos la conexión con la base de datos
	public static function con()
	{
		// $conexion = mysql_connect("localhost","failboxtest","failboxtest");
		//$conexion = mysql_connect("localhost","root","");
		$con = mysqli_connect("localhost","root","","failbox");
		mysqli_query($con,"SET NAMES 'utf8'");
		//mysql_select_db("failbox");
		return $con;
	}
}
?>
