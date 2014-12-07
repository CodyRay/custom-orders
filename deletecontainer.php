<?php 
	
	if( !(isset($_REQUEST['redirect']) && isset($_REQUEST['ContainerID']) && isset($_REQUEST['OrderID'])) || 
	   (empty($_REQUEST['redirect']) && empty($_REQUEST['ContainerID']) && empty($_REQUEST['OrderID'])) ) {
	    //Error, don't print anything just redirect somewhere
		header("Location: .");
		exit(1);
	}
	
	include("inc/sql_queries.php");
	remove_container($_REQUEST['ContainerID']); //FIXME
	header("Location: ".$_REQUEST['redirect']."?OrderID=".$_REQUEST['OrderID'].(isset($_REQUEST['admin']) ? "&admin" : ""));
?>