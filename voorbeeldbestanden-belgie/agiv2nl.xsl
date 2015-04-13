<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
    xmlns:gml="http://www.opengis.net/gml/3.2"
    xmlns:imkl="http://www.geonovum.nl/wion/2015/1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<!--Identity template, 
        provides default behavior that copies all content into the output -->
    <xsl:template match="@*|node()">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:template>

    <xsl:template match="imkl:imklId">  
	<imkl:identificatie>
	<imkl:NEN3610ID>
        <imkl:namespace>hallo</imkl:namespace>
        <imkl:lokaalID>xxyyzz</imkl:lokaalID>
	</imkl:NEN3610ID>
	</imkl:identificatie>
    </xsl:template>

    <xsl:template match="imkl:ExtraTopografie/imkl:ligging">
	<imkl:typeTopografischObject/>
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:template>

    <xsl:template match="imkl:Utiliteitsnet/imkl:technischContactpersoon">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
	<imkl:thema></imkl:thema>
    </xsl:template>

    <xsl:template match="imkl:Aansluitschets/imkl:adres">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
	<imkl:extraInfoType></imkl:extraInfoType>
	<imkl:bestandLocatie>xx</imkl:bestandLocatie>
	<imkl:bestandMediaType/>
      <imkl:ligging>
        <gml:LineString gml:id="{generate-id()}" srsName="http://spatialreference.org/ref/epsg/31370/">
          <gml:posList>123310.34375 199899.921875 123307.75 199895.328125 123308.03125 199893.890625</gml:posList>
        </gml:LineString>
      </imkl:ligging>
    </xsl:template>

    <xsl:template match="imkl:postcode">
	<imkl:woonplaatsNaam>Lutjebroek</imkl:woonplaatsNaam>
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
	<imkl:landcode>nl</imkl:landcode>
    </xsl:template>

    <xsl:template match="imkl:Duct/imkl:containerType"></xsl:template>
    <xsl:template match="imkl:ExtraDetailinfo/imkl:opKabelEnLeidingen"></xsl:template>
    <xsl:template match="imkl:Annotatie/imkl:opContainerLeidingElementen"></xsl:template>
    <xsl:template match="imkl:Annotatie/imkl:label"></xsl:template>
    <xsl:template match="imkl:dekking"></xsl:template>
    <xsl:template match="imkl:standaardDekking"></xsl:template>
</xsl:stylesheet>
