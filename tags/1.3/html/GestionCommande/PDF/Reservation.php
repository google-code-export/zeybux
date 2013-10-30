<page orientation="<?php echo $lOrientation;?>" >
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<thead >
			<tr >
				<th style="width: 55px; text-align: center; background: #E7E7E7; border: solid 1px black;" >Compte</th>
				<th style="width: 125px; text-align: center; background: #E7E7E7; border-top: solid 1px black; border-bottom: solid 1px black; border-right: solid 1px black;">Nom</th>
				<th style="width: 125px; text-align: center; background: #E7E7E7; border-top: solid 1px black; border-bottom: solid 1px black; border-right: solid 1px black;">Prénom</th>
				<th style="width: 95px; text-align: center; background: #E7E7E7; border-top: solid 1px black; border-bottom: solid 1px black; border-right: solid 1px black;">Tél.</th>
	<?php		
				$j = 0;
				while($j < $lNbProduitPage) {
					$lIdProduit = $lIdProduits[$i + $j];
					$lProduit = ProduitManager::select($lIdProduit);	
					$lNomProduit = NomProduitManager::select($lProduit->getIdNomProduit());
					$lLabelNomProduit = $lNomProduit->getNom();
					if($lProduit->getType() == 2) {
						$lLabelNomProduit .= " (Abonnement)";
					} ?>
				<th colspan="2" style="width: 80px; text-align: center; background: #E7E7E7; border-top: solid 1px black; border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLabelNomProduit; ?></th>
					
	<?php		
					$j++;
				} ?>
			</tr>
			<tr>
				<th style="border-bottom: solid 1px black; border-left: solid 1px black; border-right: solid 1px black;"></th>
				<th style="border-bottom: solid 1px black; border-right: solid 1px black;"></th>
				<th style="border-bottom: solid 1px black; border-right: solid 1px black;"></th>
				<th style="border-bottom: solid 1px black; border-right: solid 1px black;"></th>
	<?php		$j = 0;
				while($j < $lNbProduitPage) {?>
				<th style="width: 40px; text-align: center; background: #E7E7E7; border-bottom: solid 1px black; border-right: solid 1px black;">Prévu</th>
				<th style="width: 40px; text-align: center; background: #E7E7E7; border-bottom: solid 1px black; border-right: solid 1px black;">Réel</th>
	<?php 		
					$j++;
				} ?>
			</tr>
		</thead>
		<tbody>
	<?php 	foreach($lTableauReservation as $lIndice => $lLigneReservation) {?>
			<tr>
				<td style="border-bottom: solid 1px black; border-left: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation['compte']; ?></td>
				<td style="border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation['nom']; ?></td>
				<td style="border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation['prenom']; ?></td>
				<td style="border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation['telephonePrincipal']; ?></td>
			
	<?php	$j = 0;
			while($j < $lNbProduitPage) { 
				$lIdProduit = $lIdProduits[$i + $j]; ?>
				<td style="border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation[$lIdProduit]; ?></td>
				<td style="border-bottom: solid 1px black; border-right: solid 1px black;"></td>
	<?php	
				$j++;
			} ?>	
			</tr>
	<?php 	
			}
	?>	
		</tbody>
	</table>
</page>