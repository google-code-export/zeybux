<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - PO Generator</title>
</head>
<body>
<div><a href="./index.php">Retour</a></div>
<?php
define("CHEMIN_CLASSES","../classes/po/");

if(isset($_POST['module'])){
	if(isset($_POST['titre'])) {
		if(isset($_POST["auteur"])) {
			
			$lTitre = $_POST["titre"];
			$lTitre[0] = strtoupper($lTitre[0]);
			$lTitre = substr_replace($lTitre,"",strlen($lTitre)-7,7);

			// Ajout de l'extension .nouveau pour éviter de réécrire sur un PO déjà existant.
			$lNomFichier = $lTitre . "PO.php";
			
			if(!file_exists($lNomFichier)) {
				$lAuteur = $_POST["auteur"];
				
				// Création du fichier
				$fp = fopen(CHEMIN_CLASSES . $_POST['module'] . "/" . $lNomFichier, 'w');	
				fwrite($fp,"<?php\n");
				fwrite($fp,"//****************************************************************\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Createur : " . $lAuteur . "\n");
				fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
				fwrite($fp,"// Fichier : " . $lNomFichier ."\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Description : Classe " . $lTitre . "PO\n");
				fwrite($fp,"//\n");
				fwrite($fp,"//****************************************************************\n\n");
				
				fwrite($fp,"/**\n");
				fwrite($fp," * @name " . $lTitre . "PO\n");
				fwrite($fp," * @author " . $lAuteur . "\n");
				fwrite($fp," * @since " . date("d/m/Y") . "\n");
				fwrite($fp," * @desc Classe représentant une " . $lTitre . "PO\n");
				fwrite($fp," */\n");
				fwrite($fp,"class " . $lTitre . "PO\n");
				fwrite($fp,"{");
					
				?>
				<h3>Fichier Généré !!</h3>
				
				<div>
					<?php echo $_POST['module'] . "->" . $_POST['titre'];?><br/>
					<?php echo "Auteur : " . $_POST['auteur']; ?><br/>
				</div>
	
				<form action="./POGenerator.php" method="post">
					<input type="hidden" name="module" value="<?php echo $_POST['module'];?>" />
					<input type="hidden" name="titre" value="<?php echo $_POST['titre'];?>" />
					<input type="hidden" name="auteur" value="<?php echo $_POST['auteur'];?>" />
					
					<table>
						<tr>
							<td>*********************</td>
							<td>* Nouvelle Variable *</td>
						</tr>
						<tr>
							<td>Nom de Variable</td>
							<td><input type="text" name="nomVariable[]" /></td>
						</tr>		
						<tr>
							<td>Type de Variable</td>
							<td><input type="text" name="typeVariable[]" /></td>
						</tr>
						<?php 
							if( isset($_POST["nomVariable"]) && isset($_POST["typeVariable"]) ) {
						?>
						<tr>
							<td>*********************</td>
							<td>* Variables du PO ***</td>
						</tr>
						<?php 
								$i = 0;
								foreach($_POST["nomVariable"] as $lNomVariable) {
									if($lNomVariable != "" && $_POST["typeVariable"][$i] != "") {
										
										$_POST["nomVariable"][$i][0] = strtoupper($_POST["nomVariable"][$i][0]);
										$_POST["typeVariable"][$i][0] = strtoupper($_POST["typeVariable"][$i][0]);			
										$lNomVariable = $_POST["nomVariable"][$i];
										
										fwrite($fp,"\n\t/**\n");
										fwrite($fp,"\t * @var " . $_POST["typeVariable"][$i] . "\n");
										fwrite($fp,"\t * @desc " . $lNomVariable . " de la " . $lTitre . "PO\n");
										fwrite($fp,"\t */\n");
										fwrite($fp,"\tprivate \$m" . $lNomVariable . ";\n");			
						?>
						<tr>
							<td>Nom de Variable</td>
							<td><input type="text" name="nomVariable[]" value="<?php echo $lNomVariable; ?>" /></td>
						</tr>		
						<tr>
							<td>Type de Variable</td>
							<td><input type="text" name="typeVariable[]" value="<?php echo $_POST["typeVariable"][$i]; ?>" /></td>
						</tr>
						<?php 
									}
									$i++;
								}
		
							$i = 0;
							foreach($_POST["nomVariable"] as $lNomVariable) {
							if($lNomVariable != "" && $_POST["typeVariable"][$i] != "") {
				
							fwrite($fp,"\n\t/**\n");
							fwrite($fp,"\t* @name get" . $lNomVariable . "()\n");
							fwrite($fp,"\t* @return " . $_POST["typeVariable"][$i] . "\n");
							fwrite($fp,"\t* @desc Renvoie le membre " . $lNomVariable . " de la " . $lTitre . "PO\n");
							fwrite($fp,"\t*/\n");
							fwrite($fp,"\tpublic function get" . $lNomVariable . "() {\n");
							fwrite($fp,"\t	return \$this->m" . $lNomVariable . ";\n");
							fwrite($fp,"\t}\n\n");
						
							fwrite($fp,"\t/**\n");
							fwrite($fp,"\t* @name set" . $lNomVariable . "(\$p" . $lNomVariable . ")\n");
							fwrite($fp,"\t* @param " . $_POST["typeVariable"][$i] . "\n");
							fwrite($fp,"\t* @desc Remplace le membre " . $lNomVariable . " par \$p" . $lNomVariable . "\n");
							fwrite($fp,"\t*/\n");
							fwrite($fp,"\tpublic function set" . $lNomVariable . "(\$p" . $lNomVariable . ") {\n");
							fwrite($fp,"\t	\$this->m" . $lNomVariable . " = \$p" . $lNomVariable . ";\n");
							fwrite($fp,"\t}\n");			
						}
						$i++;
					}
				}
				?>	
					<tr>
						<td><a href="./POGenerator.php">Effacer</a></td>
						<td><input type="submit" value="Générer"/></td>
					</tr>
				</table>
				</form>
				
				<?php
		
				fwrite($fp,"}\n");
				fwrite($fp,"?>\n");
				fclose($fp); 
			} else {
				echo "<div>Un Fichier PO existe déjà !!</div>";
				echo "<a href=\"./POGenerator.php\">Recommencer</a>";
			}			
		} else {
			?>
			<form action="./POGenerator.php" method="post">
				<input type="hidden" name="module" value="<?php echo $_POST['module'];?>" />
				<input type="hidden" name="titre" value="<?php echo $_POST['titre'];?>" />
				<span>Nom de l'auteur : </span>
				<input type="text" name="auteur" /><br/>				
				<input type="submit" />
			</form>
		<?php
		}		
	} else {
		?>
		<form action="./POGenerator.php" method="post">
		<input type="hidden" name="module" value="<?php echo $_POST['module'];?>" />
		<span>Nom de la Vue Correspondante : </span>
			<select name="titre">
			<?php 
			$lDossier = dir("../vues/" . $_POST['module'] . "/");
			while (false !== ($lEntree = $lDossier->read())) {
				if($lEntree != ".htaccess" && $lEntree != "." && $lEntree != ".." && $lEntree != ".svn") {
					echo "\t<option value=\"" . $lEntree . "\">" . $lEntree . "</option>\n";
				}
			}		
			?>			
			</select><br/>
		<input type="submit" />
		</form>
	<?php
	}
} else {
	?>
	<form action="./POGenerator.php" method="post">
	<span>Module de la Vue : </span>
		<select name="module">
		<?php 
		$lDossier = dir("../vues/");
		while (false !== ($lEntree = $lDossier->read())) {
			if($lEntree != ".htaccess" && $lEntree != "." && $lEntree != ".." && $lEntree != ".svn") {
				echo "\t<option value=\"" . $lEntree . "\">" . $lEntree . "</option>\n";
			}
		}		
		?>			
		</select><br/>
		<input type="submit" />
		</form>
	<?php
	
}
/*
// Génération automatique de PO
if(isset($_POST["auteur"]) && isset($_POST["titre"]) ) {
	$lTitre = $_POST["titre"];
	$lTitre[0] = strtoupper($lTitre[0]);
	$lNomFichier = $lTitre . "PO.php";
	$lAuteur = $_POST["auteur"];
	
	// Création du fichier
	$fp = fopen(CHEMIN_CLASSES . $lNomFichier, 'w');	
	fwrite($fp,"<?php\n");
	fwrite($fp,"//****************************************************************\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Createur : " . $lAuteur . "\n");
	fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
	fwrite($fp,"// Fichier : " . $lNomFichier ."\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Description : Classe " . $lTitre . "PO\n");
	fwrite($fp,"//\n");
	fwrite($fp,"//****************************************************************\n\n");
	
	fwrite($fp,"/**\n");
	fwrite($fp," * @name " . $lTitre . "PO\n");
	fwrite($fp," * @author " . $lAuteur . "\n");
	fwrite($fp," * @since " . date("d/m/Y") . "\n");
	fwrite($fp," * @desc Classe représentant une " . $lTitre . "PO\n");
	fwrite($fp," *//*\n");
	fwrite($fp,"class " . $lTitre . "PO\n");
	fwrite($fp,"{");
		
	?>
	<h3>Fichier Généré !!</h3>
	<form action="./POGenerator.php" method="post">
	<table>
		<tr>
			<td>*********************</td>
			<td>* Entete ************</td>
		</tr>
		<tr>
			<td>Nom du fichier</td>
			<td><?php echo $lNomFichier; ?></td>
		</tr>
		<tr>
			<td>Nom de la classe</td>
			<td><input type="text" name="titre" value="<?php echo $lTitre; ?>"/>PO</td>
		</tr>
		<tr>
			<td>Auteur</td>
			<td><input type="text" name="auteur" value="<?php echo $lAuteur; ?>"/></td>
		</tr>
		<tr>
			<td>*********************</td>
			<td>* Nouvelle Variable *</td>
		</tr>
		<tr>
			<td>Nom de Variable</td>
			<td><input type="text" name="nomVariable[]" /></td>
		</tr>		
		<tr>
			<td>Type de Variable</td>
			<td><input type="text" name="typeVariable[]" /></td>
		</tr>
		<?php 
if( isset($_POST["nomVariable"]) && isset($_POST["typeVariable"]) ) {
	?>
		<tr>
			<td>*********************</td>
			<td>* Variables du PO ***</td>
		</tr>
	<?php 
	$i = 0;
	foreach($_POST["nomVariable"] as $lNomVariable) {
		if($lNomVariable != "" && $_POST["typeVariable"][$i] != "") {
			
			$_POST["nomVariable"][$i][0] = strtoupper($_POST["nomVariable"][$i][0]);
			$_POST["typeVariable"][$i][0] = strtoupper($_POST["typeVariable"][$i][0]);			
			$lNomVariable = $_POST["nomVariable"][$i];
			
			fwrite($fp,"\n\t/**\n");
			fwrite($fp,"\t * @var " . $_POST["typeVariable"][$i] . "\n");
			fwrite($fp,"\t * @desc " . $lNomVariable . " de la " . $lTitre . "PO\n");
			fwrite($fp,"\t *//*\n");
			fwrite($fp,"\tprivate \$m" . $lNomVariable . ";\n");			
	?>
		<tr>
			<td>Nom de Variable</td>
			<td><input type="text" name="nomVariable[]" value="<?php echo $lNomVariable; ?>" /></td>
		</tr>		
		<tr>
			<td>Type de Variable</td>
			<td><input type="text" name="typeVariable[]" value="<?php echo $_POST["typeVariable"][$i]; ?>" /></td>
		</tr>
	<?php 
		}
		$i++;
	}
	
	$i = 0;
	foreach($_POST["nomVariable"] as $lNomVariable) {
		if($lNomVariable != "" && $_POST["typeVariable"][$i] != "") {
			
			fwrite($fp,"\n\t/**\n");
			fwrite($fp,"\t* @name get" . $lNomVariable . "()\n");
			fwrite($fp,"\t* @return " . $_POST["typeVariable"][$i] . "\n");
			fwrite($fp,"\t* @desc Renvoie le membre " . $lNomVariable . " de la " . $lTitre . "PO\n");
			fwrite($fp,"\t*//*\n");
			fwrite($fp,"\tpublic function get" . $lNomVariable . "() {\n");
			fwrite($fp,"\t	return \$this->m" . $lNomVariable . ";\n");
			fwrite($fp,"\t}\n\n");
		
			fwrite($fp,"\t/**\n");
			fwrite($fp,"\t* @name set" . $lNomVariable . "(\$p" . $lNomVariable . ")\n");
			fwrite($fp,"\t* @param " . $_POST["typeVariable"][$i] . "\n");
			fwrite($fp,"\t* @desc Remplace le membre " . $lNomVariable . " par \$p" . $lNomVariable . "\n");
			fwrite($fp,"\t*//*\n");
			fwrite($fp,"\tpublic function set" . $lNomVariable . "(\$p" . $lNomVariable . ") {\n");
			fwrite($fp,"\t	\$this->m" . $lNomVariable . " = \$p" . $lNomVariable . ";\n");
			fwrite($fp,"\t}\n");			
		}
		$i++;
	}
}
?>	
		<tr>
			<td><a href="./POGenerator.php">Effacer</a></td>
			<td><input type="submit" value="Générer"/></td>
		</tr>
	</table>
	</form>
	
	<?php
	
	fwrite($fp,"}\n");
	fwrite($fp,"?>\n");
	fclose($fp);
	
} else {
	?>
	<form action="./POGenerator.php" method="post">
	<table>
		<tr>
			<td>*********************</td>
			<td>* Entete ************</td>
		</tr>
		<tr>
			<td>Nom de la classe</td>
			<td><input type="text" name="titre" />PO</td>
		</tr>
		<tr>
			<td>Auteur</td>
			<td><input type="text" name="auteur" /></td>
		</tr>
		<tr>
			<td><a href="./POGenerator.php">Annuler</a></td>
			<td><input type="submit" /></td>
		</tr>
	</table>
	</form>
	<?php 
}*/
?>
</body>
</html>