ALTER TABLE `dach_detail_achat` ADD PRIMARY KEY ( `dach_id_operation` , `dach_id_operation_solidaire` , `dach_id_nom_produit` ) ;
ALTER TABLE `dach_detail_achat` ADD INDEX ( `dach_id_stock` ) ;
ALTER TABLE `dach_detail_achat` ADD INDEX ( `dach_id_detail_operation` ) ;
ALTER TABLE `dach_detail_achat` ADD INDEX ( `dach_id_stock_solidaire` ) ;
ALTER TABLE `dach_detail_achat` ADD INDEX ( `dach_id_detail_operation_solidaire` ) ;