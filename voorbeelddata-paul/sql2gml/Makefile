PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

Best.gml: sql2gml.php  postprocess.sql addgmlid.xsl
	psql -a < postprocess.sql
	php ./sql2gml.php | xsltproc addgmlid.xsl -  > Best.gml

postprocess:
	psql < postprocess.sql
clean:
	rm -f Best.gml
