PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

validate: ../voorbeelddata-paul/sql2gml/Best.gml validateCodelist.xsl
	cat ../voorbeelddata-paul/sql2gml/Best.gml | xsltproc validateCodelist.xsl - 

validateCodelist.xsl: sql2validator.php
	php sql2validator.php > validateCodelist.xsl

create:
	psql < create.sql
load:
	psql -c "copy codelists from STDIN (format csv,delimiter ';')" < waardelijsten.csv

