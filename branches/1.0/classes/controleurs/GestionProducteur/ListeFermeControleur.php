<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : ListeFermeControleur.php
//
// Description : Classe ListeFermeControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeFermeViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/AjoutFermeResponse.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/FermeValid.php");

/**
 * @name ListeFermeControleur
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe controleur d'une liste des Fermes
 */
class ListeFermeControleur
{	
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
	* @name ajouterFerme($pParam)
	* @return AjoutFermeResponse
	* @desc Ajoute une ferme
	*/
	public function ajouterFerme($pParam) {	
		$lVr = FermeValid::validAjout($pParam);
		if($lVr->getValid()) {
			// Création d'un nouveau compte
			$lCompte = new CompteVO();
			$lIdCompte = CompteManager::insert($lCompte);
			// Le label est l'id du compte par défaut
			$lCompte->setId($lIdCompte);
			$lCompte->setLabel('C' . $lIdCompte);
			CompteManager::update($lCompte);
			
			// Initialisation du compte
			$lOperation = new OperationVO();
			$lOperation->setIdCompte($lIdCompte);
			$lOperation->setMontant(0);
			$lOperation->setLibelle("Création du compte");
			$lOperation->setDate(StringUtils::dateAujourdhuiDb());
			$lOperation->setType(1);
			$lOperation->setIdCommande(0);
			$lOperation->setTypePaiement(-1);				
			OperationManager::insert($lOperation);
			
			$lFerme = new FermeVO();
			$lFerme->setNom($pParam["nom"]);
			$lFerme->setIdCompte($lIdCompte);
			$lFerme->setSiren($pParam["siren"]);
			$lFerme->setAdresse($pParam["adresse"]);
			$lFerme->setCodePostal($pParam["codePostal"]);
			$lFerme->setVille($pParam["ville"]);
			$lFerme->setDateAdhesion($pParam["dateAdhesion"]);
			$lFerme->setDescription($pParam["description"]);
			$lFerme->setEtat(0);			
			$lId = FermeManager::insert($lFerme);
			
			$lResponse = new AjoutFermeResponse();
			$lResponse->setId($lId);
			return $lResponse;
		}
		return $lVr;
	}
}
?>