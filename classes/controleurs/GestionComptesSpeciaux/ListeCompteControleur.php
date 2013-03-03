<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier : ListeCompteControleur.php
//
// Description : Classe ListeCompteControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMPTES_SPECIAUX . "/ListeCompteResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "IdentificationService.php" );
include_once(CHEMIN_CLASSES_VO . "IdentificationVO.php");

/**
 * @name ListeCompteControleur
 * @author Julien PIERRE
 * @since 25/01/2012
 * @desc Classe controleur d'un ListeCompte
 */
class ListeCompteControleur
{	
	/**
	* @name getListeCompte()
	* @return ListeCompteResponse
	* @desc Renvoie la liste des comptes spéciaux
	*/
	public function getListeCompte() {		
		$lIdentificationService = new IdentificationService();
		$lListeCompte = $lIdentificationService->get();
		
		$lNbAdministrateur = 0;
		$lNbCaisse = 0;
		$lNbSolidaire = 0;
		
		$lResponse = new ListeCompteResponse();		
		foreach($lListeCompte as $lCompte) {
			switch($lCompte->getType()) {
				case "2":
					$lResponse->addAdministrateur($lCompte);
					$lNbAdministrateur++;
					break;
					
				case "3":
					$lResponse->addCaisse($lCompte);
					$lNbCaisse++;
					break;
					
				case "4":
					$lResponse->addSolidaire($lCompte);
					$lNbSolidaire++;
					break;
			}	
		}		
		
		$lIdentificationVO = new IdentificationVO();
		if($lNbAdministrateur == 0) { $lResponse->addAdministrateur($lIdentificationVO); }
		if($lNbCaisse == 0) { $lResponse->addCaisse($lIdentificationVO); }
		if($lNbSolidaire == 0) { $lResponse->addSolidaire($lIdentificationVO); }
		
		return $lResponse;
	}
}
?>
