/* ne fonction qu'en MySQL 5.7*/

drop database if exists zenbanque ;
create database if not exists zenbanque;
use zenbanque;

/* tables de principales */
create table individus(id int primary key auto_increment, 
                    civilite char(3) not null, /* MME / M */
					nom_usage varchar(255) not null,
					nom_jeune_fille varchar(255),					
					prenom varchar(255) not null, 
					date_naissance date, 
					email varchar(50) not null,
					portable varchar(10),
					fixe varchar(10),
					adresse varchar(255), 
					code_postal int(5),
					ville varchar(255),
					mot_de_passe int(5)
					) engine=InnoDB default charset=UTF8;

create table agences(id int primary key auto_increment,
                    email varchar(255),
					departement int(2),
					code_agence int(5),
					code_banque int(5)
					)engine=InnoDB default charset=UTF8;
		
insert into agences(email, departement, code_agence, code_banque) values 
	('zenbanque94@gmail.com', 94, 94000, 17515), 
	('zenbanque75@gmail.com', 75, 75000, 17515),
    ('zenbanque93@gmail.com', 93, 93000, 17515),
    ('zenbanque91@gmail.com', 91, 91000, 17515);
					
create table comptes(numero_compte varchar(11) primary key,
					libelle varchar(255),                   
                    cle_rib int(2),
					type_compte char(1),/*C pour courant / E pour épargne*/					
                    agence_id int,
					individu_id int,                    
					foreign key (individu_id) references individus(id),
                    foreign key (agence_id) references agences(id)
					)engine=InnoDB default charset=UTF8; 
					
create table beneficiaires(id int primary key auto_increment, 
					libelle varchar(255),						
					individu_source_id int not null,
					individu_beneficiaire_id int not null,
					numero_compte_id varchar(11) not null,
					foreign key (individu_source_id) references individus(id),
					foreign key (individu_beneficiaire_id) references individus(id),
					foreign key (numero_compte_id) references comptes(numero_compte)
					)engine=InnoDB default charset=UTF8;											               

create table mouvements(id int primary key auto_increment,
					libelle varchar(255),
                    sens char(1), /* D/C */
                    montant numeric,
                    date_mouvement date,
                    type_mouvement varchar(10), /* CB/V/D/R */
					numero_compte_id varchar(11),                    
					foreign key (numero_compte_id) references comptes(numero_compte)
					)engine=InnoDB default charset=UTF8;

create table historisation(id int primary key auto_increment,
                    individu_id int,
					date_heure datetime,
                    modification varchar(255),
                    foreign key (individu_id) references individus(id)
					)engine=InnoDB default charset=UTF8;

/*
delimiter |
create or replace trigger historisation on individus for each row
   after update
declare
    var_modification varchar(255);
begin
    if old.nom <> new.nom then
        var_modification := new.nom;
    end if;
    
    call historisation(old.id, var_modification);
end |
delimiter;
*/
delimiter |
drop function if exists creation_compte|
create function creation_compte(
    in_individu_id integer, 
    in_departement_id int(2),
    in_libelle varchar(255),                   
    in_cle_rib int(2),
	in_type_compte char(1)/*C pour courant / E pour épargne*/					)
returns varchar(11)
begin
	declare	var_numero_compte_int bigint;
    declare	var_numero_compte_char varchar(11);
    declare var_agence_id int;
    /*
        La colonne numéro de compte est untype varchar de façon à avoir une longueur fixe car les int n'accepte pas les 0 devant
        On caste la colonne numero_compte pour faire un max+1 lors de la création de façon à avoir une gestion simplifiée de celui ci
    */
    select max(CAST(numero_compte AS UNSIGNED))+1 into var_numero_compte_int from comptes;
    if var_numero_compte_int = 1 or var_numero_compte_int is null then
        set var_numero_compte_char = '11111111111';     
    else
    	set var_numero_compte_char = CAST(var_numero_compte_int AS char(11));
    end if;        
    
    select id into var_agence_id from agences where departement = in_departement_id;
    /* 
        si le code postal n'existe pas dans la table des agences, on créé celle ci
    */
    if var_agence_id is null then
        insert into agences(email, departement, code_agence, code_banque) values (concat('zenbanque', in_departement_id, '@gmail.com'), in_departement_id, concat(in_departement_id, '000'), 17515);
        select id into var_agence_id from agences where departement = in_departement_id;
    end if;    
    
    /* création du compte */
    insert into comptes(numero_compte, libelle, cle_rib, type_compte, agence_id, individu_id) values (var_numero_compte_char, in_libelle, in_cle_rib, in_type_compte, var_agence_id, in_individu_id);
        
    /* historisation */
    call historisation(in_individu_id, concat('CREATION DU COMPTE ', var_numero_compte_char));
    
    return var_numero_compte_char;
end|

drop function if exists historisation|
create procedure historisation(
    IN in_individu_id int, 
    IN in_modification varchar(255))
begin
    insert into historisation(individu_id, date_heure, modification) values (in_individu_id, now(), in_modification);
end|

drop function if exists generation_mot_de_passe|
create function generation_mot_de_passe(
    in_individu_id int)
returns int
begin
    declare var_mot_de_passe int;

    select max(mot_de_passe)+1 
        into var_mot_de_passe
    from individus;
    /* on initialise le mot de passe sur 5 digits si il en existe pas encore en base*/
    IF var_mot_de_passe = 1 or var_mot_de_passe is null THEN
        set var_mot_de_passe = 12345;
    end if;
        
    /* historisation */
    call historisation(in_individu_id, 'NOUVEAU MOT DE PASSE');
    
    return var_mot_de_passe;
end|

drop function if exists creation_individu|
create function creation_individu(
    in_civilite char(3), /* MME / M */
    in_nom_usage varchar(255),
	in_nom_jeune_fille varchar(255),					
	in_prenom varchar(255), 
	in_date_naissance date, 
	in_email varchar(50),
	in_portable varchar(10),
	in_fixe varchar(10),
	in_adresse varchar(255), 
	in_code_postal int(5),
	in_ville varchar(255)
)
returns int
begin
	declare var_individu_id int;

    /* création de l'individu */
    insert into individus(civilite, nom_usage, nom_jeune_fille, prenom, date_naissance, email, portable, fixe, adresse, code_postal, ville)
        values (in_civilite, in_nom_usage, in_nom_jeune_fille, in_prenom, in_date_naissance, in_email, in_portable, in_fixe, in_adresse, in_code_postal, in_ville);
        
    select id into var_individu_id from individus where email = in_email;
    
    /* génération du mot de passe */
    update individus set
        mot_de_passe = generation_mot_de_passe(var_individu_id)
    where id = var_individu_id;
    
    /* création du compte courant */  
    begin    
        declare var_numero_compte varchar(11);
        select creation_compte(var_individu_id, left(in_code_postal, 2), 'Compte courant', 23, 'C') into var_numero_compte;    
        insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Offre de bienvennue', 'C', 100.00, CURDATE(), 'V', var_numero_compte);
    end;
        
    /* historisation */
    call historisation(var_individu_id, 'CREATION');
    
    return var_individu_id;
end|

/* INITIALISATION DES INDIVIDUS*/
select creation_individu('MME', 'CABOT', 'CABOT', 'Sandra', '1978-05-03', 'sandrac.cabot@gmail.com', null, null, 'avenue du général de gaulle', 94160, 'SAINT MANDE')|
select creation_individu('M', 'DUVERT', '', 'Alexandre', '1971-06-28', 'aduvert@noos.fr', null, null, '5 passage national', 75013, 'Paris 13')|
select creation_individu('M', 'MARTINEZ', '', 'Arnaud', '1974-09-12', 'amartinez@gmail.com', null, null, 'avenue Albert Perrault', 94370, 'Sucy en Brie')|
select creation_individu('M', 'ALI', '', 'Baba', '1971-06-28', 'ababa@hotmail.fr', null, null, '5 passage national', 92014, 'Nanterre')|

/* INITIALISATION DES MOUVEMENTS
*/

create or replace view v_listes_comptes
as select i.id as individu_id, 
    numero_compte, 
    code_agence, 
    code_banque, 
    cle_rib, 
    case when type_compte = 'E' then 'Compte épargne' else 'Compte courant' end as type_compte
from individus i
join comptes c on c.individu_id = i.id
join agences a on a.id = c.agence_id|

create or replace view v_soldes_comptes
as select lc.*, sum(montant) as solde
from v_listes_comptes lc
join mouvements m on m.numero_compte_id = lc.numero_compte
group by individu_id, numero_compte, code_agence, code_banque, cle_rib, type_compte|

/*create or replace view v_mouvements_comptes
as select lc.*, lc.*
from v_listes_comptes lc
join mouvements m on m.numero_compte_id = lc.numero_compte
group by individu_id, numero_compte, code_agence, code_banque, cle_rib, type_compte|*/
delimiter ;
