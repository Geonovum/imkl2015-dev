#!/usr/bin/php
<?xml version="1.0"?>
<gml:FeatureCollection
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
$query = 'select partyid,gmlid,thema,eisvoorhp,tcontpers,telefoon,email,authority,authrole,unetworkty from utiliteitsnet ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Utiliteitsnet gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "        <us-net-common:utilityNetworkType xlink:href=\"http://inspire.ec.europa.eu/codelist/UtilityNetworkTypeValue/" . $line["unetworkty"] . "\"/>\n";
    echo "        <us-net-common:authorityRole xlink:href=\"" .  $line["partyid"] ."\"/>\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    printattribute("imkl:beginLifespanVersion","2001-12-17T09:30:47.0Z");
    echo "        <imkl:technischContactpersoon>\n";
    echo "            <imkl:TechnischContactpersoon>\n";
    echo "                <imkl:naam>" . $line["tcontpers"] . "</imkl:naam>\n";
    echo "                <imkl:telefoon>" . $line["telefoon"] . "</imkl:telefoon>\n";
    echo "                <imkl:email>" . $line["email"] . "</imkl:email>\n";
    echo "            </imkl:TechnischContactpersoon>\n";
    echo "        </imkl:technischContactpersoon>\n";
    printattribute("imkl:eisVoorzorgsmaatregelHoogstePrioriteit",$line["eisvoorhp"]);
    echo "        <imkl:thema xlink:href=\"http://www.geonovum.nl/imkl/2015/1.0/def/Thema/" . $line["thema"] . "\"/>\n";
    echo "        </imkl:Utiliteitsnet>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

//
// Process leidingelement
//
$query = 'select gmlid,unetid,netbeheer,type,status,vertpositi,bzichtbaar,dieptetovm,dieptenap,xinfo,hoogte,detailsch,ST_AsGML(3,geom,5,0,null) as geom from leidingelement ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Appurtenance gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
#    echo "            <imkl:bovengrondsZichtbaar>" . $line["bzichtbaar"] . "\n";
#    echo "            </imkl:bovengrondsZichtbaar>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "            <net:geometry>" . $line["geom"] . "</net:geometry>\n";
    echo "            <us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    printattribute("us-net-common:validFrom","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:validTo","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    echo "            <us-net-common:appurtenanceType xlink:href=\"" .  $line["type"] . "\"/>\n";
    echo "        </imkl:Appurtenance>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Process oliegaschemicalien
#
$query = 'select gmlid,unetid,netbeheer,status,vertpositi,producttyp,warningt,toelichtin,pressure,pipediam,dieptetovm,dieptenap,xinfo,disttype,ulinkid from oliegaschemicalien ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:OlieGasChemicalienPijpleiding gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
    echo "            <net:inspireId>\n";
    echo "                <base:Identifier>\n";
    echo "                <base:localId>" . $line["gmlid"] . "</base:localId>\n";
    echo "                <base:namespace>gascom-be</base:namespace>\n";
    echo "            </base:Identifier>\n";
    echo "            </net:inspireId>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "            <net:link xlink:href=\"" . $line["ulinkid"] . "\"/>\n";
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
$query = 'select ulinkid,gmlid,unetid,type,netbeheer,status,vertpositi,disttype,warningt,ductwidth,bzichtbaar,toelichtin,aantalk,dieptetovm,dieptenap,xinfo,geom from kabelb;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Kabelbed gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "            <net:link xlink:href=\"" . $line["ulinkid"] . "\"/>\n";
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
// Process elektriciteitskabel
//
$query = 'select
gmlid,unetid,netbeheer,status,vertpositi,warningt,opvolt,nomvolt,toelichtin,dieptetovm,dieptenap,xinfo,disttype,ulinkid from elektriciteitskabel ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Elektriciteitskabel gml:id=\"" .  $line["gmlid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
#    echo "            <imkl:bovengrondsZichtbaar>" . $line["bzichtbaar"] . "\n";
#    echo "            </imkl:bovengrondsZichtbaar>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "            <net:link xlink:href=\"" . $line["ulinkid"] . "\"/>\n";
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
$query = 'select gmlid,status,unetid,ST_AsGML(3,geom,5,0,null) as geom from utilitylink;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <us-net-common:UtilityLink gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
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



#
# Process waterleiding
#
$query = 'select
gmlid,objectid,obj_id,ltyp,lbez,byear,aclass_id,gclass_id,gtype_id,enabled,cstype_id,length_mea,uttracewei,status,origobject,refscale,soort,medium,geo_kwalit,projectnum,functie,cp_ctrl_ar,cp_ctrl__1,cp_prot_ar,cp_prot__1,risicovol,crucialite,kb_nummer,diameter,materiaal,wanddikte,trace_nr,shape_len,unetid,netbeheer,status_1,vertpositi,disttype,warningt,pipediam,pressure,producttyp,toelichtin,dieptetovm,dieptenap,xinfo,geom,ulinkid from water_kabelofleiding ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Waterleiding gml:id=\"" .  $line["gmlid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
    echo "            <net:inspireId>\n";
    echo "                <base:Identifier>\n";
    echo "                <base:localId>" . $line["gmlid"] . "</base:localId>\n";
    echo "                <base:namespace>gascom-be</base:namespace>\n";
    echo "            </base:Identifier>\n";
    echo "            </net:inspireId>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "            <net:link xlink:href=\"" . $line["gmlid"] . "\"/>\n";
    echo "            <us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    echo "            <us-net-common:validFrom>2001-12-17T09:30:47.0Z</us-net-common:validFrom>\n";
    echo "            <us-net-common:validTo>2001-12-17T09:30:47.0Z</us-net-common:validTo>\n";
    echo "            <us-net-common:verticalPosition>underground</us-net-common:verticalPosition>\n";
    echo "            <us-net-common:warningType xlink:href=\"http://inspire.ec.europa.eu/codelist/WarningTypeExtendedValue/net\"/>\n";
    echo "            <us-net-common:pipeDiameter uom=\"urn:ogc:def:uom:OGC::cm\">" . $line["pipediam"] . "</us-net-common:pipeDiameter>\n";
    echo "            <us-net-common:pressure uom=\"urn:ogc:def:uom:OGC::bar\">" . $line["pressure"] . "</us-net-common:pressure>\n";
    echo "            <us-net-wa:waterType xlink:href=\"" .  $line["producttyp"] . "\" />\n";
    echo "        </imkl:Waterleiding>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);


#
# Process Riool_vv
#
$query = 'select gmlid,unetid,netbeheer,status,vertpositi,disttype,warningt,pipediam,pressure,swatertype,toelichtin,dieptetovm,dieptenap,xinfo,geom,ulinkid from rioolvv_kabelofleiding;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Rioolleiding gml:id=\"" .  $line["gmlid"] . "\">\n";
    echo "            <net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
    echo "            <net:inspireId>\n";
    echo "                <base:Identifier>\n";
    echo "                <base:localId>" . $line["gmlid"] . "</base:localId>\n";
    echo "                <base:namespace>gascom-be</base:namespace>\n";
    echo "            </base:Identifier>\n";
    echo "            </net:inspireId>\n";
    echo "            <net:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "            <net:link xlink:href=\"" . $line["ulinkid"] . "\"/>\n";
    echo "            <us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    echo "            <us-net-common:validFrom>2001-12-17T09:30:47.0Z</us-net-common:validFrom>\n";
    echo "            <us-net-common:validTo>2001-12-17T09:30:47.0Z</us-net-common:validTo>\n";
    echo "            <us-net-common:verticalPosition>underground</us-net-common:verticalPosition>\n";
    echo "            <us-net-common:warningType xlink:href=\"http://inspire.ec.europa.eu/codelist/WarningTypeExtendedValue/net\"/>\n";
    echo "            <us-net-common:pipeDiameter uom=\"urn:ogc:def:uom:OGC::cm\">" . $line["pipediam"] . "</us-net-common:pipeDiameter>\n";
    printtagattribute("us-net-common:pressure","uom=\"urn:ogc:def:uom:OGC::bar\"",$line["pressure"]);
    echo "            <us-net-sw:sewerWaterType xlink:href=\"" .  $line["swatertype"] . "\" />\n";
    echo "        </imkl:Rioolleiding>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Process AaanduidingEisVoorzorgsmaatregel
#
$query = 'select gmlid,unetid,netbeheer,eisvoorzm,geofict,geom from aanduidingeisvoorzorgsmaatregel;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:AanduidingEisVoorzorgsmaatregel gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "            <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:eisVoorzorgsmaatregel>" . $line["eisvoorzm"] . "</imkl:eisVoorzorgsmaatregel>\n";
    echo "        </imkl:AanduidingEisVoorzorgsmaatregel>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Process diepte
#
$query = 'select gmlid,unetid,netbeheer,dtovmveld,dtovnap,nauwk from diepte;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:DiepteTovMaaiveld gml:id=\"" .  $line["gmlid"] . "\">\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "            <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "            <imkl:diepteNauwkeurigheid xlink:href=\"TODO\"/>\n";
    echo "            <imkl:dieptePeil uom=\"urn:ogc:def:uom:OGC::bar\">" .  $line["dtovmveld"] . "</imkl:dieptePeil>\n";
    echo "            <imkl:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "        </imkl:DiepteTovMaaiveld>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);


#
# Extra Geometrie
#
$query = 'select gmlid,unetid,netbeheer,type,ST_AsGML(3,geom,5,0,null) as geom from extrageometrie;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:ExtraGeometrie gml:id=\"" .  $line["gmlid"] . "\">\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "        <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:vlakgeometrie2.5D>" . $line["geom"] .  "</imkl:vlakgeometrie2.5D>\n";
    echo "        </imkl:ExtraGeometrie>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Extra Topografie
#
$query = 'select
gmlid,unetid,netbeheer,type,typeobject,ST_AsGML(3,geom,5,0,null) as geom from extratopo;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:ExtraTopografie gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "        <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:extraTopografieType xlink:href=\"http://www.geonovum.nl/imkl/2015/1.0/def/Thema/" . $line["type"] . "\"/>\n";
    echo "        <imkl:typeTopografischObject xlink:href=\"http://www.geonovum.nl/imkl/2015/1.0/def/Thema/" .  $line["typeobject"] . "\"/>\n";
    echo "        <imkl:ligging>" . $line["geom"] . "</imkl:ligging>\n";
    echo "        <imkl:inNetwork xlink:href=\"" . $line["unetid"] . "\"/>\n";
    echo "        </imkl:ExtraTopografie>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Annotatie punt
#

$query = 'select gmlid,unetid,netbeheer,label,beschrijvi,ST_AsGML(3,geom,5,0,null) as geom from annotatie;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Annotatie gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "        <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:annotatieType>" . $line["beschrijvi"] . "</imkl:annotatieType>\n";
    echo "        <imkl:ligging>" . $line["geom"] . "</imkl:ligging>\n";
    echo "        </imkl:Annotatie>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Annotatie lijn
#
$query = 'select gmlid,unetid,thema,type,netbeheer,ST_AsGML(3,geom,5,0,null) as geom from annotatie_lijn;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Annotatie gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "        <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:annotatieType xlink:href=\"" . $line["type"] . "\"/>\n";
    echo "        <imkl:ligging>" . $line["geom"] . "</imkl:ligging>\n";
    echo "        </imkl:Annotatie>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Maatvoering
#
$query = 'select gmlid,unetid,netbeheer,type,ST_AsGML(3,geom,5,0,null) as geom from maatvoering;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Maatvoering gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "        <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:maatvoeringsType xlink:href=\"" . $line["type"] . "\"/>\n";
    echo "        <imkl:ligging>" . $line["geom"] . "</imkl:ligging>\n";
    echo "        </imkl:Maatvoering>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Maatvoering_pijl
#
$query = 'select gmlid,rotatie,unetid,netbeheer,type,ST_AsGML(3,geom,5,0,null) as geom from maatvoering_pijl;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Maatvoering gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "        <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:maatvoeringsType xlink:href=\"" . $line["type"] . "\"/>\n";
    echo "        <imkl:rotatiehoek uom=\"urn:ogc:def:uom:OGC::deg\">" .  $line["rotatie"] . "</imkl:rotatiehoek>\n";
    echo "        <imkl:ligging>" . $line["geom"] . "</imkl:ligging>\n";
    echo "        </imkl:Maatvoering>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

#
# Maatvoering_label
#
$query = 'select gmlid,unetid,netbeheer,toelichtin,label,ST_AsGML(3,geom,5,0,null) as geom from maatvoering_label;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "    <gml:featureMember>\n";
    echo "        <imkl:Maatvoering gml:id=\"" . $line["gmlid"] . "\">\n";
    echo "        <imkl:label>" . $line["label"] . "</imkl:label>\n";
    echo "        <imkl:omschrijving>" . $line["toelichtin"] . "</imkl:omschrijving>\n";
    echo "        <imkl:identificatie>\n";
    echo "            <imkl:NEN3610ID>\n";
    echo "                <imkl:namespace>IMKL2005</imkl:namespace><imkl:lokaalID>" . $line["gmlid"] .  "</imkl:lokaalID>\n";
    echo "            </imkl:NEN3610ID>\n";
    echo "        </imkl:identificatie>\n";
    echo "        <imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "        <imkl:maatvoeringsType xlink:href=\"maatvoeringslabel\"/>\n";
    echo "        <imkl:ligging>" . $line["geom"] . "</imkl:ligging>\n";
    echo "        </imkl:Maatvoering>\n";
    echo "    </gml:featureMember>\n\n";
}
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>

</gml:FeatureCollection>
