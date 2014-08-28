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