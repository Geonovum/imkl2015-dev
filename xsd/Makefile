all: IMKL2015-rrb.xsd IMKL2015-sw.xsd IMKL2015-wion.xsd IMKL2015.xsd

IMKL2015-rrb.xsd: Makefile ../ShapeChange/xsd/RRB/IMKL2015.xsd
	cat ../ShapeChange/xsd/RRB/IMKL2015.xsd | \
	sed 's#http://www.geonovum.nl/imkl/2015/1.0#http://www.geonovum.nl/rrb/2015/1.0#g' | \
	sed 's#imkl2015:#rrb:#g' | \
	sed 's#xmlns:imkl2015#xmlns:rrb#g' > IMKL2015-rrb.xsd
IMKL2015-wion.xsd: Makefile ../ShapeChange/xsd/WION/IMKL2015.xsd
	cat ../ShapeChange/xsd/WION/IMKL2015.xsd | \
	sed 's#http://www.geonovum.nl/imkl/2015/1.0#http://www.geonovum.nl/wion/2015/1.0#g' | \
	sed 's#imkl2015:#wion:#g' | \
	sed 's#xmlns:imkl2015#xmlns:wion#g' > IMKL2015-wion.xsd
IMKL2015-sw.xsd: Makefile ../ShapeChange/xsd/StedelijkWater/IMKL2015.xsd
	cat ../ShapeChange/xsd/StedelijkWater/IMKL2015.xsd | \
	sed 's#http://www.geonovum.nl/imkl/2015/1.0#http://www.geonovum.nl/sw/2015/1.0#g' | \
	sed 's#imkl2015:#sw:#g' | \
	sed 's#xmlns:imkl2015#xmlns:sw#g' > IMKL2015-sw.xsd

IMKL2015.xsd: ../ShapeChange/xsd/INPUT/IMKL2015.xsd
	cp ../ShapeChange/xsd/INPUT/IMKL2015.xsd IMKL2015.xsd

deploy: 
	cp IMKL2015-rrb.xsd IMKL2015-wion.xsd IMKL2015-sw.xsd ../../imkl2015-review/4.\ XML\ schema/

clean:
	rm IMKL2015-rrb.xsd IMKL2015-wion.xsd IMKL2015-sw.xsd IMKL2015.xsd
