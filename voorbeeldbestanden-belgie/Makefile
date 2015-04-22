FILES = Sewer/basispakket/basispakket.nl.xml \
 Sewer/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Sewer/container-single-theme/container-single-theme.nl.xml \
 Sewer/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Sewer/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 Thermal/basispakket/basispakket.nl.xml \
 Thermal/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Thermal/container-single-theme/container-single-theme.nl.xml \
 Thermal/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Thermal/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 Electricity/basispakket/basispakket.nl.xml \
 Electricity/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Electricity/container-single-theme/container-single-theme.nl.xml \
 Electricity/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Electricity/basispakket1Appurtenance/basispakket1Appurtenance.nl.xml \
 Electricity/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 OilGasChemicals/basispakket/basispakket.nl.xml \
 OilGasChemicals/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 OilGasChemicals/container-single-theme/container-single-theme.nl.xml \
 OilGasChemicals/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 OilGasChemicals/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 uitgebreid-pakket-1/imklVoeren.nl.xml \
 Telecom/basispakket/basispakket.nl.xml \
 Telecom/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Telecom/container-single-theme/container-single-theme.nl.xml \
 Telecom/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Telecom/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 Water/basispakket/basispakket.nl.xml \
 Water/pakket-met-ExtraTopografie/pakket-met-ExtraTopografie.nl.xml \
 Water/container-single-theme/container-single-theme.nl.xml \
 Water/pakket-met-dieptes/pakket-met-dieptes.nl.xml \
 Water/pakket-met-ExtraInformatie/pakket-met-extraInformatie.nl.xml \
 Water/pakket-met-aansluiting/pakket-met-aansluiting.nl.xml \
 uitgebreid-pakket-2/imklVoeren.nl.xml

%.nl.xml: %.xml Makefile agiv2nl.xsl
	mkdir -p $(dir voorbeeldbestanden-nl/$<)
	cat $< |\
	grep -v orientatie |\
	grep -v liggingNauwkeurigheid |\
	grep -v kleur |\
	grep -v voorzorgsmaatregel |\
	grep -v subThema |\
	grep -v imkl:gemeente |\
	grep -v imkl:datumOpmetingDieptePeil |\
	grep -v imkl:opLeidingElementen |\
	grep -v isRisicovol |\
        grep -v imkl:isBovengrondsZichtbaar |\
        sed 's#imkl:ElectricityCable#imkl:Elektriciteitskabel#g' |\
        sed 's#imkl:diepte#imkl:dieptelegging#g' |\
        sed 's#imkl:diepteleggingNauwkeurigheid#imkl:diepteNauwkeurigheid#g' |\
        sed 's#imkl:TAWDiepte#imkl:DiepteNAP#g' |\
        sed 's#imkl:ExtraPlan#imkl:ExtraDetailinfo#g' |\
        sed 's#imkl:extraPlanType#imkl:extraInfoType#g' |\
        sed 's#imkl:heeftLeidingElement#imkl:heeftLeidingelement#g' |\
        sed 's#imkl:SewerPipe#imkl:Rioolleiding#g' |\
        sed 's#imkl:heeftContainerLeidingElement#imkl:heeftKabelEnLeidingContainer#g' |\
        sed 's#imkl:opContainerLeidingElementen#imkl:opContainerLeidingelementen#g' |\
        sed 's#imkl:heeftUtilityNetwork#imkl:inNetwork#g' |\
        sed 's#imkl:Aansluiting#imkl:Aansluitschets#g' |\
        sed 's#imkl:ThermalPipe#imkl:ThermischePijpleiding#g' |\
        sed 's#imkl:TelecommunicationsCable#imkl:Telecommunicatiekabel#g' |\
        sed 's#imkl:OilGasChemicalsPipe#imkl:OlieGasChemicalienPijpleiding#g' |\
        sed 's#imkl:Tower#imkl:Toren#g' |\
        sed 's#imkl:Cabinet#imkl:Kast#g' |\
        sed 's#imkl:Pole#imkl:Mast#g' |\
        sed 's#imkl:WaterPipe#imkl:Waterleiding#g' |\
        sed 's#imkl:diepteleggingPeil#imkl:dieptePeil#g' |\
        sed 's#imkl:straatnaam#imkl:naamOpenbareRuimte#g' |\
        sed 's#imkl:RelatieveDiepte#imkl:DiepteTovMaaiveld#g' |\
        sed 's#imkl:Manhole#imkl:Mangat#g' |\
        sed 's#imkl:UtilityNetwork#imkl:Utiliteitsnet#g' |\
        sed 's#imkl"=http://mir.agiv.be/cl/AGIV/v1/xmlns/IMKL2.2"#wion="http://www.geonovum.nl/wion/2015/1.0"#g' |\
        sed 's#IMKL2.2_rc_12062014.xsd#../../../IMKL2015-wion.xsd#g' |\
        sed 's#IMKL2.2-20141128.xsd#../../IMKL2015-wion.xsd#g' |\
        sed 's#http://mir.agiv.be/cl/AGIV/v1/xmlns/IMKL2.2#http://www.geonovum.nl/wion/2015/1.0#g' |\
	xsltproc agiv2nl.xsl -  > voorbeeldbestanden-nl/$<

all: $(FILES)

clean:
	rm -rf $(FILES)
	rm -rf voorbeeldbestanden-nl

