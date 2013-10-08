<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/01/2012
// Fichier : MesAchatsDetailVue.php
//
// Description : Retourne les infos sur l'achat d'un adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_GET['idAchat'])) {
		$lParam = array("idAchat" => $_GET['idAchat']);		
		
		// Inclusion des classes
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/MesAchatsControleur.php");
	
		$lControleur = new MesAchatsControleur();
		$lPage = $lControleur->getDetail($lParam);	
	
		$lLogger->log("Affichage de la vue MesAchatsDetail par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		
		// Inclusion des classes
		include_once(CHEMIN_CLASSES_UTILS . "Template.php");
		include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
		include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");
	
		// Constante de titre de la page
		define("TITRE", ZEYBUX_TITRE_DEBUT . "Mes Achats - " . ZEYBUX_TITRE_FIN);
		
		// Préparation de l'affichage
		$lTemplate = new Template(CHEMIN_TEMPLATE);	
		
		// Entete
		$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
		$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
		InfobullesUtils::generer($lTemplate); // Messages d'erreur
		$lTemplate->assign_var_from_handle('ENTETE', 'entete');
		
		// Menu
		$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
		$lTemplate->assign_vars( array( 'menu-MesAchats' => "ui-state-active") );	
		$lTemplate->assign_var_from_handle('MENU', 'menu');
		
		// Body		
		$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'DetailAchats.html') );
		
		$lData = array("categories" => array(),"total" => 0, "totalSolidaire" => 0);
		foreach($lPage->getAchats()->getProduits() as $lProduit) {
			$lLigneAchat = array("nproNom"=> $lProduit->getNproNom(), 
								"stoQuantite" => "", "prix" => "", "proUniteMesure" => "", "sigleMonetaire" => "",
								"stoQuantiteSolidaire" => "", "prixSolidaire" => "", "proUniteMesureSolidaire" => "", "sigleMonetaireSolidaire" => "");
						
			if(!is_null($lProduit->getMontant())) {
				$lLigneAchat["stoQuantite"] = StringUtils::affichageMonetaireFr($lProduit->getQuantite() * -1);
				$lLigneAchat["prix"] = StringUtils::affichageMonetaireFr($lProduit->getMontant() * -1);
				$lLigneAchat["proUniteMesure"] = $lProduit->getUnite();
				$lLigneAchat["sigleMonetaire"] = SIGLE_MONETAIRE;
			}
			if(!is_null($lProduit->getMontantSolidaire())) {
				$lLigneAchat["stoQuantiteSolidaire"] = StringUtils::affichageMonetaireFr($lProduit->getQuantiteSolidaire() * -1);
				$lLigneAchat["prixSolidaire"] = StringUtils::affichageMonetaireFr($lProduit->getMontantSolidaire() * -1);
				$lLigneAchat["proUniteMesureSolidaire"] = $lProduit->getUniteSolidaire();
				$lLigneAchat["sigleMonetaireSolidaire"] = SIGLE_MONETAIRE;
			}
			if(!isset($lData["categories"][$lProduit->getCproNom()])) {
				$lData["categories"][$lProduit->getCproNom()] = array("nom" => $lProduit->getCproNom(), "achat" => array());
			}
			array_push($lData["categories"][$lProduit->getCproNom()]["achat"], $lLigneAchat);
		}
	
	/*	$lAchat = array("detailAchat" => array(), "detailAchatSolidaire" => array(), "dateAchat" => "");
		foreach($lPage->getAchats() as $lAchatTemp) {
			if(count($lAchatTemp->getDetailAchat()) > 0) {
				$lAchat["detailAchat"] = $lAchatTemp->getDetailAchat();
			}
			if(count($lAchatTemp->getDetailAchatSolidaire()) > 0) {
				$lAchat["detailAchatSolidaire"] = $lAchatTemp->getDetailAchatSolidaire();
			}
			$lAchat["dateAchat"] = $lAchatTemp->getDateAchat();
		}*/
				
	/*	$lData = array("categories" => array(),"total" => 0, "totalSolidaire" => 0);
		foreach($lPage->getDetailProduit() as $lProduit) {
			$lLigneAchat = array("nproNom"=> $lProduit->getNproNom(), 
								"stoQuantite" => "", "prix" => "", "proUniteMesure" => "", "sigleMonetaire" => "",
								"stoQuantiteSolidaire" => "", "prixSolidaire" => "", "proUniteMesureSolidaire" => "", "sigleMonetaireSolidaire" => "");
						
			foreach($lAchat["detailAchat"] as $lDetailAchat) {
				if($lDetailAchat->getIdProduit() == $lProduit->getProId()) {
					$lLigneAchat["stoQuantite"] = StringUtils::affichageMonetaireFr($lDetailAchat->getQuantite() * -1);
					$lLigneAchat["prix"] = StringUtils::affichageMonetaireFr($lDetailAchat->getMontant() * -1);
					$lLigneAchat["proUniteMesure"] = $lProduit->getProUniteMesure();
					$lLigneAchat["sigleMonetaire"] = SIGLE_MONETAIRE;
				
					$lData["total"] += $lDetailAchat->getMontant() * -1;
				}
			}
			foreach($lAchat["detailAchatSolidaire"] as $lDetailAchatSolidaire) {
				if($lDetailAchatSolidaire->getIdProduit() == $lProduit->getProId()) {
					$lLigneAchat["stoQuantiteSolidaire"] = StringUtils::affichageMonetaireFr($lDetailAchatSolidaire->getQuantite() * -1);
					$lLigneAchat["prixSolidaire"] = StringUtils::affichageMonetaireFr($lDetailAchatSolidaire->getMontant() * -1);
					$lLigneAchat["proUniteMesureSolidaire"] = $lProduit->getProUniteMesure();
					$lLigneAchat["sigleMonetaireSolidaire"] = SIGLE_MONETAIRE;
				
					$lData["totalSolidaire"] += $lDetailAchatSolidaire->getMontant() * -1;
				}
			}
			
			if(!isset($lData["categories"][$lProduit->getCproNom()])) {
				$lData["categories"][$lProduit->getCproNom()] = array("nom" => $lProduit->getCproNom(), "achat" => array());
			}
			array_push($lData["categories"][$lProduit->getCproNom()]["achat"], $lLigneAchat);
		}*/
		
		if(!is_null($lPage->getAchats()->getOperationAchat())) {
			$lData["total"] = $lPage->getAchats()->getOperationAchat()->getMontant() * -1;
			$lData["dateAchat"] = StringUtils::dateDbToFr($lPage->getAchats()->getOperationAchat()->getDate());
		}
		if(!is_null($lPage->getAchats()->getOperationAchatSolidaire())) {
			$lData["totalSolidaire"] = $lPage->getAchats()->getOperationAchatSolidaire()->getMontant() *-1;
			$lData["dateAchat"] = StringUtils::dateDbToFr($lPage->getAchats()->getOperationAchatSolidaire()->getDate());
		}
		
		
		$lData["totalMarche"] = $lData["total"] + $lData["totalSolidaire"];
		
		$lData["total"] = StringUtils::affichageMonetaireFr($lData["total"]);
		$lData["totalSolidaire"] = StringUtils::affichageMonetaireFr($lData["totalSolidaire"]);
		$lData["totalMarche"] = StringUtils::affichageMonetaireFr($lData["totalMarche"]);
		
		$lTemplate->assign_vars( array( 'sigleMonetaire' => SIGLE_MONETAIRE, "dateAchat" => $lData["dateAchat"], "totalMarche" =>  $lData["totalMarche"],
				"total" => $lData["total"], "totalSolidaire" => $lData["totalSolidaire"]) );
		
		foreach($lData["categories"] as $lCategorie) {
			$lTemplate->assign_block_vars('categories', array(
					'nom' => $lCategorie["nom"] ));
			foreach($lCategorie["achat"] as $lAchat) {
				$lTemplate->assign_block_vars('categories.achat', $lAchat);
			}
		}
		
		// Pied de Page
		$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
		$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
		
		
		$lTemplate->set_filenames( array('page' => 'Page.html') );
		$lTemplate->assign_var_from_handle('CONTENU', 'body');
		
		// Affichage
		$lTemplate->pparse('page');
	} else {
		$lLogger->log("Demande d'accés à MesAchatsDetail sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à MesAchatsDetail",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=2');
}
?>