#!/usr/local/bin/php
<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
    xmlns:gml="http://www.opengis.net/gml/3.2"
    xmlns:imkl="http://www.geonovum.nl/wion/2015/1.0"
    xmlns:net="http://inspire.ec.europa.eu/schemas/net/4.0"
    xmlns:us-net-common="http://inspire.ec.europa.eu/schemas/us-net-common/4.0"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<!--Identity template, 
        provides default behavior that copies all content into the output -->
    <xsl:template match="@*|node()">
            <xsl:apply-templates select="@*|node()"/>
    </xsl:template>

<?php
date_default_timezone_set("Europe/Amsterdam");

echo "<!-- File created by Wilko Quak via the sql2gml.php script on " .  date('Y-m-d') . " -->\n";

//
// Connect to DBMS.
//
$dbconn = pg_connect("");

#
#
$query = "select codelist,value from codelists where codelist = 'appurtenanceType'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "<xsl:template match=\"us-net-common:" . $line["codelist"] .  "[@xlink:href = 'http://inspire.ec.europa.eu/codelist/" . $line["codelist"] . "Value/" .  $line["value"] . "']\" priority=\"10\">OK <xsl:value-of select='@*'/><xsl:text>&#xa;</xsl:text>\n";
    echo "</xsl:template>";
}
pg_free_result($result);
pg_close($dbconn);
?>

    <xsl:template match="us-net-common:appurtenanceType[@xlink:href]" pririty="5">ERROR <xsl:value-of select='@*'/><xsl:text>&#xa;</xsl:text>
    </xsl:template>

</xsl:stylesheet>
