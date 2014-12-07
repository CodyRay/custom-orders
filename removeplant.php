<?php 
	
	include("inc/sql_queries.php");
	remove_plant($_REQUEST['ContainerID'], $_REQUEST["PlantID"]); //FIXME
	header("Location: editcontainer.php?ContainerID=".$_REQUEST['ContainerID'].(isset($_REQUEST['admin']) ? "&admin" : ""));
?>