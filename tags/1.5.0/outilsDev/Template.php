<?php


function template($pStr,$pValues,$pBname) {

	$lListeBlocks = array();
	function chercherBlocks($pData) {
		$lSplits = preg_split("/<!-- BEGIN (.*?) -->(.*)/", $pData, -1, PREG_SPLIT_OFFSET_CAPTURE);
		print_r( $lSplits);
		if($lSplits != null) {
		//	array_push($lListeBlocks, $lSplits[1]);
		//	chercherBlocks($lSplits[2]);
		}
	}
	chercherBlocks($pStr);
/*
	// Transformation du template de base pour le traitement
	if($lListeBlocks) {
		foreach($lListeBlocks as $lBlocks) {
			$lExplode = explode('.',$lListeBlocks[$lBlocks]);
			$pStr = preg_replace  (  "/<!-- BEGIN " . $lListeBlocks[$lBlocks] . " -->/"  ,  "{" . $lExplode[count($lExplode) - 1] . "{"  ,  $pStr );
			$pStr = preg_replace  (  "/<!-- END " . $lListeBlocks[$lBlocks] . " -->/"  ,  "{" . $lExplode[count($lExplode) - 1] . "{"  ,  $pStr );	
		}
	}
	
	// détection des blocs {blockName{ ... }blockName}
    $lSplits = preg_split( "/{(\\w*){(.*)}\\1}/" , $pStr);
    
	// si un bloc est trouvé 
    if ($lSplits) { 
        // on met de côté tous les éléments dont on dispose 
        $lBlock     = $lSplits[0]; // {blockName{ ... }blockName}  
        $lBlockName = $lSplits[1]; // blockName  
        $lContent   = $lSplits[2]; // ... 
        $lPartial   = ''; 
 
        // on traite le contenu avec les données adéquates 
        // en le repassant par la fonction récursivement 
        // ainsi les éventuels blocs inclus seront traités aussi 
        if($pValues[$lBlockName]) {
        	foreach($pValues[$lBlockName] as $lTag) {
        		if($pBname != null)
        			$lBnameOut = $pBname . '.' . $lBlockName;
        		else
        			$lBnameOut = $lBlockName;
            	$lPartial .=  template($lContent, $pValues[$lBlockName][$lTag],$lBnameOut); 
        	}
        }
        
        // le bloc {blockName{ ... }blockName} trouvé est replacé par le contenu traité 
        $pStr = preg_replace ($lBlock,$lPartial,$pStr);
         
        // si des blocs suivent ils seront traités également 
        $pStr = template($pStr,$pValues,null); 
    }
    
    // remplacement des tags {tag} 
    if($pValues) {
    	foreach($pValues as $lTag) {
    		preg_replace  ('/{' . lTag . '}/',$pValues[$lTag],$pStr);
    	}
    }
 
    // suppression des tags vides 
    return preg_replace  ('/{\w+}/','',$pStr);
	*/
}


$ltest = "<!-- BEGIN ttt --> toto <!-- END ttt -->C'est {var} test";
$lData = array('var' => 'un');
echo template($ltest,$lData,null);
?>