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
    	<thead>
	        <tr>
	            <th style="width: 30%; border: solid 1px black;">Banque</th>
	            <th style="width: 20%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Nom</th>
	            <th style="width: 20%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Prénom</th>
	            <th style="width: 15%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Montant</th>
	            <th style="width: 15%; border-right: solid 1px black; border-top: solid 1px black; border-bottom: solid 1px black;">Numéro</th>
	        </tr>
        </thead>
    	<tbody>
<?php
$lTotal = 0;
foreach($lOperations as $lLigne) {	
	?>
	        <tr>
	            <td style="width: 30%; text-align: left; border-right: solid 1px black; border-left: solid 1px black; border-bottom: solid 1px black;"><?php echo $lLigne->getBanque(); ?></td>
	            <td style="width: 20%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo $lLigne->getNom(); ?></td>
	            <td style="width: 20%; text-align: left; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo $lLigne->getPrenom(); ?></td>
	            <td style="width: 15%; text-align: right; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo number_format($lLigne->getMontant(), 2, ',', ' '); ?> &euro;</td>
	            <td style="width: 15%; text-align: right; border-right: solid 1px black; border-bottom: solid 1px black;"><?php echo $lLigne->getNumero(); ?></td>
	        </tr>
	   
	<?php
}
?>
		</tbody>
	</table>
</page>