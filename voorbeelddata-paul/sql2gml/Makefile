PGHOST=pakhuis.tudelft.nl
PGDATABASE=imkl
#PGUSER=imkl
Best.gml: sql2gml.php  postprocess.sql addgmlid.xsl
	psql -a < postprocess.sql 2>&1 | tee post.log
	php ./sql2gml.php | xsltproc addgmlid.xsl - | xmllint --format -  > Best.gml
	php ./sql2objects.php > Authorities.gml
Best.noid.gml: Best.gml rmgmlid.xsl
	cat Best.gml | xsltproc rmgmlid.xsl - > Best.noid.gml

validate: Best.gml
	cat Best.gml | xsltproc validateCodelist.xsl - 

inspirevalidate:
	for URI in $(grep -e xlink:href Best.gml | grep -e inspire | sort --uniq --stable | cut -f2 -d'"' | sed -e 's/ /%20/g'); do curl -sL -w "%{http_code} %{url_effective}\\n" "$URI" -o /dev/null; done

check:
	psql -a < qcheck.sql
postprocess:
	psql -a < postprocess.sql 2>&1 | tee post.log
clean:
	rm -f Best.gml
	rm -f post.log
	psql -a < drop.sql
