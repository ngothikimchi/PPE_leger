--
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

---Gestion oublié mot de passe

