<?php
	session_start();
	
	$product_no = $_GET['no'];
	
	unset($_SESSION['order'][$product_no]);
	
	header("Location:cart_item.php");