#!/usr/local/bin/php
<?xml version="1.0"?>
<rdf:RDF xmlns="http://www.w3.org/2004/02/skos/core#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<?php
date_default_timezone_set("Europe/Amsterdam");

echo "<!-- File created by Wilko Quak via the sql2rdf.php script on " .  date('Y-m-d') . " -->\n";

//
// Connect to DBMS.
//
$dbconn = pg_connect("");

$prevscheme = "";
$query = "select herkomst,source,attribute,value,labelnl,description,listname,url from codelists where attribute is not null order by listname";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());


while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    if ($line["listname"] != $prevscheme)
    {
        $listname = substr($line["url"],0,strrpos($line["url"],"/"));
        echo "<ConceptScheme rdf:about=\"" . $listname .  "\">\n";
	echo "    <type rdf:resource=\"http://www.w3.org/2002/07/owl#Thing\"/>\n";
        echo "</ConceptScheme>\n";

	$prevscheme = $line["listname"];
    }

    echo "<Concept rdf:about=\"" . $line["url"] .  "\">\n";
    echo "    <type rdf:resource=\"http://www.w3.org/2002/07/owl#Thing\"/>\n";
    echo "    <prefLabel rdf:datatype=\"http://www.w3.org/2001/XMLSchema#string\" xml:lang=\"nl\">" .  $line["labelnl"] . "</prefLabel>\n";
    echo "    <definition rdf:datatype=\"http://www.w3.org/2001/XMLSchema#string\" xml:lang=\"nl\">" .  $line["description"] . "</definition>\n";
    echo "</Concept>\n";
}
pg_free_result($result);


pg_close($dbconn);
?>
</rdf:RDF>

