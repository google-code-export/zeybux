<?php 
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
	require_once("./parametres.php");	
	$lResponse = file_get_contents("http://" . ADRESSE_DEPOT_ZEYBUX . "/index.php");
	$lNouvelleVersion = json_decode($lResponse,true);
	
	function viderDossier($pPath, $pFull = 0) {
		if(is_dir($pPath)) {
			$d = dir($pPath);
			while (false !== ($entry = $d->read())) {
				if(		$entry != '.'
						&& $entry != '..'
						&& (($pFull == 0 && $entry != '.htaccess') || $pFull == 1)
						&& $entry != '.svn'
						&& $entry != '.project'
				) {
					if(is_dir($d->path.'/'.$entry)) {
						viderDossier($d->path.'/'.$entry, $pFull);
					} else {
						unlink( $d->path.'/'.$entry );
					}
				}
			}
			$d->close();
		}
	}
	
	if(isset($_POST['canal']) && !empty($_POST['canal'])) {
		if(isset($_POST["canal"])) { // Mise à jour du canal
			$cMaintenanceConfig->canal = $_POST["canal"];
			$newJsonString = json_encode($cMaintenanceConfig);
			file_put_contents('./conf/maintenance.json', $newJsonString);
		}
	}
	
	if(isset($_GET['e']) && !empty($_GET['e'])) {
		switch($_GET['e']) {
			case 1 : // Téléchargement du nouveau phar
				if(isset($_POST["phar"])) {
					viderDossier("./" . DOSSIER_UPLOAD );
					if(copy("http://" . ADRESSE_DEPOT_ZEYBUX . "/" . $cMaintenanceConfig->canal . "/" . $_POST["phar"], "./" . DOSSIER_UPLOAD . "/" . $_POST["phar"])) {
						echo 1;
					} else {
						echo 0;
					}
				} else {
					echo 0;
				}
				break;
								
			case 2 : // Fermeture de l'accès
				if(copy(DOSSIER_CONFIGURATION . "/Maintenance_ferme.php" , DOSSIER_SITE_CONFIGURATION . "/Maintenance.php")) {
					echo 1;
				} else {
					echo 0;
				}
				break;
				
			case 3 : // Sauvegarde du zeybux
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
					while($creationTable = mysql_fetch_array($listeCreationsTables))
					{
						// Si c'est une table ajout à la liste pour sauvegarde des données	
						if(preg_match('/CREATE TABLE/',$creationTable[1])) {
							array_push($lListeTable,$table[0]);
						}
						
						if(preg_match('/CREATE ALGORITHM=UNDEFINED/',$creationTable[1])) {
							$creationTable[1] = preg_replace('/CREATE ALGORITHM=UNDEFINED DEFINER=`(.*)`@`(.*)` SQL SECURITY DEFINER VIEW/', "CREATE VIEW", $creationTable[1]);
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
								
			case 4 : // Déploiement du zeybux
				// vider le dossier d'extraction
				viderDossier(DOSSIER_EXTRACT,1);
				
				// Création du phar
				$p = new Phar("./" . DOSSIER_UPLOAD . "/" . $_POST["phar"]);
				// Extraction de l'archive
				$p->extractTo(DOSSIER_EXTRACT);
				
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
				supprimerDossier(DOSSIER_SITE);
				
				function parcourirDossier($pPathIn,$pPathOut) {
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
							&& $entry != "script"
					   && $entry != ".htaccess") {
							if(is_dir($d->path.'/'.$entry)) {
								if(!is_dir($pPathOut .'/'. $entry)) {
									mkdir($pPathOut .'/'. $entry);
								}
								$lTempIn = $d->path.'/'.$entry;
								$lTempOut = $pPathOut.'/'. $entry;
								parcourirDossier($lTempIn, $lTempOut);
							} else {
								$filename = $d->path.'/'.$entry;
								copy($filename , $pPathOut .'/'. $entry);
							}
						}
					}
					$d->close();
				}
				parcourirDossier(DOSSIER_EXTRACT,DOSSIER_SITE);
				
				// Fonction qui permet de décomposer le numéro de version et de mettre 0 si il n'y a rien
				function decomposerVersion($pVersion) {
					$lVersion = explode("\.",$pVersion);
					$lVersionRetour = array(0,0,0);
					if(isset($lVersion[0])) {
						$lVersionRetour[0] = $lVersion[0];
					}
					if(isset($lVersion[1])) {
						$lVersionRetour[1] = $lVersion[1];
					}
					if(isset($lVersion[2])) {
						$lVersionRetour[2] = $lVersion[2];
					}
					return $lVersionRetour;
				}
								
				$lTabVersion = array();
				$lVersionZeybux = decomposerVersion(ZEYBUX_VERSION); // Décomposition de la version actuelle
				
				$lListeNomFichier = array();
				$d = dir(DOSSIER_EXTRACT . "/script/");
				// Scan du dossier des scripts
				while (false !== ($entry = $d->read())) {
					if(		$entry != '.'
							&& $entry != '..'
							&& $entry != '.svn'
							&& $entry != '.project'
							&& $entry != '.htaccess'
							&& is_file($d->path . '/' . $entry)
					) {
				
						// enleve l'extention, tout ce qui se trouve apres le '.'
						$lNomFichier = substr($entry, 0, strrpos($entry,"."));
						$lVersion = decomposerVersion($lNomFichier);
				
						// Si la version de la modification est supérieure à celle du site on l'ajoute
						if($lVersion[0] > $lVersionZeybux[0]
								|| ($lVersion[0] = $lVersionZeybux[0] && $lVersion[1] > $lVersionZeybux[1])
								|| ($lVersion[0] = $lVersionZeybux[0] && $lVersion[1] = $lVersionZeybux[1] & $lVersion[2] > $lVersionZeybux[2])
						) {
							if(!isset($lTabVersion[$lVersion[0]])) {
								$lTabVersion[$lVersion[0]] = array();
							}
							if(!isset($lTabVersion[$lVersion[0]][$lVersion[1]])) {
								$lTabVersion[$lVersion[0]][$lVersion[1]] = array();
							}
							$lTabVersion[$lVersion[0]][$lVersion[1]][$lVersion[2]] = $entry;
						}
					}
				}
				// Lancement des scripts dans l'ordre des versions
				foreach($lTabVersion as $lMaj) {
					foreach($lMaj as $lMin) {
						foreach($lMin as $lLigne) {
							require_once($d->path.'/'.$lLigne);
						}
					}
				}
				$d->close();

				$lUpdateSql = "";
				// Recherche l'ensemble des évolution de la base à partir de la version du site
				$lTabVersion = array();					
				$lListeNomFichier = array();
				$d = dir(DOSSIER_UPDATE_BDD);
				while (false !== ($entry = $d->read())) {
					if(		$entry != '.'
							&& $entry != '..'
							&& $entry != '.svn'
							&& $entry != '.project'
							&& $entry != '.htaccess'
							&& is_file($d->path . '/' . $entry)
					) {
		
						// enleve l'extention, tout ce qui se trouve apres le '.'
						$lNomFichier = substr($entry, 0, strrpos($entry,"."));
						$lVersion = decomposerVersion($lNomFichier);
						
						// Si la version de la modification est supérieure à celle du site on l'ajoute
						if($lVersion[0] > $lVersionZeybux[0] 
							|| ($lVersion[0] = $lVersionZeybux[0] && $lVersion[1] > $lVersionZeybux[1])
							|| ($lVersion[0] = $lVersionZeybux[0] && $lVersion[1] = $lVersionZeybux[1] & $lVersion[2] > $lVersionZeybux[2])
						) {
							if(!isset($lTabVersion[$lVersion[0]])) {
								$lTabVersion[$lVersion[0]] = array();
							}
							if(!isset($lTabVersion[$lVersion[0]][$lVersion[1]])) {
								$lTabVersion[$lVersion[0]][$lVersion[1]] = array();
							}
							$lTabVersion[$lVersion[0]][$lVersion[1]][$lVersion[2]] = $entry;
						}
					}
				}
				foreach($lTabVersion as $lMaj) {
					foreach($lMaj as $lMin) {
						foreach($lMin as $lLigne) {
							$lUpdateSql .= ' ' . file_get_contents($d->path.'/'.$lLigne);
						}
					}
				}
				$d->close();
					
				
				$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
				mysql_select_db(MYSQL_DBNOM, $connexion);
				// Ajout du préfixe
				$lUpdateSql=str_replace('{PREFIXE}', MYSQL_DB_PREFIXE, $lUpdateSql);
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
								
				// vider le dossier d'extraction
				viderDossier(DOSSIER_EXTRACT,1);
				
				echo json_encode(array("NbRequetes" => $lNbRequetes, "NbErreur" => $lNbErreur, "log" => $lNomFichierLog));
				break;
				
			case 5 : // Ouverture de l'accès
				viderDossier("./" . DOSSIER_UPLOAD );
				if(copy(DOSSIER_CONFIGURATION . "/Maintenance_ouvert.php" , DOSSIER_SITE_CONFIGURATION . "/Maintenance.php")) {
					echo 1;
				} else {
					echo 0;
				}
				shell_exec('cd ../ && chmod -R 705 .');
				break;
		}
	} else {
?>
	<script type="text/javascript">
	$(document).ready(function() {		
		function etape5() { // Ouverture de l'accès
			$.post(	"./index.php?m=Maj&e=5", "phar=" + "<?php echo $lNouvelleVersion[$cMaintenanceConfig->canal]["phar"]; ?>",
				function(lResponse) {
					if(lResponse == 1) {
						$("#etape-5").addClass("ui-icon-check").removeClass("ui-icon-closethick");
					}
				}
			);
		};
		
		function etape4() { // Déploiement du zeybux
			$.post(	"./index.php?m=Maj&e=4", "phar=" + "<?php echo $lNouvelleVersion[$cMaintenanceConfig->canal]["phar"]; ?>",
				function(lResponse) {
					$("#etape-4").addClass("ui-icon-check").removeClass("ui-icon-closethick");
					$("#NbRequetes").text(lResponse.NbRequetes);
					$("#NbErreurs").text(lResponse.NbErreur);
					$("#logs").attr("href",lResponse.log);
					$("#etape-4-detail, #logs").show();
					etape5();
				}, "json"
			);
		};
		
		function etape31(pParam, pIndex) { // Sauvegarde du zeybux données des tables
			$.post(	"./index.php?m=Maj&e=31", "dossier=" + pParam.dossier + "&table=" + pParam.tables[pIndex],
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

		function etape3() { // Sauvegarde du zeybux
			$.post(	"./index.php?m=Maj&e=3", "phar=" + "<?php echo $lNouvelleVersion[$cMaintenanceConfig->canal]["phar"]; ?>",
				function(lResponse) {
					$("#etape-3").addClass("ui-icon-check").removeClass("ui-icon-closethick");
					$("#tableTotal").text(lResponse.tables.length);
					$("#etape-3-detail").show();
					etape31(lResponse,0);
				}, "json"
			);
		};
		
		function etape2() { // Fermeture de l'accès
			$.post(	"./index.php?m=Maj&e=2", "phar=" + "<?php echo $lNouvelleVersion[$cMaintenanceConfig->canal]["phar"]; ?>",
				function(lResponse) {
					if(lResponse == 1) {
						$("#etape-2").addClass("ui-icon-check").removeClass("ui-icon-closethick");
						etape3();
					}
				}
			);
		};
		
		$("#btn-maj").click(function() { // Téléchargement du nouveau phar
			$("#detail-etape, #info-version").toggle();
			$.post(	"./index.php?m=Maj&e=1", "phar=" + "<?php echo $lNouvelleVersion[$cMaintenanceConfig->canal]["phar"]; ?>",
				function(lResponse) {
					if(lResponse == 1) {
						$("#etape-1").addClass("ui-icon-check").removeClass("ui-icon-closethick");
						etape2();
					}
				}
			);
		});
	});
	</script>
	<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
		<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Mise à jour</div>
		<div id="info-version" class="com-center">
		Version du zeybux : <?php echo ZEYBUX_VERSION; ?><br/><br/>
		<form action="./index.php?m=Maj" method="post">
		Canal de mise à jour : 
			<select name="canal">
			<?php foreach($cMaintenanceCanal as $lCanal) {
				echo "<option";
				if($lCanal == $cMaintenanceConfig->canal) {
					echo " selected=\"selected\"";
				}
				echo ">" . $lCanal . "</option>";				
			}?>
			</select>
			<input type="submit" value="Modifier" class="com-btn-edt ui-state-default ui-corner-all com-button com-center">
		</form>
		<br/>
		<?php 
		if($lNouvelleVersion[$cMaintenanceConfig->canal]["version"] == ZEYBUX_VERSION) {
			echo "Le Zeybux est à jour";
		} else {
			echo "<button id=\"btn-maj\" class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\">Installer la nouvelle version : " . $lNouvelleVersion[$cMaintenanceConfig->canal]["version"] . "</button>";
		}
		echo "<br/><br/>";
		if($lNouvelleVersion["maintenance"]["version"] == ZEYBUX_VERSION_MAINTENANCE) {
			echo "Le module de Maintenance est à jour";
		} else {
			echo "<a href=\"./majMaintenance.php?e=1\" class=\"com-btn-edt ui-state-default ui-corner-all com-button com-center\">Installer la nouvelle version du module de maintenance : " . $lNouvelleVersion["maintenance"]["version"] . "</a>";
		}
		echo "<br/><br/>";
		?>
		</div>
		<div id="detail-etape" class="ui-helper-hidden">
			<span id="etape-1" class="com-float-left ui-icon ui-icon-closethick"></span> Téléchargement de la nouvelle version<br/>
			<span id="etape-2" class="com-float-left ui-icon ui-icon-closethick"></span> Fermeture des accès<br/>
			<span id="etape-3" class="com-float-left ui-icon ui-icon-closethick"></span> Sauvegarde du zeybux<br/>
			<div id="etape-3-detail" class="ui-helper-hidden" style="margin-left:30px;">
				<span>Table : </span><span id="tableEnCours">0</span>/<span id="tableTotal"></span><br/>
			</div>
			<span id="etape-4" class="com-float-left ui-icon ui-icon-closethick"></span> Déploiement de la mise à jour
			<a id="logs" href="" class="ui-helper-hidden com-btn-edt ui-state-default ui-corner-all com-button com-center">Logs</a><br/>
			<div id="etape-4-detail" class="ui-helper-hidden" style="margin-left:30px;">
				<span>Nombre de requêtes : </span><span id="NbRequetes"></span><br/>
				<span>Nombre d'erreur : </span><span id="NbErreurs"></span><br/>
			</div>
			<span id="etape-5" class="com-float-left ui-icon ui-icon-closethick"></span> Ouverture des accès <br/>
			<a id="btn-ok" href="./index.php?m=Maj" style="display:block;margin-top:15px;margin-bottom:15px;" class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Retour</a>
		</div>
	</div>
<?php 	
	}
}
?>