<?php
if(isset($_GET["file"])) {
	unlink(DOSSIER_SITE_LOGS . '/' . $_GET["file"]);
	header("location:./index.php?m=LogLevel");
}
?>