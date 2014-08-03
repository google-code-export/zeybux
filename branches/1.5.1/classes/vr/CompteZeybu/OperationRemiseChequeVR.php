<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : OperationRemiseChequeVR.php
//
// Description : Classe OperationRemiseChequeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name OperationRemiseChequeVR
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une OperationRemiseChequeVR
 */
class OperationRemiseChequeVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc IdRemiseCheque de la OperationRemiseChequeVR
	 */
	protected $mIdRemiseCheque;
	
	/**
	 * @var VRelement
	 * @desc IdOperation de la OperationRemiseChequeVR
	 */
	protected $mIdOperation;
	
	/**
	* @name OperationRemiseChequeVR()
	* @return bool
	* @desc Constructeur
	*/
	function OperationRemiseChequeVR() {
		parent::__construct();
		$this->mIdRemiseCheque = new VRelement();
		$this->mIdOperation = new VRelement();
	}

	/**
	* @name getIdRemiseCheque()
	* @return VRelement
	* @desc Renvoie le VRelement mIdRemiseCheque
	*/
	public function getIdRemiseCheque() {
		return $this->mIdRemiseCheque;
	}

	/**
	* @name setIdRemiseCheque($pIdRemiseCheque)
	* @param VRelement
	* @desc Remplace le mIdRemiseCheque par $pIdRemiseCheque
	*/
	public function setIdRemiseCheque($pIdRemiseCheque) {
		$this->mIdRemiseCheque = $pIdRemiseCheque;
	}
		
	/**
	 * @name getIdOperation()
	 * @return VRelement
	 * @desc Renvoie le VRelement mIdOperation
	 */
	public function getIdOperation() {
		return $this->mIdOperation;
	}
	
	/**
	 * @name setIdOperation($pIdOperation)
	 * @param VRelement
	 * @desc Remplace le mIdOperation par $pIdOperation
	 */
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}
}
?>