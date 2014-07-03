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
			<td>
			Date : <?php echo date('d/m/Y'); ?><br>
			Compte : <?php echo $lInfoBancaire->getNumeroCompte(); ?><br>
			Nom du titulaire : <?php echo $lInfoBancaire->getRaisonSociale(); ?><br>
			Total : <?php echo number_format($lRemise->getMontant(), 2, ',', ' ');?>  &euro;
			</td>
			<td style="width: 60%;">
			</td>
		</tr>
	</table>
	<br>
	<br>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 60%; border: solid 1px black;">Banque</th>
            <th style="width: 20%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Nombre de chèque</th>
            <th style="width: 20%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Total</th>
        </tr>
    </table>
<?php
$lTotal = 0;
foreach($lOperations as $lLigne) {	
	?>
	    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt;">
	        <tr>
	            <td style="width: 60%; text-align: left; border-right: solid 1px black; border-left: solid 1px black; border-bottom: solid 1px black;"><?php echo $lLigne->getBanque(); ?></td>
	            <td style="width: 20%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"> <?php echo $lLigne->getNombreCheque(); ?> x <?php echo number_format($lLigne->getMontant(), 2, ',', ' '); ?> &euro;</td>
	            <td style="width: 20%; text-align: right; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo number_format($lLigne->getTotal(), 2, ',', ' '); ?> &euro;</td>
	        </tr>
	    </table>
	<?php
}
?>
</page>