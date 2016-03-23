#!/usr/bin/php
<?xml version="1.0"?>
<gml:FeatureCollection
    xmlns:imkl="http://www.geostandaarden.nl/imkl/2015/wion/1.1"
    xmlns:us-net-wa="http://inspire.ec.europa.eu/schemas/us-net-wa/4.0" 
    xmlns:us-net-sw="http://inspire.ec.europa.eu/schemas/us-net-sw/4.0"
    xmlns:us-net-common="http://inspire.ec.europa.eu/schemas/us-net-common/4.0"
    xmlns:us-net-el="http://inspire.ec.europa.eu/schemas/us-net-el/4.0"
    xmlns:us-net-ogc="http://inspire.ec.europa.eu/schemas/us-net-ogc/4.0"
    xmlns:net="http://inspire.ec.europa.eu/schemas/net/4.0"
    xmlns:base="http://inspire.ec.europa.eu/schemas/base/3.3"
    xmlns:base2="http://inspire.ec.europa.eu/schemas/base2/1.0"
    xmlns:gml="http://www.opengis.net/gml/3.2"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    gml:id="ID_1c0c5554-5c4a-467a-a9ef-9f36b5af2bfq"
    xsi:schemaLocation="http://www.geostandaarden.nl/imkl/2015/wion/1.1 ../xsd/IMKL2015-wion.xsd">


<!-- Dit is voorbeeldstand van imkl2015 bestand met topologie. Het zijn
gasleidinging uit het open data bestand van Enexis. De gasleidingen zijn
gecodeerd as links en als er twee gasleidingen op hetzelfde punt eindigen is
op die plek een Appurtenance van het type connectionBox neergezet. Dit klopt
waarschijnlijk niet. En alle andere attributen klopt ook niet veel van, maar als
topologisch voorbeeldbestand is het voldoende -->

<?php
date_default_timezone_set("Europe/Amsterdam");

function printopen($element)
{
    echo "        <" . $element . ">\n";
}

function printclose($element)
{
    echo "        </" . $element . ">\n";
}

function printattribute_tvale($tag,$value,$tvalue)
{
    if ($value != "")
    {
        echo "        <" . $tag . " " . $tvalue .">" . $value . "</" . $tag . ">\n";
    }
    else
    {
        echo "            <" . $tag . " " . $tvalue . " xsi:nil=\"true\"/>\n";
    }
}

function printhrefopt($element,$href)
{

    if ($href != "")
    {
        echo "        <" . $element . " xlink:href=\"" . $href .  "\"/>\n";
    }
}

function printhref($element,$href)
{

    if ($href != "")
    {
        echo "        <" . $element . " xlink:href=\"" . $href .  "\"/>\n";
    }
    else
    {
        echo "            <" . $element . " xsi:nil=\"true\"/>\n";
    }
}

function printattribute($tag,$value)
{
    echo "        <" . $tag . ">" . $value . "</" . $tag . ">\n";
}

function printINSPIREcodelistvalue($attribute,$codelist,$value)
{
    if ($value != "")
    {
        echo "        <" . $attribute . " xlink:href=\"http://inspire.ec.europa.eu/codelist/" . $codelist . "/" .  $value . "\"/>\n";
    }
    else
    {
        echo "            <" . $attribute . " xsi:nil=\"true\"/>\n";
    }
}

function printMYcodelistvalue($attribute,$value)
{
    if ($value != "")
    {
	echo "        <" . $attribute . " xlink:href=\"" .  $value . "\"/>\n";
    }
    else
    {
        echo "            <" . $attribute . " xsi:nil=\"true\"/>\n";
    }
}


function printNENcodelistvalue($attribute,$codelist,$value)
{
    if ($value != "")
    {
	echo "        <" . $attribute . " xlink:href=\"http://www.geonovum.nl/imkl2015/1.0/id/" . $codelist . "/" .  $value . "\"/>\n";
    }
    else
    {
        echo "            <" . $attribute . " xsi:nil=\"true\"/>\n";
    }
}

function printtagattribute($tag,$attribute,$value)
{
    if ($value == "")
    {
        echo "            <" . $tag . " " . $attribute . " xsi:nil=\"true\">" . $value . "</" . $tag . ">\n";
    }
    else
    {
        echo "            <" . $tag . " " . $attribute . "=\"" . $value . "\"/>\n";
    }
}

function openfeature($featuretype,$gmlid)
{
    echo "        <" . $featuretype . " gml:id=\"" .  $gmlid . "\">\n";
}


function printNEN3610ID($bronhoudercode,$lokaalid)
{
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>nl.imkl</imkl:namespace>\n";
    echo "                <imkl:lokaalID>" . $bronhoudercode . "." . $lokaalid . "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
}

function printINSPIREID($namespace,$gmlid)
{
    echo "            <" . $namespace . ":inspireId>\n";
    echo "                <base:Identifier>\n";
    echo "                    <base:localId>"  . preg_replace("/^nl.imkl./","",$gmlid) . "</base:localId>\n";
    echo "                    <base:namespace>nl.imkl</base:namespace>\n";
    echo "                </base:Identifier>\n";
    echo "            </" . $namespace . ":inspireId>\n";
}
    

function printValidity($from,$to)
{
    echo "            <us-net-common:validFrom>" . $from . "</us-net-common:validFrom>\n";
    echo "            <us-net-common:validTo>" . $to . "</us-net-common:validTo>\n";
}

function printLifespan($namespace,$from,$to)
{
    echo "            <" . $namespace . ":beginLifespanVersion>" . $from . "</" . $namespace . ":beginLifespanVersion>\n";
    if ($to != "")
    {
        echo "            <" . $namespace . ":endLifespanVersion>" . $to .  "</" . $namespace . ":endLifespanVersion>\n";
    }
}


echo "<!-- File created by Wilko Quak via the sql2topology.php script on " .  date('Y-m-d') . " -->\n";

//
// Connect to DBMS.
//
$dbconn = pg_connect("");

//
// Create one utiliteitsnet.
//
printopen("gml:featureMember");
openfeature("imkl:Utiliteitsnet","nl.imkl.topodemo.topodemo-gas");

//$query2 = 'select elementid from utilitynetwork_elements ue where ue.utilitynetwork = \'' . $line["gmlid"] . '\' ;';
//$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
//while ($line2 = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
    //printhref("net:elements",$line2["elementid"]);
//}
//pg_free_result($result2);

printINSPIREcodelistvalue("us-net-common:utilityNetworkType","UtilityNetworkTypeValue","oilGasChemical");
printhref("us-net-common:authorityRole","topodemo");
printNEN3610ID("topodemo","topodemo-gas");
printLifespan("imkl","2001-12-17T09:30:47.0Z","");
printNENcodelistvalue('imkl:thema','Thema',"gasLageDruk");
printopen("imkl:technischContactpersoon");
printopen("imkl:TechnischContactpersoon");
printattribute("imkl:naam","Wilko Quak");
printattribute("imkl:telefoon","00");
printattribute("imkl:email","w.quak@geonovum.nl");
printclose("imkl:TechnischContactpersoon");
printclose("imkl:technischContactpersoon");
printclose("imkl:Utiliteitsnet");
printclose("gml:featureMember");

//
// Process node
//
$query = 'select
id,ST_AsGML(3,geometry,5,0,null,\'geometrynodeid.\' || id::text) as geom from
nodes where (geometry && ST_makeEnvelope(128256,408036, 136179,412636,28992))';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("us-net-common:Appurtenance","nl.imkl.topodemo.node." . $line["id"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printINSPIREID("net","topodemo.node." . $line["id"]);
    printhref("net:inNetwork","nl.imkl.topodemo.topodemo-gas");
    printattribute("net:geometry",$line["geom"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue","inUse");
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printhref("us-net-common:verticalPosition","");
    printMycodelistvalue("us-net-common:appurtenanceType","http://inspire.ec.europa.eu/codelist/ElectricityAppurtenanceTypeValue/connectionBox");
    printclose("us-net-common:Appurtenance");
    printclose("gml:featureMember");
}
pg_free_result($result);



//
// Process utilitylink
//
$query = 'select drukgroep,gassoort,diameter, gid,status,startNode,endNode,ST_AsGML(3,geometry,5,0,null,\'geomid\' ||
gid::text) as geom from gasleiding_ligging where (startNode is not null or
endNode is not null) and (geometry && ST_makeEnvelope(128256,408036, 136179,412636,28992));';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("us-net-common:UtilityLink","nl.imkl.topodemo.link." . $line["gid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printINSPIREID("net","topodemo.link." . $line["gid"]);
    printhref("net:inNetwork","nl.imkl.topodemo.topodemo-gas");
    printattribute("net:centrelineGeometry",$line["geom"]);
    printattribute("net:fictitious","false");
    if ($line["endnode"] != "")
    {
        printhrefopt("net:endNode","nl.imkl.topodemo.node." . $line["endnode"]);
    }
    if ($line["startnode"] != "")
    {
	printhrefopt("net:startNode","nl.imkl.topodemo.node." . $line["startnode"]);
    }
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printhref("us-net-common:verticalPosition","");
    printclose("us-net-common:UtilityLink");
    printclose("gml:featureMember");

    printopen("gml:featureMember");
    openfeature("imkl:OlieGasChemicalienPijpleiding","nl.imkl.topodemo.leiding." . $line["gid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printINSPIREID("net","nl.imkl.topodemo.leiding." . $line["gid"]);
    printhref("net:inNetwork","nl.imkl.topodemo.topodemo-gas");
    printhref("net:link",  "topodemo.link." . $line["gid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    printhref("us-net-common:utilityFacilityReference","");
    printINSPIREcodelistvalue("us-net-common:warningType","WarningTypeValue","net");
    printattribute_tvale("us-net-common:pipeDiameter",$line["diameter"],"uom=\"urn:ogc:def:uom:OGC::cm\"");
    printattribute_tvale("us-net-common:pressure",$line["drukgroep"],"uom=\"urn:ogc:def:uom:OGC::bar\"");
    printINSPIREcodelistvalue("us-net-ogc:oilGasChemicalsProductType","OilGasChemicalsProductTypeValue",$line["gassoort"]);
    printclose("imkl:OlieGasChemicalienPijpleiding");
    printclose("gml:featureMember");
}
pg_free_result($result);


// Closing connection
pg_close($dbconn);
?>

</gml:FeatureCollection>
