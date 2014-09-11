<?php 
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) { // Vérification de la connexion 
?>
	<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
		<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Modification du mot de passe</div>
<?php
	// Chargement du fichier des identifiants
	$jsonString = file_get_contents('./conf/identifiant.json');
	$cIdentifiant = json_decode($jsonString);
	
	// Modification du mdp à efectuer
	if(isset($_GET['fonction']) && $_GET['fonction'] == "pass") {
		
		// test des entrants du formulaire
		if(isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['pass_nouveau']) && isset($_POST['pass_confirm'])) {
			$lModif = true;
			
			// L'ensemble des champs sont obligatoires
			if(empty($_POST['login']) || empty($_POST['pass']) || empty($_POST['pass_nouveau']) || empty($_POST['pass_confirm'])) {
				$lModif = false;
				header('location:./index.php?m=Mdp&err=3'); // redirection pour afficher l'erreur
			}
			// L'ancien mdp doit être correcte
			if(md5($_POST['pass']) !== $cIdentifiant->pass) {
				$lModif = false;
				header('location:./index.php?m=Mdp&err=1'); // redirection pour afficher l'erreur
			}
			// Le nouveau mot de passe doit être le même
			if($_POST['pass_nouveau'] !== $_POST['pass_confirm']) {
				$lModif = false;
				header('location:./index.php?m=Mdp&err=2'); // redirection pour afficher l'erreur
			}
			
			if($lModif) {
				// Maj des identifiants
				$cIdentifiant->login = $_POST['login'];
				$cIdentifiant->pass = md5($_POST['pass_nouveau']);
				// Enregistrement
				$newJsonString = json_encode($cIdentifiant);
				file_put_contents('./conf/identifiant.json', $newJsonString);
				?>
				<span>Mise à jour effectuée	</span>	
				<?php 
			}
		}
	}
	// affiche les messages d'erreur
	if(isset($_GET['err']) ) {
		echo "<span>";
		if($_GET['err'] == 1) {
			echo "L'ancien mot de passe n'est pas le bon.";
		}
		if($_GET['err'] == 2) {
			echo "Le nouveau mot de passe n'est pas identique.";
		}
		if($_GET['err'] == 3) {
			echo "Merci de remplir l'ensemble des champs";
		}
		echo "</span>";
	}
	?>	
		<form action="./index.php?m=Mdp&fonction=pass" method="post">
			<table>
				<tr>
					<th class="com-table-form-th ui-widget-content ui-corner-all">Login *</th>
					<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="text" name="login" maxlength="100" id="login" value="<?php echo $cIdentifiant->login;?>"/></td>
				</tr>
				<tr>
					<th class="com-table-form-th ui-widget-content ui-corner-all">Ancien mot de Passe *</th>
					<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="password" name="pass" maxlength="100" id="motPasse"/></td>
				</tr>
				<tr>
					<th class="com-table-form-th ui-widget-content ui-corner-all">Nouveau mot de Passe *</th>
					<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="password" name="pass_nouveau" maxlength="100" id="motPasseNouveau"/></td>
				</tr>
				<tr>
					<th class="com-table-form-th ui-widget-content ui-corner-all">Resaisir le mot de Passe *</th>
					<td class="com-table-form-td"><input class="com-input-text ui-widget-content ui-corner-all" type="password" name="pass_confirm" maxlength="100" id="motPasseConfirm"/></td>
				</tr>
				<tr>
					<td class="com-center">
						<input type="submit" value="Valider" class="ui-state-default ui-corner-all com-button com-center"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<?php 
}
?>