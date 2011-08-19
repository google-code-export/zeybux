<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : GestionProducteurToVO.php
//
// Description : Classe GestionProducteurToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "GestionProducteurVO.php" );

/**
 * @name GestionProducteurToVO
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe représentant une GestionProducteurToVO
 */
class GestionProducteurToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ProducteurVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->nom)
			&& isset($lJson->prenom)
			&& isset($lJson->dateNaissance)
			&& isset($lJson->compte)
			&& isset($lJson->commentaire)
			&& isset($lJson->courrielPrincipal)
			&& isset($lJson->courrielSecondaire)
			&& isset($lJson->telephonePrincipal)
			&& isset($lJson->telephoneSecondaire)
			&& isset($lJson->adresse)
			&& isset($lJson->codePostal)
			&& isset($lJson->ville);

		if($lValid) {
			$lVo = new GestionProducteurVO();
			$lVo->setId($lJson->id);
			$lVo->setNom($lJson->nom);
			$lVo->setPrenom($lJson->prenom);
			$lVo->setDateNaissance($lJson->dateNaissance);
			$lVo->setCompte($lJson->compte);
			$lVo->setCommentaire($lJson->commentaire);
			$lVo->setCourrielPrincipal($lJson->courrielPrincipal);
			$lVo->setCourrielSecondaire($lJson->courrielSecondaire);
			$lVo->setTelephonePrincipal($lJson->telephonePrincipal);
			$lVo->setTelephoneSecondaire($lJson->telephoneSecondaire);
			$lVo->setAdresse($lJson->adresse);
			$lVo->setCodePostal($lJson->codePostal);
			$lVo->setVille($lJson->ville);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ProducteurVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['nom'])
			&& isset($pArray['prenom'])
			&& isset($pArray['dateNaissance'])
			&& isset($pArray['compte'])
			&& isset($pArray['commentaire'])
			&& isset($pArray['courrielPrincipal'])
			&& isset($pArray['courrielSecondaire'])
			&& isset($pArray['telephonePrincipal'])
			&& isset($pArray['telephoneSecondaire'])
			&& isset($pArray['adresse'])
			&& isset($pArray['codePostal'])
			&& isset($pArray['ville']);

		if($lValid) {
			$lVo = new GestionProducteurVO();
			$lVo->setId($pArray['id']);
			$lVo->setNom($pArray['nom']);
			$lVo->setPrenom($pArray['prenom']);
			$lVo->setDateNaissance($pArray['dateNaissance']);
			$lVo->setCompte($pArray['compte']);
			$lVo->setCommentaire($pArray['commentaire']);
			$lVo->setCourrielPrincipal($pArray['courrielPrincipal']);
			$lVo->setCourrielSecondaire($pArray['courrielSecondaire']);
			$lVo->setTelephonePrincipal($pArray['telephonePrincipal']);
			$lVo->setTelephoneSecondaire($pArray['telephoneSecondaire']);
			$lVo->setAdresse($pArray['adresse']);
			$lVo->setCodePostal($pArray['codePostal']);
			$lVo->setVille($pArray['ville']);
			return $lVo;
		}
		return NULL;
	}
}
?>