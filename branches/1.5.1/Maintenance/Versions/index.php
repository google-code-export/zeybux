<?php
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
require_once("./parametres.php");
if(isset($_GET["action"])) {
	switch($_GET["action"]) {			
		case "actionSav":
			 // Sauvegarde du zeybux
			// Création d'un nouveau répertoire de sauvegarde
			$lDossier = FILE_DUMP . "/" . date("YmdHis");
			mkdir( $lDossier );
			// Le dossier de sauvegarde de la BDD				
			$lDossierDump = $lDossier . "/dump/";
			mkdir( $lDossierDump );
		
			// Sauvegarde des fichiers
			function parcourirDossier($pPathIn,$pPathOut) {
				$d = dir($pPathIn);
				while (false !== ($entry = $d->read())) {
					if(	$entry != '.' && $entry != '..' && $entry != 'Maintenance') {
						if(is_dir($d->path.'/'.$entry)) {
							if(!is_dir($pPathOut .'/'. $entry)) {
								mkdir($pPathOut .'/'. $entry);
							}
							parcourirDossier($d->path.'/'.$entry,$pPathOut.'/'. $entry);
						} else {
							$filename = $d->path.'/'.$entry;
							copy($filename , $pPathOut .'/'. $entry);
						}
					}
				}
				$d->close();
			}
			parcourirDossier(DOSSIER_SITE,$lDossier);
		
			// Sauvegarde de la base
			// Etape 1 structure de la base
			$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
			mysql_select_db(MYSQL_DBNOM, $connexion);
				
			$entete = "-- ----------------------\n";
			$entete .= "-- Zeybux base " . MYSQL_DBNOM . " au ".date("d-M-Y")."\n";
			$entete .= "-- ----------------------\n\n\n";
			$creations = "";
			$lListeTable = array();
			$listeTables = mysql_query("show tables", $connexion);
			while($table = mysql_fetch_array($listeTables)) {
				// La structure
				$creations .= "-- -----------------------------\n";
				$creations .= "-- creation de la table ".$table[0]."\n";
				$creations .= "-- -----------------------------\n";
				$listeCreationsTables = mysql_query("show create table ".$table[0], $connexion);
				while($creationTable = mysql_fetch_array($listeCreationsTables)) {
					// Si c'est une table ajout à la liste pour sauvegarde des données
					if(preg_match('/CREATE TABLE/',$creationTable[1])) {
						array_push($lListeTable,$table[0]);
					}
					
					if(preg_match('/CREATE ALGORITHM=UNDEFINED/',$creationTable[1])) {
						$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
						$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
							$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`lesamisdpdev1`@`%` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
					}
					$creations .= $creationTable[1].";\n\n";
				}
			}
			mysql_close($connexion);
			
			$lNomFichier = $lDossierDump . "structure.sql";
			$fichierDump = fopen($lNomFichier, "w");
			fwrite($fichierDump, utf8_encode($entete));
			fwrite($fichierDump, utf8_encode($creations));
			fclose($fichierDump);
			
			// Creation du zip
			$lZip = new ZipArchive();
			
			// On teste si le dossier existe, car sans ça le script risque de provoquer des erreurs.
			if($lZip->open($lDossier . '/dump.sql.zip', ZipArchive::CREATE) == TRUE) {
				// Ajout du fichier
				if(!$lZip->addFile($lNomFichier, "0-structure.sql")) {
					echo -1;
				}
				// On ferme l’archive.
				$lZip->close();
			} else {
				// Erreur lors de l’ouverture.
				// On peut ajouter du code ici pour gérer les différentes erreurs.
				echo -2;
			}
			
			// Suppression du fichier
			unlink($lNomFichier);

			echo json_encode(array("dossier"=>$lDossier,"tables"=>$lListeTable));
			break;
		
		case 31:
				// Sauvegarde de la base
				if(isset($_POST['table']) && isset($_POST['dossier'])) {
					$lDossier = $_POST['dossier'];
					$lDossierDump = $lDossier . "/dump/";
					
					// Etape 2 Les données
					$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
					mysql_select_db(MYSQL_DBNOM, $connexion);
					$table = $_POST['table'];
					$insertions = "\n\n";
					$donnees = mysql_query("SELECT * FROM ".$table);
					$insertions .= "-- -----------------------------\n";
					$insertions .= "-- insertions dans la table ".$table."\n";
					$insertions .= "-- -----------------------------\n";
					while($nuplet = @mysql_fetch_array($donnees))
					{
						$insertions .= "INSERT INTO ".$table." VALUES(";
						for($i=0; $i < mysql_num_fields($donnees); $i++)
						{
							if($i != 0)
								$insertions .=  ", ";
							//if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
								$insertions .=  "'";
							$insertions .= addslashes($nuplet[$i]);
							//if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
								$insertions .=  "'";
						}
						$insertions .=  ");\n";
					}
					$insertions .= "\n";
					$lNomFichier = $lDossierDump . $table . ".sql";
					$fichierDump = fopen($lNomFichier , "w");
					fwrite($fichierDump, utf8_encode($insertions));
					fclose($fichierDump);
					
					// Ajout au zip
					$lZip = new ZipArchive();
						
					// On teste si le dossier existe, car sans ça le script risque de provoquer des erreurs.
					if($lZip->open($lDossier . '/dump.sql.zip', ZipArchive::CREATE) == TRUE) {
						// Ajout du fichier
						if(!$lZip->addFile($lNomFichier, $table . ".sql")) {
							echo -1;
						}
						// On ferme l’archive.
						$lZip->close();
						echo 1;
					} else {
						// Erreur lors de l’ouverture.
						// On peut ajouter du code ici pour gérer les différentes erreurs.
						echo -2;
					}
					
					// Suppression du fichier
					unlink($lNomFichier);
				} else {
					echo 0;
				}
				break;
			
		case "del":
			if(isset($_GET["dir"])) {
				function supprimerDossier($pPath) {					
					if(is_dir($pPath)) {
						$d = dir($pPath);
						while (false !== ($entry = $d->read())) {	   
						   if(	$entry != '.' && $entry != '..' ) {
					   		if(is_dir($d->path.'/'.$entry)) {
					   			supprimerDossier($d->path.'/'.$entry);
								//rmdir($d->path.'/'.$entry);
					   		} else {
					   			$filename = $d->path.'/'.$entry;
								unlink($filename);
					   		}
						   }
						}
						$d->close();
						rmdir($pPath);
					}
				}
				supprimerDossier(FILE_DUMP . "/". $_GET["dir"]);
			}
			break;
		
		case "rollBack":
			if(isset($_GET["dir"])) { 
			$lVersion = $_GET["dir"];
				?>
			<script type="text/javascript">
			$(document).ready(function() {	
				function etape42() { // Ouverture des accès 
					$.post(	"./index.php?m=Versions&action=42",
						function(lResponse) {
							if(lResponse == 1) {
								$("#etape-4").addClass("ui-icon-check").removeClass("ui-icon-closethick");
								$("#btn-ok").show();
							}
						}
					);
				};
				
				function etape41(pParam, pIndex) { // Insertion de la BDD
					$.post(	"./index.php?m=Versions&action=41", "dossier=" + pParam.dossier + "&table=" + pParam.tables[pIndex],
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
					
				function etape4() {
					$.post(	"./index.php?m=Versions&action=actionRollBackConfirm", "dir=" + <?php echo $_GET["dir"]; ?>,
						function(lResponse) {
							if(lResponse.retour == 1) {								
								lResponse.dossier = "<?php echo $_GET["dir"]; ?>";
								$("#tableTotalInsert").text(lResponse.tables.length);
								$("#etape-4-detail").show();
								etape41(lResponse,0);
							}
						}, "json"
					);
				};
				
				function etape31(pParam, pIndex) { // Sauvegarde du zeybux données des tables
					$.post(	"./index.php?m=Versions&action=31", "dossier=" + pParam.dossier + "&table=" + pParam.tables[pIndex],
						function(lResponse) {
							if(lResponse == 1) {
								$("#tableEnCours").text(pIndex + 1);								
								if( pParam.tables[pIndex + 1]) {
									etape31(pParam, pIndex + 1);
								} else {
									$("#etape-3").addClass("ui-icon-check").removeClass("ui-icon-closethick");
									etape4();
								}
							}
						}
					);
				};
				
				$("#btn-rollback").click(function() { // Sauvegarde du zeybux
					$.post(	"./index.php?m=Versions&action=actionSav",
						function(lResponse) {
							$("#tableTotal").text(lResponse.tables.length);
							$("#etape-3-detail, #confirm").toggle();
							etape31(lResponse,0);
						}, "json"
					);
				});
			});
			</script>
			<div class="com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all">
				<div id="confirm">
					<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Appliquer une version</div>
						Voulez-vous réellement appliquer la version : <?php echo $lVersion[6] . $lVersion[7] ."-". $lVersion[4] . $lVersion[5] . "-" . $lVersion[0] . $lVersion[1] . $lVersion[2] . $lVersion[3] . " " . $lVersion[8] . $lVersion[9] .":". $lVersion[10] . $lVersion[11] .":". $lVersion[12]. $lVersion[13];?>
					<br/><br/>
					<div class="com-center">
						<button id="btn-rollback" class="ui-state-default ui-corner-all com-button com-center">Confirmer</button>
					</div>
				</div>
				<div id="etape-3-detail" class="ui-helper-hidden" style="margin-left:30px;">
					<br/><span id="etape-3" class="com-float-left ui-icon ui-icon-closethick"></span> Sauvegarde du zeybux<br/>
					<span>Table : </span><span id="tableEnCours">0</span>/<span id="tableTotal"></span><br/>
					<span id="etape-4" class="com-float-left ui-icon ui-icon-closethick"></span> Installation de la version<br/>
					<span id="etape-4-detail" class="ui-helper-hidden"><span>Table : </span><span id="tableEnCoursInsert">0</span>/<span id="tableTotalInsert">0</span></span><br/>
					<div id="btn-ok" class="ui-helper-hidden">
						La version : <?php echo $lVersion[6] . $lVersion[7] ."-". $lVersion[4] . $lVersion[5] . "-" . $lVersion[0] . $lVersion[1] . $lVersion[2] . $lVersion[3] . " " . $lVersion[8] . $lVersion[9] .":". $lVersion[10] . $lVersion[11] .":". $lVersion[12]. $lVersion[13];?> est active. 
						<a href="./index.php?m=Versions" style="margin-top:15px;margin-bottom:15px;" class="com-btn-edt ui-state-default ui-corner-all com-button com-center">OK</a><br/><br/>
					</div>
				</div>
			</div>
		<?	}
			break;
			
		case "actionRollBackConfirm":
			if(isset($_POST["dir"])) {
				// Ferme les accès
				copy(DOSSIER_CONFIGURATION . "/Maintenance_ferme.php" , DOSSIER_SITE_CONFIGURATION . "/Maintenance.php");
			/*	?>
				
				
				<div class="com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all">
					<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Appliquer une version</div>
				
				
				<?php
				// Sauvegarde du site
			/*	$lDossier =  FILE_DUMP . "/" . date("YmdHis");
				mkdir($lDossier);
				include("./Versions/dumpFile.php");
				include("./Versions/dumpMySQL.php"); */
				
				// Déploiement de la version
				// Supression de l'ancien site excepté dossier maintenance, index.php, dossier configuration et Maintenance.php du dossier configuration
				// Pas de suppression des logs
				function supprimerDossier($pPath) {
					$d = dir($pPath);
					while (false !== ($entry = $d->read())) {
						if(	$entry != '.'
								&& $entry != '..'
								&& $d->path.'/'.$entry != '../index.html'
								&& $entry != "DB.php"
								&& $entry != "LogLevel.php"
								&& $entry != "Mail.php"
								&& $entry != 'Maintenance.php'
								&& $entry != "Proprietaire.php"
								&& $entry != 'SOAP.php'
								&& $entry != 'Titre.php'
								&& $entry != 'Maintenance'
								&& $entry != 'logs'
								&& $entry != ".htaccess" ) {
							if(is_dir($d->path.'/'.$entry)) {
								supprimerDossier($d->path.'/'.$entry);
								if($entry != 'configuration' && $entry != 'classes' && $entry != 'html' && $entry != 'vues') {
									rmdir($d->path.'/'.$entry);
								}
							} else {
								$filename = $d->path.'/'.$entry;
								unlink($filename);
							}
						}
					}
					$d->close();
				}
				/*function supprimerDossier($pPath) {
					$d = dir($pPath);
					while (false !== ($entry = $d->read())) {	   
					   if(	$entry != '.' && $entry != '..' && $entry != 'index.php' && $entry != 'Maintenance.php' && $entry != 'Maintenance' && $entry != 'logs' && $entry != "DB.php") {
				   		if(is_dir($d->path.'/'.$entry)) {
				   			supprimerDossier($d->path.'/'.$entry);
							if($entry != 'configuration') {
								rmdir($d->path.'/'.$entry);
							}
				   		} else {
				   			$filename = $d->path.'/'.$entry;
							unlink($filename);
				   		}
					   }
					}
					$d->close();
				}*/
				supprimerDossier(DOSSIER_SITE);				
				
				/*function parcourirDossierExtract($pPathIn,$pPathOut) {
					$d = dir($pPathIn);
					while (false !== ($entry = $d->read())) {	   
					   if(	$entry != '.' && $entry != '..' && $entry != 'index.php' && $entry != 'Maintenance.php' && $entry != 'Maintenance' && $entry != 'update.sql' && $entry != "DB.php") {
				   		if(is_dir($d->path.'/'.$entry)) {
							if(!is_dir($pPathOut .'/'. $entry)) {
								mkdir($pPathOut .'/'. $entry);
							}
				   			parcourirDossierExtract($d->path.'/'.$entry,$pPathOut.'/'. $entry);
				   		} else {
				   			$filename = $d->path.'/'.$entry;
							copy($filename , $pPathOut .'/'. $entry);
				   		}
					   }
					}
					$d->close();
				}*/
				function parcourirDossierExtract($pPathIn,$pPathOut) {
					$d = dir($pPathIn);
					while (false !== ($entry = $d->read())) {
						if(	$entry != '.'
								&& $entry != '..'
								&& $d->path.'/'.$entry != '../index.html'
								&& $entry != "DB.php"
								&& $entry != "LogLevel.php"
								&& $entry != "Mail.php"
								&& $entry != 'Maintenance.php'
								&& $entry != "Proprietaire.php"
								&& $entry != 'SOAP.php'
								&& $entry != 'Titre.php'
								&& $entry != 'Maintenance'
								&& $entry != 'update.sql'
								&& $entry != "bdd"
								&& $entry != ".htaccess"
								&& $entry != "dump"
								&& $entry != "dump.sql.zip") {
							if(is_dir($d->path.'/'.$entry)) {
								if(!is_dir($pPathOut .'/'. $entry)) {
									mkdir($pPathOut .'/'. $entry);
								}
								$lTempIn = $d->path.'/'.$entry;
								$lTempOut = $pPathOut.'/'. $entry;
								parcourirDossierExtract($lTempIn, $lTempOut);
							} else {
								$filename = $d->path.'/'.$entry;
								copy($filename , $pPathOut .'/'. $entry);
							}
						}
					}
					$d->close();
				}
				parcourirDossierExtract(FILE_DUMP . "/" . $_POST["dir"],DOSSIER_SITE);
				
				// Suppression de la base
				$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
				mysql_select_db(MYSQL_DBNOM, $connexion);
				$listeTables = mysql_query("show tables", $connexion);
			    while($table = mysql_fetch_array($listeTables)) {			    			    	
				    mysql_query("DROP TABLE " . $table[0], $connexion);
				    mysql_query("DROP VIEW " . $table[0], $connexion);
			    }
				mysql_close($connexion);

   				// Mise en place de la base de la version => Trop long : à réaliser par PhpMyAdmin
			/*	$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
				mysql_select_db(MYSQL_DBNOM, $connexion);
				$lRequete = file_get_contents(FILE_DUMP . "/" . $_POST["dir"] . "/dump.sql");
				// Ajout du préfixe
				$lRequete=str_replace('{PREFIXE}', MYSQL_DB_PREFIXE, $lRequete);
				$lRequetes = explode(";\n", $lRequete);	
				$lNbErreur = 0;
				$lNbRequetes = 0;
				mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
				$f = fopen(LOG_EXTRACT . date('Y-m-d_H:i:s') . "_updateSql.log", "w");
				foreach( $lRequetes as $lReq ) {
					if(!empty($lReq)) {
						$lNbRequetes++;
						if(!mysql_query($lReq, $connexion)) {
							$lNbErreur++;
							fwrite($f, mysql_errno($connexion) . ": " . mysql_error($connexion) . "\n" . $lReq . "\n\n");
						} else {
							fwrite($f," OK : " . $lReq . "\n\n");
						}
					}
				}
				fclose($f);
				mysql_close($connexion); */

				// Ouvre les accès
	//			copy(DOSSIER_CONFIGURATION . "/Maintenance_ouvert.php" , DOSSIER_SITE_CONFIGURATION . "/Maintenance.php");
				
			/*	$lVersion = $_GET["dir"];
				?>
						<br/><br/>La version : <?php echo $lVersion[6] . $lVersion[7] ."-". $lVersion[4] . $lVersion[5] . "-" . $lVersion[0] . $lVersion[1] . $lVersion[2] . $lVersion[3] . " " . $lVersion[8] . $lVersion[9] .":". $lVersion[10] . $lVersion[11] .":". $lVersion[12]. $lVersion[13];?> est active. 
				</div>
				<?php */
				
				$lListeTable = array();
				
				$lDossier = FILE_DUMP . "/" . $_POST["dir"];
				$lDossierDump = $lDossier . '/dump/';
				$zip = new ZipArchive;
				if ($zip->open($lDossier . "/dump.sql.zip") === TRUE) {
					$zip->extractTo($lDossierDump);
					$zip->close();

					$lNomFichier = $lDossierDump . "0-structure.sql";
					$lUpdateSql = file_get_contents($lNomFichier);
					
					$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
					mysql_select_db(MYSQL_DBNOM, $connexion);
					// Ajout du préfixe
					$lRequetes = explode(";", $lUpdateSql);
					$lNbErreur = 0;
					$lNbRequetes = 0;
					mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
					$lNomFichierLog = LOG_EXTRACT . date('Y-m-d_H:i:s') . "_updateSql.log";
					$f = fopen($lNomFichierLog, "w");
					foreach( $lRequetes as $lReq ) {
						$lReqTrim = trim($lReq);
						if(!empty($lReqTrim)) {
							$lNbRequetes++;
							if(!mysql_query($lReq, $connexion)) {
								$lNbErreur++;
								fwrite($f, mysql_errno($connexion) . ": " . mysql_error($connexion) . "\n" . $lReq . "\n\n");
							} else {
								fwrite($f," OK : " . $lReq . "\n\n");
							}
						}
					}
					fclose($f);
					mysql_close($connexion);
					
					unlink($lNomFichier);
					
					$d = dir($lDossierDump);
					while (false !== ($entry = $d->read())) {
						if(	$entry != '.' && $entry != '..' && $entry != "0-structure.sql") {
							array_push($lListeTable,$entry);
						}
					}
					$d->close();
					$lRetour = 1;
					
				} else {
					$lRetour = 0;
				}
				
				echo json_encode(array("retour"=>$lRetour,"tables"=>$lListeTable));
			}
			break;
			
		case "41":
			// Sauvegarde de la base
			if(isset($_POST['table']) && isset($_POST['dossier'])) {
				$lDossier = FILE_DUMP . "/" . $_POST["dossier"];
				$lDossierDump = $lDossier . "/dump/";
				$lNomFichier = $lDossierDump . $_POST['table'];
				$lUpdateSql = file_get_contents($lNomFichier);
					
				$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
				mysql_select_db(MYSQL_DBNOM, $connexion);
				// Ajout du préfixe
				$lRequetes = explode(";", $lUpdateSql);
				$lNbErreur = 0;
				$lNbRequetes = 0;
				mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
				$lNomFichierLog = LOG_EXTRACT . date('Y-m-d_H:i:s') . "_updateSql.log";
				$f = fopen($lNomFichierLog, "w");
				foreach( $lRequetes as $lReq ) {
					$lReqTrim = trim($lReq);
					if(!empty($lReqTrim)) {
						$lNbRequetes++;
						if(!mysql_query($lReq, $connexion)) {
							$lNbErreur++;
							fwrite($f, mysql_errno($connexion) . ": " . mysql_error($connexion) . "\n" . $lReq . "\n\n");
						} else {
							fwrite($f," OK : " . $lReq . "\n\n");
						}
					}
				}
				fclose($f);
				mysql_close($connexion);
					
				unlink($lNomFichier);
				
				echo 1;
			} else {
				echo 0;
			}
			break;
			
		case 42:
			// Ouvre les accès
			copy(DOSSIER_CONFIGURATION . "/Maintenance_ouvert.php" , DOSSIER_SITE_CONFIGURATION . "/Maintenance.php");
			echo 1;
			break;
	}
} 
	$lVersions = array();
	$d = dir(FILE_DUMP);
	while (false !== ($entry = $d->read())) {	   
		if(	$entry != '.' && $entry != '..' && $entry != '.svn') {
			if(is_dir($d->path.'/'.$entry)) {
				array_push($lVersions,$entry);
   			}
	   }
	}
	$d->close();
	rsort($lVersions);
	if(!isset($_GET["action"]) || 
	(isset($_GET["action"]) && $_GET["action"] != "31"  && $_GET["action"] != "41"  && $_GET["action"] != "42" && $_GET["action"] != "actionSav" && $_GET['action'] != "rollBack" && $_GET['action'] != "actionRollBackConfirm") ) {
?>

<script type="text/javascript">
$(document).ready(function() {		
	function etape31(pParam, pIndex) { // Sauvegarde du zeybux données des tables
		$.post(	"./index.php?m=Versions&action=31", "dossier=" + pParam.dossier + "&table=" + pParam.tables[pIndex],
			function(lResponse) {
				if(lResponse == 1) {
					$("#tableEnCours").text(pIndex + 1);
					
					if( pParam.tables[pIndex + 1]) {
						etape31(pParam, pIndex + 1);
					} else {
						$("#etape-3").addClass("ui-icon-check").removeClass("ui-icon-closethick");
						$("#btn-ok").show();
					}
				}
			}
		);
	};
	
	$("#btn-sav").click(function() { // Sauvegarde du zeybux
		$.post(	"./index.php?m=Versions&action=actionSav",
			function(lResponse) {
				$("#tableTotal").text(lResponse.tables.length);
				$("#etape-3-detail").show();
				etape31(lResponse,0);
			}, "json"
		);
	});
});
</script>
<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
	<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Versions du Zeybux</div>
 	<div class="com-center">
		<button id="btn-sav" class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Ajouter une sauvegarde</button>
	</div> 
	<div id="etape-3-detail" class="ui-helper-hidden" style="margin-left:30px;">
		<br/><span id="etape-3" class="com-float-left ui-icon ui-icon-closethick"></span> Sauvegarde du zeybux<br/>
		<span>Table : </span><span id="tableEnCours">0</span>/<span id="tableTotal"></span><br/><br/>
		<a id="btn-ok" href="./index.php?m=Versions" style="margin-top:15px;margin-bottom:15px;" class="ui-helper-hidden com-btn-edt ui-state-default ui-corner-all com-button com-center">OK</a>
	</div>
	<br/><br/>
	
	<table class="com-table">
		<tr class="ui-widget ui-widget-header" >
			<th class="com-table-th-debut" >Date de Sauvegarde</th>
			<th class="com-table-th-med td-edt"></th>
			<th class="com-table-th-med td-edt"></th>
			<th class="com-table-th-fin td-edt"></th>
		</tr>
		<?php foreach($lVersions as $lVersion) {?>
		<tr>
			<td class="com-table-td-debut"><?php echo $lVersion[6] . $lVersion[7] ."-". $lVersion[4] . $lVersion[5] . "-" . $lVersion[0] . $lVersion[1] . $lVersion[2] . $lVersion[3] . " " . $lVersion[8] . $lVersion[9] .":". $lVersion[10] . $lVersion[11] .":". $lVersion[12]. $lVersion[13];?></td>
			<td class="com-table-td-med">
				<a href="./ancien/<?php echo $lVersion;?>/dump.sql.zip" target="_blank" class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Télécharger la base">
					<span class="ui-icon ui-icon-arrowthick-1-n"></span>
				</a>
			</td>
			<td class="com-table-td-med">
				<a href="./index.php?m=Versions&amp;action=rollBack&amp;dir=<?php echo $lVersion;?>" class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Appliquer (fichier pas la bdd)">
					<span class="ui-icon ui-icon-check"></span>
				</a>
			</td>
			<td class="com-table-td-fin">
				<a href="./index.php?m=Versions&amp;action=del&amp;dir=<?php echo $lVersion;?>" class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Supprimer">
					<span class="ui-icon ui-icon-trash"></span>
				</a>
			</td>
		</tr>
		<?php }?>
		
	</table>
</div>


<?php
	}
}
?>