<?php
$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
mysql_select_db(MYSQL_DBNOM, $connexion);
$lRequete = file_get_contents(FILE_UPDATE_BDD);
$lRequetes = explode(";\n", $lRequete);	
$lNbErreur = 0;
mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
$f = fopen(LOG_EXTRACT . date('Y-m-d_H:i:s') . "_updateSql.log", "w")
foreach( $lRequetes as $lReq ) {
	if(!mysql_query($lReq, $connexion)) {
		$lNbErreur++;
		fwrite($f, mysql_errno($connexion) . ": " . mysql_error($connexion) . "\n")
	}
}
fclose($f);
mysql_close($connexion);
echo "Nombre d'erreur : " . $lNbErreur .".<br/>";
echo "Mise à jour de la base effectuée !!<br/><br/>";

?>