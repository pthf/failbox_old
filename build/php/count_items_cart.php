<?php 
session_start();
if (isset($_SESSION['carrito'])) {

	$total_items_cart = count($_SESSION['carrito']);
	print_r(json_encode($total_items_cart));
}
?>