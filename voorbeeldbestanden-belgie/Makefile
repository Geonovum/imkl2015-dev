FILES = Sewer/basispakket/basispakket.nl.xml \
 Sewer/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Sewer/container-single-theme/container-single-theme.nl.xml \
 Sewer/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Sewer/pakket-met-ActivityComplex/pakket-met-ActivityComplex.nl.xml \
 Sewer/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 Thermal/basispakket/basispakket.nl.xml \
 Thermal/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Thermal/container-single-theme/container-single-theme.nl.xml \
 Thermal/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Thermal/pakket-met-ActivityComplex/pakket-met-ActivityComplex.nl.xml \
 Thermal/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 Electricity/basispakket/basispakket.nl.xml \
 Electricity/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Electricity/container-single-theme/container-single-theme.nl.xml \
 Electricity/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Electricity/basispakket1Appurtenance/basispakket1Appurtenance.nl.xml \
 Electricity/pakket-met-ActivityComplex/pakket-met-ActivityComplex.nl.xml \
 Electricity/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 OilGasChemicals/basispakket/basispakket.nl.xml \
 OilGasChemicals/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 OilGasChemicals/container-single-theme/container-single-theme.nl.xml \
 OilGasChemicals/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 OilGasChemicals/pakket-met-ActivityComplex/pakket-met-ActivityComplex.nl.xml \
 OilGasChemicals/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 uitgebreid-pakket-1/imklVoeren.nl.xml \
 Telecom/basispakket/basispakket.nl.xml \
 Telecom/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Telecom/container-single-theme/container-single-theme.nl.xml \
 Telecom/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Telecom/pakket-met-ActivityComplex/pakket-met-ActivityComplex.nl.xml \
 Telecom/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 Water/basispakket/basispakket.nl.xml \
 Water/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Water/container-single-theme/container-single-theme.nl.xml \
 Water/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Water/pakket-met-ActivityComplex/pakket-met-ActivityComplex.nl.xml \
 Water/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 Water/pakket-met-aansluiting/pakket-met-aansluiting.nl.xml \
 uitgebreid-pakket-2/imklVoeren.nl.xml

%.nl.xml: %.xml Makefile
	cat $< |\
	grep -v orientatie |\
	grep -v liggingNauwkeurigheid |\
	grep -v kleur |\
	grep -v voorzorgsmaatregel |\
	grep -v subThema |\
	grep -v isRisicovol |\
        sed 's#isBovengrondsZichtbaar#bovengrondsZichtbaar#g' |\
        sed 's#imkl"=http://mir.agiv.be/cl/AGIV/v1/xmlns/IMKL2.2"#wion="http://www.geonovum.nl/wion/2015/1.0"#g' |\
        sed 's#IMKL2.2_rc_12062014.xsd#../../../xsd/IMKL2015-wion.xsd#g' |\
        sed 's#http://mir.agiv.be/cl/AGIV/v1/xmlns/IMKL2.2#http://www.geonovum.nl/wion/2015/1.0#g' > $@

all: $(FILES)

clean:
	rm -rf $(FILES)

