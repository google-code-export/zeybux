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
	if(isset($_GET['id_commande'])) {
		$lParam = array("id_commande" => $_GET['id_commande']);		
		
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
		InfobullesUtils::generer(&$lTemplate); // Messages d'erreur
		$lTemplate->assign_var_from_handle('ENTETE', 'entete');
		
		// Menu
		$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
		$lTemplate->assign_vars( array( 'menu-MesAchats' => "ui-state-active") );	
		$lTemplate->assign_var_from_handle('MENU', 'menu');
		
		// Body		
		$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'DetailAchats.html') );
		$lTemplate->assign_vars( array( 'sigleMonetaire' => SIGLE_MONETAIRE , 'comNumero' => $lPage->getMarche()->getNumero() ) );
	
		$lData = array("achats" => array(), "achatsSolidaire" =>array());
		foreach($lPage->getAchats() as $lAchat) {		
			$lDataPdtAchat = array();
			$lDataPdtAchatSolidaire = array();
			$lAchatClassique = false;
			$lAchatSolidaire = false;
			
			foreach($lPage->getMarche()->getProduits() as $lProduit) {	
				$lAchatPdtSolidaire = false;
				
				$lPdt = array("nproNom"=>$lProduit->getNom(), 'proUniteMesure' => $lProduit->getUnite());
				$lPdtSolidaire = array("nproNom"=>$lProduit->getNom(), 'proUniteMesure' => $lProduit->getUnite());
				
				$lQte = 0;
				$lPrix = 0;				
				foreach($lProduit->getLots() as $lLot) {
					foreach($lAchat->getDetailAchat() as $lDetailAchat) {
						if($lLot->getId() == $lDetailAchat->getIdDetailCommande() ) {
							$lQte = $lDetailAchat->getQuantite() * -1;
							$lPrix = $lDetailAchat->getMontant() * -1;
							$lAchatClassique = true;
						}
					}
					
				}				
				$lPdt['stoQuantite'] = $lQte;
				$lPdt['prix'] = $lPrix;
				
				if(!isset($lDataPdtAchat[$lProduit->getIdCategorie()])) {
					$lDataPdtAchat[$lProduit->getIdCategorie()] = array("nom" => $lProduit->getCproNom(),"achat"=>array());
				}
				array_push($lDataPdtAchat[$lProduit->getIdCategorie()]["achat"],$lPdt);

				// Solidaire
				$lQteSolidaire = 0;
				$lPrixSolidaire = 0;	
				foreach($lPage->getStockSolidaire() as $lStockSolidaire) {
					if($lProduit->getId() == $lStockSolidaire->getProId()){
						foreach($lProduit->getLots() as $lLot) {
							foreach($lAchat->getDetailAchatSolidaire() as $lDetailAchatSolidaire) {
								if($lDetailAchatSolidaire->getIdDetailCommande() == $lLot->getId()) {
									$lQteSolidaire = $lDetailAchatSolidaire->getQuantite() * -1;
									$lPrixSolidaire = $lDetailAchatSolidaire->getMontant() * -1;
									$lAchatSolidaire = true;
									$lAchatPdtSolidaire = true;
								}
							}
						}
					}
				}
				
				if($lAchatPdtSolidaire) {
						$lPdtSolidaire['stoQuantiteSolidaire'] = $lQteSolidaire;
						$lPdtSolidaire['prixSolidaire'] = $lPrixSolidaire;	
						
						if(!isset($lDataPdtAchatSolidaire[$lProduit->getIdCategorie()])) {
							$lDataPdtAchatSolidaire[$lProduit->getIdCategorie()] = array("nom" => $lProduit->getCproNom(),"achat"=>array());
						}
						array_push($lDataPdtAchatSolidaire[$lProduit->getIdCategorie()]["achat"],$lPdtSolidaire);	
				}
			}
			
			if($lAchatClassique) {
				$lDataAchat = array("categories"=>$lDataPdtAchat,
									"idAchat"=>$lAchat->getId()->getIdAchat(),
									"total"=>$lAchat->getTotal() * -1);				
				
				array_push($lData["achats"],$lDataAchat);
			}
			
			if($lAchatSolidaire) {
				$lDataAchatSolidaire = array("categories"=>$lDataPdtAchatSolidaire,
									"idAchat"=>$lAchat->getId()->getIdAchat(),
									"totalSolidaire" => $lAchat->getTotalSolidaire() * -1);
				array_push($lData["achatsSolidaire"],$lDataAchatSolidaire);
			}
		}

		if(!empty($lData["achats"])) {
			$lTemplate->set_filenames( array('detailAchat' => MOD_COMMANDE . '/' . 'DetailAchat.html') );
			foreach($lData["achats"] as $lAchats) {
				$lTemplate->assign_block_vars('achats', array(
							"idAchat" => $lAchats['idAchat'],
							"total" => StringUtils::affichageMonetaireFr($lAchats['total']) ));
				
				foreach($lAchats["categories"] as $lCategorie) {
					$lTemplate->assign_block_vars('achats.categories', array(
							'nom' => $lCategorie["nom"] ));
					foreach($lCategorie["achat"] as $lAchat) {
						$lTemplate->assign_block_vars('achats.categories.achat', array(
							'nproNom' => $lAchat["nproNom"],
							'stoQuantite' => StringUtils::affichageMonetaireFr($lAchat["stoQuantite"]),
							'proUniteMesure' => $lAchat["proUniteMesure"],
							'prix'  =>  StringUtils::affichageMonetaireFr($lAchat["prix"]) ));
					}
				}
			}		
			$lTemplate->assign_var_from_handle('DETAIL_ACHAT', 'detailAchat');
		}
		
		if(!empty($lData["achatsSolidaire"])) {
			$lTemplate->set_filenames( array('detailAchatSolidaire' => MOD_COMMANDE . '/' . 'DetailAchatSolidaire.html') );
			foreach($lData["achatsSolidaire"] as $lAchats) {
				$lTemplate->assign_block_vars('achatsSolidaire', array(
							"idAchat" => $lAchats['idAchat'],
							"totalSolidaire" => StringUtils::affichageMonetaireFr($lAchats['totalSolidaire']) ));
				
				foreach($lAchats["categories"] as $lCategorie) {
					$lTemplate->assign_block_vars('achatsSolidaire.categories', array(
							'nom' => $lCategorie["nom"] ));
					
					
					foreach($lCategorie["achat"] as $lAchat) {
						$lTemplate->assign_block_vars('achatsSolidaire.categories.achat', array(
							'nproNom' => $lAchat["nproNom"],
							'stoQuantite' => StringUtils::affichageMonetaireFr($lAchat["stoQuantiteSolidaire"]),
							'proUniteMesure' => $lAchat["proUniteMesure"],
							'prix'  =>  StringUtils::affichageMonetaireFr($lAchat["prixSolidaire"]) ));
					}
				}
			}		
			$lTemplate->assign_var_from_handle('DETAIL_ACHAT_SOLIDAIRE', 'detailAchatSolidaire');
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
	header('location:./index.php?cx=1');
}
?>