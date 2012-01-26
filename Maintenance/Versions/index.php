<?php
require_once("./parametres.php");
if(isset($_GET["action"])) {
	switch($_GET["action"]) {			
		case "actionSav":
			?>			
			<div class="com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Sauvegarde du site</div>
			<?php 
			$lDossier =  FILE_DUMP . "/" . date("YmdHis");
			mkdir($lDossier);
			include("./Versions/dumpFile.php");
			include("./Versions/dumpMySQL.php");
			?>
			</div>
			<?php 
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
			<div class="com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Appliquer une version</div>
					Voulez-vous réellement appliquer la version : <?php echo $lVersion[6] . $lVersion[7] ."-". $lVersion[4] . $lVersion[5] . "-" . $lVersion[0] . $lVersion[1] . $lVersion[2] . $lVersion[3] . " " . $lVersion[8] . $lVersion[9] .":". $lVersion[10] . $lVersion[11] .":". $lVersion[12]. $lVersion[13];?>
					<br/><br/>
					<div class="com-center">
						<a href="./index.php?m=Versions&amp;action=actionRollBack&amp;dir=<?php echo $_GET["dir"];?>">
							<button class="ui-state-default ui-corner-all com-button com-center">Confirmer</button>
						</a>
					</div>
			</div>
		<?	}
			break;
			
		case "actionRollBackConfirm":
			if(isset($_GET["dir"])) {
				// Ferme les accès
				copy(DOSSIER_CONFIGURATION . "/Maintenance_ferme.php" , DOSSIER_SITE_CONFIGURATION . "/Maintenance.php");
				?>
				
				
				<div class="com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all">
					<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Appliquer une version</div>
				
				
				<?php
				// Sauvegarde du site
				$lDossier =  FILE_DUMP . "/" . date("YmdHis");
				mkdir($lDossier);
				include("./Versions/dumpFile.php");
				include("./Versions/dumpMySQL.php");
				
				// Déploiement de la version
				// Supression de l'ancien site excepté dossier maintenance, index.php, dossier configuration et Maintenance.php du dossier configuration
				// Pas de suppression des logs
				function supprimerDossier($pPath) {
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
				}
				supprimerDossier(DOSSIER_SITE);				
				
				function parcourirDossierExtract($pPathIn,$pPathOut) {
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
				}
				parcourirDossierExtract(FILE_DUMP . "/" . $_GET["dir"],DOSSIER_SITE);
				
				// Suppression de la base
				$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
   				mysql_select_db(MYSQL_DBNOM, $connexion);
   				$listeTables = mysql_query("show tables", $connexion);
			    while($table = mysql_fetch_array($listeTables)) {
			    	mysql_query("DROP TABLE" . $table[0]);
			    }
   				mysql_close($connexion);

   				// Mise en place de la base de la version
				$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
				mysql_select_db(MYSQL_DBNOM, $connexion);
				$lRequete = file_get_contents(FILE_DUMP . "/" . $_GET["dir"] . "/dump.sql");
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
							fwrite($f, mysql_errno($connexion) . ": " . mysql_error($connexion) . "\n");
						}
					}
				}
				fclose($f);
				mysql_close($connexion);

				// Ouvre les accès
				copy(DOSSIER_CONFIGURATION . "/Maintenance_ouvert.php" , DOSSIER_SITE_CONFIGURATION . "/Maintenance.php");
				
				$lVersion = $_GET["dir"];
				?>
						<br/><br/>La version : <?php echo $lVersion[6] . $lVersion[7] ."-". $lVersion[4] . $lVersion[5] . "-" . $lVersion[0] . $lVersion[1] . $lVersion[2] . $lVersion[3] . " " . $lVersion[8] . $lVersion[9] .":". $lVersion[10] . $lVersion[11] .":". $lVersion[12]. $lVersion[13];?> est active. 
				</div>
				<?php 
				
			}
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
?>


<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
	<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Versions du Zeybux</div>
	<div class="com-center">
		<a href="./index.php?m=Versions&amp;action=sav">
			<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Ajouter une sauvegarde</button>
		</a><br/><br/>
	</div>
	<table class="com-table">
		<tr class="ui-widget ui-widget-header" >
			<th class="com-table-th-debut" >Date de Sauvegarde</th>
			<th class="com-table-th-med td-edt"></th>
			<th class="com-table-th-fin td-edt"></th>
		</tr>
		<?php foreach($lVersions as $lVersion) {?>
		<tr>
			<td class="com-table-td-debut"><?php echo $lVersion[6] . $lVersion[7] ."-". $lVersion[4] . $lVersion[5] . "-" . $lVersion[0] . $lVersion[1] . $lVersion[2] . $lVersion[3] . " " . $lVersion[8] . $lVersion[9] .":". $lVersion[10] . $lVersion[11] .":". $lVersion[12]. $lVersion[13];?></td>
			<td class="com-table-td-med">
				<a href="./index.php?m=Versions&amp;action=rollBack&amp;dir=<?php echo $lVersion;?>" class="com-cursor-pointer com-btn-header ui-widget-content ui-corner-all btn-edt-supprimer" title="Appliquer">
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

?>