<?php 
if(!isset($_SESSION['idAdmin']))
	header("Location: index.php");
require_once("../db/conexion.php");
 
//consulta todos los empleados
$query = "SELECT * FROM Marcas ORDER BY Marca ASC";
$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
 	echo "<select id='brand' name='brand' class='form-control' required>";
	echo "<option disabled selected>Selecciona..</option>";
while($fila=mysqli_fetch_array($resultado)){
 	echo "<option value='".$fila['IdMarca']."'>".$fila['Marca']."</option>";
}
  	echo "</select>";