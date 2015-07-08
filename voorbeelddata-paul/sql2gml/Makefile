PGHOST=cerise.tudelft.nl
PGDATABASE=imkl
PGUSER=imkl

Best.gml: sql2gml.php  postprocess.sql addgmlid.xsl
	psql -a < postprocess.sql 2>&1 | tee post.log
	php ./sql2gml.php | xsltproc addgmlid.xsl - | xmllint --format -  > Best.gml
	php ./sql2objects.php > Authorities.gml

validate: Best.gml
	cat Best.gml | xsltproc validateCodelist.xsl - 
check:
	psql -a < qcheck.sql
postprocess:
	psql -a < postprocess.sql 2>&1 | tee post.log
clean:
	rm -f Best.gml
	rm -f post.log
	psql -a < drop.sql
