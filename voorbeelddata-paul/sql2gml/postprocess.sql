alter table ms_kabelofleiding drop column if exists geometryid;
alter table ms_kabelofleiding add column geometryid text;
update ms_kabelofleiding set geometryid = 'geomkabelofleiding' || gid ;

alter table leidingelement drop column if exists geometryid;
alter table leidingelement add column geometryid text;
update leidingelement set geometryid = 'geomleidingelement' || gid ;

drop table if exists utilitylink;
create table utilitylink
as
    select gid,thema,geom,geometryid
    from ms_kabelofleiding
;

