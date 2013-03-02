<?php
if(isset($_GET["type"])) {
	if($_GET["type"] == "info") {
		copy(DOSSIER_CONFIGURATION . "/LogLevel_Info.php" , DOSSIER_SITE_CONFIGURATION . "/LogLevel.php");
	} else {
		copy(DOSSIER_CONFIGURATION . "/LogLevel_Debug.php" , DOSSIER_SITE_CONFIGURATION . "/LogLevel.php");
	}
	header("location:./index.php?m=LogLevel");
}
?>