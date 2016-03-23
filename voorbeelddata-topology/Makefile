PGDATABASE=imkl

TopologyExample.gml: sql2topology.php
	php ./sql2topology.php | xmllint --format -  > TopologyExample.gml
clean:
	rm -f Topology.gml

gas:
	psql -c 'drop table if exists gasleiding_ligging'
	shp2pgsql -p -WISO-8859-1 -s 28992 -S -D -g geometry $(TMPDIR)/gamefiles/G_leiding_VR_Ligging_Kaart.shp gasleiding_ligging | sed 's/varchar([0-9]*)/text/' | psql
	shp2pgsql -a -WISO-8859-1 -s 28992 -S -D -I -g geometry $(TMPDIR)/gamefiles/G_leiding_VR_Ligging_Kaart.shp gasleiding_ligging | iconv -c -f ISO-8859-1 -t UTF-8//TRANSLIT | psql

load: $(TMPDIR)/gamefiles

$(TMPDIR)/gamefiles: $(TMPDIR)/EnexisData.zip
	(cd $(TMPDIR) ;unzip EnexisData.zip)
$(TMPDIR)/EnexisData.zip:
	wget -O $(TMPDIR)/EnexisData.zip https://www.enexis.nl/Documents/open-data/Asset%20Data.zip
