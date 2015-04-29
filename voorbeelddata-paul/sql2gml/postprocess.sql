--
-- Elektriciteitskabel
-- 
drop table if exists elektriciteitskabel;
create table elektriciteitskabel
as
   select 
	gid,
	id::text,
	thema::text,
	netbeheer::text,
	status::text,
	vertpositi::text,
	warningt::text,
	opvolt::text,
	nomvolt::text,
	toelichtin::text,
	dieptetovm::text,
	dieptenap::text,
	xinfo::text,
	disttype::text,
	geom,
	geometryid::text,
	linkid::text,
        'hs' || gid as gmlid
     from hs_kabelofleiding
   union all
   select
	gid,
	id::text,
	thema::text,
	netbeheer::text,
	status::text,
	vertpositi::text,
	warningt::text,
	opvolt::text,
	null::text,
	toelichtin::text,
	dieptetovm::text,
	dieptenap::text,
	xinfo::text,
	disttype::text,
	geom,
	geometryid::text,
	linkid::text,
        'ls' || gid as gmlid
      from ls_kabelofleiding
   union all
   select 
	gid,
	id::text,
	thema::text,
	netbeheer::text,
	status::text,
	vertpositi::text,
	warningt::text,
	opvolt::text,
	nomvolt::text,
	toelichtin::text,
	dieptetovm::text,
	dieptenap::text,
	xinfo::text,
	disttype::text,
	geom,
	geometryid::text,
	linkid::text,
       'ms' || gid as gmlid
       from ms_kabelofleiding
;

alter table elektriciteitskabel drop column if exists linkid;
alter table elektriciteitskabel add column linkid text;
update elektriciteitskabel set linkid = 'hs_kabel0fleiding-' || gid ;

update elektriciteitskabel 
   set nomvolt = 0.0 where nomvolt is null;
update elektriciteitskabel 
   set opvolt = 0.0 where opvolt is null;

--
-- OlieGasChemicalien
-- 
drop table if exists oliegaschemicalien;
create table oliegaschemicalien
as
    select
	 gid,
	 id,
	 thema,
	 netbeheer,
	 status,
	 vertpositi,
	 disttype,
	 warningt,
	 pipediam::text,
	 pressure,
	 producttyp,
	 toelichtin,
	 dieptetovm,
	 dieptenap,
	 xinfo,
	 geom
    from hd_gas_kabelofleiding
    union all
    select
	 gid,
	 id,
	 thema,
	 netbeheer,
	 status,
	 vertpositi,
	 disttype,
	 warningt,
	 pipediam::text,
	 pressure,
	 producttyp,
	 toelichtin,
	 dieptetovm,
	 dieptenap,
	 xinfo,
	 geom
    from ld_gas_kabelofleiding
    union all
    select
	 gid,
	 id,
	 thema,
	 netbeheer,
	 status,
	 vertpositi,
	 disttype,
	 warningt,
	 pipediam::text,
	 pressure,
	 producttyp,
	 toelichtin,
	 dieptetovm,
	 dieptenap,
	 xinfo,
	 geom
    from bgevaarlijkeinhoud
;
alter table oliegaschemicalien drop column if exists linkid;
alter table oliegaschemicalien add column linkid text;
update oliegaschemicalien set linkid = 'oliegas-' || gid ;
update oliegaschemicalien set pipediam = '0.0' where pipediam is null ;
update oliegaschemicalien set pressure = '0.0' where pressure is null ;


--
--
--
drop table if exists kabelb;
create table kabelb
as
    select 
	 gid        , 
	 id         , 
	 thema      , 
	 type       , 
	 netbeheer  , 
	 status     , 
	 vertpositi , 
	 disttype   , 
	 warningt   , 
	 ductwidth  , 
	 bzichtbaar , 
	 toelichtin , 
	 aantalk    , 
	 dieptetovm , 
	 dieptenap  , 
	 xinfo      , 
	 geom
    from kabelbed
union all
    select 
	 gid        , 
	 id         , 
	 thema      , 
	 type       , 
	 netbeheer  , 
	 status     , 
	 vertpositi , 
	 disttype   , 
	 warningt   , 
	 ductwidth  , 
	 bzichtbaar , 
	 toelichtin , 
	 aantalk    , 
	 dieptetovm , 
	 dieptenap  , 
	 xinfo      , 
	 geom 
    from dt_kabelbed;


alter table kabelb drop column if exists linkid;
alter table kabelb add column linkid text;
update kabelb set linkid = 'kabelbed-' || gid ;






alter table rioolvv_kabelofleiding drop column if exists linkid;
alter table rioolvv_kabelofleiding add column linkid text;
update rioolvv_kabelofleiding set linkid = 'rioolvv_kabelofleiding' || gid ;

alter table water_kabelofleiding drop column if exists linkid;
alter table water_kabelofleiding add column linkid text;
update water_kabelofleiding set linkid = 'water_kabelofleiding' || gid ;

alter table leidingelement drop column if exists linkid;
alter table leidingelement add column linkid text;
update leidingelement set linkid = 'leidingelement' || gid ;

alter table leidingelement add column unetid text;
update leidingelement l
   set unetid = 'unetid-' || (select gid from utiliteitsnet u where u.thema = l.thema);

drop table if exists utilitylink;
create table utilitylink
as
    select gid,thema,geom,linkid,status::text
    from elektriciteitskabel
       union all
    select gid,thema,geom,linkid,status::text
    from rioolvv_kabelofleiding
       union all
    select gid,thema,geom,linkid,status::text
    from water_kabelofleiding
;
