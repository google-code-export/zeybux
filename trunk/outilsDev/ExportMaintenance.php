<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Export de la Maintenance</title>
</head>
<body>
<div><a href="./index.php">Retour</a></div>
<?php 
// Répertoire du site
$lDossierVersion = dirname(__FILE__). '/../../';

if(isset($_POST['nom']) && isset($_POST['source'])) {
	$lNom = $_POST['nom'];
	$lSource = $_POST['source'];

	// Dossier Source
	$lDossierVersionSource = $lDossierVersion . $lSource;
	// Dossier cible de génération sur zeybux
	$lPath = $lDossierVersion . $lNom;

	if(is_dir($lPath)) {
		echo "<span>Le dossier d'export existe déjà !!</span><br/>";
	} else {
		mkdir($lPath);
		mkdir($lPath . '/ancien');
		$fp = fopen($lPath . '/ancien/.htaccess', 'w');
		fclose($fp);
		mkdir($lPath . '/archive');
		$fp = fopen($lPath . '/archive/.htaccess', 'w');
		fclose($fp);
		mkdir($lPath . '/conf');
		$fp = fopen($lPath . '/conf/.htaccess', 'w');
		fclose($fp);
		mkdir($lPath . '/nouveau');
		$fp = fopen($lPath . '/nouveau/.htaccess', 'w');
		fclose($fp);
		mkdir($lPath . '/logs');
		$fp = fopen($lPath . '/logs/.htaccess', 'w');
		fclose($fp);
		
		function parcourirDossierCopie($pPath,$pDest) {
			$d = dir($pPath);
			while (false !== ($entry = $d->read())) {
				if(	$entry != '.'
						&& $entry != '..'
						&& $entry != '.svn'
						&& $entry != '.project'
						&& $entry != 'conf'
				) {
					if(is_dir($d->path.'/'.$entry)) {
						if(!is_dir($pDest.'/'.$entry)) {
							mkdir($pDest.'/'.$entry);
						}
						if($entry != "ancien"
								&& $entry != "archive"
								&& $entry != "deploiement"
								&& $entry != "logs"
								&& $entry != "nouveau") {
							parcourirDossierCopie($d->path.'/'.$entry,$pDest.'/'.$entry);
						}
					} else {
						copy( $d->path.'/'.$entry , $pDest.'/'.$entry);
					}
				}
			}
			$d->close();
		}
		parcourirDossierCopie($lDossierVersionSource . '/Maintenance',$lPath);

		include($lDossierVersionSource . "/Maintenance/version.php");

		// Création de l'archive
		$lVersion = str_replace('.','-',ZEYBUX_VERSION_MAINTENANCE);
		
		$phar = new Phar($lPath .'/zeybux_module-maintenance_' . $lVersion . '.phar');
		$phar->buildFromDirectory($lPath);
		$phar->compress(Phar::BZ2);
		$phar->stopBuffering();
		unlink($lPath .'/zeybux_module-maintenance_' . $lVersion . '.phar');		
		shell_exec('cd ' . $lPath . ' && chmod -R 777 .');
		
		echo "<h1>Export Terminé !!</h1>";
	}
} else {
echo "
	<form action=\"./ExportMaintenance.php\" method=\"post\">
		<span>Nom du dossier Source</span>
			<select name=\"source\">\n";
			
			$lDossiers = array();
			if(is_dir($lDossierVersion)) {
				$d = dir($lDossierVersion);
				while (false !== ($entry = $d->read())) {
					if( $entry != '.' 
						&& $entry != '..'
						&& $entry != '.metadata'
						&& $entry != '.svn'
						&& $entry != 'RemoteSystemsTempFiles'
						&& is_dir($d->path.'/'.$entry)) {
						array_push($lDossiers,$entry);
					}
				}
				$d->close();
			}
			sort($lDossiers);
			foreach($lDossiers as $lDossier) {

echo "				<option value=\"". $lDossier . "\">" . $lDossier . "</option>\n";

			}
		
		echo "</select>	
			<br/>
		<span>Nom du dossier d'export</span><input type=\"text\" name=\"nom\" /><br/>
		<input type=\"submit\" value=\"Exporter\"/>
	</form>";
}
?>
</body>
</html>