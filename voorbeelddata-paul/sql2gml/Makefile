PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

Best.gml: sql2gml.php  postprocess.sql
	psql < postprocess.sql
	php ./sql2gml.php > Best.gml
postprocess:
	psql < postprocess.sql
clean:
	rm -f Best.gml
