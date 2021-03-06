/* Pré requis : MySQL 5.7*/

drop database if exists zenbanque ;
create database if not exists zenbanque;
use zenbanque;

/* Tables principales */

/* 
    Descriptions des tables :
    •	"individus" stocke les clients et leurs coordonnées
    •	"agences" stocke les agences, une par département
    •	"comptes" stocke les comptes courant ou épargne
    •	"beneficiaires" stocke les bénéficiaires des clients qui sont eux même des clients de l'agence
    •	"mouvements" stocke les mouvements effectués sur les comptes clients
    •	"historisation" stocke les connexions, création de compte, mouvements.... par individu
    •	"commandes_chequiers" stocke les commandes de chéquiers des clients
*/

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
					code_postal char(5),
					ville varchar(255),
					mot_de_passe int(5)
					) engine=InnoDB default charset=UTF8;

create table agences(id int primary key auto_increment,
					libelle varchar(50),
                    email varchar(255),
					departement char(2),
					code_agence char(5),
					code_banque int(5)
					)engine=InnoDB default charset=UTF8;

insert into agences(libelle, email, departement, code_agence, code_banque) values
	('Zen 94', 'zenbanque94@gmail.com', '94', '94000', 17515),
	('Zen 75', 'zenbanque75@gmail.com', '75', '75000', 17515),
    ('Zen 93', 'zenbanque93@gmail.com', '93', '93000', 17515),
    ('Zen 91', 'zenbanque91@gmail.com', '91', '91000', 17515);

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
                    modification text,
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

delimiter |
drop trigger if exists historisation|
create trigger historisation after update on individus for each row
begin
	declare libelle varchar(255);
	declare modif text;
	set libelle = 'Modifications - ';
	if old.adresse <> new.adresse and new.adresse is not null then
		set modif = new.adresse;
    end if;
	if old.portable <> new.portable then
		if new.portable is null or new.portable = '' then
			set modif = concat(modif, ' - Suppression du numéro de portable');
		else
			set modif = concat(modif, ' - ', new.portable);
		end if;
    end if;
	if old.code_postal <> new.code_postal and new.code_postal is not null then
		set modif = concat(modif, ' - ', new.code_postal);
    end if;
	if old.ville <> new.ville and new.ville is not null then
		set modif = concat(modif, ' - ', new.ville);
    end if;
	if old.fixe <> new.fixe then
		if new.fixe is null or new.fixe = '' then
			set modif = concat(modif, ' - Suppression du numéro de fixe');
		else
			set modif = concat(modif, ' - ', new.fixe);
		end if;
    end if;
	if modif is not null then
		insert into historisation(individu_id, date_heure, modification) values (old.id, now(), concat(libelle, modif));
	end if;
end|

/* CREATION DES FONCTIONS */

/*
    La fonction creation_compte() :
        •	Créé le compte courant ou le compte épargne 
        •	Alimente le compte courant avec 100 euros, 
        •	Crée l'agence associée à son département si celle-ci n'existe pas
        •	Historise la création du compte (function historisation())
*/
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
	declare var_departement char(2);
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

/*
    Fonction permettant l'historisation
*/
drop function if exists historisation|
create procedure historisation(
    IN in_individu_id int,
    IN in_modification varchar(255))
begin
    insert into historisation(individu_id, date_heure, modification) values (in_individu_id, now(), in_modification);
end|

/*
    La fonction generation_mot_de_passe() permet la génération du mot de passe du client et historise celle ci
*/
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

/* 
    La fonction creation_individu() :
    •	Crée l'individu, 
    •	Créé son compte courant et l'alimente avec 100 euros (function creation_compte()), 
    •	Génère le mot de passe (function generation_mot_de_passe())) de connexion
    •	Historise la création de l'individu (function historisation())
*/
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
	in_code_postal char(5),
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
        insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Offre de bienvenue', 'C', 100.00, CURDATE(), 'V', var_numero_compte);
    end;

    /* historisation */
    call historisation(var_individu_id, concat('Création client ', in_nom_usage, ' ' , in_prenom));

    return var_individu_id;
end|

/* 
    La fonction commande_chequiers() enregistre la demande de chéquier et fait le contrôle qui empêche la commande de plus de 2 chéquiers dans le mois 
*/
drop function if exists commande_chequiers|
create function commande_chequiers(
    in_individu_id int,
	in_num_compte varchar(11),
	in_nombre int
)
returns varchar(255)
begin
	declare nbr_chequier int;
    /* On Compte le nombre de chequier déjà commandé dans le mois */
	select count(nombre) into nbr_chequier
	from commandes_chequiers
	where individu_id = in_individu_id
	  and numero_compte_id = in_num_compte
	  and datediff(CURDATE(), date_commande) >= 0
      and datediff(CURDATE(), date_commande) <= 30;

	if (nbr_chequier > 2) then
		return "Nombre de chéquier maximum atteint";
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

/*
    La fonction demande_virement() enregistre la demande de virement et contrôle que l'on peut faire celui ci en prenant en compte le découvert autorisé de 500 euros
*/
drop function if exists demande_virement|
create function demande_virement(
    in_num_compte_source varchar(11),
	in_num_compte_dest varchar(11),
	in_montant double,
    in_date date,
    in_motif varchar(255)
)
returns varchar(255)
begin
	declare virement_ko boolean;

	select (solde - in_montant) < -500 into virement_ko
	from v_soldes_comptes
	where numero_compte = in_num_compte_source;

	if (virement_ko) then
		return "Le solde de votre compte n'est pas suffisant pour effectuer ce virement";
	else
        begin
            declare var_beneficiaire_nom varchar(255);
            declare var_source_nom varchar(255);
            declare id int;

            select concat(nom, ' ' , prenom) into var_beneficiaire_nom
            from individus i
            join comptes c on c.individu_id = i.id
            where numero_compte = in_num_compte_dest;

            select id, concat(nom, ' ' , prenom) into id, var_source_nom
            from individus i
            join comptes c on c.individu_id = i.id
            where numero_compte = in_num_compte_source;

            /*débit du compte source */
            insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values (in_motif, 'D', in_montant, in_date, 'V', in_num_compte_source);
            /* crédit du compte bénéficiaire */
            insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values (in_motif, 'C', in_montant, in_date, 'V', in_num_compte_dest);

            /* historisation */
            call historisation(id, concat('Virement de ', in_montant, ' - Motif ', in_motif));
        end;

        return "";
    end if;
end|

/* INITIALISATION DES INDIVIDUS*/
select creation_individu('MME', 'CABOT', 'CABOT', 'Sandra', '1978-05-03', 'scabot@hotmail.com', '0630215469', null, 'avenue du général de gaulle', '94160', 'SAINT MANDE')|
select creation_individu('M', 'DUVERT', '', 'Alexandre', '1971-06-28', 'aduvert@noos.fr', null, '0123654789', '5 passage national', '75013', 'Paris 13')|
select creation_individu('M', 'MARTINEZ', '', 'Arnaud', '1974-09-12', 'amartinez@gmail.com', '0632156987', null, 'avenue Albert Perrault', '94370', 'Sucy en Brie')|
select creation_individu('M', 'ALI', '', 'Baba', '1971-06-28', 'ababa@hotmail.fr', null, '0432569874', '5 passage national', '06100', 'Nice')|

/* INITIALISATION DES MOUVEMENTS*/
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Salaire', 'C', '3256.25', '2017-12-28', 'V', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('EDF', 'D', '95.60', '2017-12-29', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai1', 'D', '12', '2017-12-29', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai2', 'D', '50', '2017-12-19', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai3', 'D', '20', '2017-12-20', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai4', 'C', '12', '2017-12-22', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai5', 'D', '30', '2017-12-29', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai6', 'D', '30', '2017-12-29', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai7', 'D', '30', '2017-12-29', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai8', 'D', '30', '2017-12-29', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai9', 'D', '30', '2017-12-29', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai10', 'C', '300', '2017-12-29', 'P', '11111111111')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai11', 'D', '30', '2017-12-29', 'P', '11111111111')|

 /* INITIALISATION DES BENEFICIAIRES*/
insert into beneficiaires(libelle, individu_source_id, individu_beneficiaire_id, numero_compte_id) values ('Mon beneficiaire 1', 1, 2, '11111111112')|
insert into beneficiaires(libelle, individu_source_id, individu_beneficiaire_id, numero_compte_id) values ('Mon beneficiaire 2', 1, 3, '11111111113')|

/* Création de nouveauCompte Epargne + Ajout de lignes */
select creation_compte(1,'Compte Epargne','E')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai6', 'C', '120', '2017-12-22', 'P', '11111111115')|
insert into mouvements(libelle, sens, montant, date_mouvement, type_mouvement, numero_compte_id) values ('Opération essai7', 'D', '300', '2017-12-29', 'P', '11111111115')|


/* CREATION DES VUES */
create or replace view v_listes_comptes as
    select i.id as individu_id,
        c.numero_compte,
        a.code_agence,
        a.code_banque,
        c.cle_rib,
        c.type_compte,
        case when type_compte = 'E' then 'Compte épargne' else 'Compte courant' end as libelle_type_compte,
        a.libelle as libelle_agence
    from individus i
    join comptes c on c.individu_id = i.id
    join agences a on a.id = c.agence_id|

create or replace view v_soldes_comptes as
    select individu_id, numero_compte, code_agence, code_banque, cle_rib, type_compte, libelle_type_compte, libelle_agence, round(sum(montant),2) as solde
    from
        (select lc.*,  case when m.sens = 'C' then coalesce(montant, 0) else coalesce(concat('-', montant), 0) end as montant
        from v_listes_comptes lc
        left join mouvements m on m.numero_compte_id = lc.numero_compte
        ) q
    group by individu_id, numero_compte, code_agence, code_banque, cle_rib, type_compte
    order by individu_id, numero_compte|

create or replace view v_mouvements_comptes
    as select lc.individu_id, m.*
    from v_listes_comptes lc
    join mouvements m on m.numero_compte_id = lc.numero_compte
    order by m.numero_compte_id, m.date_mouvement, m.libelle desc|

/* vue utilisée afin de pouvoir faire des virements sur mes comptes ou mes beneficiaires */
create or replace view v_comptes_beneficiaires as
	select b.individu_beneficiaire_id, b.individu_source_id, b.libelle, c.numero_compte
	from beneficiaires b
    join comptes c on c.individu_id = b.individu_beneficiaire_id
    UNION ALL
    select i.id, i.id, concat('Mon compte ', c2.numero_compte), c2.numero_compte
    from individus i
    join comptes c2 on c2.individu_id = i.id
    where c2.type_compte = 'E'
    order by libelle|

delimiter ;
