<?php
$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
mysql_select_db(MYSQL_DBNOM, $connexion);
$lRequete = file_get_contents(FILE_UPDATE_BDD);
$lRequetes = explode(";\n", $lRequete);	
foreach( $lRequetes as $lReq ) {
	mysql_query($lReq, $connexion); 
}
mysql_close($connexion);
echo "Mise à jour de la base effectuée !!<br/><br/>";

?>
