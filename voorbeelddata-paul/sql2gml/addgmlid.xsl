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

    <xsl:template match="gml:Polygon/|gml:Point/|gml:Curve/">  
	<xsl:attribute name="gml:id"><xsl:value-of select="generate-id()"/></xsl:attribute>
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:template>

</xsl:stylesheet>
