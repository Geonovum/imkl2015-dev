#!/usr/local/bin/php
<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
    xmlns:base2="http://inspire.ec.europa.eu/schemas/base2/1.0"
    xmlns:base="http://inspire.ec.europa.eu/schemas/base/3.3"
    xmlns:gml="http://www.opengis.net/gml/3.2"
    xmlns:imkl="http://www.geonovum.nl/wion/2015/1.0"
    xmlns:net="http://inspire.ec.europa.eu/schemas/net/4.0"
    xmlns:us-net-common="http://inspire.ec.europa.eu/schemas/us-net-common/4.0"
    xmlns:us-net-el="http://inspire.ec.europa.eu/schemas/us-net-el/4.0"
    xmlns:us-net-ogc="http://inspire.ec.europa.eu/schemas/us-net-ogc/4.0"
    xmlns:us-net-sw="http://inspire.ec.europa.eu/schemas/us-net-sw/4.0"
    xmlns:us-net-wa="http://inspire.ec.europa.eu/schemas/us-net-wa/4.0" 
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<!--Identity template, 
        provides default behavior that copies all content into the output -->
    <xsl:template match="@*|node()">
            <xsl:apply-templates select="@*|node()"/>
    </xsl:template>

<?php
date_default_timezone_set("Europe/Amsterdam");

echo "<!-- File created by Wilko Quak via the sql2validator.php script on " .  date('Y-m-d') . " -->\n";

//
// Connect to DBMS.
//
$dbconn = pg_connect("");

#
#
$query = "select source,attribute,value,description,listname,value,url from codelists where attribute is not null";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "<xsl:template match=\"" . $line["attribute"] .  "[@xlink:href = '" .  $line["url"] . "']\" priority=\"10\">OK <xsl:value-of select='@*'/><xsl:text>&#xa;</xsl:text>\n";
    echo "</xsl:template>\n";
}
pg_free_result($result);


$query = "select distinct attribute from codelists where attribute != ''";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
{
    echo "<xsl:template match=\"" . $line["attribute"] .  "[@xlink:href]\" priority=\"5\">ERROR <xsl:value-of select='@*'/><xsl:text>&#xa;</xsl:text>\n";
    echo "</xsl:template>\n";
}
pg_free_result($result);

pg_close($dbconn);
?>

</xsl:stylesheet>
