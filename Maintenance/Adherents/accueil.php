<div class="adherent_form_div com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
	<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Importer des comptes</div>
	<form method="POST" action="./index.php?m=Adherents&action=import" enctype="multipart/form-data">
	     <!-- On limite le fichier à 10000Ko -->
	     <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
	     Fichier : <input type="file" name="compte" >
	     <input type="submit" name="envoyer" value="Importer" class="com-btn-edt ui-state-default ui-corner-all com-button com-center">
	</form>
</div>
<div class="adherent_form_div com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all com-float-left">
	<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Exporter les comptes</div>
	<div class="com-center">
		<a href="./Adherents/ExportCompte.php">
			<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Exporter</button>
		</a>
	</div>
</div>