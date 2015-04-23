PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

load:
	shp2pgsql -d -I -W LATIN1  -s 28992  5meter_AanduidingEisVoorzorgsmaatregel.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  aanduidingEisVoorzorgsmaatregel.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Annotatie_lijn.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Annotatie.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  BGevaarlijkeInhoud.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Containerelement.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Diepte.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  DT_Kabelbed.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  DT_KabelOfLeiding.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  ExtraDetailInfo.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  ExtraGeometrie.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  ExtraTopo.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  HD_Gas_KabelOfLeiding.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  HS_KabelOfLeiding.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  kabelbedAlgemeen.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Kabelbed.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  KabelEnLeidingContainer.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Kunstwerk_Containerelement.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  LD_Gas_KabelOfLeiding.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Leidingelement.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  LS_Kabelbed.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  LS_KabelOfLeiding.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  maatvoering_label.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  maatvoering_pijl.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  maatvoering.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  MS_Kabelbed.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  MS_KabelOfLeiding.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  RioolVV_KabelOfLeiding.shp| psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Utiliteitsnet.shp | psql
	shp2pgsql -d -I -W LATIN1  -s 28992  Water_KabelOfLeiding.shp| psql

createdb:
	createdb imkl
	psql -c 'create extension postgis'

