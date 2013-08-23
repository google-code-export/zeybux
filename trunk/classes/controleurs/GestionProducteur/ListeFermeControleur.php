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
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/AjoutFermeResponse.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/FermeValid.php");
//include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_SERVICE . "FermeService.php");

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
		$lFermeService = new FermeService();
		$lResponse->setListeFerme($lFermeService->get());
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
			$lCompteService = new CompteService();
			$lCompte = $lCompteService->set($lCompte);
			
			// Création de la ferme
			$lFerme = new FermeVO();
			$lFerme->setNom($pParam["nom"]);
			$lFerme->setIdCompte($lCompte->getId());
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