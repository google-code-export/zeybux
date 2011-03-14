;function ProduitsBonDeLivraisonVR() {
	this.valid = true;
	this.log = new VRelement();
	this.id = new VRelement();
	this.id_commande = new VRelement();
	this.id_producteur = new VRelement();
	this.export_type = new VRelement();
	this.produits = new Array();
	this.typePaiement = new VRelement();
	this.total = new VRelement();
	this.typePaiementChampComplementaireObligatoire = new VRelement();
	this.typePaiementChampComplementaire = new VRelement();
}
