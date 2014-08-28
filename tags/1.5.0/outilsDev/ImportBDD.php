<?php 
define("FICHIER_SQL","zeybuStructure.sql.zip");
define("CHEMIN_FICHIER_SQL","./");
$lDossierBdd = CHEMIN_FICHIER_SQL . "/bdd/";
include('../configuration/DB.php');
$lConnexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);

if(isset($_GET['action'])) {
	switch($_GET['action']) {
		case "41":
			// Sauvegarde de la base
			if(isset($_POST['bdd']) && isset($_POST['table'])) {
				$lNomBdd = $_POST["bdd"];
				$lNomFichier = $lDossierBdd . $_POST['table'];
				$lUpdateSql = file_get_contents($lNomFichier);
					
				
				mysql_select_db($lNomBdd, $lConnexion);
				// Ajout du préfixe
				$lRequetes = explode(";", $lUpdateSql);
				$lNbErreur = 0;
				$lNbRequetes = 0;
				mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
				foreach( $lRequetes as $lReq ) {
					$lReqTrim = trim($lReq);
					if(!empty($lReqTrim)) {
						$lNbRequetes++;
						if(!mysql_query($lReq, $lConnexion)) {
							$lNbErreur++;
						} 
					}
				}					
				unlink($lNomFichier);
				
				echo 1;
			} else {
				echo 0;
			}
			break;
			
		case 42:
			// Suppression du fichier
			unlink(CHEMIN_FICHIER_SQL . FICHIER_SQL);
			rmdir($lDossierBdd);
			echo 1;
			break;
	}
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - BBD Import</title>
	<script type="text/javascript" src="../js/zeybux-jquery.php"></script>
	<link href="../css/themes/le-frog/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div>
	<a href="./index.php">Retour</a><br/>
	<a href="./ImportBDD.php">Recommencer</a><br/><br/>
</div>
<?php
// Téléchargement du fichier sql
if( isset($_FILES["zeybusql"]) ) {
	if($_FILES["zeybusql"]["error"] == UPLOAD_ERR_OK) {
		$tmp_name = $_FILES["zeybusql"]["tmp_name"];
		$name = $_FILES["zeybusql"]["name"];
		move_uploaded_file($tmp_name, CHEMIN_FICHIER_SQL . FICHIER_SQL);
	}
}

if(file_exists(CHEMIN_FICHIER_SQL . FICHIER_SQL) && isset($_POST["bdd"]) && $_POST["bdd"] != "" ) {
	$lNomBdd = $_POST["bdd"];
	@mkdir($lDossierBdd);
	
	// Extraction de l'archive
	$zip = new ZipArchive;
	if ($zip->open(CHEMIN_FICHIER_SQL . FICHIER_SQL) === TRUE) {
		$zip->extractTo($lDossierBdd);
		$zip->close();
	
		// Integration de la structure
		$lNomFichier = $lDossierBdd . "0-structure.sql";
		$lUpdateSql = file_get_contents($lNomFichier);

		mysql_select_db($lNomBdd, $lConnexion);
		// Ajout du préfixe
		$lRequetes = explode(";", $lUpdateSql);
		$lNbErreur = 0;
		$lNbRequetes = 0;
		mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
		foreach( $lRequetes as $lReq ) {
			$lReqTrim = trim($lReq);
			if(!empty($lReqTrim)) {
				$lNbRequetes++;
				if(!mysql_query($lReq, $lConnexion)) {
					$lNbErreur++;
				}
			}
		}		
		unlink($lNomFichier);
			
		$lListeTable = array();
		$d = dir($lDossierBdd);
		while (false !== ($entry = $d->read())) {
			if(	$entry != '.' && $entry != '..' && $entry != "0-structure.sql") {
				array_push($lListeTable,$entry);
			}
		}
		$d->close();
		?>
		<script type="text/javascript">
		$(document).ready(function() {
			function etape42() {
				$.post(	"./ImportBDD.php?&action=42",
					function(lResponse) {
						if(lResponse == 1) {
							$("#etape-4").addClass("ui-icon-check").removeClass("ui-icon-closethick");
							$("#btn-ok").show();
						}
					}
				);
			};
		
			function etape41(pParam, pIndex) { // Insertion de la BDD
				$.post(	"./ImportBDD.php?&action=41", "bdd=" + pParam.bdd + "&table=" + pParam.tables[pIndex],
					function(lResponse) {
						if(lResponse == 1) {
							$("#tableEnCoursInsert").text(pIndex + 1);
							if( pParam.tables[pIndex + 1]) {
								etape41(pParam, pIndex + 1);
							} else {
								etape42();
							}
						}
					}
				);
			};
			var lResponse = eval(<?php echo json_encode(array("bdd"=>$lNomBdd,"tables"=>$lListeTable)); ?>);
			etape41(lResponse,0);
		});
		</script>
		<div>
			<div id="etape-3-detail" style="margin-left:30px;">
				<span id="etape-4" class="ui-icon ui-icon-closethick" style="float:left"></span> Installation de la BDD<br/>
				<span id="etape-4-detail"><span>Table : </span><span id="tableEnCoursInsert">0</span>/<span id="tableTotalInsert"><?php echo count($lListeTable); ?></span></span><br/>
				<div id="btn-ok" class="ui-helper-hidden">BDD installée</div>
			</div>
		</div>
		<?php 
	} else {
		echo "Erreur";
	}
} else {
	$lListeBDD = mysql_query("SHOW DATABASES", $lConnexion);
	?>
	<form method="post" action="./ImportBDD.php" enctype="multipart/form-data">
		<span>Le fichier Sql de la BDD : </span>
		<input type="file" name="zeybusql"/><br/>
		<span>La BDD de destination : </span>
		<select name="bdd">
		<?php 
			while($lTable = mysql_fetch_array($lListeBDD)) {
				echo "<option value=\"". $lTable[0] . "\">" . $lTable[0] . "</option>";
			}
		?>
		</select><br/>		
		<input type=submit value="Importer">
	</form>
	
	<?php
}
?>	
</body>
</html>
<?php 
}
	
mysql_close($lConnexion);
?>