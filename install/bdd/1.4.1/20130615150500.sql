insert into opecp_operation_champ_complementaire 
select ope_id, 3,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 2;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 2;

insert into opecp_operation_champ_complementaire 
select ope_id, 2,
ope_id_banque
from ope_operation
where ope_type_paiement = 2;

insert into opecp_operation_champ_complementaire 
select ope_id, 4,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 3;

insert into opecp_operation_champ_complementaire 
select ope_id, 5,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 4;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 1;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 5;

insert into opecp_operation_champ_complementaire 
select ope_id, 6,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 5;

insert into opecp_operation_champ_complementaire 
select ope_id, 7,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 6;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 6;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 7;

insert into opecp_operation_champ_complementaire 
select ope_id, 8,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 7;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 8;

insert into opecp_operation_champ_complementaire 
select ope_id, 8,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 8;

insert into opecp_operation_champ_complementaire 
select ope_id, 4,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 9;

insert into opecp_operation_champ_complementaire 
select ope_id, 5,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 10;

insert into opecp_operation_champ_complementaire 
select ope_id, 4,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 11;

insert into opecp_operation_champ_complementaire 
select ope_id, 5,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 12;

insert into opecp_operation_champ_complementaire 
select ope_id, 4,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 13;

insert into opecp_operation_champ_complementaire 
select ope_id, 5,
ope_type_paiement_champ_complementaire
from ope_operation
where ope_type_paiement = 14;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 15;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 16;

insert into opecp_operation_champ_complementaire 
select ope_id, 1,
ope_id_commande
from ope_operation
where ope_type_paiement = 0;

UPDATE `tpp_type_paiement` SET `tpp_type` = 'Création de compte' WHERE `tpp_type_paiement`.`tpp_id` = -1;