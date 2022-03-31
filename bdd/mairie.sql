select "ppe_mairiev2" AS "Creation base de donnee";
drop database if exists ppe_mairiev2;
create database ppe_mairiev2; 
use ppe_mairiev2;




/*
 *              ______      __    __
 *             /_  __/___ _/ /_  / /__
 *              / / / __ `/ __ \/ / _ \
 *             / / / /_/ / /_/ / /  __/
 *            /_/  \__,_/_.___/_/\___/
 */



select "role" AS "Creation table";
create table role(
	idRole int(10) not null auto_increment,
	nomRole varchar(20) not null,
	primary key (idRole)
)engine=innodb, charset=utf8;

select "user" AS "Creation table";
create table user(
	idUser int(10) not null auto_increment, 
	emailUser varchar(50) not null unique,
	mdpUser varchar(255) not null,
	idRoleUser int(10) default 1,
	primary key (idUser),
	foreign key (idRoleUser) references role(idRole)
)engine=innodb, charset=utf8;

select "citoyen" AS "Creation table";
create table citoyen(
	idCit int(10) not null auto_increment,
	nomCit varchar(30) not null, 
	prenomCit varchar(30) not null, 
	sexeCit enum("Masculin", "Feminin"),
	dateNaissCit date not null,
	lieuNaissCit varchar(20) not null,
	cpLieuNaissCit varchar(5) not null,
	adresseCit varchar(25) not null,
	villeCit varchar(50) not null,
	cpCit varchar(5) not null, 
	situationFamilialeCit enum("Célibataire", "Marié(e)", "Divorcé(e)","Pacsé(e)"),
	emailCit varchar(50) not null unique,
	question varchar(255),
	reponse varchar(255),
  	primary key (idCit)
)engine=innodb, charset=utf8;

select "service" AS "Creation table";
create table service(
	idService int(3) not null auto_increment,
	nomService varchar(20) not null,
	primary key(idservice)
)engine=innodb, charset=utf8;

select "employe" AS "Creation table";
create table employe(
  	idEmploye int(10) not null auto_increment,
	nomEmploye varchar(25) not null,
	prenomEmploye varchar(25) not null, 
	emailEmploye varchar(50) not null unique,
	idServiceEmploye int(3) not null,
	primary key (idEmploye),
	foreign key (idServiceEmploye) references service(idService)
)engine=innodb, charset=utf8;

select "association" AS "Creation table";
create table association(
	idAssoc int(10) not null auto_increment,
	nomAssoc varchar (50) not null,
	adresseAssoc varchar(120) not null,
	cpAssoc varchar (12) not null,
	villeAssoc varchar (20) not null,
	telAssoc varchar(12) not null,
	primary key (idAssoc)
)engine=innodb, charset=utf8;

select "type_evenement" AS "Creation table";
create table type_evenement(
	codeTypeEve varchar(30) not null,
	nomtTypeEve varchar (255) not null,
	primary key (codetypeEve)
)engine=innodb, charset=utf8;

select "type_evenement_enfant" AS "Creation table";
create table type_evenement_enfant(
	codeTypeEve varchar(30) not null,
	nomTypeEve varchar (255) not null,
	trancheAgeMin int(5),
	trancheAgeMax int(5),
	accompagnant boolean,
	primary key (codeTypeEve)
)engine=innodb, charset=utf8;

select "type_evenement_adulte" AS "Creation table";
create table type_evenement_adulte(
	codeTypeEve varchar(30) not null,
	nomTypeEve varchar (255) not null,
	primary key (codeTypeEve)
)engine=innodb, charset=utf8;
    

select "evenement" AS "Creation table";
create table evenement(
	idEve int(10) not null auto_increment, 
	nomEve varchar (100) not null,
	contenuEve varchar (255) not null,
	adresseEve varchar (50) not null,
	debutEve date not null, 
	finEve date not null,
	dateFinInscriptionEve date not null,
	nbParticipantMaxEve int(5),
	codeTypeEve varchar(30) not null,
	idAssocEve int(10) not null,
	primary key (idEve), 
	foreign key (codeTypeEve) references type_evenement(codeTypeEve),
	foreign key (idAssocEve) references association(idAssoc)
)engine=innodb, charset=utf8;

select "participer" AS "Creation table";
create table participer(
	idCit int(10) not null,
	idEve int(10) not null,
	dateDemande date not null,
	foreign key (idCit) references citoyen(idCit),
	foreign key (idEve) references evenement(idEve),
	primary key (idCit,idEve)
)engine=innodb, charset=utf8;

select "type_demande" AS "Creation table";
create table type_demande(
	idTypeDem int(2) not null auto_increment, 
	nomTypeDem varchar(100) not null, 
	etrePlurielDem boolean,
	primary key (idTypeDem)
)engine=innodb, charset=utf8;

select "demande_mono" AS "Creation table";
create table demande_mono(
	idDemande int(6) not null auto_increment, 
	dateDemande date not null, 
	dateRep date, 
	etat enum("En cours de traitement","Demande acceptée","Demande refusée") default "En cours de traitement", 
	idCit int(10) not null,
	idTypeDem int(2) not null,
	idEmploye int(10),
	primary key (idDemande), 
	foreign key (idCit) references citoyen(idCit),
	foreign key (idTypeDem) references type_demande(idTypeDem),
	foreign key (idEmploye) references employe(idEmploye)
)engine=innodb, charset=utf8;

select "demande_pluriel" AS "Creation table";
create table demande_pluriel(
	idDemande int(6) not null auto_increment, 
	dateDemande date not null,
	dateRep date,
	idCit1 int(10) not null,
	idCit2 int(10) not null,
	idEmploye int(10),
	idTypeDem int(2) not null,
	etat enum("En cours de traitement", "Demande acceptée", "Demande refusée") default "En cours de traitement", 
	primary key (idDemande,idCit1,idCit2,dateDemande),
	foreign key (idCit1) references citoyen(idCit),
	foreign key (idCit2) references citoyen(idCit),
	foreign key (idTypeDem) references type_demande(idTypeDem),
	foreign key (idEmploye) references employe(idEmploye)
)engine=innodb, charset=utf8;

/*
 *         _    ___
 *        | |  / (_)__ _      __
 *        | | / / / _ \ | /| / /
 *        | |/ / /  __/ |/ |/ /
 *        |___/_/\___/|__/|__/
 */

select "gestion_demande_mono_view" AS "Creation view";
--View demande_mono
create view gestion_demande_mono_view (idDemande,typeD,etat,idCit,nomCit,prenomCit,emailCit,dateDemande,
dateRep, traiteePar)
as
select d.idDemande, t.nomTypeDem, d.etat,c.idCit, c.nomCit, c.prenomCit,c.emailCit,d.dateDemande,d.dateRep,
CONCAT( e.nomEmploye,' ',e.prenomEmploye)
as traitee_par
from demande_mono d
inner join citoyen c
on c.idCit = d.idCit
inner join type_demande t
on t.idTypeDem = d.idTypeDem
left join employe e
on d.idEmploye = e.idEmploye ;

select "gestion_demande_pluriel_view" AS "Creation view";
--View demande_pluriel
create view gestion_demande_pluriel_view (idDemande,typeDemande,etatDemande,idCit1,nomCit1,prenomCit1,emailCit1,idCit2,
nomCit2,prenomCit2,emailCit2,dateDemande,dateRep, traiteePar)
as
select d.idDemande, t.nomTypeDem, d.etat,d.idCit1,c1.nomCit,c1.prenomCit,c1.emailCit,
d.idCit2,c2.nomCit, c2.prenomCit,c2.emailCit,d.dateDemande,d.dateRep,
CONCAT( e.nomEmploye,' ',e.prenomEmploye) as traitee_par
from demande_pluriel d
inner join citoyen c1
on c1.idCit = d.idCit1
inner join citoyen c2
on c2.idCit = d.idCit2
inner join type_demande t
on t.idTypeDem = d.idTypeDem
left join employe e
on d.idEmploye = e.idEmploye ;

select "evenement_association_view" AS "Creation view";
--view affichier les evenements avec assoiciation (jointure)
create view evenement_association_view (idEve,nomEve,contenu,adresse,debutEve,
finEve,dateFinInscription,nbParticipantMax,association)
as
select e.idEve,e.nomEve,e.contenuEve,e.adresseEve,e.debutEve,e.finEve,e.dateFinInscriptionEve,e.nbParticipantMaxEve,
a.nomAssoc
from evenement e inner join association a
on e.idAssocEve = a.idAssoc;

select "evenement_enfant_view" AS "Creation view";
--view evenement_enfant
create view evenement_enfant_view as
select e.*,t.trancheAgeMin,t.trancheAgeMax,t.accompagnant from evenement e
inner join type_evenement_enfant t
on t.codeTypeEve = e.codeTypeEve;

select "participer_citoyen_evenement_view" AS "Creation view";
--view participer_evenement_citoyen
create view participer_citoyen_evenement_view as
select p.idCit,c.nomCit,c.prenomCit,e.nomEve,p.dateDemande
from participer p inner join citoyen c
on c.idCit = p.idCit
inner join evenement e
on e.idEve = p.idEve;

/*
 *              ______     _
 *             /_  __/____(_)___ _____ ____  _____
 *              / / / ___/ / __ `/ __ `/ _ \/ ___/
 *             / / / /  / / /_/ / /_/ /  __/ /
 *            /_/ /_/  /_/\__, /\__, /\___/_/
 *                       /____//____/
 */

select "ajout_evenement_enfant_trigger" AS "Creation trigger";
--Trigger insert type_evenement_enfant
drop trigger if exists ajout_evenement_enfant_trigger ;
delimiter //
create trigger ajout_evenement_enfant_trigger
before insert on type_evenement_enfant
for each row
begin
declare s int;
declare a int ;
select count(*) into a
from type_evenement
where codeTypeEve=new.codeTypeEve ;
if a=0
 then
    insert into type_evenement values (new.codeTypeEve ,new.nomTypeEve);
end if ;
select count(*) into s
from type_evenement_adulte
where codeTypeEve=new.codeTypeEve ;
  if s > 0
    then
       signal sqlstate '45000'
       set message_text='Ce code a été déjà utilisé';
  end if ;
end //
delimiter ;


select "ajout_evenement_adulte_trigger" AS "Creation trigger";
--Trigger insert type_evenementadult
drop trigger if exists ajout_evenement_adulte_trigger ;
delimiter //
create trigger ajout_evenement_adulte_trigger
before insert on type_evenement_adulte
for each row
begin
declare s int;
declare a int ;
select count(*) into a
from type_evenement
where codetypeEve=new.codetypeEve ;
if a=0
 then
    insert into type_evenement values (new.codetypeEve ,new.nomTypeEve);
end if ;
select count(*) into s
from type_evenement_enfant
where codetypeEve=new.codetypeEve ;
  if s > 0
    then
       signal sqlstate '45000'
       set message_text='Ce code a été déjà utilisé';
  end if ;
end //
delimiter ;

select "update_eve_enfant_trigger" AS "Creation trigger";
--trigger update Evenement type enfant
drop trigger if exists update_eve_enfant_trigger;
delimiter //
create trigger update_eve_enfant_trigger
 after update on type_evenement_enfant
 for each row
 begin
update type_evenement
	set nomTypeEve = new.nomTypeEve
	    where codetypeEve =old.codetypeEve;
end //
delimiter ;

select "update_eve_adulte_trigger" AS "Creation trigger";
--trigger update Evenement type adulte
drop trigger if exists update_eve_adulte_trigger;
delimiter //
create trigger update_eve_adulte_trigger
after update on type_evenement_adulte
for each row
begin
	update type_evenement
	set nomTypeEve = new.nomTypeEve
	    where codetypeEve =old.codetypeEve;
end //
delimiter ;

select "delete_evenement_enfant_trigger" AS "Creation trigger";
---trigger delete evenement type enfant
drop trigger if exists delete_evenement_enfant_trigger;
delimiter //
create trigger delete_evenement_enfant_trigger
 before delete on type_evenement_enfant
 for each row
 begin
 delete from type_evenement where codeTypeEve=old.codeTypeEve;
end //
delimiter ;

select "delete_evenement_adulte_trigger" AS "Creation trigger";
---trigger delete evenement type adulte
drop trigger if exists delete_evenement_adulte_trigger;
delimiter //
create trigger delete_evenement_adulte_trigger
 before delete on type_evenement_adulte
 for each row
 begin
 delete from type_evenement where codetypeEve=old.codetypeEve;
end //
delimiter ;




/*
 *            ____                     __
 *           /  _/___  ________  _____/ /_
 *           / // __ \/ ___/ _ \/ ___/ __/
 *         _/ // / / (__  )  __/ /  / /_
 *        /___/_/ /_/____/\___/_/   \__/
 */


select "role" AS "Insertion table ";
insert into role values (1,"user"),(2,"admin"),(3,"editor");

select "user" AS "Insertion table ";
insert into user values (null,"a@gmail.com","123",1),(null,"b@gmail.com","123",1);
insert into user values (null,"a@ville-ermont.fr","123",2),(null,"b@ville-ermont.fr","123",2);
insert into user values (null,"d@gmail.com","123",1);
insert into user values (null,"c@gmail.com","123",1);

select "service" AS "Insertion table";
insert into service values (null,"administration"),(null,"communication");

select "employe" AS "Insertion table";
insert into employe values (null,"Henry","Tom","a@ville-ermont.fr",1);
insert into employe values (null,"Alain","Nicolas","b@ville-ermont.fr",1);

select "association" AS "Insertion table";
insert into association values (null,"Mappy","73 Rue de Courcelles","75008","Paris","0198123645"),
(null,"DSD ORGANISATION ","102 bis Rue du Président Wilson","92300 ","Levallois-Perret","0198123645");

select "type_demande" AS "Insertion table";
insert into type_demande values (null,"acte de mariages",true),
(null,"acte de naissance",false),(null,"demande de passport",false),(null,"Pacs",true),(null,"Demande de divorce",true);
--test user participer evenement


select "citoyen" AS "Insertion table";
insert into citoyen values(null,"Louis","Gabirel","Masculin","2007-02-01","Paris","78000","rue des tulipes", "Paris",
"78000","Célibataire","d@gmail.com","ecoleprimaire","Nacelle");

insert into citoyen values
(null,"Helen","Jade","Feminin","2009-02-01","Paris","78000","rue des tulipes","Paris","78000","Célibataire","a@gmail.com","profpref","Sarah");

insert into citoyen values(null,"Jack","Tom","Feminin","2008-02-01","Paris","78000","rue des tulipes","Paris",
"78000","Célibataire","b@gmail.com","ecoleprimaire","Jeanmoulin");

insert into citoyen values
(null,"David","Gabirel","Masculin","1980-02-01","Paris","78000","rue des tulipes","Paris","78000","Célibataire","c@gmail.com","nommere","Helen");

update user set mdpUser=sha1(mdpUser);

select "type_evenement_enfant" AS "Insertion table";
insert into type_evenement_enfant values ("en123","sport-hiver",10,15,false);
insert into type_evenement_enfant values ("en124","musique-hiver",10,18,false);

select "type_evenement_adulte" AS "Insertion table";
insert into type_evenement_adulte values ("ad123","concert de musique");
insert into type_evenement_adulte values ("ad125","théatre");

select "evenement" AS "Insertion table";
insert into evenement values (null,"Le plateau omnisports","Cet espace, ouvert à tout type de glisse, est en accès libre. Chaque usager doit respecter le règlement affiché et être équipé des protections corporelles individuelles minimum le protégeant en cas de chute ou de collision.",
"l’école primaire Guyonnerie","2022-02-15","2022-02-17","2022-02-15",200,"en123",1);
insert into evenement values (null,"Le terrain stabilisé",
"Ce terrain peut accueillir un grand nombre d’entraînements et de rencontres amicales grâce à la présence de deux vestiaires.","l’école primaire Guyonnerie",
"2022-02-15","2022-02-17","2022-02-15",200,"en123",1);




create table sentinelleEvenement as
select *,sysdate() dateEnregistrer,user() userEve,'__________' action
from evenement
where 2=0 ;

alter table sentinelleEvenement add primary key(idEve,dateEnregistrer);

drop trigger if exists sentinelleEve_supp;
delimiter //
create trigger sentinelleEve_supp
before delete on evenement
for each row
begin
insert into sentinelleEvenement select *,sysdate(),user(),
'delete' from evenement where idEve=old.idEve;
end //
delimiter ;

drop trigger if exists sentinellevol_modif;
delimiter //
create trigger sentinellevol_modif
before update on evenement
for each row
begin
insert into sentinelleEvenement select *,sysdate(),user(),
'update' from evenement where idEve=old.idEve;
end //
delimiter ;

drop trigger if exists sentinelleEve_insert;
delimiter //
create trigger sentinelleEve_insert
after insert on evenement
for each row
begin
insert into sentinelleEvenement select *,sysdate(),user(),
'insert' from evenement where idEve=new.idEve;
end //
delimiter ;

--hachage question secrete et reponse
update citoyen set question=sha1(question) where idCit in (1,2,3,4);
update citoyen set reponse=sha1(reponse) where idCit in (1,2,3,4);