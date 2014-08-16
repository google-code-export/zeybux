<?php
function parcourirDossierSQL($pPath,&$pUpdateSql) {
	if(is_dir($pPath)) {
		$lListeNomFichier = array();
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {
			if(		$entry != '.'
					&& $entry != '..'
					&& $entry != '.svn'
					&& $entry != '.project'
					&& $entry != '.htaccess'
			) {
								
				// enleve l'extention, tout ce qui se trouve apres le '.'
				$lNomFichier = substr($entry, 0, strpos($entry,"."));
				// Si la version de la modification est supérieure à celle du site on l'ajoute au début
				// Bien l'ajouter au début pour que les requêtes soient exécutées dans l'ordre chronologique.
				if($lNomFichier > ZEYBUX_VERSION_TECHNIQUE) {
					array_push($lListeNomFichier,$lNomFichier);
					//$lListeRequete[(int)$lNomFichier] = file_get_contents($d->path.'/'.$entry);
				}
			}
		}
		sort($lListeNomFichier, SORT_NUMERIC);
		foreach($lListeNomFichier as $lIndice => $lNom) {
			$pUpdateSql .= ' ' . file_get_contents($d->path.'/'.$lNom.'.sql');
		}
		$d->close();
	}
}

$lUpdateSql = "";
// Recherche l'ensemble des évolution de la base à partir de la version du site
parcourirDossierSQL(DOSSIER_UPDATE_BDD, $lUpdateSql);

$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
mysql_select_db(MYSQL_DBNOM, $connexion);
//$lRequete = file_get_contents(FILE_UPDATE_BDD);
// Ajout du préfixe
$lUpdateSql=str_replace('{PREFIXE}', MYSQL_DB_PREFIXE, $lUpdateSql);
$lRequetes = explode(";", $lUpdateSql);	
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
		}
	}
}
fclose($f);
mysql_close($connexion);

echo "Mise à jour de la base effectuée.<br/>";
echo "Nombre de requêtes : " . $lNbRequetes .".<br/><br/>";
echo "Nombre d'erreur : " . $lNbErreur .".<br/><br/>";

?>
