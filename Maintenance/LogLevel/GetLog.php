<?php
if(isset($_GET["file"])) {
	require_once("./parametres.php");
	header("Content-disposition: attachment; filename=".$_GET["file"]);
	header("Content-type: application/octet-stream"); 
	echo file_get_contents(DOSSIER_SITE_LOGS . '/' . $_GET["file"]);
}
?>