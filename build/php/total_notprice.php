<?php 
session_start();
// include('delete_session_cart.php'); 
if (isset($_SESSION['carrito'])) {
	$total_not_price = 0;
	for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
		$total_not_price = $total_not_price + $_SESSION['carrito'][$i]["precio_lista"];
	}
	print_r(json_encode($total_not_price));
}
?>