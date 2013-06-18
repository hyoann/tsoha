CREATE TABLE lento (
	tunnus varchar PRIMARY KEY,
	lahtopaiva date NOT NULL,
	kohde varchar NOT NULL
);

CREATE TABLE tuoteryhma (
	id serial PRIMARY KEY,
	nimi varchar UNIQUE NOT NULL
);

CREATE TABLE tuote (
	id serial PRIMARY KEY,
	nimi varchar UNIQUE NOT NULL,
	hinta numeric CHECK (hinta > 0) NOT NULL,
	kuvaus varchar,
	kuva varchar,
	ryhma_id integer REFERENCES tuoteryhma(id)
);

CREATE TABLE asiakas (
	id serial PRIMARY KEY,
	kayttajatunnus varchar UNIQUE NOT NULL,
	salasana varchar NOT NULL,
	nimi varchar NOT NULL,
	osoite varchar NOT NULL,
	puhelin varchar NOT NULL,
	lento varchar NOT NULL REFERENCES lento(tunnus) ON DELETE CASCADE,
	istumapaikka varchar NOT NULL
);

CREATE TABLE ostos (
	id serial PRIMARY KEY,
	tuotemaara integer CHECK (tuotemaara >= 0),
	asiakas_id integer REFERENCES asiakas(id) ON DELETE CASCADE,
	tuote_id integer REFERENCES tuote(id)
);

