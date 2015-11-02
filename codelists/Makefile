PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

validate: ../voorbeelddata-paul/sql2gml/Best.gml validateCodelist.xsl
	cat ../voorbeelddata-paul/sql2gml/Best.gml | xsltproc validateCodelist.xsl - 

validateCodelist.xsl: sql2validator.php load
	php sql2validator.php > validateCodelist.xsl

imkl2015.rdf: sql2rdf.php
	php sql2rdf.php > imkl2015.rdf

checkinspireurls:
	sh checkinspireurls.sh

#
# To get a waardelijsten.csv:
# 1: save waardelijsten as utf.
#
waardelijsten-utf8.csv: waardelijsten.csv
	iconv -f utf16 -t utf8 waardelijsten.csv > waardelijsten-utf8.csv

load: waardelijsten-utf8.csv
	psql < create.sql
	psql -c "delete from codelists;"
	psql -c "copy codelists from STDIN (header true,format csv,delimiter '	')" < waardelijsten-utf8.csv

clean:
	rm -f validateCodelist.xsl imkl2015.rdf

