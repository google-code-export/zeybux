<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/01/2011
// Fichier : CSV.php
//
// Description : Classe CSV
//
//****************************************************************

/**
 * @name CSV
 * @author Julien PIERRE
 * @since 02/01/2011
 * @desc Classe de gestion du CSV
 */
class CSV
{
	/**
	* @var String
	* @desc Nom du fichier
	*/
	private $mNom;
	
	/**
	* @var array(String)
	* @desc Entete du fichier
	*/
	private $mEntete;
	
	/**
	* @var array(String)
	* @desc Données du fichier
	*/
	private $mData;
	
	/**
	* @name CSV()
	* @desc Le Constructeur
	*/
	public function CSV(){
		$this->mEntete = array();
		$this->mData = array();
	}
	
	/**
	* @name getNom()
	* @return String
	* @desc Renvoie le membre Nom
	*/
	public function getNom(){
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param String
	* @desc Remplace le membre Nom par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
	
	/**
	* @name getEntete()
	* @return array(String)
	* @desc Renvoie le membre Entete
	*/
	public function getEntete(){
		return $this->mEntete;
	}

	/**
	* @name setEntete($pEntete)
	* @param array(String)
	* @desc Remplace le membre Entete par $pEntete
	*/
	public function setEntete($pEntete) {
		$this->mEntete = $pEntete;
	}
	
	/**
	* @name addEntete($pEntete)
	* @param String
	* @desc Ajoute $pEntete au membre Entete
	*/
	public function addEntete($pEntete) {
		array_push($this->mEntete,$pEntete);
	}
	
	/**
	* @name getData()
	* @return array(String)
	* @desc Renvoie le membre Data
	*/
	public function getData(){
		return $this->mData;
	}

	/**
	* @name setData($pData)
	* @param array(String)
	* @desc Remplace le membre Data par $pData
	*/
	public function setData($pData) {
		$this->mData = $pData;
	}
	
	/**
	* @name addData($pData)
	* @param String
	* @desc Ajoute $pData au membre Data
	*/
	public function addData($pData) {
		array_push($this->mData,$pData);
	}
	
	/**
	* @name output()
	* @return Fichier CSV
	* @desc Retourne le fichier en CSV
	*/
	public function output() {
		// Préparation des donnés	
		$lTableau = array();
		array_push($lTableau,$this->getEntete());		
		foreach($this->getData() as $lLigne) {
			array_push($lTableau,$lLigne);
		}
	
		// Lance le téléchargement
		header("Content-disposition: attachment; filename=" . $this->getNom()); 
		header("Content-Type: application/force-download"); 
		header("Content-Transfer-Encoding: text/plain\n");
		header("Pragma: no-cache"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public"); 
		header("Expires: 0"); 
	
		// Export des données
	    $outstream = fopen("php://output", 'w');		
	    function __outputCSV(&$vals, $key, $filehandler) {
	        fputcsv($filehandler, $vals, ';', '"');
	    }
	    array_walk($lTableau, '__outputCSV', $outstream);		
	    fclose($outstream);
	}	
}