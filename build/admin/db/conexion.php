<?php
class Conectar
{
	//establecemos la conexión con la base de datos
	public static function con()
	{
		$conexion = mysql_connect("localhost","root","");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db("failbox");
		return $conexion;
	}
}
?>