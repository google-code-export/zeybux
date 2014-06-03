<?php 
session_start();
$lAffiche = true;
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1 && isset($_GET['m']) ) {
	if($_GET['m'] == "Versions") {	
		if(isset($_GET['action']) && ($_GET['action'] == "actionSav" || $_GET['action'] == "31" || $_GET['action'] == "actionRollBackConfirm")) {
			include_once("./Versions/index.php");
			$lAffiche = false;
		}
		
		
	/*	if(isset($_GET['action']) && $_GET['action'] == "sav") {
			header('location:./index.php?m=Versions&action=actionSav');
		} else if(isset($_GET['action']) && $_GET['action'] == "actionRollBack" && isset($_GET["dir"]) ) {
			header('location:./index.php?m=Versions&action=actionRollBackConfirm&dir=' . $_GET["dir"]);
		}*/
	}
	
	if($_GET['m'] == "LogLevel") {	
		if(isset($_GET['action']) && $_GET['action'] == "getLog") {
			include_once("./LogLevel/GetLog.php");	
			$lAffiche = false;
		}
	}
	
	if($_GET['m'] == "Extract") {
		if(isset($_GET['e'])) {
			include_once("./Extract/index.php");
			$lAffiche = false;
		}
	}
	
	if($_GET['m'] == "Maj") {
		if(isset($_GET['e'])) {
			include_once("./Maj/maj.php");	
			$lAffiche = false;
		}
	}
}
if($lAffiche) {
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
	<script src="./jquery/jquery-1.11.0.min.js" type="text/javascript"></script>
</head>
<body>
	<div id="site" class="ui-corner-all">
	
		<h1><img src="./images/zeybu.png"/> Zeybux  <img src="./images/zeybu.png"/></h1>
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
						<a href="./index.php?m=Versions" class="com-cursor-pointer ui-widget-header menu-lien btn-menu <?php if(isset($_GET['m']) && $_GET['m'] == "Versions") echo "ui-state-active";?>"><span>Versions</span></a>
					</li>
					<li>
						<a href="./index.php?m=LogLevel" class="com-cursor-pointer ui-widget-header menu-lien btn-menu <?php if(isset($_GET['m']) && $_GET['m'] == "LogLevel") echo "ui-state-active";?>"><span>Logs</span></a>
					</li>
					<li>
						<a href="./index.php?m=Extract" class="com-cursor-pointer ui-widget-header menu-lien btn-menu <?php if(isset($_GET['m']) && $_GET['m'] == "Extract") echo "ui-state-active";?>"><span>Extract</span></a>
					</li>
					<li>
						<a href="./index.php?m=Mdp" class="com-cursor-pointer ui-widget-header menu-lien btn-menu ui-corner-br <?php if(isset($_GET['m']) && $_GET['m'] == "Mdp") echo "ui-state-active";?>"><span>Identifiants</span></a>
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
					
				case "LogLevel":
					include_once("./LogLevel/index.php");
					break;
					
				case "Extract":
					include_once("./Extract/index.php");
					break;
					
				case "Mdp":
					include_once("./Identifiant.php");
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
		</div>
	</div>
</body>
</html>
<?php } ?>
