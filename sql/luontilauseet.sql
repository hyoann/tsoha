CREATE TABLE tuoteryhma (
	id serial PRIMARY KEY,
	nimi varchar
);

CREATE TABLE tuote (
	id serial PRIMARY KEY,
	nimi varchar,
	hinta numeric (4,2),
	kuvaus varchar,
	kuva varchar,
	ryhma_id integer REFERENCES tuoteryhma(id)
);

CREATE TABLE lento (
	tunnus varchar PRIMARY KEY,
	lahtopaiva date,
	kohde varchar
);

CREATE TABLE asiakas (
	id serial PRIMARY KEY,
	kayttajatunnus varchar UNIQUE NOT NULL,
	salasana varchar NOT NULL,
	lentotunnus varchar NOT NULL REFERENCES lento(tunnus),
	istumapaikka varchar NOT NULL
);

CREATE TABLE ostos (
	id serial PRIMARY KEY,
	tuotemaara integer,
	asiakas_id integer REFERENCES asiakas(id),
	tuote_id integer REFERENCES tuote(id)
);

