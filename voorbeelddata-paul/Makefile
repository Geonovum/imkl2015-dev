PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

load:
	shp2pgsql -d -I  -s 4326 5meter_AanduidingEisVoorzorgsmaatregel.shp | psql
	shp2pgsql -d -I  -s 4326 5meter_AanduidingEisVoorzorgsmaatregel.shp| psql
	shp2pgsql -d -I  -s 4326 BGevaarlijkeInhoud.shp| psql
	shp2pgsql -d -I  -s 4326 Containerelement.shp| psql
	shp2pgsql -d -I  -s 4326 DT_KabelOfLeiding.shp| psql
	shp2pgsql -d -I  -s 4326 DT_Kabelbed.shp| psql
	shp2pgsql -d -I  -s 4326 Diepte.shp| psql
	shp2pgsql -d -I  -s 4326 ExtraGeometrie.shp| psql
	shp2pgsql -d -I  -s 4326 HD_Gas_KabelOfLeiding.shp| psql
	shp2pgsql -d -I  -s 4326 HS_KabelOfLeiding.shp| psql
	shp2pgsql -d -I  -s 4326 KabelEnLeidingContainer.shp| psql
	shp2pgsql -d -I  -s 4326 Kabelbed.shp| psql
	shp2pgsql -d -I  -s 4326 Kunstwerk_Containerelement.shp| psql
	shp2pgsql -d -I  -s 4326 LD_Gas_KabelOfLeiding.shp| psql
	shp2pgsql -d -I  -s 4326 LS_KabelOfLeiding.shp| psql
	shp2pgsql -d -I  -s 4326 LS_Kabelbed.shp| psql
	shp2pgsql -d -I  -s 4326 Leidingelement.shp| psql
	shp2pgsql -d -I  -s 4326 MS_KabelOfLeiding.shp| psql
	shp2pgsql -d -I  -s 4326 MS_Kabelbed.shp| psql
	shp2pgsql -d -I  -s 4326 RioolVV_KabelOfLeiding.shp| psql
	shp2pgsql -d -I  -s 4326 Water_KabelOfLeiding.shp| psql
	shp2pgsql -d -I  -s 4326 kabelbedAlgemeen.shp| psql

createdb:
	createdb imkl
	psql -c 'create extension postgis'
