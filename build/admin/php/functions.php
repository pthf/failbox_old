<?php
require_once("../db/conexion.php");
	if(isset($_POST['namefunction'])){
		//include("connect_db.php");
		//connect_base_de_datos();
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
			case 'addImageBanner':
				addImageBanner();
				break;
			case 'deleteBannerHome':
				deleteBannerHome($_POST['dataBanner']);
				break;
			case 'cargaMasivaProductos':
				cargaMasivaProductos();
				break;
			case 'cargaMasivaCaracteristicas':
				cargaMasivaCaracteristicas();
				break;
			case 'cargaMasivaImages':
				cargaMasivaImages();
				break;
		}
	}

	function changePassword(){
		$idAdmin = $_POST['idAdmin'];
		$password = $_POST['password'];
		$passwordhash = password_hash($password, PASSWORD_DEFAULT);

		$query = "UPDATE Usuarios SET Password = '$passwordhash' WHERE IdUsuario = $idAdmin";
		$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
	}

	function deleteAdmin(){
			$idAdmin = $_POST['id'];
			$query = "DELETE FROM Usuarios WHERE IdUsuario = $idAdmin";
			$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
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
		$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
	}

	function verifyPasswordLogin(){

		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "SELECT * FROM Usuarios WHERE NombreUser = '$username'";
		$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
		if(mysqli_num_rows($result) > 0){
			$find = false;
			while($line = mysqli_fetch_array($result)){
				if(password_verify($password, $line['Password'])){
					$find = true;
					date_default_timezone_set('America/Mexico_City');
					$lastDate = date("Y-m-d H:i:s");
					$query2 = "UPDATE Usuarios SET UltimaConexion = '$lastDate' WHERE IdUsuario = ".$line['IdUsuario'];
					$result2 = mysqli_query(Conectar::con(),$query2) or die(mysqli_error());
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
		$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
		echo '<option disabled selected value="">Selecciona..</option>';
		while ($line = mysqli_fetch_array($result)) {
			echo '<option value="'.$line["IdSubcategoria"].'" name="'.$line["IdSubcategoria"].'">'.$line["Subcategoria"].'</option>';
		}

	}

	function getEditProduct($id){

		$query = "SELECT * FROM Subcategoria WHERE Categorias_IdCategoria = $id ORDER BY Subcategoria ASC";
		$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
			echo '<option disabled selected value="">Selecciona..</option>';
		while ($line = mysqli_fetch_array($result)) {
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
								'".$formData["description"]."','".$route_name."','".$formData['stocks']."',
								'".$formData['pricelist']."','".$formData['pricefailbox']."',
								'".$formData['cost_shipping']."','".$formData['warranty']."',
								'".$formData['model']."','".$formData['sku']."',
								'".$formData['status']."','".$image."',
								'".$formData['url_paypal']."','".$formData['outstanding']."',
								'".$datatime."','".$formData['idPrivilegio']."',
								'".$formData['brand']."','".$formData['category']."',
								'".$formData['subcategory']."')";
		$res = mysqli_query(Conectar::con(),$sql_products) or die(mysqli_error());

		//Obtenemos el ultimo id añadido en la tabla Productos
		$rs = mysqli_query(Conectar::con(),"SELECT MAX(IdProducto) AS id FROM Productos");
		if ($row = mysqli_fetch_row($rs)) {
			$id = trim($row[0]);
			echo $id;
		}

		
	}

	function addNewCharacteristics() {

		parse_str($_POST['action'],$formData);
		
	    date_default_timezone_set('UTC');
	    date_default_timezone_set("America/Mexico_City");
	    $datatime = date("Y-m-d H:i:s");

	    $query = "SELECT * FROM Productos_has_Caracteristicas WHERE Productos_IdProducto = '".$formData['idProducto']."' AND Caracteristicas_IdCaracteristica = '".$formData['type_characteristic']."'";
		$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
		$row_type = mysqli_num_rows($result);

		//Si el resultado de $row_type es igual a "0" es porque no existe en la tabla, pero si es "1", ya se tiene ese tipo de caracteristica registrada
		//Entonces continuamos con la validacion
		if ($row_type == 0) {

			$sql = "INSERT INTO Productos_has_Caracteristicas VALUES ('".$formData['idProducto']."','".$formData['type_characteristic']."','".$formData['characteristic']."')";
			$res = mysqli_query(Conectar::con(),$sql) or die(mysqli_error());

			echo $formData['idProducto'];

		} else {

			echo $formData['idProducto'];

		}
		
	}

	function addNewSubcategory() {

		parse_str($_POST['action'],$formData);

		$query = "SELECT * FROM Subcategoria WHERE Categorias_IdCategoria = '".$formData['category']."' AND Subcategoria = '".$formData['other_subcategory']."'";
		$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error()); 
		$row = mysqli_num_rows($resultado);

		if ($row == 0) {

			$convert_name = explode(' ', $formData['other_subcategory']);
			$convert_name = strtolower(implode('-', $convert_name));
			$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
			$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
			$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

			$sql = "INSERT INTO Subcategoria (IdSubcategoria, Subcategoria, RouteSubcategoria, Categorias_IdCategoria) VALUES ('','".$formData['other_subcategory']."','".$route_name."','".$formData['category']."')";
			$res = mysqli_query(Conectar::con(),$sql) or die(mysqli_error());

			// $id = mysqli_insert_id();
			$rs = mysqli_query(Conectar::con(),"SELECT MAX(IdSubcategoria) AS id FROM Subcategoria");
			if ($row = mysqli_fetch_row($rs)) {
				$id = trim($row[0]);
			}
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
	                            SET NombreProd='" . $formData['name_product'] . "', RouteProd='" .$route_name. "', Descripcion='" . $formData["description"] . "', 
	                                Stock='" . $formData['stocks'] . "', PrecioLista='" . $formData['pricelist'] . "', 
	                                PrecioFailbox='" . $formData['pricefailbox'] . "', CostoEnvio='".$formData['cost_shipping']."',
	                                Garantia='" . $formData['warranty'] . "', Modelo='" . $formData['model'] . "',
	                                SKU='" . $formData['sku'] . "', Estatus='" . $formData['estatus'] . "',
	                                urlPaypal='" . $formData['url_paypal'] . "',Destacado='" . $formData['outstanding'] . "',
	                                FechaAlta='".$datatime."', IdPrivilegio='" . $formData['idPrivilegio'] . "', Marcas_IdMarca='".$formData['brand']."', Categorias_IdCategoria='".$formData['category']."', 
	                                Subcategoria_IdSubcategoria='".$formData['subcategory']."'
								WHERE IdProducto = '" . $formData['id'] . "'";
	    $res = mysqli_query(Conectar::con(),$sql_changes_prod) or die(mysqli_error());
	    
	    $id_product = $formData['id'];
	    echo $id_product;
	}

	function addImageBanner () {

		parse_str($_POST['action'], $formData);
		
		$fileNames = []; 
		$indice = 0;
		foreach ($_FILES['failboxBannerImage']["error"]  as $key => $value) {
			$fileName = $_FILES["failboxBannerImage"]["name"][$key];
			$fileName = date("YmdHis").pathinfo($_FILES["failboxBannerImage"]["type"][$key], PATHINFO_EXTENSION);
			array_push($fileNames, $fileName);
			$fileType = $_FILES["failboxBannerImage"]["type"][$key];
			$fileTemp = $_FILES["failboxBannerImage"]["tmp_name"][$key];
			if($indice==0)
				move_uploaded_file($fileTemp, "../images/bannersHome/".$fileName);
			$indice++;
		}
		$query = "INSERT INTO BannersHome VALUES(null,'".$fileName."','".$formData['bannerUrl']."','".$formData['bannerName']."')";
		$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());

	}

	function deleteBannerHome ($dataBanner) {
		
		$query = "DELETE FROM BannersHome WHERE idBannersHome = $dataBanner";
		$result = mysqli_query(Conectar::con(),$query) or die(mysqli_error());

	}

	function cargaMasivaProductos () {

		$fname = $_FILES['upload_products']['name'];

        $chk_ext = explode(".",$fname[0]);
        if(strtolower(end($chk_ext)) == "csv")
        {    
          //si es correcto, entonces damos permisos de lectura para subir
          $filename = $_FILES['upload_products']['tmp_name'];
          $handle = fopen($filename[0], "r"); 
          $array_products = array();
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
          {
            array_push($array_products, $data);
          }
          date_default_timezone_set('UTC');
		  date_default_timezone_set("America/Mexico_City");
		  $datatime = date("Y-m-d H:i:s");

		  $array_id = array();
          for($i=1; $i < count($array_products); $i++){

          	$convert_name = explode(' ', $array_products[$i][0]);
			$convert_name = strtolower(implode('-', $convert_name));
			$no_permitidas= array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
			$permitidas= array("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
			$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

			$query1 = "SELECT * FROM Categorias WHERE Categoria = '".$array_products[$i][14]."'";
			$resultado1 = mysqli_query(Conectar::con(),$query1) or die(mysqli_error());
			$num_row_cat = mysqli_num_rows($resultado1);
			if ($num_row_cat == 0) {

				$category = $array_products[$i][14];
				$lower_category = strtolower($category);
				$capital_category = ucwords($lower_category);

				$convert_name = explode(' ', $capital_category);
				$convert_name = strtolower(implode('-', $convert_name));
				$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
				$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
				$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

				$sql = "INSERT INTO Categorias VALUES('', '".$capital_category."', '".$route_name."')";
				$res = mysqli_query(Conectar::con(),$sql) or die(mysqli_error());

			} 

			$query6 = "SELECT * FROM Categorias WHERE Categoria = '".$array_products[$i][14]."'";
			$resultado6 = mysqli_query(Conectar::con(),$query6) or die(mysqli_error(Conectar::con()));
			$fila = mysqli_fetch_array($resultado6);

			$query2 = "SELECT * FROM Subcategoria WHERE Subcategoria = '".$array_products[$i][15]."' AND Categorias_IdCategoria = '".$fila[0]."'";
			$resultado2 = mysqli_query(Conectar::con(),$query2) or die(mysqli_error(Conectar::con()));
			$num_row_sub = mysqli_num_rows($resultado2);

			if ($num_row_sub == 0) {

				$subcategory = $array_products[$i][15];
				$lower_subcategory = strtolower($subcategory);
				$capital_subcategory = ucwords($lower_subcategory);

				$convert_name = explode(' ', $capital_subcategory);
				$convert_name = strtolower(implode('-', $convert_name));
				$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
				$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
				$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

				$sql2 = "INSERT INTO Subcategoria VALUES('','".$capital_subcategory."','".$route_name."','".$fila[0]."')";
				$res2 = mysqli_query(Conectar::con(),$sql2) or die(mysqli_error());

			} 

			$query3 = "SELECT * FROM Marcas WHERE Marca = '".$array_products[$i][13]."'";
			$resultado3 = mysqli_query(Conectar::con(),$query3) or die(mysqli_error(Conectar::con()));
			$num_row_brand = mysqli_num_rows($resultado3);
			if ($num_row_brand == 0) {

				$brand = $array_products[$i][13];
				$lower_brand = strtolower($brand);
				$capital_brand = ucwords($lower_brand);

				$convert_name = explode(' ', $capital_brand);
				$convert_name = strtolower(implode('-', $convert_name));
				$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
				$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
				$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

				$sql3 = "INSERT INTO Marcas VALUES('', '".$capital_brand."', '".$route_name."')";
				$res3 = mysqli_query(Conectar::con(),$sql3) or die(mysqli_error());

			}

			$sql4 = "SELECT * FROM Categorias WHERE Categoria = '".$array_products[$i][14]."'";
			$res4 = mysqli_query(Conectar::con(),$sql4) or die(mysqli_error());
			$row1 = mysqli_fetch_array($res4);

			$sql5 = "SELECT * FROM Subcategoria WHERE Subcategoria = '".$array_products[$i][15]."' AND Categorias_IdCategoria = '".$fila[0]."'";
			$res5 = mysqli_query(Conectar::con(),$sql5) or die(mysqli_error(Conectar::con()));
			$row2 = mysqli_fetch_array($res5);

			$sql6 = "SELECT * FROM Marcas WHERE Marca = '".$array_products[$i][13]."'";
			$res5 = mysqli_query(Conectar::con(),$sql6) or die(mysqli_error(Conectar::con()));
			$row3 = mysqli_fetch_array($res5);

			$array_images = explode('-', $array_products[$i][10]);
			$images = implode(',', $array_images);

            $query = "INSERT INTO Productos VALUES(null,'".$array_products[$i][0]."','".$array_products[$i][1]."','".$route_name."',
                    '".$array_products[$i][2]."','".$array_products[$i][3]."','".$array_products[$i][4]."','".$array_products[$i][5]."',
                    '".$array_products[$i][6]."','".$array_products[$i][7]."','".$array_products[$i][8]."','".$array_products[$i][9]."',
                    '".$images."','".$array_products[$i][11]."','".$array_products[$i][12]."','".$datatime."',
                    '1','".$row3['IdMarca']."','".$row1['IdCategoria']."','".$row2['IdSubcategoria']."')";
	        $resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error()); 

	        $rs = mysqli_query(Conectar::con(),"SELECT MAX(IdProducto) AS id FROM Productos");
			if ($row = mysqli_fetch_row($rs)) {
				$id = trim($row[0]);
				array_push($array_id, $id);

				$query4 = "SELECT IdProducto,Image FROM Productos WHERE IdProducto = '".$id."'";
	           	$resultado4 = mysqli_query(Conectar::con(),$query4) or die(mysqli_error());
				while ($row4 = mysqli_fetch_array($resultado4)) {
	           		$imagenes_prod = explode(',', $row4['Image']);
	           		for ($x=0; $x < count($imagenes_prod); $x++) { 
	           			$query5 = "INSERT INTO Productos_has_Imagenes VALUES('".$row4['IdProducto']."','','".$imagenes_prod[$x]."')";
	           			$resultado5 = mysqli_query(Conectar::con(),$query5) or die(mysqli_error());
	           		}
	           	}
			}
          }
          	// var_dump($array_id);
          echo count($array_id);
          //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
          fclose($handle);
        } else {
          echo 0;   
        }

	}

	function cargaMasivaCaracteristicas () {

		$fname = $_FILES['upload_char']['name'];
		
        // echo 'Cargando nombre del archivo: '.$fname[1].' <br>';
        $chk_ext = explode(".",$fname[1]);
        if(strtolower(end($chk_ext)) == "csv")
        {    
          //si es correcto, entonces damos permisos de lectura para subir
          $filename = $_FILES['upload_char']['tmp_name'];
          $handle = fopen($filename[1], "r");
          $array_products = array();
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
          {
            array_push($array_products, $data);
          }
          for($i=1; $i < count($array_products); $i++){

          	$query1 = "SELECT * FROM Caracteristicas WHERE NombreCaracteristica = '".$array_products[$i][1]."'";
          	$resultado1 = mysqli_query(Conectar::con(),$query1) or die(mysqli_error());
          	$row = mysqli_num_rows($resultado1);

          	if ($row == 0) {
          		$query2 = "INSERT INTO Caracteristicas VALUES ('','".$array_products[$i][1]."')";
          		$resultado2 = mysqli_query(Conectar::con(),$query2) or die(mysqli_error());
          		$query5 = "SELECT * FROM Caracteristicas WHERE NombreCaracteristica = '".$array_products[$i][1]."'";
          		$resultado5 = mysqli_query(Conectar::con(),$query5) or die(mysqli_error());
          		$row5 = mysqli_fetch_array($resultado5);
	            $query = "INSERT INTO Productos_has_Caracteristicas VALUES('".$array_products[$i][0]."','".$row5[0]."','".$array_products[$i][2]."')";
	            $resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error()); 
          	} else {
          		$row2 = mysqli_fetch_array($resultado1);
          		$query3 = "SELECT * FROM Productos_has_Caracteristicas WHERE Productos_IdProducto = '".$array_products[$i][0]."' AND Caracteristicas_IdCaracteristica = '".$row2[0]."' AND DetalleCaracteristica = '".$array_products[$i][2]."'";
          		$resultado3 = mysqli_query(Conectar::con(),$query3) or die(mysqli_error());
          		$row3 = mysqli_num_rows($resultado3);
          		if ($row3 == 0) {
          			$query4 = "INSERT INTO Productos_has_Caracteristicas VALUES('".$array_products[$i][0]."','".$row2[0]."','".$array_products[$i][2]."')";
	            	$resultado = mysqli_query(Conectar::con(),$query4) or die(mysqli_error()); 
          		}
          	}

          }
          echo "<span style='color:blue'>Importación exitosa!</span>";
           //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
          fclose($handle);
        } else {
          echo '<span style="color:red">Formato de archivo incorrecto</span>';     
        }

	}