<?php 
session_start();
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1 && isset($_GET['m']) && $_GET['m'] == "Versions") {
	if(isset($_GET['action']) && $_GET['action'] == "sav") {
		header('location:./index.php?m=Versions&action=actionSav');
	} else if(isset($_GET['action']) && $_GET['action'] == "actionRollBack" && isset($_GET["dir"]) ) {
		header('location:./index.php?m=Versions&action=actionRollBackConfirm&dir=' . $_GET["dir"]);
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Maintenance Zeybux</title>

	<link rel="icon" type="image/png" href="./images/zeybu-ico.png" />
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'/>
	<link href="./css/themes/le-frog/jquery-ui-1.8.custom.css" rel="stylesheet" type="text/css" media="all" />
	<link href="./css/Commun/Entete.css" rel="stylesheet" type="text/css" media="all" />
	<link href="./css/cssDev-min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="./css/Maintenance.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
	<div id="site" class="ui-corner-all">
	
		<h1><img src="./images/zeybu.png"/> Les Amis du  ZEYBU  <img src="./images/zeybu.png"/></h1>
<?php
	if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) { ?>
		<div id="menu_ext">
			<div id="menu_int">
				<ul id="menu_liste">
					<li>
						<a href="./index.php?m=Maj" class="com-cursor-pointer ui-widget-header menu-lien btn-menu ui-corner-tl <?php if(isset($_GET['m']) && $_GET['m'] == "Maj") echo "ui-state-active";?>"><span>Mise à jour</span></a>
					</li>
					<li>
						<a href="./index.php?m=Adherents" class="com-cursor-pointer ui-widget-header menu-lien btn-menu <?php if(isset($_GET['m']) && $_GET['m'] == "Adherents") echo "ui-state-active";?>"><span>Adherents</span></a>
					</li>
					<li>
						<a href="./index.php?m=Versions" class="com-cursor-pointer ui-widget-header menu-lien btn-menu ui-corner-br <?php if(isset($_GET['m']) && $_GET['m'] == "Versions") echo "ui-state-active";?>"><span>Versions</span></a>
					</li>
				</ul>
			</div>
			<span id="lien-deconnexion" class="ui-widget-header ui-corner-bl">
				<a href="./identification/deconnexion.php">
				<span class="com-float-left ui-icon ui-icon-power"></span>
				Déconnexion
				</a>
			</span>
		</div>
<?php } else {
		include("./identification/formConnexion.php");
	}
?>
		<div id="contenu">
<?php
	if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
		if(isset($_GET['m'])) {
			switch($_GET['m']) {
				case "Maj":
					include_once("./Maj/maj.php");	
					break;
					
				case "Adherents":
					include_once("./Adherents/index.php");	
					break;
					
				case "Versions":
					include_once("./Versions/index.php");	
					break;
					
				default:
					include_once("./accueil.php");	
					break;	
			}
		} else {
			include_once("./accueil.php");			
		}
	} 
?>
		</div>
		<div id="piedpage">
			Les amis du Zeybu - 25 allée du gerbier, EYBENS -  <a href="mailto:lesamisduzeybu@gmail.com">lesamisduzeybu@gmail.com</a> - 04 56 45 64 54
		</div>
	</div>
</body>
</html>
