function MonCompteTemplate(){this.detailReservation='<div id="contenu"><div class="com-widget-window ui-widget ui-widget-content ui-corner-all"><div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Commandes n°{comNumero}</div><div>Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}</div></div><div class="com-widget-window ui-widget ui-widget-content ui-corner-all"><div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Ma Commande</div><table class="com-table"><!-- BEGIN reservation --><tr ><td class="com-table-td">{reservation.nproNom}</td><td class="com-table-td">{reservation.stoQuantite}</td><td>{reservation.proUniteMesure}</td><td class="com-table-td">{reservation.prix}</td><td>{sigleMonetaire}</td></tr><!-- END reservation --><tr><td class="com-table-td" colspan="3">Total : </td><td class="com-table-td">{total}</td><td class="com-table-td">{sigleMonetaire}</td></tr></table></div><div class="boutons-edition com-widget-header ui-widget ui-widget-header ui-corner-all com-center"><button class="ui-state-default ui-corner-all com-button com-center" id="btn-modifier">Modifier</button><button class="ui-helper-hidden ui-state-default ui-corner-all com-button com-center">Supprimer</button></div></div>';this.modifierReservation='<div id="contenu"><div class="com-widget-window ui-widget ui-widget-content ui-corner-all"><div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Commandes n°{comNumero}</div><div>Fin des réservations : Le {dateFinReservation} à {heureFinReservation}H{minuteFinReservation} <br/>Marché : Le {dateMarcheDebut} de {heureMarcheDebut}H{minuteMarcheDebut} à {heureMarcheFin}H{minuteMarcheFin}</div></div><div class="com-widget-window ui-widget ui-widget-content ui-corner-all"><div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Ma Commande</div><div><table class="com-table"><!-- BEGIN produit --><tr class="pdt" id="pdt-{produit.proId}"><td><input type="checkbox" {produit.checked}/></td><td><span class="ui-helper-hidden"><span class="pdt-id">{produit.proId}</span></span></td><td colspan="5">{produit.nproNom}</td><td><span>{produit.proMaxProduitCommande}</span> <span>{produit.proUniteMesure}</span> Max</td><td colspan="3"></td></tr><!-- BEGIN produit.lot --><tr class="lot lot-pdt-{produit.proId}"><td><span class="ui-helper-hidden"><span class="pdt-id">{produit.proId}</span><span class="lot-id">{produit.lot.dcomId}</span></span></td><td><input type="radio" name="lot-produit-{produit.proId}" {produit.lot.checked}/></td><td>{produit.lot.dcomTaille}</td><td>{produit.proUniteMesure}</td><td>{produit.lot.dcomPrix}</td><td>{sigleMonetaire}</td><td><button class="btn-moins btn-pdt-{produit.proId}" id="btn-moins-lot-{produit.lot.dcomId}">-</button></td><td><span id="colonne-qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}" class="colonne-pdt-{produit.proId}"><span id="qte-pdt-{produit.proId}-lot-{produit.lot.dcomId}" class="qte">{produit.lot.stoQuantiteReservation}</span> <span>{produit.proUniteMesure}</span></span></td><td><button class="btn-plus btn-pdt-{produit.proId}" id="btn-plus-lot-{produit.lot.dcomId}">+</button></td><td><span id="colonne-prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}" class="colonne-pdt-{produit.proId}"><span id="prix-pdt-{produit.proId}-lot-{produit.lot.dcomId}">{produit.lot.prixReservation}</span></span></td><td><span id="colonne-sigle-pdt-{produit.proId}-lot-{produit.lot.dcomId}" class="colonne-pdt-{produit.proId}">{sigleMonetaire}</span></td></tr><!-- END produit.lot --><!-- END produit --><tr><td colspan="9">Total : </td><td><span id="total">{total}</span></td><td>{sigleMonetaire}</td></tr></table></div></div><div class="com-widget-header ui-widget ui-widget-header ui-corner-all com-center"><button class="ui-state-default ui-corner-all com-button com-center" id="btn-annuler">Annuler</button><button class="ui-state-default ui-corner-all com-button com-center" id="btn-valider">Valider</button></div></div>';this.listeReservation='<div id="contenu"><div class="com-widget-window ui-widget ui-widget-content ui-corner-all"><div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Mes Commandes</div><table class="com-table"><tr class="ui-widget ui-widget-header"><th class="com-table-th">Commande N°</th><th class="com-table-th">Date limite de Réservation</th><th class="com-table-th">Marché</th>	</tr><!-- BEGIN reservation --><tr class="com-cursor-pointer visualiser-reservation" id={reservation.idCommande} ><td class="com-table-td com-underline-hover">{reservation.numero}</td><td class="com-table-td com-underline-hover">Le {reservation.dateFinReservation} à {reservation.heureFinReservation}H{reservation.minuteFinReservation}</td><td class="com-table-td com-underline-hover">Le {reservation.dateMarcheDebut} de {reservation.heureMarcheDebut}H{reservation.minuteMarcheDebut} à {reservation.heureMarcheFin}H{reservation.minuteMarcheFin}</td></tr><!-- END reservation --></table></div><div class="ui-helper-hidden com-widget-header ui-widget ui-widget-header ui-corner-all com-center"><button class="ui-state-default ui-corner-all com-button com-center">Anciennes commandes</button></div></div>';this.listeReservationVide='<div id="contenu"><div class="com-widget-window ui-widget ui-widget-content ui-corner-all"><div class="com-widget-header ui-widget ui-widget-header ui-corner-all">Mes Commandes</div>Aucune réservation en cours.</div><div class="ui-helper-hidden com-widget-header ui-widget ui-widget-header ui-corner-all com-center"><button class="ui-state-default ui-corner-all com-button com-center">Anciennes commandes</button></div></div>'};