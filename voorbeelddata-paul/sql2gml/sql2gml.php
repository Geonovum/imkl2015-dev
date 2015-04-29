#!/usr/bin/php
<?xml version="1.0"?>
<gml:FeatureCollection
    xmlns:gml="http://www.opengis.net/gml/3.2"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:imkl="http://www.geonovum.nl/wion/2015/1.0"
    xmlns:net="urn:x-inspire:specification:gmlas:Network:3.2"
    xmlns:us-net-ogc="http://inspire.ec.europa.eu/schemas/us-net-ogc/3.0"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:base="urn:x-inspire:specification:gmlas:BaseTypes:3.2"
    xmlns:us-net-common="http://inspire.ec.europa.eu/schemas/us-net-common/3.0"
    xmlns:us-net-el="http://inspire.ec.europa.eu/schemas/us-net-el/3.0"
    gml:id="ID_1c0c5554-5c4a-467a-a9ef-9f36b5af2bfq"
    xsi:schemaLocation="http://www.geonovum.nl/wion/2015/1.0 ../../xsd/IMKL2015-wion.xsd">

<?php
date_default_timezone_set("Europe/Amsterdam");
echo "<!-- File created by Wilko Quak via the sql2gml.php script on " .  date('Y-m-d') . " -->\n";

//
// Connect to DBMS.
//
$dbconn = pg_connect("");

//
// Process utiliteitsnet.
//
$query = 'select gid,id,thema,eisvoorhp,tcontpers,telefoon,email,authority,authrole,unetworkty from utiliteitsnet ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Utiliteitsnet gml:id=\"unetid" . $line["gid"] . uniqid() . "\">\n";
    echo "        <us-net-common:utilityNetworkType xlink:href=\"" . $line["unetworkty"] . "\"/>\n";
#
# TODO add authorityRole
#
    echo "        <us-net-common:authorityRole xlink:href=\"" . uniqid() ."\"/>\n";
    echo "        <imkl:identificatie><imkl:NEN3610ID><imkl:namespace>hallo</imkl:namespace><imkl:lokaalID>xxyyzz</imkl:lokaalID></imkl:NEN3610ID></imkl:identificatie>\n";
    echo "        <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:technischContactpersoon>\n";
    echo "            <imkl:TechnischContactpersoon>\n";
    echo "                <imkl:naam>" . $line["tcontpers"] . "</imkl:naam>\n";
    echo "                <imkl:telefoon>" . $line["telefoon"] . "</imkl:telefoon>\n";
    echo "                <imkl:email>" . $line["email"] . "</imkl:email>\n";
    echo "            </imkl:TechnischContactpersoon>\n";
    echo "        </imkl:technischContactpersoon>\n";
    echo "        <imkl:eisVoorzorgsmaatregelHoogstePrioriteit>" . $line["eisvoorhp"] . "\n";
    echo "        </imkl:eisVoorzorgsmaatregelHoogstePrioriteit>\n";
    echo "        <imkl:thema xlink:href=\"" . $line["thema"] . "\"/>\n";
    echo "        </imkl:Utiliteitsnet>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

//
// Process leidingelement
//
$query = 'select gid,unetid,linkid,id,thema,netbeheer,type,status,vertpositi,bzichtbaar,dieptetovm,dieptenap,xinfo,hoogte,detailsch,ST_AsGML(3,geom,5,0,null,linkid || \'x\') as geom from leidingelement ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Appurtenance gml:id=\"ID" . $line["linkid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
#    echo "            <imkl:bovengrondsZichtbaar>" . $line["bzichtbaar"] . "\n";
#    echo "            </imkl:bovengrondsZichtbaar>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "            <net:geometry>" . $line["geom"] . "\n";
    echo "            </net:geometry>\n";
    echo "            <us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    echo "            <us-net-common:validFrom>2001-12-17T09:30:47.0Z</us-net-common:validFrom>\n";
    echo "            <us-net-common:validTo>2001-12-17T09:30:47.0Z</us-net-common:validTo>\n";
    echo "            <us-net-common:verticalPosition>underground</us-net-common:verticalPosition>\n";
    echo "            <us-net-common:appurtenanceType xlink:href=\"\"/>\n";
    echo "        </imkl:Appurtenance>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Process oliegaschemicalien
#
$query = 'select gid,id,thema,netbeheer,status,vertpositi,producttyp,warningt,toelichtin,pressure,pipediam,dieptetovm,dieptenap,xinfo,disttype,linkid from oliegaschemicalien ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:OlieGasChemicalienPijpleiding gml:id=\"IDms_kabelofleiding" . $line["gid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
    echo "            <net:inspireId>\n";
    echo "                <base:Identifier>\n";
    echo "                <base:localId>" . $line["gid"] . "</base:localId>\n";
    echo "                <base:namespace>gascom-be</base:namespace>\n";
    echo "            </base:Identifier>\n";
    echo "            </net:inspireId>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["thema"] . "\"/>\n";
    echo "            <net:link xlink:href=\"" . $line["linkid"] . "\"/>\n";
    echo "            <us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    echo "            <us-net-common:validFrom>2001-12-17T09:30:47.0Z</us-net-common:validFrom>\n";
    echo "            <us-net-common:validTo>2001-12-17T09:30:47.0Z</us-net-common:validTo>\n";
    echo "            <us-net-common:verticalPosition>underground</us-net-common:verticalPosition>\n";
    echo "            <us-net-common:utilityFacilityReference xlink:href=\"xxxxTODO\"/>\n";
#echo "            <us-net-common:utilityDeliveryType xlink:href="http://inspire.ec.europa.eu/codelist/UtilityDeliveryTypeExtendedValue/distribution"/
    echo "            <us-net-common:warningType xlink:href=\"http://inspire.ec.europa.eu/codelist/WarningTypeExtendedValue/net\"/>\n";
    echo "            <us-net-common:pipeDiameter uom=\"urn:ogc:def:uom:OGC::cm\">" . $line["pipediam"] . "</us-net-common:pipeDiameter>\n";
    echo "            <us-net-common:pressure uom=\"urn:ogc:def:uom:OGC::bar\">" . $line["pressure"] . "</us-net-common:pressure>\n";
    echo "            <us-net-ogc:oilGasChemicalsProductType xlink:href=\"" .  $line["producttyp"] . "\" />\n";
    echo "        </imkl:OlieGasChemicalienPijpleiding>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);
//
// Kabelbed
//
$query = 'select linkid,gid,id,thema,type,netbeheer,status,vertpositi,disttype,warningt,ductwidth,bzichtbaar,toelichtin,aantalk,dieptetovm,dieptenap,xinfo,geom from kabelb;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Kabelbed gml:id=\"IDms_kabelofleiding" . $line["gid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["thema"] . "\"/>\n";
    echo "            <net:link xlink:href=\"" . $line["linkid"] . "\"/>\n";
    echo "            <us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    echo "            <us-net-common:validFrom>2001-12-17T09:30:47.0Z</us-net-common:validFrom>\n";
    echo "            <us-net-common:validTo>2001-12-17T09:30:47.0Z</us-net-common:validTo>\n";
    echo "            <us-net-common:verticalPosition>underground</us-net-common:verticalPosition>\n";
    echo "            <us-net-common:warningType xlink:href=\"http://inspire.ec.europa.eu/codelist/WarningTypeExtendedValue/net\"/>\n";
    echo "	      <us-net-common:ductWidth uom=\"urn:ogc:def:uom:OGC::cm\">" . $line["ductwidth"] ."</us-net-common:ductWidth>\n";
    echo "        </imkl:Kabelbed>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

//
// Process ms_kabelofleiding
//
$query = 'select gid,id,thema,netbeheer,status,vertpositi,warningt,opvolt,nomvolt,toelichtin,dieptetovm,dieptenap,xinfo,disttype,linkid from elektriciteitskabel ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Elektriciteitskabel gml:id=\"IDms_kabelofleiding" . $line["gid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
#    echo "            <imkl:bovengrondsZichtbaar>" . $line["bzichtbaar"] . "\n";
#    echo "            </imkl:bovengrondsZichtbaar>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["thema"] . "\"/>\n";
    echo "            <net:link xlink:href=\"" . $line["linkid"] . "\"/>\n";
    echo "            <us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    echo "            <us-net-common:validFrom>2001-12-17T09:30:47.0Z</us-net-common:validFrom>\n";
    echo "            <us-net-common:validTo>2001-12-17T09:30:47.0Z</us-net-common:validTo>\n";
    echo "            <us-net-common:verticalPosition>underground</us-net-common:verticalPosition>\n";
    echo "	      <us-net-common:warningType xsi:nil=\"true\" />\n";
    echo "	      <us-net-el:operatingVoltage uom=\"urn:ogc:def:uom:OGC::V\">" . $line["opvolt"] ."</us-net-el:operatingVoltage>\n";
    echo "	      <us-net-el:nominalVoltage uom=\"urn:ogc:def:uom:OGC::V\">" . $line["nomvolt"] ."</us-net-el:nominalVoltage>\n";
    echo "        </imkl:Elektriciteitskabel>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

//
// Process utilitylink
//
$query = 'select gid,status,thema,linkid,ST_AsGML(3,geom,5,0,null,linkid) as geom from utilitylink ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <us-net-common:UtilityLink gml:id=\"IDms_kabelofleiding" . $line["gid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["thema"] . "\"/>\n";
    echo "            <net:centrelineGeometry>" . $line["geom"] . "\n";
    echo "            </net:centrelineGeometry>\n";
    echo "            <net:fictitious>false</net:fictitious>\n";
    echo "            <us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    echo "            <us-net-common:validFrom>2001-12-17T09:30:47.0Z</us-net-common:validFrom>\n";
    echo "            <us-net-common:validTo>2001-12-17T09:30:47.0Z</us-net-common:validTo>\n";
    echo "	      <us-net-common:verticalPosition xsi:nil=\"true\" />\n";
    echo "        </us-net-common:UtilityLink>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);


// Closing connection
pg_close($dbconn);
?>

</gml:FeatureCollection>
