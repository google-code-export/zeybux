<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/11/2010
// Fichier : AdherentToVO.php
//
// Description : Classe AdherentToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "AdherentVO.php" );

/**
 * @name AdherentToVO
 * @author Julien PIERRE
 * @since 09/11/2010
 * @desc Classe représentant une AdherentToVO
 */
class AdherentToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet AdherentVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->motPasse)
			&& isset($lJson->numero)
			&& isset($lJson->compte)
			&& isset($lJson->nom)
			&& isset($lJson->prenom)
			&& isset($lJson->courrielPrincipal)
			&& isset($lJson->courrielSecondaire)
			&& isset($lJson->telephonePrincipal)
			&& isset($lJson->telephoneSecondaire)
			&& isset($lJson->adresse)
			&& isset($lJson->codePostal)
			&& isset($lJson->ville)
			&& isset($lJson->dateNaissance)
			&& isset($lJson->dateAdhesion)
			&& isset($lJson->commentaire)
			&& isset($lJson->modules);

		if($lValid) {
			$lVo = new AdherentVO();
			$lVo->setId($lJson->id);
			$lVo->setPass($lJson->motPasse);
			$lVo->setNumero($lJson->numero);
			$lVo->setIdCompte($lJson->compte);
			$lVo->setNom($lJson->nom);
			$lVo->setPrenom($lJson->prenom);
			$lVo->setCourrielPrincipal($lJson->courrielPrincipal);
			$lVo->setCourrielSecondaire($lJson->courrielSecondaire);
			$lVo->setTelephonePrincipal($lJson->telephonePrincipal);
			$lVo->setTelephoneSecondaire($lJson->telephoneSecondaire);
			$lVo->setAdresse($lJson->adresse);
			$lVo->setCodePostal($lJson->codePostal);
			$lVo->setVille($lJson->ville);
			$lVo->setDateNaissance($lJson->dateNaissance);
			$lVo->setDateAdhesion($lJson->dateAdhesion);
			$lVo->setCommentaire($lJson->commentaire);
			$lVo->setListeModule($lJson->modules);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet AdherentVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['motPasse'])
			&& isset($pArray['numero'])
			&& isset($pArray['compte'])
			&& isset($pArray['nom'])
			&& isset($pArray['prenom'])
			&& isset($pArray['courrielPrincipal'])
			&& isset($pArray['courrielSecondaire'])
			&& isset($pArray['telephonePrincipal'])
			&& isset($pArray['telephoneSecondaire'])
			&& isset($pArray['adresse'])
			&& isset($pArray['codePostal'])
			&& isset($pArray['ville'])
			&& isset($pArray['dateNaissance'])
			&& isset($pArray['dateAdhesion'])
			&& isset($pArray['commentaire'])
			&& isset($pArray['modules']);

		if($lValid) {
			$lVo = new AdherentVO();
			$lVo->setId($pArray['id']);
			$lVo->setPass($pArray['motPasse']);
			$lVo->setNumero($pArray['numero']);
			$lVo->setIdCompte($pArray['compte']);
			$lVo->setNom($pArray['nom']);
			$lVo->setPrenom($pArray['prenom']);
			$lVo->setCourrielPrincipal($pArray['courrielPrincipal']);
			$lVo->setCourrielSecondaire($pArray['courrielSecondaire']);
			$lVo->setTelephonePrincipal($pArray['telephonePrincipal']);
			$lVo->setTelephoneSecondaire($pArray['telephoneSecondaire']);
			$lVo->setAdresse($pArray['adresse']);
			$lVo->setCodePostal($pArray['codePostal']);
			$lVo->setVille($pArray['ville']);
			$lVo->setDateNaissance($pArray['dateNaissance']);
			$lVo->setDateAdhesion($pArray['dateAdhesion']);
			$lVo->setCommentaire($pArray['commentaire']);
			$lVo->setListeModule($pArray['modules']);
			return $lVo;
		}
		return NULL;
	}
}
?>