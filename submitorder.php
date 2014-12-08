<?php
	if(!(isset($_REQUEST["OrderID"]) && !empty($_REQUEST["OrderID"]))) {
		exit(0);
	}
	
	include("inc/sql_queries.php");
	$order = get_order($_REQUEST["OrderID"]);
	$order["DateOrdered"] = date("Y-m-d");
	update_order($order);
	
	header("Location: viewcustomer.php?CustomerID=".$order['CustomerID']);
?>