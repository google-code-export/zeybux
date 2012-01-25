<?php 
if(isset($_GET['action'])) {
	switch($_GET['action']) {
		case "import":
			include('./Adherents/ImportCompte.php');
			break;
			
		default:
			include('./Adherents/accueil.php');
			break;
	}
} else {
	include('./Adherents/accueil.php');
}
?>