<page orientation="<?php echo $lOrientation;?>" backbottom="10mm">	
    <page_footer>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: right; width: 100%;">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<thead >
			<tr >
				<th style="width: 55px; text-align: center; border: solid 1px black;" >Compte</th>
				<th style="width: 125px; text-align: center; border-top: solid 1px black; border-bottom: solid 1px black; border-right: solid 1px black;">Nom</th>
				<th style="width: 125px; text-align: center; border-top: solid 1px black; border-bottom: solid 1px black; border-right: solid 1px black;">Prénom</th>
				<th style="width: 95px; text-align: center; border-top: solid 1px black; border-bottom: solid 1px black; border-right: solid 1px black;">Tél.</th>
	<?php		
				$lLots = array();
				$lNbLignePrixProduit = 0;
				$j = 0;
				while($j < $lNbProduitPage) {
					$lIdProduit = $lIdProduits[$i * $lLimitePaysage  + $j];
					$lProduits = ProduitManager::selectDetailProduits(array($lIdProduit));
					$lProduit = $lProduits[0];
					
					$lLots[$lIdProduit] = DetailCommandeManager::selectByIdProduit($lIdProduit);
					
					$lnbLignePrix = count($lLots[$lIdProduit]);
					if($lNbLignePrixProduit < $lnbLignePrix) {
						$lNbLignePrixProduit = $lnbLignePrix;
					}
					
					$lLabelNomProduit = $lProduit->getNproNom();
					if($lProduit->getProType() == 2) {
						$lLabelNomProduit .= " (Abonnement)";
					} ?>
				<th colspan="2" style="width: 80px; text-align: center; border-top: solid 1px black; border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLabelNomProduit; ?></th>
					
	<?php		
					$j++;
				} ?>
			</tr>
			
			
	<?php 
			for($n = 0; $n < $lNbLignePrixProduit; $n++) {
	?>		
			<tr>
				<th style="width: 55px; border-bottom: solid 1px black; border-left: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 125px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 125px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 95px; text-align: right; border-bottom: solid 1px black; border-right: solid 1px black;">
	<?php 
				if( $n == 0) {?>
					Prix&nbsp;	
	<?php 		}
	
	?>			
				</th>
	<?php		$j = 0;
				while($j < $lNbProduitPage) {
					$lIdProduit = $lIdProduits[$i * $lLimitePaysage + $j];
				?>
				
				<th colspan="2" style="width: 80px; text-align: center; border-bottom: solid 1px black; border-right: solid 1px black;">
	<?php 
					if(isset($lLots[$lIdProduit][$n])) {
						echo number_format($lLots[$lIdProduit][$n]->getTaille(), 2, ',', ' ') . " : " . number_format($lLots[$lIdProduit][$n]->getPrix(), 2, ',', ' ') . " &euro;";
					}
	?>						
				</th>
	<?php 		
					$j++;
				} ?>
			</tr>
	<?php 		
			}
	?>
			
			
			<tr>
				<th style="width: 55px; border-bottom: solid 1px black; border-left: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 125px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 125px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 95px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
	<?php		$j = 0;
				while($j < $lNbProduitPage) {?>
				<th style="width: 40px; text-align: center; border-bottom: solid 1px black; border-right: solid 1px black;">Prévu</th>
				<th style="width: 40px; text-align: center; border-bottom: solid 1px black; border-right: solid 1px black;">Réel</th>
	<?php 		
					$j++;
				} ?>
			</tr>
			<tr>
				<th style="width: 55px; border-bottom: solid 1px black; border-left: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 125px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 125px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
				<th style="width: 95px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
	<?php		$j = 0;
				while($j < $lNbProduitPage) {
					$lIdProduit = $lIdProduits[$i * $lLimitePaysage + $j];
					$lQuantite = '';
					if(isset($lQuantiteReservation[$lIdProduit])) {
						$lQuantite = $lQuantiteReservation[$lIdProduit];
					}
?>
				<th style="width: 40px; text-align: center; border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lQuantite; ?></th>
				<th style="width: 40px; border-bottom: solid 1px black; border-right: solid 1px black;"></th>
	<?php 		
					$j++;
				} ?>
			</tr>			
		</thead>
		<tbody>
	<?php 	foreach($lTableauReservation as $lIndice => $lLigneReservation) {?>
			<tr>
				<td style="width: 55px; border-bottom: solid 1px black; border-left: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation['compte']; ?></td>
				<td style="width: 125px; border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation['nom']; ?></td>
				<td style="width: 125px; border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation['prenom']; ?></td>
				<td style="width: 95px; border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation['telephonePrincipal']; ?></td>
			
	<?php	$j = 0;
			while($j < $lNbProduitPage) {				
				$lIdProduit = $lIdProduits[$i * $lLimitePaysage + $j]; ?>
				<td style="width: 40px; text-align: center; border-bottom: solid 1px black; border-right: solid 1px black;"><?php echo $lLigneReservation[$lIdProduit]; ?></td>
				<td style="width: 40px; border-bottom: solid 1px black; border-right: solid 1px black;"></td>
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