/* ne fonction qu'en MySQL 5.7*/

drop database if exists zenbanque ;
create database if not exists zenbanque;
use zenbanque;

/* tables de principales */
create table individus(id int primary key auto_increment, 
                    civilite char(3) not null, /* MME / M */
					nom varchar(255) not null,
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
					libelle varchar(50),
                    email varchar(255),
					departement int(2),
					code_agence int(5),
					code_banque int(5)
					)engine=InnoDB default charset=UTF8;
		
insert into agences(libelle, email, departement, code_agence, code_banque) values 
	('Zen 94', 'zenbanque94@gmail.com', 94, 94000, 17515), 
	('Zen 75', 'zenbanque75@gmail.com', 75, 75000, 17515),
    ('Zen 93', 'zenbanque93@gmail.com', 93, 93000, 17515),
    ('Zen 91', 'zenbanque91@gmail.com', 91, 91000, 17515);
					
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
                    montant decimal(10,2),
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
					
create table commandes_chequiers(id int primary key auto_increment,
                    individu_id int,
					numero_compte_id varchar(11),
					date_commande date,
                    nombre int(1),
                    foreign key (individu_id) references individus(id),
					foreign key (numero_compte_id) references comptes(numero_compte)
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

/* CREATION DES FONCTIONS */
drop function if exists creation_compte|
create function creation_compte(
    in_individu_id integer, 
    in_libelle varchar(255),                   
	in_type_compte char(1)/*C pour courant / E pour épargne*/					)
returns varchar(11)
begin
	declare	var_numero_compte_int bigint;
    declare	var_numero_compte_char varchar(11);
    declare var_agence_id int;
	declare var_departement int;
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
    
	select left(code_postal, 2) into var_departement from individus where id = in_individu_id;
	select id into var_agence_id from agences where departement = var_departement;
	
    /* 
        si le code postal n'existe pas dans la table des agences, on créé celle ci
    */
    if var_agence_id is null then
        insert into agences(libelle, email, departement, code_agence, code_banque) values (concat('Zen ', var_departement), concat('zenbanque', var_departement, '@gmail.com'), var_departement, concat(var_departement, '000'), 17515);
        select id into var_agence_id from agences where departement = var_departement;
    end if;    
    
    /* création du compte */
	begin
		declare var_cle_rib int;
		if in_type_compte = 'C' then
			set var_cle_rib = 23;
		else
			set var_cle_rib = 25;
		end if;
		insert into comptes(numero_compte, libelle, cle_rib, type_compte, agence_id, individu_id) values (var_numero_compte_char, in_libelle, var_cle_rib, in_type_compte, var_agence_id, in_individu_id);
    end;
    
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
    insert into individus(civilite, nom, nom_jeune_fille, prenom, date_naissance, email, portable, fixe, adresse, code_postal, ville)
        values (in_civilite, in_nom_usage, in_nom_jeune_fille, in_prenom, in_date_naissance, in_email, in_portable, in_fixe, in_adresse, in_code_postal, in_ville);
        
    select id into var_individu_id from individus where email = in_email;
    
    /* génération du mot de passe */
    update individus set
        mot_de_passe = generation_mot_de_passe(var_individu_id)
    where id = var_individu_id;
    
    /* création du compte courant */  
    begin    
        declare var_numero_compte varchar(11);
        select creation_compte(var_individu_id, 'Compte courant', 'C') into var_numero_compte;    
        insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Offre de bienvennue', 'C', 100.00, CURDATE(), 'V', var_numero_compte);
    end;
        
    /* historisation */
    call historisation(var_individu_id, 'CREATION');
    
    return var_individu_id;
end|

drop function if exists commande_chequiers|
create function commande_chequiers(
    in_individu_id int,
	in_num_compte varchar(11),
	in_nombre int
)
returns varchar(255)
begin
	declare nbr_chequier int;
	
	select count(nombre) into nbr_chequier 
	from commandes_chequiers 
	where individu_id = in_individu_id
	  and numero_compte_id = in_num_compte
	  and datediff(CURDATE(), date_commande) >= 30;
	
	if (nbr_chequier > 2) then
		return "Nombre de chéquier maximum atteind";	
	elseif (in_nombre + nbr_chequier > 2) then
		return "Le nombre de chéquier maximum commandé est dépassé.";
	else
        /* création de la commande */
        insert into commandes_chequiers(individu_id, numero_compte_id, date_commande, nombre) values (in_individu_id, in_num_compte, CURDATE(), in_nombre);

        /*On récupère l'ID de la table poru historisation*/
        BEGIN
            declare id int;
            select max(id) into id from commandes_chequiers;

            /* historisation */
            call historisation(id, concat('COMMANDE DE CHEQUIER : ', in_nombre));
        end;

        return "";
    end if;
end|

/* INITIALISATION DES INDIVIDUS*/
select creation_individu('MME', 'CABOT', 'CABOT', 'Sandra', '1978-05-03', 'scabot@hotmail.com', null, null, 'avenue du général de gaulle', 94160, 'SAINT MANDE')|
select creation_individu('M', 'DUVERT', '', 'Alexandre', '1971-06-28', 'aduvert@noos.fr', null, null, '5 passage national', 75013, 'Paris 13')|
select creation_individu('M', 'MARTINEZ', '', 'Arnaud', '1974-09-12', 'amartinez@gmail.com', null, null, 'avenue Albert Perrault', 94370, 'Sucy en Brie')|
select creation_individu('M', 'ALI', '', 'Baba', '1971-06-28', 'ababa@hotmail.fr', null, null, '5 passage national', 92014, 'Nanterre')|
/* INITIALISATION DES MOUVEMENTS*/
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Salaire', 'C', '3256.25', '2017-12-28', 'V', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('EDF', 'D', '95.60', '2017-12-29', 'P', '11111111111')|
 /* INITIALISATION DES BENEFICIAIRES*/
insert into beneficiaires(libelle, individu_source_id, individu_beneficiaire_id, numero_compte_id) values ('Mon beneficiaire 1', 1, 2, '11111111112')|
insert into beneficiaires(libelle, individu_source_id, individu_beneficiaire_id, numero_compte_id) values ('Mon beneficiaire 2', 1, 3, '11111111113')|

/* CREATION DES VUES */
create or replace view v_listes_comptes
as select i.id as individu_id, 
    c.numero_compte, 
    a.code_agence, 
    a.code_banque, 
    cle_rib, 
    case when type_compte = 'E' then 'Compte épargne' else 'Compte courant' end as type_compte,
	a.libelle as libelle_agence
from individus i
join comptes c on c.individu_id = i.id
join agences a on a.id = c.agence_id|

create or replace view v_soldes_comptes
as select lc.*,  coalesce(sum(montant), 0) as solde
from v_listes_comptes lc
left join mouvements m on m.numero_compte_id = lc.numero_compte
group by individu_id, numero_compte, code_agence, code_banque, cle_rib, type_compte|

create or replace view v_mouvements_comptes
as select lc.individu_id, m.*
from v_listes_comptes lc
join mouvements m on m.numero_compte_id = lc.numero_compte
order by m.numero_compte_id, m.date_mouvement desc|

create or replace view v_beneficiaires as
	select b.id, b.libelle, i2.nom, i2.prenom
	from beneficiaires b
	join individus i on i.id = b.individu_source_id
	join individus i2 on i2.id = b.individu_beneficiaire_id
    order by b.libelle, i2.nom, i2.prenom|
delimiter ;
