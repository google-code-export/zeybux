<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
}
-->
</style>
<page footer="date;heure;page" style="font-size: 12pt">
<table cellspacing="0" style="width: 100%; text-align:left; font-size: 14px">
<tr>
<td style="width: 15%;">
<img  src="<?php echo CHEMIN_RACINE .'/images/zeybu.png'?>" alt="Zeybu">
</td>
<td style="width: 25%;">
<?php echo PROP_NOM;?><br>
<?php echo PROP_ADRESSE;?><br>
<?php echo PROP_CODE_POSTAL;?> - <?php echo PROP_VILLE;?><br>
<?php echo PROP_TEL;?><br>
</td>
<td style="width: 60%;">

</td>
</tr>
</table>
<br>
<br>
<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
	<tr>
		<td style="width:50%;"></td>
		<td style="width:50%"><?php  echo $lFerme->getNom(); ?></td>
	</tr>
	<tr>
		<td style="width:50%;"></td>
		<td style="width:50%">
		<?php  echo $lFerme->getAdresse(); ?><br>
		<?php  echo $lFerme->getCodePostal(); ?> - <?php  echo $lFerme->getVille(); ?><br>
		</td>
	</tr>
</table>
<br>
<br>
<table cellspacing="0" style="width: 100%; text-align: left;font-size: 12pt">
<tr>
<td style="width:50%;"></td>
<td style="width:50%; ">EYBENS, le <?php echo date('d/m/Y'); ?></td>
        </tr>
    </table>
    <br>
    <i>
        <b><u>Objet </u>: &laquo; Bon de Livraison &raquo;</b><br><br>
    </i>
    <div>
    Madame, Monsieur,<br>
    Les amis du zeybu vous confirme l'achat des produits suivants.<br><br>
    </div>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 10%; border: solid 1px black;">Produit</th>
            <th style="width: 37%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Désignation</th>
            <th style="width: 20%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Quantité</th>
            <th style="width: 20%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Solidaire</th>
            <th style="width: 13%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Prix Net</th>
        </tr>
    </table>
<?php
foreach($lFacture->getProduits() as $lLigne) {
	$lQuantite = '';
	$lUnite = '';
	$lMontant = 0;
	$lQteTest = $lLigne->getQuantite();
	if(!is_null($lLigne->getQuantite()) && !empty($lQteTest)) {
		$lQuantite = number_format($lQteTest, 2, ',', ' ');;
		$lUnite = $lLigne->getUnite();
		$lMontant = $lLigne->getMontant();
	}
	
	$lQuantiteSolidaire = '';
	$lUniteSolidaire = '';
	$lQteSolTest = $lLigne->getQuantiteSolidaire();
	if(!is_null($lLigne->getQuantiteSolidaire()) && !empty($lQteSolTest)) {
		$lQuantiteSolidaire = number_format($lQteSolTest, 2, ',', ' ');;
		$lUniteSolidaire = $lLigne->getUniteSolidaire();
	}

	?>
	    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt;">
	        <tr>
	            <td style="width: 10%; text-align: left; border-right: solid 1px black; border-left: solid 1px black; border-bottom: solid 1px black;"><?php echo $lLigne->getNproNumero(); ?></td>
	            <td style="width: 37%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo $lLigne->getNproNom(); ?></td>
	            <td style="width: 10%; text-align: right; border-bottom: solid 1px black;"><?php echo $lQuantite; ?></td>
	            <td style="width: 10%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"> <?php echo $lUnite;?></td>
	            <td style="width: 10%; text-align: right; border-bottom: solid 1px black;"><?php echo $lQuantiteSolidaire?></td>
	            <td style="width: 10%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo $lUniteSolidaire; ?></td>
	            <td style="width: 13%; text-align: right; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo number_format($lMontant, 2, ',', ' ') . ' ' . SIGLE_MONETAIRE; ?></td>
	        </tr>
	    </table>
	<?php
}
?>
    <table cellspacing="0" style="width: 100%; border-right: solid 1px black; border-left: solid 1px black; border-bottom: solid 1px black; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 87%; text-align: right;">Total : </th>
            <th style="width: 13%; text-align: right;"><?php echo number_format($lFacture->getId()->getMontant(), 2, ',', ' ') . ' ' . SIGLE_MONETAIRE; ?></th>
        </tr>
    </table>
    <br>
    <nobreak>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:50%;"></td>
                <td style="width:50%; ">
                    Chantal VIOLETTE<br>
                    Responsable Zeybu Marché<br>
                    Tel : 06 34 68 46 87<br>
                </td>
            </tr>
        </table>
    </nobreak>
</page>