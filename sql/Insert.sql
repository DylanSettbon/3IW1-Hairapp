INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Luc','Dupuis','ld@hotmail.fr','GENERATE_PWD','asfd177c6d', null, 0, 0, 2, 'DATE', 'DATE', null, null );

INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Thomas','Rambla','tr@hotmail.fr','GENERATE_PWD','46f6577f9s',null, 0, 0, 2, 'DATE', 'DATE', null, null );

INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Blandine','Delhoume','ef@hotmail.fr','GENERATE_PWD','49fsd77h6',null, 0, 0, 1, 'DATE', 'DATE', null, null );

INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Manon','Delhoume','md@hotmail.fr','GENERATE_PWD','14fd177c9d',null, 0, 0, 2, 'DATE', 'DATE', null, null );

INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Guillaume','Delamare','sm@hotmail.fr','GENERATE_PWD','pffd177e9d',null, 0, 0, 1, 'DATE', 'DATE', null, null );


INSERT INTO category (description_category, id_user, id_CategoryType, status_category) VALUES
  ('News', 1, 1, 1),('Promotion', 1, 1, 1),('Produits', 1, 1, 1);

INSERT INTO category (description_category, id_user, id_CategoryType, status_category, displayOrder)
VALUES ('Enfants', 1, 3, 1, 3), ('Hommes', 1, 3, 1, 2), ('Femmes', 1, 3, 1, 1);



INSERT INTO package (description, price, duration, id_User, id_Category, status) VALUES
  ('coupe enfants -10 ans', 12, 20, 1, 3, 1),
  ('Coupe', 15, 30, 1, 5, 1),
  ('Coupe + Shampoing', 20, 40, 1, 5, 1),
  ('Barbe', 10, 15, 1, 5, 1),
  ('Shampooing', 5, 10, 1, 6, 1),
  ('Coupe', 20, 30, 1, 6, 1),
  ('Shampooing + soin + coupe + brushing', 40, 90, 1, 6, 1);


INSERT INTO appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package) VALUES ('DAY_RDV','HOUR_RDV',1,3,1);

INSERT INTO appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package) VALUES ('DAY_RDV','HOUR_RDV',2,5,1);

INSERT INTO appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package) VALUES ('DAY_RDV','HOUR_RDV',1,3,1);

INSERT INTO appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package) VALUES ('DAY_RDV','HOUR_RDV',4,5,1);

INSERT INTO article ( name, description, dateparution, minidescription, image, status, id_Category) VALUES
  ('Gel', 'Promotion du 15Juillet', 'DATE', ' Promotion du 15Jui', NULL, 1, 2),
  ('Star au salon', 'Une celebrite est venu nous rendre visite', 'DATE', 'Une celebrite est v', NULL, 1, 1),
  ('Nouvelle brosse', 'La nouvelle brosse Elypse \r\nutilisée par les plus grands experts !', 'DATE', 'La nouvelle brosse ', NULL, 1, 3),
  ('Seche cheveux', 'Seche cheveux pour cheveux long', 'DATE', 'Seche cheveux pour ', NULL, 1, 2),
  ('Couleur ', 'Le Lorem Ipsum est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble', 'DATE', ' Le Lorem Ipsum est', NULL, 1, 2)
