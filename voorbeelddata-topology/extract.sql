SET search_path TO enexis,public;

CREATE temporary SEQUENCE serial START 10000000;

create temporary table tempnodes
as
   select st_endpoint(geometry) as geometry,nextval('serial') as id
   from gasleiding_ligging
   union all
   select st_startpoint(geometry) as geometry,nextval('serial') as id
   from gasleiding_ligging
;

drop table if exists nodes;
create table nodes
(
    id bigint,
    geomtext text primary key,
    geometry Geometry(POINT,28992)
);

insert into nodes
    select
        min(id) as id,
	st_astext(geometry) as geomtext,
        st_setsrid(geometry,28992)::Geometry(POINT,28992) as geometry
    from tempnodes
    group by geometry
    having count(*) > 1;
;

alter table  gasleiding_ligging add column startnode bigint;
alter table  gasleiding_ligging add column endnode bigint;

update gasleiding_ligging g set startnode = (select id from nodes where geomtext = st_astext(st_startpoint(g.geometry)));
update gasleiding_ligging g set endnode = (select id from nodes where geomtext = st_astext(st_endpoint(g.geometry)));
