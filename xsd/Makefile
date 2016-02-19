all: imkl2015-rrb.xsd imkl2015-sw.xsd imkl2015-wion.xsd imkl2015.xsd

imkl2015-rrb.xsd: Makefile ../ShapeChange/xsd/RRB/imkl2015.xsd
	cat ../ShapeChange/xsd/RRB/imkl2015.xsd | \
	sed 's#http://www.geonovum.nl/imkl/2015/1.0#http://www.geostandaarden.nl/imkl/2015/rrb/1.0#g' | \
	sed 's#imkl2015:#rrb:#g' | \
	sed 's#xmlns:imkl2015#xmlns:rrb#g' > imkl2015-rrb.xsd
imkl2015-wion.xsd: Makefile ../ShapeChange/xsd/WION/imkl2015.xsd
	cat ../ShapeChange/xsd/WION/imkl2015.xsd | \
	sed 's#http://www.geonovum.nl/imkl/2015/1.0#http://www.geostandaarden.nl/imkl/2015/wion/1.0#g' | \
	sed 's#imkl2015:#wion:#g' | \
	sed 's#xmlns:imkl2015#xmlns:wion#g' > imkl2015-wion.xsd
imkl2015-sw.xsd: Makefile ../ShapeChange/xsd/StedelijkWater/imkl2015.xsd
	cat ../ShapeChange/xsd/StedelijkWater/imkl2015.xsd | \
	sed 's#http://www.geonovum.nl/imkl/2015/1.0#http://www.geostandaarden.nl/imkl/2015/sw/1.0#g' | \
	sed 's#imkl2015:#sw:#g' | \
	sed 's#xmlns:imkl2015#xmlns:sw#g' > imkl2015-sw.xsd

imkl2015.xsd: ../ShapeChange/xsd/INPUT/imkl2015.xsd
	cp ../ShapeChange/xsd/INPUT/imkl2015.xsd imkl2015.xsd

deploy: 
	cp imkl2015-rrb.xsd imkl2015-wion.xsd imkl2015-sw.xsd ../../imkl2015-review/4.\ XML\ schema/

clean:
	rm imkl2015-rrb.xsd imkl2015-wion.xsd imkl2015-sw.xsd imkl2015.xsd
