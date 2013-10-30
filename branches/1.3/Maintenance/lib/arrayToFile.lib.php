<?php

function Array2File($arr,$sFileOut,$file='',$where='') {
	if (!is_array($arr)) return false;
	if ($file!='')
		$f=$file;
	else {
		if (!($f = fopen($sFileOut, "w")))
			return false;
	}
	foreach ($arr as $k => $v) {  
		if (gettype($v)=='array') {		
			if (!fwrite($f, $where."['".$k."'] ==>\n"))
				return false;

			Array2File($v,$sFileOut,$f,"\t");

		} else {
			if (!fwrite($f, $where."['".$k.'\']='.$v."\n"))
				return false;
		}
	}
	if ($file=='')
		fclose($f);
}

?>
