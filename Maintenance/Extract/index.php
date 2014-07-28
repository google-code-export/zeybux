<?php 
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
	if(isset($_GET['action']) && !empty($_GET['action'])) {
		require_once("./parametres.php");
		
		
		$lDossierDump = "./Extract/dump/";
		$lFichierDump = 'dump.sql.zip';
		
		switch($_GET['action']) {
			case 30:
				@mkdir( $lDossierDump );
				
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
				
				if(file_exists($lFichierDump)) {
					unlink($lFichierDump);
				}
					
				// On teste si le dossier existe, car sans ça le script risque de provoquer des erreurs.
				if($lZip->open('./Extract/'.$lFichierDump, ZipArchive::CREATE) == TRUE) {
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
				
				echo json_encode(array("tables"=>$lListeTable));
				break;
				
			case 31:
				// Sauvegarde de la base
				if(isset($_POST['table'])) {						
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
					if($lZip->open('./Extract/'.$lFichierDump, ZipArchive::CREATE) == TRUE) {
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
				
				case 32:
					rmdir( $lDossierDump );
					echo 1;
					break;
		}
	
	
	
/*	if(isset($_GET['e']) && !empty($_GET['e'])) {
		require_once("./parametres.php");

		$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
		mysql_select_db(MYSQL_DBNOM, $connexion);
		
		$entete = "-- ----------------------\n";
		$entete .= "-- Zeybux base " . MYSQL_DBNOM . " au " . date("d-M-Y") . "\n";
		$entete .= "-- ----------------------\n\n\n";
		$creations = "";
		$insertion = "\n\n";
		$insertions = array();
		$lListeTable = array();
		$listeTables = mysql_query("show tables", $connexion);
		
		//$fichierInsertion = fopen('./insert.sql', "w");
		
		while($table = mysql_fetch_array($listeTables))
		{
			array_push($lListeTable,$table[0]);
			// La structure
			if($table[0] != 'view_info_commande') {
				$creations .= "-- -----------------------------\n";
				$creations .= "-- creation de la table ".$table[0]."\n";
				$creations .= "-- -----------------------------\n";
				$listeCreationsTables = mysql_query("show create table ".$table[0], $connexion);
				while($creationTable = mysql_fetch_array($listeCreationsTables))
				{
					if(preg_match('/CREATE ALGORITHM=UNDEFINED/',$creationTable[1])) {
						$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
						$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
					} else {
						$creationTable[1] = str_replace('CREATE TABLE `', "CREATE TABLE `", $creationTable[1]);
						$creationTable[1] = preg_replace ("/AUTO_INCREMENT=[0-9]* DEFAULT/","AUTO_INCREMENT=0 DEFAULT", $creationTable[1]);
					}
					$creations .= $creationTable[1].";\n\n";
				}
				 
				// si l'utilisateur a demandé les données ou la totale
				if($table[0] != "acc_acces" 
						/*&& $table[0] != "hdope_historique_detail_operation" && $table[0] != "hsto_historique_stock"*/
		/*		) {
						$donnees = mysql_query("SELECT * FROM ".$table[0]);
						$lLigneInsertion = "-- -----------------------------\n";
						$lLigneInsertion .= "-- insertions dans la table ".$table[0]."\n";
						$lLigneInsertion .= "-- -----------------------------\n";
						while($nuplet = mysql_fetch_array($donnees))
						{
							$lLigneInsertion .= "INSERT INTO ".$table[0]." VALUES(";
							for($i=0; $i < mysql_num_fields($donnees); $i++)
							{
								if($i != 0)
									$lLigneInsertion .=  ", ";
								//if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
									$lLigneInsertion .=  "'";
								$lLigneInsertion .= utf8_encode(addslashes($nuplet[$i]));
								//if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
									$lLigneInsertion .=  "'";
							}
							$lLigneInsertion .=  ");\n";
						}
						$lLigneInsertion .= "\n";
						
						array_push($insertions, $lLigneInsertion);
				}
			}
		}

		// Cette vue doit être placée en fin car elle dépend d'autres vues
		/*$table[0] = "view_info_commande";
		array_push($lListeTable,$table[0]);
		$creations .= "-- -----------------------------\n";
		$creations .= "-- creation de la table ".$table[0]."\n";
		$creations .= "-- -----------------------------\n";
		$listeCreationsTables = mysql_query("show create table ".$table[0], $connexion);
		while($creationTable = mysql_fetch_array($listeCreationsTables))
		{
			$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
			$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
			$creations .= $creationTable[1].";\n\n";
		}*/
		
/*		mysql_close($connexion);
		
		$lMajMdP = '';
		if($_GET['e'] == 1) {
			$lMajMdP = "\n\nupdate ide_identification set ide_pass='01f01083386dc09d99826461b2b6c6f1';";
		}
		
		// Lance le téléchargement
		header("Content-disposition: attachment; filename=Extract.sql.tar.gz");
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: text/plain\n");
		header("Pragma: no-cache");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
		header("Expires: 0");
		
		// Export des données
		$lFileTemp = microtime() . ".sql";
		
		$fichierDump = fopen('./' . $lFileTemp, "w");
		fwrite($fichierDump, utf8_encode($entete));
		fwrite($fichierDump, utf8_encode($creations));
		fwrite($fichierDump, utf8_encode($insertion));
		foreach($insertions as $lLigne) {
			fwrite($fichierDump, $lLigne);
		}
		fwrite($fichierDump, utf8_encode($lMajMdP));
		fclose($fichierDump);
		
		require_once('./lib/pclerror.lib.php');
		require_once('./lib/pcltrace.lib.php');
		require_once('./lib/pcltar.lib.php');
		require_once('./lib/arrayToFile.lib.php');
		
		$p_tarname = $lFileTemp . '.tar.gz';
		$p_list = array('./' . $lFileTemp);
		$p_mode = '';
		$p_add_dir = '';
		$p_remove_dir = '';
		PclTarCreate($p_tarname, $p_list, $p_mode, $p_add_dir, $p_remove_dir);
		
		echo file_get_contents('./' . $lFileTemp . '.tar.gz');
		unlink('./' . $lFileTemp);		
		unlink('./' . $lFileTemp . '.tar.gz');
	}*/
	} else {
?>
<script type="text/javascript">
	$(document).ready(function() {		
		function etape32() { // Insertion de la BDD
			$.post(	"./index.php?m=Extract&action=32",
				function(lResponse) {
					if(lResponse == 1) {
						$("#etape-4").addClass("ui-icon-check").removeClass("ui-icon-closethick");
						$("#btn-ok").show();
					}
				}
			);
		};
		
		function etape31(pParam, pIndex) { // Insertion de la BDD
			$.post(	"./index.php?m=Extract&action=31", "table=" + pParam.tables[pIndex],
				function(lResponse) {
					if(lResponse == 1) {
						$("#tableEnCoursInsert").text(pIndex + 1);								
						if( pParam.tables[pIndex + 1]) {
							etape31(pParam, pIndex + 1);
						} else {
							etape32();
						}
					}
				}
			);
		};
		
		$("#btn-extraire").click(function() { // Sauvegarde du zeybux
			$("#etape-3-detail, #confirm").toggle();
			$.post(	"./index.php?m=Extract&action=30",
				function(lResponse) {
					$("#tableTotalInsert").text(lResponse.tables.length);
					$("#etape-4-detail").show();
					etape31(lResponse,0);
				}, "json"
			);
		});
	});
</script>
<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
	<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Extract de la base</div>
	<div class="com-center">
		<div id="confirm">
			<button id="btn-extraire" class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Extraire</button>
			<br/>
			<br/>
		</div>		
		<div id="etape-3-detail" class="ui-helper-hidden" style="margin-left:30px;">
			<div>
				<span id="etape-4" class="com-float-left ui-icon ui-icon-closethick"></span>Extraction<br/>
				<span id="etape-4-detail" class="ui-helper-hidden"><span>Table : </span><span id="tableEnCoursInsert">0</span>/<span id="tableTotalInsert">0</span></span><br/><br/>
				<div id="btn-ok" class="ui-helper-hidden">
					<a href="./Extract/dump.sql.zip" style="margin-top:15px;margin-bottom:15px;" class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Télécharger</a><br/><br/>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	}
}
?>