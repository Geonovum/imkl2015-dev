PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

validate: ../voorbeelddata-paul/sql2gml/Best.gml validateCodelist.xsl
	cat ../voorbeelddata-paul/sql2gml/Best.gml | xsltproc validateCodelist.xsl - 

validateCodelist.xsl: sql2validator.php load
	php sql2validator.php > validateCodelist.xsl

imkl2015.rdf: sql2rdf.php
	php sql2rdf.php > imkl2015.rdf

load: waardelijsten.csv
	psql < create.sql
	psql -c "delete from codelists;"
	psql -c "copy codelists from STDIN (header true,format csv,delimiter ';')" < waardelijsten.csv

