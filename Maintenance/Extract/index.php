<?php 
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
	if(isset($_GET['e']) && !empty($_GET['e'])) {
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
				) {
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
		
		mysql_close($connexion);
		
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
	} else {
?>
<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
	<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Extract de la base</div>
	<div class="com-center">
		<a href="./index.php?m=Extract&amp;e=1">
			<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Avec modification des identifications</button>
		</a>
		<a href="./index.php?m=Extract&amp;e=0">
			<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Sans modification des identifications</button>
		</a>
		<br/>
		<br/>
	</div>
</div>
<?php 
	}
}
?>