<?php 
session_start();
// include('delete_session_cart.php'); 
if (isset($_SESSION['total_carrito'])) {
	$total_price = 0;
	$costo_envio = 0;
	for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
		$total_price = $total_price + $_SESSION['carrito'][$i]["sub_total"];
		$costo_envio = $costo_envio + $_SESSION['carrito'][$i]['costo_envio'];
		$total = $total_price + $costo_envio;
	}
	print_r(json_encode($total));
	// print_r(json_encode($_SESSION['total_carrito']));
}
?>