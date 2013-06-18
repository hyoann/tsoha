INSERT INTO lento (tunnus, lahtopaiva, kohde) VALUES
	('AY882', '2013-08-28', 'Oulu'),
	('LH2464', '2013-10-22', 'Frankfurt'),
	('AF1098', '2013-09-12', 'Pariisi'),
	('BA1982', '2013-07-11', 'Lontoo');

INSERT INTO asiakas (kayttajatunnus, salasana, nimi, osoite, puhelin, lento, istumapaikka) VALUES
	('hii', 'sala1', 'Heikki Ilmarinen', 'Jännäkatu 27 A, 00510 KUOPIO', '0109562974', 'AY882', '01B'),
	('ohoi', 'sala2', 'Jutta Menninkäinen', 'Hienotie 4 C 21, 02350 IISALMI', '0603826501', 'LH2464', '06F'),
	('there', 'sala3', 'Mikko Siirappila', 'Kivamäki 175, 01405 IVALO', '0220186539', 'LH2464', '23G'),
	('taas', 'sala4', 'Vera Taaja', 'Lelurinne 4 F 51, 03800 PORI', '0239122139', 'LH2464', '12F'),
	('yksi', 'sala5', 'Minna Hannula', 'Keskitie 1 E 32, 02300 HAMINA', '0129672995', 'LH2464', '11C'),
	('nimi', 'sala6', 'Tytti Pesonen', 'Ristikkokuja  25, 00700 ÄHTÄRI', '0438129876', 'AY882', '12B' ),
	('tahan', 'sala7','Boris Maunula', 'Liinatie 2 D 11, 002100 RAAHE', '0129876543', 'AF1098', '02A');
	
INSERT INTO tuoteryhma (nimi) VALUES
	('Makeiset'),
	('Kosmetiikka'),
	('Virvoitusjuomat'),
	('Alkoholijuomat'),
	('Pukeutuminen');
