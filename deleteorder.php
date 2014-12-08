<?php 
	
	include("inc/sql_queries.php");
	$data = get_order($_REQUEST["OrderID"]);
	remove_order($_REQUEST['OrderID']); //FIXME
	header("Location: viewcustomer.php?CustomerID=".$data['CustomerID']);
?>