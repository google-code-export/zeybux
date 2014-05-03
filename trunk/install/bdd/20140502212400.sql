ALTER TABLE `dope_detail_operation` ADD INDEX `id_operation` ( `dope_id_operation` ) COMMENT '';
ALTER TABLE `dope_detail_operation` ADD INDEX `id_detail_commande` ( `dope_id_detail_commande` ) COMMENT '';
ALTER TABLE `sto_stock` ADD INDEX `sto_id_operation` ( `sto_id_operation` ) COMMENT '';