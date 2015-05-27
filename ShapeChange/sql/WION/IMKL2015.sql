CREATE TABLE maatvoering (

	id bigserial NOT NULL PRIMARY KEY,
	maatvoeringstype text NOT NULL,
	rotatiehoek numeric,
	ligging geometry(GEOMETRY,28992) NOT NULL
);

CREATE TABLE appurtenance (

	id bigserial NOT NULL PRIMARY KEY,
	hoogte text
);

CREATE TABLE extratopografie (

	id bigserial NOT NULL PRIMARY KEY,
	extratopografietype text NOT NULL,
	typetopografischobject text NOT NULL,
	ligging geometry(GEOMETRY,28992) NOT NULL
);

CREATE TABLE extradetailinfo (

	id bigserial NOT NULL PRIMARY KEY,
	adres unknown,
	bestandlocatie text NOT NULL,
	bestandmediatype text NOT NULL,
	bestandidentificator text,
	ligging geometry(GEOMETRY,28992) NOT NULL
);

CREATE TABLE diepte (

	id bigserial NOT NULL PRIMARY KEY,
	dieptenauwkeurigheid text NOT NULL,
	dieptepeil numeric NOT NULL,
	datumopmetingdieptepeil timestamp with timezone,
	ligging geometry(GEOMETRY,28992),
	heeftkabelofleiding unknown,
	heeftkabelenleidingcontainer unknown,
	heeftleidingelement unknown,
	heeftcontainerleidingelement unknown
);

CREATE TABLE utiliteitsnet (

	id bigserial NOT NULL PRIMARY KEY,
	technischcontactpersoon unknown NOT NULL,
	thema text NOT NULL,
	standaarddieptelegging bigserial
);

CREATE TABLE buis (

	id bigserial NOT NULL PRIMARY KEY,
	buismateriaaltype text
);

CREATE TABLE extrageometrie (

	id bigserial NOT NULL PRIMARY KEY,
	vlakgeometrie2d geometry(POLYGON,28992),
	puntgeometrie2_5d geometry(POINT,28992),
	lijngeometrie2_5d geometry(LINESTRING,28992),
	vlakgeometrie2_5d geometry(POLYGON,28992),
	geometrie3d text
);

CREATE TABLE dieptenap (

	id bigserial NOT NULL PRIMARY KEY,
	maaiveldpeil numeric,
	datumopmetingmaaiveldpeil timestamp with timezone
);

CREATE TABLE annotatie (

	id bigserial NOT NULL PRIMARY KEY,
	annotatietype text NOT NULL,
	rotatiehoek numeric,
	ligging geometry(GEOMETRY,28992) NOT NULL
);

CREATE TABLE aanduidingeisvoorzorgsmaatregel (

	id bigserial NOT NULL PRIMARY KEY,
	geometrie geometry(POLYGON,28992),
	geometriebegrenzingfictief boolean
);

CREATE TABLE dieptetovmaaiveld (

	id bigserial NOT NULL PRIMARY KEY,
	heeftutilitynetwork bigserial
);



ALTER TABLE utiliteitsnet ADD CONSTRAINT fk_utiliteitsnet_standaarddieptelegging_to_dieptetovmaaiveld FOREIGN KEY (standaarddieptelegging) REFERENCES dieptetovmaaiveld;
ALTER TABLE dieptetovmaaiveld ADD CONSTRAINT fk_dieptetovmaaiveld_heeftutilitynetwork_to_utiliteitsnet FOREIGN KEY (heeftutilitynetwork) REFERENCES utiliteitsnet;


CREATE INDEX idx_maatvoering_ligging ON maatvoering USING GIST (ligging);
CREATE INDEX idx_extratopografie_ligging ON extratopografie USING GIST (ligging);
CREATE INDEX idx_extradetailinfo_ligging ON extradetailinfo USING GIST (ligging);
CREATE INDEX idx_diepte_ligging ON diepte USING GIST (ligging);
CREATE INDEX idx_extrageometrie_vlakgeometrie2d ON extrageometrie USING GIST (vlakgeometrie2d);
CREATE INDEX idx_extrageometrie_puntgeometrie2_5d ON extrageometrie USING GIST (puntgeometrie2_5d);
CREATE INDEX idx_extrageometrie_lijngeometrie2_5d ON extrageometrie USING GIST (lijngeometrie2_5d);
CREATE INDEX idx_extrageometrie_vlakgeometrie2_5d ON extrageometrie USING GIST (vlakgeometrie2_5d);
CREATE INDEX idx_annotatie_ligging ON annotatie USING GIST (ligging);
CREATE INDEX idx_aanduidingeisvoorzorgsmaatregel_geometrie ON aanduidingeisvoorzorgsmaatregel USING GIST (geometrie);

