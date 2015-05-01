        <base2:organisationName>xx</base2:organisationName>
        <base2:role xlink:href="hello world"/>
    </base2:RelatedParty>
#!/usr/bin/php
<?xml version="1.0"?>
<base2:RelatedParty
    xmlns:us-net-wa="http://inspire.ec.europa.eu/schemas/us-net-wa/3.0" 
    xmlns:gml="http://www.opengis.net/gml/3.2"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:imkl="http://www.geonovum.nl/wion/2015/1.0"
    xmlns:us-net-sw="http://inspire.ec.europa.eu/schemas/us-net-sw/3.0"
    xmlns:net="urn:x-inspire:specification:gmlas:Network:3.2"
    xmlns:us-net-ogc="http://inspire.ec.europa.eu/schemas/us-net-ogc/3.0"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:base="urn:x-inspire:specification:gmlas:BaseTypes:3.2"
    xmlns:base2="http://inspire.ec.europa.eu/schemas/base2/1.0"
    xmlns:us-net-common="http://inspire.ec.europa.eu/schemas/us-net-common/3.0"
    xmlns:us-net-el="http://inspire.ec.europa.eu/schemas/us-net-el/3.0"
    gml:id="ID_1c0c5554-5c4a-467a-a9ef-9f36b5af2bfq"
    xsi:schemaLocation="http://www.geonovum.nl/wion/2015/1.0 ../../xsd/IMKL2015-wion.xsd">

<?php
date_default_timezone_set("Europe/Amsterdam");

function printattribute($tag,$value)
{
    echo "            <" . $tag . ">" . $value . "</" . $tag . ">\n";
}

function printtagattribute($tag,$attribute,$value)
{
    if ($value == "")
    {
        echo "            <" . $tag . " " . $attribute . " xsi:nil=\"true\">" . $value . "</" . $tag . ">\n";
    }
    else
    {
        echo "            <" . $tag . " " . $attribute . ">" . $value . "</" . $tag . ">\n";
    }
}



echo "<!-- File created by Wilko Quak via the sql2gml.php script on " .  date('Y-m-d') . " -->\n";

//
// Connect to DBMS.
//
$dbconn = pg_connect("");

//
// Process utiliteitsnet.
//
$query = 'select partyid,authority,authrole from relatedparty;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <base2:relatedParty gml:id=\"" . $line["partyid"] . "\">\n";
    echo "        <base2:organisationName>" . $line["authority"] . "</base2:organisationName>\n";
    echo "        <base2:role xlink:href=\"" . $line["authrole"] . "\"/>\n";
    echo "        </imkl:Utiliteitsnet>\n";
    echo "    </base2:relatedParty>\n\n";
}
pg_free_result($result);


// Closing connection
pg_close($dbconn);
?>

</base2:RelatedParty>
