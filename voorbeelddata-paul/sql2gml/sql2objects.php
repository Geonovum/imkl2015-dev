#!/usr/bin/php
<?xml version="1.0"?>
<gml:Dictionary
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

<gml:identifier codeSpace="test">
</gml:identifier>

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
    echo "        <" . $attribute . " xlink:href=\"http://inspire.ec.europa.eu/codelist/" . $codelist . "/" .  $value . "\"/>\n";
}


function printNENcodelistvalue($attribute,$codelist,$value)
{
    echo "        <" . $attribute . " xlink:href=\"http://www.geonovum.nl/imkl/2015/1.0/def/" . $codelist . "/" .  $value . "\"/>\n";
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

function makegmlid($bronhoudercode,$lokaalid)
{
    return ("nl.imkl." . $bronhoudercode .  "." . $lokaalid );
}

function openfeature($featuretype,$bronhoudercode,$lokaalid)
{
    echo "        <" . $featuretype . " gml:id=\"" .  makegmlid($bronhoudercode,$lokaalid) . "\">\n";
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

function printINSPIREID($bronhoudercode,$lokaalid)
{
    echo "            <net:inspireId>\n";
    echo "                <base:Identifier>\n";
    echo "                    <base:localId>" . $bronhoudercode . "." . $lokaalid. "</base:localId>\n";
    echo "                    <base:namespace>nl.imkl</base:namespace>\n";
    echo "                </base:Identifier>\n";
    echo "            </net:inspireId>\n";
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
    echo "<gml:dictionaryEntry>\n\n";
    echo "    <base2:relatedParty gml:id=\"" . $line["partyid"] . "\">\n";
    echo "        <base2:organisationName>" . $line["authority"] . "</base2:organisationName>\n";
    echo "        <base2:role xlink:href=\"" . $line["authrole"] . "\"/>\n";
    echo "        </imkl:Utiliteitsnet>\n";
    echo "    </base2:relatedParty>\n\n";
    echo "</gml:dictionaryEntry>\n\n";
}
pg_free_result($result);


// Closing connection
pg_close($dbconn);
?>

</gml:Dictionary>
