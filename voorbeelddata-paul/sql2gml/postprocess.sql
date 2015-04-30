alter table vijfmeteraanduiding drop column if exists gmlid;
alter table aanduidingEisVoorzorgsmaatregel drop column if exists gmlid;
alter table Annotatie_lijn drop column if exists gmlid;
alter table Annotatie drop column if exists gmlid;
alter table BGevaarlijkeInhoud drop column if exists gmlid;
alter table Containerelement drop column if exists gmlid;
alter table Diepte drop column if exists gmlid;
alter table DT_Kabelbed drop column if exists gmlid;
alter table DT_KabelOfLeiding drop column if exists gmlid;
alter table ExtraDetailInfo drop column if exists gmlid;
alter table ExtraGeometrie drop column if exists gmlid;
alter table ExtraTopo drop column if exists gmlid;
alter table HD_Gas_KabelOfLeiding drop column if exists gmlid;
alter table HS_KabelOfLeiding drop column if exists gmlid;
alter table kabelbedAlgemeen drop column if exists gmlid;
alter table Kabelbed drop column if exists gmlid;
alter table KabelEnLeidingContainer drop column if exists gmlid;
alter table Kunstwerk_Containerelement drop column if exists gmlid;
alter table LD_Gas_KabelOfLeiding drop column if exists gmlid;
alter table Leidingelement drop column if exists gmlid;
alter table LS_Kabelbed drop column if exists gmlid;
alter table LS_KabelOfLeiding drop column if exists gmlid;
alter table maatvoering_label drop column if exists gmlid;
alter table maatvoering_pijl drop column if exists gmlid;
alter table maatvoering drop column if exists gmlid;
alter table MS_Kabelbed drop column if exists gmlid;
alter table MS_KabelOfLeiding drop column if exists gmlid;
alter table RioolVV_KabelOfLeiding drop column if exists gmlid;
alter table Utiliteitsnet drop column if exists gmlid;
alter table Water_KabelOfLeiding drop column if exists gmlid;

alter table vijfmeteraanduiding add column gmlid text;
alter table aanduidingEisVoorzorgsmaatregel add column gmlid text;
alter table Annotatie_lijn add column gmlid text;
alter table Annotatie add column gmlid text;
alter table BGevaarlijkeInhoud add column gmlid text;
alter table Containerelement add column gmlid text;
alter table Diepte add column gmlid text;
alter table DT_Kabelbed add column gmlid text;
alter table DT_KabelOfLeiding add column gmlid text;
alter table ExtraDetailInfo add column gmlid text;
alter table ExtraGeometrie add column gmlid text;
alter table ExtraTopo add column gmlid text;
alter table HD_Gas_KabelOfLeiding add column gmlid text;
alter table HS_KabelOfLeiding add column gmlid text;
alter table kabelbedAlgemeen add column gmlid text;
alter table Kabelbed add column gmlid text;
alter table KabelEnLeidingContainer add column gmlid text;
alter table Kunstwerk_Containerelement add column gmlid text;
alter table LD_Gas_KabelOfLeiding add column gmlid text;
alter table Leidingelement add column gmlid text;
alter table LS_Kabelbed add column gmlid text;
alter table LS_KabelOfLeiding add column gmlid text;
alter table maatvoering_label add column gmlid text;
alter table maatvoering_pijl add column gmlid text;
alter table maatvoering add column gmlid text;
alter table MS_Kabelbed add column gmlid text;
alter table MS_KabelOfLeiding add column gmlid text;
alter table RioolVV_KabelOfLeiding add column gmlid text;
alter table Utiliteitsnet add column gmlid text;
alter table Water_KabelOfLeiding add column gmlid text;

update vijfmeteraanduiding set gmlid = 'a-' || gid;
update aanduidingEisVoorzorgsmaatregel set gmlid = 'a-' || gid;
update Annotatie_lijn set gmlid = 'b-' || gid;
update Annotatie set gmlid = 'c-' || gid;
update BGevaarlijkeInhoud set gmlid = 'd-' || gid;
update Containerelement set gmlid = 'e-' || gid;
update Diepte set gmlid = 'f-' || gid;
update DT_Kabelbed set gmlid = 'g-' || gid;
update DT_KabelOfLeiding set gmlid = 'h-' || gid;
update ExtraDetailInfo set gmlid = 'i-' || gid;
update ExtraGeometrie set gmlid = 'j-' || gid;
update ExtraTopo set gmlid = 'k-' || gid;
update HD_Gas_KabelOfLeiding set gmlid = 'l-' || gid;
update HS_KabelOfLeiding set gmlid = 'm-' || gid;
update kabelbedAlgemeen set gmlid = 'n-' || gid;
update Kabelbed set gmlid = 'o-' || gid;
update KabelEnLeidingContainer set gmlid = 'p-' || gid;
update Kunstwerk_Containerelement set gmlid = 'q-' || gid;
update LD_Gas_KabelOfLeiding set gmlid = 's-' || gid;
update Leidingelement set gmlid = 't-' || gid;
update LS_Kabelbed set gmlid = 'u-' || gid;
update LS_KabelOfLeiding set gmlid = 'v-' || gid;
update maatvoering_label set gmlid = 'w-' || gid;
update maatvoering_pijl set gmlid = 'x-' || gid;
update maatvoering set gmlid = 'maatvoering-' || gid;
update MS_Kabelbed set gmlid = 'mskabelb-' || gid;
update MS_KabelOfLeiding set gmlid = 'ms-' || gid;
update RioolVV_KabelOfLeiding set gmlid = 'rioolvv-' || gid;
update Utiliteitsnet set gmlid = 'unet-' || gid;
update Water_KabelOfLeiding set gmlid = 'water-' || gid;

-- First merge some tables
--
-- hs_kabelofleiding hs_kabelofleiding hs_kabelofleiding --> elektriciteitskabel
-- 
drop table if exists elektriciteitskabel;
create table elektriciteitskabel
as
   select 
	gmlid,
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
	geom
     from hs_kabelofleiding
   union all
   select
	gmlid,
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
	geom
      from ls_kabelofleiding
   union all
   select 
	gmlid,
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
	geom
       from ms_kabelofleiding
;

--
-- OlieGasChemicalien
-- 
drop table if exists oliegaschemicalien;
create table oliegaschemicalien
as
    select
	 gmlid,
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
	 gmlid,
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
	 gmlid,
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

--
--
--
drop table if exists kabelb;
create table kabelb
as
    select 
	 gmlid, 
	 id, 
	 thema, 
	 type, 
	 netbeheer, 
	 status, 
	 vertpositi, 
	 disttype, 
	 warningt, 
	 ductwidth, 
	 bzichtbaar, 
	 toelichtin, 
	 aantalk, 
	 dieptetovm, 
	 dieptenap, 
	 xinfo, 
	 geom
    from kabelbed
union all
    select 
	 gmlid, 
	 id, 
	 thema, 
	 type, 
	 netbeheer, 
	 status, 
	 vertpositi, 
	 disttype, 
	 warningt, 
	 ductwidth, 
	 bzichtbaar, 
	 toelichtin, 
	 aantalk, 
	 dieptetovm, 
	 dieptenap, 
	 xinfo, 
	 geom 
    from dt_kabelbed;


--
-- Now we have the following tables left...
--

-- vijfmeteraanduiding
-- aanduidingEisVoorzorgsmaatregel
-- Annotatie_lijn
-- Annotatie
-- BGevaarlijkeInhoud
-- Containerelement
-- Diepte
-- DT_KabelOfLeiding
-- ExtraDetailInfo
-- ExtraGeometrie
-- ExtraTopo
-- kabelbedAlgemeen
-- KabelEnLeidingContainer
-- Kunstwerk_Containerelement
-- Leidingelement
-- LS_Kabelbed
-- maatvoering_label
-- maatvoering_pijl
-- maatvoering
-- MS_Kabelbed
-- RioolVV_KabelOfLeiding
-- Utiliteitsnet
-- Water_KabelOfLeiding
-- elektriciteitskabel
-- oliegaschemicalien
-- kabelb

--
-- Now we fix that all objects have to refer to a utilitynet while they do refer
-- refer to the thema only.
-- 
alter table vijfmeteraanduiding add column unetid text;
alter table aanduidingEisVoorzorgsmaatregel add column unetid text;
alter table Annotatie_lijn add column unetid text;
alter table Annotatie add column unetid text;
alter table BGevaarlijkeInhoud add column unetid text;
alter table Containerelement add column unetid text;
alter table Diepte add column unetid text;
alter table DT_KabelOfLeiding add column unetid text;
alter table ExtraDetailInfo add column unetid text;
alter table ExtraGeometrie add column unetid text;
alter table ExtraTopo add column unetid text;
alter table kabelbedAlgemeen add column unetid text;
alter table KabelEnLeidingContainer add column unetid text;
alter table Kunstwerk_Containerelement add column unetid text;
alter table Leidingelement add column unetid text;
alter table LS_Kabelbed add column unetid text;
alter table maatvoering_label add column unetid text;
alter table maatvoering_pijl add column unetid text;
alter table maatvoering add column unetid text;
alter table MS_Kabelbed add column unetid text;
alter table RioolVV_KabelOfLeiding add column unetid text;
alter table Water_KabelOfLeiding add column unetid text;
alter table elektriciteitskabel add column unetid text;
alter table oliegaschemicalien add column unetid text;
alter table kabelb add column unetid text;

update vijfmeteraanduiding l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update aanduidingEisVoorzorgsmaatregel l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update Annotatie_lijn l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update Annotatie l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update BGevaarlijkeInhoud l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update Containerelement l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update Diepte l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update DT_KabelOfLeiding l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update ExtraDetailInfo l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update ExtraGeometrie l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update ExtraTopo l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update kabelbedAlgemeen l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update KabelEnLeidingContainer l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update Kunstwerk_Containerelement l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update Leidingelement l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update LS_Kabelbed l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update maatvoering_label l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update maatvoering_pijl l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update maatvoering l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update MS_Kabelbed l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update RioolVV_KabelOfLeiding l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update Water_KabelOfLeiding l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update elektriciteitskabel l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update oliegaschemicalien l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);
update kabelb l set unetid = (select gmlid from utiliteitsnet u where u.thema = l.thema);

--
-- The following tables need to be forked. They are two objects in the targed
-- schema.
-- 
drop table if exists utilitylink;
create table utilitylink
as
    select 'ulinkid-' || gmlid as gmlid,unetid,geom,status::text
    from elektriciteitskabel
       union all
    select 'ulinkid-' || gmlid as gmlid,unetid,geom,status::text
    from rioolvv_kabelofleiding
       union all
    select 'ulinkid-' || gmlid as gmlid,unetid,geom,status::text
    from water_kabelofleiding
       union all
    select 'ulinkid-' || gmlid as gmlid,unetid,geom,status::text
    from oliegaschemicalien
       union all
    select 'ulinkid-' || gmlid as gmlid,unetid,geom,status::text
    from kabelb
;

alter table water_kabelofleiding drop column if exists ulinkid;
alter table water_kabelofleiding add column ulinkid text;
update water_kabelofleiding set ulinkid = 'ulinkid-' || gmlid;

alter table rioolvv_kabelofleiding drop column if exists ulinkid;
alter table rioolvv_kabelofleiding add column ulinkid text;
update rioolvv_kabelofleiding set ulinkid = 'ulinkid-' || gmlid;

alter table elektriciteitskabel drop column if exists ulinkid;
alter table elektriciteitskabel add column ulinkid text;
update elektriciteitskabel set ulinkid = 'ulinkid-' || gmlid;

alter table oliegaschemicalien drop column if exists ulinkid;
alter table oliegaschemicalien add column ulinkid text;
update oliegaschemicalien set ulinkid = 'ulinkid-' || gmlid;


alter table kabelb drop column if exists ulinkid;
alter table kabelb add column ulinkid text;
update kabelb set ulinkid = 'ulinkid-' || gmlid;



update kabelb set ductwidth = '0.0' where ductwidth is null ;

update elektriciteitskabel set nomvolt = 0.0 where nomvolt is null;
update elektriciteitskabel set opvolt = 0.0 where opvolt is null;

update oliegaschemicalien set pipediam = '0.0' where pipediam is null ;
update oliegaschemicalien set pressure = '0.0' where pressure is null ;

update water_kabelofleiding set pressure = '0.0' where pressure is null ;
update water_kabelofleiding set pipediam = '0.0' where pressure is null ;
