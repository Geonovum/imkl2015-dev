#!/usr/bin/php
<?xml version="1.0"?>
<gml:FeatureCollection
    xmlns:imkl="http://www.geonovum.nl/wion/2015/1.0"
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
    xsi:schemaLocation="http://www.geonovum.nl/wion/2015/1.0 ../../xsd/IMKL2015-wion.xsd">

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
	echo "        <" . $attribute . " xlink:href=\"http://www.geonovum.nl/imkl2015/1.0/def/" . $codelist . "/" .  $value . "\"/>\n";
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

function printINSPIREID($namespace,$bronhoudercode,$lokaalid)
{
    echo "            <" . $namespace . ":inspireId>\n";
    echo "                <base:Identifier>\n";
    echo "                    <base:localId>" . $bronhoudercode . "." . $lokaalid. "</base:localId>\n";
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


echo "<!-- File created by Wilko Quak via the sql2gml.php script on " .  date('Y-m-d') . " -->\n";

//
// Connect to DBMS.
//
$dbconn = pg_connect("");

//
// Process utiliteitsnet.
//
$query = 'select gid,id,thema,eisvoorhp,tcontpers,telefoon,email,authority,authrole,unetworkty,thema_code,bhcode,unetid from utiliteitsnet ;';
// authority and authrole,thema_code worden niet gebruikt
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Utiliteitsnet",$line["bhcode"],$line["unetid"]);
    printINSPIREcodelistvalue("us-net-common:utilityNetworkType","UtilityNetworkTypeValue",$line["unetworkty"]);
    printhref("us-net-common:authorityRole",$line["bhcode"]);
    printNEN3610ID($line["bhcode"],$line["unetid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue('imkl:thema','Thema',$line["thema"]);
    printopen("imkl:technischContactpersoon");
    printopen("imkl:TechnischContactpersoon");
    printattribute("imkl:naam",$line["tcontpers"]);
    printattribute("imkl:telefoon",$line["telefoon"]);
    printattribute("imkl:email",$line["email"]);
    printclose("imkl:TechnischContactpersoon");
    printclose("imkl:technischContactpersoon");
    printclose("imkl:Utiliteitsnet");
    printclose("gml:featureMember");
}
pg_free_result($result);

//
// Process leidingelement
//
$query = 'select gmlid,gid,id,netbeheer,typeurl,status,vertpositi,bzichtbaar,dieptetovm,dieptenap,xinfo,hoogte,detailsch,ST_AsGML(3,geom,5,0,null) as geom,unetid,bhcode from v_leidingelement ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Appurtenance",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printattribute("net:geometry",$line["geom"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition",$line["vertpositi"]);
    printMycodelistvalue("us-net-common:appurtenanceType",$line["typeurl"]);
    printhrefopt("imkl:heeftExtraInformatie",$line["detailsch"]);
    printclose("imkl:Appurtenance");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Process oliegaschemicalien
#
$query = 'select bhcode,gmlid,unetid,netbeheer,status,vertpositi,producttyp,warningt,toelichtin,pressure,pipediam,dieptetovm,dieptenap,xinfo,disttype from v_oliegaschemicalien ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:OlieGasChemicalienPijpleiding",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printINSPIREID("net",$line["bhcode"],$line["gmlid"]);
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printhref("net:link", "nl.imkl." . $line["bhcode"] .  ".ulinkid-" .  $line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    printhref("us-net-common:utilityFacilityReference","");
    printINSPIREcodelistvalue("us-net-common:warningType","WarningTypeValue","net");
    printattribute_tvale("us-net-common:pipeDiameter",$line["pipediam"],"uom=\"urn:ogc:def:uom:OGC::cm\"");
    printattribute_tvale("us-net-common:pressure",$line["pressure"],"uom=\"urn:ogc:def:uom:OGC::bar\"");
    printINSPIREcodelistvalue("us-net-ogc:oilGasChemicalsProductType","OilGasChemicalsProductTypeValue",$line["producttyp"]);
    printclose("imkl:OlieGasChemicalienPijpleiding");
    printclose("gml:featureMember");
}
pg_free_result($result);

//
// Kabelbed
//
$query = 'select bhcode,gmlid,unetid,type,netbeheer,status,vertpositi,disttype,warningt,ductwidth,bzichtbaar,toelichtin,aantalk,dieptetovm,dieptenap,xinfo,geom from v_kabelbed;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Kabelbed",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printhref("net:link", "nl.imkl." . $line["bhcode"] .  ".ulinkid-" .  $line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    printINSPIREcodelistvalue("us-net-common:warningType","WarningTypeValue","net");
    printattribute_tvale("us-net-common:ductWidth",$line["ductwidth"],"uom=\"urn:ogc:def:uom:OGC::cm\"");
    printclose("imkl:Kabelbed");
    printclose("gml:featureMember");
}
pg_free_result($result);


//
// Process elektriciteitskabel
//
$query = 'select bhcode,gmlid,unetid,netbeheer,status,vertpositi,warningt,opvolt,nomvolt,toelichtin,dieptetovm,dieptenap,xinfo,disttype from v_elektriciteitskabel ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Elektriciteitskabel",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printhref("net:link", "nl.imkl." . $line["bhcode"] .  ".ulinkid-" .  $line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    printINSPIREcodelistvalue("us-net-common:warningType","WarningTypeValue","net");
    printattribute_tvale("us-net-el:operatingVoltage",$line["opvolt"],"uom=\"urn:ogc:def:uom:OGC::V\"");
    printattribute_tvale("us-net-el:nominalVoltage",$line["nomvolt"],"uom=\"urn:ogc:def:uom:OGC::V\"");
    printclose("imkl:Elektriciteitskabel");
    printclose("gml:featureMember");
}
pg_free_result($result);

//
// Process utilitylink
//
$query = 'select bhcode,gmlid,status,unetid,ST_AsGML(3,geom,5,0,null) as geom from utilitylink;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("us-net-common:UtilityLink",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printINSPIREID("net",$line["bhcode"],$line["gmlid"]);
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printattribute("net:centrelineGeometry",$line["geom"]);
    printattribute("net:fictitious","false");
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printhref("us-net-common:verticalPosition","");
    printclose("us-net-common:UtilityLink");
    printclose("gml:featureMember");
}
pg_free_result($result);



#
# Process waterleiding
#
$query = 'select
bhcode,gmlid,objectid,obj_id,ltyp,lbez,byear,aclass_id,gclass_id,gtype_id,enabled,cstype_id,length_mea,uttracewei,status,origobject,refscale,soort,medium,geo_kwalit,projectnum,functie,cp_ctrl_ar,cp_ctrl__1,cp_prot_ar,cp_prot__1,risicovol,crucialite,kb_nummer,diameter,materiaal,wanddikte,trace_nr,shape_len,unetid,netbeheer,status_1,vertpositi,disttype,warningt,pipediam,pressure,producttyp,toelichtin,dieptetovm,dieptenap,xinfo,geom
from v_water_kabelofleiding ;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Waterleiding",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printINSPIREID("net",$line["bhcode"],$line["gmlid"]);
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printhref("net:link", "nl.imkl." . $line["bhcode"] .  ".ulinkid-" .  $line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status_1"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    printINSPIREcodelistvalue("us-net-common:warningType","WarningTypeValue","net");
    printattribute_tvale("us-net-common:pipeDiameter",$line["pipediam"],"uom=\"urn:ogc:def:uom:OGC::cm\"");
    printattribute_tvale("us-net-common:pressure",$line["pressure"],"uom=\"urn:ogc:def:uom:OGC::bar\"");
    printINSPIREcodelistvalue("us-net-wa:waterType","WaterTypeValue",$line["producttyp"]);
    printclose("imkl:Waterleiding");
    printclose("gml:featureMember");
}
pg_free_result($result);


#
# Process Riool_vv
#
$query = 'select
bhcode,gmlid,unetid,netbeheer,status,vertpositi,disttype,warningt,pipediam,pressure,swatertype,toelichtin,dieptetovm,dieptenap,xinfo,geom
from v_rioolvv_kabelofleiding;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Rioolleiding",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printINSPIREID("net",$line["bhcode"],$line["gmlid"]);
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printhref("net:link", "nl.imkl." . $line["bhcode"] .  ".ulinkid-" .  $line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    printINSPIREcodelistvalue("us-net-common:warningType","WarningTypeValue","net");
    printattribute_tvale("us-net-common:pipeDiameter",$line["pipediam"],"uom=\"urn:ogc:def:uom:OGC::cm\"");
    printattribute_tvale("us-net-common:pressure",$line["pressure"],"uom=\"urn:ogc:def:uom:OGC::bar\"");
    printINSPIREcodelistvalue("us-net-sw:sewerWaterType","SewerWaterTypeValue",$line["swatertype"]);
    printclose("imkl:Rioolleiding");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Process AaanduidingEisVoorzorgsmaatregel
#
$query = 'select bhcode,gmlid,unetid,netbeheer,eisvoorzm,geofict, ST_AsGML(3,geom,5,0,null) as geom from v_aanduidingeisvoorzorgsmaatregel;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:AanduidingEisVoorzorgsmaatregel",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printhref("imkl:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printattribute("imkl:eisVoorzorgsmaatregel",$line["eisvoorzm"]);
    printattribute("imkl:geometriebegrenzingFictief",$line["geofict"]);
    printattribute("imkl:geometrie",$line["geom"]);
    printclose("imkl:AanduidingEisVoorzorgsmaatregel");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Process diepte
#
$query = 'select bhcode,gmlid,unetid,netbeheer,dtovmveld,dtovnap,nauwk from v_diepte;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:DiepteTovMaaiveld",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue("imkl:diepteNauwkeurigheid","NauwkeurigheidDiepteValue",$line["nauwk"]);
    printattribute_tvale("imkl:dieptePeil",$line["dtovmveld"],"uom=\"urn:ogc:def:uom:OGC::bar\"");
    printhref("imkl:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printclose("imkl:DiepteTovMaaiveld");
    printclose("gml:featureMember");
}
pg_free_result($result);


#
# Extra Geometrie
#
$query = 'select bhcode,gmlid,unetid,netbeheer,type,ST_AsGML(3,geom,5,0,null) as geom from v_extrageometrie;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:ExtraGeometrie",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printattribute("imkl:vlakgeometrie2.5D",$line["geom"]);
    printclose("imkl:ExtraGeometrie");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Extra Topografie
#
$query = 'select
bhcode,gmlid,unetid,netbeheer,type,typeobject,ST_AsGML(3,geom,5,0,null) as geom from v_extratopo;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:ExtraTopografie",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue('imkl:extraTopografieType','ExtraTopografieTypeValue',$line["type"]);
    printNENcodelistvalue('imkl:typeTopografischObject','TopografischObjectTypeValue',$line["typeobject"]);
    printattribute("imkl:ligging",$line["geom"]);
    printhref("imkl:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printclose("imkl:ExtraTopografie");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Annotatie punt
#
# TODO: beschrijving moet nog ergens.
#

$query = 'select bhcode,gmlid,unetid,netbeheer,label,beschrijvi,ST_AsGML(3,geom,5,0,null) as geom from v_annotatie;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Annotatie",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue('imkl:annotatieType','AnnotatieTypeValue','annotatieLabel');
    printattribute("imkl:ligging",$line["geom"]);
    printclose("imkl:Annotatie");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Annotatie lijn
#
$query = 'select bhcode,gmlid,unetid,thema,type,netbeheer,ST_AsGML(3,geom,5,0,null) as geom from v_annotatie_lijn;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Annotatie",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue('imkl:annotatieType','AnnotatieTypeValue',$line["type"]);
    printattribute("imkl:ligging",$line["geom"]);
    printclose("imkl:Annotatie");
    printclose("gml:featureMember");
}
pg_free_result($result);


#
# Maatvoering_pijl
#
$query = 'select bhcode,gmlid,rotatie,unetid,netbeheer,type,ST_AsGML(3,geom,5,0,null) as geom from v_maatvoering_pijl;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Maatvoering",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue('imkl:maatvoeringsType','MaatvoeringsTypeValue',$line["type"]);
    printattribute_tvale("imkl:rotatiehoek",$line["rotatie"],"uom=\"urn:ogc:def:uom:OGC::deg\"");
    printattribute("imkl:ligging",$line["geom"]);
    printclose("imkl:Maatvoering");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Maatvoering_label
#
$query = 'select bhcode,gmlid,unetid,netbeheer,toelichtin,label,ST_AsGML(3,geom,5,0,null) as geom from v_maatvoering_label;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Maatvoering",$line["bhcode"],$line["gmlid"]);
    printattribute("imkl:label",$line["label"]);
    printattribute("imkl:omschrijving",$line["toelichtin"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue('imkl:maatvoeringsType','MaatvoeringsTypeValue',"maatvoeringslabel");
    printattribute("imkl:ligging",$line["geom"]);
    printclose("imkl:Maatvoering");
    printclose("gml:featureMember");
}
pg_free_result($result);
#
# Mangat
#
$query = 'select gmlid,netbeheer,thema,type,ST_AsGML(3,geom,5,0,null) as geom,unetid,bhcode from mangat;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Mangat",$line["bhcode"],$line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue","functional");
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    printattribute("us-net-common:geometry",$line["geom"]);
    printINSPIREID("us-net-common",$line["bhcode"],$line["gmlid"]);
    printNENcodelistvalue('imkl:containerLeidingelementType','containerLeidingelementType',"type");
    printhref("imkl:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printclose("imkl:Mangat");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Mast
#
$query = 'select gmlid,netbeheer,thema,type,ST_AsGML(3,geom,5,0,null) as geom,unetid,bhcode from mast;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Mast",$line["bhcode"],$line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue","functional");
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition","underground");
    printattribute("us-net-common:geometry",$line["geom"]);
    printINSPIREID("us-net-common",$line["bhcode"],$line["gmlid"]);
    printattribute_tvale("us-net-common:poleHeight","100.0","uom=\"urn:ogc:def:uom:OGC::bar\"");
    printNENcodelistvalue('imkl:containerLeidingelementType','containerLeidingelementType',"type");
    printhref("imkl:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printclose("imkl:Mast");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Maatvoering_lijn
#
$query = 'select bhcode,gmlid,unetid,netbeheer,type,ST_AsGML(3,geom,5,0,null) as geom from v_maatvoering_lijn;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Maatvoering",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["gmlid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue('imkl:maatvoeringsType','MaatvoeringsTypeValue',$line["type"]);
    printattribute("imkl:ligging",$line["geom"]);
    printclose("imkl:Maatvoering");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# KabelEnLeidingContainer (Hier zitten alleen mantelbuizen in)
#
$query = 'select bhcode,gmlid,unetid,typeleidin,thema,netbeheer,status,vertpositi,disttype,warningt,pipediam,pressure,buismat,bzichtbaar,toelichtin,aantalk,dieptetovm,dieptenap,xinfo,detailsch,ST_AsGML(3,geom,5,0,null) as geom from v_kabelenleidingcontainer;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
#typeleidin thema netbeheer status vertpositi disttype
#warningt pipediam pressure bzichtbaar toelichtin aantalk dieptetovm
#dieptenap xinfo detailsch 

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Mantelbuis",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printhref("net:link", "nl.imkl." . $line["bhcode"] .  ".ulinkid-" .  $line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition",$line["vertpositi"]);
    printINSPIREcodelistvalue("us-net-common:warningType","WarningTypeValue","net");
    printattribute_tvale("us-net-common:pipeDiameter",$line["pipediam"],"uom=\"urn:ogc:def:uom:OGC::cm\"");
    printattribute_tvale("us-net-common:pressure",$line["pressure"],"uom=\"urn:ogc:def:uom:OGC::bar\"");
    printNENcodelistvalue('imkl:buismateriaalType','MateriaalTypeValue',"buismat");
    printclose("imkl:Mantelbuis");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Process ExtraDetailInfo
#
$query = 'select bhcode,gmlid,unetid,thema,netbeheer,type,bestand,adres,ST_AsGML(3,geom,5,0,null) as geom from v_extradetailinfo;';

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:ExtraDetailinfo",$line["bhcode"],$line["gmlid"]);
    printNEN3610ID($line["bhcode"],$line["unetid"]);
    printLifespan("imkl","2001-12-17T09:30:47.0Z","");
    printNENcodelistvalue("imkl:extraInfoType","ExtraDetailInfoTypeValue",$line["type"]);
    printattribute("imkl:bestandLocatie",$line["bestand"]);
    printhref("imkl:bestandMediaType",$line["type"]);
    printattribute("imkl:ligging",$line["geom"]);
    printclose("imkl:ExtraDetailinfo");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# Process Kunstwerk_Containerelement (== Duct)
#
$query = ' select gmlid, gid, id, netbeheer, thema, toelichtin, detailsche, status, vertpositi, disttype, warningt, ductwidth, bzichtbaar, aantalk, dieptetovm, dieptenap, xinfo, ST_AsGML(3,geom,5,0,null) as geom, unetid, bhcode
from v_Kunstwerk_Containerelement;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
#gmlid, gid, id, netbeheer, thema, toelichtin, detailsche, status, vertpositi,
#disttype, warningt, ductwidth, bzichtbaar, aantalk, dieptetovm, dieptenap,
#xinfo, ST_AsGML(3,geom,5,0,null) as geom, unetid, bhcode 

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    printopen("gml:featureMember");
    openfeature("imkl:Duct",$line["bhcode"],$line["gmlid"]);
    printLifespan("net","2001-12-17T09:30:47.0Z","");
    printhref("net:inNetwork",makegmlid($line["bhcode"],$line["unetid"]));
    printhref("net:link", "nl.imkl." . $line["bhcode"] .  ".ulinkid-" .  $line["gmlid"]);
    printINSPIREcodelistvalue("us-net-common:currentStatus","ConditionOfFacilityValue",$line["status"]);
    printValidity("2001-12-17T09:30:47.0Z","2001-12-17T09:30:47.0Z");
    printattribute("us-net-common:verticalPosition",$line["vertpositi"]);
    printINSPIREcodelistvalue("us-net-common:warningType","WarningTypeValue","net");
    printattribute_tvale("us-net-common:ductWidth",$line["ductwidth"],"uom=\"urn:ogc:def:uom:OGC::cm\"");
    printclose("imkl:Duct");
    printclose("gml:featureMember");
}
pg_free_result($result);

#
# TODO geulmof objecten zouden verplaatst moeten worden naar Appurtenenance
# terwijl ze nu in container zitten.
#
# TODO DT_KabelOfLeiding
#

// Closing connection
pg_close($dbconn);
?>

</gml:FeatureCollection>
