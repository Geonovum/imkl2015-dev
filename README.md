# imkl2015-dev

`NOTE: This git was used for the generation of IMKL schemas. It is preserved for future use when potential schemas need to be generated` 

This is the github reposotitory for the development of the IMKL2015 information model and schemas. In the repo we have the following folders:

* ShapeChange: Configuration files for the ShapeChange tool that convert the UML diagram to a GML application schema.
* codelists: tool that converts codelists in Excel sheet to SKOS.
* UML: The UML diagram.
* xsd: After ShapeChange the schemas's get a bit of postprocessing this is done here.

## URI Stratgy
In IMKL2015 objects are identified by URI's. Below we describe what URI's are used for what purposes:

### Codelijsten

In het codelijstergister zitten codelijsten en de codes zelf: een codelijst is een lijstje toegestane waardes (in de vorm van een URI).

    http://definities.geostandaarden.nl/imkl2015/id/waardelijst/[naam waardelijst]

Een code zelf is een URI met bijbehorende definitie:

    http://definities.geostandaarden.nl/imkl2015/id/waardelijst/[naam waardelijst]/[naam waarde]

Het feit dat in de  URL van een code de naam van de waardelijst voorkomt dit niet betekent dat die code alleen bij die waardelijst kan horen. 

Het RDF met de codelijst wordt gepubliceerd op:

    http://register.geostandaarden.nl/waardelijst/imkl/20151201/imkl2015.rdf

### GML Applicatieschema
Binnen IMKL komen momenteel drie applicatieschema’s voor: 

    WION: http://www.geostandaarden.nl/imkl/2015/wion/1.0
    RRB: http://www.geostandaarden.nl/imkl/2015/rrb/1.0
    SW: http://www.geostandaarden.nl/imkl/2015/sw/1.0


De XML schema’s worden gepubliceerd op het technisch register op:

    http://register.geostandaarden.nl/gmlapplicatieschema/imkl/1.0.0RC1/IMKL2015-wion.xsd
    http://register.geostandaarden.nl/gmlapplicatieschema/imkl/1.0.0RC1/IMKL2015-rrb.xsd
    http://register.geostandaarden.nl/gmlapplicatieschema/imkl/1.0.0RC1/IMKL2015-sw.xsd

