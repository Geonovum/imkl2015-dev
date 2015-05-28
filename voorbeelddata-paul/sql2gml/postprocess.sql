-- First merge some tables
--
-- hs_kabelofleiding hs_kabelofleiding hs_kabelofleiding --> elektriciteitskabel
-- 
drop table if exists elektriciteitskabel cascade;
create table elektriciteitskabel
as
   select 
	'hs' || gid as gid,
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
	'ls' || gid as gid,
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
	'ms' || gid as gid,
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
drop table if exists oliegaschemicalien cascade;
create table oliegaschemicalien
as
    select
	 'hd' || gid as gid,
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
	 'ld' || gid as gid,
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
	 'bgv' || gid as gid,
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


update kabelbed set ductwidth = '0.0' where ductwidth is null ;
update rioolvv_kabelofleiding set pipediam = '0.0' where pipediam is null ;
update rioolvv_kabelofleiding set pressure = '0.0' where pressure is null ;
update oliegaschemicalien set pipediam = '0.0' where pipediam is null ;
update water_kabelofleiding  set pipediam = '0.0' where pipediam is null ;
update elektriciteitskabel set nomvolt = '0.0' where nomvolt is null;
update elektriciteitskabel set opvolt = '0.0' where opvolt is null;

update oliegaschemicalien set pipediam = '0.0' where pipediam is null ;
update oliegaschemicalien set pressure = '0.0' where pressure is null ;

update water_kabelofleiding set pressure = '0.0' where pressure is null ;
update water_kabelofleiding set pipediam = '0.0' where pressure is null ;

update diepte set nauwk = '0.0' where nauwk is null ;
--
-- Now we have the following tables left...
--

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
-- KabelEnLeidingContainer
-- Kunstwerk_Containerelement
-- Leidingelement
-- maatvoering_label
-- maatvoering_lijn
-- maatvoering_pijl
-- RioolVV_KabelOfLeiding
-- Utiliteitsnet
-- Water_KabelOfLeiding
-- elektriciteitskabel
-- oliegaschemicalien
-- kabelbed

drop table v_aanduidingEisVoorzorgsmaatregel;
drop table v_Annotatie_lijn;
drop table v_Annotatie;
drop table v_BGevaarlijkeInhoud;
drop table v_Containerelement;
drop table v_Diepte;
drop table v_DT_KabelOfLeiding;
drop table v_ExtraDetailInfo;
drop table v_ExtraGeometrie;
drop table v_ExtraTopo;
drop table v_KabelEnLeidingContainer;
drop table v_Kunstwerk_Containerelement;
drop table v_Leidingelement;
drop table v_maatvoering_label;
drop table v_maatvoering_lijn;
drop table v_maatvoering_pijl;
drop table v_RioolVV_KabelOfLeiding;
drop table v_Water_KabelOfLeiding;
drop table v_elektriciteitskabel;
drop table v_oliegaschemicalien;
drop table v_kabelbed;

create table v_aanduidingEisVoorzorgsmaatregel                                          as select 'a-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from aanduidingEisVoorzorgsmaatregel                  l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_Annotatie_lijn                                                           as select 'b-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from Annotatie_lijn                                   l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_Annotatie                                                                as select 'c-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from Annotatie                                        l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_BGevaarlijkeInhoud                                                       as select 'd-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from BGevaarlijkeInhoud                               l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_Containerelement                                                         as select 'e-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from Containerelement                                 l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_Diepte                                                                   as select 'f-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from Diepte                                           l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_DT_KabelOfLeiding                                                        as select 'g-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from DT_KabelOfLeiding                                l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_ExtraDetailInfo                                                          as select 'h-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from ExtraDetailInfo                                  l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_ExtraGeometrie                                                           as select 'i-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from ExtraGeometrie                                   l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_ExtraTopo                                                                as select 'j-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from ExtraTopo                                        l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_KabelEnLeidingContainer                                                  as select 'l-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from KabelEnLeidingContainer                          l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_Kunstwerk_Containerelement                                               as select 'm-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from Kunstwerk_Containerelement                       l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_Leidingelement                                                           as select 'n-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from Leidingelement                                   l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_maatvoering_label                                                        as select 'p-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from maatvoering_label                                l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_maatvoering_lijn								as select 'k-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from maatvoering_lijn                                 l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_maatvoering_pijl                                                         as select 'q-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from maatvoering_pijl                                 l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_RioolVV_KabelOfLeiding                                                   as select 't-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from RioolVV_KabelOfLeiding                           l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_Water_KabelOfLeiding                                                     as select 'v-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from Water_KabelOfLeiding                             l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_elektriciteitskabel                                                      as select 'w-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from elektriciteitskabel                              l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_oliegaschemicalien                                                       as select 'x-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from oliegaschemicalien                               l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;
create table v_kabelbed                                                                 as select 'y-' || l.gid as gmlid, l.*,u.unetid,u.bhcode from kabelbed                                         l,utiliteitsnet u where u.thema = l.thema and u.authority = l.netbeheer;

--
-- Create a table of parties from the utilitynetworks
--
drop table if exists relatedparty cascade;
create table relatedparty
as
    select 'party-' || unetid as partyid,authority,authrole
    from utiliteitsnet
    ;


--
-- The following tables need to be forked. They are two objects in the targed
-- schema.
-- 
drop table if exists utilitylink cascade;

create table utilitylink
as
    select 'ulinkid-' || gmlid as gmlid,bhcode,thema,netbeheer,unetid,geom,status::text
    from v_elektriciteitskabel
       union all
    select 'ulinkid-' || gmlid as gmlid,bhcode,thema,netbeheer,unetid,geom,status::text
    from v_rioolvv_kabelofleiding
       union all
    select 'ulinkid-' || gmlid as gmlid,bhcode,thema,netbeheer,unetid,geom,status::text
    from v_water_kabelofleiding
       union all
    select 'ulinkid-' || gmlid as gmlid,bhcode,thema,netbeheer,unetid,geom,status::text
    from v_oliegaschemicalien
       union all
    select 'ulinkid-' || gmlid as gmlid,bhcode,thema,netbeheer,unetid,geom,status::text
    from v_kabelbed
       union all
    select 'ulinkid-' || gmlid as gmlid,bhcode,thema,netbeheer,unetid,geom,status::text
    from v_kabelenleidingcontainer
       union all
    select 'ulinkid-' || gmlid as gmlid,bhcode,thema,netbeheer,unetid,geom,status::text
    from v_Kunstwerk_Containerelement
;
--create table utilitylink
--as select l.*,n.unetid,n.bhcode
--from t_utilitylink l,utiliteitsnet n where n.thema = l.thema and n.authority = l.netbeheer;


drop table if exists mangat;
create table mangat as select * from v_containerelement where type = 'mangat';
drop table if exists mast;
create table mast as select * from v_containerelement where type = 'mast';
drop table if exists geulmof;
create table geulmof as select * from v_containerelement where type = 'geulmof';





