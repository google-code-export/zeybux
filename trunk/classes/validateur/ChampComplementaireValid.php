<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/07/2013
// Fichier : ChampComplementaireValid.php
//
// Description : Classe ChampComplementaireValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "ChampComplementaireVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name ChampComplementaireVR
 * @author Julien PIERRE
 * @since 27/07/2013
 * @desc Classe représentant une ChampComplementaireValid
*/
class ChampComplementaireValid
{
	/**
	 * @name validUpdate($pData, $pTypePaiement)
	 * @return ChampComplementaireVR
	 * @desc Test la validite de l'élément
	 */
	public static function validUpdate($pData, $pTypePaiement) {
		$lVr = new ChampComplementaireVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
		if(!isset($pData['valeur'])) {
			$lVr->setValid(false);
			$lVr->getValeur()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getValeur()->addErreur($lErreur);
		}
		if(!isset($pTypePaiement)) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			if(!TestFonction::checkLength($pData['valeur'],0,50)) {
				$lVr->setValid(false);
				$lVr->getValeur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getValeur()->addErreur($lErreur);
			}

			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			} else {
				// Champ Obligatoire
				if($pTypePaiement == 1 && empty($pData['valeur'])) {
					$lVr->setValid(false);
					$lVr->getValeur()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getValeur()->addErreur($lErreur);
				}
				
				// Selon le type de champ
				switch($pData['id']) {
					case 1: // IdMarche
						if(!is_int((int)$pData['valeur'])) {
							$lVr->setValid(false);
							$lVr->getValeur()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
							$lVr->getValeur()->addErreur($lErreur);
						}
						$lMarche = CommandeManager::select($pData['valeur']);
						if($lMarche->getId() != $pData['valeur']) {
							$lVr->setValid(false);
							$lVr->getValeur()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
							$lVr->getValeur()->addErreur($lErreur);
						}
						break;
					case 4: // Id Operation Reception
					case 5: // Id Operation émission
					case 6: // Id Produit
					case 7: // Id info Operation Livraison
					case 8: // Id Operation soeur
						if(!is_int((int)$pData['valeur'])) {
							$lVr->setValid(false);
							$lVr->getValeur()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
							$lVr->getValeur()->addErreur($lErreur);
						}
						break;

					case 2: // Banque
						$lBanqueService = new BanqueService();
						if(!$lBanqueService->existe($pData['valeur'])) {
							$lVr->setValid(false);
							$lVr->getValeur()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_261_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_261_MSG);
							$lVr->getValeur()->addErreur($lErreur);
						}
						break;
						
					case 3: // Numéro
						break;
				}
			}
		}
		return $lVr;
	}
}
?>