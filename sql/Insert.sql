INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Luc','Dupuis','ld@hotmail.fr','GENERATE_PWD','asfd177c6d', null, 0, 0, 2, 'DATE', 'DATE', null, null );

INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Thomas','Rambla','tr@hotmail.fr','GENERATE_PWD','46f6577f9s',null, 0, 0, 2, 'DATE', 'DATE', null, null );

  INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Blandine','Delhoume','ef@hotmail.fr','GENERATE_PWD','49fsd77h6',null, 0, 0, 1, 'DATE', 'DATE', null, null );

  INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Manon','Delhoume','md@hotmail.fr','GENERATE_PWD','14fd177c9d',null, 0, 0, 2, 'DATE', 'DATE', null, null );

  INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )VALUES ('Guillaume','Delamare','sm@hotmail.fr','GENERATE_PWD','pffd177e9d',null, 0, 0, 1, 'DATE', 'DATE', null, null );


INSERT INTO Appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package,planned) VALUES ('DATE_RDV','HOUR_RDV',3,1,1, 1);

INSERT INTO Appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package,planned) VALUES ('DATE_RDV','HOUR_RDV',5,2,1, 1);

INSERT INTO Appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package,planned) VALUES ('DATE_RDV','HOUR_RDV',3,1,1, 1);

INSERT INTO Appointment(dateAppointment,hourAppointment,id_user,id_Hairdresser,id_Package,planned) VALUES ('DATE_RDV','HOUR_RDV',5,4,1, 1);


      INSERT INTO categoryType(type)
      VALUES  ('Article'),('Produits'),('Forfaits');


INSERT INTO user( firstname, lastname, email, pwd, token, tel, changetopwd, receivePromOffer, status, dateInserted, dateUpdated, lastConnection, picture )
    VALUES( 'FN_TOCHANGE', 'LN_TOCHANGE', 'MAIL_TOCHANGE',
                         'PWD_TOCHANGE', 'TOKEN_TOCHANGE', 'TEL_TOCHANGE', 0, 0, 'STATUS_TOCHANGE', 'DATE_TOCHANGE',
                         'DATE_TOCHANGE', null, null );

INSERT INTO color(name,code)
VALUES ('current','#637484'),
       ('standard','#637484'),
       ('currentBtn','#009CDF'),
       ('standardBtn','#009CDF');

INSERT INTO configuration( logo, email_address, email_pwd, postal_address, status_configuration , facebook_link, twitter_link, instagram_link, pinterest_link )
VALUES( 'LOGO_TOCHANGE', ' EMAILADDRESS_TOCHANGE', 'EMAILPWD_TO_CHANGE',
'POSTAL_TOCHANGE', 'STATUSCONFIG_TOCHANGE' , 'FACEBOOK', 'TWITTER' , 'INSTAGRAM', 'PINTEREST' )