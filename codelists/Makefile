PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

imkl2015.rdf: sql2rdf.php
	php sql2rdf.php > imkl2015.rdf

validate: ../voorbeelddata-paul/sql2gml/Best.gml validateCodelist.xsl
	cat ../voorbeelddata-paul/sql2gml/Best.gml | xsltproc validateCodelist.xsl - 

validateCodelist.xsl: sql2validator.php load
	php sql2validator.php > validateCodelist.xsl


checkinspireurls:
	sh checkinspireurls.sh

#
# To get a waardelijsten-utf16.txt:
# 1: save waardelijsten as utf.
#
waardelijsten-utf8.csv: waardelijsten-utf16.txt
	iconv -f utf-16 -t utf8 waardelijsten-utf16.txt > waardelijsten-utf8.csv

load: waardelijsten-utf8.csv
	psql < create.sql
	psql -c "delete from codelists;"
	psql -c "copy codelists from STDIN (header true,format csv,delimiter '	')" < waardelijsten-utf8.csv

clean:
	rm -f validateCodelist.xsl imkl2015.rdf

deploy:
	cp imkl2015.rdf ../../imkl2015-review/3.\ waardelijsten
	cp imkl2015.rdf ../../imkl/waardelijst/1.0.0RC1
