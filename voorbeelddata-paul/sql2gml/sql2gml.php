#!/usr/bin/php
<?xml version="1.0"?>
<gml:FeatureCollection
    xmlns:gml="http://www.opengis.net/gml/3.2"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:imkl="http://www.geonovum.nl/wion/2015/1.0"
    xmlns:net="urn:x-inspire:specification:gmlas:Network:3.2"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:us-net-common="http://inspire.ec.europa.eu/schemas/us-net-common/3.0"
    gml:id="ID_1c0c5554-5c4a-467a-a9ef-9f36b5af2bfq"
    xsi:schemaLocation="http://www.geonovum.nl/wion/2015/1.0 ../../xsd/IMKL2015-wion.xsd">

	<?php

        echo "<!-- File created by sql2gml.php script on " .  date('Y-m-d') . " -->";

	$dbconn = pg_connect("");

// Performing SQL query
$query = 'select gid,id,thema,eisvoorhp,tcontpers,telefoon,email,authority,authrole,unetworkty from utiliteitsnet ;
';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "	<gml:featureMember>\n";
    echo "		<imkl:Utiliteitsnet gml:id=\"ID" . $line["id"] . uniqid() . "\">\n";
    echo "			<us-net-common:utilityNetworkType xlink:href=\"" . $line["unetworkty"] . "\"/>\n";
#
# TODO add aytgrole
#
    echo "			<us-net-common:authorityRole xlink:href=\"" . uniqid() ."\"/>\n";
    echo "<imkl:identificatie><imkl:NEN3610ID><imkl:namespace>hallo</imkl:namespace><imkl:lokaalID>xxyyzz</imkl:lokaalID></imkl:NEN3610ID></imkl:identificatie>\n";
    echo "			<imkl:beginLifespanVersion>2001-12-17T09:30:47.0Z</imkl:beginLifespanVersion>\n";
    echo "			<imkl:technischContactpersoon>\n";
    echo "				<imkl:TechnischContactpersoon>\n";
    echo "					<imkl:naam>" . $line["tcontpers"] . "</imkl:naam>\n";
    echo "					<imkl:telefoon>" . $line["telefoon"] . "</imkl:telefoon>\n";
    echo "					<imkl:email>" . $line["email"] . "</imkl:email>\n";
    echo "				</imkl:TechnischContactpersoon>\n";
    echo "			</imkl:technischContactpersoon>\n";
    echo "			<imkl:eisVoorzorgsmaatregelHoogstePrioriteit>" . $line["eisvoorhp"] . "\n";
    echo "			</imkl:eisVoorzorgsmaatregelHoogstePrioriteit>\n";
    echo "			<imkl:thema xlink:href=\"" . $line["thema"] . "\"/>\n";
    echo "		</imkl:Utiliteitsnet>\n";
    echo "	</gml:featureMember>\n\n";
}

// Free resultset
pg_free_result($result);

// Performing SQL query
$query = 'select gid,id,thema,netbeheer,type,status,vertpositi,bzichtbaar,dieptetovm,dieptenap,xinfo,hoogte,detailsch,ST_AsGML(3,geom,5,0,null,\'geomid\' || gid) as geom from leidingelement ;
';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "	<gml:featureMember>\n";
    echo "		<imkl:Appurtenance gml:id=\"ID" . $line["gid"] . "\">\n";
    echo "			<net:beginLifespanVersion>2001-12-17T09:30:47.0Z</net:beginLifespanVersion>\n";
#    echo "			<imkl:bovengrondsZichtbaar>" . $line["bzichtbaar"] . "\n";
#    echo "			</imkl:bovengrondsZichtbaar>\n";
    echo "			<net:inNetwork xlink:href=\"" . $line["thema"] . "\"/>\n";
    echo "			<net:geometry>" . $line["geom"] . "\n";
    echo "			</net:geometry>\n";
    echo "			<us-net-common:currentStatus xlink:href=\"" . $line["status"] ."\"/>\n";
    echo "			<us-net-common:validFrom>2001-12-17T09:30:47.0Z</us-net-common:validFrom>\n";
    echo "			<us-net-common:validTo>2001-12-17T09:30:47.0Z</us-net-common:validTo>\n";
    echo "			<us-net-common:verticalPosition>underground</us-net-common:verticalPosition>\n";
    echo "			<us-net-common:appurtenanceType xlink:href=\"\"/>\n";
    echo "		</imkl:Appurtenance>\n";
    echo "	</gml:featureMember>\n\n";
}

// Free resultset
pg_free_result($result);


// Closing connection
pg_close($dbconn);
?>

</gml:FeatureCollection>
