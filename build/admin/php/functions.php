<?php
require_once("../db/conexion.php");
	if(isset($_POST['namefunction'])){
		include("connect_db.php");
		connect_base_de_datos();
		$namefunction = $_POST['namefunction'];
		switch ($namefunction) {
			case 'verifyPasswordLogin':
				verifyPasswordLogin();
				break;
			case 'addNewAdminUser':
				addNewAdminUser();
				break;
			case 'addNewCharacteristics':
				addNewCharacteristics();
				break;
			case 'changePassword':
				changePassword();
				break;
			case 'deleteAdmin':
				deleteAdmin();
				break;
			case 'getStatesUser':
				getStatesUser($_POST['idCategory']);
				break;
			case 'addNewProduct':
				addNewProduct();
				break;
			case 'editProduct':
				editProduct();
				break;
			case 'addNewSubcategory':
				addNewSubcategory();
				break;
			case 'getEditProduct':
				getEditProduct($_POST['idCategory']);
				break;
		}
	}

	function changePassword(){
		$idAdmin = $_POST['idAdmin'];
		$password = $_POST['password'];
		$passwordhash = password_hash($password, PASSWORD_DEFAULT);

		$query = "UPDATE Usuarios SET Password = '$passwordhash' WHERE IdUsuario = $idAdmin";
		$result = mysql_query($query) or die(mysql_error());
	}

	function deleteAdmin(){
			$idAdmin = $_POST['id'];
			$query = "DELETE FROM Usuarios WHERE IdUsuario = $idAdmin";
			$result = mysql_query($query) or die(mysql_error());
	}

	function addNewAdminUser(){
		$name = $_POST['username'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$typePerfil = $_POST['typePerfil'];
		$userPrivileges = $_POST['userPrivileges'];
		$passwordhash = password_hash($password, PASSWORD_DEFAULT);

		$query = "INSERT INTO Usuarios (Nombre, Apellido, Email, Password, TipoPerfil, Privilegios, adminLastConnection) VALUES
																		('$name', '$lastname', '$email', '$passwordhash', '$typePerfil','$userPrivileges', '0000-00-00 00:00:00')";
		$result = mysql_query($query) or die(mysql_error());
	}

	function verifyPasswordLogin(){

		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "SELECT * FROM Usuarios WHERE NombreUser = '$username'";
		$result = mysql_query($query) or die(mysql_error());
		if(mysql_num_rows($result) > 0){
			$find = false;
			while($line = mysql_fetch_array($result)){
				if(password_verify($password, $line['Password'])){
					$find = true;
					date_default_timezone_set('America/Mexico_City');
					$lastDate = date("Y-m-d H:i:s");
					$query2 = "UPDATE Usuarios SET UltimaConexion = '$lastDate' WHERE IdUsuario = ".$line['IdUsuario'];
					$result2 = mysql_query($query2) or die(mysql_error());
					session_start();
					$_SESSION['idAdmin'] = $line['IdUsuario'];
					$_SESSION['Usuario'] = $line['NombreUser'];
					$_SESSION['idPrivilegio'] = $line['Privilegios'];
				}
			}
			if($find)
				echo 1;
			else
			 echo -1;
		}else{
			echo 0;
		}

	}

	function getStatesUser($id){

		$query = "SELECT * FROM Subcategoria WHERE Categorias_IdCategoria = $id ORDER BY Subcategoria ASC";
		$result = mysql_query($query) or die(mysql_error());
		echo '<option disabled selected value="">Selecciona..</option>';
		while ($line = mysql_fetch_array($result)) {
			echo '<option value="'.$line["IdSubcategoria"].'" name="'.$line["IdSubcategoria"].'">'.$line["Subcategoria"].'</option>';
		}

	}

	function getEditProduct($id){

		$query = "SELECT * FROM Subcategoria WHERE Categorias_IdCategoria = $id ORDER BY Subcategoria ASC";
		$result = mysql_query($query) or die(mysql_error());
			echo '<option disabled selected value="">Selecciona..</option>';
		while ($line = mysql_fetch_array($result)) {
			echo '<option value="'.$line["IdSubcategoria"].'" name="'.$line["IdSubcategoria"].'">'.$line["Subcategoria"].'</option>';
		}

	}

	function addNewProduct() {
	
		parse_str($_POST['action'],$formData);
		
	    date_default_timezone_set('UTC');
	    date_default_timezone_set("America/Mexico_City");
	    $datatime = date("Y-m-d H:i:s");

		$image = "null";

		$convert_name = explode(' ', $formData['name_product']);
		$convert_name = strtolower(implode('-', $convert_name));
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));
		
		$sql_products = "INSERT INTO Productos 
							VALUES (null,'".$formData['name_product']."',
								'".$formData['description']."','".$route_name."','".$formData['stocks']."',
								'".$formData['pricelist']."','".$formData['pricefailbox']."',
								'".$formData['model']."','".$formData['sku']."',
								'".$formData['status']."','".$image."',
								'".$formData['url_paypal']."','".$formData['outstanding']."',
								'".$datatime."','".$formData['brand']."','".$formData['category']."',
								'".$formData['subcategory']."')";
		$res = mysql_query($sql_products,Conectar::con()) or die(mysql_error());

		//Obtenemos el ultimo id añadido en la tabla Productos
		$id_producto = mysql_insert_id();

		echo $id_producto;
		
	}

	function addNewCharacteristics() {

		parse_str($_POST['action'],$formData);
		
	    date_default_timezone_set('UTC');
	    date_default_timezone_set("America/Mexico_City");
	    $datatime = date("Y-m-d H:i:s");

	    $query = "SELECT * FROM Productos_has_Caracteristicas WHERE Productos_IdProducto = '".$formData['idProducto']."' AND Caracteristicas_IdCaracteristica = '".$formData['type_characteristic']."'";
		$result = mysql_query($query,Conectar::con()) or die(mysql_error());
		$row_type = mysql_num_rows($result);

		//Si el resultado de $row_type es igual a "0" es porque no existe en la tabla, pero si es "1", ya se tiene ese tipo de caracteristica registrada
		//Entonces continuamos con la validacion
		if ($row_type == 0) {

			$sql = "INSERT INTO Productos_has_Caracteristicas VALUES ('".$formData['idProducto']."','".$formData['type_characteristic']."','".$formData['characteristic']."')";
			$res = mysql_query($sql,Conectar::con()) or die(mysql_error());

			echo $formData['idProducto'];

		} else {

			echo $formData['idProducto'];

		}
		
	}

	function addNewSubcategory() {

		parse_str($_POST['action'],$formData);

		$query = "SELECT * FROM Subcategoria WHERE Categorias_IdCategoria = '".$formData['category']."' AND Subcategoria = '".$formData['other_subcategory']."'";
		$resultado = mysql_query($query,Conectar::con()) or die(mysql_error()); 
		$row = mysql_num_rows($resultado);

		if ($row == 0) {

			$convert_name = explode(' ', $formData['other_subcategory']);
			$convert_name = strtolower(implode('-', $convert_name));
			$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
			$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
			$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

			$sql = "INSERT INTO Subcategoria (IdSubcategoria, Subcategoria, RouteSubcategoria, Categorias_IdCategoria) VALUES ('','".$formData['other_subcategory']."','".$route_name."','".$formData['category']."')";
			$res = mysql_query($sql,Conectar::con()) or die(mysql_error());

			$id = mysql_insert_id();
			echo '<span style="color:blue">Se agrego correctamente...!!</span><br>';

		} else {

			echo '<span style="color:red">Ya existe la subcategoria, intente de nuevo!!</span><br>';

		}
		
	}

	function editProduct() {

	    parse_str($_POST['action'], $formData);

	    date_default_timezone_set('UTC');
	    date_default_timezone_set("America/Mexico_City");
	    $datatime = date("Y-m-d H:i:s");

	    $convert_name = explode(' ', $formData['name_product']);
		$convert_name = strtolower(implode('-', $convert_name));
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

	    //Realizamos los cambios de los datos a la tabla Productos
	    $sql_changes_prod = "UPDATE Productos 
	                            SET NombreProd='" . $formData['name_product'] . "', RouteProd='" .$route_name. "', Descripcion='" . $formData['description'] . "', 
	                                Stock='" . $formData['stocks'] . "', PrecioLista='" . $formData['pricelist'] . "', 
	                                PrecioFailbox='" . $formData['pricefailbox'] . "', Modelo='" . $formData['model'] . "',
	                                SKU='" . $formData['sku'] . "', Estatus='" . $formData['estatus'] . "',
	                                urlPaypal='" . $formData['url_paypal'] . "',Destacado='" . $formData['outstanding'] . "',
	                                FechaAlta='".$datatime."', Marcas_IdMarca='".$formData['brand']."', Categorias_IdCategoria='".$formData['category']."', 
	                                Subcategoria_IdSubcategoria='".$formData['subcategory']."'
								WHERE IdProducto = '" . $formData['id'] . "'";
	    $res = mysql_query($sql_changes_prod, Conectar::con()) or die(mysql_error());
	    
	    $id_product = $formData['id'];
	    echo $id_product;
	}

	