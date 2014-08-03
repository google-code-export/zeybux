<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2013
// Fichier : AchatControleur.php
//
// Description : Classe AchatControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeAchatResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeMarcheResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AchatValid.php");

/**
 * @name AchatControleur
 * @author Julien PIERRE
 * @since 08/09/2013
 * @desc Classe controleur d'une AchatControleur
 */
class AchatControleur
{		
	/**
	 * @name getListeMarche()
	 * @return ListeMarcheResponse
	 * @desc Retourne la liste des marchés.
	 */
	public function getListeMarche() {
		$lMarcheService = new MarcheService();		
		return new ListeMarcheResponse($lMarcheService->get());
	}
	
	/**
	 * @name getListeAchat($pParam)
	 * @return ListeAchatResponse
	 * @desc Retourne la liste des Achats.
	 */
	public function getListeAchat($pParam) {
		$lVr = AchatValid::validRechercheListeAchat($pParam);
		if($lVr->getValid()) {

			$lDateDebut = NULL;
			if(!empty($pParam['dateDebut'])) {
				$lDateDebut = $pParam['dateDebut'];
			}
			$lDateFin = NULL;
			if(!empty($pParam['dateFin'])) {
				$lDateFin = $pParam['dateFin'];
			}
			$lIdMarche = NULL;
			if(!empty($pParam['idMarche'])) {
				$lIdMarche = $pParam['idMarche'];
			}
			
			$lListeAchatResponse = new ListeAchatResponse();
			$lAchatService = new AchatService();
			$lListeAchatResponse->setListeAchat($lAchatService->rechercheListeAchat($lDateDebut, $lDateFin, $lIdMarche));
			
			return $lListeAchatResponse;
		}
		return $lVr;
	}
}
?>