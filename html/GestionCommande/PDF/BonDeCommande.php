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
        <b><u>Objet </u>: &laquo; Bon de Commande &raquo;</b><br><br>
    </i>
    <div>
    Madame, Monsieur,<br>
    L'association "<?php echo PROP_NOM;?>" souhaite commander les produits suivants pour le <?php echo StringUtils::dateDbToFr($lMarche->getDateMarcheDebut());?>.<br><br>
    </div>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 10%; border: solid 1px black;">Produit</th>
            <th style="width: 37%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Désignation</th>
            <th style="width: 20%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Prix Unitaire</th>
            <th style="width: 20%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Quantité</th>
            <th style="width: 13%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Prix Net</th>
        </tr>
    </table>
<?php
$lTotal = 0;
foreach($lLignesBonCommande as $lLigne) {
	$lNumero = $lLigne->getNproNumero();
	$lNomproduit = $lLigne->getNproNom();
	$lUnite = $lLigne->getProUniteMesure();
	// Si produit en plusieurs lot affiche le lot.
	if(isset($lProduit[$lLigne->getProId()]) && $lProduit[$lLigne->getProId()] == 2) {
		$lNomproduit .= " (" . number_format($lLigne->getDcomTaille(), 2, ',', ' ') . " " .$lUnite .")";
	}	
	$lPrixUnitaire = 0;
	// Evite la division par 0
	if($lLigne->getDcomTaille() > 0) {
		$lPrixUnitaire = $lLigne->getDcomPrix() / $lLigne->getDcomTaille();
	}
	$lTotal += $lLigne->getDopeMontant();
	
	?>
	    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt;">
	        <tr>
	            <td style="width: 10%; text-align: left; border-right: solid 1px black; border-left: solid 1px black; border-bottom: solid 1px black;"><?php echo $lNumero; ?></td>
	            <td style="width: 37%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo $lNomproduit; ?></td>
	            <td style="width: 10%; text-align: right; border-bottom: solid 1px black;"><?php echo number_format($lPrixUnitaire, 2, ',', ' '); ?></td>
	            <td style="width: 10%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"> &euro;/<?php echo $lUnite;?></td>
	            <td style="width: 10%; text-align: right; border-bottom: solid 1px black;"><?php echo number_format($lLigne->getStoQuantite(), 2, ',', ' '); ?></td>
	            <td style="width: 10%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"> <?php echo $lUnite;?></td>
	            <td style="width: 13%; text-align: right; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo number_format($lLigne->getDopeMontant(), 2, ',', ' '); ?> &euro;</td>
	        </tr>
	    </table>
	<?php
}
?>
    <table cellspacing="0" style="width: 100%; border-right: solid 1px black; border-left: solid 1px black; border-bottom: solid 1px black; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 87%; text-align: right;">Total : </th>
            <th style="width: 13%; text-align: right;"><?php echo number_format($lTotal, 2, ',', ' '); ?> &euro;</th>
        </tr>
    </table>
    <br>
    <div style="font-size: 11pt;">
    Merci de nous confirmer la bonne prise en compte de cette commande par mail : <a href="mailto:<?php echo PROP_MEL;?>"><?php echo PROP_MEL;?></a><br>
    Plus les dons en nature à préciser sur la facture au nom <?php echo PROP_NOM;?>.
    </div>
    <br>
    <nobreak>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:50%;"></td>
                <td style="width:50%; ">
                    <?php echo PROP_RESP_MARCHE_PRENOM;?> <?php echo PROP_RESP_MARCHE_NOM;?><br>
                    <?php echo PROP_RESP_MARCHE_POSTE;?><br>
                    Tel : <?php echo PROP_RESP_MARCHE_TEL;?><br>
                </td>
            </tr>
        </table>
    </nobreak>
</page>