<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : ListeAbonneControleur.php
//
// Description : Classe ListeAbonneControleur
//
//****************************************************************
// Inclusion des classes
/*include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ZEYBU . "/InfoCompteZeybuResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );*/
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/ListeAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/DetailAbonneResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AbonnementListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ABONNEMENT . "/ListeAbonneValid.php" );
include_once(CHEMIN_CLASSES_VO . "ListeProduitVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeProduitFermeVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeProduitFermeCategorieVO.php");
include_once(CHEMIN_CLASSES_VO . "ListeProduitFermeCategorieProduitAbonnementVO.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeFermeViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT ."/ListeProduitFermeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ABONNEMENT . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ABONNEMENT . "/ListeProduitValid.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/DetailProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ABONNEMENT . "/DetailAbonnementResponse.php" );
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");

/**
 * @name ListeAbonneControleur
 * @author Julien PIERRE
 * @since 15/02/2012
 * @desc Classe controleur du liste d'abonne
 */
class ListeAbonneControleur
{
	/**
	* @name getListeAbonne()
	* @desc Donne la liste des adhérents 
	*/
	public function getListeAbonne() {		
		$lResponse = new ListeAdherentResponse();
		$lResponse->setListeAdherent(AbonnementListeAdherentViewManager::selectAll());
		return $lResponse;		
	}
	
	/**
	* @name getDetailAbonne($pParam)
	* @desc Donne le détail d'un abonne
	*/
	public function getDetailAbonne($pParam) {
		$lVr = ListeAbonneValid::validGetDetailAbonne($pParam);
		if($lVr->getValid()) {
			$lAdherent = AbonnementListeAdherentViewManager::select($pParam["id"]);		
			$lAdherent = $lAdherent[0];
			$lResponse = new DetailAbonneResponse();
			$lResponse->setAdherent($lAdherent);
			$lAbonnementService = new AbonnementService();
			//$lResponse->setProduits($lAbonnementService->getProduitsAbonne($lAdherent->getCptId()));

			$lProduits = $lAbonnementService->getProduitsAbonne($lAdherent->getCptId());
			
			$lDerniereFerme = $lProduits[0]->getFerNom();
			$lDerniereCategorie = $lProduits[0]->getCproNom();
			$lListeProduit = new ListeProduitVO();
			
			$lFerme = new ListeProduitFermeVO();
			$lFerme->setNom($lProduits[0]->getFerNom());
			
			$lCategorie = new ListeProduitFermeCategorieVO();
			$lCategorie->setNom($lProduits[0]->getCproNom());
			
			foreach($lProduits as $lProduit) {
				if($lDerniereFerme != $lProduit->getFerNom()) {
					$lFerme->addCategories($lCategorie);
					$lListeProduit->addFermes($lFerme);
					
					$lFerme = new ListeProduitFermeVO();
					$lFerme->setNom($lProduit->getFerNom());
					
					$lCategorie = new ListeProduitFermeCategorieVO();
					$lCategorie->setNom($lProduit->getCproNom());
				} else if($lDerniereCategorie != $lProduit->getCproNom()) {
					$lFerme->addCategories($lCategorie);
					$lCategorie = new ListeProduitFermeCategorieVO();
					$lCategorie->setNom($lProduit->getCproNom());
				}
				$lPdt = new ListeProduitFermeCategorieProduitAbonnementVO();
				$lPdt->setId($lProduit->getCptAboIdProduitAbonnement());
				$lPdt->setIdAbonnement($lProduit->getCptAboId());
				$lPdt->setNom($lProduit->getNproNom());			
				$lPdt->setQuantite($lProduit->getCptAboQuantite());			
				$lPdt->setUnite($lProduit->getProAboUnite());			
				$lPdt->setDateDebutSuspension($lProduit->getCptAboDateDebutSuspension());			
				$lPdt->setDateFinSuspension($lProduit->getCptAboDateFinSuspension());			
				$lCategorie->addProduits($lPdt);
				
				
				$lDerniereCategorie = $lProduit->getCproNom();
				$lDerniereFerme = $lProduit->getFerNom();	
			}		
			$lFerme->addCategories($lCategorie);
			$lListeProduit->addFermes($lFerme);

			$lResponse->setProduits($lListeProduit);

			return $lResponse;		
		}
		return $lVr;
	}
	
	/**
	* @name ajoutAbonnement($pParam)
	* @desc Ajoute un abonnement
	*/
	public function ajoutAbonnement($pParam) {
		$lVr = ListeAbonneValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lAbonnementService = new AbonnementService();
			// Si il y a une suspension en cours on ajoute l'abonnement en suspension
			//$lProduits = $lAbonnementService->getProduitsAbonne($pParam['idCompte']);
			
			$lCompteAbonnement = new CompteAbonnementVO();
			//$lCompteAbonnement->setId($pId);
			$lCompteAbonnement->setIdCompte($pParam['idCompte']);
			$lCompteAbonnement->setIdProduitAbonnement($pParam['idProduitAbonnement']);
			$lCompteAbonnement->setIdLotAbonnement($pParam['idLotAbonnement']);
			$lCompteAbonnement->setQuantite($pParam['quantite']);
			$lCompteAbonnement->setDateDebutSuspension(StringUtils::FORMAT_DATE_TIME_NULLE);
			$lCompteAbonnement->setDateFinSuspension(StringUtils::FORMAT_DATE_TIME_NULLE);
			$lCompteAbonnement->setEtat(0);

			$lAbonnementService->setAbonnement($lCompteAbonnement);
		}
		return $lVr;
	}
	
	/**
	* @name updateAbonnement($pParam)
	* @desc Met à jour un abonnement
	*/
	public function updateAbonnement($pParam) {
		$lVr = ListeAbonneValid::validUpdate($pParam);
		if($lVr->getValid()) {			
			$lAbonnementService = new AbonnementService();			
			$lDetailCompteAbonnement = $lAbonnementService->getAbonnement($pParam["id"]);			
			
			$lCompteAbonnement = new CompteAbonnementVO();
			$lCompteAbonnement->setId($pParam["id"]);
			$lCompteAbonnement->setIdCompte($pParam['idCompte']);
			$lCompteAbonnement->setIdProduitAbonnement($pParam['idProduitAbonnement']);
			$lCompteAbonnement->setIdLotAbonnement($pParam['idLotAbonnement']);
			$lCompteAbonnement->setQuantite($pParam['quantite']);
			$lCompteAbonnement->setDateDebutSuspension($lDetailCompteAbonnement->getCptAboDateDebutSuspension());
			$lCompteAbonnement->setDateFinSuspension($lDetailCompteAbonnement->getCptAboDateFinSuspension());
			$lCompteAbonnement->setEtat(0);

			$lAbonnementService->setAbonnement($lCompteAbonnement);
		}
		return $lVr;
	}
	
	/**
	* @name supprimerAbonnement($pParam)
	* @desc Supprime un abonnement
	*/
	public function supprimerAbonnement($pParam) {
		$lVr = ListeAbonneValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAbonnementService = new AbonnementService();
			$lAbonnementService->deleteAbonnement($pParam['id']);
		}
		return $lVr;
	}
	
	/**
	* @name suspendreAbonnement($pParam)
	* @desc Suspend un abonnement
	*/
	public function suspendreAbonnement($pParam) {
		$lVr = ListeAbonneValid::validSuspendre($pParam);
		if($lVr->getValid()) {	
			$lCompteAbonnementVO = new CompteAbonnementVO();
			$lCompteAbonnementVO->setIdCompte($pParam['idCompte']);
			$lCompteAbonnementVO->setDateDebutSuspension($pParam["dateDebutSuspension"] . " " . StringUtils::FORMAT_TIME_NULLE);
			$lCompteAbonnementVO->setDateFinSuspension($pParam["dateFinSuspension"] . " " . StringUtils::FORMAT_TIME_NULLE);
			
			$lAbonnementService = new AbonnementService();		
			$lAbonnementService->suspendreAbonnement($lCompteAbonnementVO);
		}
		return $lVr;
	}
	
	/**
	* @name supprimerSuspensionAbonnement($pParam)
	* @desc Arrête la suspension d'abonnement
	*/
	public function supprimerSuspensionAbonnement($pParam) {
		$lVr = ListeAbonneValid::validSupprimerSuspension($pParam);
		if($lVr->getValid()) {	
			$lCompteAbonnementVO = new CompteAbonnementVO();
			$lCompteAbonnementVO->setIdCompte($pParam['idCompte']);
			$lCompteAbonnementVO->setDateDebutSuspension(StringUtils::FORMAT_DATE_TIME_NULLE);
			$lCompteAbonnementVO->setDateFinSuspension(StringUtils::FORMAT_DATE_TIME_NULLE);
			
			$lAbonnementService = new AbonnementService();		
			$lAbonnementService->suspendreAbonnement($lCompteAbonnementVO);
		}
		return $lVr;
	}
	
	/**
	* @name getListeFerme()
	* @return ListeFermeResponse
	* @desc Recherche la liste des Fermes
	*/
	public function getListeFerme() {		
		// Lancement de la recherche
		$lResponse = new ListeFermeResponse();
		$lResponse->setListeFerme(ListeFermeViewManager::selectAll());
		return $lResponse;
	}
	
	/**
	* @name getListeProduit($pParam)
	* @return ListeProduitResponse
	* @desc Retourne la liste des produits
	*/
	public function getListeProduit($pParam) {
		$lVr = ListeAbonneValid::validGetListeProduit($pParam);
		if($lVr->getValid()) {
			$lAbonnementService = new AbonnementService();			
			$lResponse = new ListeProduitResponse();
			$lResponse->setListeProduit($lAbonnementService->getProduitsNonAbonne( $pParam['id'],$pParam["idFerme"] ) );
			return $lResponse;
		}		
		return $lVr;
	}
	
	/**
	* @name getDetailProduit($pParam)
	* @desc Donne le détail d'un produit
	*/
	public function getDetailProduit($pParam) {
		$lVr = ListeProduitValid::validGetDetailProduit($pParam);
		if($lVr->getValid()) {
			$lAbonnementService = new AbonnementService();
			$lResponse = new DetailProduitResponse();
			$lResponse->setProduit($lAbonnementService->getDetailProduit($pParam["id"]));
			return $lResponse;		
		}
		return $lVr;
	}
	
	/**
	* @name getDetailAbonnement($pParam)
	* @desc Donne le détail d'un produit et de l'abonnement
	*/
	public function getDetailAbonnement($pParam) {
		$lVr = ListeAbonneValid::validGetDetailAbonnement($pParam);
		if($lVr->getValid()) {
			$lAbonnementService = new AbonnementService();
			$lResponse = new DetailAbonnementResponse();
			$lResponse->setProduit($lAbonnementService->getDetailProduit($pParam["idProduit"]));
			$lResponse->setAbonnement($lAbonnementService->getAbonnement($pParam["idCompteAbonnement"]));
			return $lResponse;		
		}
		return $lVr;
	}
}
?>