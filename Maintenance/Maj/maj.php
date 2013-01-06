<?php 
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
?>
<div>
	<ul class="liste_action com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
		<li class="<?php if(!isset($_GET['e'])) echo"ui-widget-header ui-corner-top";?>">1 : Fermeture des accès</li>
		<li class="<?php if(isset($_GET['e']) && $_GET['e'] == 1) echo"ui-widget-header";?>" >2 : Sauvegarde du site</li>
		<li class="<?php if(isset($_GET['e']) && ($_GET['e'] == 2 || $_GET['e'] == 21)) echo"ui-widget-header";?>">3 : Upload du package</li>
		<li class="<?php if(isset($_GET['e']) && $_GET['e'] == 3) echo"ui-widget-header";?>">4 : Déploiement de la mise à jour</li>
		<li class="<?php if(isset($_GET['e']) && ($_GET['e'] == 4 || $_GET['e'] == 5)) echo"ui-widget-header ui-corner-bottom";?>">5 : Ouverture des accès</li>
	</ul>
</div>
<?php
require_once("./parametres.php");
if(isset($_GET['e']) && !empty($_GET['e'])) {
	switch($_GET['e']) {
		case 1 :?>
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Fermeture des accès</div>
	<?php include("./Maj/fermetureAcces.php"); ?>			
			</div>
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Sauvegarde du site</div>
				<a id="lien_btn_fermer_acces" href="./index.php?m=Maj&amp;e=2">
					<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Sauvegarder</button>
				</a>
			</div>
			<?php
		break;

		case 2 :
			?>
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Sauvegarde du site</div>		
<?php 
// Création d'un nouveau répertoire de sauvegarde
$lDossier = FILE_DUMP . "/" . date("YmdHis");
mkdir( $lDossier );

include("./Maj/dumpFile.php");
include("./Maj/dumpMySQL.php");

?>
			</div>
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Upload du package</div>		
<?php include("./Maj/formUpload.php"); ?>
			</div>
			<?php 
		break;
		
		case 21 :
			?>
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Upload du package</div>		
<?php include("./Maj/formUpload.php"); ?>
			</div>
			<?php 
		break;

		case 3 :
			?>
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Upload du package</div>
<?php include("./Maj/upload.php");?>
			</div>
			
			
<?php if($lUploadOk) { ?>
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Déploiement de la mise à jour</div>
				<a id="lien_btn_fermer_acces" href="./index.php?m=Maj&amp;e=4&amp;p=<?php echo $fichier; ?>">
					<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Déployer</button>
				</a>
			</div>
<?php }
		break;

		case 4 :?>
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Déploiement de la mise à jour</div>
<?php 
$lTraitementOK = false;
include("./Maj/extractPackage.php");
if($lTraitementOK) {
	include("./Maj/updateMySQL.php");
	include("./Maj/deploiementFile.php");
?>
			</div>
				<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
					<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Ouverture des accès</div>
					<a id="lien_btn_fermer_acces" href="./index.php?m=Maj&amp;e=5">
						<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Ouvrir</button>
					</a>
				</div>
<?php } else { ?>
			</div>
<?php }
		break;

		case 5 :	
?>	
			<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
				<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Ouverture des accès</div>	
<?php include("./Maj/OuvertureAcces.php"); ?>		
			</div>	
<?php 
		break;
	}

} else {?>
<div class="detail_action com-widget-window  ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
	<div class="com-widget-window  ui-widget ui-widget-header ui-corner-all">Fermeture des accès</div>
	<a id="lien_btn_fermer_acces" href="./index.php?m=Maj&amp;e=1">
		<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Fermer</button>
	</a>
</div>
<?php } 
}
?>