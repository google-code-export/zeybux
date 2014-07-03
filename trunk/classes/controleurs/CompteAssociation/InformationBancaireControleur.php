<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/06/2014
// Fichier : InformationBancaireControleur.php
//
// Description : Classe InformationBancaireControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ZEYBU . "/InformationBancaireValid.php");
include_once(CHEMIN_CLASSES_TOVO . "InformationBancaireToVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "InformationBancaireService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ZEYBU . "/InformationBancaireResponse.php" );

/**
 * @name InformationBancaireControleur
 * @author Julien PIERRE
 * @since 22/06/2014
 * @desc Classe controleur des informations bancaire
 */
class InformationBancaireControleur
{	
	/**
	 * @name getInformationBancaire()
	 * @desc Retourne les informations bancaire du compte
	 */
	public function getInformationBancaire() {
		$lInformationBancaireService = new InformationBancaireService();			
		return new InformationBancaireResponse($lInformationBancaireService->getByIdCompte(-4));
	}
	
	/**
	 * @name enregistrerInformationBancaire($pParam)
	 * @desc enregistre les informations bancaire
	 */
	public function enregistrerInformationBancaire($pParam) {
		$lVr = InformationBancaireValid::validDelete($pParam);
		if($lVr->getValid()) {
			// Récupération de l'objet
			$lInformationBancaire = InformationBancaireToVO::convertFromArray($pParam);

			// Récupère les informations bancaire actuelles
			$lInformationBancaireService = new InformationBancaireService();	
			$lInformationBancaireActuelle = $lInformationBancaireService->getByIdCompte(-4);
			
			// Si l'information existe déjà mise à jour
			if($lInformationBancaireActuelle->getIdCompte() == -4) {
				$lInformationBancaireActuelle->setNumeroCompte($lInformationBancaire->getNumeroCompte());
				$lInformationBancaireActuelle->setRaisonSociale($lInformationBancaire->getRaisonSociale());
				$lInformationBancaireService->set($lInformationBancaireActuelle);				
			} else { // sinon ajout
				$lInformationBancaire->setIdCompte(-4);
				$lInformationBancaireService->set($lInformationBancaire);
			}
		}
		return $lVr;	
	}
}
?>