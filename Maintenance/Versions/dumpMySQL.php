<?php /*
function dumpMySQL($serveur, $login, $password, $base, $pDossier, $mode)
{
    $connexion = mysql_connect($serveur, $login, $password);
    mysql_select_db($base, $connexion);
    
    $entete = "-- ----------------------\n";
    $entete .= "-- dump de la base ".$base." au ".date("d-M-Y")."\n";
    $entete .= "-- ----------------------\n\n\n";
    $creations = "";
    $insertions = "\n\n";
    
    $listeTables = mysql_query("show tables", $connexion);
    while($table = mysql_fetch_array($listeTables))
    {
        // si l'utilisateur a demandé la structure ou la totale
        if($mode == 1 || $mode == 3)
        {
            $creations .= "-- -----------------------------\n";
            $creations .= "-- creation de la table ".$table[0]."\n";
            $creations .= "-- -----------------------------\n";
            $listeCreationsTables = mysql_query("show create table ".$table[0], $connexion);
            while($creationTable = mysql_fetch_array($listeCreationsTables))
            {
              $creations .= $creationTable[1].";\n\n";
            }
        }
        // si l'utilisateur a demandé les données ou la totale
        if($mode > 1)
        {
            $donnees = mysql_query("SELECT * FROM ".$table[0]);
            $insertions .= "-- -----------------------------\n";
            $insertions .= "-- insertions dans la table ".$table[0]."\n";
            $insertions .= "-- -----------------------------\n";
            while($nuplet = mysql_fetch_array($donnees))
            {
                $insertions .= "INSERT INTO ".$table[0]." VALUES(";
                for($i=0; $i < mysql_num_fields($donnees); $i++)
                {
                  if($i != 0)
                     $insertions .=  ", ";
                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
                     $insertions .=  "'";
                  $insertions .= addslashes($nuplet[$i]);
                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
                    $insertions .=  "'";
                }
                $insertions .=  ");\n";
            }
            $insertions .= "\n";
        }
    }
 
    mysql_close($connexion);
 
    $fichierDump = fopen($pDossier . "/dump.sql", "w");
    fwrite($fichierDump, $entete);
    fwrite($fichierDump, $creations);
    fwrite($fichierDump, $insertions);
    fclose($fichierDump);
    echo "Sauvegarde de la base réalisée avec succès.<br/>";
}
dumpMySQL(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS, MYSQL_DBNOM, $lDossier, 3);*/
?>
<?php
function dumpMySQL($serveur, $login, $password, $base, $pDossier, $mode)
{
    $connexion = mysql_connect($serveur, $login, $password);
    mysql_select_db($base, $connexion);
    
   /* $entete = "-- ----------------------\n";
    $entete .= "-- dump de la base ".$base." au ".date("d-M-Y")."\n";
    $entete .= "-- ----------------------\n\n\n";
    $creations = "";
    $insertions = "\n\n";
    
    $listeTables = mysql_query("show tables", $connexion);*/
    
    $entete = "-- ----------------------\n";
    $entete .= "-- Zeybux base ".$base." au ".date("d-M-Y")."\n";
    $entete .= "-- ----------------------\n\n\n";
    $creations = "";
    $insertions = "\n\n";
    $lListeTable = array();
    $listeTables = mysql_query("show tables", $connexion);    
    while($table = mysql_fetch_array($listeTables))
    {
       /* // si l'utilisateur a demandé la structure ou la totale
        if($mode == 1 || $mode == 3)
        {
            $creations .= "-- -----------------------------\n";
            $creations .= "-- creation de la table ".$table[0]."\n";
            $creations .= "-- -----------------------------\n";
            $listeCreationsTables = mysql_query("show create table ".$table[0], $connexion);
            while($creationTable = mysql_fetch_array($listeCreationsTables))
            {
              $creations .= $creationTable[1].";\n\n";
            }
        }
        // si l'utilisateur a demandé les données ou la totale
        if($mode > 1)
        {
            $donnees = mysql_query("SELECT * FROM ".$table[0]);
            $insertions .= "-- -----------------------------\n";
            $insertions .= "-- insertions dans la table ".$table[0]."\n";
            $insertions .= "-- -----------------------------\n";
            while($nuplet = mysql_fetch_array($donnees))
            {
                $insertions .= "INSERT INTO ".$table[0]." VALUES(";
                for($i=0; $i < mysql_num_fields($donnees); $i++)
                {
                  if($i != 0)
                     $insertions .=  ", ";
                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
                     $insertions .=  "'";
                  $insertions .= addslashes($nuplet[$i]);
                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
                    $insertions .=  "'";
                }
                $insertions .=  ");\n";
            }
            $insertions .= "\n";
        }*/
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
	        switch($table[0])
	        {
	        	case "cpt_compte":
		            $donnees = mysql_query("SELECT * FROM ".$table[0]);
		            $insertions .= "-- -----------------------------\n";
		            $insertions .= "-- insertions dans la table ".$table[0]."\n";
		            $insertions .= "-- -----------------------------\n";
		            $insertions .= "INSERT INTO cpt_compte (`cpt_id`, `cpt_label`, `cpt_solde`) VALUES
									(-1, 'Zeybu Marché', '0'),
									(-2, 'EAU', '0'),
									(-3, 'Invité', '0'),
									(-4, 'Zeybu Association', '0');\n\n";
		            break;
		            
		        case "mod_module":    
		        case "tpp_type_paiement":    
		        case "vue_vues":
		            $donnees = mysql_query("SELECT * FROM ".$table[0]);
		            $insertions .= "-- -----------------------------\n";
		            $insertions .= "-- insertions dans la table ".$table[0]."\n";
		            $insertions .= "-- -----------------------------\n";
		            while($nuplet = mysql_fetch_array($donnees))
		            {
		                $insertions .= "INSERT INTO ".$table[0]." VALUES(";
		                for($i=0; $i < mysql_num_fields($donnees); $i++)
		                {
		                  if($i != 0)
		                     $insertions .=  ", ";
		                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
		                     $insertions .=  "'";
		                  $insertions .= addslashes($nuplet[$i]);
		                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
		                    $insertions .=  "'";
		                }
		                $insertions .=  ");\n";
		            }
		            $insertions .= "\n";
		         break;
	        }
        }
    }
    
// Cette vue doit être placée en fin car elle dépend d'autres vues
   	$table[0] = "view_info_commande";
    array_push($lListeTable,$table[0]);
	$creations .= "-- -----------------------------\n";
	$creations .= "-- creation de la table ".$table[0]."\n";
   	$creations .= "-- -----------------------------\n";
	$listeCreationsTables = mysql_query("show create table ".$table[0], $connexion);
	if($listeCreationsTables) {
		while($creationTable = mysql_fetch_array($listeCreationsTables)) {
			$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
			$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`julien`@`localhost` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
			$creationTable[1] = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`lesamisdpdev1`@`%` SQL SECURITY DEFINER VIEW `', "CREATE VIEW `", $creationTable[1]);
			$creations .= $creationTable[1].";\n\n";
		}
	}
    mysql_close($connexion);
    
    $fichierDump = fopen($pDossier . "/dump.sql", "w");
   /* fwrite($fichierDump, $entete);
    fwrite($fichierDump, $creations);
    fwrite($fichierDump, $insertions);*/
    fwrite($fichierDump, utf8_encode($entete));
    fwrite($fichierDump, utf8_encode($creations));
    fwrite($fichierDump, utf8_encode($insertions));
    fclose($fichierDump);
    echo "Sauvegarde de la base réalisée avec succès.<br/>";
}
dumpMySQL(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS, MYSQL_DBNOM, $lDossier, 3);
?>

