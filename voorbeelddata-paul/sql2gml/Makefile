PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

Best.gml: sql2gml.php  postprocess.sql addgmlid.xsl
	psql -a < postprocess.sql
	php ./sql2gml.php | xsltproc addgmlid.xsl -  > Best.gml
	php ./sql2objects.php > Authorities.gml

postprocess:
	psql -a < postprocess.sql 2>&1 | tee post.log
clean:
	rm -f Best.gml
