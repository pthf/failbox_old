<?php 
// ini_set("session.cookie_lifetime","60");
// $inactivo = 900;
session_start();
if (isset($_SESSION['carrito'])) {
	print_r(json_encode($_SESSION['carrito']));
	// $vida_session = time() - $_SESSION['carrito'];
	// if($vida_session > $inactivo){
	// 	session_destroy();
	// 	header("Location: index.php"); 
	// }
}
// $_SESSION['carrito'] = time();

// ?>