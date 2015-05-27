SET CLIENT_ENCODING TO UTF8;
SET STANDARD_CONFORMING_STRINGS TO ON;
BEGIN;
CREATE TABLE "utiliteitsnet" (gid serial,
"id" numeric(10,0),
"thema" varchar(40),
"eisvoorhp" varchar(254),
"tcontpers" varchar(40),
"telefoon" varchar(40),
"email" varchar(40),
"authority" varchar(40),
"authrole" varchar(40),
"unetworkty" varchar(40));
ALTER TABLE "utiliteitsnet" ADD PRIMARY KEY (gid);
SELECT AddGeometryColumn('','utiliteitsnet','geom','28992','POINT',2);
INSERT INTO "utiliteitsnet" ("id","thema","eisvoorhp","tcontpers","telefoon","email","authority","authrole","unetworkty",geom) VALUES (NULL,'riool',NULL,NULL,NULL,NULL,NULL,'beheerder','sewer','010100002040710000308BFC1AD7DD02416194C67187C41741');
select * from utiliteitsnet;
