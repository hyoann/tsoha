INSERT INTO lento (tunnus, lahtopaiva, kohde) VALUES
	('AY882', '2013-08-28', 'Oulu'),
	('LH2464', '2013-10-22', 'Frankfurt');

INSERT INTO asiakas (kayttajatunnus, salasana, lentotunnus, istumapaikka) VALUES
	('hii', 'sala1', 'AY882', '01B'),
	('ohoi', 'sala2', 'LH2464', '06F');
	
INSERT INTO tuoteryhma (nimi) VALUES
	('makeiset'),
	('kosmetiikka'),
	('virvoitusjuomat'),
	('alkoholijuomat'),
	('pukeutuminen');
