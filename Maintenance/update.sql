INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_label_champ_complementaire` ,
`tpp_visible`
)
VALUES (
NULL , 'Virement Solidaire (émission)', '1', 'Id compte reception', '0'
);

INSERT INTO `tpp_type_paiement` (
`tpp_id` ,
`tpp_type` ,
`tpp_champ_complementaire` ,
`tpp_label_champ_complementaire` ,
`tpp_visible`
)
VALUES (
NULL , 'Virement Solidaire (réception)', '1', 'Id compte émission', '0'
);