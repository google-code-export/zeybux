<?php 
require_once("./parametres.php");
if(isset($_GET['action'])) {
	switch($_GET['action']) {
		case "chgLevel":
			include('./LogLevel/ChgLevel.php');
			break;
			
		case "del":
			include('./LogLevel/del.php');
			break;
			
		default:
			include('./LogLevel/accueil.php');
			break;
	}
} else {
	include('./LogLevel/accueil.php');
}
?>