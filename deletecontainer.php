<?php 
	if( !(isset($_REQUEST['redirect']) && isset($_REQUEST['containerid']) && isset($_REQUEST['orderid'])) || 
	   (empty($_REQUEST['redirect']) && empty($_REQUEST['containerid']) && empty($_REQUEST['orderid'])) ) {
	    //Error, don't print anything just redirect somewhere
		header("Location: .");
		exit(1);
	}
	include("inc/database.php");
	//deletecontainer($_REQUEST['containerid']); //FIXME
	header("Location: ".$_REQUEST['redirect']."?orderid=".$_REQUEST['orderid'].(isset($_REQUEST['admin']) ? "&admin" : ""));
?>